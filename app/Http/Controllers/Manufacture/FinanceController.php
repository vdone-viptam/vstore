<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BlanceChange;
use App\Models\Deposit;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FinanceController extends Controller
{
    //

    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        $this->v['banks'] = DB::table('banks')->select('name', 'full_name', 'image', 'id')->get();
        $this->v['wallet'] = Wallet::select('bank_id', 'id', 'account_number', 'name')
            ->where('type', 1)
            ->where('user_id', Auth::id())->first();
        $this->v['waiting']= Deposit::select(DB::raw('SUM(amount) as amount') )->groupBy('user_id')->where('user_id',Auth::id())->where('status',0)->first()->amount ??0;
        return view('screens.manufacture.finance.index', $this->v);
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
            'name.required' => 'Tên chủ tài khoản bắt buộc nhập',
            'bank_id.numeric' => 'Ngân hàng bắt buộc chọn',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validateCreate', 'failed');
        }

        DB::table('wallets')->insert([
            'account_number' => $request->account_number,
            'bank_id' => $request->bank_id,
            'user_id' => Auth::id(),
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Thêm mới ngân hàng thành công');
    }

    public function transferMoney(Request $request)
    {
        $type = $request->type ?? 'asc';
        $field = $request->field ?? 'id';
        $limit = $request->limit ?? 10;
        // dd($type,$field);
        $this->v['histories'] = BlanceChange::select('money_history', 'type', 'title', 'status', 'created_at')
            ->where('user_id', Auth::id())
            ->orderBy($field, $type)
            ->paginate($limit);
        $this->v['field'] = $field;
        $this->v['type'] = $type;
        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['params'] = $request->all();

        return view('screens.manufacture.finance.revenue', $this->v);
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
        $limit = $request->limit ?? 10;
        $key_search = $request->key_search ?? '';

        $this->v['histories'] = Deposit::select('name', 'amount', 'id', 'status', 'account_number', 'code', 'old_money', 'bank_id', 'created_at')
            ->selectSub('select name from banks where id = deposits.bank_id', 'bank_name')
            ->where('user_id', Auth::id())
            ->orderBy($field, $type)
            ->paginate($limit);
        $this->v['type'] = $type;
        $this->v['field'] = $field;

        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['params'] = $request->all();

        return view('screens.manufacture.finance.history', $this->v);
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
                return redirect()->back()->with('error', 'Số tiền rút tối đa là ' . number_format(Auth::user()->money, 0, '.', '.').' VNĐ');
            }
            $bank = Bank::where('id',$wallet->bank_id)->first();
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


            $hmac = 'accountCode='.Auth::user()->account_code .'&code='. $code .'&value='.round($request->money,0). '&bankNumber=' . $wallet->account_number.'&bankHolder='.$wallet->name;
//                    sellerPDoneId=VNO398917577&buyerId=2&ukey=25M7I5f9913085b842&value=500000&orderId=10&userId=63
            $sig = hash_hmac('sha256',$hmac,config('domain.key_split'));


//
//            userId=${dto.userId}&code=${dto.code}&value=${dto.value}&bankNumber=${dto.bankNumber}&bankHolder=${dto.bankHolder}

            $respon = Http::post(config('domain.domain_vdone') . 'accountant/withdraw/v-shop',[
                "code"=> $code,
                "accountCode"=> Auth::user()->account_code,
                "bankName"=> $bank->name,
                "bankLogo"=> $bank->image,
                "bankHolder"=> $wallet->name,
                "bankNumber"=> $wallet->account_number,
                "value"=> round($request->money,0),
                "type"=>2,
                "signature"=> $sig
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
