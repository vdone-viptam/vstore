<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItemV2;
use App\Models\CartV2;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Cart
 *
 * Danh sách api liên quan tới giỏ hàng
 */
class CartController extends Controller
{
    /**
     * Cart quantity
     *
     * API dùng để tăng giảm 1 đơn vị sản phẩm trong giỏ hàng
     *
     * @param Request $request
     * @param  $cart_id "Mã giỏ hàng"
     * @param  $type 1 tăng sản phẩm | 2 giảm sản phẩm
     * @return JsonResponse|int
     */
    public function updateQuantityInCart(Request $request, $id): JsonResponse|int
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:0',
            'user_id' => 'required',
            'vshop_id' => 'required',
        ]);
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $vshopId = $request->vshop_id;

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'errors' => $validator->errors()
            ]);
        }
        $userId = $request->user_id;
        $cart = CartV2::where('user_id', $userId)
            ->where('id', $id)
            ->first();
        if(!$cart) {
            return response()->json([
                "status_code" => 401,
            ], 401);
        }
        if($quantity <= 0) {
            CartItemV2::where('cart_id', $id)
                ->where('vshop_id', $vshopId)
                ->where('product_id', $productId)->delete();
            return response()->json([
                "status_code" => 200
            ]);
        }

        CartItemV2::where('cart_id', $id)
            ->where('product_id', $productId)
            ->where('vshop_id', $vshopId)
            ->update([
                "quantity" => $quantity
            ]);

        return response()->json([
            "status_code" => 200,
        ]);
    }

    /**
     * Cart
     *
     * API dùng để xem sản phẩm trong giỏ hàng
     *
     * @param $user_id "mã tài khoản người dùng pdone"
     * @return JsonResponse
     */
    public function index($user_id): JsonResponse
    {
        $cart = CartV2::where('cart_v2.user_id', $user_id)
            ->where('status', config('constants.statusCart.cart'))->first();
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
                'cart_items_v2.quantity',
                'cart_items_v2.discount',
                'cart_items_v2.vshop_id',
                'vshop.name as name_vshop',
                'vshop.id as vshop_id_'
            )
            ->get();
        $result = [];
        foreach ($cartItems as $item) {
            $result[$item['vshop_id']]['vshop'] = [
                "name" => $item->name_vshop,
                "id" => $item->vshop_id_,
            ];
            $item->images = json_decode($item->images);
            $result[$item['vshop_id']]['products'][] = $item;
        }
        $result = array_values($result);
        return response()->json([
            'cart_id' => $cart->id,
            'carts' => $result
        ]);
    }

    /**
     * Cart add
     *
     * API dùng để thêm sản phẩm vào giỏ hàng
     *
     * @param Request $request
     * @param $id "mã sản phẩm"
     * @bodyParam  pdone_id required mã user của người dùng
     * @bodyParam  quantity required|numeric|min:1 Số sản phẩm mua
     * @bodyParam  vshop_id required mã v-shop
     * @return JsonResponse
     */
    public function add(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'vshop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $vshopId = $request->vshop_id;
        $userId = $request->user_id;
        $quantity = $request->quantity;

        $product = DB::table('products')
            ->join('vshop_products', 'products.id', '=', 'vshop_products.product_id')
            ->where('products.id', $id)
            ->where('products.status', 2)
            ->where('vshop_products.id_pdone', $vshopId)
            ->first();

        if (!$product) {
            return response()->json([
                'status_code' => 401,
                'errors' => 'Sản phẩm chưa niêm yết'
            ], 404);
        }

        $cart = CartV2::where('status', config('constants.statusCart.cart'))
            ->where('user_id', $userId)
            ->first();

        if(!$cart) {
            $cart = new CartV2();
            $cart->status = config('constants.statusCart.cart');
            $cart->user_id = $userId;
            $cart->save();
        }

        $discountProduct = Discount::where('product_id', $id)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->sum('discount');

        $checkCartItem = CartItemV2::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if($checkCartItem) {
            $checkCartItem->quantity += $quantity;
            $checkCartItem->sku = $product->sku_id;
            $checkCartItem->discount = $discountProduct;
            $checkCartItem->price = $product->price;
            $checkCartItem->save();
        } else {
            $checkCartItem = new CartItemV2();
            $checkCartItem->product_id = $id;
            $checkCartItem->cart_id = $cart->id;
            $checkCartItem->vshop_id = $vshopId;
            $checkCartItem->sku = $product->sku_id;
            $checkCartItem->discount = $discountProduct;
            $checkCartItem->price = $product->price;
            $checkCartItem->quantity = $quantity;
            $checkCartItem->save();
        }

        return response()->json([
            'status_code' => 201,
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
            'cart_item' => $checkCartItem
        ], 201);
    }
}
