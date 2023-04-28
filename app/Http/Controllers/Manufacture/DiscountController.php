<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\BuyMoreDiscount;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function discount(Request $request)
    {
        $this->v['field'] = $request->field ?? 'discounts.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['discounts'] = DB::table('discounts')->select('discounts.id', 'discounts.discount',
            'products.name', 'discounts.created_at', 'start_date', 'end_date', 'discounts.status')
            ->join('products', 'discounts.product_id', '=', 'products.id')
            ->orderBy($this->v['field'], $this->v['type'])
            ->where('discounts.user_id', Auth::id());
        if (strlen($this->v['key_search'])) {
            $this->v['discounts'] = $this->v['discounts']->where(function ($query) {
                $query->where('products.name', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['discounts'] = $this->v['discounts']->paginate($this->v['limit']);
        $this->onDiscount();
        return view('screens.manufacture.discount.discount', $this->v);

    }

    public function createDis()
    {
        $product = DB::table('products')->select('name', 'id')->where('status', 2)->where('user_id', Auth::id())->get();
        $data = [];
        foreach ($product as $pr) {
            if (DB::table('discounts')->where('user_id', Auth::id())->where('product_id', $pr->id)->count() == 0) {
                $data[] = $pr;
            }
        }
        $this->v['products'] = $data;
        return response()->json([
            'view' => view('screens.manufacture.discount.createDis', $this->v)->render()
        ]);

    }

    public function chooseProduct(Request $request)
    {
        $pro = DB::table('products')->select('id', 'price', 'discount', 'discount_vShop')->where('status', 2)->where('id', $request->product_id)->first();
        if ($pro) {
            $buy_more = BuyMoreDiscount::where('end', 0)->where('product_id', $pro->id)->first();
//return $buy_more;
            $pro->price = number_format($pro->price, 0, '.', '.') ?? 0;
            $pro->buy_more = $buy_more->discount ?? 0;
            return response()->json([
                'pro' => $pro,
            ]);
        } else {
            return null;
        }

    }

    public function storeDis(Request $request)
    {

        try {
            DB::table('discounts')->insert([
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => 1,
                'user_id' => Auth::id(),
                'created_at' => Carbon::now(),
                'status' => 0
            ]);

            return redirect()->route('screens.manufacture.product.discount')->with('success', 'Thêm mới giảm giá thành công');
        } catch (\Exception $exception) {
            return redirect()->route('screens.manufacture.product.discount')->with('error', 'Thêm mới giảm giá thất bại');

        }
    }

    public function editDis(Request $request)
    {
        $this->v['discount'] = DB::table('discounts')->select('id', 'product_id', 'start_date', 'end_date', 'start_date', 'discount')->where('id', $request->id)->first();
        $this->v['product1'] = Product::select('discount', 'discount_vShop', 'price', 'name', 'id')->where('id', $this->v['discount']->product_id)->first();
        $buy_more = BuyMoreDiscount::where('end', 0)->where('product_id', $this->v['product1']->id)->first();

        $this->v['product1']->buy_more = $buy_more->discount ?? 0;
        return response()->json([
            'view' => view('screens.manufacture.discount.editDis', $this->v)->render(),
            'id' => $this->v['discount']->id
        ]);

    }

    public function updateDis(Request $request, $id = null)
    {

        try {
            DB::table('discounts')
                ->where('id', $id)
                ->update([
                    'product_id' => $request->product_id,
                    'discount' => $request->discount,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);

            return redirect()->route('screens.manufacture.product.discount')->with('success', 'Cập nhật giảm giá thành công');
        } catch (\Exception $exception) {
            return redirect()->route('screens.manufacture.product.discount')->with('error', 'Cập nhật giảm giá thất bại');

        }
    }

    public function onDiscount()
    {
        Discount::where('start_date', '<=', \Carbon\Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->where('status', 0)
            ->where('discounts.user_id', Auth::id())
            ->update(['status' => 1]);

        Discount::where('end_date', '<', Carbon::now())
            ->where('status', 1)
            ->where('discounts.user_id', Auth::id())
            ->update(['status' => 2]);

    }
}
