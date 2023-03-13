<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @group Finance
 *
 * Danh sách api liên quan tài chính V-Shop
 */
class FinanceController extends Controller
{
    /**
     * Danh sách ngân hàng
     *
     * API này sẽ trả về danh sách thông tin ngân hàng
     * @return \Illuminate\Http\JsonResponse
     */

    public function getListBank()
    {
        try {

            $banks = Bank::select('id', 'name', 'image', 'full_name')->get();

            return response()->json([
                'success' => true,
                'data' => $banks
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Thông tin ví
     *
     * API này sẽ trả về thông tin ví
     * @param  $pdone_id id user vshop
     */

    public function getWallet(Request $request, $pdone_id)
    {
        try {
            $vshop_id = DB::table('vshop')
                ->select('id')
                ->where('pdone_id', $pdone_id)
                ->first()
                ->id ?? 0;

            if (!$vshop_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy vshop'
                ], 404);
            }
            $wallet = Wallet::select('wallets.id', 'account_number', 'banks.name as bank_name', 'wallets.name')
                ->join('banks', 'wallets.bank_id', '=', 'banks.id')
                ->where('user_id', $vshop_id)->first();
            return response()->json([
                'success' => false,
                'data' => $wallet
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }

    }

    /**
     * Cập nhật ví
     *
     * API này sẽ trả về dể cập nhật ví
     * @param $wallet_id id tài khoản ví
     * @urlParam  pdone_id id user vshop
     */
    public function editWallet($wallet_id)
    {
        try {

            $banks = Bank::select('id', 'name', 'image', 'full_name')->get();
            $wallet = Wallet::select('id', 'account_number', 'name')->where('id', $wallet_id)->first();
            return response()->json([
                'success' => true,
                'data' => [
                    'banks' => $banks,
                    'wallet' => $wallet
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Cập nhật tài khoản ngân hàng
     *
     * API này sẽ cập nhật thông tin ngân hàng
     * @param Request $request
     * @param $wallet_id id tài khoản ví
     *
     * @bodyParam pdone_id id user vshop
     * @bodyParam bank_id id ngân hàng được chọn
     * @bodyParam account_code Số tài khoản ngân hàng
     * @bodyParam name Tên chủ tài khoản
     */

    public function updateWallet(Request $request, $wallet_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'pdone_id' => 'required|max:255',
                'bank_id' => 'required|max:255',
                'account_number' => 'required|max:255',
                'name' => 'required|max:255'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'messageError' => $validator->errors(),
                ], 401);
            }

            $vshop_id = DB::table('vshop')
                ->select('id')
                ->where('pdone_id', $request->pdone_id)
                ->first()
                ->id ?? 0;

            if (!$vshop_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy vshop'
                ], 404);
            }

            DB::table('wallets')->where('id', $wallet_id)->update([
                'account_number' => $request->account_number,
                'bank_id' => $request->bank_id,
                'name' => $request->name
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật tài khoản ví thành công'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Thêm mới ngân hàng
     *
     * API này sẽ lưu mới thông tin ngân hàng
     * @bodyParam pdone_id id user vshop
     * @bodyParam bank_id id ngân hàng được chọn
     * @bodyParam account_code Số tài khoản ngân hàng
     * @bodyParam name Tên chủ tài khoản
     */

    public function storeWallet(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'pdone_id' => 'required|max:255',
                'bank_id' => 'required|max:255',
                'account_number' => 'required|max:255',
                'name' => 'required|max:255'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'messageError' => $validator->errors(),
                ], 401);
            }

            $vshop_id = DB::table('vshop')
                ->select('id')
                ->where('pdone_id', $request->pdone_id)
                ->first()
                ->id ?? 0;

            if (!$vshop_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy vshop'
                ], 404);
            }

            if (DB::table('wallets')->where('user_id' , $vshop_id)->count() == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản ngân hàng đã tồn tại'
                ], 401);
            }
            DB::table('wallets')->insert([
                'account_number' => $request->account_number,
                'bank_id' => $request->bank_id,
                'user_id' => $vshop_id,
                'name' => $request->name
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Thêm mới tài khoản ngân hàng thành công'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tạo lệnh rút tiền
     *
     * API này sẽ tạo mới lệnh rút tiền
     * @param $wallet_id id tài khoản ví
     * @bodyParam pdone_id id user vshop
     * @bodyParam amount Số tiên rút
     */

    public function storeDeposit(Request $request, $wallet_id)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'pdone_id' => 'required|max:255',
                'amount' => 'required|numeric|min:1',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'messageError' => $validator->errors(),
                ], 401);
            }

            $wallet = DB::table('wallets')->where('id', $wallet_id)->first();
            $vshop_id = DB::table('vshop')
                ->select('id', 'money')
                ->where('pdone_id', $request->pdone_id)
                ->first();

            if (!$vshop_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy vshop'
                ], 404);
            }
            if ($request->amount > $vshop_id->money) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số dư tài khoản không đủ'
                ], 401);
            }

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
                'amount' => $request->amount,
                'status' => 0,
                'user_id' => $vshop_id->id,
                'account_number' => $wallet->account_number,
                'old_money' => $vshop_id->money,
                'type' => 2,
                'created_at' => Carbon::now()
            ]);
            DB::table('vshop')->where('id', $vshop_id->id)->update(['money' => $vshop_id->money - $request->amount]);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Tạo yêu cầu rút tiền thành công'
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
