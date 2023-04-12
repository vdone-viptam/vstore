<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\BlanceChange;
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
        $this->v['wallet'] = Wallet::select('bank_id', 'id', 'account_number', 'name')->where('user_id', Auth::id())
            ->where('type', 1)
            ->first();
        return view('screens.storage.finance.index', $this->v);
    }


    public function storeWall(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required',
            'bank_id' => 'required|numeric|min:0',
            'name' => 'required',
        ], [
            'account_number.required' => 'Số tài khoản bắt buộc nhập',
            'bank_id.required' => 'Ngân hàng bắt buộc chọn',
            'bank_id.numeric' => 'Ngân hàng bắt buộc chọn',
            'name.required' => 'Tên chủ tài khoản bắt buộc nhập',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validateCreate', 'failed');
        }

        $wallets = new Wallet();
        $wallets->account_number = $request->account_number;
        $wallets->bank_id = $request->bank_id;
        $wallets->name = $request->name;
        $wallets->user_id = Auth::id();
        $wallets->save();

        return redirect()->back()->with('success', 'Thêm mới ngân hàng thành công');
    }

    public function updateWall(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required',
            'bank_id' => 'required|numeric|min:0',
            'name' => 'required',
        ], [
            'account_number.required' => 'Số tài khoản bắt buộc nhập',
            'bank_id.required' => 'Ngân hàng bắt buộc chọn',
            'name.required' => 'Tên chủ tài khoản bắt buộc nhập',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validateUpdate', 'failed');
        }
        DB::table('wallets')->where('id', $id)->update([
            'account_number' => $request->account_number,
            'bank_id' => $request->bank_id,
            'user_id' => Auth::id(),
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Cập nhật ngân hàng thành công');
    }

    public function history(Request $request)
    {
        $type = $request->type ?? 'asc';
        $field = $request->field ?? 'id';
        $this->v['histories'] = Deposit::select('name', 'amount', 'id', 'status', 'account_number', 'code', 'old_money', 'bank_id', 'created_at')
            ->where('user_id', Auth::id())
            ->orderBy($field, $type)
            ->paginate(10);
        $this->v['field'] = $field;
        $this->v['type'] = $type;
        return view('screens.storage.finance.history', $this->v);
    }

    public function transferMoney(Request $request)
    {
        $type = $request->type ?? 'asc';
        $field = $request->field ?? 'id';
        // dd($type,$field);
        $this->v['histories'] = BlanceChange::select('money_history', 'type', 'title', 'status', 'created_at')
            ->where('user_id', Auth::id())
            ->orderBy($field, $type)
            ->paginate(10);
        $this->v['field'] = $field;
        $this->v['type'] = $type;
        return view('screens.storage.finance.revenue', $this->v);
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
            if ($request->money > Auth::user()->money) {
                return redirect()->back()->with('error', 'Số tiền rút tối đa là ' . number_format(Auth::user()->money, 0, '.', '.') . ' VNĐ');
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
            DB::table('balance_change_history')->insert([
                'user_id' => Auth::id(),
                'type' => 0,
                'title' => 'Rút tiền về ngân hàng',
                'status' => 1,
                'money_history' => (double)$request->money,
                'created_at' => Carbon::now()
            ]);
            DB::table('users')->where('id', Auth::id())->update(['money' => Auth::user()->money - $request->money]);
            DB::commit();

            return redirect()->back()->with('success', 'Tạo yêu cầu rút tiền thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Tạo yêu cầu rút tiền thất bại');

        }
    }
}
