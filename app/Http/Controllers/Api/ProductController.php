<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index( Request $request){
        $limit = $request->limit ?? 10;
        $products = Product::paginate($limit);
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
    public function productByVstore(Request $request, $id){
        $limit = $request->limit ?? 10;
        $products = Product::where('vstore_id',$id)->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $products,

        ]);
    }
}
