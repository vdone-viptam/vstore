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
use App\Models\RequestWarehouse;
use App\Models\User;
use App\Models\Vshop;
use App\Models\VshopProduct;
use App\Models\Warehouses;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Elastic\Elasticsearch\Exception\ClientResponseException;
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
        $type = $request->type ?? 'asc';
        $field = $request->field ?? 'in_stock';
        $products = DB::table('categories')->selectRaw('products.publish_id,
            products.sku_id,
            products.name as product_name,
            categories.name as cate_name,
            (product_warehouses.amount - product_warehouses.export) as in_stock,
            warehouses.id as warehouse_id,
            products.id as product_id'
        )
            ->selectSub('select IFNULL(SUM(quantity),0) from request_warehouses
                     where request_warehouses.product_id = products.id
                       and request_warehouses.ware_id = warehouses.id  and request_warehouses.type = 2 and request_warehouses.status = 0', 'pause_product')
            ->selectSub('select name from users where id = products.user_id', 'name')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
            ->join('users', 'warehouses.user_id', 'users.id')
            ->where('product_warehouses.status', 1)
            ->orderBy($field, $type)
            ->groupBy(['products.id'])
            ->where('warehouses.user_id', Auth::id());

        if ($request->key_search) {
            $request->key_search = trim($request->key_search);
            $products->where(function ($query) use ($request) {
                $query->where('products.publish_id', $request->key_search)
                    ->orWhere('products.sku_id', $request->key_search)
                    ->orWhere('products.name', 'like', '%' . $request->key_search . '%')
                    ->orWhere('users.name', $request->key_search)
                    ->orWhere('categories.name', $request->key_search);
            });
        }
        $products = $products->paginate($limit);

        return view('screens.storage.product.index',
            ['products' => $products, 'key_search' => trim($request->key_search) ?? '', 'type' => $type, 'field' => $field]);
    }

    public function request(Request $request)
    {
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => \Carbon\Carbon::now()]);
        }
        $limit = $request->limit ?? 10;
        $type = $request->type ?? 'desc';
        $field = $request->field ?? 'request_warehouses.id';
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
            ->orderBy($field, $type);
        if ($request->key_search) {
            $request->key_search = trim($request->key_search);
            $requests->where(function ($query) use ($request) {
                $query->where('request_warehouses.code', $request->key_search)
                    ->orWhere('products.publish_id', $request->key_search)
                    ->orWhere('products.name', 'like', '%' . $request->key_search . '%')
                    ->orWhere('users.name', $request->key_search);
            });
        }
        $requests = $requests->paginate($limit);
        $this->v['requests'] = $requests;
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['type'] = $type;
        $this->v['field'] = $field;
        return view('screens.storage.product.request', $this->v);

    }

    public function updateRequest(Request $request, $status = null)
    {
        if (!in_array((int)$status, [10, 5, 1])) {
            return response()->json([
                'success' => false,
                'message' => 'Trạng thái cập nhật chỉ là 1,5 hoặc 10',
            ], 400);
        }
        DB::beginTransaction();
        try {
            $requestIm = RequestWarehouse::where('id', $request->id)->where('type', 1)->first();
            if (!$requestIm) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy yêu cầu',
                ], 404);
            } else {
                if ($requestIm->status == 1 || $requestIm->status == 2) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy yêu cầu',
                    ], 404);
                }
            }
            if ($requestIm->status == 5) {
                $ware = ProductWarehouses::where('ware_id', $requestIm->ware_id)->where('product_id', $requestIm->product_id)->first();
                if (!$ware) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy sản phẩm',
                    ], 404);
                }
                if ($ware->status == 0) {
                    $ware->status = 1;
                }
                $ware->amount = $ware->amount + $requestIm->quantity;
                $ware->save();
                $vshop = Vshop::where('pdone_id', 262)->first();
                $user = User::find($requestIm->ncc_id);
                $data_vstore = [
                    'title' => 'Bạn vừa có 1 thông báo mới',
                    'avatar' => '#',
                    'message' => 'Đã đồng ý yêu cầu thêm sản phẩm của bạn',
                    'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                    'href' => route('screens.manufacture.warehouse.swap', ['key_search' => $requestIm->code])
                ];
                $user->notify(new AppNotification($data_vstore));
                if (!VshopProduct::where('product_id', $requestIm->product_id)->where('vshop_id', $vshop->id)->whereIn('status', [1, 2])->first()) {
                    $vshop_product = new VshopProduct();
                    $vshop_product->vshop_id = $vshop->id;
                    $vshop_product->product_id = $requestIm->product_id;
                    $vshop_product->status = 1;
                    $vshop_product->save();
                }

                $product = Product::with(['category'])->where('id', $requestIm->product_id)->where('availability_status', 0)->first();
                if ($product) {
                    $product->availability_status = 1;
                    $product->save();
                    $elasticsearchController = new ElasticsearchController();

                    try {
                        $res = $elasticsearchController
                            ->createDocProduct((string)$product->id,
                                $product->name, $product->short_content, $product->category->name, $product->publish_id);
                        DB::commit();
                    } catch (ClientResponseException $exception) {
                        DB::rollBack();
                        return response()->json([
                            'success' => false,
                            'message' => 'Có lỗi xảy ra vui lòng thử lại',
                        ], 500);
                    }
                }
            }
            if ($requestIm->status == 7) {
                $ware = ProductWarehouses::where('ware_id', $requestIm->ware_id)->where('product_id', $requestIm->product_id)->first();
                if (!$ware) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy sản phẩm',
                    ], 404);
                }
                $ware->export = $ware->export - (int)$requestIm->quantity;
                $ware->save();
            }

            $requestIm->status = $status;
            $requestIm->save();
            if ($status == 10) {
                $user = User::find($requestIm->ncc_id);
                $data_vstore = [
                    'title' => 'Bạn vừa có 1 thông báo mới',
                    'avatar' => '#',
                    'message' => 'Đã từ chối yêu cầu thêm sản phẩm của bạn',
                    'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                    'href' => route('screens.manufacture.warehouse.swap', ['key_search' => $requestIm->code])
                ];
                $user->notify(new AppNotification($data_vstore));
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật yêu cầu thành công',

            ], 201);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 500);
        }
    }

    public function requestOut(Request $request)
    {
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => \Carbon\Carbon::now()]);
        }
        $limit = $request->limit ?? 10;
        $type = $request->type ?? 'desc';
        $field = $request->field ?? 'order.created_at';
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
            ->orderBy($field, $type);
        $order = $order->where('order.status', '!=', 2)
            ->where('order_item.warehouse_id', $warehouses->id);
        if ($request->key_search) {
            $request->key_search = trim($request->key_search);
            $order->where(function ($query) use ($request) {
                $query->where('order.no', $request->key_search)
                    ->orWhere('products.publish_id', $request->key_search)
                    ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
            });
        }
        $order = $order->paginate($limit);
        $key_search = trim($request->key_search) ?? '';
        return view('screens.storage.product.requestOut', compact('order', 'key_search', 'field', 'type'));
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
            'data' => $product,
        ]);
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
            ->orWhere('order.no', $request->id)
            ->first();
        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    public function updateRequestOut(Request $request, $status = null)
    {


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
            RequestWarehouse::destroy($order->request_warehouse_id);
            $priceDiscount = $product->price;

            $totalDiscountSuppliersAndVStore = 0;
            if ($order_item->discount_ncc) {
                $totalDiscountSuppliersAndVStore += $order_item->discount_ncc;
            }
            if ($order_item->discount_vstore) {
                $totalDiscountSuppliersAndVStore += $order_item->discount_vstore;
            }
            if ($totalDiscountSuppliersAndVStore > 0) {
                $priceDiscount = $priceDiscount - $priceDiscount * ($totalDiscountSuppliersAndVStore / 100);
            }
            if ($order_item->discount_vshop) {
                $priceDiscount = $priceDiscount - $priceDiscount * ($order_item->discount_vshop / 100);
            }
            $price = $priceDiscount;
            //Tính VAT
            $vat = $priceDiscount * ($product->vat / 100);
            $priceDiscount = $priceDiscount + $vat;
            if ($status == 1) {
//            return $order->total;
                if ($order->method_payment == 'COD') {
                    $money_colection = (int)$order->total - (int)$order->shipping;
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
                    'PRODUCT_WEIGHT' => ($product->weight) * $order_item->quantity,
                    'PRODUCT_PRICE' => $order->total - $order->shipping,
                    'MONEY_COLLECTION' => $money_colection,
                    'TYPE' => 1,

                ]);

                $date = str_replace(' giờ', '', $get_list[0]['THOI_GIAN']);
                $order->estimated_date = \Illuminate\Support\Carbon::now()->addHours((int)$date);

                $tinh_thanh_gui = Province::where('province_id', $warehouse->city_id)->first()->province_name ?? '';
                $quan_huyen_gui = District::where('district_id', $warehouse->district_id)->first()->district_name ?? '';
                $tinh_thanh_nhan = Province::where('province_id', $order->province_id)->first()->province_name ?? '';
                $quan_huyen_nhan = District::where('district_id', $order->district_id)->first()->district_name ?? '';
//            return $quan_huyen_nhan;
//            return $warehouse->address .',' .$quan_huyen_gui.','.$tinh_thanh_gui;

                $list_item[] = [
                    'PRODUCT_NAME' => $product->name,
                    'PRODUCT_QUANTITY' => $order_item['quantity'],
                    'PRODUCT_PRICE' => $priceDiscount,
                    'PRODUCT_WEIGHT' => $product->weight * $order_item['quantity']
                ];
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
                    "RECEIVER_ADDRESS" => $order->address,
                    "RECEIVER_PHONE" => $order->phone,
                    "PRODUCT_NAME" => $product->name,
                    "PRODUCT_DESCRIPTION" => $order_item['quantity'] . " x " . $product->name,
                    "PRODUCT_QUANTITY" => $order_item->quantity,
                    "PRODUCT_PRICE" => $order->total - $order->shipping,
                    "PRODUCT_WEIGHT" => $product->weight * $order_item['quantity'],
                    "PRODUCT_LENGTH" => null,
                    "PRODUCT_WIDTH" => null,
                    "PRODUCT_HEIGHT" => null,
                    "ORDER_PAYMENT" => $order_payment,
                    "ORDER_SERVICE" => $get_list[0]['MA_DV_CHINH'],
                    "ORDER_SERVICE_ADD" => null,
                    "ORDER_NOTE" => $order_item['quantity'] . " x " . $product->name,
                    "MONEY_COLLECTION" => $money_colection,
                    "LIST_ITEM" => $list_item,
                ]);

                $order->order_number = json_decode($taodon)->data->ORDER_NUMBER;
                $order->save();
                $requestEX = new RequestWarehouse();

                $requestEX->ncc_id = 0;
                $requestEX->product_id = $product->id;
                $requestEX->status = 0;
                $requestEX->type = 2;
                $requestEX->ware_id = $order->warehouse_id;
                $requestEX->quantity = $order_item->quantity;
                $code = 'YCX' . rand(100000000, 999999999);

                while (true) {
                    $re = RequestWarehouse::where('code', $code)->count();
                    if ($re == 0) {
                        break;
                    }
                    $code = 'YCX' . rand(100000000, 999999999);
                }
                $requestEX->order_number = json_decode($taodon)->data->ORDER_NUMBER;
                $requestEX->code = $code;
                $requestEX->note = 'Yêu cầu xuất kho';
                $requestEX->save();
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
}
