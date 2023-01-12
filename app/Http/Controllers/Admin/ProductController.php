<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::where('vstore_confirm_date', '!=', null)
            ->where('status', 2)
            ->orderBy('admin_confirm_date', 'asc')
        ->paginate(10);

        if ($request->option && $request->option == 0) {
            $products = Product::where('name', 'like', '%' . 'platinum update' . '%')
//                ->orWhere('publish_id', 'like', '%' . $request->search . '%')
//                ->orWhere('brand', 'like', '%' . $request->search . '%')
                ->where('status', 2)
                ->orderBy('admin_confirm_date', 'asc')
                ->where('vstore_confirm_date', '!=', null)
                ->paginate(10);
        }
//        elseif ($request->option == 1){
//            $products= $products->where('name','like','%'.'$request->search'.'%')
//
//            ;
//        }
//        elseif ($request->option == 2){
//            $products= $products->where('name','like','%'.'$request->search'.'%')
//
//            ;
//        }

        return view('screens.admin.product.index', compact('products'));

    }

    public function detail(Request $request)
    {
        $product = Product::select('id', 'name', 'user_id', 'category_id', 'created_at', 'status', 'discount', 'price', 'admin_confirm_date')->where('id', $request->id)->first();
        $product->amount_product = (int)DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2  AND product_id = $request->id) as amount FROM product_warehouses where status = 1 AND product_id = $request->id"))[0]->amount;
        return view('screens.admin.product.detail', compact('product'));
    }

    public function confirm($id, Request $request)
    {
        $product = Product::find($id);
        $product->status = $request->status;
        $product->admin_confirm_date = Carbon::now();
        if (isset($request->note)) {
            $product->note = $request->note;
        }
        $product->save();
        $product->publish_id = $product->id . rand(100000, 999999);
        $product->save();
        return redirect()->back()->with('success', 'Thay đổi trạng thái yêu cầu thành công');
    }
}
