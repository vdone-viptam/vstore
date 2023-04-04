<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\RequestWarehouse;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    //


    public function importProduct()
    {
        $limit = $request->limit ?? 10;
        $requests = User::join('products', 'users.id', '=', 'products.user_id')
            ->select(
                'request_warehouses.code',
                'products.publish_id',
                'products.name as product_name',
                'users.name as ncc_name',
                'quantity',
                'request_warehouses.status',
                'request_warehouses.created_at',
                'request_warehouses.id'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->where('type', 1)
            ->whereIn('request_warehouses.status', [5, 1])
            ->orderBy('request_warehouses.id', 'desc')
            ->paginate($limit);
        return response()->json([
            'success' => true,
            'data' => $requests
        ], 200);
    }

    public function exportProduct()
    {
        $limit = $request->limit ?? 10;
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
                'request_warehouses.order_number'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->where('type', 2)
            ->orderBy('request_warehouses.status', 'asc')
            ->paginate($limit);
        return response()->json([
            'success' => true,
            'data' => $requests
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

    public function exportDestroyProduct()
    {
        $limit = $request->limit ?? 10;
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
            ->orderBy('request_warehouses.id', 'desc')
            ->paginate($limit);
        return response()->json([
            'success' => true,
            'data' => $requests
        ], 200);
    }

    public function destroyOrder()
    {
        $limit = $request->limit ?? 10;
        $ware = Warehouses::select('id')->where('user_id', Auth::id())->first();
        $orders = Product::select('order.no', 'order_item.quantity', 'order.note', 'order_item.product_id', 'products.name as product_name', 'products.publish_id')
            ->join('order_item', 'products.id', '=', 'order_item.product_id')
            ->join('order', 'order_item.order_id', '=', 'order.id')
            ->where('order.export_status', 3)
            ->where('order.status', '!=', 2)
            ->where('order_item.warehouse_id', $ware->id)
            ->paginate($limit);

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

}
