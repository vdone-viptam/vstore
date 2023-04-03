<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'request_warehouses.created_at',
                'request_warehouses.id'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->where('type', 1)
            ->where('request_warehouses.status', 1)
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
                'request_warehouses.created_at',
                'request_warehouses.id'
            )
            ->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->where('type', 2)
            ->where('request_warehouses.status', 1)
            ->orderBy('request_warehouses.id', 'desc')
            ->paginate($limit);
        return response()->json([
            'success' => true,
            'data' => $requests
        ], 200);
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
        $orders = OrderItem::with(['product'])
            ->select('order.no', 'order_item.quantity', 'order.note', 'order_item.product_id')
            ->join('order', 'order_item.order_id', '=', 'order.id')
            ->where('order.export_status', 10)
            ->where('order.status', 2)
            ->where('order_item.warehouse_id', $ware->id)
            ->paginate($limit);

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

}
