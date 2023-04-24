<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItemV2;
use App\Models\CartV2;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Vshop;
use App\Models\VshopProduct;
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
     * API dùng để tăng giảm số lượng đơn vị sản phẩm trong giỏ hàng, 0 sẽ là xoá
     *
     * @param Request $request
     * @param $id "Mã giỏ hàng"
     * @param $product_id "Mã sản phẩm"
     * @param $quantity "Số lượng"
     * @param $vshop_id "Vshop id"
     * @param $user_id "id người dùng"
     * @return JsonResponse|int
     */
    public function updateQuantityInCart(Request $request, $id, $productId): JsonResponse|int
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:0',
            'vshop_id' => 'required',
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $quantity = $request->quantity;
        $vshopId = $request->vshop_id;
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
                "status_code" => 200,
                "delete" => true
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
            "delete" => false,
            "quantity" => $quantity
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
    public function index(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'is_pdone' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $user_id = $request->user_id;

        $cart = CartV2::where('cart_v2.user_id', $user_id)
            ->where('status', config('constants.statusCart.cart'))->first();
        if(!$cart) {
            return response()->json([
                'status_code' => 200,
                'message' => "Giỏ hàng trống",
                'carts'=>[]
            ], 200);
        }
        $cartItems = CartItemV2::where('cart_id', $cart->id)
            ->join('products', 'products.id', '=', 'cart_items_v2.product_id')
            ->join('vshop', 'cart_items_v2.vshop_id', '=', 'vshop.id')
            ->select(
                'products.id',
                'products.images',
                'products.name',
                'products.price',
                'products.vat',
                'cart_items_v2.quantity',
                'cart_items_v2.vshop_id',
                'vshop.nick_name as name_vshop',
                'vshop.id as vshop_id_',
                'vshop.avatar',
            )
            ->orderBy('cart_items_v2.id', 'desc')
            ->get();

        $result = [];

        foreach ($cartItems as $item) {

            $checkProductVshop = VshopProduct::where('product_id', $item->id)
                ->where('vshop_id', $item->vshop_id_)
                ->first();

            if(!$checkProductVshop) {
                continue;
            }

            $result[$item['vshop_id']]['vshop'] = [
                "name" => $item->name_vshop,
                "id" => $item->vshop_id_,
                "avatar" => $item->avatar
            ];
            $item->images = json_decode($item->images);
            $newImages = [];
            foreach ($item->images as $index => $image) {
                array_push($newImages, asset($image));
            }
            $item->images = $newImages;

            $item->discount = getDiscountProduct($item->id, $item->vshop_id_);
            $result[$item['vshop_id']]['products'][] = $item;
        }

        $result = array_values($result);
        if($result===[]) {
            return response()->json([
                'status_code' => 200,
                'message' => "Giỏ hàng trống",
                'carts'=>[]
            ], 200);
        }

        return response()->json([
            'status_code' => 200,
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
     * @bodyParam  user_id required mã user của người dùng
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
            'is_pdone' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $vshopId = $request->vshop_id;

        // Kiểm tra xêm vshop tồn tại không ?
        $vshop = Vshop::find($vshopId);
        if(!$vshop) {
            return response()->json([
                'status_code' => 404,
            ], 500);
        }

        $userId = $request->user_id;
        $quantity = $request->quantity;

        $product = DB::table('products')
            // chưa check status products
            ->join('vshop_products', 'products.id', '=', 'vshop_products.product_id')
            ->where('products.id', $id)
            ->where('products.status', 2) // active
            ->where('vshop_products.vshop_id', $vshopId)
            ->WhereIn('vshop_products.status',[1,2])
            ->select('products.id', 'products.sku_id', 'products.price', 'products.images', 'products.name')
            ->first();

        if (!$product) {
//            return response()->json([
//                'status_code' => 401,
//                'errors' => 'Sản phẩm chưa niêm yết'
//            ], 404);
            $product = Product::find($id);
        }

        $product->discount = getDiscountProduct($product->id, $vshop->id);
        $product->images = json_decode($product->images);

        $newImages = [];
        foreach ($product->images as $index => $image) {
            array_push($newImages, asset($image));
        }
        $product->images = $newImages;

        $cart = CartV2::where('status', config('constants.statusCart.cart'))
            ->where('user_id', $userId)
            ->first();

        if(!$cart) {
            $cart = new CartV2();
            $cart->status = config('constants.statusCart.cart');
            $cart->user_id = $userId;
            $cart->save();
        }

        $checkCartItem = CartItemV2::where('cart_id', $cart->id)
            ->where('product_id', $id)
            ->where('vshop_id', $vshopId)
            ->first();

        if($checkCartItem) {
            $checkCartItem->quantity += $quantity;
            $checkCartItem->sku = $product->sku_id;
            $checkCartItem->price = $product->price;
            $checkCartItem->save();
        } else {
            $checkCartItem = new CartItemV2();
            $checkCartItem->product_id = $id;
            $checkCartItem->cart_id = $cart->id;
            $checkCartItem->vshop_id = $vshop->id;
            $checkCartItem->sku = $product->sku_id;
            $checkCartItem->price = $product->price;
            $checkCartItem->quantity = $quantity;
            $checkCartItem->save();
        }

        return response()->json([
            'status_code' => 201,
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
            'cart_item' => $checkCartItem,
            'product' =>$product
        ], 201);
    }



}
