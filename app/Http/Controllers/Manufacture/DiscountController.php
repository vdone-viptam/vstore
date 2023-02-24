<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function discount()
    {
        $this->v['discounts'] = DB::table('discounts')->select('discounts.id', 'discounts.discount', 'products.name', 'discounts.created_at', 'start_date', 'end_date')
            ->join('products', 'discounts.product_id', '=', 'products.id')
            ->where('discounts.user_id', Auth::id())
            ->paginate(10);
        return view('screens.manufacture.discount.discount', $this->v);

    }

    public function createDis()
    {
        $product = DB::table('products')->select('name', 'id')->where('status', 2)->where('user_id', Auth::id())->get();
        $data = [];
        foreach ($product as $pr) {
            if (DB::table('discounts')->where('product_id', $pr->id)->count() == 0) {
                $data[] = $pr;
            }
        }
        $this->v['products'] = $data;
        return view('screens.manufacture.discount.createDis', $this->v);

    }

    public function chooseProduct(Request $request)
    {
        $pro = DB::table('products')->select('price', 'discount', 'discount_vShop')->where('id', $request->product_id)->first();
        if ($pro) {
            $pro->price = number_format($pro->price, 0, '.', '.') ?? 0;
            return $pro;
        } else {
            return null;
        }

    }

    public function storeDis(Request $request)
    {
        DB::table('discounts')->insert([
            'product_id' => $request->product_id,
            'discount' => $request->discount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => 1,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('screens.manufacture.product.discount')->with('success', 'Thêm mới giảm giá thành công');
    }

    public function editDis(Request $request)
    {

        $product = DB::table('products')->select('name', 'id')->where('status', 2)->where('user_id', Auth::id())->get();
        $data = [];
        foreach ($product as $pr) {
            if (DB::table('discounts')->where('product_id', $pr->id)->count() == 0) {
                $data[] = $pr;
            }
        }

        $this->v['products'] = $data;
        $this->v['discount'] = DB::table('discounts')->select('id', 'product_id', 'start_date', 'end_date', 'start_date', 'discount')->where('id', $request->id)->first();
        $this->v['product1'] = Product::select('discount', 'discount_vShop', 'price', 'name', 'id')->where('id', $this->v['discount']->product_id)->first();
        return view('screens.manufacture.discount.editDis', $this->v);

    }

    public function updateDis($id, Request $request)
    {
        DB::table('discounts')
            ->where('id', $id)
            ->update([
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

        return redirect()->route('screens.manufacture.product.discount')->with('success', 'Cập nhật giảm giá thành công');
    }
}
