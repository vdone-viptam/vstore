<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $orders = Order::with(['orderItem.product',
            'orderItem.vshop',
            'orderItem.warehouse',
            'orderItem'])->select(
            'no', 'id', 'export_status', 'created_at'
        )
            ->where('order.status', '!=', 2)
            ->paginate($limit);
        $key_search = $request->key_search ?? '';
        return view('screens.vstore.order.index', compact('orders', 'key_search'));
    }

    public function new()
    {
        return view('screens.vstore.order.new');
    }
}
