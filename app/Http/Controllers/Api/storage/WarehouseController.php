<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\RequestWarehouse;
use App\Models\User;
use App\Models\Vshop;
use App\Models\VshopProduct;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
    //


    public function importProduct(Request $request)
    {
        $limit = $request->limit ?? 10;
        $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();
        $type = $request->type ?? 'desc';
        $field = $request->field ?? 'request_warehouses.id';
        $requests = User::join('products', 'users.id', '=', 'products.user_id')
            ->select(
                'request_warehouses.code',
                'products.publish_id',
                'products.name as product_name',
                'users.name as ncc_name',
                'quantity',
                'request_warehouses.status',
                'request_warehouses.created_at',
                'request_warehouses.id',
                'request_warehouses.note'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->where('type', 1)
            ->where('request_warehouses.ware_id', $warehouses->id)
            ->whereIn('request_warehouses.status', [5, 1, 7])
            ->orderBy($field, $type);
        if ($request->code) {
            $requests = $requests->where('request_warehouses.code', $request->code);
        }
        $requests = $requests->paginate($limit);
        return response()->json([
            'success' => true,
            'data' => $requests,
            'field' => $field,
            'type' => $type
        ], 200);
    }

    public function detailImportProduct(Request $request)
    {
        $requests = User::join('products', 'users.id', '=', 'products.user_id')
            ->select(
                'request_warehouses.code',
                'products.publish_id',
                'products.name as product_name',
                'users.name as ncc_name',
                'quantity',
                'request_warehouses.status',
                'request_warehouses.created_at',
                'request_warehouses.id',
                'request_warehouses.note',
                'request_warehouses.type'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->where('request_warehouses.id', $request->id)
            ->orWhere('request_warehouses.code', $request->id)
            ->first();
        if ($requests->type == 2) {
            $requests->order_number = RequestWarehouse::select('order_number')
                    ->where('id', $requests->id)->orWhere('code', $request->id)
                    ->first()->order_number ?? 'Chưa có mã vận chuyển';
        }
        return response()->json([
            'success' => true,
            'data' => $requests
        ], 200);

    }

    public function exportProduct(Request $request)
    {
        $limit = $request->limit ?? 10;
        $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();
        $type = $request->type ?? 'desc';
        $field = $request->field ?? 'request_warehouses.id';
        $requests = User::query()
            ->join('products', 'users.id', '=', 'products.user_id')
            ->select(
                'request_warehouses.code',
                'products.publish_id',
                'products.name as product_name',
                'users.name as ncc_name',
                'quantity',
                'request_warehouses.status',
                'request_warehouses.created_at',
                'request_warehouses.id',
                'request_warehouses.order_number',
                'order.id as order_id'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->join('order', 'request_warehouses.order_number', '=', 'order.order_number')
            ->where('type', 2)
            ->where('request_warehouses.ware_id', $warehouses->id)
            ->whereNotIn('order.export_status', [3, 5])
            ->orderBy($field, $type);
        if ($request->code) {
            $requests = $requests->where('request_warehouses.code', $request->code);
        }
        $requests = $requests->paginate($limit);
        return response()->json([
            'success' => true,
            'data' => $requests,
            'field' => $field,
            'type' => $type
        ], 200);

    }


    public function confirmExportProduct(Request $request)
    {
        DB::beginTransaction();

        try {
            $requestEx = RequestWarehouse::where('id', $request->id)->where('type', 2)->where('status', 0)->first();
            if (!$requestEx) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy yêu cầu xuất kho'
                ], 404);
            }

            $requestEx->status = 1;

            $productWare = ProductWarehouses::where('ware_id', $requestEx->ware_id)->where('product_id', $requestEx->product_id)->first();

            if (!$productWare) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }
            $productWare->export = $productWare->export + $requestEx->quantity;

            if ($productWare->export > $productWare->amount) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng sản phẩm không đủ để xuất'
                ], 400);
            }
            $productWare->save();

            $requestEx->save();
            $order = Order::where('order_number', $requestEx->order_number)->first();
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng'
                ], 404);
            }
            $order->export_status = 2;
            $order->cancel_status = 1;
            $order->save();

            $product = Product::find($requestEx->product_id);
            $product->amount_product_sold = $product->amount_product_sold + $requestEx->quantity;
            $product->save();

            $vshop_Id = OrderItem::select('vshop_id')->where('order_id', $order->id)->first();

            $vshop_product = VshopProduct::where('vshop_id', $vshop_Id->vshop_id)->where('product_id', $requestEx->product_id)->first();
            $vshop_product->amount_product_sold = $vshop_product->amount_product_sold + $requestEx->quantity;

            $vshop_product->save();

            $vshop = Vshop::find($vshop_Id->vshop_id);
            $vshop->products_sold = $vshop->products_sold + $requestEx->quantity;
            $vshop->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Xác nhận yêu cầu xuất thành công'
            ], 201);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function exportDestroyProduct(Request $request)
    {
        $limit = $request->limit ?? 10;
        $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();
        $type = $request->type ?? 'desc';
        $field = $request->field ?? 'request_warehouses.id';
        $requests = User::join('products', 'users.id', '=', 'products.user_id')
            ->select(
                'request_warehouses.code',
                'products.publish_id',
                'products.name as product_name',
                'users.name as ncc_name',
                'quantity',
                'request_warehouses.created_at',
                'request_warehouses.id',
                'request_warehouses.status',
                'request_warehouses.order_number',
                'request_warehouses.note'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->where('type', 3)
            ->where('request_warehouses.status', 1)
            ->where('request_warehouses.ware_id', $warehouses->id)
            ->orderBy($field, $type);
        if ($request->code) {
            $requests = $requests->where('request_warehouses.code', $request->code);
        }
        $requests = $requests->paginate($limit);
        return response()->json([
            'success' => true,
            'data' => $requests,
            'field' => $field,
            'type' => $type
        ], 200);
    }

    public function storeImportProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ], [
            'order_id.required' => 'Mã đơn hàng là bắt buộc'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        DB::beginTransaction();
        try {
            $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();
            $order = Order::join('order_item', 'order.id', '=', 'order_item.order_id')
                ->select('quantity', 'order_item.product_id', 'order_item.warehouse_id', 'order.no', 'products.user_id', 'order.id')
                ->join('products', 'order_item.product_id', '=', 'products.id')
                ->where('order_item.order_id', $request->order_id)
                ->where('order.warehouse_id', $warehouses->id)
                ->where('order.cancel_status', 1)
                ->where('order.export_status', 5)
                ->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng để hoàn hàng'], 404);
            }

            $requestIm = new RequestWarehouse();

            $requestIm->ncc_id = $order->user_id;
            $requestIm->product_id = $order->product_id;
            $requestIm->status = 7;
            $requestIm->type = 1;
            $requestIm->ware_id = $order->warehouse_id;
            $requestIm->quantity = $order->quantity;
            $code = 'YCHH' . rand(100000000, 999999999);

            while (true) {
                $re = RequestWarehouse::where('code', $code)->count();
                if ($re == 0) {
                    break;
                }
                $code = 'YCHH' . rand(100000000, 999999999);
            }
            $requestIm->code = $code;
            $requestIm->order_number = '';
            $requestIm->note = 'Hoàn hàng khách hủy - ' . $order->no;
            $requestIm->save();

            DB::table('order')->where('id', $order->id)->update(['cancel_status' => 3]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Tạo yêu cầu hoàn hàng thành công'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyOrder(Request $request)
    {
        $limit = $request->limit ?? 10;
        $ware = Warehouses::select('id')->where('user_id', Auth::id())->first();
        $type = $request->type ?? 'desc';
        $field = $request->field ?? 'order.id';
        $orders = Product::select('order.no', 'order_item.quantity', 'order.note', 'order_item.product_id', 'products.name as product_name', 'products.publish_id', 'order.id as order_id',
            'order.export_status', 'order.cancel_status')
            ->join('order_item', 'products.id', '=', 'order_item.product_id')
            ->join('order', 'order_item.order_id', '=', 'order.id')
            ->where('order.export_status', 5)
            ->where('order.status', '!=', 2)
            ->orderBy($field, $type)
            ->where('order_item.warehouse_id', $ware->id);
        if ($request->code) {
            $orders = $orders->where('order.no', $request->code);
        }
        $orders = $orders->paginate($limit);

        return response()->json([
            'success' => true,
            'data' => $orders,
            'field' => $field,
            'type' => $type
        ], 200);
    }


    public function createRequestDestroy(Request $request)
    {
        $products = Product::join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
            ->select('products.id', 'products.name', DB::raw('(amount - export) as in_stock'), 'warehouses.id as ware_id')
            ->where('warehouses.user_id', Auth::id())
            ->get();
        $arr = [];
        foreach ($products as $product) {
            $pause_product = (int)DB::table('request_warehouses')
                    ->selectRaw('SUM(quantity) as total')
                    ->join('order', 'request_warehouses.order_number', '=', 'order.order_number')
                    ->where('request_warehouses.product_id', $product->id)
                    ->where('request_warehouses.ware_id', $product->ware_id)
                    ->where('type', 2)
                    ->where('request_warehouses.status', 0)
                    ->first()->total ?? 0;
            $product->in_stock = $product->in_stock - $pause_product;
            if ($product->in_stock > 0) {
                $arr[] = $product;
            }
        }
        return response()->json([
            'success' => true,
            'data' => $arr
        ]);
    }

    public function storeRequestDestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'warehouse_id' => 'required',
            'note' => 'required|max:255'
        ], [
            'product_id.required' => 'Mã sản phẩm là bắt buộc',
            'quantity.required' => 'Số lượng sản phẩm hủy bắt buộc nhập',
            'quantity.numeric' => 'Số lượng sản phẩm hủy bắt buộc phải là số',
            'quantity.min' => 'Số lượng sản phẩm hủy bắt buộc lớn hơn 0',
            'warehouse_id.required' => 'ID kho hàng là bắt buộc',
            'note.required' => 'Lý do hủy hàng bắt buộc nhập',
            'note.max' => 'Lý do ít hơn 255 ký tự '
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }
        DB::beginTransaction();
        try {
            $requestDe = new RequestWarehouse();

            $requestDe->ncc_id = 0;
            $requestDe->product_id = $request->product_id;
            $requestDe->status = 1;
            $requestDe->type = 3;
            $requestDe->ware_id = $request->warehouse_id;
            $requestDe->quantity = $request->quantity;
            $requestDe->order_number = '';
            $code = 'YCXH' . rand(100000000, 999999999);

            while (true) {
                $re = RequestWarehouse::where('code', $code)->count();
                if ($re == 0) {
                    break;
                }
                $code = 'YCX' . rand(100000000, 999999999);
            }
            $requestDe->code = $code;
            $requestDe->note = $request->note;
            $requestDe->save();

            $productWare = ProductWarehouses::where('ware_id', $request->warehouse_id)->where('product_id', $request->product_id)->first();
            if (!$productWare) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }
            $pause_product = (int)DB::table('request_warehouses')
                    ->selectRaw('SUM(quantity) as total')
                    ->join('order', 'request_warehouses.order_number', '=', 'order.order_number')
                    ->where('request_warehouses.product_id', $request->product_id)
                    ->where('request_warehouses.ware_id', $request->warehouse_id)
                    ->where('type', 2)
                    ->where('request_warehouses.status', 0)
                    ->first()->total ?? 0;
            if ($productWare->amount - ($productWare->export + $pause_product) < $request->quantity) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng sản phẩm hủy phải nhỏ hơn ' . $productWare->amount - ($productWare->export + $pause_product)
                ], 400);
            } else {
                $productWare->export = $productWare->export + $request->quantity;

                $productWare->save();
                DB::commit();
            }

            return response()->json([
                'success' => true,
                'message' => 'Hủy sản phẩm thành công'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }

    }


    public function detailDestroyOrder(Request $request)
    {
        $orders = Product::select('order.no', 'order_item.quantity', 'order.note', 'order_item.product_id', 'products.name as product_name', 'products.publish_id', 'order.id')
            ->join('order_item', 'products.id', '=', 'order_item.product_id')
            ->join('order', 'order_item.order_id', '=', 'order.id')
            ->where('order.id', $request->id)
            ->first();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }


    public function exportBill(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:order,id',
        ], [
            'order_id.required' => 'Mã đơn hàng là bắt buộc',
            'order_id.exits' => 'Không tìm thấy đơn hàng'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $data = Order::query()
            ->select('order.order_number',
                'order.no',
                'order.fullname as name_customer',
                'order.address as address_customer',
                'order.phone as phone_customer',
                'order_item.quantity',
                'total',
                'order.method_payment',
                'shipping',
                'users.name as storage_name',
                'users.phone_number as storage_phone',
                'order.estimated_date'
            )
            ->selectSub('select province_name from province where  province_id = warehouses.city_id limit 1', 'province_boss_storage')
            ->selectSub('select district_name from district where  district_id = warehouses.district_id limit 1', 'district_id_boss_storage')
            ->selectSub('select wards_name from wards where  wards_id = warehouses.ward_id limit 1', 'ward_id_boss_storage')
            ->selectSub('select weight from products where  id = order_item.product_id limit 1', 'weight')
            ->selectSub('select name from products where  id = order_item.product_id limit 1', 'name')
            ->selectSub('select updated_at from request_warehouses where  order_number = order.order_number and type = 2 and status =1 limit 1', 'export_date')
            ->join('order_item', 'order_item.order_id', '=', 'order.id')
            ->join('warehouses', 'order_item.warehouse_id', '=', 'warehouses.id')
            ->join('users', 'warehouses.user_id', '=', 'users.id')
            ->where('order.status', '!=', 2)
            ->where('order.id', $request->order_id)
            ->first();


        if (!isset($data->no)) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng phù hợp'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => $data
        ], 200);

    }

}
