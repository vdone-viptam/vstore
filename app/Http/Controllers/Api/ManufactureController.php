<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


/**
 * @group Manufacture
 *
 * Danh sách api liên quan nhà cung cấp
 */
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
        $user = User::where('role_id',2)->where('account_code','!=',null)
            ->select('id','name','email','company_name','phone_number','address','avatar','banner')
            ->paginate($limit);
        if ($user){
            foreach ($user as $value){
                $value->avatar=asset($value->avatar);
                $value->banner=asset($value->banner);
            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);
    }
    /**
     * chi tiết nhà cung cấp
     *
     * API này sẽ trả về chi tiết nhà cung cấp
     *
     * @param $id id user
     * @return JsonResponse
     */
    public function detail($id){

        $user = User::where('id',$id)
            ->where('reole_id',2)
            ->select('id','name','avatar','banner','account_code','address','phone_number','company_name')
            ->first();
        if ($user){
            $user->avatar=asset('image/users/'.$user->avatar) ;
            $user->banner=asset('image/users/'.$user->banner) ;
        }
        return response()->json([
            'status_code' => 200,
            'data' => $user,

        ]);
    }
}
