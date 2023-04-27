<?php

namespace App\Http\Controllers\Storage;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\User;
use App\Models\Warehouses;
use App\Models\WarehouseType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function detailProfile(Request $request)
    {
        $this->v['infoAccount'] = Auth::user();
        $this->v['infoAccount']->storage_information = json_decode($this->v['infoAccount']->storage_information);

        return response()->json([
            'success' => true,
            'data' => $this->v['infoAccount']
        ]);
    }
    public function detailProfileWarehouse(Request $request)
    {
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $this->v['infoWarehouse'] = WarehouseType::select('type', 'acreage', 'volume', 'length', 'width', 'height','image_storage','image_pccc')
                                    ->where('user_id', Auth::id())->get();
        // dd(Auth::id());
        if(!empty($this->v['infoWarehouse'])){
            foreach ($this->v['infoWarehouse'] as $key => $value) {
                if(!empty($value->image_storage)){
                    $imageStorage = json_decode( $value->image_storage );
                    $arrImgStorage = [];
                    if(!empty($imageStorage)){
                        foreach ($imageStorage as $keyImg => $valueImg) {
                            $arrImgStorage[] = asset('storage/'.$valueImg);
                        }
                    }
                    $this->v['infoWarehouse'][$key]['image_storage'] = $arrImgStorage;
                }
                if(!empty($value->image_pccc)){
                    $imageStorage = json_decode( $value->image_pccc );
                    $arrImgStorage = [];
                    if(!empty($imageStorage)){
                        foreach ($imageStorage as $keyImg => $valueImg) {
                            $arrImgStorage[] = asset('storage/'.$valueImg);
                        }
                    }
                    $this->v['infoWarehouse'][$key]['image_pccc'] = $arrImgStorage;
                }
            }
        }
        // dd($this->v);
        return view('screens.storage.account.profile-warehouse', $this->v);
    }
    public function updateProfileWarehouse(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'type' => 'required|integer|between:1,3',
            // 'normalImageStorage' => 'required_if:type,1|array|min:1',
            // 'coldImageStorage' => 'required_if:type,2|array|min:1',
            // 'warehouseImageStorage' => 'required_if:type,3|array|min:1',
        ], [

        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
            // return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
            return redirect()->back()->with('error', 'Ảnh kho chưa có');
        }
        try {

        $pathNormalImageStorage = 'image/users/storage/normal/image_storage/'. Auth::id();
        $pathNormalImagePccc = 'image/users/storage/normal/image_pccc/'. Auth::id();
        $pathColdImageStorage = 'image/users/storage/cold/image_storage/'. Auth::id();
        $pathColdImagePccc = 'image/users/storage/cold/image_pccc/'. Auth::id();
        $pathWarehouseImageStorage = 'image/users/storage/warehouse/image_storage/'. Auth::id();
        $pathWarehouseImagePccc = 'image/users/storage/warehouse/image_pccc/'. Auth::id();


        $arrNormalImageStorage = [];
        $arrNormalImagePccc = [];
        $arrColdImageStorage = [];
        $arrColdImagePccc = [];
        $arrWarehouseImageStorage = [];
        $arrWarehouseImagePccc = [];

        if(!empty($request->normalImageStorage)){
            foreach (json_decode($request->normalImageStorage) as $image) {
                $arrNormalImageStorage[] = $this->saveImgBase64($image, $pathNormalImageStorage);
            }
        }
        if(!empty($request->normalImagePccc)){
            foreach (json_decode($request->normalImagePccc) as $image) {
                $arrNormalImagePccc[] = $this->saveImgBase64($image, $pathNormalImagePccc);
            }
        }
        if(!empty($request->coldImageStorage)){
            foreach (json_decode($request->coldImageStorage) as $image) {
                $arrColdImageStorage[] = $this->saveImgBase64($image, $pathColdImageStorage);
            }
        }
        if(!empty($request->coldImagePccc)){
            foreach (json_decode($request->coldImagePccc) as $image) {
                $arrColdImagePccc[] = $this->saveImgBase64($image, $pathColdImagePccc);
            }
        }
        if(!empty($request->warehouseImageStorage)){
            foreach (json_decode($request->warehouseImageStorage) as $image) {
                $arrWarehouseImageStorage[] = $this->saveImgBase64($image, $pathWarehouseImageStorage);
            }
        }
        if(!empty($request->warehouseImagePccc)){
            foreach (json_decode($request->warehouseImagePccc) as $image) {
                $arrWarehouseImagePccc[] = $this->saveImgBase64($image, $pathWarehouseImagePccc);
            }
        }

        $dataUpdate = WarehouseType::where('user_id', Auth::id())
                                    ->where('type',$request->type)
                                    ->update(
                                        [
                                            'acreage' => $request->acreage,
                                            'volume' => $request->volume,
                                            'length' => $request->length,
                                            'width' => $request->width,
                                            'height' => $request->height,
                                        ]);
        if(!empty($arrNormalImageStorage)){
            $dataUpdate = WarehouseType::where('user_id', Auth::id())
                                    ->where('type',$request->type)
                                    ->update(['image_storage' => $arrNormalImageStorage ?? null]);
        }
        if(!empty($arrNormalImagePccc)){
            $dataUpdate = WarehouseType::where('user_id', Auth::id())
                                    ->where('type',$request->type)
                                    ->update(['image_pccc' => $arrNormalImagePccc ?? null]);
        }
        if(!empty($arrColdImageStorage)){
            $dataUpdate = WarehouseType::where('user_id', Auth::id())
                                    ->where('type',$request->type)
                                    ->update(['image_storage' => $arrColdImageStorage ?? null]);
        }
        if(!empty($arrColdImagePccc)){
            $dataUpdate = WarehouseType::where('user_id', Auth::id())
                                    ->where('type',$request->type)
                                    ->update(['image_pccc' => $arrColdImagePccc ?? null]);
        }
        if(!empty($arrWarehouseImageStorage)){
            $dataUpdate = WarehouseType::where('user_id', Auth::id())
                                    ->where('type',$request->type)
                                    ->update(['image_storage' => $arrWarehouseImageStorage ?? null]);
        }
        if(!empty($arrWarehouseImagePccc)){
            $dataUpdate = WarehouseType::where('user_id', Auth::id())
                                    ->where('type',$request->type)
                                    ->update(['image_pccc' => $arrWarehouseImagePccc ?? null]);
        }

        return redirect()->back()->with('success', 'Cập nhật thông tin kho thành công');
        } catch (\Exception $exception) {
            // dd($exception->getMessage());
            return redirect()->back()->with('error', 'Ảnh kho chưa có');
        }
    }
    protected function saveImgBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return $folder . '/' .$fileName;
    }

    public function profile(Request $request)
    {
//        return 1;
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $this->v['infoAccount'] = User::with(['province', 'district', 'ward'])->where('id', Auth::id())->first();
        $this->v['infoAccount']->storage_information = json_decode($this->v['infoAccount']->storage_information);
        $this->v['infoWarehouse'] = WarehouseType::select('type', 'acreage', 'volume', 'length', 'width', 'height')->where('user_id', Auth::id())->get();

        return view('screens.storage.account.profile', $this->v);

    }

    public function editProfile(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'company_name' => 'required|max:100',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'id_vdone' => 'required',
            // 'floor_area' => 'required',
            // 'volume' => 'required',
            // 'cold_storage' => 'required',
            // 'warehouse' => 'required',
            // 'normal_storage' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
        ], [
            'name.required' => 'Tên bắt buộc nhập',
            'name.max' => 'Tên  tối đa 30 ký tự',
            'company_name.required' => 'Tên công ty bắt buộc nhập',
            'company_name.max' => 'Tên công ty tối đa 100 ký tự',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone_number.required' => 'Số điện thoại bất buộc nhập',
            'phone_number.regex' => 'Số điện thoại không hợp lệ',
            'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
            // 'floor_area.required' => 'trường này không được trống',
            // 'volume.required' => 'Trường này không được trống',
            // 'cold_storage.required' => 'Trường này không được trống',
            // 'warehouse.required' => 'Trường này không được trống',
            // 'normal_storage.required' => 'Trường này không được trống',
            'city_id.required' => 'Trường này không được trống',
            'district_id.required' => 'Trường này không được trống',
            'ward_id.required' => 'Trường này không được trống',

        ]);
        if ($validator->fails()) {
            // dd($validator->errors());
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


            $address = $user->ward->wards_name . ',' . $user->district->district_name . ', ' . $user->province->province_name;

            $result = getLatLongByAddress($address);
            if (!$result) {
                return redirect()->back()->with('error', 'Địa chỉ không hợp lệ');
            }

            $lat = $result['lat'];
            $long = $result['lng'];

            $warehouse = Warehouses::where('user_id', $user->id)->first();
            $warehouse->name = $request->name;
            $warehouse->address = $request->address;
            $warehouse->ward_id = $request->ward_id;
            $warehouse->city_id = $request->city_id;
            $warehouse->district_id = $request->district_id;
            $warehouse->lat = $lat;
            $warehouse->long = $long;
            $warehouse->save();
            return redirect()->back()->with('success', 'Cập nhật thông tin tài khoản thành công');

        } catch (Exception $e) {
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
//        return 1;
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
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
//            'password_confirmation.required'=>'vvUI LONG NHẬP '
            'password_confirmation' => 'Xác nhận mật khẩu bắt buộc nhập'

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
        return view('screens.storage.account.edit_tax_code');
    }

    public function saveChangeTaxCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tax_code' => 'required|regex:/^[0-9]{10,13}$/',
        ], [
            'tax_code.required' => 'Mã số thuế bắt buộc nhập',
            'tax_code.regex' => 'Mã số thuế không hợp lệ'
        ]);


        if ($validator->fails()) {
            return 1;
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        try {
            if (DB::table('users')->where('tax_code', $request->tax_code)->where('role_id', Auth::user()->role_id)->count() > 0) {
                return redirect()->back()->withErrors(['tax_code' => 'Mã số thuế đã được đăng ký'])->withInput($request->all());

            }
            if (DB::table('users')->where('tax_code', $request->tax_code)->whereIn('role_id', [2, 3])->count() > 0) {
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
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại');
        }
    }
}
