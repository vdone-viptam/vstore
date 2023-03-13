<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItemV2;
use App\Models\CartV2;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{


    public function index(Request $request, $userId, $cartId): \Illuminate\Http\JsonResponse
    {
        $fullname = $request->fullname;
        $phone = $request->phone;

        $order = new Order();
        $order->user_id = $userId;
        $order->status = config('constants.orderStatus.wait_for_confirmation');
        $latestOrder = Order::orderBy('created_at','DESC')->first();
        $order->no = Str::random(5).str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);
        $order->shipping = 0; // Tổng phí ship
        $order->shipping_details = json_encode([]); // Chi tiết phí ship
        $order->total = 0; // Tổng tiền
        $order->save();

        $cart = CartV2::where('cart_v2.user_id', $userId)->where('status', config('constants.statusCart.cart'))->first();
        if(!$cart) {
            return response()->json([
                'status_code' => 404,
                'message' => "Giỏ hàng trống"
            ], 404);
        }

        $cartItems = CartItemV2::where('cart_id', $cart->id)
            ->join('products', 'products.id', '=', 'cart_items_v2.product_id')
            ->join('vshop', 'cart_items_v2.vshop_id', '=', 'vshop.id')
            ->select(
                'products.id',
                'products.images',
                'products.name',
                'products.vat',
                'products.price',
                'products.weight',
                'cart_items_v2.quantity',
//                'cart_items_v2.discount',
                'cart_items_v2.vshop_id',
                'vshop.name as name_vshop',
                'vshop.id as vshop_id_'
            )
            ->get();
        $result = [];

        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->vshop_id = $item->vshop_id_;
            $orderItem->sku = '';
//            $orderItem->discount = $item->discount;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->quantity;
            $orderItem->save();

            $result[$item['vshop_id']]['vshop'] = [
                "name" => $item->name_vshop,
                "id" => $item->vshop_id_,
            ];
            $item->images = json_decode($item->images);
            $result[$item['vshop_id']]['products'][] = $item;
        }
        $result = array_values($result);
        if($result === []) {
            return response()->json([
                'status_code' => 404,
                'message' => "Giỏ hàng trống"
            ], 404);
        }

        foreach ($result as $item) {
            $arrProductId = array_column($item['products'], 'id');
            $discounts = getDiscountProducts($arrProductId, $item['vshop']['id']);
            foreach ($item['products'] as $product) {
                foreach ($discounts as $key => $discount) {
                    if ($product['id'] == $key) {
                        $product->discount = $discount;
                    }
                }
            }
        }
        $districtId = $request->district_id;
        $provinceId = $request->province_id;
        $wardsId = $request->wards_id;
        $address = $request->address;
        if($fullname && $phone) {
            $order->fullname = $fullname;
            $order->phone = $phone;
        }
        if($districtId && $provinceId && $wardsId && $address) {
            $order->district_id = $districtId;
            $order->province_id = $provinceId;
            $order->address = $address;
            $totalShipping = 0;
            $total = 0;
            $shippingDetails = [];
            foreach ($result as $index => $item) {
                $price = 0;
                $weight = 0;
                foreach ($item['products'] as $pro) {
                    $weight += $pro->weight;
                    $priceDiscount = $pro->price * $pro->quantity;
                    $totalDiscountSuppliersAndVStore = 0;
                    if(isset($pro['discount']['discountsFromSuppliers'])) {
                        $totalDiscountSuppliersAndVStore += $pro['discount']['discountsFromSuppliers'];
                    }
                    if(isset($pro['discount']['id'])) {
                        $totalDiscountSuppliersAndVStore += $pro['discount']['discountsFromVShop'];
                    }
                    if($totalDiscountSuppliersAndVStore > 0) {
                        $priceDiscount = $priceDiscount - $priceDiscount * ($totalDiscountSuppliersAndVStore/100);
                    }
                    if(isset($pro['discount']['discountsFromVStore'])) {
                        $priceDiscount = $priceDiscount - $priceDiscount * ($pro['discount']['discountsFromVStore']/100);
                    }
                    $price += $priceDiscount;
                    //Tính VAT
                    $price = $price + $price*($pro['vat']/100);
                }
                $body = [
                    'SENDER_DISTRICT' => 14, // Cầu giấy
                    'SENDER_PROVINCE' => 1, // Hà Nội
                    'RECEIVER_DISTRICT' => $districtId,
                    'RECEIVER_PROVINCE' => $provinceId,

                    "ORDER_SERVICE_ADD" => "",
                    "ORDER_SERVICE" => "VCN",

                    'PRODUCT_TYPE' => config('viettelPost.productType.commodity'),
                    'PRODUCT_WEIGHT' => $weight,
                    'PRODUCT_PRICE' => $price,
                    'MONEY_COLLECTION'=>0,
                    'NATIONAL_TYPE'=>config('viettelPost.nationalType.domesticType'),
                ];
                $getPrice = Http::withHeaders(
                    [
                        'Content-Type'=>' application/json',
                        'Token'=>'eyJhbGciOiJFUzI1NiJ9.eyJzdWIiOiIwODEzNjM1ODY4IiwiVXNlcklkIjoxMjU3NzU2NSwiRnJvbVNvdXJjZSI6NSwiVG9rZW4iOiIzWFk1OFFFSFA1N0pLUzBIVSIsImV4cCI6MTY3ODYwODgwNCwiUGFydG5lciI6MTI1Nzc1NjV9.C3rYwtrUN5uCiIA4DF7xLUUgTwOA0Lp4DM1JtKJxv52uhF6lgHx7OmoPDVlkTb8dxJei-YCq2a0Rq7StlRMBVA' //$login['data']['token']
                    ]
                )->post('https://partner.viettelpost.vn/v2/order/getPrice', $body);
                $transportFee = $getPrice['data']['MONEY_TOTAL_OLD'];
                $kpiHt = $getPrice['data']['KPI_HT'];
                $item['transport_fee'] = $transportFee;
                $totalShipping += $transportFee;
                $item['delivery_time'] = $kpiHt;
                $result[$index] = $item;
                $shippingDetails[] = [
                    "delivery_time" => $kpiHt,
                    "transport_fee" => $transportFee,
                    "vshop_id" => $item['vshop']['id']
                ];
                $total += $price + $transportFee;
            }
            $order->shipping_details = json_encode($shippingDetails);
            $order->shipping = $totalShipping;
            $order->total = $total;
            $order->pay = config('constants.payStatus.pay');
            $order->save();
        } else {
            $result['pay'] = config('constants.payStatus.unpaid'); // Được phép thanh toán hay chưa
        }
        $order->shipping_details = json_decode($order->shipping_details);
        return response()->json([
            'status_code' => 200,
            'cart_id' => $cart->id,
            'order' => $order,
            'carts' => $result
        ]);
    }
}
