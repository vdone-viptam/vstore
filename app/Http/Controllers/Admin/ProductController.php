<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v=[];
    }

    public function index(Request $request)
    {
             $limit = $request->limit ?? 10;
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        if (isset($request->condition) && $request->condition != 0) {
            $condition = $request->condition;
            if ($condition == 'sku_id') {
                $this->v['products'] = Product::select('id', 'name', 'category_id', 'created_at', 'user_id', 'status', 'user_id')->where($condition, 'like', '%' . $request->key_search . '%')->where('vstore_confirm_date', '!=', null)
                    ->where('status', 2)
                    ->orderBy('admin_confirm_date', 'asc')
                    ->paginate($limit);
            } else if ($condition == 'name') {
                $this->v['products'] = Product::select('id', 'name', 'category_id', 'created_at', 'user_id', 'status', 'user_id')->where($condition, 'like', '%' . $request->key_search . '%')->where('vstore_confirm_date', '!=', null)
                    ->where('status', 2)
                    ->orderBy('admin_confirm_date', 'asc')
                    ->paginate($limit);
            } else if ($condition == '3') {
                $this->v['products'] = Product::select('products.id', 'products.name', 'categories.name as cate_name', 'user_id', 'products.created_at', 'products.status', 'vstore_id')->join('categories', 'products.category_id', '=', 'categories.id')->where('categories.name', 'like', '%' . $request->key_search . '%')->where('vstore_confirm_date', '!=', null)
                    ->where('status', 2)
                    ->orderBy('admin_confirm_date', 'asc')
                    ->paginate($limit);
            } else {
                $this->v['products'] = Product::select('id', 'name', 'category_id', 'created_at', 'user_id', 'status', 'user_id')->where($condition, 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);

            }
        } else {
            $this->v['products'] = Product::where('vstore_confirm_date', '!=', null)
                ->where('status', 2)
                ->orderBy('admin_confirm_date', 'asc')
                ->paginate(10);

        }
        if (isset($request->page) && $request->page > $this->v['products']->lastPage()) {
            abort(404);
        }

        $this->v['params'] = $request->all();

        return view('screens.admin.product.index', $this->v);

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
