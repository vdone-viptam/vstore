<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function productByNcc( Request $request,$id){
        $limit = $request->limit ?? 10;
        $products = Product::where('user_id',$id)->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $products,

        ]);
    }
    public function mail(){
        $email = 'ttkhoa1999@gmail.com';
        Mail::send('email.test', ['ID' => '123123123', 'password' => '12121212'], function ($message) use ($email) {
            $message->to( $email);
            $message->subject('Đơn đăng ký của bạn đã được duyệt');
        });
    }
}
