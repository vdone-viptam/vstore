<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\RequestWarehouse;
use App\Models\User;
use App\Models\Warehouses;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Dotenv\Util\Str;
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

        if (!DB::table('product_warehouses')->where('product_id', $request->product_id)->where('ware_id', $request->ware_id)->first()) {
            $model = new ProductWarehouses();
            $model->fill($request->only('product_id', 'ware_id'));
            $model->amount = 0;
            $model->status = 0;
            $model->code = \Illuminate\Support\Str::random(12);
            $model->export = 0;
            $model->save();
        }


        $requestIm = new RequestWarehouse();

        $requestIm->ncc_id = Auth::id();
        $requestIm->product_id = $request->product_id;
        $requestIm->status = 0;
        $requestIm->type = 1;
        $requestIm->ware_id = $request->ware_id;
        $requestIm->quantity = $request->amount;
        $code = 'YCN' . rand(100000000, 999999999);

        while (true) {
            $re = RequestWarehouse::where('code', $code)->count();
            if ($re == 0) {
                break;
            }
            $code = 'YCN' . rand(100000000, 999999999);
        }
        $requestIm->code = $code;
        $requestIm->order_number = '';
        $requestIm->note = 'Yêu cầu gửi sản phẩm';
        $requestIm->save();

        $warehouse = Warehouses::select('user_id')->where('id', $request->ware_id)->first();
        if ($warehouse) {
            $user = User::find($warehouse->user_id);
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => asset('image/users/' . Auth::user()->avatar) ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                'message' => 'Bạn vừa có đơn yêu cầu gửi sản phẩm mới',
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('screens.storage.product.request', ['key_search' => $requestIm->code])
            ];
            $user->notify(new AppNotification($data));
        }
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

    public function index(Request $request)
    {
        $limit= $request->limit??10;




        $ware = DB::table('warehouses')
            ->selectRaw('warehouses.name as ware_name,warehouses.id,
            phone_number,
            address,SUM(product_warehouses.amount - export) as amount_product,count(products.id) as amount,product_warehouses.code')
            ->join('product_warehouses', 'warehouses.id', '=', 'product_warehouses.ware_id')
            ->join('products', 'product_warehouses.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::id())
            ->where('product_warehouses.status', 1)

            ->orderBy('amount_product','desc')
            ->groupByRaw('ware_name,warehouses.id,phone_number,address')

            ->paginate($limit);


        return view('screens.manufacture.warehouse.index', ['warehouses' => $ware]);
    }
    public function store(Request $request){

    }
    public function swap()
    {
//        $products = DB::table('warehouses')->selectRaw('warehouses.name as ware_name,products.name,product_warehouses.status,product_warehouses.created_at,amount')->join('product_warehouses', 'warehouses.id', '=', 'product_warehouses.ware_id')->join('products', 'product_warehouses.product_id', '=', 'products.id')->where('warehouses.user_id', Auth::id())->where('product_warehouses.status','!=',3)->orderBy('product_warehouses.id', 'desc')->paginate(10);
//        $products = Product::join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
//            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
//            ->select()
//            ->paginate(10);

        $products = Warehouses::select('request_warehouses.code', 'warehouses.name as ware_name',
            'products.name', 'request_warehouses.status',
            'request_warehouses.quantity',
            'request_warehouses.created_at', 'request_warehouses.type')
            ->join('request_warehouses', 'warehouses.id', '=', 'request_warehouses.ware_id')
            ->join("products", 'request_warehouses.product_id', '=', 'products.id')
            ->orderBy('request_warehouses.id', 'desc')
            ->where('products.user_id', Auth::id())
            ->paginate(10);
//        $products = Product::where('user_id',Auth::user()->id)->paginate(10);
        return view('screens.manufacture.warehouse.swap', ['products' => $products]);

    }

    public function detail(Request $request)
    {
        $kho = ProductWarehouses::select('products.name as name', 'product_id', DB::raw('(amount -export) as amount_product'))
            ->join('products', 'product_warehouses.product_id', '=', 'products.id')
            ->groupBy(['product_id', 'products.name']
            )->where('ware_id', $request->id)
            ->where('products.user_id', Auth::id())
            ->where('product_warehouses.status', 1)
            ->get();


        return response()->json(['success' => true, 'data' => $kho]);
//        return view('screens.manufacture.warehouse.detail', ['products1' => $kho]);

    }

    public function test()
    {
        return view('screens.vstore.product.test');
    }
}

