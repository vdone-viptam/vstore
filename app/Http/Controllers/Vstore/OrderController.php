<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $this->v['field'] = $request->field ?? 'order.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 1;
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['orders'] = Order::join('order_item', 'order.id', '=', 'order_item.order_id')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('no', 'products.name', 'categories.name as cate_name', 'order.id',
                'order_item.price', 'quantity', 'total', 'order.created_at',
                'estimated_date', 'products.discount', 'export_status', DB::raw('(products.discount * total) as money'))->where('order.status', '!=', 2);
        if (strlen($this->v['key_search']) > 0) {
            $this->v['orders'] = $this->v['orders']->where(function ($query) {
                $query->where('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('order.no', 'like', $this->v['key_search']);
            });
        }
        $this->v['orders'] = $this->v['orders']->orderBy($this->v['field'], $this->v['type'])->paginate($this->v['limit']);

        return view('screens.vstore.order.index', $this->v);
    }

    public function detail(Request $request)
    {
        $this->v['order'] = Warehouses::join('order', 'warehouses.id', '=', 'order.warehouse_id')->join('order_item', 'order.id', '=', 'order_item.order_id')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('order.id', $request->id)
            ->select('no', 'products.name', 'categories.name as cate_name', 'warehouses.name as ware_name',
                'order_item.price', 'quantity', 'total', 'order.created_at',
                'estimated_date', 'products.discount', 'export_status', DB::raw('(products.discount * total) as money'))->where('order.status', '!=', 2)->first();

        return response()->json(['view' => view('screens.vstore.order.detail', $this->v)->render()]);
    }

    public function new()
    {
        return view('screens.vstore.order.new');
    }
}
