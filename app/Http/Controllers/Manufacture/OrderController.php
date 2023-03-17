<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\BillDetail;
use App\Models\Discount;
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
        $bills = BillDetail::join('bill_product', 'bill_details.id', '=', 'bill_product.bill_detail_id')
            ->join('products', 'bill_product.product_id', '=', 'products.id', '')
            ->where('products.user_id', Auth::id())
            ->select('products.publish_id', 'products.name', 'bill_details.code', 'bill_details.status', 'bill_product.price',
                'bill_product.quantity', 'bill_details.success_day', 'products.price as cost_price', 'bill_product.vshop_id',
                'bill_product.created_at', 'products.id', 'products.discount', 'products.discount_vShop')
//            ->groupBy('bill_product.id')
            ->orderBy('bill_product.created_at', 'desc')
            ->paginate($limit);

        //trang thái giao hàng 1 đang giao, 2 thành công ,3 hủy, đơn đang được xư lý vận chuyển chưa lấy hàng
        $being_transported = [200, 202, 300, 320, 400];
        $canceled = [107, 201];
        $successful_delivery = [501];
        foreach ($bills as $value) {
            if (in_array($value->status, $being_transported)) {
                $value->delivery_status = 1;
            } elseif (in_array($value->status, $canceled)) {
                $value->delivery_status = 3;
            } elseif (in_array($value->status, $successful_delivery)) {
                $value->delivery_status = 2;
            } else {
                $value->delivery_status = 4;
            }
            $discount = Discount::where('product_id', $value->id)
                ->where('start_date', '<=', $value->created_at)
                ->where('end_date', '>=', $value->created_at)
                ->where('type', 1)
                ->first();;
            $discount_code = $discount->discount ?? 0;

            $value->price_after_discount = $value->cost_price - ($value->cost_price / 100 * ($value->discount_vShop + $value->discount + $discount_code));
            $value->total = $value->quantity * $value->price;

        }
//        $bills= $bills->paginate(10);
//        return $bill;
        return view('screens.manufacture.order.index', compact('bills'));
    }

    public function destroy()
    {
        return view('screens.manufacture.order.destroy', []);

    }

    public function pending()
    {
        return view('screens.manufacture.order.pending', []);

    }

    public function order()
    {
        $orders = PreOrderVshop::with(['product'])
            ->select('status', 'quantity', 'place_name', 'fullname', 'phone', 'address', 'no', 'total', 'discount', 'deposit_money', 'created_at', 'product_id', 'id')
            ->where('ncc_id', Auth::id())
            ->orderBy('id', 'desc')
            ->paginate(10);;
        return view('screens.manufacture.order.order', [
            'orders' => $orders
        ]);
    }

    public function detailOrder($id)
    {
        $orders = PreOrderVshop::with(['product'])
            ->select('status', 'quantity', 'place_name', 'fullname', 'phone', 'address', 'no', 'total', 'discount', 'deposit_money', 'created_at', 'product_id', 'id')
            ->where('ncc_id', Auth::id())
            ->where('id', $id)
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
