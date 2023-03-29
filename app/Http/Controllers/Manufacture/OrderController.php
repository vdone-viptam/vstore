<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PreOrderVshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $orders = OrderItem::with(['product', 'vshop', 'warehouse', 'order'])->select('order_id',
            'product_id',
            'order_item.price',
            'quantity',
            'warehouse_id',
            'order_id',
            'vshop_id',
            'warehouse_id'
        )->join('products', 'order_item.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::id())
            ->orderBy('order_item.id', 'desc')->paginate($limit);

        return view('screens.manufacture.order.index', ['orders' => $orders]);
    }

    public function destroy()
    {
        return view('screens.manufacture.order.destroy', []);

    }

    public function pending()
    {
        $limit = $request->limit ?? 10;

        $orders = OrderItem::with(['product', 'vshop', 'warehouse', 'order'])->select('order_id',
            'product_id',
            'order_item.price',
            'quantity',
            'warehouse_id',
            'order_id',
            'vshop_id',
            'warehouse_id'
        )->where('products.user_id', Auth::id())
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->orderBy('order_item.id', 'desc')
            ->paginate($limit);
        return view('screens.manufacture.order.pending', ['orders' => $orders]);

    }

    public function order()
    {
        $orders = PreOrderVshop::with(['product'])
            ->select('pre_order_vshop.status', 'quantity', 'place_name', 'fullname', 'phone', 'address', 'no', 'total', 'pre_order_vshop.discount', 'pre_order_vshop.deposit_money', 'pre_order_vshop.created_at', 'product_id', 'pre_order_vshop.id')
            ->join('products', 'pre_order_vshop.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::id())
            ->orderBy('pre_order_vshop.id', 'desc')
            ->paginate(10);;
        return view('screens.manufacture.order.order', [
            'orders' => $orders
        ]);
    }

    public function detailOrder($id)
    {
        $orders = PreOrderVshop::with(['product'])
            ->select('pre_order_vshop.status', 'quantity', 'place_name', 'fullname', 'phone', 'address', 'no', 'total', 'pre_order_vshop.discount', 'pre_order_vshop.deposit_money', 'pre_order_vshop.created_at', 'product_id', 'pre_order_vshop.id')
            ->join('products', 'pre_order_vshop.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::id())
            ->where('pre_order_vshop.id', $id)
            ->first();
        return view('screens.manufacture.order.detail', [
            'order' => $orders
        ]);
    }

    public function updateOrder($id, Request $request)
    {
        DB::beginTransaction();
        try {
            PreOrderVshop::where('id', $id)->update(['status' => $request->status]);
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
        }
    }
}
