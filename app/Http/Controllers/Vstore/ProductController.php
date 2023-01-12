<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function request()
    {
        $this->v['products'] = Product::select('id', 'name', 'category_id', 'created_at', 'user_id', 'status', 'user_id')->orderBy('id', 'desc')->paginate(10);
        return view('screens.vstore.product.request', $this->v);
    }

    public function detail(Request $request)
    {
        $this->v['product'] = Product::select('id', 'name', 'user_id', 'category_id', 'created_at', 'status', 'discount', 'price')->where('id', $request->id)->first();
        $this->v['product']->amount_product = (int)DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2  AND product_id = $request->id) as amount FROM product_warehouses where status = 1 AND product_id = $request->id"))[0]->amount;
        return view('screens.vstore.product.detail', $this->v);
    }

    public function confirm($id, Request $request)
    {
        $product = Product::find($id);
        $product->status = $request->status;
        $product->vstore_confirm_date = Carbon::now();
        if (isset($request->note)) {
            $product->note = $request->note;
        }
        $product->save();

        return redirect()->back()->with('success', 'Thay đổi trạng thái yêu cầu thành công');
    }

}
