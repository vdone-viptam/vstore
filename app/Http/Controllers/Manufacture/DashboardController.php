<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Interfaces\Chart\ChartRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private ChartRepositoryInterface $chartRepository;
    public function __construct(ChartRepositoryInterface $chartRepository)
    {
        $this->chartRepository = $chartRepository;
    }
    public function index()
    {
        $dataRevenueChartMonth = $this->chartRepository->revenueRangeTimeMonth();
        $dataRevenueChartYear = $this->chartRepository->revenueRangeTimeYear();
        $dataOrderChartMonth = $this->chartRepository->orderRangeTimeMonth();
        $dataOrderRangeTimeYear = $this->chartRepository->orderRangeTimeYear();

        $dataRevenueToday = $this->chartRepository->revenue30Day();
        $dataOrderToday = $this->chartRepository->productRunningOut();
        $dataOrderSuccessToday = $this->chartRepository->unapprovedOrder();

        return view('screens.manufacture.dashboard.index', [
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
