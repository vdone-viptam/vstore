<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(10);
        return response()->json([
            'status_code' => 200,
            'data' => $products
        ]);
    }
    public function productByCategory($id){
        $products = Product::where('category_id',$id)->paginate(10);
            return response()->json([
                'status_code' => 200,
                'data' => $products,

            ]);


    }
}
