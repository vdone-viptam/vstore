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

class OrderController extends Controller
{
    public function index(Request $request, $userId, $cartId): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($request->all(), [
//            'address' => 'required',
//            'fullname' => 'required',
//            'phone' => 'required',
//            'related_address',
//            'district_id',
//            'province_id',
//            'wards_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $fullname = $request->fullname;
        $email = $request->email;
        $phone = $request->phone;

        $order = new Order();
        $order->status = config('constants.orderStatus.wait_for_confirmation');
        $order->shipping = 0; // Tổng phí ship
        $order->shipping_details = json_encode([]); // Chi tiết phí ship
        $order->total = 0; // Tổng tiền
        $order->total_discount = 0; // giá sau khi đã sử dụng discount
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
                'products.price',
                'products.weight',
                'cart_items_v2.quantity',
                'cart_items_v2.discount',
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
            $orderItem->discount = $item->discount;
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

        $districtId = $request->district_id;
        $provinceId = $request->province_id;
        $wardsId = $request->wards_id;
        $address = $request->address;

        if($fullname && $email && $phone) {
            $order->fullname = '';
            $order->email = '';
            $order->phone = '';
        }

        if($districtId && $provinceId && $wardsId && $address) {
            $order->address = '';
            $totalShipping = 0;
            $total = 0;
            $shippingDetails = [];
            foreach ($result as $index => $item) {
                $price = 0;
                $weight = 0;
                foreach ($item['products'] as $pro) {
                    $weight += $pro->weight;
                    $price += $pro->price;
                    $total += $pro->price - $pro->price*($pro->discount/100);
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
                    "transport_fee" => $transportFee
                ];
            }
            $order->shipping_details = json_encode($shippingDetails);
            $order->shipping = $totalShipping;
            $order->total = $total;
            $order->save();
        } else {
            $result['pay'] = false; // Được phép thanh toán hay chưa
        }

        return response()->json([
            'status_code' => 200,
            'cart_id' => $cart->id,
            'order' => $order,
            'carts' => $result
        ]);
    }
}
