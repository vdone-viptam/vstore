<?php

namespace App\Http\Controllers\Api\storage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required',
                'company_name' => 'required',
                'tax_code' => 'required|digits:10',
                'address' => 'required|max:255',
                'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
                'id_vdone' => 'required|max:255',
                'floor_area' => 'required',
                'volume' => 'required',
                'image_storage' => 'required',
                'image_pccc' => 'required',
                'city_id' => 'required',
                'district_id' => 'required'

            ], [
                'email.required' => 'Email bắt buộc nhập',
                'email.email' => 'Email không đúng dịnh dạng',
                'name.required' => 'Tên bắt buộc nhập',
                'company_name.required' => 'Tên công ty bắt buộc nhập',
                'tax_code.required' => 'Mã số thuế bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone_number.required' => 'Số điện thoại bất buộc nhập',
                'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
                'floor_area.required' => 'Diện tích kho bắt buộc nhập',
                'volume.required' => 'Thể tích kho bắt buộc nhập',
                'image_storage.required' => 'Ảnh kho bắt buộc nhập',
                'image_pccc.required' => 'Ảnh chứng minh bắt buộc nhập',
                'city_id' => 'Tỉnh (thành phố) bắt buộc chọn',
                'district_id' => 'Quận (huyện) bắt buộc chọn',
                'tax_code.digits' => 'Mã số phải có độ dài 10 ký tự',
                'phone_number.regex' => 'Số điện thoại không hợp lệ'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'messages' => $validator->errors()
                ]);
            }


            DB::beginTransaction();
            $checkEmail = DB::table('users')
                ->where('email', $request->email)
                ->where('role_id', 4)
                ->count();

            if ($checkEmail > 0) {
                return response()->json([
                    'success' => false,
                    'messages' => ['email' => 'Email đã được đăng ký.']
                ]);
            }

            $checkTax = DB::table('users')
                ->where('tax_code', $request->tax_code)
                ->where('role_id', 4)
                ->count();
            if ($checkTax > 0) {
                return response()->json([
                    'success' => false,
                    'messages' => ['tax_code' => 'Mã số thuế đã được đăng ký.']
                ]);
            }

            $checkTax2 = DB::table('users')
                ->where('name', $request->name)
                ->where('role_id', 4)
                ->count();
            if ($checkTax2 > 0) {
                return response()->json([
                    'success' => false,
                    'messages' => ['name' => 'Tên đã tồn tại.']
                ]);
            }

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
            $user->role_id = 4;
            $user->slug = Str::slug($request->name);
            $cold_storage = $request->cold_storage ?? '';
            $warehouse = $request->warehouse ?? '';
            $normal_storage = $request->normal_storage ?? $request->volume;
            $file = [];

            foreach ($request->image_storage as $image) {
                $file = base64_decode($image);
                $folderName = '/image/users/';
                $safeName = str_random(10) . '.' . 'png';
                $destinationPath = public_path() . $folderName;
                file_put_contents(public_path() . '/image/users/' . $safeName, $file);

                //save new file path into db
                $file[] = $safeName;
            }
            $file1 = [];
            foreach ($request->image_pccc as $image) {
                $file = base64_decode($image);
                $folderName = '/image/users/';
                $safeName = str_random(10) . '.' . 'png';
                $destinationPath = public_path() . $folderName;
                file_put_contents(public_path() . '/image/users/' . $safeName, $file);

                //save new file path into db
                $file1[] = $safeName;
            }
            $storage_information = [
                'floor_area' => $request->floor_area,
                'volume' => $request->volume,
                'image_storage' => json_encode($file),
                'image_pccc' => json_encode($file1),
                'cold_storage' => $cold_storage,
                'warehouse' => $warehouse,
                'normal_storage' => $normal_storage,
            ];
            $user->storage_information = json_encode($storage_information);
            $user->provinceId = $request->city_id;
            $user->district_id = $request->district_id;
            $user->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Đăng ký thành công'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ], [
                'email.required' => 'Email bắt buộc nhập',
                'password.required' => 'Mật khẩu bắt buộc nhập',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'messages' => $validator->errors()
                ]);
            }

            if (Auth::attempt(['account_code' => $request->email, 'password' => $request->password, 'role_id' => 4]) || Auth::attempt(['code' => $request->email, 'password' => $request->password, 'role_id' => 4])) {
                $user = User::where('account_code', $request->email)->orWhere('code', $request->email)->first();
                $tokenResult = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'status_code' => 200,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => $user,
                    'success' => true
                ]);
            }
            return response()->json([
                'status_code' => 500,
                'success' => false,
                'message' => 'Tài khoản, mật khẩu không chính xác',
            ]);

        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'success' => false,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }

}
