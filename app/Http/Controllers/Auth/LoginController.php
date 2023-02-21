<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
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

    public function getFormRegisterVstorage()
    {
        return view('auth.storage.register_storage');
    }

    public function getFormLoginVstorage()
    {
        if (Auth::user() && Auth::user()->role_id == 4) {
            return redirect()->route('screens.storage.dashboard.index');
        }
        return view('auth.storage.login_storage');
    }

    public function getFormLoginVstore()
    {
        if (Auth::user() && Auth::user()->role_id == 3) {
            return redirect()->route('screens.vstore.dashboard.index');
        }
        return view('auth.Vstore.login_vstore');
    }

    public function getFormLoginNCC()
    {
        if (Auth::user() && Auth::user()->role_id == 2) {
            return redirect()->route('screens.manufacture.dashboard.index');
        }
        return view('auth.NCC.login_ncc');
    }

    public function getFormLoginAdmin()
    {
        return view('auth.admin.login');
    }

    public function postFormRegister(Request $request)
    {
        if ($request->role_id != 4) {
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
                'name.unique' => 'Tên công ty đã tồn tại',
                'company_name.unique' => 'Tên công ty đã tồn tại',
                'company_name.required' => 'Tên công ty bắt buộc nhập',
                'tax_code.required' => 'Mã số thuế bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone_number.required' => 'Số điện thoại bất buộc nhập',
                'id_vdone.required' => 'ID người đại điện bắt buộc nhập',

            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users|email',
                'name' => 'required|unique:users',
                'company_name' => 'required||unique:users',
                'tax_code' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
                'id_vdone' => 'required',
                'floor_area' => 'required',
                'volume' => 'required',
                'image_storage' => 'required',
                'image_pccc' => 'required',
                'length' => 'required',
                'with' => 'required',
                'height' => 'required'

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
                'floor_area.required' => 'trường này không được trống',
                'volume.required' => 'trường này không được trống',
                'image_storage.required' => 'trường này không được trống',
                'image_pccc.required' => 'trường này không được trống',
                'length.required' => 'trường này không được trống',
                'with.required' => 'trường này không được trống',
                'height.required' => 'trường này không được trống',


            ]);
        }

        if ($validator->fails()) {
            dd($validator->errors());
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
            if ($request->role_id == 4) {
                $cold_storage = $request->cold_storage ?? '';
                $warehouse = $request->warehouse ?? '';
                $normal_storage = $request->normal_storage ?? $request->volume;
                $filestorage = '';
                $filepccc = '';
                if ($request->hasFile('image_storage')) {
                    $file = $request->file('image_storage');
                    $filestorage = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('image/users'), $filestorage);

                }
                if ($request->hasFile('image_pccc')) {
                    $file = $request->file('image_pccc');
                    $filepccc = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('image/users'), $filepccc);

                }
                $storage_information = [
                    'floor_area' => $request->floor_area,
                    'volume' => $request->volume,
                    'image_storage' => 'image/users' . $filestorage,
                    'image_pccc' => 'image/users' . $filepccc,
                    'cold_storage' => $cold_storage,
                    'warehouse' => $warehouse,
                    'normal_storage' => $normal_storage,
                ];
                $user->storage_information = json_encode($storage_information);
            }
            $user->save();

            DB::commit();

            if ($request->role_id == 2) {
                return redirect()->route('login_ncc')->with('success', 'Thành công');
            }
            if ($request->role_id == 3) {
                return redirect()->route('login_vstore')->with('success', 'Thành công');
            }
            if ($request->role_id == 4) {
                return redirect()->route('login_storage')->with('success', 'Thành công');
            }
//            return 1
        } catch (\Exception $e) {
            dd($e->getMessage());
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

        $credentials = request(['email', 'password']);
        try {
            if (Auth::attempt(['account_code' => $request->email, 'password' => $request->password]) && Auth::user()->role_id == $request->type) {
                $token = Str::random(32);
                $userLogin = Auth::user();
                $login = new Otp();
                $login->code = rand(100000, 999999);
                $login->user_code = $userLogin->id;
                $login->save();
                Mail::send('email.otp', ['confirm_code' => $login->code], function ($message) use ($userLogin) {
                    $message->to($userLogin->email);
                    $message->subject('Bạn vừa có yêu cầu đăng nhập');
                });
                Auth::logout();
                return redirect()->route('otp', ['token1' => $token, 'id' => $userLogin->id]);
            } else {
                return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
            };
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }


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
        Auth::hasUser();
        return redirect('login');
    }

    public function OTP($token1, Request $request)
    {

        return view('auth.otp', [
            'token' => $token1,
            'user_id' => $request->id
        ]);
    }

    public function post_OTP(Request $request, $token1)
    {
        $otp = Otp::where('user_code', $request->id)->where('code', $request->otp)->first();
        $now = Carbon::now();


        if ($otp) {
            if ($now->diffInMinutes($otp->created_at) >= 1) {
                return redirect()->back()->with('error', 'Mã xác minh đã hết hạn');
            }
            $user = User::find($request->id);
            Auth::login($user);
            Otp::where('user_code', $request->id)->delete();
            $otp->delete();
            if (Auth::user()->role_id == 1) {
                return redirect()->route('screens.admin.dashboard.index');
            }
            if (Auth::user()->role_id == 2) {

                return redirect()->route('screens.manufacture.dashboard.index');
            }
            if (Auth::user()->role_id == 3) {

                return redirect()->route('screens.vstore.dashboard.index');
            }
            if (Auth::user()->role_id == 4) {

                return redirect()->route('screens.storage.dashboard.index');
            }
        } else {
            return redirect()->back()->with('error', 'Mã xác minh không chính xác');
        }

    }

    public function reOtp(Request $request)
    {
        $user = User::find($request->id);
        $login = new Otp();
        $login->code = rand(100000, 999999);
        $login->user_code = $user->id;
        $login->save();
        Mail::send('email.otp', ['confirm_code' => $login->code], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Bạn vừa có yêu cầu gửi lại mã xác minh');
        });
        return redirect()->back();
    }
}
