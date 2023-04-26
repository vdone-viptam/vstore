<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Interfaces\Chart\ChartRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private ChartRepositoryInterface $chartRepository;
    public function __construct(ChartRepositoryInterface $chartRepository)
    {
        $this->chartRepository = $chartRepository;
    }
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $data =  Product::query()->select('products.id',
            'publish_id', 'products.name', 'category_id', 'price', 'products.status', 'vstore_id', 'categories.name as cate_name','discount',
            'amount_product_sold','admin_confirm_date')
            ->selectSub('select name from users where id = products.vstore_id', 'vstore_name')
            ->selectSub('select IFNULL(SUM(amount - export),0) from product_warehouses where product_id= products.id', 'amount')
            ->join("categories", 'products.category_id', '=', 'categories.id')
            ->groupBy('products.id')
            ->where('user_id', Auth::id())
            ->where('products.status', 2)
            ->orderBy('products.id','desc')
            ->paginate($limit);

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

        $dataRevenueChartMonth = $this->chartRepository->revenueRangeTimeMonth();
        $dataRevenueChartYear = $this->chartRepository->revenueRangeTimeYear();
        $dataOrderChartMonth = $this->chartRepository->orderRangeTimeMonth();
        $dataOrderRangeTimeYear = $this->chartRepository->orderRangeTimeYear();

        $dataRevenueToday = $this->chartRepository->revenue30Day();
        $dataOrderToday = $this->chartRepository->productRunningOut();
        $dataOrderSuccessToday = $this->chartRepository->unapprovedOrder();

        return view('screens.manufacture.dashboard.index', [
            'data' => $data,
            'limit' => $limit,
            'warehouses' => $warehouses,

            'dataRevenueChartMonth' => $dataRevenueChartMonth,
            'dataRevenueChartYear' => $dataRevenueChartYear,
            'dataOrderChartMonth' => $dataOrderChartMonth,
            'dataOrderRangeTimeYear' => $dataOrderRangeTimeYear,

            'dataRevenueToday' => $dataRevenueToday,
            'dataOrderToday' => $dataOrderToday,
            'dataOrderSuccessToday' => $dataOrderSuccessToday,
        ]);
    }
}
