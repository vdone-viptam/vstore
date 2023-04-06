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
                ->select('users.name', 'account_code', 'province.province_name', 'users.id as user_id',
                    DB::raw('count(*) as count_product'),
                    DB::raw('sum(product_warehouses.amount - product_warehouses.export) as amount_product')
                )
                ->join('province', 'users.provinceId', '=', 'province.province_id')
                ->join('products', 'users.id', '=', 'products.user_id')
                ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
                ->where('ware_id', $id);
            if (isset($request->search)) {
                $ncc = $ncc->where(function ($query) use ($search) {
                    $query->where('users.name', 'like', '%' . $search . '%')
                        ->orWhere('users.account_code', 'like', '%' . $search . '%');
                });
            }
            $ncc = $ncc->groupBy(['users.name', 'account_code'])
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
                'user_id' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }
            $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;
            $ncc = User::query()
                ->select('users.name', 'account_code', 'province.province_name', 'users.id as user_id',
                    DB::raw('count(*) as count_product'),
                    DB::raw('sum(product_warehouses.amount - product_warehouses.export) as amount_product')
                )
                ->join('province', 'users.provinceId', '=', 'province.province_id')
                ->join('products', 'users.id', '=', 'products.user_id')
                ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
                ->where('ware_id', $id);

            $result = $ncc->where('products.user_id', $request->user_id)->first();

            if (!isset($result->account_code)) {

                $ncc = User::query()
                    ->select('users.name', 'account_code', 'province.province_name', 'users.id as user_id',
                        DB::raw('count(*) as count_product'),
                        DB::raw('sum(product_warehouses.amount - product_warehouses.export) as amount_product')
                    )
                    ->join('province', 'users.provinceId', '=', 'province.province_id')
                    ->join('products', 'users.id', '=', 'products.user_id')
                    ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
                    ->where('ware_id', $id)->where('users.account_code', $request->user_id)->first();
                if (!isset($ncc->account_code)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy nhà cung cấp'
                    ]);
                }
            } else {
                $ncc = $result;
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
                'limit' => 'numeric|min:1',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }
            $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;

            $limit = $request->limit ?? 10;
            $ncc = OrderItem::query()
                ->select('products.id as product_id',
                    'delivery_partner.name_partner', 'delivery_partner.code_partner', 'delivery_partner.id as delivery_partner_id',
                    DB::raw('count(*) as count_product'),
                )
                ->selectSub('select COUNT(order.id) from `order` join order_item on order.id = order_item.order_id
                 where export_status=3 or export_status=5 and order_item.warehouse_id =' . $id . ' and delivery_partner_id= delivery_partner.id', 'destroy_order')
                ->join('products', 'order_item.product_id', 'products.id')
                ->join('order', 'order.id', 'order_item.order_id')
                ->join('delivery_partner', 'delivery_partner.id', 'order_item.delivery_partner_id')
                ->where('order_item.warehouse_id', $id)
                ->where('order.export_status', 4);
            $ncc = $ncc->groupBy(['delivery_partner_id'])
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
     * chi tiết đối tác giao hàng
     *
     * API này sẽ trả về chi tiết đối tác giao hàng
     *
     * @param Request $request \
     * @bodyParam delivery_partner_id id đối tác giao hàng
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailDeliveryPartner(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'delivery_partner_id' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'messageError' => $validator->errors(),
                ], 401);
            }
            $id = Warehouses::select('id')->where('user_id', Auth::id())->first()->id;

            $data = OrderItem::query()
                ->select(DB::raw('count(*) as count_product'),
                    'delivery_partner.name_partner', 'delivery_partner.code_partner', 'delivery_partner.id as delivery_partner_id',
                )
                ->selectSub('select COUNT(order.id) from `order` join order_item on order.id = order_item.order_id
                 where export_status=3 or export_status=5 and order_item.warehouse_id =' . $id . ' and delivery_partner_id= delivery_partner.id', 'destroy_order')
                ->join('products', 'order_item.product_id', '=', 'products.id')
                ->join('delivery_partner', 'delivery_partner.id', 'order_item.delivery_partner_id')
                ->join('order', 'order.id', '=', 'order_item.order_id')
                ->join('warehouses', 'warehouses.id', '=', 'order.warehouse_id')
                ->where('order.export_status', 4)
                ->where('warehouses.user_id', Auth::id());
            $result = $data->where('delivery_partner.id', $request->delivery_partner_id)->get();

            if (!strlen($result[0]->delivery_partner_id) && isset($result[0]->delivery_partner_id)) {
                $data = OrderItem::query()
                    ->select(DB::raw('count(*) as count_product'),
                        'delivery_partner.name_partner', 'delivery_partner.code_partner', 'delivery_partner.id as delivery_partner_id',
                    )
                    ->selectSub('select COUNT(order.id) from `order` join order_item on order.id = order_item.order_id
                 where export_status=3 or export_status=5 and order_item.warehouse_id =' . $id . ' and delivery_partner_id= delivery_partner.id', 'destroy_order')
                    ->join('products', 'order_item.product_id', '=', 'products.id')
                    ->join('delivery_partner', 'delivery_partner.id', 'order_item.delivery_partner_id')
                    ->join('order', 'order.id', '=', 'order_item.order_id')
                    ->join('warehouses', 'warehouses.id', '=', 'order.warehouse_id')
                    ->where('order.export_status', 4)
                    ->where('warehouses.user_id', Auth::id())->where('delivery_partner.code_partner', $request->delivery_partner_id)->get();
                if (!strlen($data[0]->delivery_partner_id) && isset($data[0]->delivery_partner_id)) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy đối tác giao hàng'
                    ]);
                }
            } else {
                $data = $result;
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
