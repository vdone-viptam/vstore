<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\Discount;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $orders = OrderItem::with(['order', 'product', 'vshop'])
            ->select('order_id', 'product_id', 'vshop_id', 'quantity', 'order_item.discount_vshop', 'discount_ncc', 'discount_vstore', 'order_item.price')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->where('products.vstore_id', Auth::id());

        if ($request->condition && $request->condition == 1) {
            $orders = $orders->where('products.name', 'like', '%' . trim($request->key_word) . '%');
        }
        $orders = $orders->paginate($limit);
        $key_word = $request->key_word ?? '';
        return view('screens.vstore.order.index', compact('orders', 'key_word'));
    }

    public function new()
    {
        return view('screens.vstore.order.new');
    }
}
