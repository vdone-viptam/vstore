<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItemV2;
use App\Models\CartV2;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class OrderController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
            'product_id' => 'required',
            'vshop_id' => 'required',
            'quantity' => 'required|numeric',
            'method_payment' => 'required|in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD',
            'fullname' => 'required',
            'phone' => 'required',
            'district_id' => 'required',
            'province_id' => 'required',
            'ward_id' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'error' => $validator->errors(),
            ]);
        }

        $methodPayment = $request->method_payment;
        $productId = $request->product_id;
        $vshopId = $request->vshop_id;
        $quantity = $request->quantity;

        $product = Product::where('products.id', $request->product_id)
            ->join('vshop_products', 'vshop_products.product_id', '=', 'products.id')
            ->join('vshop', 'vshop.id', '=', 'vshop_products.vshop_id')
            ->select(
                'products.id',
                'products.images',
                'products.name',
                'products.vat',
                'products.type_pay',
                'products.price',
                'products.weight',
                'vshop.id as vshop_id'
            )
            ->first();

        $product->quantity = $quantity;

        if (!$product) {
            return response()->json([
                'status_code' => 404
            ], 404);
        }
        $discount = getDiscountProduct($productId, $vshopId);
        $product->discount = $discount;

        $userId = $request->user_id;
        $fullname = $request->fullname;
        $phone = $request->phone;
        $districtId = $request->district_id;
        $provinceId = $request->province_id;
        $wardId = $request->ward_id;
        $address = $request->address;

        $order = new Order();
        $order->pay = 1;
        $order->user_id = $userId;
        $order->status = config('constants.orderStatus.wait_for_confirmation');
        $latestOrder = Order::orderBy('created_at', 'DESC')->first();
        $order->no = Str::random(5) . str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);
        $order->shipping = 0; // Tổng phí ship
        $order->total = $product->price * $quantity;
        $totalDiscountSuppliersAndVStore = 0;
        if (isset($discount['discountsFromSuppliers'])) {
            $totalDiscountSuppliersAndVStore += $discount['discountsFromSuppliers'];
        }
        if (isset($discount['discountsFromVStore'])) {
            $totalDiscountSuppliersAndVStore += $discount['discountsFromVStore'];
        }
        if ($totalDiscountSuppliersAndVStore > 0) {
            $order->total = $order->total - $order->total * ($totalDiscountSuppliersAndVStore / 100);
        }
        if (isset($discount['discountsFromVShop'])) {
            $order->total = $order->total - $order->total * ($discount['discountsFromVShop'] / 100);
        }

        $totalVat = 0;

        if ($districtId && $provinceId && $wardId && $address) {
            $order->district_id = $districtId;
            $order->ward_id = $wardId;
            $order->province_id = $provinceId;
            $order->address = $address;
            $vat = $order->total * ($product->vat / 100);
            $order->total = $order->total + $vat;
            $totalVat = $vat;

            $body = [
                // Cần tính toán các sản phẩm ở kho nào rồi tính phí vận chuyển. Hiện tại chưa làm
                'SENDER_DISTRICT' => 14, // Cầu giấy
                'SENDER_PROVINCE' => 1, // Hà Nội
                'RECEIVER_DISTRICT' => $districtId,
                'RECEIVER_PROVINCE' => $provinceId,

                'PRODUCT_TYPE' => config('viettelPost.productType.commodity'),
                'PRODUCT_WEIGHT' => $product->weight * $quantity,
                'PRODUCT_PRICE' => $order->total,
                'MONEY_COLLECTION' => $methodPayment === 'COD' ? $order->total : 0,
                'TYPE' => config('viettelPost.nationalType.domesticType'),
            ];

            $getPriceAll = Http::withHeaders(
                [
                    'Content-Type' => ' application/json',
                    'Token' => 'eyJhbGciOiJFUzI1NiJ9.eyJzdWIiOiIwODEzNjM1ODY4IiwiVXNlcklkIjoxMjU3NzU2NSwiRnJvbVNvdXJjZSI6NSwiVG9rZW4iOiIzWFk1OFFFSFA1N0pLUzBIVSIsImV4cCI6MTY3ODYwODgwNCwiUGFydG5lciI6MTI1Nzc1NjV9.C3rYwtrUN5uCiIA4DF7xLUUgTwOA0Lp4DM1JtKJxv52uhF6lgHx7OmoPDVlkTb8dxJei-YCq2a0Rq7StlRMBVA' //$login['data']['token']
                ]
            )->post('https://partner.viettelpost.vn/v2/order/getPriceAll', $body);

            if ($getPriceAll->status() !== 200) {
                return response()->json([
                    "status_code" => 403,
                    "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                ]);
            }
            $ORDER_SERVICE = $getPriceAll[0]['MA_DV_CHINH'];


            $body = [
                // Cần tính toán các sản phẩm ở kho nào rồi tính phí vận chuyển. Hiện tại chưa làm
                'SENDER_DISTRICT' => 14, // Cầu giấy
                'SENDER_PROVINCE' => 1, // Hà Nội
                'RECEIVER_DISTRICT' => $districtId,
                'RECEIVER_PROVINCE' => $provinceId,

                "ORDER_SERVICE_ADD" => "",
                "ORDER_SERVICE" => $ORDER_SERVICE,

                'PRODUCT_TYPE' => config('viettelPost.productType.commodity'),
                'PRODUCT_WEIGHT' => $product->weight * $quantity,
                'PRODUCT_PRICE' => $order->total,
                'MONEY_COLLECTION' => $methodPayment === 'COD' ? $order->total : 0,
                'NATIONAL_TYPE' => config('viettelPost.nationlType.domesticType'),
            ];

            $getPrice = Http::withHeaders(
                [
                    'Content-Type' => ' application/json',
                    'Token' => 'eyJhbGciOiJFUzI1NiJ9.eyJzdWIiOiIwODEzNjM1ODY4IiwiVXNlcklkIjoxMjU3NzU2NSwiRnJvbVNvdXJjZSI6NSwiVG9rZW4iOiIzWFk1OFFFSFA1N0pLUzBIVSIsImV4cCI6MTY3ODYwODgwNCwiUGFydG5lciI6MTI1Nzc1NjV9.C3rYwtrUN5uCiIA4DF7xLUUgTwOA0Lp4DM1JtKJxv52uhF6lgHx7OmoPDVlkTb8dxJei-YCq2a0Rq7StlRMBVA' //$login['data']['token']
                ]
            )->post('https://partner.viettelpost.vn/v2/order/getPrice', $body);
            if ($getPrice['status'] !== 200) {
                return response()->json([
                    "status_code" => 403,
                    "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                ]);
            }
            $transportFee = $getPrice['data']['MONEY_TOTAL_OLD'];

            $order->total += $transportFee;
            $order->shipping = $transportFee;
        }
        if ($fullname && $phone) {
            $order->fullname = $fullname;
            $order->phone = $phone;
        }
        $order->warehouse_id = 1;
        $order->method_payment = $methodPayment;
        $order->save();

        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product->id;
        $orderItem->vshop_id = $product->vshop_id;
        $orderItem->warehouse_id = 1;
        $orderItem->sku = '';
        $orderItem->price = $product->price;
        $orderItem->quantity = $quantity;
        $orderItem->discount_vshop = isset($discount['discountsFromVShop']) ? $discount['discountsFromVShop'] : 0;
        $orderItem->discount_ncc = isset($discount['discountsFromSuppliers']) ? $discount['discountsFromSuppliers'] : 0;
        $orderItem->discount_vstore = isset($discount['discountsFromVStore']) ? $discount['discountsFromVStore'] : 0;
        $orderItem->save();
        $product->images = json_decode($product->images);

        $order->total_vat = $totalVat;

        return response()->json([
            'status_code' => 200,
            'order' => $order,
            'product' => $product,
            'method_payment' => $methodPayment
        ]);
    }

    public function update(Request $request, $orderId)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
            'method_payment' => 'in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'error' => $validator->errors(),
            ]);
        }
        $order = Order::find($orderId);
        $methodPayment = $request->method_payment ? $request->method_payment : $order->method_payment;
        if (!$order) {
            return response()->json([
                "status_code" => 404
            ], 404);
        }
        $orderItems = OrderItem::where('order_id', $order->id)
            ->join('products', 'products.id', '=', 'order_item.product_id')
            ->select(
                'order_item.discount_ncc',
                'order_item.discount_vstore',
                'order_item.discount_vshop',
                'order_item.vshop_id',
                'order_item.quantity',
                'products.weight',
                'products.price',
                'products.vat',
                'products.images',
                'products.name',
                'products.type_pay',
                'products.price',
            )
            ->get();
        $districtId = $request->district_id;
        $provinceId = $request->province_id;
        $wardId = $request->ward_id;
        $address = $request->address;
        $totalVat = 0;
        if ($districtId && $provinceId && $wardId && $address) {
            $order->district_id = $districtId;
            $order->ward_id = $wardId;
            $order->province_id = $provinceId;
            $order->address = $address;
            $result = [];
            foreach ($orderItems as $item) {
                $result[$item['vshop_id']]['vshop'] = [
                    "name" => $item->name_vshop,
                    "id" => $item->vshop_id_,
                ];
                $item->images = json_decode($item->images);
                $result[$item['vshop_id']]['products'][] = $item;
            }
            $totalShipping = 0;
            $total = 0;
            foreach ($result as $item) {
                $price = 0;
                $weight = 0;
                foreach ($item['products'] as $pro) {
                    $weight += $pro->weight * $pro->quantity;
                    $priceDiscount = $pro->price * $pro->quantity;
                    $totalDiscountSuppliersAndVStore = 0;
                    if ($pro->discount_ncc) {
                        $totalDiscountSuppliersAndVStore += $pro->discount_ncc;
                    }
                    if ($pro->discount_vstore) {
                        $totalDiscountSuppliersAndVStore += $pro->discount_vstore;
                    }
                    if ($totalDiscountSuppliersAndVStore > 0) {
                        $priceDiscount = $priceDiscount - $priceDiscount * ($totalDiscountSuppliersAndVStore / 100);
                    }
                    if ($pro->discount_vshop) {
                        $priceDiscount = $priceDiscount - $priceDiscount * ($pro->discount_vshop / 100);
                    }
                    $price += $priceDiscount;
                    //Tính VAT
                    $vat = $price * ($pro['vat'] / 100);
                    $totalVat += $vat;
                    $price = $price + $vat;
                }

                $body = [
                    // Cần tính toán các sản phẩm ở kho nào rồi tính phí vận chuyển. Hiện tại chưa làm
                    'SENDER_DISTRICT' => 14, // Cầu giấy
                    'SENDER_PROVINCE' => 1, // Hà Nội
                    'RECEIVER_DISTRICT' => $districtId,
                    'RECEIVER_PROVINCE' => $provinceId,

                    'PRODUCT_TYPE' => config('viettelPost.productType.commodity'),
                    'PRODUCT_WEIGHT' => $weight,
                    'PRODUCT_PRICE' => $price,
                    'MONEY_COLLECTION' => $methodPayment === 'COD' ? $price : 0,
                    'TYPE' => config('viettelPost.nationalType.domesticType'),
                ];

                $getPriceAll = Http::withHeaders(
                    [
                        'Content-Type' => ' application/json',
                        'Token' => 'eyJhbGciOiJFUzI1NiJ9.eyJzdWIiOiIwODEzNjM1ODY4IiwiVXNlcklkIjoxMjU3NzU2NSwiRnJvbVNvdXJjZSI6NSwiVG9rZW4iOiIzWFk1OFFFSFA1N0pLUzBIVSIsImV4cCI6MTY3ODYwODgwNCwiUGFydG5lciI6MTI1Nzc1NjV9.C3rYwtrUN5uCiIA4DF7xLUUgTwOA0Lp4DM1JtKJxv52uhF6lgHx7OmoPDVlkTb8dxJei-YCq2a0Rq7StlRMBVA' //$login['data']['token']
                    ]
                )->post('https://partner.viettelpost.vn/v2/order/getPriceAll', $body);
                if ($getPriceAll->status() !== 200) {
                    return response()->json([
                        "status_code" => 403,
                        "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                    ]);
                }
                $ORDER_SERVICE = $getPriceAll[0]['MA_DV_CHINH'];

                $body = [
                    // Cần tính toán các sản phẩm ở kho nào rồi tính phí vận chuyển. Hiện tại chưa làm
                    'SENDER_DISTRICT' => 14, // Cầu giấy
                    'SENDER_PROVINCE' => 1, // Hà Nội
                    'RECEIVER_DISTRICT' => $districtId,
                    'RECEIVER_PROVINCE' => $provinceId,
                    "ORDER_SERVICE_ADD" => "",
                    "ORDER_SERVICE" => $ORDER_SERVICE,
                    'PRODUCT_TYPE' => config('viettelPost.productType.commodity'),
                    'PRODUCT_WEIGHT' => $weight,
                    'PRODUCT_PRICE' => $price,
                    'MONEY_COLLECTION' => $methodPayment === 'COD' ? $price : 0,
                    'NATIONAL_TYPE' => config('viettelPost.nationalType.domesticType'),
                ];
                $getPrice = Http::withHeaders(
                    [
                        'Content-Type' => ' application/json',
                        'Token' => 'eyJhbGciOiJFUzI1NiJ9.eyJzdWIiOiIwODEzNjM1ODY4IiwiVXNlcklkIjoxMjU3NzU2NSwiRnJvbVNvdXJjZSI6NSwiVG9rZW4iOiIzWFk1OFFFSFA1N0pLUzBIVSIsImV4cCI6MTY3ODYwODgwNCwiUGFydG5lciI6MTI1Nzc1NjV9.C3rYwtrUN5uCiIA4DF7xLUUgTwOA0Lp4DM1JtKJxv52uhF6lgHx7OmoPDVlkTb8dxJei-YCq2a0Rq7StlRMBVA' //$login['data']['token']
                    ]
                )->post('https://partner.viettelpost.vn/v2/order/getPrice', $body);
                if ($getPrice['status'] !== 200) {
                    return response()->json([
                        "status_code" => 403,
                        "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                    ]);
                }
                $transportFee = $getPrice['data']['MONEY_TOTAL_OLD'];
                $kpiHt = $getPrice['data']['KPI_HT'];

                $item['transport_fee'] = $transportFee;
                $totalShipping += $transportFee;
                $item['delivery_time'] = $kpiHt;
                $total += $price + $totalShipping;
            }
            $order->shipping = $totalShipping;
            $order->total = $total;
            $order->warehouse_id = 1;
            $order->method_payment = $methodPayment;
            $order->pay = config('constants.payStatus.pay');
            $order->save();
        }
        $order->total_vat = $totalVat;
        return response()->json([
            'status_code' => 200,
            'order' => $order,
            'method_payment' => $methodPayment
        ]);
    }

    public function getOrdersByUser(Request $request, $id)
    {
        try {
            $status = $request->status ?? 0;
            $limit = $request->limit ?? 5;
            $orders = Order::with(['orderItem'])->select('no', 'id', 'total', 'export_status');

            if ($status !== 0) {
                $orders = $orders->where('export_status', $status);
            }

            $orders = $orders->paginate($limit);

            foreach ($orders as $order) {
                $order->orderItem = $order->orderItem()
                    ->select('products.images',
                        'products.name as product_name',
                        'quantity',
                        'discount_vshop',
                        'discount_ncc',
                        'discount_vstore',
                        'products.price',
                    )
                    ->join('products', 'order_item.product_id', '=', 'order_item.product_id')
                    ->get();

                foreach ($order->orderItem as $order1) {
                    $order1->image = asset(json_decode($order1->images)[0]);
                    unset($order1->images);
                }

                $order->total_product = count($order->orderItem);
            }
            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getDetailOrderByUser($order_id)
    {
        try {
            $order = Order::with(['orderItem'])
                ->select('no', 'id', 'created_at', 'shipping', 'total', 'full_name', 'phone', 'address', 'export_status')
                ->where('id', $order_id)->first();
            $order->info_customer = [
                'fullname' => $order->fullname,
                'phone' => $order->phone,
                'address' => $order->address
            ];
            unset($order->fullname);
            unset($order->phone);
            unset($order->address);
            $order->detail = $order->orderItem()
                ->select("product.name",
                    'price',
                    'discount_vshop',
                    'discount_ncc',
                    'discount_vstore',
                    'quantity',
                    'vat'
                )
                ->join('products', 'order_item.product_id', '=', 'order_item.product_id')
                ->first();
            return response()->json([
                'success' => true,
                'data' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
