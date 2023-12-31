<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $warehouses = Warehouses::where('user_id', Auth::id())->first();
        $publish_id = $request->publish_id;
        $requestEx = Product::join('order_item', 'products.id', '=', 'order_item.product_id')
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
            );

        $requestEx = $requestEx->where('order.status', '!=', 2)
            ->where('export_status', 0)
            ->where('order_item.warehouse_id', $warehouses->id)
            ->count();
        $requestIm = User::join('products', 'users.id', '=', 'products.user_id')
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
            ->where('request_warehouses.status', 0)
            ->where('type', 1)
            ->where('request_warehouses.ware_id', $warehouses->id)
            ->count();
        $productOutStock = count(DB::select(DB::raw("
        SELECT amount - export - (SELECT IFNULL(SUM(quantity),0)
                                  FROM request_warehouses WHERE `status` = 0
                                                            AND type = 2 AND ware_id = $warehouses->id
                                                            AND product_id = product_warehouses.product_id) as 'total'
        FROM product_warehouses
        WHERE ware_id = $warehouses->id HAVING total <= 10
        "))) ?? 0;

        $products = User::join('products', 'users.id', '=', 'products.user_id')
            ->select(
                'request_warehouses.code',
                'products.publish_id',
                'products.name as product_name',
                'users.name as ncc_name',
                'quantity',
                'request_warehouses.status',
                'request_warehouses.created_at',
                'request_warehouses.type',
                'request_warehouses.id',
                'products.sku_id'
            );
        $products = $products->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')
            ->whereIn('request_warehouses.type', [1, 10, 2, 3])
            ->where('request_warehouses.ware_id', $warehouses->id)
            ->whereIn('request_warehouses.status', [7, 0])
            ->orderBy('request_warehouses.id', 'desc')
            ->paginate($request->limit ?? 10);
        return view('screens.storage.dashboard.index', [
            'success' => true,
            'requestEx' => $requestEx,
            'requestIm' => $requestIm,
            'productOutStock' => $productOutStock,
            'products' => $products]);
    }
}
