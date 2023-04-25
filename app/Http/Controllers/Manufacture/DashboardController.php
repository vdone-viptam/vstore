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
