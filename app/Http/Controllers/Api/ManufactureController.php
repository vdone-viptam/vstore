<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    /**
     * Danh sách nhà cung cấp
     *
     * API này sẽ trả về sách Nhà cung cấp
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @return JsonResponse
     */
    public function index(Request $request){
        $limit = $request->limit ?? 10;
        $user = User::where('role_id',2)->where('account_code','!=',null)->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);
    }
    public function detail(Request $request,$id){
        $user = User::find($id);
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);
    }
}
