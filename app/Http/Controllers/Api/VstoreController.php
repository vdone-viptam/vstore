<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
/**
 * @group Vstore
 *
 * Danh sách api liên quan nhà phân phối vstore
 */
class VstoreController extends Controller
{
    //
    /**
     * Danh sách nhà vstore
     *
     * API này sẽ trả về sách vstore
     *
     * @param Request $request
     * @urlParam page Số trang
     * @urlParam limit Giới hạn bản ghi trên một trang
     * @return JsonResponse
     */
    public function index(){
        $limit = $request->limit ?? 10;
        $user = User::where('role_id',3)->where('account_code','!=',null)->paginate($limit);
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);
    }
}
