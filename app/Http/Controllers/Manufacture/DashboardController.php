<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\DashboardRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private DashboardRepositoryInterface $dashboardRepository;
    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }
    public function index(Request $request)
    {
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = $request->key_search ?? 10;
        $limit = $request->limit ?? 10;

        $data =  Product::query()->select('products.id',
            'publish_id', 'products.name', 'category_id', 'price', 'products.status', 'vstore_id', 'categories.name as cate_name','discount',
            'amount_product_sold','admin_confirm_date')
            ->selectSub('select name from users where id = products.vstore_id', 'vstore_name')
            ->selectSub('select IFNULL(SUM(amount - export),0) from product_warehouses where product_id= products.id', 'amount')
            ->join("categories", 'products.category_id', '=', 'categories.id');

        $this->v['key_search'] = trim($request->key_search) ?? '';
        if (strlen($this->v['key_search'])) {
            $data = $data->where(function ($query) {
                $query->where('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('publish_id', '=', $this->v['key_search'])
                    ->orWhere('brand', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $data = $data->groupBy('products.id')
            ->where('user_id', Auth::id())
            ->where('products.status', 2)
            ->orderBy($this->v['field'], $this->v['type'])
            ->paginate($this->v['limit']);
        // copy from app\Http\Controllers\Manufacture\WarehouseController\index()
        $warehouse_aff = json_decode(Auth::user()->warehouse_aff) ?? [];
        $warehouses = DB::table('warehouses')->selectRaw('warehouses.name as ware_name,warehouses.id,
                                warehouses.phone_number,
                                warehouses.address')
            ->selectSub('select IFNULL(SUM(amount),0) - IFNULL(SUM(export),0)
                from product_warehouses where ware_id = warehouses.id and product_warehouses.status = 1 group by ware_id', 'amount_product')
            ->selectSub('select IFNULL(COUNT(product_warehouses.product_id),0)
                            from product_warehouses where ware_id = warehouses.id and product_warehouses.status = 1  limit 1', 'amount')
            ->join('users', 'warehouses.user_id', '=', 'users.id')
            // ->orderBy($this->v['field'], $this->v['type'])
            ->whereIn('warehouses.user_id', $warehouse_aff)
            ->paginate(10);


        $revenueInMonthNow = $this->dashboardRepository->revenueInMonthNow();
        $productRunningOut = $this->dashboardRepository->productRunningOut();
        $unapprovedOrder = $this->dashboardRepository->unapprovedOrder();

        return view('screens.manufacture.dashboard.index', [
            'data' => $data,
            'limit' => $limit,
            'field' => $this->v['field'],
            'type' => $this->v['type'],
            'key_search' => $this->v['key_search'],
            'warehouses' => $warehouses,

            'revenueInMonthNow' => $revenueInMonthNow,
            'productRunningOut' => $productRunningOut,
            'unapprovedOrder' => $unapprovedOrder,
        ]);
    }
}
