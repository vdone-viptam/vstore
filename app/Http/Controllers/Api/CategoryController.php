<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Categories
 *
 * Danh sách api liên quan tới danh mục
 */
class CategoryController extends Controller
{
    /**
     * Danh sách danh mục
     *
     * API này sẽ trả về danh sách danh mục
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang Mặc định 48
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ?? 48;
        try {
            $categories = Category::select('id', 'name', 'img')->paginate($limit);
            if ($categories) {
                foreach ($categories as $value) {
                    $value->img = asset($value->img);
                }
            }
            return response()->json([
                'status_code' => 200,
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Danh sách danh mục theo V-Store
     *
     * API này sẽ trả về danh sách danh mục
     *
     * @param Request $request
     * @urlParam limit Giới hạn bản ghi  Mặc định 100
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryByVstore($vstore_id, Request $request)
    {
        try {
            $limit = $request->limit ?? 100;
            $products = Product::select('category_id')->where('status', 2)->where('vstore_id', $vstore_id)->get();
            $data = [];

            foreach ($products as $pr) {
                $data[] = $pr->category_id;
            }
            $category = Category::select('id', 'name', 'img')->whereIn('id', $data)->where('status', 1)->limit($limit)->get();
            if ($category) {
                foreach ($category as $value) {
                    $value->img = asset($value->img);
                }
            }
            return response()->json(['status' => 200, 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()], 400);

        }


    }

    /**
     * Danh sách sản phẩm theo danh mục
     *
     * API này sẽ trả về danh sách sản phẩm
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang Mặc định 8
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductByCategory(Request $request, $category_id)
    {
        try {
            $limit =$request->limit??8;
            $product = Product::select('images', 'name', 'publish_id', 'price', 'id')
                ->where('category_id', $category_id)
                ->where('status', 2)
                ->paginate($limit);


            foreach ($product as $pr) {
                $pr->discount = DB::table('discounts')
                        ->selectRaw('SUM(discount) as sum')
                        ->where('product_id', $pr->id)
                        ->whereIn('type', [1, 2])
                        ->first()->sum ?? 0;

                $pr->image = asset(json_decode($pr->images)[0]);
                unset($pr->images);
            }

            return response()->json(['status' => 200, 'data' => $product]);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'error' => $e->getMessage()], 400);

        }

    }

    /**
     * chi tiết danh mục
     *
     * API này sẽ trả về chi tiết danh mục
     *
     * @param $id id danh mục
     * @return JsonResponse
     */
    public
    function detail($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'status_code' => 200,
                'data' => $category
            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'data' => 'not found Category',
            ], 400);
        }
    }

    /**
     * Danh sách vstore theo danh mục
     *
     * API này sẽ trả về danh sách vstore theo danh mucj
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang Mặc định 10
     * @return \Illuminate\Http\JsonResponse
     */

    public function getVstoreByCategory(Request $request, $id){
        $limit = $request->limit??10;
        $vstore= Category::join('products','categories.id','=','products.category_id')
                            ->join('users','products.vstore_id','users.id')
                            ->where('categories.id',$id)
                            ->select('users.id','users.name','users.avatar')
                            ->paginate($limit);

        if (count($vstore)>0){
            foreach ($vstore as $value){
                $value->avatar=asset('image/users/'.$value->avatar);
            }
            return response()->json([
                'status_code' => 200,
                'data' => $vstore
            ]);
        }else{
            return response()->json([
                'status_code' => 400,
                'message' => 'không tìm thấy'
            ]);
        }



    }

}
