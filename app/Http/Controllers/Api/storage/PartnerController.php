<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * danh sách Nhà cung cấp
     *
     * API này sẽ trả về danh sách Nhà cung cấp
     *
     * @param Request $request
     * @bodyParam search : tìm kiếm qua mã, tên ncc
     * @bodyParam limit tổng số review / 1 trang
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'search' => 'max:200',
                'limit' => 'numeric|min:1',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }
            $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;
            $search = $request->search;
            $limit = $request->limit ?? 10;
            $ncc = User::query()
                ->select('users.name', 'account_code','province.province_name','users.id as user_id',
                        DB::raw('count(*) as count_product'),
                        DB::raw('sum(product_warehouses.amount - product_warehouses.export) as amount_product')
                    )
                ->join('province', 'users.provinceId', '=', 'province.province_id')
                ->join('products', 'users.id', '=', 'products.user_id')
                ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
                ->where('ware_id', $id);
            if(isset($request->search)){
                $ncc= $ncc->where(function ($query) use ($search) {
                                $query->where('users.name', 'like','%'. $search . '%')
                                    ->orWhere('users.account_code','like','%'. $search . '%');
                                });
            }
            $ncc= $ncc->groupBy(['users.name', 'account_code'])
                ->paginate($limit);

            return response()->json(['success' => true, 'data' => $ncc]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * chi tiết Nhà cung cấp
     *
     * API này sẽ trả về chi tiết Nhà cung cấp
     *
     * @param Request $request
     * @bodyParam user_id : user id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailNcc(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }
            $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;
            $ncc = User::query()
                ->select('users.name', 'account_code','province.province_name','users.id as user_id',
                        DB::raw('count(*) as count_product'),
                        DB::raw('sum(product_warehouses.amount - product_warehouses.export) as amount_product')
                    )
                ->join('province', 'users.provinceId', '=', 'province.province_id')
                ->join('products', 'users.id', '=', 'products.user_id')
                ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
                ->where('ware_id', $id)
                ->where('products.user_id', $request->user_id)->first();

            return response()->json(['success' => true, 'data' => $ncc]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * danh sách đối tác giao hàng
     *
     * API này sẽ trả về danh sách đối tác giao hàng
     *
     * @param Request $request
     * @bodyParam limit tổng số review / 1 trang
     * @return \Illuminate\Http\JsonResponse
     */
    public function deliveryPartner(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // 'search' => 'max:200',
                'limit' => 'numeric|min:1',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }
            $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;
            // $search = $request->search;
            $limit = $request->limit ?? 10;
            $ncc = OrderItem::query()
                ->select('products.id as product_id',
                        DB::raw('count(*) as count_product'),
                    )
                ->join('products', 'order_item.product_id', '=', 'products.id')
                // sau này còn phải join đên delivery_partner để lấy các mã ncc khác viettel post !
                ->join('order', 'order.id', '=', 'order_item.order_id')
                ->where('order_item.warehouse_id', $id)
                ->where('order.export_status', 4);
            $ncc= $ncc->groupBy(['product_id'])
                ->paginate($limit);
            foreach ($ncc as $item)
            {
                $item->name_partner = "Viettel Post";
                $item->code_partner = "codevt";
                $item->partner_id = 1;
            }
            return response()->json(['success' => true, 'data' => $ncc]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * chi tiết đối tác giao hàng
     *
     * API này sẽ trả về chi tiết đối tác giao hàng
     *
     * @param Request $request\
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailDeliveryPartner(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // 'user_id' => 'required|exists:users,id',
                // 'partner_id' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }

            $data = OrderItem::query()
                ->select(DB::raw('count(*) as count_product'),
                    )
                ->join('products', 'order_item.product_id', '=', 'products.id')
                // sau này còn phải join đên delivery_partner để lấy các mã ncc khác viettel post !
                ->join('order', 'order.id', '=', 'order_item.order_id')
                ->join('warehouses', 'warehouses.id', '=', 'order.warehouse_id')
                ->where('warehouses.user_id', Auth::id())
                ->where('order.export_status', 4)->get();

            // $data= $data->groupBy(['products.id'])->get();
            foreach ($data as $item)
            {
                $item->name_partner = "Viettel Post";
                $item->code_partner = "codevt";
                $item->partner_id = 1;
            }
            return response()->json(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
