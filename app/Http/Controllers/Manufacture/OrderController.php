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
    public function __construct()
    {
        $this->v = [];
    }
    public function index(Request $request)
    {
        $key_search = $request->key_search ?? '';
        $limit = $request->limit ?? 10;
        $orders = Order::with(['orderItem.product',
            'orderItem.vshop',
            'orderItem.warehouse',
            'orderItem'])->select(
            'no', 'id', 'export_status', 'created_at','estimated_date'
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
        $orders = $orders->orderBy('id', 'desc')->paginate($limit);
        return view('screens.manufacture.order.index',compact('key_search'), ['orders' => $orders]);
    }

    public function destroy()
    {
        return view('screens.manufacture.order.destroy', []);

    }

    public function pending(Request $request)
    {
        $key_search = $request->key_search ?? '';
        $limit = $request->limit ?? 10;
        $orders = Order::with(['orderItem.product',
            'orderItem.vshop',
            'orderItem.warehouse',
            'orderItem'])->select(
            'no', 'id', 'export_status', 'created_at'
        )
            ->where('order.status', '!=', 2)
            ->where('export_status', '!=', 4);
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
        $orders = $orders->orderBy('id', 'desc')->paginate($limit);

        return view('screens.manufacture.order.pending', ['orders' => $orders]);

    }

    public function order(Request $request)
    {
        $this->v['field'] = $request->field ?? 'pre_order_vshop.id';
        $this->v['type'] = $request->type ?? 'desc';

        $limit = $request->limit ?? 10;
        $key_search = $request->key_search ?? '';

        $this->v['orders'] = PreOrderVshop::with(['product'])
            ->select('pre_order_vshop.status', 'quantity',
                'place_name', 'fullname', 'phone', 'address', 'no',
                'total', 'pre_order_vshop.discount', 'pre_order_vshop.deposit_money',
                'pre_order_vshop.created_at', 'product_id', 'pre_order_vshop.id')
            ->join('products', 'pre_order_vshop.product_id', '=',
                'products.id')
            ->where('products.user_id', Auth::id())
            ->orderBy($this->v['field'], $this->v['type']);
        if ($key_search && strlen(($key_search) > 0)) {
            $this->v['orders'] = $this->v['orders']->where(function ($sub) use ($key_search) {
                $sub->where('products.name', 'like', '%' . $key_search . '%')
                    ->orWhere('no', 'like', '%' . $key_search . '%');
            });
        }
        $this->v['orders'] = $this->v['orders']->paginate($limit);;
        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['params'] = $request->all();
        return view('screens.manufacture.order.order', $this->v);
    }

    // clone from order
    public function requestOrders(Request $request)
    {
        // kiểm tra thêm status = 3 là đơn hàng mới và cần duyệt
        $this->v['field'] = $request->field ?? 'pre_order_vshop.id';
        $this->v['type'] = $request->type ?? 'desc';

        $limit = $request->limit ?? 10;
        $key_search = $request->key_search ?? '';

        $this->v['orders'] = PreOrderVshop::with(['product'])
            ->select('pre_order_vshop.status', 'quantity',
                'place_name', 'fullname', 'phone', 'address', 'no',
                'total', 'pre_order_vshop.discount', 'pre_order_vshop.deposit_money',
                'pre_order_vshop.created_at', 'product_id', 'pre_order_vshop.id')
            ->join('products', 'pre_order_vshop.product_id', '=',
                'products.id')
            ->where('products.user_id', Auth::id())
            ->where('pre_order_vshop.status', 3)
            ->orderBy($this->v['field'], $this->v['type']);
        if ($key_search && strlen(($key_search) > 0)) {
            $this->v['orders'] = $this->v['orders']->where(function ($sub) use ($key_search) {
                $sub->where('products.name', 'like', '%' . $key_search . '%')
                    ->orWhere('no', 'like', '%' . $key_search . '%');
            });
        }
        $this->v['orders'] = $this->v['orders']->paginate($limit);;
        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['params'] = $request->all();
        return view('screens.manufacture.order.request', $this->v);
    }


    public function detailOrder($id)
    {
        $orders = PreOrderVshop::with(['product'])
            ->select('pre_order_vshop.status', 'quantity', 'place_name',
                'fullname', 'phone', 'address', 'no', 'total',
                'pre_order_vshop.discount', 'pre_order_vshop.deposit_money',
                'pre_order_vshop.created_at', 'product_id', 'pre_order_vshop.id')
            ->join('products', 'pre_order_vshop.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::id())
            ->where('pre_order_vshop.id', $id)
            ->first();
        return $orders ;
        // return view('screens.manufacture.order.detail', [
        //     'order' => $orders
        // ]);
    }

    public function updateOrder($id, Request $request)
    {
        DB::beginTransaction();
        try {
            PreOrderVshop::where('id', $id)->update(['status' => $request->status]);
            DB::commit();
            return response()->json([
                'message' => 'update success'
            ]);
            // return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
        }
    }


}
