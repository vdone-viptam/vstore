<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Interfaces\Chart\ChartRepositoryInterface;
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
    public function index()
    {
        $data = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.vstore_id', '=', 'users.id')
            ->selectRaw('requests.code,
            requests.id,requests.created_at,requests.status,
            categories.name,products.name as product_name,
            users.name as user_name')
            ->where('requests.user_id', Auth::id())
            ->orderBy('requests.id', 'desc')
            ->limit(10)->get();


        $dataRevenueChartMonth = $this->chartRepository->revenueRangeTimeMonth();
        $dataRevenueChartYear = $this->chartRepository->revenueRangeTimeYear();
        $dataOrderChartMonth = $this->chartRepository->orderRangeTimeMonth();
        $dataOrderRangeTimeYear = $this->chartRepository->orderRangeTimeYear();

        $dataRevenueToday = $this->chartRepository->revenue30Day();
        $dataOrderToday = $this->chartRepository->productRunningOut();
        $dataOrderSuccessToday = $this->chartRepository->unapprovedOrder();

        return view('screens.manufacture.dashboard.index', [
            'data' => $data,

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
