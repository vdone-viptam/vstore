<?php

namespace App\Http\Controllers;

use App\Models\BlanceChange;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            if ($request->status == 2){
                $user = User::find($deposits->user_id);

                $balance_change_history = new BlanceChange();
                $balance_change_history->type = 1;
                $balance_change_history->title = 'Hoàn tiền do admin từ trối lệnh rút tiền';
                $balance_change_history->user_id=$deposits->user_id;
                $balance_change_history->money_history = $user->money;

                $user->money += $deposits->amount;
                $user->save();


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
}
