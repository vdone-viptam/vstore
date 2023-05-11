<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\RequestWarehouse;
use App\Models\User;
use App\Models\Warehouses;
use App\Models\WarehouseType;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Raw;

class WarehouseController extends Controller
{

    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function addProduct()
    {
        $products = Product::where('user_id', Auth::id())
            ->where('admin_confirm_date', '!=', null)
            ->where('vstore_confirm_date', '!=', null)
            ->get();
        $warehouses = Warehouses::all();

        return view('screens.manufacture.warehouse.add-product', compact('products', 'warehouses'));
    }

    public function affWarehouse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_code' => 'required',
        ], [
            'account_code.required' => 'ID kho không được để trống',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }
        $user = User::where('role_id', 4)->where('account_code', $request->account_code)->first();
        $user2 = User::find(Auth::id());
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'ID kho không tồn tại'
            ], 404);
        }
        $warehouse_aff = json_decode($user2->warehouse_aff) ?? [];
        if (in_array($user->id, $warehouse_aff)) {
            return response()->json([
                'success' => false,
                'message' => 'Kho đã liên kết.Vui lòng thử ID kho khác'
            ], 400);
        }

        $user2->warehouse_aff = json_encode(array_merge($warehouse_aff, [$user->id]));
        $user2->save();
        return response()->json([
            'success' => true,
            'message' => 'Liên kết kho thành công'
        ], 201);
    }

    public function postAddProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'ware_id' => 'required',
            'quantity' => 'required|min:1|not_in:0',
        ], [
            'product_id.required' => 'Trường này không được trống',
            'ware_id.required' => 'Trường này không được trống',
            'quantity.required' => 'Trường này không được trống',
            'quantity.min' => 'Không được nhỏ hơn 1',
            'quantity.not_in' => 'Không được nhỏ hơn hoặc bằng 0',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        try {
            if (!DB::table('product_warehouses')->where('product_id', $request->product_id)->where('ware_id', $request->ware_id)->first()) {
                $model = new ProductWarehouses();
                $model->fill($request->only('product_id', 'ware_id'));
                $model->amount = 0;
                $model->status = 0;
                $model->code = \Illuminate\Support\Str::random(12);
                $model->export = 0;
                $model->type_warehouses = $request->type ?? 1;
                $model->save();
            }


            $requestIm = new RequestWarehouse();

            $requestIm->ncc_id = Auth::id();
            $requestIm->product_id = $request->product_id;
            $requestIm->status = 0;
            $requestIm->type = 1;
            $requestIm->type_warehouses = $request->type;
            $requestIm->ware_id = $request->ware_id;
            $requestIm->quantity = str_replace('.', '', $request->quantity);
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
            return redirect()->back()->with('success', 'Gửi yêu cầu gửi sản phẩm thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Gửi yêu cầu gửi sản phẩm không thành công');

        }
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
        $limit = $request->limit ?? 10;

        $warehouse_aff = json_decode(Auth::user()->warehouse_aff) ?? [];
        // dd(Auth::id());
        $this->v['field'] = $request->field ?? 'amount_product';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['products'] = Product::select('id', 'name')->where('user_id', Auth::id())->where('status', 2)->get();
        $this->v['warehouses'] = DB::table('warehouses')->selectRaw('warehouses.name as ware_name,warehouses.id,
            warehouses.phone_number,
            warehouses.address,warehouses.user_id')
            ->selectSub('select IFNULL(SUM(amount),0) - IFNULL(SUM(export),0)
from product_warehouses where ware_id = warehouses.id and product_warehouses.status = 1 group by ware_id', 'amount_product')
            ->selectSub('select IFNULL(COUNT(product_warehouses.product_id),0)
from product_warehouses where ware_id = warehouses.id and product_warehouses.status = 1  limit 1', 'amount')
            ->selectSub('select province_name from province where  province_id = warehouses.city_id limit 1', 'province_name')
            ->selectSub('select district_name from district where  district_id = warehouses.district_id limit 1', 'district_name')
            ->selectSub('select wards_name from wards where  wards_id = warehouses.ward_id limit 1', 'wards_name')
            ->join('users', 'warehouses.user_id', '=', 'users.id')
            ->orderBy($this->v['field'], $this->v['type'])
            ->whereIn('warehouses.user_id', $warehouse_aff)
            ->paginate($this->v['limit']);
        foreach ($this->v['warehouses'] as $warehouse) {
            $type = WarehouseType::select('type')->where('user_id', $warehouse->user_id)->get();
            $arrType = [];
            foreach ($type as $t) {
                $arrType[] = $t->type;
            }

            $warehouse->type_warehouse = $arrType;
        }

        return view('screens.manufacture.warehouse.index', $this->v);
    }

    public function store(Request $request)
    {

    }

    public function swap(Request $request)
    {
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $this->v['field'] = $request->field ?? 'request_warehouses.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';

        $this->v['products'] = Warehouses::select('request_warehouses.code', 'warehouses.name as ware_name',
            'products.name', 'request_warehouses.status',
            'request_warehouses.quantity',
            'request_warehouses.created_at', 'request_warehouses.type')
            ->join('request_warehouses', 'warehouses.id', '=', 'request_warehouses.ware_id')
            ->join("products", 'request_warehouses.product_id', '=', 'products.id')
            ->orderBy($this->v['field'], $this->v['type'])
            ->where('products.user_id', Auth::id())
            ->whereIn('request_warehouses.type', [1, 2]);
        if (strlen($this->v['key_search']) > 0) {
            $this->v['products'] = $this->v['products']->where(function ($query) {
                $this->v['products']->where('request_warehouses.code', $this->v['key_search'])
                    ->orWhere('warehouses.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('products.name', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['products'] = $this->v['products']->paginate($this->v['limit']);
        return view('screens.manufacture.warehouse.swap', $this->v);

    }

    public function detail(Request $request)
    {
        $warehouse_aff = json_decode(Auth::user()->warehouse_aff) ?? [];
        $warehouses = Warehouses::select('image_storage')
            ->join('warehouse_type', 'warehouses.user_id', '=', 'warehouse_type.user_id')
            ->where('warehouses.id', $request->id)
            ->limit(3)->get();
        $order = Order::select(DB::raw('count(*) as total'), 'export_status')
            ->groupBy('export_status')
            ->whereIn('export_status', [5, 4])
            ->where('warehouse_id', $request->id)
            ->get();
        $kho = ProductWarehouses::select(
            'products.name as name', 'product_id',
            DB::raw('(amount -export) as amount_product'))
            // ->join('products', 'product_warehouses.product_id', '=', 'products.id')
            ->leftJoin('products', 'product_warehouses.product_id', '=', 'products.id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
            ->groupBy(['product_id', 'products.name']
            )->where('ware_id', $request->id)
            // ->where('products.user_id', Auth::id())
            ->whereIn('warehouses.user_id', $warehouse_aff)
            ->where('product_warehouses.status', 1)
            ->get();

        // dd($kho->toArray());

        return response()->json(['success' => true, 'data' => $kho, 'img' => $warehouses, 'order' => $order]);
//        return view('screens.manufacture.warehouse.detail', ['products1' => $kho]);

    }

    public function test()
    {
        return view('screens.vstore.product.test');
    }

    public function getTypeWarehouse(Request $request)
    {

        try {
            $ware_type = WarehouseType::select('warehouse_type.type')
                ->join('warehouses', 'warehouse_type.user_id', '=', 'warehouses.user_id')
                ->where('warehouses.id', $request->id)
                ->get();

            $product_ware = ProductWarehouses::select('type_warehouses')->where('product_id', $request->product_id)
                    ->where('ware_id', $request->id)
                    ->first()->type_warehouses ?? 0;

            return response()->json([
                'ware_type' => $ware_type,
                'product_ware' => $product_ware
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}

