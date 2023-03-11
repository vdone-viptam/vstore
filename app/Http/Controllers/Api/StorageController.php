<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StorageController extends Controller
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

    public function index(Request $request)
    {

//        return Auth::user();
        $limit = $request->limit ?? 10;
        $products = Category::join('products', 'categories.id', '=', 'products.category_id')
            ->join('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id')
            ->groupBy('products.id')
            ->select('products.id', 'products.publish_id', 'products.images', 'products.name as name', 'categories.name as cate_name', 'products.price', 'product_warehouses.ware_id', 'product_warehouses.product_id', 'product_warehouses.amount');

//        return Auth::user();

        if ($request->key_search) {

            $products = $products->where('products.publish_id', 'like', '%' . $request->key_search . '%')
                ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
        }
        $products = $products->where('warehouses.user_id', Auth::id())
            ->where('product_warehouses.status', '!=', 3)
            ->paginate($limit);
        foreach ($products as $pro) {
            $pro->amount_product = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2 AND ware_id =" . $pro->ware_id . " AND product_id = " . $pro->product_id . ") as amount FROM product_warehouses where status = 1 AND ware_id =" . $pro->ware_id . " AND product_id = " . $pro->product_id . ""))[0]->amount ?? 0;
        }
        $this->v['products'] = $products;
        $this->v['params'] = $request->all();
//        return  $this->v;
        return response()->json([
            'status_code' => 200,
            'data' => $this->v['products']
        ], 200);
//        return view('screens.storage.product.index', $this->v);
    }

    public function request(Request $request)
    {
        $limit = $request->limit ?? 10;
        $this->v['requests'] = Product::select('category_id', 'products.user_id', 'product_warehouses.amount', 'product_warehouses.id', 'product_warehouses.created_at', 'product_warehouses.status', 'products.name')
            ->join("product_warehouses", 'products.id', '=', 'product_warehouses.product_id')
            ->join('warehouses', 'product_warehouses.ware_id', '=', 'warehouses.id');
        if ($request->key_search) {
            $this->v['requests'] = $this->v['requests']->where('product_warehouses.id', 'like', '%' . str_replace('YC', '', $request->key_search) . '%')
                ->orWhere('products.name', 'like', '%' . $request->key_search . '%');
        }
        $this->v['requests'] = $this->v['requests']->whereIn('product_warehouses.status',[0,1,5])->where('warehouses.user_id', Auth::id())->paginate($limit);

        $this->v['params'] = $request->all();
        return response()->json([
            'status_code' => 200,
            'data' => $this->v['requests']
        ], 200);
//        return view('screens.storage.product.request', $this->v);

    }

}
