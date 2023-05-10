<?php

namespace App\Http\Controllers;

use App\Models\BlanceChange;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
/**
 * @group accountant
 *
 * Danh sách api liên quan tới kế toán
 */
class AccountingController extends Controller
{
    public  function confirmed(Request $request,$code){
        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric|min:1|max:2',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $deposits = Deposit::where('code',$code)->first();
        if ($deposits && $deposits->status ==0){

            $deposits->status = $request->status;
            $deposits->save();
            $user = User::find($deposits->user_id);
            if ($request->status == 2){

                $user->money += $deposits->amount;
                $user->save();
            }elseif ($request->status == 1){
                $balance_change_history = new BlanceChange();
                $balance_change_history->type = 2;
                $balance_change_history->title = 'Rút tiền về tài khoản ngân hàng';
                $balance_change_history->user_id=$deposits->user_id;
                $balance_change_history->money_history = $deposits->amount;
                $balance_change_history->code=$deposits->code;
                $balance_change_history->save();
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'Lệnh rút tiền không tồn tại hoặc đã xác nhận',
            ],400);
        }
        return response()->json([
            'status_code' => 201,
            'message' => 'Cập nhật trạng thái rút tiền thành công',
        ],200);
    }

    // Nhận trạng thái xác nhận từ kế toán 1 đồng ý, 2 từ chối
    /**
     * Bill
     *
     * API dùng để nhận trạng thái xác nhận từ kế toán 1 đồng ý, 2 từ chối
     *
     * @param Request $request
     * @param  $id mã người dùng
     * @bodyParam status 1 đồng ý, 2 ừ chối
     * @return JsonResponse
     */
    public function confirmedVstore(Request $request, $code){
        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric|min:1|max:2',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $user = User::where('trading_code',$code)->where('role_id',3)->first();
        if ($user){
            $user->accountant_confirm= $request->status;
            $user->save();
        }elseif (!$user){
            return response()->json([
                'status_code' => 404,
                'message' => 'the account does not exist or does not have vstore permission',
            ],400);
        }
        return response()->json([
            'status_code' => 201,
            'message' => 'success',
        ],200);
    }
}
