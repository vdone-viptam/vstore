<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Interfaces\Chart\ChartRepositoryInterface;
use App\Models\Product;
use App\Models\Vshop;
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
        $data = Product::select('products.images', 'name', 'product_id', 'products.discount')->join('request_warehouses', 'products.id', '=', 'request_warehouses.product_id')->where('request_warehouses.status', 0)->groupBy(['products.images', 'name', 'product_id', 'products.discount'])
            ->where('products.vstore_id',Auth::id())
            ->limit(10)->get();
                $vshop  = [];

        $dataChartMonth = $this->chartRepository->revenueRangeTimeMonth();
        $dataChartYear = $this->chartRepository->revenueRangeTimeYear();

        return view('screens.vstore.dashboard.index',
        [
            'data' => $data,
            'vshop' => $vshop,
            'dataChartMonth' => $dataChartMonth,
            'dataChartYear' => $dataChartYear,
        ]);

    }
}
