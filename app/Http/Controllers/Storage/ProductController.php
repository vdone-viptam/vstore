<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    private $v;

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $products = Category::join('products', 'categories.id', '=', 'products.category_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
            ->groupBy('products.id')
            ->select('products.id', 'products.publish_id', 'products.images', 'products.name as name', 'categories.name as cate_name', 'products.price', 'product_warehouses.ware_id', 'product_warehouses.product_id', 'product_warehouses.amount');

//        return Auth::user();

        if ($request->key_search) {

            $products = $products->where('products.publish_id', 'like', '%' . $request->key_search . '%')
                ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
        }
        $products = $products->where('warehouses.user_id', Auth::id())
            ->where('product_warehouses.status', '!=', 3)
            ->paginate($limit);
        foreach ($products as $pro) {
            $pro->amount_product = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND ware_id =" . $pro->ware_id . " AND product_id = " . $pro->product_id . ") as amount FROM product_warehouses where status = 1 AND ware_id =" . $pro->ware_id . " AND product_id = " . $pro->product_id . ""))[0]->amount ?? 0;
        }
        $this->v['products'] = $products;
        $this->v['params'] = $request->all();
        return view('screens.storage.product.index', $this->v);
    }

    public function request(Request $request)
    {
        $limit = $request->limit ?? 10;
        $this->v['requests'] = Product::select('category_id', 'products.user_id', 'product_warehouses.amount', 'product_warehouses.id', 'product_warehouses.created_at', 'product_warehouses.status', 'products.name')
            ->join("product_warehouses", 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id');
        if ($request->key_search) {
            $this->v['requests'] = $this->v['requests']->where('product_warehouses.id', 'like', '%' . str_replace('YC', '', $request->key_search) . '%')
                ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
        }
        $this->v['requests'] = $this->v['requests']->whereIn('product_warehouses.status',[0,1,5])->where('warehouses.user_id', Auth::id())->paginate($limit);

        $this->v['params'] = $request->all();
        return view('screens.storage.product.request', $this->v);

    }

    public function requestOut(Request $request)
    {
        $limit = $request->limit ?? 10;
       $product = Warehouses::join('product_warehouses','warehouses.id','=','product_warehouses.ware_id')
                    ->join('products','product_warehouses.product_id','=','products.id')
                    ->join('categories','products.category_id','=','categories.id')
            ->whereIn('product_warehouses.status',[2,3,4])
           ->where('warehouses.user_id',Auth::id())
           ->select('product_warehouses.id','product_warehouses.code','product_warehouses.status as status','products.name as product_name','categories.name as category_name','product_warehouses.created_at','product_warehouses.status');
           if ($request->key_search) {

           }

//           ->paginate($limit);

        $count = count($product);
        return view('screens.storage.product.requestOut', compact('product','count'));
    }

    public function updateRequest($status, Request $request)
    {
        DB::table('product_warehouses')->where('id', $request->id)->update(['status' => $status]);


        return redirect()->back()->with('success', 'Cập nhật đơn gửi hàng thành công');
    }
    public function updateRequestOut($status,Request $request){
        if ($status != 2 || $status !=4){
            return redirect()->back();
        }
        $product_warehouses =
        DB::table('product_warehouses')->where('id', $request->id)->update(['status' => $status]);


        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
    }
}
