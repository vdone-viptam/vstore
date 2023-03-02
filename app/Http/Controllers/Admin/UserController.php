<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        $limit = $request->limit ?? 10;
        if (isset($request->name)) {
            $this->v['users'] = $this->v['users']->where('company_name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->id)) {
            $this->v['users'] = $this->v['users']->where('id', $request->id);
        }
        $this->v['users'] = $this->v['users']->orderBy('id', 'desc')->where('role_id', '!=', 1)->paginate($limit);
        $this->v['params'] = $request->all();
        return view('screens.admin.user.index', $this->v);
    }

    public function getListUser(Request $request)
    {
        $this->v['users'] = User::select();
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        $limit = $request->limit ?? 10;
        if (isset($request->name)) {
            $this->v['users'] = $this->v['users']->where('company_name', 'like', '%' . $request->name . '%');
        }
        if (isset($request->id)) {
            $this->v['users'] = $this->v['users']->where('id', $request->id);
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
                $number = User::where('account_code', 'like' . '%' . $user->tax_code . '%')->count();
                if ($number == 0) {
                    $ID = 'vnk' . '01' . '-' . $user->tax_code;
                } elseif ($number < 10) {
                    $ID = 'vnk' . '0' . $number . '-' . $user->tax_code;
                } elseif ($number > 10) {
                    $ID = 'vnk' . $number . '-' . $user->tax_code;
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
            $user->save();
            if ($user->role_id == 4) {
                $warehouses = new Warehouses();
                $warehouses->name = $user->name;
                $warehouses->phone_number = $user->phone_number;
                $warehouses->address = $user->address;
                $warehouses->city_id = $user->city_id;
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
}
