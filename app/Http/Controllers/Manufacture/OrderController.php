<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PreOrderVshop;
use App\Models\Product;
use Carbon\Carbon;
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
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $this->v['field'] = $request->field ?? 'order.export_status';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['orders'] = Order::join('order_item', 'order.id', '=', 'order_item.order_id')
            ->join('products', 'order_item.product_id', '=', 'products.id')
            ->select('order.no', 'order.id', 'order.export_status', 'order.created_at', 'products.name', 'order_item.price', 'total', DB::raw('order_item.price * order_item.quantity * (100 - products.discount - products.discount_vShop) / 100 as money'))
            ->where('order.status', '!=', 2)
            ->where('products.user_id', Auth::id())
            ->where('products.discount', '!=', null)
            ->where('products.discount_vShop', '!=', null)
            ->groupBy('order.id')
            ->orderBy($this->v['field'], $this->v['type']);

        if (strlen($this->v['key_search']) > 0) {
            $this->v['orders'] = $this->v['orders']->where(function ($sub) {
                $sub->where('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('order.no', $this->v['key_search']);
            });
        }
        $this->v['orders'] = $this->v['orders']->paginate($this->v['limit']);

        return view('screens.manufacture.order.index', $this->v);
    }

    public function destroy()
    {
        return view('screens.manufacture.order.destroy', []);
    }

    public function pending(Request $request)
    {
        $key_search = $request->key_search ?? '';
        $limit = $request->limit ?? 10;
        $orders = Order::with([
            'orderItem.product',
            'orderItem.vshop',
            'orderItem.warehouse',
            'orderItem'])->select(
            'no', 'id', 'export_status', 'created_at', 'total'
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
                    ->orWhere('no', $key_search);
            });
        }
        $orders = $orders->orderBy('id', 'desc')->paginate($limit);

        return view('screens.manufacture.order.pending', ['orders' => $orders]);
    }

    public function order(Request $request)
    {
        $this->v['field'] = $request->field ?? 'pre_order_vshop.id';
        $this->v['type'] = $request->type ?? 'desc';

        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = $request->key_search ?? '';

        $this->v['orders'] = PreOrderVshop::with(['product'])
            ->select('pre_order_vshop.status', 'quantity',
                'place_name', 'fullname', 'phone', 'address', 'no',
                'total', 'pre_order_vshop.discount', DB::raw('(total - (total * pre_order_vshop.discount / 100)) * (pre_order_vshop.deposit_money / 100) as deposit_money'),
                'pre_order_vshop.created_at', 'product_id', 'pre_order_vshop.id', DB::raw('total - (total * pre_order_vshop.discount / 100) * (pre_order_vshop.deposit_money / 100) as money'))
            ->join('products', 'pre_order_vshop.product_id', '=',
                'products.id')
            ->whereIn('pre_order_vshop.status', [1, 4])
            ->where('products.user_id', Auth::id())
            ->orderBy($this->v['field'], $this->v['type']);
        if (strlen($this->v['key_search']) > 0) {
            $this->v['orders'] = $this->v['orders']->where(function ($sub) {
                $sub->where('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('pre_order_vshop.no', $this->v['key_search']);
            });
        }
        $this->v['orders'] = $this->v['orders']->paginate($this->v['limit']);;
        return view('screens.manufacture.order.order', $this->v);
    }

    // clone from order
    public function requestOrders(Request $request)
    {
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        // kiểm tra thêm status = 3 là đơn hàng mới và cần duyệt
        $this->v['field'] = $request->field ?? 'pre_order_vshop.id';
        $this->v['type'] = $request->type ?? 'desc';

        $limit = $request->limit ?? 10;
        $this->v['key_search'] = $request->key_search ?? '';

        $this->v['orders'] = PreOrderVshop::with(['product'])
            ->select('pre_order_vshop.status', 'quantity',
                'place_name', 'fullname', 'phone', 'address', 'no',
                'total', 'pre_order_vshop.discount', DB::raw('(total - (total * pre_order_vshop.discount / 100)) * (pre_order_vshop.deposit_money / 100) as deposit_money'),
                'pre_order_vshop.created_at', 'product_id', 'pre_order_vshop.id', DB::raw('total - (total * pre_order_vshop.discount / 100) * (pre_order_vshop.deposit_money / 100) as money'))
            ->join('products', 'pre_order_vshop.product_id', '=',
                'products.id')
            ->where('products.user_id', Auth::id())
            ->whereIn('pre_order_vshop.status', [3, 5])
            ->orderBy($this->v['field'], $this->v['type']);
        if (strlen(($this->v['key_search']) > 0)) {
            $this->v['orders'] = $this->v['orders']->where(function ($sub) {
                $sub->where('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('no', $this->v['key_search']);
            });
        }
        $this->v['orders'] = $this->v['orders']->paginate($limit);
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['params'] = $request->all();

        return view('screens.manufacture.order.request', $this->v);
    }


    public function detailOrder($id)
    {
        $orders = PreOrderVshop::with(['product'])
            ->select(
                'pre_order_vshop.status',
                'quantity',
                'place_name',
                'fullname',
                'phone',
                'address',
                'no',
                'total',
                'pre_order_vshop.discount',
                'pre_order_vshop.deposit_money',
                'pre_order_vshop.created_at',
                'product_id',
                'pre_order_vshop.id'
            )
            ->join('products', 'pre_order_vshop.product_id', '=', 'products.id')
            ->where('products.user_id', Auth::id())
            ->where('pre_order_vshop.id', $id)
            ->first();
        return $orders;
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
