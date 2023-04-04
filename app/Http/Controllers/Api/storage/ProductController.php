<?php

namespace App\Http\Controllers\Api\storage;

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
use App\Models\RequestWarehouse;
use App\Models\User;
use App\Models\Warehouses;
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
        $this->v = [];
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
            ->groupBy(['products.id'])
            ->where('warehouses.user_id', Auth::id())
            ->paginate($limit);;

        foreach ($products as $pro) {
            $pro->pause_product = (int)DB::table('request_warehouses')
                    ->selectRaw('SUM(quantity) as total')
                    ->where('request_warehouses.product_id', $pro->product_id)
                    ->where('request_warehouses.ware_id', $pro->warehouse_id)
                    ->where('type', 2)
                    ->first()->total ?? 0;
        }
        return response()->json([
            'success' => true,
            'data' => $products
        ], 200);

    }

    public function detailProduct(Request $request)
    {
        $product = DB::table('categories')->selectRaw('products.publish_id,
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
            ->groupBy(['products.id'])
            ->where('warehouses.user_id', Auth::id())
            ->where('product_warehouses.product_id', $request->product_id)
            ->first();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm'
            ], 404);
        }
        $product->ex_im = DB::table('request_warehouses')
            ->selectRaw('SUM(quantity) as total,type')
            ->where('request_warehouses.product_id', $product->product_id)
            ->where('request_warehouses.ware_id', $product->warehouse_id)
            ->whereIn('type', [1, 2])
            ->where('status', 0)
            ->orderBy('type', 'asc')
            ->groupBy('type')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
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
            ->orderBy('request_warehouses.id', 'desc')
            ->paginate($limit);
        $this->v['params'] = $request->all();
        return response()->json([
            'success' => true,
            'data' => $requests
        ], 200);

    }

    public function detailRequest(Request $request)
    {
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
            ->where('request_warehouses.id', $request->id)
            ->first();
        return response()->json([
            'success' => true,
            'data' => $requests
        ], 200);
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
                'order.created_at',
                'order.id'
            )
            ->orderBy('order.id', 'desc');
        $order = $order->where('order.status', '!=', 2)
            ->where('order_item.warehouse_id', $warehouses->id)
            ->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);

    }

    public function detailRequestOut(Request $request)
    {
        $order = Product::join('order_item', 'products.id', '=', 'order_item.product_id')
            ->join('order', 'order_item.order_id', '=', 'order.id')
            ->select(
                'order.no',
                'products.publish_id',
                'products.name',
                'order_item.quantity',
                'order.method_payment',
                'order.export_status',
                'order.created_at',
                'order.id'
            )
            ->orderBy('order.id', 'desc');
        $order = $order->where('order.status', '!=', 2)
            ->where('order.id', $request->id)
            ->first();
        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    public function updateRequest($status, Request $request)
    {
        if (!in_array((int)$status, [5, 2, 1])) {
            return response()->json([
                'success' => false,
                'message' => 'Trạng thái cập nhật chỉ là 1,5 hoặc 2',
            ], 400);
        }

        $requestIm = RequestWarehouse::where('id', $request->id)->where('type', 1)->where('status', 0)->orWhere('status', 5)->first();
        if (!$requestIm) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy yêu cầu',
            ], 404);
        }
        if ($status == 1) {
            if ($requestIm->type == 1) {
                $ware = ProductWarehouses::where('ware_id', $requestIm->ware_id)->where('product_id', $requestIm->product_id)->first();
                if (!$ware) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy sản phẩm',
                    ], 404);
                }
                $ware->amount = $ware->amount + $requestIm->quantity;
                $ware->save();
            }
        }
        $requestIm->status = $status;
        $requestIm->save();
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật đơn gửi hàng thành công',

        ], 201);


    }

    public function updateRequestOut($status, Request $request)
    {


//        return $request;

        try {

            $order = Order::where('id', $request->id)->orWhere('no', $request->id)->first();
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
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
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy kho hàng'
                ], 404);
            }
            $order_item = OrderItem::where('order_id', $order->id)->first();

            $product = Product::where('id', $order_item->product_id)->first();
            DB::table('request_warehouses')->where('code', $order->no)->where('type', 10)->delete();

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
                    "SENDER_PHONE" => $warehouse->phone_nameber,
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
                $request = new RequestWarehouse();

                $request->ncc_id = 0;
                $request->product_id = $product->id;
                $request->status = 0;
                $request->type = 2;
                $request->ware_id = $order->warehouse_id;
                $request->quantity = $order_item->quantity;
                $code = 'YCX' . rand(100000000, 999999999);

                while (true) {
                    $re = RequestWarehouse::where('code', $code)->count();
                    if ($re == 0) {
                        break;
                    }
                    $code = 'YCX' . rand(100000000, 999999999);
                }
                $request->order_number = json_decode($taodon)->data->ORDER_NUMBER;
                $request->code = $code;
                $request->note = 'Yêu cầu xuất kho';
                $request->save();
            }
            if ($status == 3 && $order->order_number !== '') {
                $order->note = $request->note;
                $order->save();
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
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật đơn hàng thành công',

            ], 201);


        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);

        };

    }

    public function getProductAndOrderBySKU($sku)
    {
        $product = Product::select('name', 'category_id', 'brand',
            'weight', 'length', 'height', 'packing_type',
            'volume', 'with', 'images', 'material', 'id')
            ->where('sku_id', $sku)
            ->first();
        $warehouse = Warehouses::select("id")->where('user_id', Auth::id())->first();
        $product->in_stock = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2  AND product_id = " . $product->id . " AND ware_id =" . $warehouse->id . ") as amount FROM product_warehouses where status = 1 AND product_id = " . $product->id . " AND ware_id =" . $warehouse->id . ""))[0]->amount;

        $product->orders = OrderItem::select('no', 'quantity')
            ->where('product_id', $product->id)
            ->where('export_status', 0)
            ->join('order', 'order_item.order_id', '=', 'order.id')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function sendBill($order_id)
    {
        try {
            $order = Order::select('no', 'id', 'created_at', 'shipping', 'total', 'fullname', 'phone', 'address', 'export_status', 'order_number')
                ->where('id', $order_id)
                ->where('status', '!=', 2)
                ->first();
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }
            $order->info_receiver = [
                'fullname' => $order->fullname,
                'phone' => $order->phone,
                'address' => $order->address
            ];
            unset($order->fullname);
            unset($order->phone);
            unset($order->address);
            $order->detail = $order->orderItem()
                ->select('discount_ncc', 'discount_vstore', 'discount_vshop', 'product_id', 'quantity')->first();
            $product = $order->detail->product()->select('vat', 'price', 'name')->first();
            $order->detail->vat = $product->vat;
            $order->detail->price = $product->price;
            $order->detail->product_name = $product->name;
            return response()->json([
                'success' => true,
                'data' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
