<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->v = [];

    }


    public function profile()
    {
        $this->v['infoAccount'] = Auth::user();
        return view('screens.manufacture.account.profile', $this->v);

    }

    public function editProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_name' => 'required',
//            'tax_code' => 'required',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'id_vdone' => 'required',
//            'link_website' => 'required|url'

        ], [
            'name.required' => 'Tên v-store bắt buộc nhập',
            'company_name.required' => 'Tên công ty bắt buộc nhập',
//            'tax_code.required' => 'Mã số thuế bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bất buộc nhập',
            'phone_number.regex' => 'Số điện thoại không hợp lệ',
            'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
//            'link_website.required' => 'Địa chỉ website bắt buộc nhập',
//            'link_website.url' => 'Địa chỉ website không hợp lệ'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        $user = \App\Models\User::find($id);

        $user->name = trim($request->name);
        $user->company_name = trim($request->company_name);
//        $user->tax_code = trim($request->tax_code);
        $user->address = trim($request->address);
        $user->id_vdone = trim($request->id_vdone);
        $user->id_vdone_diff = trim($request->id_vdone_diff);
        $user->phone_number = trim($request->phone_number);
//        $user->link_website = trim($request->link_website);
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin tài khoản thành công');
    }

    public function uploadImage($id, Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'img' => 'size:20000000',
//            'banner' => 'size:20000000',
//
//        ], [
//            'img.size' => 'Qúa kíc cỡ',
//            'banner.banner' => 'Qúa kíc cỡ',
//        ]);
//        if ($validator->fails()) {
//            return redirect()->back();
//        }
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

    public function address()
    {
        $this->v['infoAccount'] = User::select('id', 'name', 'avatar')->where('id', Auth::id())->first();
        return view('screens.manufacture.account.address', $this->v);

    }

    public function saveAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'ward_id' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'city_id' => 'required',

        ], [
            'name.required' => 'Tên kho bắt buộc nhập',
            'ward_id.required' => 'Xã bắt buộc chọn',
            'district_id.required' => 'Quận huyện bắt buộc chọn',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bất buộc nhập',
            'phone_number.regex' => 'Số điện thoại không hợp lệ',
            'city_id.required' => 'Thành phố bắt buộc chọn',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
        $ware = new Warehouses();
        $ware->name = $request->name;
        $ware->phone_number = $request->phone_number;
        $ware->address = $request->address;
        $ware->district_id = $request->district_id;
        $ware->ward_id = $request->ward_id;
        $ware->city_id = $request->city_id;

        $ware->user_id = Auth::id();

        $ware->save();

        return redirect()->back()->with('success', 'Thêm mới kho hàng thành công');

    }

    public function editAddress(Request $request)
    {
        $ware = Warehouses::find($request->id);

        return view('screens.manufacture.account.edit', ['ware' => $ware])->render();
    }


    public function updateAddress(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'ward_id' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'city_id' => 'required',

        ], [
            'name.required' => 'Tên kho bắt buộc nhập',
            'ward_id.required' => 'Xã bắt buộc chọn',
            'district_id.required' => 'Quận huyện bắt buộc chọn',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bất buộc nhập',
            'phone_number.regex' => 'Số điện thoại không hợp lệ',
            'city_id.required' => 'Thành phố bắt buộc chọn',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        $ware = Warehouses::find($id);
        $ware->name = $request->name;
        $ware->phone_number = $request->phone_number;
        $ware->address = $request->address;
        $ware->district_id = $request->district_id;
        $ware->ward_id = $request->ward_id;
        $ware->city_id = $request->city_id;
        $ware->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin kho hàng thành công');
    }

    public function getdestroyAddress(Request $request)
    {
        return view('screens.manufacture.account.destroy', ['id' => $request->id])->render();
    }

    public function destroyAddress($id)
    {
        Warehouses::destroy($id);

        return redirect()->back();
    }

    public function changePassword()
    {
        $this->v['infoAccount'] = Auth::user();
        return view('screens.manufacture.account.change_password', $this->v);

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
