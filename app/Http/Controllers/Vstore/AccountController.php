<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouses;
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
        return view('screens.vstore.account.profile', $this->v);

    }

    public function editProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_name' => 'required',
            'tax_code' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'id_vdone' => 'required',
        ], [
            'name' => 'Tên v-store bắt buộc nhập',
            'company_name' => 'Tên công ty bắt buộc nhập',
            'tax_code' => 'Mã số thuế bắt buộc nhập',
            'address' => 'Địa chỉ bắt buộc nhập',
            'phone_number' => 'Số điện thoại bất buộc nhập',
            'id_vdone' => 'ID người đại điện bắt buộc nhập',
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
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
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
        return view('screens.vstore.account.change_password', $this->v);

    }

    public function saveChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'confirmed|required',
            'password_confirmation' => 'required'
        ], [
            'old_password.required' => 'Mật khẩu cũ bắt buộc nhập',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác',
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
