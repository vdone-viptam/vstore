<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
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
     * Cart
     *
     * API dùng để xem sản phẩm trong giỏ hàng
     *
     * @param Request $request
     * @param  $pdone_id mã tài khoản người dùng pdone
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($pdone_id)
    {
        $cart = Cart::where('pdone_id', $pdone_id)->select('quantity', 'products.id as product_id', 'images', 'products.name', 'price', 'carts.id as cart_id', 'vshop_id','products.vat')->join('products', 'carts.product_id', '=', 'products.id')->get();

        $cart = $this->_group_by($cart, 'vshop_id');
        $data = [];

        foreach ($cart as $index => $val) {
            $arr['vshop_id'] = $index;
            foreach ($val as $a) {
                $a->image = asset(json_decode($a->images)[0]);
                unset($a->images);
                unset($a->vshop_id);
                $a->discount = DB::table('discounts')->selectRaw('SUM(discount) as sum')
                        ->where('product_id', $a->product_id)
                        ->first()->sum ?? 0;
            }
            $arr['products'] = $val;
            $data[] = $arr;
        }

        return response()->json([
            'status_code' => 200,
            'data' => $data
        ]);
    }

    public
    function _group_by($array, $key)
    {
        $return = array();
        foreach ($array as $val) {
            $return[$val->{$key}][] = $val;
        }
        return $return;
    }

    /**
     * Cart add
     *
     * API dùng để thêm sản phẩm vào giỏ hàng
     *
     * @param Request $request
     * @param  $id mã sản phẩm
     * @bodyParam  pdone_id required mã user của người dùng
     * @bodyParam  quantity required|numeric|min:1 Số sản phẩm mua
     * @bodyParam  vshop_id required mã v-shop
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function add(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pdone_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'vshop_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'errors' => $validator->errors()
            ]);
        }

        $product = DB::table('products')->where('id', $id)->where('status', 2)->first();
        if (!$product) {
            return response()->json([
                'status_code' => 401,
                'errors' => 'Sản phẩm chưa niêm yết'
            ]);
        }

        $cart = Cart::where('vshop_id', $request->vshop_id)
            ->where('product_id', $id)->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->vshop_id = $request->vshop_id;
            $cart->pdone_id = $request->pdone_id;
            $cart->quantity = $request->quantity;
            $cart->product_id = $id;
            $cart->save();
        } else {
            $cart->quantity += $request->quantity;
            $cart->save();
        }
        return response()->json([
            'status_code' => 201,
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
        ], 201);
    }

    /**
     * Cart remove
     *
     * API dùng để xóa sản phẩm khỏi giỏ hàng
     *
     * @param Request $request
     * @param  $cart_id Mã giỏ hàng
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function remove(Request $request, $cart_id)
    {
        Cart::destroy($cart_id);
        return response()->json([
            'status_code' => 201,
            'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công',
        ]);
    }

    /**
     * Cart quantity
     *
     * API dùng để tăng giảm 1 đơn vị sản phẩm trong giỏ hàng
     *
     * @param Request $request
     * @param  $cart_id Mã giỏ hàng
     * @param  $type 1 tăng sản phẩm | 2 giảm sản phẩm
     * @return \Illuminate\Http\JsonResponse
     */
    public
    function quantity(Request $request, $cart_id, $type)
    {
        $cart = Cart::where('id', $cart_id)->first();
        if (!$cart) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Giỏ hàng không tồn tại'
            ]);
        }
        if ($type == 1) {
            $cart->quantity += 1;

        } else {
            $cart->quantity -= 1;
        }

        $cart->save();
        if ($cart->quantity == 0) {
            Cart::destroy($cart_id);
            return response()->json([
                'status_code' => 201,
                'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công']);
        }
        return response()->json([
            'status_code' => 201,
            'message' => 'Thay đổi số lượng sản phẩm thành công'
        ]);
    }
}
