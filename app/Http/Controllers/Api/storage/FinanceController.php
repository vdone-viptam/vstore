<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        $this->v['banks'] = DB::table('banks')->select('name', 'full_name', 'image', 'id')->get();
        $this->v['wallet'] = Wallet::select('bank_id', 'id', 'account_number', 'name')->where('user_id', Auth::id())->first();
        return response()->json([
            'success' => true,
            'data' => $this->v
        ]);
    }


    public function storeWall(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required',
            'bank_id' => 'required',
            'name' => 'required',
        ], [
            'account_number.required' => 'Số tài khoản bắt buộc nhập',
            'bank_id.required' => 'Ngân hàng bắt buộc chọn',
            'name.required' => 'Tên chủ tài khoản bắt buộc nhập',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 401);
        }

        DB::table('wallets')->insert([
            'account_number' => $request->account_number,
            'bank_id' => $request->bank_id,
            'user_id' => Auth::id(),
            'name' => $request->name
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Thêm mới ngân hàng thành công',
        ], 201);
    }

    public function updateWall(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required',
            'bank_id' => 'required',
            'name' => 'required',
        ], [
            'account_number.required' => 'Số tài khoản bắt buộc nhập',
            'bank_id.required' => 'Ngân hàng bắt buộc chọn',
            'name.required' => 'Tên chủ tài khoản bắt buộc nhập',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 401);
        }
        DB::table('wallets')->where('id', $id)->update([
            'account_number' => $request->account_number,
            'bank_id' => $request->bank_id,
            'user_id' => Auth::id(),
            'name' => $request->name
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật ngân hàng thành công',
        ], 201);
    }

    public function history()
    {
        $this->v['histories'] = Deposit::select('name', 'amount', 'id', 'status', 'account_number', 'code', 'old_money', 'bank_id')->where('user_id', Auth::id())->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $this->v['histories']
        ]);
    }

    public function deposit(Request $request)
    {
        DB::beginTransaction();

        try {
            $wallet = DB::table('wallets')->where('id', $request->bank)->first();
            $code = Str::random(12);
            while (true) {
                if (DB::table('deposits')->where('code', $code)->count() > 0) {
                    $code = Str::random(12);
                } else {
                    break;
                }
            }
            DB::table('deposits')->insert([
                'name' => $wallet->name,
                'code' => $code,
                'bank_id' => $wallet->bank_id,
                'amount' => $request->money,
                'status' => 0,
                'user_id' => Auth::id(),
                'account_number' => $wallet->account_number,
                'old_money' => Auth::user()->money - $request->money,
                'created_at' => Carbon::now()
            ]);
            DB::table('users')->where('id', Auth::id())->update(['money' => Auth::user()->money - $request->money]);
            DB::commit();
            return response()->json(['success' => true,
                'message' => 'Tạo yêu cầu rút tiền thành công'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
