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
        $key_search = $request->key_search ?? '';
        $limit = $request->limit ?? 10;
        $orders = Order::with(['orderItem.product',
            'orderItem.vshop',
            'orderItem.warehouse',
            'orderItem'])->select(
            'no', 'id', 'export_status', 'created_at'
        )
            ->where('order.status', '!=', 2);
        if ($key_search && strlen(($key_search) > 0)) {
            $orders->where(function ($sub) use ($key_search) {
                $sub->whereHas('orderItem.vshop', function ($query) use ($key_search) {
                    $query->where('nick_name', 'like', '%' . $key_search . '%');
                })
                    ->orWhereHas('orderItem.product', function ($query) use ($key_search) {
                        $query->where('name', 'like', '%' . $key_search . '%');
                    })
                    ->orWhere('no', 'like', '%' . $key_search . '%');
            });
        }
        $orders = $orders->paginate($limit);
//        ->whereHas('books', function (Builder $query) {
//        $query->where('title', 'like', 'PHP%');
//    })

        return view('screens.vstore.order.index', compact('orders', 'key_search'));
    }

    public function new()
    {
        return view('screens.vstore.order.new');
    }
}
