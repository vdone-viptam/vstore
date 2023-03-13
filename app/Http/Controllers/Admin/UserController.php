<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DepositExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\RequestChangeTaxCode;
use App\Models\User;
use App\Models\Warehouses;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $this->v['users'] = User::select();
        $limit = $request->limit ?? 10;
        if (isset($request->keyword)) {
            $this->v['users'] = $this->v['users']->orwhere('company_name', 'like', '%' . $request->keyword . '%')
                ->orwhere('name', 'like', '%' . $request->keyword . '%')
                ->orwhere('email', 'like', '%' . $request->keyword . '%')
                ->orwhere('id_vdone', 'like', '%' . $request->keyword . '%')
                ->orwhere('phone_number', 'like', '%' . $request->keyword . '%')
                ->orwhere('tax_code', '=', $request->keyword)
                ->orwhere('account_code', '=', $request->keyword)
                ->orwhere('address', 'like', '%' . $request->keyword . '%');
        }
        $this->v['users'] = $this->v['users']->orderBy('id', 'desc')->where('role_id', '!=', 1)->paginate($limit);
        $this->v['params'] = $request->all();
        return view('screens.admin.user.index', $this->v);
    }

    public function getListUser(Request $request)
    {
        $this->v['users'] = User::select();
        $limit = $request->limit ?? 10;
        if (isset($request->keyword)) {
            $this->v['users'] = $this->v['users']->orwhere('company_name', 'like', '%' . $request->keyword . '%')
                ->orwhere('name', 'like', '%' . $request->keyword . '%')
                ->orwhere('email', 'like', '%' . $request->keyword . '%')
                ->orwhere('id_vdone', 'like', '%' . $request->keyword . '%')
                ->orwhere('phone_number', 'like', '%' . $request->keyword . '%')
                ->orwhere('tax_code', '=', $request->keyword)
                ->orwhere('account_code', '=', $request->keyword)
                ->orwhere('address', 'like', '%' . $request->keyword . '%');
        }
        $this->v['users'] = $this->v['users']->orderBy('id', 'desc')->where('confirm_date', '!=', null)->paginate($limit);
        $this->v['params'] = $request->all();
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
                $number = User::where('tax_code', $user->tax_code)->where('role_id', 4)->count();
                if ($number == 0) {
                    $ID = 'vnk' . '01' . $user->tax_code;
                } elseif ($number < 10) {
                    $ID = 'vnk' . '0' . $number . $user->tax_code;
                } elseif ($number >= 10) {
                    $ID = 'vnk' . $number . $user->tax_code;
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
            $user->save();

            if ($user->role_id == 4) {
                $warehouses = new Warehouses();
                $warehouses->name = $user->name;
                $warehouses->phone_number = $user->phone_number;
                $warehouses->address = $user->address;
                $warehouses->city_id = $user->provinceId;
                $warehouses->district_id = $user->district_id;
                $warehouses->user_id = $user->id;
                $warehouses->save();
            }

            Mail::send('email.confirm', ['ID' => $ID, 'password' => $password], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Đơn đăng ký của bạn đã được duyệt');
            });
            DB::commit();

            return redirect()->back()->with('success', 'Kích hoạt tài khoản thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }

    public function detail(Request $request)
    {
        $user = User::select('name', 'email', 'id_vdone', 'phone_number', 'tax_code', 'address', 'created_at', 'storage_information')->where('id', $request->id)->first();
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
        return redirect()->route('screens.admin.user.list_user');
    }

    public function requestChangeTaxCode()
    {
//        return 1;
        $this->v['requests'] = RequestChangeTaxCode::select('id', 'user_id', 'tax_code', 'status')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('screens.admin.user.request', $this->v);
    }

    public function confirmRequest(Request $request, $id, $status)
    {
        DB::beginTransaction();
        try {
            $request = RequestChangeTaxCode::where('id', $id)->first();
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
                'href' => $href . '?'
            ];

            $user->notify(new AppNotification($data));
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật yêu cầu cập nhật mã số thuế thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }

    public function exportUser()
    {
        return Excel::download(new UserExport, Carbon::now()->format('d-m-Y') . ' -danh_sach_tai_khoan' . '.xlsx');
    }
}
