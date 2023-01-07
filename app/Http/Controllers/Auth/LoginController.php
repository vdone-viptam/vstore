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

    public function getFormRegister()
    {
        return view('auth.register');
    }

    public function postFormRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'name' => 'required',
            'company_name' => 'required',
            'tax_code' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'id_vdone' => 'required',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ], [
            'email.required' => 'Email bắt buộc nhập',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng dịnh dạng',
            'name' => 'Tên v-store bắt buộc nhập',
            'company_name' => 'Tên công ty bắt buộc nhập',
            'tax_code' => 'Mã số thuế bắt buộc nhập',
            'address' => 'Địa chỉ bắt buộc nhập',
            'phone_number' => 'Số điện thoại bất buộc nhập',
            'id_vdone' => 'ID người đại điện bắt buộc nhập',
            'password.required' => 'Mật khẩu bắt buộc nhập',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác',
            'password.min' => 'Mật khẩu phải dài it nhất 8 kí tự',
            'password_confirmation' => 'Xác nhận mật khẩu bắt buộc nhập'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->id_vdone = $request->id_vdone;
        $user->company_name = $request->company_name;
        $user->phone_number = $request->phone_number;
        $user->tax_code = $request->tax_code;
        if ($request->id_vdone_diff) {
            $user->id_vdone_diff = $request->id_vdone_diff;
        }
        $user->address = $request->address;

        $user->save();

        return 'Đăng ký thành công';
    }

    public function postLogin(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
//        return 1;
        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)){
            return 'đăng nhập thành công';
        }else if(Auth::attempt(['phone_number' => $request->email, 'password' => $request->password])){
            return 'đăng nhập thành công';
        }else{
            return redirect()->route('login')->with('mes','Tài khoản hoặc mật khẩu không chính xác');
        }
        ;

    }
    public function getLogin(){
        return view('auth.login');
    }
    public function formForgotPassword(){
        return view('auth.forgotPassword');
    }
    public function postForgotPassword(Request $request){
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
        $user = User::where('email',$request->email)->first();
        if ($user){
            $passwordReset = PasswordReset::where('email',$request->email)->delete();
            $token = Str::random(10);
            DB::table('password_resets')->insert(['email'=>$request->email,'token'=>$token,'created_at'=>Carbon::now()]);
            Mail::send('email.forgot', ['token'=>$token ], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Thông báo đổi mật khẩu' );
            });
        }else{
            return 1;
        }
    }
    public function formResetForgot($token){
        return view('auth.formReset');
    }
    public function postResetForgot(Request $request ,$token){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:30|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.required' => 'Email bắt buộc nhập',
            'password.min' => 'Qúa ít ký tự',
            'password.max' => 'Qúa nhiều ký tự',
            'password.confirmed'=>'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được trống',
        ]);
//        password_confirmation
        $passwordReset = PasswordReset::where('token',$token)->first();
        if ($passwordReset){
            $user = User::where('email',$passwordReset->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            $passwordReset->delete();
        }else{
            return redirect()->route('login');
        }
        return redirect()->route('login');
    }
}
