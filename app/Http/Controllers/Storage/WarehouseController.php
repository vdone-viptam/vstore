<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    //

    public function importProduct(Request $request)
    {
        $limit = $request->limit ?? 10;
        $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();

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
            ->orderBy('request_warehouses.id', 'desc');
        if ($request->code) {
            $requests = $requests->where('request_warehouses.code', $request->code);
        }
        $requests = $requests->paginate($limit);
        return view('screens.storage.warehouse.import', [
            'requests' => $requests
        ]);
    }

    public function exportProduct(Request $request)
    {
        $limit = $request->limit ?? 10;
        $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();
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
            ->orderBy('request_warehouses.status', 'asc');
        if ($request->code) {
            $requests = $requests->where('request_warehouses.code', $request->code);
        }
        $requests = $requests->paginate($limit);
        return view('screens.storage.warehouse.export', [
            'requests' => $requests
        ]);

    }

    public function exportDestroyProduct(Request $request)
    {
        $limit = $request->limit ?? 10;
        $warehouses = Warehouses::select('id')->where('user_id', Auth::id())->first();
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
            ->orderBy('request_warehouses.id', 'desc');
        if ($request->code) {
            $requests = $requests->where('request_warehouses.code', $request->code);
        }
        $requests = $requests->paginate($limit);

        return view('screens.storage.warehouse.export_destroy', [
            'requests' => $requests
        ]);
    }

    public function destroyOrder(Request $request)
    {
        $limit = $request->limit ?? 10;
        $ware = Warehouses::select('id')->where('user_id', Auth::id())->first();
        $orders = Product::select('order.no', 'order_item.quantity', 'order.note', 'order_item.product_id', 'products.name as product_name', 'products.publish_id', 'order.id as order_id',
            'order.export_status', 'order.cancel_status')
            ->join('order_item', 'products.id', '=', 'order_item.product_id')
            ->join('order', 'order_item.order_id', '=', 'order.id')
            ->where('order.export_status', 5)
            ->where('order.status', '!=', 2)
            ->where('order_item.warehouse_id', $ware->id);
        if ($request->code) {
            $orders = $orders->where('order.no', $request->code);
        }
        $orders = $orders->paginate($limit);

        return view('screens.storage.warehouse.order_destroy', [
            'orders' => $orders
        ]);
    }

}
