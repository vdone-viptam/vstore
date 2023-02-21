<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products = Product::join('product_warehouses','products.id','=','product_warehouses.product_id')
                            ->join('warehouses','product_warehouses.ware_id','=','warehouses.id')
                            ->groupBy('products.id')
                            ->get()
        ;
        return $products;
        return view('screens.storage.product.index', []);
    }

    public function request()
    {
        return view('screens.storage.product.request', []);

    }
    public function requestOut(){
        return view('screens.storage.product.requestOut', []);
    }
}
