<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Chart\ChartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $dataRevenueToday = $this->chartRepository->revenueToday();
        $dataRequestProductToday = $this->chartRepository->requestProductToday();
        $dataRequestTaxCodeToday = $this->chartRepository->requestTaxCodeToday();
        $dataRegisterMonth = $this->chartRepository->registerMonth();
        $dataRegisterYear = $this->chartRepository->registerYear();
        $requestProductMonth = $this->chartRepository->requestProductMonth();
        $requestProductYear = $this->chartRepository->requestProductYear();

        $dataOrderToday = $this->chartRepository->orderToday();
        $dataOrderSuccessToday = $this->chartRepository->orderSuccessToday();
        $dataRegisterToday = $this->chartRepository->registerToday();

        return view('screens.admin.dashboard.index', [
            'dataRevenueChartMonth' => $dataRevenueChartMonth,
            'dataRevenueChartYear' => $dataRevenueChartYear,
            'dataOrderChartMonth' => $dataOrderChartMonth,
            'dataOrderRangeTimeYear' => $dataOrderRangeTimeYear,

            'dataRevenueToday' => $dataRevenueToday,
            'dataRequestTaxCodeToday' => $dataRequestTaxCodeToday,
            'dataRequestProductToday' => $dataRequestProductToday,
            'dataRegisterMonth' => $dataRegisterMonth,
            'dataRegisterYear' => $dataRegisterYear,
            'requestProductMonth' => $requestProductMonth,
            'requestProductYear' => $requestProductYear,

            'dataOrderToday' => $dataOrderToday,
            'dataOrderSuccessToday' => $dataOrderSuccessToday,
            'dataRegisterToday' => $dataRegisterToday,
        ]);
    }
}
