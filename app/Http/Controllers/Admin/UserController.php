<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function getListRegisterAccount()
    {
        $this->v['users'] = User::select();
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        $limit = $request->limit ?? 10;
        if (isset($request->name)) {
            $this->v['users'] = $this->v['users']->where('company_name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->id)) {
            $this->v['users'] = $this->v['users']->where('id', $request->id);
        }
        $this->v['users'] = $this->v['users']->orderBy('id', 'desc')->where('role_id', '!=', 1)->paginate($limit);
        $this->v['params'] = $request->all();
        return view('screens.admin.user.index', $this->v);
    }

    public function getListUser(Request $request)
    {
        $this->v['users'] = User::select();
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        $limit = $request->limit ?? 10;
        if (isset($request->name)) {
            $this->v['users'] = $this->v['users']->where('company_name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->id)) {
            $this->v['users'] = $this->v['users']->where('id', $request->id);
        }
        $this->v['users'] = $this->v['users']->orderBy('id', 'desc')->where('confirm_date', '!=', null)->paginate($limit);
        $this->v['params'] = $request->all();
        return view('screens.admin.user.list_user', $this->v);
    }

    public function confirm($id)
    {
        DB::beginTransaction();
        try {
            $ID = rand(100000000000, 999999999999);
            $checkUser = User::where('account_code', $ID)->first();
            while ($checkUser) {
                $ID = rand(100000000000, 999999999999);
                $checkUser = User::where('account_code', $ID)->first();
            }
            $password = rand(1000000, 9999999);
            $user = User::find($id);
            $user->account_code = $ID;
            $user->password = Hash::make($password);
            $user->confirm_date = Carbon::now();
            $user->save();

            Mail::send('email.confirm', ['ID' => $ID, 'password' => $password], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Đơn đăng ký của bạn đã được duyệt');
            });
            DB::commit();

            return redirect()->back()->with('success', 'Kích hoạt tài khoản thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }
}
