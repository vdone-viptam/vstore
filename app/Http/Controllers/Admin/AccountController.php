<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }


    public function profile()
    {
        $this->v['infoAccount'] = Auth::user();
        return view('screens.admin.account.profile', $this->v);

    }

    public function editProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_name' => 'required',
            'tax_code' => 'required|digits:10',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'id_vdone' => 'required',

        ], [
            'name.required' => 'Tên v-store bắt buộc nhập',
            'company_name.required' => 'Tên công ty bắt buộc nhập',
            'tax_code.required' => 'Mã số thuế bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bất buộc nhập',
            'phone_number.regex' => 'Số điện thoại không hợp lệ',
            'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        $user = \App\Models\User::find($id);

        $user->name = trim($request->name);
        $user->company_name = trim($request->company_name);
        $user->tax_code = trim($request->tax_code);
        $user->address = trim($request->address);
        $user->id_vdone = trim($request->id_vdone);
        $user->id_vdone_diff = trim($request->id_vdone_diff);
        $user->phone_number = trim($request->phone_number);
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin tài khoản thành công');
    }

    public function uploadImage($id, Request $request)
    {
        $user = User::find($id);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('image/users'), $filename);
            $user->avatar = $filename;
        }
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('image/users'), $filename);
            $user->banner = $filename;
        }


        $user->save();

        return redirect()->back();
    }


    public function changePassword()
    {
        return view('screens.admin.account.change_password', $this->v);

    }

    public function saveChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'confirmed|required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/',
            'password_confirmation' => 'required'
        ], [
            'old_password.required' => 'Mật khẩu cũ bắt buộc nhập',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác',
            'password.min' => 'Mật khẩu ít nhất 8 kí tự',
            'password.regex' => 'Mật khẩu không dúng dịnh dạng (ít nhất 1 chữ số,kí tự đặc biệt và 1 ký tự in hoa bất kì)',
            'password.required' => 'Mật khẩu mới bắt buộc nhập',
            'password_confirmation.required' => 'Bạn chưa xác nhận mật khảu'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        $user = User::find(Auth::id());

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => "Mật khẩu cũ không chính xác"])->withInput($request->all())->with('validate', 'failed');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Thay đổi mật khẩu thành công');
    }
}
