<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //

    public function index(Request $request )
    {
        $limit = $request->limit ??10;
        $products =  Category::join('products','categories.id','=','products.category_id')
                            ->join('product_warehouses','products.id','=','product_warehouses.product_id')
                            ->join('warehouses','product_warehouses.ware_id','=','warehouses.id')
                            ->groupBy('products.id')
                            ->select('products.id','products.publish_id','products.images','products.name as name','categories.name as cate_name','products.price','product_warehouses.ware_id','product_warehouses.product_id','product_warehouses.amount')
                            ->where('warehouses.user_id',Auth::id())
                            ->where('product_warehouses.status','!=',3)
                            ->paginate($limit)
        ;
//        return Auth::user();
        foreach ($products as $pro){
            $pro->amount_product = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND ware_id =" . $pro->ware_id . " AND product_id = " . $pro->product_id . ") as amount FROM product_warehouses where status = 1 AND ware_id =" . $pro->ware_id . " AND product_id = " . $pro->product_id . ""))[0]->amount ?? 0;
//            return $pro;
        }
//        return $products;
        return view('screens.storage.product.index',compact('products'));
    }

    public function request()
    {
        return view('screens.storage.product.request', []);

    }
    public function requestOut(){
        return view('screens.storage.product.requestOut', []);
    }
}
