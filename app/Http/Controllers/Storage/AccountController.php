<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\User;
use App\Models\Warehouses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }


    public function profile()
    {
//        return 1;
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $this->v['infoAccount'] = User::with(['province', 'district','ward'])->where('id', Auth::id())->first();
        $this->v['infoAccount']->storage_information = json_decode($this->v['infoAccount']->storage_information);
//        return $this->v['infoAccount'];
        return view('screens.storage.account.profile', $this->v);

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
            'floor_area' => 'required',
            'volume' => 'required',
            'cold_storage' => 'required',
            'warehouse' => 'required',
            'normal_storage' => 'required',
            'city_id'=>'required',
            'district_id'=>'required',
            'ward_id'=>'required',
        ], [
            'name.required' => 'Tên v-store bắt buộc nhập',
            'company_name.required' => 'Tên công ty bắt buộc nhập',
//            'tax_code.required' => 'Mã số thuế bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bất buộc nhập',
            'phone_number.regex' => 'Số điện thoại không hợp lệ',
            'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
            'floor_area.required' => 'trường này không được trống',
            'volume.required' => 'Trường này không được trống',
            'cold_storage.required' => 'Trường này không được trống',
            'warehouse.required' => 'Trường này không được trống',
            'normal_storage.required' => 'Trường này không được trống',
            'city_id.required' => 'Trường này không được trống',
            'district_id.required' => 'Trường này không được trống',
            'ward_id.required' => 'Trường này không được trống',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
        try {
            $user = \App\Models\User::find($id);
            $user->name = trim($request->name);
            $user->company_name = trim($request->company_name);
            $user->provinceId = $request->city_id;
            $user->district_id = $request->district_id;
            $user->ward_id = $request->ward_id;

            $user->address = trim($request->address);
            $user->id_vdone = trim($request->id_vdone);
            $user->id_vdone_diff = trim($request->id_vdone_diff);
            $user->phone_number = trim($request->phone_number);
            $old_info = json_decode($user->storage_information);
            $old_info->floor_area = $request->floor_area;
            $old_info->volume = $request->volume;
            $old_info->cold_storage = $request->cold_storage;
            $old_info->warehouse = $request->warehouse;
            $old_info->normal_storage = $request->normal_storage;
            $user->storage_information = json_encode($old_info);
            $user->save();



            $address = $user->ward->wards_name .','. $user->district->district_name.', '  .$user->province->province_name;
//            return $address_ware;
            $result = app('geocoder')->geocode($address)->get();
            if (!isset($result[0])){
                return redirect()->back()->with('error','Địa chỉ không hợp lệ');
            }
            $coordinates = $result[0]->getCoordinates();

            $lat = $coordinates->getLatitude();
            $long = $coordinates->getLongitude();

            $warehouse= Warehouses::where('user_id',$user->id)->first();
            $warehouse->name=$user->name;
            $warehouse->ward_id =$request->ward_id;
            $warehouse->city_id =$request->city_id;
            $warehouse->district_id =$request->district_id;
            $warehouse->lat= $lat;
            $warehouse->long = $long;
            $warehouse->save();
            return redirect()->back()->with('success', 'Cập nhật thông tin tài khoản thành công');

        }catch (Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }


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
        return view('screens.storage.account.change_password', $this->v);

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
            'password.min' => 'Mật khẩu không dúng định dạng',
            'password.regex' => 'Mật khẩu không dúng định dạng ',
            'password.required' => 'Mật khẩu mới bắt buộc nhập',
            'password_confirmation.required' => 'Bạn chưa xác nhận mật khẩu'
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

    public function editTaxCode()
    {
        return view('screens.storage.account.edit_tax_code');
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
                return redirect()->back()->withErrors(['tax_code' => 'Mã số thuế đã được đang ký'])->withInput($request->all());

            }
            if (DB::table('users')->where('tax_code', $request->tax_code)->where('role_id', 3)->orWhere('role_id', 2)->count() > 0) {
                return redirect()->back()->withErrors(['tax_code' => 'Mã số thuế đã được đang ký'])->withInput($request->all());
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
