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
use Illuminate\Support\Facades\Http;
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
        if ($request->role_id == 3) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|unique:users',
                'company_name' => 'required',
                'tax_code' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
                'id_vdone' => 'required',
                'city_id' => 'required',
                'district_id' => 'required'

            ], [
                'email.required' => 'Email bắt buộc nhập',
                'email.unique' => 'Email đã tồn tại',
                'email.email' => 'Email không đúng dịnh dạng',
                'name.required' => 'Tên nhà phân phối bắt buộc nhập',
                'name.unique' => 'Tên công ty đã tồn tại',
                'company_name.required' => 'Tên công ty bắt buộc nhập',
                'tax_code.required' => 'Mã số thuế bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone_number.required' => 'Số điện thoại bất buộc nhập',
                'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
                'city_id' => 'Tỉnh (thành phố) bắt buộc chọn',
                'district_id' => 'Quận (huyện) bắt buộc chọn'
            ]);
        } elseif ($request->role_id == 4) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|unique:users',
                'company_name' => 'required||unique:users',
                'tax_code' => 'required|max:255',
                'address' => 'required|max:255',
                'phone_number' => 'required|max:255',
                'id_vdone' => 'required|max:255',
                'floor_area' => 'required',
                'volume' => 'required',
                'image_storage' => 'required',
                'image_pccc' => 'required',
                'length' => 'required',
                'with' => 'required',
                'height' => 'required',
                'city_id' => 'required',
                'district_id' => 'required'

            ], [
                'email.required' => 'Email bắt buộc nhập',
                'email.unique' => 'Email đã tồn tại',
                'email.email' => 'Email không đúng dịnh dạng',
                'name.required' => 'Tên bắt buộc nhập',
                'name.unique' => 'Tên công ty đã tồn tại',
                'company_name.unique' => 'Tên công ty đã tồn tại',
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
                'city_id' => 'Tỉnh (thành phố) bắt buộc chọn',
                'district_id' => 'Quận (huyện) bắt buộc chọn'
            ]);
        } elseif ($request->role_id == 2) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|unique:users',
                'company_name' => 'required|unique:users',
                'tax_code' => 'required',
                'address' => 'required',
                'phone_number' => 'required',
                'id_vdone' => 'required',
                'city_id' => 'required',
                'district_id' => 'required'
            ], [
                'email.required' => 'Email bắt buộc nhập',
                'email.unique' => 'Email đã tồn tại',
                'email.email' => 'Email không đúng dịnh dạng',
                'name.required' => 'Tên nhà cung cấp bắt buộc nhập',
                'name.unique' => 'Tên nhà cung cấp đã tồn tại',
                'company_name.unique' => 'Tên công ty đã tồn tại',
                'company_name.required' => 'Tên công ty bắt buộc nhập',
                'tax_code.required' => 'Mã số thuế bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone_number.required' => 'Số điện thoại bất buộc nhập',
                'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
                'city_id' => 'Tỉnh (thành phố) bắt buộc chọn',
                'district_id' => 'Quận (huyện) bắt buộc chọn'
            ]);
        }
        try {
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());

            }


            DB::beginTransaction();
            $domain = $request->getHttpHost();
            if ($domain == config('domain.admin')) {
                $role_id = 1;
            }
            if ($domain == config('domain.ncc')) {
                $role_id = 2;
            }
            if ($domain == config('domain.vstore')) {
                $role_id = 3;
            }
            if ($domain == config('domain.storage')) {
                $role_id = 4;
            }
            $checkEmail = DB::table('users')
                ->where('email', $request->email)
                ->where('role_id', $request->role_id)
                ->count();

            if ($checkEmail > 0) {
                return redirect()->back()->withErrors(['email' => 'Email đã được đăng ký.'])->withInput($request->all());
            }

            $checkTax = DB::table('users')
                ->where('tax_code', $request->tax_code)
                ->where('role_id', $role_id)
                ->count();
            if ($checkTax > 0) {
                return redirect()->back()->withErrors(['tax_code' => 'Mã số thuế đã được đăng ký.'])->withInput($request->all());
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->id_vdone = $request->id_vdone;
            $user->company_name = $request->company_name;
            $user->password = Hash::make(rand(100000, 999999));
            $user->phone_number = $request->phone_number;
            $user->tax_code = $request->tax_code;
            if ($role_id == 3) {
                $user->branch = 1;
            }
            if ($request->id_vdone_diff) {
                $user->id_vdone_diff = $request->id_vdone_diff;
            }
            $user->address = $request->address;
            $user->role_id = $role_id;
            $user->slug = Str::slug($request->name);
            if ($role_id == 4) {
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
            $user->provinceId = $request->city_id;
            $user->district_id = $request->district_id;
            $user->save();

            DB::commit();

            if ($role_id == 2) {

                return redirect()->route('login_ncc')->with('success', 'Đăng ký tài khoản thành công');
            }
            if ($role_id == 3) {
                return redirect()->route('login_vstore')->with('success', 'Đăng ký tài khoản thành công');
            }
            if ($role_id == 4) {
                return redirect()->route('login_storage')->with('success', 'Đăng ký tài khoản thành công');
            }
//            return 1
        } catch (\Exception $e) {
//            dd($e->getMessage());
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
            $domain = $request->getHttpHost();
            if ($domain == config('domain.admin')) {
                $role_id = 1;
            }
            if ($domain == config('domain.ncc')) {
                $role_id = 2;
            }
            if ($domain == config('domain.vstore')) {
                $role_id = 3;
            }
            if ($domain == config('domain.storage')) {
                $role_id = 4;
            }

            if (Auth::attempt(['account_code' => $request->email, 'password' => $request->password, 'role_id' => $role_id])) {
                if (Auth::user()->status == 4) {
                    return redirect()->back()->with('error', 'Tài khoản đã hết hạn sử dụng.Liên hệ quản trị viên để gia hạn tài khoản');
                }
                $token = Str::random(32);
                $userLogin = Auth::user();
                $login = new Otp();
                $login->code = rand(100000, 999999);
                $login->user_code = $userLogin->id;
                $login->number = 0;
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
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }


    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function formForgotPassword(Request $request)
    {
        $domain = $request->getHttpHost();
        if ($domain == config('domain.admin')) {
            $role_id = 1;
        }
        if ($domain == config('domain.ncc')) {
            $role_id = 2;
        }
        if ($domain == config('domain.vstore')) {
            $role_id = 3;
        }
        if ($domain == config('domain.storage')) {
            $role_id = 4;
        }
        return view('auth.forgotPassword', ['role_id' => $role_id]);
    }

    public function postForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email|email',
            'role_id' => 'required'
        ], [
            'email.required' => 'Email bắt buộc nhập',
            'email.exists' => 'Email không tồn tại',
            'email.email' => 'Email không đúng dịnh dạng',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        $domain = $request->getHttpHost();
        if ($domain == config('domain.admin')) {
            $role_id = 1;
        }
        if ($domain == config('domain.ncc')) {
            $role_id = 2;
        }
        if ($domain == config('domain.vstore')) {
            $role_id = 3;
        }
        if ($domain == config('domain.storage')) {
            $role_id = 4;
        }
        $user = User::where('email', $request->email)->where('role_id', $role_id)->where('account_code', '!=', null)->first();
        if ($user) {
            $passwordReset = PasswordReset::where('email', $request->email)->where('role_id', $role_id)->delete();
            $token = Str::random(32);
            DB::table('password_resets')
                ->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now(), 'role_id' => $role_id]);
            Mail::send('email.forgot', ['token' => $token, 'role_id' => $role_id], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Thông báo đổi mật khẩu');
            });

            return redirect()->route('form_forgot_password')->with('success', 'Đường link đổi mật khẩu đã được gửi vào mail');
        } else {
            return redirect()->route('form_forgot_password')->with('error', 'Không tìm thầy tài khoản');
        }
    }

    public function formResetForgot($token, Request $request)
    {
        $domain = $request->getHttpHost();
        if ($domain == config('domain.admin')) {
            $role_id = 1;
        }
        if ($domain == config('domain.ncc')) {
            $role_id = 2;
        }
        if ($domain == config('domain.vstore')) {
            $role_id = 3;
        }
        if ($domain == config('domain.storage')) {
            $role_id = 4;
        }
        $passwordReset = PasswordReset::where('token', $token)->where('role_id', $role_id)->first();

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
            'role_id' => 'required',
        ], [
            'password.required' => 'Email bắt buộc nhập',
            'password.min' => 'Qúa ít ký tự',
            'password.max' => 'Qúa nhiều ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được trống',
        ]);
        $domain = $request->getHttpHost();
        if ($domain == config('domain.admin')) {
            $role_id = 1;
        }
        if ($domain == config('domain.ncc')) {
            $role_id = 2;
        }
        if ($domain == config('domain.vstore')) {
            $role_id = 3;
        }
        if ($domain == config('domain.storage')) {
            $role_id = 4;
        }
        $passwordReset = PasswordReset::where('token', $token)->where('role_id', $role_id)->first();
        if ($passwordReset) {
            $user = User::where('email', $passwordReset->email)->where('role_id', $role_id)->first();
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
            if ($now->diffInMinutes($otp->created_at) >= 3) {
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
                // dd(1);
                return redirect()->route('screens.manufacture.dashboard.index');
            }
            if (Auth::user()->role_id == 3) {

                return redirect()->route('screens.vstore.dashboard.index');
            }
            if (Auth::user()->role_id == 4) {

                return redirect()->route('screens.storage.dashboard.index');
            }
        } else {
            $checkOtpNumber = Otp::where('user_code', $request->id)->where('number', 4)->first();
            if ($checkOtpNumber) {
                $removeOtp = Otp::where('user_code', $request->id)->delete();
                return redirect()->back()->with('error', 'Mã xác đã nhập sai vượt quá 5 lần vui lòng gửi lại mã');
            }

            $otp = Otp::where('user_code', $request->id)->update([
                'number' => DB::raw('number+1')
            ]);
            return redirect()->back()->with('error', 'Mã xác minh không chính xác');
        }

    }

    public function reOtp(Request $request)
    {
        $user = User::find($request->id);
        $otp = Otp::where('user_code', $user->id)->delete();
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


    public function getCity(Request $request)
    {
        if ($request->type == 2) {
            $response = Http::get('https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId=' . $request->value);
        } else {
            $response = Http::get('https://partner.viettelpost.vn/v2/categories/listProvince');

        }
        return $response->json()['data'];
    }
}
