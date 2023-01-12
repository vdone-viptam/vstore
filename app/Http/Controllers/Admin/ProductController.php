<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::where('vstore_confirm_date','!=',null)
//        ->where('admin_confirm_date',null);
              ->orderBy('admin_confirm_date','asc')
        ->paginate(10)
        ;
        return view('screens.admin.product.index');
        return $products;
}
}
