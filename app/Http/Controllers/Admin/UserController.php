<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DepositExport;
use App\Exports\UserExport;
use App\Http\Controllers\Api\ElasticsearchController;
use App\Http\Controllers\Controller;
use App\Http\Lib9Pay\HMACSignature;
use App\Http\Lib9Pay\MessageBuilder;
use App\Models\District;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\Province;
use App\Models\RequestChangeTaxCode;
use App\Models\User;
use App\Models\UserReferral;
use App\Models\Ward;
use App\Models\Warehouses;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function getListRegisterAccount(Request $request)
    {
        $this->v['field'] = $request->field ?? 'users.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';

        $this->v['users'] = User::select('users.name', 'users.id', 'email', 'id_vdone', 'company_name',
            'phone_number', 'tax_code', 'address', 'users.created_at', 'confirm_date', 'users.referral_code', 'users.role_id', 'accountant_confirm');
        $limit = $request->limit ?? 10;
        if (strlen($this->v['key_search']) > 0) {
            $this->v['users'] = $this->v['users']
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $this->v['key_search'] . '%')
                        ->orwhere('company_name', 'like', '%' . $this->v['key_search'] . '%')
                        ->orwhere('email', 'like', '%' . $this->v['key_search'] . '%')
                        ->orwhere('id_vdone', 'like', '%' . $this->v['key_search'] . '%')
                        ->orwhere('phone_number', 'like', '%' . $this->v['key_search'] . '%')
                        ->orwhere('tax_code', '=', $this->v['key_search'])
                        ->orwhere('account_code', 'like', '%' . $this->v['key_search'] . '%')
                        ->orwhere('address', 'like', '%' . $this->v['key_search'] . '%');
                });
        }
        $this->v['count'] = $this->v['users']->count();
        $this->v['users'] = $this->v['users']->join('order_service', 'users.id', '=', 'order_service.user_id')
            ->where('order_service.status', 3)
            ->where('payment_status', 1)
            ->orderBy($this->v['field'], $this->v['type'])
            ->where('role_id', '!=', 1)->paginate($limit);

        $this->v['params'] = $request->all();
        return view('screens.admin.user.index', $this->v);
    }

    public function getListUser(Request $request)
    {
        $this->v['users'] = User::select();
        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['field'] = $request->field ?? 'id';
        $this->v['limit'] = $request->limit ?? 10;
        $limit = $request->limit ?? 10;
        if (isset($request->key_search)) {
            $this->v['users'] = $this->v['users']->orwhere('company_name', 'like', '%' . $request->key_search . '%')
                ->orwhere('name', 'like', '%' . $request->key_search . '%')
                ->orwhere('email', 'like', '%' . $request->key_search . '%')
                ->orwhere('id_vdone', 'like', '%' . $request->key_search . '%')
                ->orwhere('phone_number', 'like', '%' . $request->key_search . '%')
                ->orwhere('tax_code', '=', $request->key_search)
                ->orwhere('account_code', 'like', '%' . $request->key_search . '%')
                ->orwhere('address', 'like', '%' . $request->key_search . '%');
        }
        $this->v['users'] = $this->v['users']->orderBy($this->v['field'], $this->v['type'])->where('account_code', '!=', null)->where('confirm_date', '!=', null)->paginate($limit);
//        return  $this->v['users'];
        return view('screens.admin.user.list_user', $this->v);
    }

    public function confirm($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $ID = $user->tax_code;

            if ($user->role_id == 2) {
                $ID = 'vnncc' . $ID;

            } elseif ($user->role_id == 4) {
                $arr = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                $number = User::where('tax_code', $user->tax_code)->where('confirm_date', '!=', null)->where('role_id', 4)->count();
                if ($number == 0) {
                    $ID = 'vnk' . '01' . $user->tax_code;
                } elseif ($number < 10 && $number > 0) {
                    $ID = 'vnk' . '0' . $number + 1 . $user->tax_code;

                } elseif ($number >= 10) {
                    $ID = 'vnk' . $number + 1 . $user->tax_code;
                }
//                elseif ($number > 99) {
//                    for ($i = 0; $i < count($arr); $i++) {
//                        $a = User::where('account_code', '=', 'vnk' . $arr[round($number % 100 / 10)] . '%' . '-' . $user->tax_code)->count();
//                        if ($a < 8) {
//                            $ID = 'vnk' . $arr[round($number % 1000)] . $a + 1 . '-' . $user->tax_code;
//                        }
//                    }
//                }
            } else {
                $ID = 'vnvst' . $ID;
            }
            $password = rand(1000000, 9999999);
            $user->account_code = $ID;
            $user->password = Hash::make($password);
            $user->confirm_date = Carbon::now();
            $user->expiration_date = Carbon::now()->addDays(365);
            $user->status = 1;
            if (strlen($user->referral_code) > 0) {
                $referral = new UserReferral();
                $referral->user_id = $user->id;
                $referral->vshop_id = $user->referral_code;
                $referral->save();
            }
            $user->save();
            $this->sendAccountant($user);
            if ($user->role_id == 4) {
                $district = District::where('district_id', $user->district_id)->first()->district_name;
                $province = Province::where('province_id', $user->provinceId)->first()->province_name;
                $wards = Ward::where('wards_id', $user->ward_id)->first()->wards_name;

                $address = $wards . ', ' . $district . '. ' . $province;
                $result = getLatLongByAddress($address);
                if (!$result) {
                    return redirect()->back()->with('error', 'Địa chỉ không hợp lệ');
                }

                $lat = $result['lat'];
                $long = $result['lng'];
                $warehouses = new Warehouses();
                $warehouses->name = $user->name;
                $warehouses->phone_number = $user->phone_number;
                $warehouses->address = $user->address;
                $warehouses->city_id = $user->provinceId;
                $warehouses->district_id = $user->district_id;
                $warehouses->ward_id = $user->ward_id;
                $warehouses->user_id = $user->id;
                $warehouses->lat = $lat ?? '19.6397685';
                $warehouses->long = $long ?? '105.7028457';
                $warehouses->save();
            }
            if ($user->role_id == 2) {
                Mail::send('email.active_ncc', ['ID' => $ID, 'password' => $password], function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('V-Store chào mừng quý khách hàng đã đăng ký tài khoản Nhà cung cấp');
                });
//                $elasticsearchController = new ElasticsearchController();
//                try {
//                    $res = $elasticsearchController->createDocNCC((string)$user->id, $user->name);
//                    DB::commit();
//                } catch (ClientResponseException $exception) {
//                    DB::rollBack();
//                    return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
//                }
            }
            if ($user->role_id == 3) {
                Mail::send('email.active_vstore', ['ID' => $ID, 'password' => $password], function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('Chào mừng quý khách hàng đã đăng ký tài khoản V-Store');
                });
//                $elasticsearchController = new ElasticsearchController();
//                try {
//                    $res = $elasticsearchController->createDocVStore((string)$user->id, $user->name);
//                    DB::commit();
//                } catch (ClientResponseException $exception) {
//                    DB::rollBack();
//                    return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
//                }
            }

            if ($user->role_id == 4) {
                Mail::send('email.active_kho', ['ID' => $ID, 'password' => $password], function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('V-Store chào mừng quý khách hàng đã đăng ký tài khoản KHO');
                });
            }
            DB::commit();

            return redirect()->back()->with('success', 'Kích hoạt tài khoản thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
        }
    }

    public function detail(Request $request)
    {
        $user = User::select('name', 'email',
            'id_vdone', 'phone_number', 'tax_code', 'role_id',
            'address', 'created_at', 'storage_information', 'confirm_date', 'referral_code')->where('id', $request->id)->first();
        return $user;
        if ($request->role_id != 4) {
            return view('screens.admin.user.detail', ['user' => $user]);
        }
        $this->v['user'] = json_decode($user->storage_information);
        $this->v['user']->created_at = $user->created_at;

        return view('screens.admin.user.detail_kho', $this->v);
    }

    public function up($id)
    {
        $user = User::find($id);
        if ($user && $user->role_id == 3) {
            $user->branch = 2;
            $user->save();
        }
        return redirect()->route('screens.admin.user.list_user')->with('success', 'Nâng cấp tài khoản thành công');
    }

    public function requestChangeTaxCode(Request $request)
    {
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['field'] = $request->field ?? 'request_change_taxcode.id';
        $this->v['requests'] = RequestChangeTaxCode::select
        (
            'request_change_taxcode.id',
            'request_change_taxcode.code',
            'request_change_taxcode.tax_code',
            'request_change_taxcode.status',
            'users.role_id',
            'users.email',
            'users.id_vdone',
            'users.name',
            'company_name',
            'users.tax_code as old_tax')
            ->orderBy($this->v['field'], $this->v['type'])
            ->join('users', 'request_change_taxcode.user_id', '=', 'users.id');
        if (strlen($this->v['key_search']) > 0) {
            $this->v['requests'] = $this->v['requests']->where(function ($query) {
                $query->where('request_change_taxcode.code', $this->v['key_search'])
                    ->orWhere('users.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('users.email', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('users.id_vdone', $this->v['key_search'])
                    ->orWhere('users.email', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('users.company_name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('users.tax_code', $this->v['key_search'])
                    ->orWhere('request_change_taxcode.tax_code', $this->v['key_search']);;
            });
        }
        $this->v['requests'] = $this->v['requests']->paginate($this->v['limit']);
        return view('screens.admin.user.request', $this->v);
    }

    public function confirmRequest(Request $request)
    {
        DB::beginTransaction();
        try {

            $status = $request->status;
            $request = RequestChangeTaxCode::where('id', $request->id)->first();
            $user = User::where('id', $request->user_id)->first();
            if ($status == 1) {
                if ($user->role_id == 3) {
                    $user->account_code = str_replace($user->tax_code, $request->tax_code, $user->account_code);
                    $ncc = User::where('tax_code', $user->tax_code)->where('role_id', 2)->get();

                    foreach ($ncc as $nc) {
                        $nc->account_code = str_replace($nc->tax_code, $request->tax_code, $nc->account_code);
                        $nc->tax_code = $request->tax_code;
                        $nc->save();
                    }

                    $vkho = User::where('tax_code', $user->tax_code)->where('role_id', 4)->get();

                    foreach ($vkho as $vkh) {
                        $vkh->account_code = str_replace($vkh->tax_code, $request->tax_code, $vkh->account_code);
                        $vkh->tax_code = $request->tax_code;
                        $vkh->save();
                    }
                } elseif ($user->role_id == 2) {
                    $user->account_code = str_replace($user->tax_code, $request->tax_code, $user->account_code);
                    $vkho = User::where('tax_code', $user->tax_code)->where('role_id', 4)->get();
                    foreach ($vkho as $vkh) {
                        $vkh->account_code = str_replace($vkh->tax_code, $request->tax_code, $vkh->account_code);
                        $vkh->tax_code = $request->tax_code;
                        $vkh->save();
                    }
                } else {
                    $user->account_code = str_replace($user->tax_code, $request->tax_code, $user->account_code);
                }
                $user->tax_code = $request->tax_code;
                $user->save();
                $request->status = 1;
                $message = 'Yêu cầu cập nhật mã số thuế của bạn đã được đồng ý';
            } else {
                $message = 'Yêu cầu cập nhật mã số thuế của bạn đã bị từ chối';

                $request->status = 2;
            }
            $request->save();
            if ($user->role_id == 2) {
                $href = route('screens.manufacture.account.profile');
            }
            if ($user->role_id == 3) {
                $href = route('screens.vstore.account.profile');
            }
            if ($user->role_id == 4) {
                $href = route('screens.storage.account.profile');
            }
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                'message' => $message,
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => $href
            ];

            $user->notify(new AppNotification($data));
            DB::commit();

            return response()->json(['message' => 'Cập nhật yêu cầu cập nhật mã số thuế thành công'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Có lỗi xảy ra vui lòng thử lại'], 500);

        }
    }

    public function exportUser()
    {
        return Excel::download(new UserExport, Carbon::now()->format('d-m-Y') . ' -danh_sach_tai_khoan' . '.xlsx');
    }

    public function historyPayment(Request $request)
    {
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['field'] = $request->field ?? 'order_service.id';
        $this->v['histories'] = User::join('order_service', 'users.id', '=', 'order_service.user_id')
            ->select('order_service.id', 'no', 'total', 'type', 'users.name', 'method_payment', 'order_service.status', 'users.email', 'users.phone_number', 'users.company_name', 'order_service.payment_status', 'order_service.created_at')
            ->where('order_service.type', '!=', 'VSTORE');
        if (strlen($this->v['key_search']) > 0) {
            $this->v['histories'] = $this->v['histories']->where(function ($query) {
                $query->where('users.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('order_service.no', $this->v['key_search']);
            });
        }
        $this->v['histories'] = $this->v['histories']->orderBy($this->v['field'], $this->v['type'])->paginate($this->v['limit']);
        return view('screens.admin.user.payment', $this->v);
    }

    public function callAPI($method, $url, $data, $headers = false)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }

    public function checkPayment(Request $request)
    {
        $orderService = OrderService::select('no', 'users.name', 'tax_code', 'phone_number', 'payment_status', 'order_service.status')->join('users', 'order_service.user_id', '=', 'users.id')->where('order_service.id', $request->id)->first();


//        $timestamp = time();

        $invoice_no = $orderService->no;
        $return_url = "https://sand-payment.9pay.vn/v2/payments/$invoice_no/inquire";
        $merchantKey = config('payment9Pay.merchantKey');
        $merchantKeySecret = config('payment9Pay.merchantKeySecret');
        $merchantEndPoint = config('payment9Pay.merchantEndPoint');

        $time = time();
        $data = [];
        $message = MessageBuilder::instance()
            ->with($time, $merchantEndPoint . '/v2/payments/' . $invoice_no . '/inquire', 'GET')
            ->withParams($data)
            ->build();
        $hmacs = new HMACSignature();
        $signature = $hmacs->sign($message, $merchantKeySecret);

        $headers = array(
            'Date: ' . $time,
            'Authorization: Signature Algorithm=HS256,Credential=' . $merchantKey . ',SignedHeaders=,Signature=' . $signature
        );

        $response = $this->callAPI('GET', $return_url, false, $headers);

        return response()->json(['request' => $response, 'name' => $orderService->name,
            'tax_code' => $orderService->tax_code,
            'phone_number' => $orderService->phone_number, 'status' => $orderService->status, 'payment_status' => $orderService->payment_status]);


    }

    public function resultCheckPayment(Request $request)
    {
        function urlSafeB64encode($string)
        {
            $data = base64_encode($string);
            $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
            return $data;
        }

        $status = 0;
        $payment = [];

        if (isset($_GET['result'])) {
            $result = urlSafeB64encode($request->result);
            $payment = json_decode($result);
            $status = $payment->status;

            return response()->json(['result' => $status]);
        }


    }

    public function updatePayment(Request $request)
    {
        $order_service = OrderService::find($request->id);
        if (!$order_service) {
            return redirect()->back()->with('error', 'Không tìm thấy giao dịch');
        }
        if ($order_service->payment_status == 1 && $order_service->status == 3) {
            return redirect()->back()->with('error', 'Không thể chuyển trạng thái giao dịch này');
        }
        $order_service->status = 3;
        $order_service->payment_status = 1;
        $order_service->save();

        return redirect()->back()->with('success', 'Thay đổi trạng thái giao dịch thành công');
    }


    // gửi thông tin tài khoản sang kế toán để làm lịch sử giao dịch
    public function sendAccountant($user)
    {
//        accountCode=${dto.accountCode}&code=${dto.code}&companyName=${dto.companyName}&vStoreName=${dto.vStoreName}&taxCode=${dto.taxCode}
        $order_service = OrderService::where('user_id', $user->id)->first();
        if ($user->role_id == 2) {
            $value = 12000000;
            $code = $order_service->no;
        } elseif ($user->role_id == 4) {
            $value = 1200000;
            $code = $order_service->no;
        } elseif ($user->role_id == 3) {
            $value = 300000000;
            $code = Str::lower(Str::random(10));
        }

        if ($user->role_id != 3) {
            $hmac = 'code=' . $code . '&companyName=' . $user->company_name . '&vStoreName=' . $user->name . '&taxCode=' . $user->tax_code;
//                    sellerPDoneId=VNO398917577&buyerId=2&ukey=25M7I5f9913085b842&value=500000&orderId=10&userId=63
            $sig = hash_hmac('sha256', $hmac, config('domain.key_split'));
            $data = [
                "code" => $code,
                "accountCode" => $user->account_code,
                "type" => $user->role_id,
                "value" => $value,
                "vStoreName" => $user->name,
                "companyName" => $user->company_name,
                "taxCode" => $user->tax_code,
                "email" => $user->email,
                "phone" => $user->phone_number,
                "signature" => $sig
            ];
            $respon = Http::post(config('domain.domain_vdone') . 'accountant/buy-account/v-store', $data);
        } else {
            $hmac = 'code=' . $user->trading_code . '&status=' . 1 . '&accountCode=' . $user->account_code;
//                    code=${dto.code}&status=${dto.status}&accountCode=${dto.accountCode}
            $sig = hash_hmac('sha256', $hmac, config('domain.key_split'));
            $data = [
                "code" => $user->trading_code,
                "accountCode" => $user->account_code,
                "status" => 1,
                "signature" => $sig
            ];
            $respon = Http::patch(config('domain.domain_vdone') . 'accountant/buy-account/v-store', $data);
        }

    }
}
