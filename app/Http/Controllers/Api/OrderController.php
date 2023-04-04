<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Point;
use App\Models\Product;
use App\Models\Vshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @group Oder
 *
 * Danh sách api liên quan tới order bill
 */
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
//            'fullname' => 'required',
//            'phone' => 'required',
//            'district_id' => 'required',
//            'province_id' => 'required',
//            'ward_id' => 'required',
//            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
        }

        $methodPayment = $request->method_payment;
        $productId = $request->product_id;
        $vshopId = $request->vshop_id;
        $quantity = $request->quantity;

        $product = Product::where('products.id', $request->product_id)
            ->join('vshop_products', 'vshop_products.product_id', '=', 'products.id')
            ->where('vshop_products.vshop_id', $vshopId)
            ->join('vshop', 'vshop.id', '=', 'vshop_products.vshop_id')
            ->select(
                'products.id',
                'products.images',
                'products.name',
                'products.vat',
                'products.type_pay',
                'products.price',
                'products.weight',
                'vshop.id as vshop_id',
                'vshop.nick_name as vshop_name',
                'vshop.avatar'
            )
            ->first();

        if (!$product) {
            return response()->json([
                'status_code' => 404
            ], 404);
        }
        $product->quantity = $quantity;
        $discount = getDiscountProduct($productId, $vshopId);
        $product->discount = $discount;

        $userId = $request->user_id;
        $fullname = $request->fullname;
        $phone = $request->phone;
        $districtId = $request->district_id;
        $provinceId = $request->province_id;
        $wardId = $request->wards_id;
        $address = $request->address;

        // NEW ORDER
        $order = new Order();
        $order->pay = 2;
        $order->user_id = $userId;
        $order->status = config('constants.orderStatus.wait_for_confirmation');
        $latestOrder = Order::orderBy('created_at', 'DESC')->first();
        $order->no = Str::random(5) . str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);
        $order->shipping = 0; // Tổng phí ship
        $order->total = $product->price * $quantity;
        $totalDiscount = 0;

        if (isset($discount['discountsFromSuppliers'])) {
            $totalDiscount += $discount['discountsFromSuppliers'];
        }
        if (isset($discount['discountsFromVStore'])) {
            $totalDiscount += $discount['discountsFromVStore'];
        }
        if (isset($discount['discountsFromVShop'])) {
            $totalDiscount += $discount['discountsFromVShop'];
        }

        $order->total = $order->total - $order->total * ($totalDiscount / 100);

        $vat = $order->total * ($product->vat / 100);
        $order->total = $order->total + $vat;
        $totalVat = $vat;
        if ($districtId && $provinceId && $wardId && $address) {
            $order->pay = 1;
            $order->district_id = $districtId;
            $order->ward_id = $wardId;
            $order->province_id = $provinceId;
            $order->address = $address;
            $warehouse = calculateShippingByProductID($product->id, $districtId, $provinceId, $wardId);
            if (!$warehouse) {
                return response()->json([
                    "status_code" => 400,
                    "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                ], 400);
            }

            $order->warehouse_id = $warehouse->id;

            $body = [
                // Cần tính toán các sản phẩm ở kho nào rồi tính phí vận chuyển. Hiện tại chưa làm
                'SENDER_DISTRICT' => $warehouse->district_id,
                'SENDER_PROVINCE' => $warehouse->city_id,
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
                    "status_code" => 400,
                    "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                ], 400);
            }
            $ORDER_SERVICE = $getPriceAll[0]['MA_DV_CHINH'];

            $body = [
                // Cần tính toán các sản phẩm ở kho nào rồi tính phí vận chuyển. Hiện tại chưa làm
                'SENDER_DISTRICT' => $warehouse->district_id,
                'SENDER_PROVINCE' => $warehouse->city_id,
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
                    "status_code" => 400,
                    "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                ], 400);
            }
            $transportFee = $getPrice['data']['MONEY_TOTAL_OLD'];

            $order->total += $transportFee;
            $order->shipping = $transportFee;
        }
        if ($fullname && $phone) {
            $order->fullname = $fullname;
            $order->phone = $phone;
        }

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
                'status_code' => 403,
                'error' => $validator->errors(),
            ], 403);
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
                $warehouse = calculateShippingByProductID($item['products']->id, $districtId, $provinceId);
                if (!$warehouse) {
                    return response()->json([
                        "status_code" => 400,
                        "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                    ], 400);
                }
                $body = [
                    // Cần tính toán các sản phẩm ở kho nào rồi tính phí vận chuyển. Hiện tại chưa làm
                    'SENDER_DISTRICT' => $warehouse->district_id, // Cầu giấy
                    'SENDER_PROVINCE' => $warehouse->city_id, // Hà Nội
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
                        "status_code" => 400,
                        "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                    ], 400);
                }
                $ORDER_SERVICE = $getPriceAll[0]['MA_DV_CHINH'];

                $body = [
                    // Cần tính toán các sản phẩm ở kho nào rồi tính phí vận chuyển. Hiện tại chưa làm
                    'SENDER_DISTRICT' => $warehouse->district_id, // Cầu giấy
                    'SENDER_PROVINCE' => $warehouse->city_id, // Hà Nội
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
                        "status_code" => 400,
                        "message" => "Không thể xác định được chi phi giao hàng, vui lòng chọn địa điểm khác"
                    ], 400);
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
    } // BỎ

    /**
     * danh sách đơn hàng theo user
     *
     * API này sẽ trả danh sách đơn hàng theo user
     *
     * @param id $id id user
     *
     * @urlParam status trạng thái đơn hàng 0 trạng thái chờ xác nhận,1 chờ giao hàng ,2 đang giao hàng , 4 đã giao hàng,5 đã hoàn thành
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrdersByUser(Request $request, $id)
    {
        try {
            $status = $request->status ?? 10;
            $limit = $request->limit ?? 5;
            $orders = Order::select('no', 'id', 'total', 'export_status', 'order_number');

            if ($status !== 10 ) {
                $orders = $orders->where('export_status', $status);
            }
            if ($status == 4) {
                $orders = $orders->where('export_status', 4)
                    ->whereDate('order.updated_at', '>', Carbon::now()->addDay(-7));
            }
            if ($status == 5) {
                $orders = $orders->where('export_status', 4)
                    ->whereDate('order.updated_at', '<=', Carbon::now()->addDay(-7));
            }
            $orders = $orders
                ->where('status', '!=', 2)
                ->orderBy('updated_at', 'desc')
                ->where('user_id', $id)->paginate($limit);

            foreach ($orders as $order) {
                $order->orderItem = $order->orderItem()
                    ->select(
                        'id as order_item_id',
                        'quantity',
                        'discount_vshop',
                        'discount_ncc',
                        'discount_vstore',
                        'product_id',
                        'price'
                    )
                    ->get();
                $product = null;
                foreach ($order->orderItem as $item) {
                    $product = $item->product()->select('name', 'price', 'images')->first();
                    $item->product_name = $product->name;
                    $item->price = $product->price;
                    $item->image = asset(json_decode($product->images)[0]);

                }

                $rating = Point::where('customer_id', $id)
                    ->where('order_item_id', $order->orderItem[0]->order_item_id)
                    ->join('products', 'points.product_id', '=', 'products.id')
                    ->select('points.id', 'products.name as product_name', 'point_evaluation', 'descriptions', 'points.images')
                    ->first();
                if ($rating) {
                    $order->rating = $rating;
                    $order->rating->image = $product->images ? asset(json_decode($product->images)[0]) : '';
                    $order->rating->content_image = $rating->images ? json_decode($rating->images) : '';
                    $order->rating->total = $product->price - ($product->price * ($order->orderItem[0]->discount_ncc +
                                $order->orderItem[0]->discount_vstore
                                + $order->orderItem[0]->discount_vshop) / 100);

                    $order->rating->quantity = $order->orderItem[0]->quantity;
                    $order->rating->product_price = $product->price;
                    unset($order->rating->images);
                } else {
                    $order->rating = null;

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

    /**
     * chi tiết đơn hàng theo id
     *
     * API này sẽ trả về chi tiết đơn hàng theo id
     *
     * @param order_id $order_id id đơn hàng
     * @return \Illuminate\Http\JsonResponse
     */

    public function getDetailOrderByUser($order_id)
    {
        try {
            $order = Order::select('no', 'id', 'created_at', 'shipping', 'total', 'fullname', 'phone', 'address', 'export_status', 'order_number')
                ->where('id', $order_id)
                ->where('status', '!=', 2)
                ->orderBy('updated_at', 'desc')
                ->first();
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }
            $order->info_receiver = [
                'fullname' => $order->fullname,
                'phone' => $order->phone,
                'address' => $order->address
            ];
            unset($order->fullname);
            unset($order->phone);
            unset($order->address);
            $order->detail = $order->orderItem()
                ->select('discount_ncc', 'discount_vstore', 'discount_vshop', 'product_id', 'quantity')->first();
            $product = $order->detail->product()->select('vat', 'price', 'name', 'price')->first();
            $order->detail->vat = $product->vat * ($product->price - ($product->price * ($order->detail->discount_ncc +
                            $order->detail->discount_vstore
                            + $order->detail->discount_vshop) / 100)) / 100 * $order->detail->quantity;
            $order->detail->price = $product->price;
            $order->detail->product_name = $product->name;
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

    /**
     * danh sách đơn hàng theo vshop
     *
     * API này sẽ trả danh sách đơn hàng theo vshop
     *
     * @param pdone_id $pdone_id pdone_id vshop
     *
     * @urlParam status trạng thái đơn hàng 0 trạng thái chờ xác nhận,1 chờ giao hàng ,2 đang giao hàng , 4 đã giao hàng,5 đã hoàn thành
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderOfUserByVshop(Request $request, $pdone_id)
    {
        try {
            $status = $request->status ?? 10;
            $limit = $request->limit ?? 5;
            $vshop_id = Vshop::select('id')->where('pdone_id', $pdone_id)->first();

            if (!$vshop_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy V-shop'
                ], 404);
            }
            $orders = OrderItem::select(
                'id as order_item_id',
                'product_id',
                'discount_vshop',
                'price',
                'discount_ncc',
                'discount_vstore',
                'quantity', 'order_id', 'product_id', 'export_status', 'order.updated_at');

            $orders = $orders->join('order', 'order_item.order_id', '=', 'order.id')
                ->where('status', '!=', 2)
                ->orderBy('order.updated_at', 'desc')
                ->where('vshop_id', $vshop_id->id);
            if ($status !== 10 && $status != 5 && $status != 4) {
                $orders = $orders->where('export_status', $status);
            }
            if ($status == 4) {
                $orders = $orders->where('export_status', 4)
                    ->whereDate('order.updated_at', '>', Carbon::now()->addDay(-7));
            }
            if ($status == 5) {
                $orders = $orders->where('export_status', 4)
                    ->whereDate('order.updated_at', '<=', Carbon::now()->addDay(-7));
            }
//            return $orders->updated_at;
//            return Carbon::now()->addDay(7);
            $orders = $orders->paginate($limit);
//            return $orders;
            foreach ($orders as $order) {
                $product = $order->product()->select('name', 'images')->first();
                $order->productInfo = null;
                $order->productInfo = [
                    'image' => asset(json_decode($product->images)[0]),
                    'name' => $product->name,
                    'quantity' => $order->quantity,
                    'price' => $order->price,
//                    'updated_at'=>$orders->updated_at
                ];
                unset($order->quantity);
                unset($order->price);
                $parentOrder = $order->order()->select('no', 'order_number')->first();
                $order->no = $parentOrder->no;
                $order->order_number = $parentOrder->order_number;
                $order->total_product = 1;
                $order->total = $order->productInfo['price'] * $order->productInfo['quantity'];
                unset($order->order);
                unset($order->product);
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

    /**
     * khách từ chối nhận/ huỷ đơn hàng
     *
     * API dùng khi khách hàng huỷ đơn hàng
     *
     * @param Request $request
     * @bodyParam order_id id order
     * @bodyParam order_id descriptions order
     * @return \Illuminate\Http\JsonResponse
     */
    public function refuseOrderByCustomer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'descriptions' => 'required|max:200',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'messageError' => $validator->errors(),
            ], 401);
        }
        try {
            $order = Order::find($request->order_id);
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy Order'
                ], 404);
            }

            $login = Http::post('https://partner.viettelpost.vn/v2/user/Login', [
                'USERNAME' => config('domain.TK_VAN_CHUYEN'),
                'PASSWORD' => config('domain.MK_VAN_CHUYEN'),
            ]);

            $refuseStatus = 5;
            $order->export_status = $refuseStatus;
            $order->note = $request->descriptions;
            $order->save();

            $huy_don = Http::withHeaders(
                [
                    'Content-Type' => ' application/json',
                    'Token' => $login['data']['token']
                ]
            )->post('https://partner.viettelpost.vn/v2/order/UpdateOrder', [
                'TYPE' => 4,
                'ORDER_NUMBER' => $order->order_number,
                'NOTE' => "Hủy đơn do khách hàng",
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
