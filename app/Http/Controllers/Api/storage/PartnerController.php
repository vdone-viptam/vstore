<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;
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
                ->select('users.name', 'account_code','province.province_name',
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
}
