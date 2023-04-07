<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Api\ElasticsearchController;
use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\BillProduct;
use App\Models\Category;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\Province;
use App\Models\User;
use App\Models\Warehouses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $products = DB::table('categories')->selectRaw('products.publish_id,
            products.sku_id,
            products.name as product_name,
            categories.name as cate_name,
            users.name,
            (product_warehouses.amount - product_warehouses.export) as in_stock,
            warehouses.id as warehouse_id,
            products.id as product_id'
        )
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
            ->join('users', 'warehouses.user_id', 'users.id')
            ->where('product_warehouses.status', 1)
            ->groupBy(['products.id'])
            ->where('warehouses.user_id', Auth::id());

        if ($request->publish_id) {
            $products = $products->where('products.publish_id', $request->publish_id);
        }

        $products = $products->paginate(1);

        foreach ($products as $pro) {
            $pro->pause_product = (int)DB::table('request_warehouses')
                    ->selectRaw('SUM(quantity) as total')
                    ->where('request_warehouses.product_id', $pro->product_id)
                    ->where('request_warehouses.ware_id', $pro->warehouse_id)
                    ->join('order', 'request_warehouses.order_number', '=', 'order.order_number')
                    ->where('type', 2)
                    ->where('request_warehouses.status', 0)
                    ->first()->total ?? 0;
        }
        return view('screens.storage.product.index', ['products' => $products]);
    }

    public function request(Request $request)
    {
        $limit = $request->limit ?? 10;
        $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();
        $requests = User::join('products', 'users.id', '=', 'products.user_id')
            ->select('request_warehouses.code',
                'products.publish_id',
                'products.name as product_name',
                'users.name as ncc_name',
                'quantity',
                'request_warehouses.created_at',
                'request_warehouses.status',
                'request_warehouses.id'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->where('type', 1)
            ->where('request_warehouses.ware_id', $warehouses->id)
            ->orderBy('request_warehouses.id', 'desc');
        if ($request->code) {
            $requests = $requests->where('request_warehouses.code', $request->code);
        }
        $requests = $requests->paginate($limit);
        $this->v['requests'] = $requests;

        return view('screens.storage.product.request', $this->v);

    }

    public function requestOut(Request $request)
    {
        $limit = $request->limit ?? 10;

        $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();
        $order = Product::join('order_item', 'products.id', '=', 'order_item.product_id')
            ->join('order', 'order_item.order_id', '=', 'order.id')
            ->select(
                'order.no',
                'products.publish_id',
                'products.name',
                'order_item.quantity',
                'order.method_payment',
                'order.export_status',
                'order.updated_at as created_at',
                'order.id'
            )
            ->orderBy('order.id', 'desc');
        $order = $order->where('order.status', '!=', 2)
            ->where('order_item.warehouse_id', $warehouses->id);
        if ($request->code) {
            $order = $order->where('order.no', $request->code);
        }
        $order = $order->paginate($limit);
        return view('screens.storage.product.requestOut', compact('order'));
    }

    public function updateRequest($status, Request $request)
    {

        $product_warehouses = ProductWarehouses::where('id', $request->id)->first();
        $product_warehouses->status = $request->status;
        $product_warehouses->save();
//        DB::table('product_warehouses')->where('id', $request->id)->update(['status' => $status]);
        if ($request->status == 1) {
            $product = Product::with(['category'])->where('id', $product_warehouses->product_id)->first();
            if ($product->availability_status == 0) {
                $elasticsearchController = new ElasticsearchController();

                $res = $elasticsearchController->createDocProduct($product->id,
                    $product->name,
                    $product->short_content,
                    $product->category->name,
                    $product->publish_id);
            }
            $product->availability_status = 1;
            $product->save();
        }

        return redirect()->back()->with('success', 'Cập nhật đơn gửi hàng thành công');
    }

    public function updateRequestOut($status, Request $request)
    {


//        return $request;

        try {

            $order = Order::find($request->id);
            if (!$order) {
                return redirect()->back();
            }

            $login = Http::post('https://partner.viettelpost.vn/v2/user/Login', [
                'USERNAME' => config('domain.TK_VAN_CHUYEN'),
                'PASSWORD' => config('domain.MK_VAN_CHUYEN'),
            ]);

//        return $login['data']['token'];
//        $data_login = json_decode($login)->data;

            $order->export_status = $status;
            $order->save();
            $warehouse = Warehouses::find($order->warehouse_id);
            if (!$warehouse) {
                return redirect()->back();
            }
            $order_item = OrderItem::where('order_id', $order->id)->first();

            $product = Product::where('id', $order_item->product_id)->first();


            if ($status == 1) {
//            return $order->total;
                if ($order->method_payment == 'COD') {
                    $money_colection = (int)$order->total;
                    $order_payment = 2;
                } else {
                    $money_colection = 0;
                    $order_payment = 1;
                }

                $get_list = Http::withHeaders(
                    [
                        'Content-Type' => ' application/json',
                        'Token' => $login['data']['token']
                    ]
                )->post('https://partner.viettelpost.vn/v2/order/getPriceAll', [
                    'SENDER_DISTRICT' => $warehouse->district_id,
                    'SENDER_PROVINCE' => $warehouse->city_id,
                    'RECEIVER_DISTRICT' => $order->district_id,
                    'RECEIVER_PROVINCE' => $order->province_id,
                    'PRODUCT_TYPE' => 'HH',
                    'PRODUCT_WEIGHT' => $product->weight * $order_item->quantity,
                    'PRODUCT_PRICE' => $order->total - $order->shipping,
                    'MONEY_COLLECTION' => $money_colection,
                    'TYPE' => 1,

                ]);
//            return $get_list;

                $tinh_thanh_gui = Province::where('province_id', $warehouse->city_id)->first()->province_name ?? '';
                $quan_huyen_gui = District::where('district_id', $warehouse->district_id)->first()->district_name ?? '';
                $tinh_thanh_nhan = Province::where('province_id', $order->province_id)->first()->province_name ?? '';
                $quan_huyen_nhan = District::where('district_id', $order->district_id)->first()->district_name ?? '';
//            return $quan_huyen_nhan;
//            return $warehouse->address .',' .$quan_huyen_gui.','.$tinh_thanh_gui;
                $list_item[] = [
                    'PRODUCT_NAME' => $product->name,
                    'PRODUCT_QUANTITY' => $order_item['quantity'],
                    'PRODUCT_PRICE' => $product->price,
                    'PRODUCT_WEIGHT' => $product->price * $order_item['quantity']
                ];
//            return $get_list[0]['MA_DV_CHINH'];
                $taodon = Http::withHeaders(
                    [
                        'Content-Type' => ' application/json',
                        'Token' => $login['data']['token']
                    ]
                )->post('https://partner.viettelpost.vn/v2/order/createOrderNlp', [
                    "ORDER_NUMBER" => '',
                    "SENDER_FULLNAME" => $warehouse->name,
                    "SENDER_ADDRESS" => $warehouse->address . ',' . $quan_huyen_gui . ',' . $tinh_thanh_gui,
                    "SENDER_PHONE" => $warehouse->phone_number,
                    "RECEIVER_FULLNAME" => $order->fullname,
                    "RECEIVER_ADDRESS" => $order->address . ',' . $quan_huyen_nhan . ',' . $tinh_thanh_nhan,
                    "RECEIVER_PHONE" => $order->phone,
                    "PRODUCT_NAME" => $order->no,
                    "PRODUCT_DESCRIPTION" => "",
                    "PRODUCT_QUANTITY" => 1,
                    "PRODUCT_PRICE" => $order->total - $order->shipping,
                    "PRODUCT_WEIGHT" => $product->weight * $order_item->quantity,
                    "PRODUCT_LENGTH" => null,
                    "PRODUCT_WIDTH" => null,
                    "PRODUCT_HEIGHT" => null,
                    "ORDER_PAYMENT" => $order_payment,
                    "ORDER_SERVICE" => $get_list[0]['MA_DV_CHINH'],
                    "ORDER_SERVICE_ADD" => null,
                    "ORDER_NOTE" => "",
                    "MONEY_COLLECTION" => 0,
                    "LIST_ITEM" => $list_item,
                ]);

                $order->order_number = json_decode($taodon)->data->ORDER_NUMBER;
                $order->save();
            }
            if ($status == 3 && $order->order_number !== '') {

                $huy_don = Http::withHeaders(
                    [
                        'Content-Type' => ' application/json',
                        'Token' => $login['data']['token']
                    ]
                )->post('https://partner.viettelpost.vn/v2/order/UpdateOrder', [
                    'TYPE' => 4,
                    'ORDER_NUMBER' => $order->order_number,
                    'NOTE' => "Hủy đơn do kho",

                ]);
            }


            return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
        } catch (\Exception $e) {
            return redirect()->back();
        };

    }

    public function detail(Request $request)
    {
//        return $request->id;
        $order = Order::where('id', $request->id)->first();

        $products = OrderItem::join('products', 'order_item.product_id', '=', 'products.id')->where('order_id', $order->id)
            ->select('order_item.id', 'order_item.quantity', 'products.publish_id', 'products.name as name')
            ->get();
        $total = $order->total;
//        return $products;
        return view('screens.storage.product.detailOut', compact('products', 'total'));

    }
}
