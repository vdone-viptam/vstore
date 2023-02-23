<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @urlParam name Tìm kiếm theo name
     * @return JsonResponse
     */
    public function index(Request $request){
        $limit = $request->limit ??10;
        if ($request->name){
            $categories = Category::where('name','like','%'.$request->name.'%')->paginate($limit);
        }else{
            $categories = Category::paginate($limit);
        }


        if ($categories){
            foreach ($categories as $value){
                $value->img = asset($value->img);
            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => $categories
        ]);
    }
    /**
     * chi tiết danh mục
     *
     * API này sẽ trả về chi tiết danh mục
     *
     * @param $id id danh mục
     * @return JsonResponse
     */
    public function detail($id){
        $category= Category::find($id);
        if ($category){
            return response()->json([
                'status_code' => 200,
                'data' => $category
            ]);
        }else{
            return response()->json([
                'status_code' => 400,
                'data' => 'not found Category',
            ],400);
        }
    }
}
