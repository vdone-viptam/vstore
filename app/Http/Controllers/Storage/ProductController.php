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

        $products = $products->paginate($limit);

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
}
