<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\RequestWarehouse;
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
            ->whereIn('request_warehouses.type', [1, 10])
            ->where('request_warehouses.ware_id', $warehouses->id)
            ->where('request_warehouses.status', 0)
            ->orderBy('request_warehouses.id', 'desc')->paginate($request->limit);
        return view('screens.storage.dashboard.index', [
            'success' => true,
            'requestEx' => $requestEx,
            'requestIm' => $requestIm,
            'productOutStock' => $productOutStock,
            'products' => $products]);
    }

    public function searchAllByKeyword(Request $request)
    {
        $key_search = trim($request->key_search) ?? '';

        if (strpos($key_search, 'YCN') !== false) {
            $query = RequestWarehouse::select('status')->where('code', $key_search)->first();
            if ($query) {
                if ($query->status == 0) {
                    return response()->json([
                        'href' => route('screens.storage.product.request', ['key_search' => $key_search])
                    ]);
                } else {
                    return response()->json([
                        'href' => route('screens.storage.warehouse.import', ['key_search' => $key_search])
                    ]);
                }
            }
            return response()->json([
                'message' => 'Không tim thấy kết quả phù hợp'
            ], 404);

        } else if (strpos($key_search, 'YCHH') !== false) {
            return response()->json([
                'href' => route('screens.storage.warehouse.import', ['key_search' => $key_search])
            ]);
        } else if (strpos($key_search, 'YCXH') !== false) {
            $query = RequestWarehouse::select('status')->where('code', $key_search)->first();
            if ($query) {
                return response()->json([
                    'href' => route('screens.storage.warehouse.exportDestroyProduct', ['key_search' => $key_search])
                ]);
            }
            return response()->json([
                'message' => 'Không tim thấy kết quả phù hợp'
            ], 404);

        } else if (strpos($key_search, 'YCX') !== false) {
            $query = RequestWarehouse::select('status')->where('code', $key_search)->first();
            if ($query) {
                return response()->json([
                    'href' => route('screens.storage.warehouse.export', ['key_search' => $key_search])
                ]);
            }
            return response()->json([
                'message' => 'Không tim thấy kết quả phù hợp'
            ], 404);

        } else if (strpos($key_search, 'VN-') !== false) {
            $query = Warehouses::join('product_warehouses', 'warehouses.id', '=', 'product_warehouses.ware_id')
                ->join('products', 'product_warehouses.product_id', '=', 'products.id')
                ->where('product_warehouses.status', 1)
                ->where('warehouses.user_id', Auth::id())
                ->where('products.publish_id', $key_search)
                ->first();
            if ($query) {
                return response()->json([
                    'href' => route('screens.storage.product.index', ['key_search' => $key_search])]);
            } else {
                return response()->json([
                    'message' => 'Không tim thấy kết quả phù hợp'
                ], 404);
            }

        } else if (!strpos($key_search, 'YC') && strlen($key_search) == 13) {
            $query1 = Order::select('export_status')->where('no', $key_search)->first();
            if ($query1) {
                if ($query1->export_status == 5) {
                    return response()->json([
                        'href' => route('screens.storage.warehouse.destroyOrder', ['key_search' => $key_search])
                    ]);
                } else {
                    return response()->json([
                        'href' => route('screens.storage.product.requestOut', ['key_search' => $key_search])
                    ]);
                }
            }
            return response()->json([
                'message' => 'Không tim thấy kết quả phù hợp'
            ], 404);
        } else {
            return response()->json([
                'message' => 'Mã yêu cầu không hợp lệ'
            ], 404);
        }
    }
}
