<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function addProduct()
    {
        $products = Product::where('user_id', Auth::id())
            ->where('admin_confirm_date', '!=', null)
            ->where('vstore_confirm_date', '!=', null)
            ->get();
        $warehouses = Warehouses::all();

        return view('screens.manufacture.warehouse.add-product', compact('products', 'warehouses'));
    }

    public function postAddProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'ware_id' => 'required',
            'amount' => 'required|min:0|not_in:0',


        ], [
            'product_id.required' => 'Trường này không được trống',
            'ware_id.required' => 'Trường này không được trống',
            'amount.required' => 'Trường này không được trống',
            'amount.min' => 'Không được nhỏ hơn hoặc băng 0',
            'amount.not_in' => 'Không được nhỏ hơn hoặc bằng 0',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
        $model = new ProductWarehouses();
        $model->fill($request->only('product_id', 'ware_id', 'amount'));
        $model->status = 0;
        $model->save();

        return redirect()->route('screens.manufacture.warehouse.addProduct')->with('message', 'Thêm Thành Công');
    }

    public function amount(Request $request)
    {
        $amount = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2  AND product_id = " . $request->product_id . " AND ware_id =" . $request->ware_id . ") as amount FROM product_warehouses where status = 1 AND product_id = " . $request->product_id . " AND ware_id =" . $request->ware_id . ""))[0]->amount;
        if ($amount) {
            return $amount;
        } else {
            return 0;
        }
//        return $amount;h
    }

    public function index()
    {
//        return 1;
//        $products = DB::table('warehouses')->selectRaw('name,address,phone_number,SUM(amount) as amount_product,count(product_id) as amount')->join('product_warehouses', 'warehouses.id', '=', 'product_warehouses.ware_id')->groupByRaw('name,address,phone_number')->paginate(10);
//        foreach ($products as $product) {
//        }
//        dd($products);
        $ware = DB::table('warehouses')
            ->selectRaw('warehouses.name as ware_name,warehouses.id,phone_number,address')
            ->join('product_warehouses', 'warehouses.id', '=', 'product_warehouses.ware_id')
            ->join('products', 'product_warehouses.product_id', '=', 'products.id')
//            ->groupBy('product_warehouses.product_id')
            ->where('products.user_id', Auth::id())->groupByRaw('ware_name,warehouses.id,phone_number,address')->paginate(10);
        foreach ($ware as $wa) {
            $wa->amount = ProductWarehouses::where('ware_id', $wa->id)->groupBy('product_id')->count();
//            return  $wa;
            $nhap = ProductWarehouses::where('ware_id', $wa->id)->where('status', 1)->sum('amount');
            $xuat = ProductWarehouses::where('ware_id', $wa->id)->where('status', 2)->sum('amount');
//            return $nhap;
            $wa->amount_product = $nhap - $xuat;
            if ($wa->amount_product <= 0) {
                $wa->amount_product = 0;
            }
        }
//        return $ware;
        return view('screens.manufacture.warehouse.index', ['warehouses' => $ware]);
    }

    public function swap()
    {
//        $products = DB::table('warehouses')->selectRaw('warehouses.name as ware_name,products.name,product_warehouses.status,product_warehouses.created_at,amount')->join('product_warehouses', 'warehouses.id', '=', 'product_warehouses.ware_id')->join('products', 'product_warehouses.product_id', '=', 'products.id')->where('warehouses.user_id', Auth::id())->where('product_warehouses.status','!=',3)->orderBy('product_warehouses.id', 'desc')->paginate(10);
        $products = Product::join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
            ->select('warehouses.name as ware_name', 'products.name', 'product_warehouses.status', 'product_warehouses.amount', 'product_warehouses.created_at')
            ->paginate(10);
//        $products = Product::where('user_id',Auth::user()->id)->paginate(10);
        return view('screens.manufacture.warehouse.swap', ['products' => $products]);

    }

    public function detail(Request $request)
    {

        $kho = ProductWarehouses::select('products.name as name', 'product_id')->join('products', 'product_warehouses.product_id', '=', 'products.id')->groupBy(['product_id', 'products.name'])->where('ware_id', $request->id)->get();

        foreach ($kho as $wa) {
//            return DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND ware_id =" . $request->id . " AND product_id = " . $wa->product_id . ") as amount FROM product_warehouses where status = 1 AND ware_id =" . $request->id . " AND product_id = " . $wa->product_id . ""));
            $wa->amount_product = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND ware_id =" . $request->id . " AND product_id = " . $wa->product_id . ") as amount FROM product_warehouses where status = 1 AND ware_id =" . $request->id . " AND product_id = " . $wa->product_id . ""))[0]->amount;

        }

        return view('screens.manufacture.warehouse.detail', ['products1' => $kho]);

    }

    public function test()
    {
        return view('screens.vstore.product.test');
    }
}

