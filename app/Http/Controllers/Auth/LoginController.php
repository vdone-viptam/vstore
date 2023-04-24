<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Lib9Pay\HMACSignature;
use App\Http\Lib9Pay\MessageBuilder;
use App\Models\OrderService;
use App\Models\District;
use App\Models\Otp;
use App\Models\PasswordReset;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use Carbon\Carbon;
use Http\Client\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //

    public function getFormRegisterVstore(Request $request)
    {
        $referral_code = $request->referral_code ?? '';

        return view('auth.Vstore.register_vstore', ['referral_code' => $referral_code]);
    }

    public function getFormRegisterNCC(Request $request)
    {
        $user = false;
        $order = false;
        if($request->order && $request->user) {
            $user = User::find($request->user);
            $order = OrderService::find($request->order);
            $latestOrder = OrderService::orderBy('created_at', 'DESC')->first();
            $order->no = Str::random(5) . str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);
            $order->status = 2;
            $order->save();
        }

        $referral_code = $request->referral_code ?? '';
        return view('auth.NCC.register_ncc', compact(['referral_code', 'user', 'order']));
    }

    public function getFormRegisterVstorage(Request $request)
    {

        $user = false;
        $order = false;
        if($request->order && $request->user) {
            $user = User::find($request->user);
            $order = OrderService::find($request->order);
            $latestOrder = OrderService::orderBy('created_at', 'DESC')->first();
            $order->no = Str::random(5) . str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);
            $order->status = 2;
            $order->save();
        }

        $referral_code = $request->referral_code ?? '';

        return view('auth.storage.register_storage', compact(['referral_code', 'user', 'order']));
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

    public function postRegisterOrderNcc(Request $request){
        $validator = Validator::make($request->all(), [
            'method_payment' => 'required|in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER',
            'order_id' => 'required',
        ]);

        $order_id = $request->order_id;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        $method = $request->method_payment;

        $order = OrderService::where('id', $order_id)
            ->where('status', 2)
            ->first();

        if(!$order) {
            return redirect()->back()->withErrors([
                "orderErr" => "Hành động không được thực hiện, vui lòng thử lại"
            ]);
        }
        $order->status = config('constants.orderServiceStatus.confirmation');
        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';

        $returnUrl = $http . config("domain.payment") . "/payment/order-service-ncc/back";
        $backUrl = $http . config("domain.payment") . "/payment/order-service-ncc/return";

        $time = time();
        $invoiceNo = $order->no;
        $amount = (float)$order->total;

        $merchantKey = config('payment9Pay.merchantKey');
        $merchantKeySecret = config('payment9Pay.merchantKeySecret');
        $merchantEndPoint = config('payment9Pay.merchantEndPoint');

        $data = array(
            'merchantKey' => $merchantKey,
            'time' => $time,
            'invoice_no' => $invoiceNo,
            'description' => 'Mua dịch vụ',
            'amount' => $amount + ($amount*(10/100)),
            'back_url' => $backUrl,
            'return_url' => $returnUrl,
            'method' => $method,
            'is_customer_pay_fee' => 1 // Đối tượng chịu phí. 0: người bán chịu phí, 1: khách hàng chịu phí
        );
        $message = MessageBuilder::instance()
            ->with($time, $merchantEndPoint . '/payments/create', 'POST')
            ->withParams($data)
            ->build();
        $hmacs = new HMACSignature();
        $signature = $hmacs->sign($message, $merchantKeySecret);
        $httpData = [
            'baseEncode' => base64_encode(json_encode($data, JSON_UNESCAPED_UNICODE)),
            'signature' => $signature,
        ];

        $order->method_payment = $method;
        $order->save();

        try {
            $redirectUrl = $merchantEndPoint . '/portal?' . http_build_query($httpData);
            return redirect()->to($redirectUrl);
        } catch (Exception $e) {
            Log::error($e);
            dd($e);
            return response()->json([
                "message" => "500 Internal Server Error",
                "errors" => $e
            ], 500);
        }

    }
    public function postRegisterOrderKho(Request $request){
        $validator = Validator::make($request->all(), [
            'method_payment' => 'required|in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER',
            'order_id' => 'required',
        ]);

        $order_id = $request->order_id;

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }

        $method = $request->method_payment;

        $order = OrderService::where('id', $order_id)
            ->where('status', 2)
            ->first();

        if(!$order) {
            return redirect()->back()->withErrors([
                "orderErr" => "Hành động không được thực hiện, vui lòng thử lại"
            ]);
        }
        $order->status = config('constants.orderServiceStatus.confirmation');
        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://';

        $returnUrl = $http . config("domain.payment") . "/payment/order-service-kho/back";
        $backUrl = $http . config("domain.payment") . "/payment/order-service-kho/return";

        $time = time();
        $invoiceNo = $order->no;
        $amount = (float)$order->total;

        $merchantKey = config('payment9Pay.merchantKey');
        $merchantKeySecret = config('payment9Pay.merchantKeySecret');
        $merchantEndPoint = config('payment9Pay.merchantEndPoint');

        $data = array(
            'merchantKey' => $merchantKey,
            'time' => $time,
            'invoice_no' => $invoiceNo,
            'description' => 'Mua dịch vụ',
            'amount' => $amount + ($amount*(10/100)),
            'back_url' => $backUrl,
            'return_url' => $returnUrl,
            'method' => $method,
            'is_customer_pay_fee' => 1 // Đối tượng chịu phí. 0: người bán chịu phí, 1: khách hàng chịu phí
        );
        $message = MessageBuilder::instance()
            ->with($time, $merchantEndPoint . '/payments/create', 'POST')
            ->withParams($data)
            ->build();
        $hmacs = new HMACSignature();
        $signature = $hmacs->sign($message, $merchantKeySecret);
        $httpData = [
            'baseEncode' => base64_encode(json_encode($data, JSON_UNESCAPED_UNICODE)),
            'signature' => $signature,
        ];

        $order->method_payment = $method;
        $order->save();

        try {
            $redirectUrl = $merchantEndPoint . '/portal?' . http_build_query($httpData);
            return redirect()->to($redirectUrl);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json([
                "message" => "500 Internal Server Error",
                "errors" => $e
            ], 500);
        }

    }

    public function postFormRegister(Request $request) // FORM SUBMIT ĐĂNG kÝ
    {
        $domain = $request->getHttpHost();
        $role_id = 0;
        if ($domain == config('domain.admin')) {
            $role_id = 1;
        }
        if ($domain == config('domain.ncc')) { // Nhà Cung cấp
            $role_id = 2;
        }
        if ($domain == config('domain.vstore')) { // Vstore
            $role_id = 3;
        }
        if ($domain == config('domain.storage')) { // Kho
            $role_id = 4;
        }

        if ($role_id == 3) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|max:32',
                'company_name' => 'required|max:50',
                'tax_code' => 'required|regex:/^[0-9]{10,13}$/',
                'address' => 'required',
                'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
                'id_vdone' => 'required',
                'city_id' => 'required',
                'district_id' => 'required',
            ], [
                'email.required' => 'Email bắt buộc nhập',
                'email.email' => 'Email không đúng dịnh dạng',
                'name.required' => 'Tên nhà V-store bắt buộc nhập',
                'name.max' => 'Tên nhà V-store tối đa 30 ký tự',
                'company_name.required' => 'Tên công ty bắt buộc nhập',
                'company_name.max' => 'Tên công ty tối đa 50 kí tự',
                'tax_code.required' => 'Mã số thuế bắt buộc nhập',
                'tax_code.digits' => 'Mã số phải có độ dài 10 hoặc 13 ký tự',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone_number.required' => 'Số điện thoại bất buộc nhập',
                'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
                'city_id' => 'Tỉnh (thành phố) bắt buộc chọn',
                'district_id' => 'Quận (huyện) bắt buộc chọn',
                'phone_number.regex' => 'Số điện thoại không hợp lệ',

            ]);
        } elseif ($role_id == 4) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|max:32',
                'company_name' => 'required|max:50',
                'tax_code' => 'required|regex:/^[0-9]{10,13}$/',
                'address' => 'required|max:255',
                'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
                'id_vdone' => 'required|max:255',
                'floor_area' => 'required',
                'volume' => 'required',
                'image_storage' => 'required',
                'image_storage.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'image_pccc.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
                'city_id' => 'required',
                'district_id' => 'required',
                'ward_id' => 'required'
            ], [
                'email.required' => 'Email bắt buộc nhập',
                'email.email' => 'Email không đúng dịnh dạng',
                'name.required' => 'Tên bắt buộc nhập',
                'name.max' => 'Tên tối đa 30 ký tự',
                'company_name.required' => 'Tên công ty bắt buộc nhập',
                'company_name.max' => 'Tên công ty tối đa 100 ký tự',
                'tax_code.required' => 'Mã số thuế bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone_number.required' => 'Số điện thoại bất buộc nhập',
                'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
                'floor_area.required' => 'Diện tích kho bắt buộc nhập',
                'volume.required' => 'Thể tích kho bắt buộc nhập',
                'image_storage.required' => 'Ảnh kho bắt buộc nhập',
                'image_storage.image' => 'Không đúng định dạng ảnh',
                'image_storage.*' => 'Không đúng định dạng ảnh !',
                'image_pccc.image' => 'Không đúng định dạng ảnh',
                'city_id' => 'Tỉnh (thành phố) bắt buộc chọn',
                'district_id' => 'Quận (huyện) bắt buộc chọn',
                'ward_id' => 'Phường (xã) bắt buộc chọn',
                'tax_code.digits' => 'Mã số phải có độ dài 10 hoặc 13 ký tự',
                'phone_number.regex' => 'Số điện thoại không hợp lệ'
            ]);
        } elseif ($role_id == 2) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required|max:32',
                'company_name' => 'required|max:50',
                'tax_code' => 'required|regex:/^[0-9]{10,13}$/',
                'address' => 'required',
                'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
                'id_vdone' => 'required',
                'city_id' => 'required',
                'district_id' => 'required'
            ], [
                'email.required' => 'Email bắt buộc nhập',
                'email.email' => 'Email không đúng dịnh dạng',
                'name.required' => 'Tên nhà cung cấp bắt buộc nhập',
                'name.max' => 'Tên nhà cung cấp tối đa 30 ký tự',
                'company_name.unique' => 'Tên công ty đã tồn tại',
                'company_name.max' => 'Tên công ty tối đa 100 kí tự',
                'company_name.required' => 'Tên công ty bắt buộc nhập',
                'tax_code.required' => 'Mã số thuế bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone_number.required' => 'Số điện thoại bất buộc nhập',
                'id_vdone.required' => 'ID người đại điện bắt buộc nhập',
                'city_id' => 'Tỉnh (thành phố) bắt buộc chọn',
                'district_id' => 'Quận (huyện) bắt buộc chọn',
                'tax_code.digits' => 'Mã số phải có độ dài 10 hoặc 13 ký tự',
                'phone_number.regex' => 'Số điện thoại không hợp lệ',
                'ward_id.required' => 'Phường (xã) bắt buộc chọn',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }


        try {
            DB::beginTransaction();
            $checkEmail = DB::table('users')
                ->where('email', $request->email)
                ->where('role_id', $role_id)
                ->whereNotNull("account_code")
                ->whereNotNull("confirm_date")
                ->count();
            $error = null;
            if ($checkEmail > 0) {
                $error['email'] = 'Email đã được đăng ký.';
            }
            if ($role_id != 4) {
                $checkTax = DB::table('users')
                    ->where('tax_code', $request->tax_code)
                    ->whereNotNull("account_code")
                    ->whereNotNull("confirm_date")
                    ->where('role_id', $role_id)
                    ->count();
                if ($checkTax > 0) {
                    $error['tax_code'] = 'Mã số thuế đã được đăng ký';
                }
            }
            if ($role_id != 4) {
                $checkTax = DB::table('users')
                    ->where('company_name', $request->company_name)
                    ->where('role_id', $role_id)
                    ->whereNotNull("account_code")
                    ->whereNotNull("confirm_date")
                    ->count();
                if ($checkTax > 0) {
                    $error['company_name'] = 'Tên công ty đã được đăng ký';
                }
            }

            $checkTax2 = DB::table('users')
                ->where('name', $request->name)
                ->where('role_id', $role_id)
                ->whereNotNull("account_code")
                ->whereNotNull("confirm_date")
                ->count();
            if ($checkTax2 > 0) {
                $error['name'] = 'Tên đã được đăng ký';
            }
            $checkTax3 = DB::table('users')
                ->where('phone_number', $request->phone_number)
                ->where('role_id', $role_id)
                ->whereNotNull("account_code")
                ->whereNotNull("confirm_date")
                ->count();
            if ($checkTax3 > 0) {
                $error['phone_number'] = 'Số điện thoại đã được đăng ký';
            }
            if ($error !== null) {
                return redirect()->back()->withErrors($error)->withInput($request->all());
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->id_vdone = $request->id_vdone;
            $user->company_name = $request->company_name;
            $user->password = Hash::make(rand(100000, 999999));
            $user->phone_number = $request->phone_number;
            $user->tax_code = $request->tax_code;
            $referral_code = $request->referral_code ?? '';
            $user->referral_code = $referral_code;
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
                $file = [];
                if ($request->hasFile('image_storage')) {


                    foreach ($request->file('image_storage') as $img) {
                        $filestorage = date('YmdHi') . $img->getClientOriginalName();
                        $img->move(public_path('image/users'), $filestorage);
                        $file[] = 'image/users/' . $filestorage;
                    }


                }
                $file1 = [];
                if ($request->hasFile('image_pccc')) {

                    foreach ($request->file('image_pccc') as $img) {
                        $filepccc = date('YmdHi') . $img->getClientOriginalName();
                        $img->move(public_path('image/users'), $filepccc);
                        $file1[] = 'image/users/' . $filepccc;
                    }
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
            }
            $user->provinceId = $request->city_id;
            $user->district_id = $request->district_id;
            $user->ward_id = $request->ward_id;

//            $user->save();

            DB::commit();

            if ($role_id == 2) {
                $userUpdateOrCreate = User::updateOrCreate([
                    "email" => $request->email,
                    "role_id" => 2,
                    "confirm_date" => null,
                    "account_code" => null
                ], $user->toArray());
                $user->id = $userUpdateOrCreate->id;
                $order = new OrderService();
                $order->user_id = $user->id;
                $order->type = "NCC";
                $order->status = 2; // 2 là chưa hoàn thành
                $order->payment_status = 2; // 2 là chưa thanh toán
                $order->method_payment = 'ATM_CARD'; // in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD
                $latestOrder = OrderService::orderBy('created_at', 'DESC')->first();
                $order->no = Str::random(5) . str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);
                $order->total = config('constants.orderService.price_ncc');
                $order->save();

                return redirect()
                    ->back()
                    ->with([
                        "order" => $order,
                        "user" => $user
                    ]);
            }

            if ($role_id == 3) {

                $user->save();

                $order = new OrderService();
                $order->user_id = $user->id;
                $order->type = "VSTORE";
                $order->status = 1; // 2 là chưa hoàn thành
                $order->payment_status = 3; // 2 là chưa thanh toán
                $order->method_payment = 'ATM_CARD'; // in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD
                $latestOrder = OrderService::orderBy('created_at', 'DESC')->first();
                $order->no = Str::random(5) . str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);
                $order->total = config('constants.orderService.price_ncc');
                $order->save();

                return redirect()->route('login_vstore')->with('success', 'Đăng ký tài khoản thành công, chờ xét duyệt. Hệ thống sẽ gửi thông tin tài khoản vào mail đã đăng ký.');
            }

            if ($role_id == 4) {
                $userUpdateOrCreate = User::updateOrCreate([
                    "email" => $request->email,
                    "role_id" => 4,
                    "confirm_date" => null,
                    "account_code" => null
                ], $user->toArray());
                $user->id = $userUpdateOrCreate->id;
                $order = new OrderService();
                $order->user_id = $user->id;
                $order->type = "KHO";
                $order->status = 2; // 2 là chưa hoàn thành
                $order->payment_status = 2; // 2 là chưa thanh toán
                $order->method_payment = 'ATM_CARD'; // in:ATM_CARD,CREDIT_CARD,9PAY,BANK_TRANSFER,COD
                $latestOrder = OrderService::orderBy('created_at', 'DESC')->first();
                $order->no = Str::random(5) . str_pad(isset($latestOrder->id) ? ($latestOrder->id + 1) : 1, 8, "0", STR_PAD_LEFT);
                $order->total = config('constants.orderService.price_kho');
                $order->save();
                return redirect()
                    ->back()
                    ->with([
                        "order" => $order,
                        "user" => $user
                    ]);

//                return redirect()->route('login_storage')->with('success', 'Đăng ký tài khoản thành công, chờ xét duyệt. Hệ thống sẽ gửi thông tin tài khoản vào mail đã đăng ký.');
            }

            return redirect()->back()->with('error', 'Yêu cầu không hợp lệ');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }

    public
    function postLogin(Request $request)
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

            if (Auth::attempt(['account_code' => $request->email, 'password' => $request->password, 'role_id' => $role_id]) || Auth::attempt(['code' => $request->email, 'password' => $request->password, 'role_id' => $role_id])) {
                if (Auth::user()->status == 4) {
                    return redirect()->back()->with('error', 'Tài khoản đã hết hạn sử dụng.Liên hệ quản trị viên để gia hạn tài khoản');
                }
//                return Auth::user();
                $token = Str::random(32);
                $userLogin = Auth::user();
                $login = new Otp();
                $login->code = rand(100000, 999999);
                $login->user_code = $userLogin->id;
                $login->number = 0;
                $login->save();
                $message1 = '';
                if ($role_id == 1) {
                    $message1 = 'Mã xác thực đăng nhập tài khoản Admin';
                }
                if ($role_id == 2) {
                    $message1 = 'Mã xác thực đăng nhập tài khoản Nhà cung cấp';
                }
                if ($role_id == 3) {
                    $message1 = 'Mã xác thực đăng nhập tài khoản V-Store';
                }
                if ($role_id == 4) {
                    $message1 = 'Mã xác thực đăng nhập tài khoản KHO';
                }
                Mail::send('email.otp', ['confirm_code' => $login->code, 'role_id' => $role_id], function ($message) use ($userLogin, $message1) {
                    $message->to($userLogin->email);
                    $message->subject($message1);
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

    public
    function getLogin()
    {
        return view('auth.login');
    }

    public
    function formForgotPassword(Request $request)
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

    public
    function postForgotPassword(Request $request)
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
        $message1 = '';
        $domain = $request->getHttpHost();
        if ($domain == config('domain.admin')) {
            $role_id = 1;
            $message1 = 'Xác thực quên mật khẩu tài khoản Admin';
        }
        if ($domain == config('domain.ncc')) {
            $role_id = 2;
            $message1 = 'Xác thực quên mật khẩu tài khoản Nhà cung cấp';
        }
        if ($domain == config('domain.vstore')) {
            $role_id = 3;
            $message1 = 'Xác thực quên mật khẩu tài khoản V-Store';
        }
        if ($domain == config('domain.storage')) {
            $role_id = 4;
            $message1 = 'Xác thực quên mật khẩu tài khoản KHO';
        }
        $user = User::where('email', $request->email)->where('role_id', $role_id)->where('account_code', '!=', null)->first();
        if ($user) {
            $passwordReset = PasswordReset::where('email', $request->email)->where('role_id', $role_id)->delete();
            $token = Str::random(32);
            DB::table('password_resets')
                ->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now(), 'role_id' => $role_id]);
            Mail::send('email.forgot', ['token' => $token, 'role_id' => $role_id], function ($message) use ($user, $message1) {
                $message->to($user->email);
                $message->subject($message1);
            });

            return redirect()->route('form_forgot_password')->with('success', 'Đường link đổi mật khẩu đã được gửi vào mail');
        } else {
            return redirect()->route('form_forgot_password')->with('error', 'Không tìm thầy tài khoản');
        }
    }

    public
    function formResetForgot($token, Request $request)
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
        if ($passwordReset) {
            if (Carbon::now()->diffInSeconds($passwordReset->created_at) > 180) {
                return redirect()->route('form_forgot_password')->with('error', 'Token của bạn đã hết hạn');
            } else {
                return view('auth.formReset', ['role_id' => $role_id]);
            }
        } else {
            return redirect()->route('form_forgot_password')->with('error', 'Token của bạn đã hết hạn');
        }


    }

    public
    function postResetForgot(Request $request, $token)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|max:30|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%]).*$/',
            'password_confirmation' => 'required',
            'role_id' => 'required',
        ], [
            'password.required' => 'Email bắt buộc nhập',
            'password.min' => 'Mật khẩu không đúng định dạng',
            'password.max' => 'Mật khẩu nhiều không đúng định dạng',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được trống',
            'password.regex' => 'Mật khẩu không đúng định dạng'
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

    public
    function getLogout()
    {
        Auth::logout();
        Auth::hasUser();
        return redirect('login');
    }

    public
    function OTP($token1, Request $request)
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

        return view('auth.otp', [
            'token' => $token1,
            'user_id' => $request->id,
            'role_id' => $role_id
        ]);
    }

    public
    function post_OTP(Request $request, $token1)
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

    public
    function reOtp(Request $request)
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
        $user = User::find($request->id);
        $otp = Otp::where('user_code', $user->id)->delete();
        $login = new Otp();
        $login->code = rand(100000, 999999);
        $login->user_code = $user->id;
        $login->save();
        Mail::send('email.otp', ['confirm_code' => $login->code, 'role_id' => $role_id], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Bạn vừa có yêu cầu gửi lại mã xác minh');
        });
        return redirect()->back();
    }


    public
    function getCity(Request $request)
    {
        if ($request->type == 2) {

            $response = District::select('district_id as DISTRICT_ID', 'district_name as DISTRICT_NAME', 'district_value as DISTRICT_VALUE', 'province_id as PROVINCE_ID')
                ->where('province_id', $request->value)->get();
//            return  $response;
//            $response = Http::get('https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId=' . $request->value);
            return $response;
        } elseif ($request->type == 3) {
            $response = Ward::select('wards_id as WARDS_ID', 'district_id as DISTRICT_ID', 'wards_name as WARDS_NAME')->where('district_id', $request->value)->get();
//            $response = Http::get('https://partner.viettelpost.vn/v2/categories/listWards?districtId=' . $request->value);
            return $response;
        } else {
            $response = Province::select('province_id as PROVINCE_ID', 'province_code as PROVINCE_CODE', 'province_name as PROVINCE_NAME')->get();
            return $response;
//            $response = Http::get('https://partner.viettelpost.vn/v2/categories/listProvince');
//            return $response->json('data');

        }
        return $response->json()['data'];
    }
}
