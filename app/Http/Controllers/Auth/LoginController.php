<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //

    public function getFormRegisterVstore()
    {
        return view('auth.Vstore.register_vstore');
    }

    public function getFormRegisterNCC()
    {
        return view('auth.NCC.register_ncc');
    }

    public function getFormLoginVstore()
    {
        return view('auth.Vstore.login_vstore');
    }

    public function getFormLoginNCC()
    {
        return view('auth.NCC.login_ncc');
    }

    public function getFormLoginAdmin()
    {
        return view('auth.admin.login');
    }

    public function postFormRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'name' => 'required|unique:users',
            'company_name' => 'required||unique:users',
            'tax_code' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'id_vdone' => 'required',
        ], [
            'email.required' => 'Email bắt buộc nhập',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng dịnh dạng',
            'name.required' => 'Tên nhà phân phối bắt buộc nhập',
            'name.unique' => 'tên công ty đã tồn tại',
            'company_name.unique' => 'tên công ty đã tồn tại',
            'company_name.required' => 'Tên công ty bắt buộc nhập',
            'tax_code.required' => 'Mã số thuế bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bất buộc nhập',
            'id_vdone.required' => 'ID người đại điện bắt buộc nhập',

        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

        }



        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->id_vdone = $request->id_vdone;
            $user->company_name = $request->company_name;
            $user->password = Hash::make(rand(100000, 999999));
            $user->phone_number = $request->phone_number;
            $user->tax_code = $request->tax_code;

            if ($request->id_vdone_diff) {
                $user->id_vdone_diff = $request->id_vdone_diff;
            }
            $user->address = $request->address;
            $user->role_id = $request->role_id;
            $user->slug = Str::slug($request->name);
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'true');
//            return 1
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'true');

        }

    }

    public function postLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email bắt buộc nhập',
            'password.required' => 'Mật khẩu bắt buộc nhập'
        ]);
//        return 1;
        $credentials = request(['email', 'password']);
        if (Auth::attempt(['account_code' => $request->email, 'password' => $request->password])) {
            if ($request->type == Auth::user()->role_id) {
                if (Auth::user()->role_id == 1) {
                    return redirect()->route('screens.admin.dashboard.index');
                }
                if (Auth::user()->role_id == 2) {

                    return redirect()->route('screens.manufacture.dashboard.index');
                }
                if (Auth::user()->role_id == 3) {

                    return redirect()->route('screens.vstore.dashboard.index');
                }
            } else {
                return redirect()->back()->with('error', 'Thông tin tài khoản hoặc mật khẩu không chính xác');
            }
        } else {
            return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
        };

    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function formForgotPassword()
    {
        return view('auth.forgotPassword');
    }

    public function postForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email|email',
        ], [
            'email.required' => 'Email bắt buộc nhập',
            'email.exists' => 'Email không tồn tại',
            'email.email' => 'Email không đúng dịnh dạng',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $passwordReset = PasswordReset::where('email', $request->email)->delete();
            $token = Str::random(32);
            DB::table('password_resets')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]);
            Mail::send('email.forgot', ['token' => $token], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Thông báo đổi mật khẩu');
            });

            return redirect()->route('form_forgot_password')->with('success', 'Đường link đổi mật khẩu đã được gửi vào mail');
        } else {
            return redirect()->route('form_forgot_password')->with('error', 'Không tìm thầy tài khoản');
        }
    }

    public function formResetForgot($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (Carbon::now()->diffInSeconds($passwordReset->created_at) > 180) {
            abort(404);
        }

        return view('auth.formReset');
    }

    public function postResetForgot(Request $request, $token)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:30|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.required' => 'Email bắt buộc nhập',
            'password.min' => 'Qúa ít ký tự',
            'password.max' => 'Qúa nhiều ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được trống',
        ]);
//        password_confirmation
        $passwordReset = PasswordReset::where('token', $token)->first();
        if ($passwordReset) {
            $user = User::where('email', $passwordReset->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            $passwordReset->delete();
        } else {
            return redirect('login')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
        return redirect('login')->with('success', 'Đổi mật khâu thành công');

    }

    public function getLogout()
    {
        Auth::logout();

        return redirect('login');
    }
}
