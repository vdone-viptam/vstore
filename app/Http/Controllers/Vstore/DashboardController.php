<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Interfaces\Chart\ChartRepositoryInterface;
use App\Models\Product;
use App\Models\Vshop;
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
        // $data = Product::select('products.images', 'name', 'product_id', 'products.discount')
        //     ->join('requests', 'products.id', '=', 'requests.product_id')
        //     ->where('requests.status', 0)
        //     ->groupBy(['products.images', 'name', 'product_id', 'products.discount'])
        //     ->where('products.vstore_id',Auth::id())
        //     ->limit(10)->get();

        $data = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->selectRaw('requests.code,requests.id,requests.created_at,categories.name as cate_name,products.name,users.name as user_name,products.price,requests.discount')
            ->limit(10)
            ->where('requests.vstore_id', Auth::id())
            ->where('requests.status', 0)
            ->get();
                $vshop  = [];

        $dataRevenueChartMonth = $this->chartRepository->revenueRangeTimeMonth();
        $dataRevenueChartYear = $this->chartRepository->revenueRangeTimeYear();
        $dataOrderChartMonth = $this->chartRepository->orderRangeTimeMonth();
        $dataOrderRangeTimeYear = $this->chartRepository->orderRangeTimeYear();

        $dataRevenueToday = $this->chartRepository->revenueToday();
        $dataOrderToday = $this->chartRepository->orderToday();
        $dataOrderSuccessToday = $this->chartRepository->orderSuccessToday();

        return view('screens.vstore.dashboard.index',
        [
            'data' => $data,
            'vshop' => $vshop,
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
