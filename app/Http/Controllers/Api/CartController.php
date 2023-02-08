<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
/**
 * @group Cart
 *
 * Danh sách api liên quan tới giỏ hàng
 */
class CartController extends Controller
{

    public function index($id){
        $cart = Cart::where('user_id',$id)->where('status',1)->get();
//        return $cart[0]['publish_id'];
        $i=0;
        foreach ($cart as $value){
            $product= Product::where('publish_id',$cart[$i]['publish_id'])->first();
            if ($product){
                $value['name']=$product->name;
                $value['price']=$product->price;
                $value['images']=$product->images;
            }else{
                $value['name']='';
                $value['price']='';
            }
$i++;
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'product saved successfully',
            'data'=>$cart
        ]);
    }
    /**
     * Cart add
     *
     * API dùng để thêm sản phẩm vào giỏ hàng
     *
     * @param Request $request
     * @param  id mã sản phẩm
     * @bodyParam  user_id mã user của người dùng
     * @urlParam quantity só lượng sản phẩm không có mặc định là 1
     * @return JsonResponse
     */
    public function add(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $product = Product::where('publish_id',$id)->first();

        if (!$product){
            return response()->json([
                'status_code' => 400,
                'data' => 'No product found or unapproved product',
            ],400);
        }
        $quantity = $request->quantity ?? 1;
        $checkCart = Cart::where('publish_id',$id)->where('user_id',$request->user_id)->where('status',1)->first();
        if ($checkCart){
           $checkCart->quantity+= 1;
           $checkCart->save();
            return response()->json([
                'status_code' => 200,
                'message' => 'Product added to cart successfully',
            ]);
        }
        $cart = new Cart();
        $cart->user_id= $request->user_id;
        $cart->publish_id=$id;
        $cart->status=1;
        $cart->quantity=1;
        $cart->save();
        return response()->json([
            'status_code' => 200,
            'message' => 'Product added to cart successfully',
        ]);
    }
    /**
     * Cart remove
     *
     * API dùng để xóa sản phẩm khỏi giỏ hàng
     *
     * @param Request $request
     * @param  id mã sản phẩm
     * @bodyParam  user_id mã user của người dùng
     * @return JsonResponse
     */
    public function remove(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $cart = Cart::where('publish_id',$id)->where('user_id',$request->user_id)->where('status',1)->first();
        if ($cart){
            $cart->status=0;
            $cart->save();
            return response()->json([
                'status_code' => 200,
                'message' => 'Product removed from cart successfully',
            ]);
        }
    }

    /**
     * Cart quantity
     *
     * API dùng để tăng giảm số lượng sản phẩm trong giỏ hàng
     *
     * @param Request $request
     * @param  id mã sản phẩm
     * @bodyParam  user_id mã user của người dùng
     * @bodyParam quantity số lượng sản phẩm
     * @return JsonResponse
     */
    public function quantity(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        $cart = Cart::where('publish_id',$id)->where('user_id',$request->user_id)->where('status',1)->first();
        if ($cart && $request->quantity >0){
            $cart->quantity = $request->quantity;
            $cart->save();
            return response()->json([
                'status_code' => 200,
                'message' => 'Update the number of products successfully',
            ]);
        }elseif ($cart && $request->quantity <=0){
            $cart->quantity = $request->quantity;
            $cart->status =0;
            $cart->save();
            return response()->json([
                'status_code' => 200,
                'message' => 'Product removed from cart successfully',
            ]);
        }
    }
}
