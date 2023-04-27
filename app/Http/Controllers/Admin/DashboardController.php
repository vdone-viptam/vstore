<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Chart\ChartRepositoryInterface;
use App\Models\RequestChangeTaxCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private ChartRepositoryInterface $chartRepository;
    private $v;

    public function __construct(ChartRepositoryInterface $chartRepository)
    {
        $this->chartRepository = $chartRepository;
        $this->v = [];
    }

    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        // Yêu cầu đăng ký tài khoản chờ xét duyệt
        $this->v['users'] = User::select('users.name', 'users.id', 'email', 'id_vdone', 'company_name',
            'phone_number', 'tax_code', 'address', 'users.created_at', 'confirm_date', 'users.referral_code', 'users.role_id');
        $limit = $request->limit ?? 10;
        if (isset($request->key_search)) {
            $this->v['users'] = $this->v['users']
                ->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->key_search . '%')
                        ->orwhere('company_name', 'like', '%' . $request->key_search . '%')
                        ->orwhere('email', 'like', '%' . $request->key_search . '%')
                        ->orwhere('id_vdone', 'like', '%' . $request->key_search . '%')
                        ->orwhere('phone_number', 'like', '%' . $request->key_search . '%')
                        ->orwhere('tax_code', '=', $request->key_search)
                        ->orwhere('account_code', 'like', '%' . $request->key_search . '%')
                        ->orwhere('address', 'like', '%' . $request->key_search . '%');
                });
        }
        $this->v['users'] = $this->v['users']->join('order_service', 'users.id', '=', 'order_service.user_id')
        ->where('order_service.status', 3)
        ->where('payment_status', 1)
        ->whereNull('confirm_date')
        ->orderBy('users.id', 'desc')
        ->where('role_id', '!=', 1)->paginate($limit);
        $this->v['countRegisterAccountPending'] = $this->v['users']->count();

        // Sản phẩm xét duyệt lên V-Store chưa xác nhận

        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }

        $this->v['requests'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')

            ->selectRaw('products.name as product_name,publish_id,categories.name as name,requests.id,requests.status,users.name as user_name,requests.created_at');

        if (isset($request->key_search)) {
            $this->v['requests'] = $this->v['requests']->where(function ($query) use ($request) {
                $query->orWhere('products.name', 'like', '%' . $request->key_search . '%')
                    ->orWhere('publish_id', $request->keyword)
                    ->orWhere('categories.name', 'like', '%' . $request->key_search . '%')
                    ->orWhere('users.name', 'like', '%' . $request->key_search . '%');
            });
        }
        $this->v['requests'] = $this->v['requests']->where('requests.status', 1)->orderBy('requests.id', 'desc')
            ->paginate($limit);
        $countRequestProductToday = $this->v['requests']->total();
        foreach ($this->v['requests'] as $key => $val) {
            if (!in_array((int)$val->status, [1, 3, 4])) {
                unset($this->v['requests'][$key]);
                $countRequestProductToday -= 1;
            }
        }
        if ($request->keyword) {
            $this->v['total'] = $countRequestProductToday;
        }

        $this->v['limit'] = $limit;
        $this->v['params'] = $request->all();


        $countRequestTaxCodeToday = $this->chartRepository->requestTaxCodeToday();


        $this->v['countRequestTaxCodeToday'] = $countRequestTaxCodeToday;
        $this->v['countRequestProductToday'] = $countRequestProductToday;


        return view('screens.admin.dashboard.index', $this->v );
    }
}
