<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    public function addProduct(){
        $products = Product::where('user_id',Auth::id())
            ->where('admin_confirm_date','!=',null)
            ->where('vstore_confirm_date','!=',null)
            ->get();
        $warehouses = Warehouses::where('user_id',Auth::id())->get();

        return view('screens.manufacture.warehouse.add-product',compact('products','warehouses'));
    }
    public function postAddProduct(Request $request){
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
        $model->fill($request->only('product_id','ware_id','amount'));
        $model->status = 1;
        $model->save();

        return redirect()->route('screens.manufacture.warehouse.addProduct')->with('message','Thêm Thành Công');
    }
    public function amount(){
        $amount =DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2  AND product_id = 1) as amount FROM product_warehouses where status = 1 AND product_id = 1"))[0]->amount;
        return $amount;
    }
}
