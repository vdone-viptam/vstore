<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * @group Product
 *
 * Danh sách api liên quan tới sản phẩm
 */
class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm
     *
     * API này sẽ trả về thông tin hiển thị sản phẩm
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @urlParam publish_id mã sản phẩm
     * @return JsonResponse
     */
    public function index( Request $request){

        $limit = $request->limit ?? 10;
        $publish_id =$request->publish_id ??  '';
            $products = Product::where('vstore_id','!=',null)->where('status',2)->where('publish_id','!=',null)->where('publish_id','like','%'.$publish_id.'%')->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $products
        ]);

    }
    public function productByCategory( Request $request,$id){
        $limit = $request->limit ?? 10;
        $products = Product::where('category_id',$id)->paginate($limit);
            return response()->json([
                'status_code' => 200,
                'data' => $products,
            ]);


    }
    /**
     * Danh sách sản phẩm vstore
     *
     * API này sẽ trả về sách sản phẩm vstore
     *
     * @param Request $request
     * @param $id id của vstore
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @urlParam publish_id mã sản phẩm
     * @return JsonResponse
     */
    public function productByVstore(Request $request, $id){
        $limit = $request->limit ?? 10;
        $products = Product::where('vstore_id',$id)->where('status',2)->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $products,

        ]);
    }
    /**
     * Danh sách sản phẩm nhà cung cấp
     *
     * API này sẽ trả về thông tin hiển thị sản phẩm nhà cung cấp
     *
     * @param Request $request
     * @param $id id nhà cung cấp
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @urlParam publish_id mã sản phẩm
     * @return JsonResponse
     */
    public function productByNcc( Request $request,$id){
        $limit = $request->limit ?? 10;
        $products = Product::where('user_id',$id)->where('status',2)->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $products,

        ]);
    }
    /**
     * Chi tiết sản phẩm
     *
     * API dùng để lấy chi tiết 1 sản phẩm
     *
     * @param Request $request
     * @param  $id mã sản phẩm
     *
     * @return JsonResponse
     */
    public function productById(Request $request, $id){

        $product = Product::where('publish_id',$id)->select('publish_id','id','name','images','price','discount_vShop','video')->first();

        if (!$product){
            return response()->json([
                'status_code' => 400,
                'data' => 'No product found or unapproved product',

            ],400);
        }
        $products_available= DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND product_id =".$product->id." ) as amount FROM product_warehouses where status = 1 AND product_id = " . $product->id . ""))[0]->amount ?? 0;
        $product->products_available=$products_available;
        return response()->json([
            'status_code' => 200,
            'data' => $product,

        ]);
    }
    /**
     * Vshop thêm sản phẩm
     *
     * API dùng để Vshop thêm sản phẩm
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @param  $id mã sản phẩm
     * @bodyParam  id_pdone id của pdone
     * @return JsonResponse
     */
    public function vshopPickup(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'id_pdone' => 'required',
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

        $checkVshop = Vshop::where('id_pdone',$request->id_pdone)->where('id_product',$product->id)->first();
            if ($checkVshop){
                return response()->json([
                    'status_code' => 400,
                    'data' => 'Products that have been added cannot be added again',
                ],400);
            }
        try {
            $vshop = new Vshop();
            $vshop->id_pdone= $request->id_pdone;
            $vshop->id_product= $product->id;
            $vshop->id_category= $product->category_id;
            $vshop->id_ncc= $product->user_id;
            $vshop->id_npp= $product->vstore_id;
            $vshop->save();
            return response()->json([
                'status_code' => 200,
                'message' => 'product saved successfully',
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }
    /**
     * sản phẩm Vshop
     *
     * API lấy danh sách sản phẩm theo vshop
     *
     * @param Request $request
     * @param  $id mã vshop
     *
     * @return JsonResponse
     */
    public function productByVshop(Request $request,$id){
        $limit = $request->limit ?? 10;
        $vshop = Vshop::where('id_pdone',$id)->get();
        $product_id=[];
        foreach ($vshop as $value){
            $product_id[]= $value->id_product;

        }
        $products = Product::whereIn('id',$product_id)->select('id','name','images','price','discount_vShop')->paginate($limit);
        foreach ($products as $value){
            $products_available= DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND product_id =".$value->id." ) as amount FROM product_warehouses where status = 1 AND product_id = " . $value->id . ""))[0]->amount ?? 0;
            $value['products_available']=$products_available;
            $value['discount']=$value->price;
        }
        return response()->json([
            'status_code' => 200,
            'message' => 'product saved successfully',
            'data'=>$products
        ]);
    }
    public function mail(){
        $email = 'phungtheanh2001@gmail.com';
        Mail::send('email.email', ['ID' => '123123123', 'password' => '12121212'], function ($message) use ($email) {
            $message->to( $email);
            $message->subject('Đơn đăng ký của bạn đã được duyệt');

        });
    }

}
