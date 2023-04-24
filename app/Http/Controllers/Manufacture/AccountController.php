<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Api\ElasticsearchController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouses;
use App\Models\WarehouseType;
use Carbon\Carbon;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $this->v['infoAccount'] = Auth::user();
        return view('screens.manufacture.account.profile', $this->v);

    }

    public function editProfile(Request $request, $id)
    {
        // dd ($request->All());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'company_name' => 'required|max:100',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'id_vdone' => 'required',
            'description' => 'max:500',
            'city_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'link_website' => 'unique:users,slug,' . $id,

        ], [
            'name.required' => 'Tên  bắt buộc nhập',
            'name.max' => 'Tên  tối đa 30 ký tự',
            'company_name.required' => 'Tên công ty bắt buộc nhập',
            'company_name.max' => 'Tên công ty tối đa 100 ký tự',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bất buộc nhập',
            'phone_number.regex' => 'Số điện thoại không hợp lệ',
            'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
            'description.max' => 'Giới thiệu ít hơn 500 ký tự',
            'city_id.required' => 'Trường này không được trống',
            'district_id.required' => 'Trường này không được trống',
            'ward_id.required' => 'Trường này không được trống',
            'link_website.unique' => 'Slug đã tồn tại',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        $user = \App\Models\User::find($id);

        $user->name = trim($request->name);
        $user->company_name = trim($request->company_name);
        $user->provinceId = $request->city_id;
        $user->district_id = $request->district_id;
        $user->ward_id = $request->ward_id;
//        $user->tax_code = trim($request->tax_code);
        $user->address = trim($request->address);
        $user->id_vdone = trim($request->id_vdone);
        $user->id_vdone_diff = trim($request->id_vdone_diff);
        $user->phone_number = trim($request->phone_number);
        if ($request->link_website) {
            $user->slug = trim($request->link_website);
        }
        // dd(1);
        $elasticsearchController = new ElasticsearchController();
        try {
            $res = $elasticsearchController->updateDocNCC((string)$user->id, $request->name);
            DB::commit();
        } catch (ClientResponseException $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
        $user->description = $request->description;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin tài khoản thành công');
    }

    public function uploadImage($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img' => 'max:200000|mimes:jpeg,png,jpg,gif',
            'banner' => 'max:200000|mimes:jpeg,png,jpg,gif',
        ], [
            'img.max' => 'Quá kích cỡ',
            'img.mimes' => 'Hãy chọn ảnh định dạng jpeg,png,jpg,gif',
            'banner.max' => 'Quá kích cỡ',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
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
        $user = User::find(Auth::id());

        if (strlen($request->old_password) == 0) {
            return redirect()->back()->withErrors(['old_password' => "Mật khẩu cũ bắt buộc nhập"])->withInput($request->all())->with('validate', 'failed');
        }
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => "Mật khẩu cũ không chính xác"])->withInput($request->all())->with('validate', 'failed');
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8|regex:' . config('regex.password'),
            'password_confirmation' => 'required'
        ], [
            'password.min' => 'Mật khẩu không đúng định dạng',
            'password.regex' => 'Mật khẩu không đúng định dạng',
            'password.required' => 'Mật khẩu mới bắt buộc nhập',
            'password.confirmed' => 'Mật khẩu không khớp',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
        if (strlen($request->password_confirmation) == 0) {
            return redirect()->back()->withErrors(['password_confirmation' => "Xác nhận mật khẩu bắt buộc nhập"])->withInput($request->all())->with('validate', 'failed');
        }
        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->withErrors(['password_confirmation' => "Xác nhận mật khẩu không chính xác"])->withInput($request->all())->with('validate', 'failed');

        }
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Thay đổi mật khẩu thành công');
    }

    public function editTaxCode()
    {
        return view('screens.manufacture.account.edit_tax_code');
    }

    public function saveChangeTaxCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tax_code' => 'required|digits:10',
        ], [
            'tax_code.required' => 'Mã số thuế bắt buộc nhập',
            'tax_code.digits' => 'Mã số thuế không hợp lệ'
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        try {
            if (DB::table('users')->where('tax_code', $request->tax_code)->where('role_id', Auth::user()->role_id)->count() > 0) {
                return redirect()->back()->withErrors(['tax_code' => 'Mã số thuế đã được đăng ký'])->withInput($request->all());
            }
            if (DB::table('users')->where('tax_code', $request->tax_code)->where('role_id', 3)->count() > 0) {
                return redirect()->back()->withErrors(['tax_code' => 'Mã số thuế đã được đăng ký'])->withInput($request->all());
            }
            if (DB::table('request_change_taxcode')->where('tax_code', $request->tax_code)->where('status', 0)->first()) {
                return redirect()->back()->withErrors(['tax_code' => 'Mã số thuế đã được đăng ký'])->withInput($request->all());
            }
            DB::table('request_change_taxcode')->insert([
                'user_id' => Auth::id(),
                'tax_code' => $request->tax_code,
                'status' => 0,
                'created_at' => Carbon::now()
            ]);
            return redirect()->back()->with('success', 'Gửi yêu cầu thay đổi mã số thuế thành công');


        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại');
        }
    }
}
