<?php

namespace App\Repositories\Chart;

use App\Interfaces\Chart\ChartRepositoryInterface;
use App\Models\BlanceChange;
use App\Models\Order;
use App\Models\PreOrderVshop;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\RequestChangeTaxCode;
use App\Models\RequestProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ChartRepository implements ChartRepositoryInterface
{
    public function revenueRangeTimeMonth()
    {
        $checkRole = User::where('id', Auth::id())->first()->role_id;
        $data = BlanceChange::where('type', 1)->where('status', 1);
        if ($checkRole != 1) {
            $data = $data->where('user_id', Auth::id());
        }
        $data = $data->select(
            DB::raw('sum(money_history) as sums'),
            DB::raw("(DATE_FORMAT(created_at, '%d/%m/%Y')) as my_date")
        )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderByDesc('created_at')
            ->groupBy('my_date')
            ->get()->toArray();
        $dataChart = [];

        // doanh thu trong 1 tuần và 1 tháng
        $moneyTotal30Days = 0;
        $moneyTotal7Days = 0;

        for ($i = 29; $i >= 0; $i--) {
            $dateIn30Days = Carbon::now()->subDays($i)->format('d/m/Y');
            $arrayDayMoney = [];
            $moneyIn30Days = 0;


            foreach ($data as $key => $value) {
                if ($dateIn30Days == $value['my_date']) {
                    $moneyIn30Days = $value['sums'];

                    // + doanh thu trong 1 tuần và 1 tháng
                    $moneyTotal30Days += $value['sums'];
                    if ($i < 7) {
                        $moneyTotal7Days += $value['sums'];
                    }
                    break;
                } else {
                    $moneyIn30Days = 0;
                }
                // khi dữ liệu lớn nếu muốn cải thiện tốc độ thì sẽ cắt bớt mảng khi đã có dữ liệu !
            }
            $arrayDayMoney['time'] = $dateIn30Days;
            $arrayDayMoney['money'] = $moneyIn30Days;

            // doanh thu trong 1 tuần và 1 tháng

            $dataChart[] = $arrayDayMoney;
        }
        $dashboardChart = [];
        $dashboardChart['week'] = array_slice($dataChart, -7, 7);
        $dashboardChart['month'] = $dataChart;
        $dashboardChart['moneyTotal30Days'] = $moneyTotal30Days;
        $dashboardChart['moneyTotal7Days'] = $moneyTotal7Days;

        return $dashboardChart;
    }

    public function revenueRangeTimeYear()
    {
        $checkRole = User::where('id', Auth::id())->first()->role_id;
        $data = BlanceChange::where('type', 1)->where('status', 1);
        if ($checkRole != 1) {
            $data = $data->where('user_id', Auth::id());
        }
        $data = $data->select(
            DB::raw('sum(money_history) as sums'),
            DB::raw("(DATE_FORMAT(created_at, '%m/%Y')) as my_month")
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(36))
            ->orderByDesc('created_at')
            ->groupBy('my_month')
            ->get()->toArray();

        $dataChart = [];
        // doanh thu trong 1 năm và 3 năm
        $moneyTotalOneYear = 0;
        $moneyTotalThreeYear = 0;

        for ($i = 36; $i >= 0; $i--) {
            $dateIn30Days = Carbon::now()->subMonths($i)->format('m/Y');
            $arrayDayMoney = [];
            $moneyIn30Days = 0;
            foreach ($data as $key => $value) {
                if ($dateIn30Days == $value['my_month']) {
                    $moneyIn30Days = $value['sums'];

                    // + doanh thu trong 1 năm và 3 năm
                    $moneyTotalThreeYear += $value['sums'];
                    if ($i < 12) {
                        $moneyTotalOneYear += $value['sums'];
                    }

                    break;
                } else {
                    $moneyIn30Days = 0;
                }
                // khi dữ liệu lớn nếu muốn cải thiện tốc độ thì sẽ cắt bớt mảng khi đã có dữ liệu !
            }
            $arrayDayMoney['time'] = $dateIn30Days;
            $arrayDayMoney['money'] = $moneyIn30Days;
            $dataChart[] = $arrayDayMoney;
        }
        $dashboardChart = [];
        $dashboardChart['one_year'] = array_slice($dataChart, -12, 12);
        $dashboardChart['three_year'] = $dataChart;
        $dashboardChart['moneyTotalOneYear'] = $moneyTotalOneYear;
        $dashboardChart['moneyTotalThreeYear'] = $moneyTotalThreeYear;

        return $dashboardChart;
    }

    public function orderRangeTimeMonth()
    {
        $checkRole = User::where('id', Auth::id())->first()->role_id;

        $data = Order::where('order.status', 1);
        $data = $data->select(
            DB::raw('count(*) as countOrder'),
            DB::raw("(DATE_FORMAT(order.created_at, '%d/%m/%Y')) as my_date")
        )
            ->where('order.created_at', '>=', Carbon::now()->subDays(30))
            ->join('order_item', 'order_item.order_id', 'order.id')
            ->join('products', 'products.id', 'order_item.product_id');
        if ($checkRole == 2) {
            $data = $data->where('products.user_id', Auth::id());
        } else if ($checkRole == 3) {
            $data = $data->where('products.vstore_id', Auth::id());
        }
        $data = $data->orderByDesc('order.created_at')
            ->groupBy('my_date')
            ->get()->toArray();
        $dataChart = [];

        // đơn hàng trong 1 tuần và 1 tháng
        $orderTotal30Days = 0;
        $orderTotal7Days = 0;

        for ($i = 29; $i >= 0; $i--) {
            $dateIn30Days = Carbon::now()->subDays($i)->format('d/m/Y');
            $arrayDayOrder = [];
            $orderIn30Days = 0;


            foreach ($data as $key => $value) {
                if ($dateIn30Days == $value['my_date']) {
                    $orderIn30Days = $value['countOrder'];

                    // + đơn hàng trong 1 tuần và 1 tháng
                    $orderTotal30Days += $value['countOrder'];
                    if ($i < 7) {
                        $orderTotal7Days += $value['countOrder'];
                    }
                    break;
                } else {
                    $orderIn30Days = 0;
                }
                // khi dữ liệu lớn nếu muốn cải thiện tốc độ thì sẽ cắt bớt mảng khi đã có dữ liệu !
            }
            $arrayDayOrder['time'] = $dateIn30Days;
            $arrayDayOrder['money'] = $orderIn30Days;

            $dataChart[] = $arrayDayOrder;
        }
        $dashboardChart = [];
        $dashboardChart['week'] = array_slice($dataChart, -7, 7);
        $dashboardChart['month'] = $dataChart;
        $dashboardChart['orderTotal30Days'] = $orderTotal30Days;
        $dashboardChart['orderTotal7Days'] = $orderTotal7Days;

        return $dashboardChart;
    }

    public function orderRangeTimeYear()
    {
        $checkRole = User::where('id', Auth::id())->first()->role_id;
        $data = Order::where('order.status', 1);
        $data = $data->select(
            DB::raw('count(*) as countOrder'),
            DB::raw("(DATE_FORMAT(order.created_at, '%m/%Y')) as my_date")
        )
            ->where('order.created_at', '>=', Carbon::now()->subMonths(36))
            ->join('order_item', 'order_item.order_id', 'order.id')
            ->join('products', 'products.id', 'order_item.product_id');
        if ($checkRole == 2) {
            $data = $data->where('products.user_id', Auth::id());
        } else if ($checkRole == 3) {
            $data = $data->where('products.vstore_id', Auth::id());
        }
        $data = $data->orderByDesc('order.created_at')
            ->groupBy('my_date')
            ->get()->toArray();
        // dd($data);
        $dataChart = [];

        // đơn hàng trong 1 năm và 3 năm
        $orderTotalThreeYear = 0;
        $orderTotalOneYear = 0;

        for ($i = 36; $i >= 0; $i--) {
            $dateIn30Days = Carbon::now()->subMonths($i)->format('m/Y');
            $arrayDayOrder = [];
            $orderIn30Days = 0;


            foreach ($data as $key => $value) {
                if ($dateIn30Days == $value['my_date']) {
                    $orderIn30Days = $value['countOrder'];

                    // + đơn hàng trong 1 năm và 3 năm
                    $orderTotalThreeYear += $value['countOrder'];
                    if ($i < 12) {
                        $orderTotalOneYear += $value['countOrder'];
                    }
                    break;
                } else {
                    $orderIn30Days = 0;
                }
                // khi dữ liệu lớn nếu muốn cải thiện tốc độ thì sẽ cắt bớt mảng khi đã có dữ liệu !
            }
            $arrayDayOrder['time'] = $dateIn30Days;
            $arrayDayOrder['money'] = $orderIn30Days;

            $dataChart[] = $arrayDayOrder;
        }
        $dashboardChart = [];
        $dashboardChart['one_year'] = array_slice($dataChart, -12, 12);
        $dashboardChart['three_year'] = $dataChart;
        $dashboardChart['orderTotalOneYear'] = $orderTotalOneYear;
        $dashboardChart['orderTotalThreeYear'] = $orderTotalThreeYear;

        return $dashboardChart;
    }

    public function revenueToday()
    {
        $checkRole = User::where('id', Auth::id())->first()->role_id;

        $data = Order::whereNotIn('order.export_status', [3,5])
            ->whereDate('order.created_at', date('Y-m-d'))
            ->join('order_item', 'order_item.order_id', 'order.id')
            ->join('products', 'products.id', 'order_item.product_id');
        if ($checkRole == 2) {
            $data = $data->where('products.user_id', Auth::id());
        } else if ($checkRole == 3) {
            $data = $data->where('products.vstore_id', Auth::id());
        }
        $data = $data->select(DB::raw('COALESCE(SUM(order_item.price * order_item.quantity),0) as total'))->value('total');

        return $data;
    }

    public function orderToday()
    {
        $checkRole = User::where('id', Auth::id())->first()->role_id;
        // dd($checkRole);
        $data = Order::whereNotIn('order.export_status', [3,5])
            ->whereDate('order.created_at', date('Y-m-d'))
            ->join('order_item', 'order_item.order_id', 'order.id')
            ->join('products', 'products.id', 'order_item.product_id');
        if ($checkRole == 2) {
            $data = $data->where('products.user_id', Auth::id());
        } else if ($checkRole == 3) {
            $data = $data->where('products.vstore_id', Auth::id());
        }
        $data = $data->count();
        return $data;
    }

    public function orderSuccessToday()
    {
        $checkRole = User::where('id', Auth::id())->first()->role_id;
        $data = Order::where('order.status', 1)->where('order.export_status', 4)
            ->whereDate('order.updated_at', date('Y-m-d'))
            ->join('order_item', 'order_item.order_id', 'order.id')
            ->join('products', 'products.id', 'order_item.product_id');
        if ($checkRole == 2) {
            $data = $data->where('products.user_id', Auth::id());
        } else if ($checkRole == 3) {
            $data = $data->where('products.vstore_id', Auth::id());
        }
        $data = $data->count();
        return $data;
    }

    public function requestProductToday()
    {
        $request = DB::table('requests')
            ->where('status', 1)
            ->count();
        return $request;
    }

    public function requestTaxCodeToday()
    {
        $data = RequestChangeTaxCode::where('status', 0)->count();
        return $data;
    }

    public function registerAccountPending()
    {
        $data = User::whereNull('confirm_date')->count();
        return $data;
    }

    public function registerMonth()
    {
        $data = User::select(
            DB::raw('count(*) as count'),
            DB::raw("(DATE_FORMAT(created_at, '%d/%m/%Y')) as my_date")
        )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderByDesc('created_at')
            ->groupBy('my_date')
            ->get()->toArray();
        $dataChart = [];

        // đơn hàng trong 1 tuần và 1 tháng
        $orderTotal30Days = 0;
        $orderTotal7Days = 0;

        for ($i = 29; $i >= 0; $i--) {
            $dateIn30Days = Carbon::now()->subDays($i)->format('d/m/Y');
            $arrayDayOrder = [];
            $orderIn30Days = 0;


            foreach ($data as $key => $value) {
                if ($dateIn30Days == $value['my_date']) {
                    $orderIn30Days = $value['count'];

                    // + đơn hàng trong 1 tuần và 1 tháng
                    $orderTotal30Days += $value['count'];
                    if ($i < 7) {
                        $orderTotal7Days += $value['count'];
                    }
                    break;
                } else {
                    $orderIn30Days = 0;
                }
                // khi dữ liệu lớn nếu muốn cải thiện tốc độ thì sẽ cắt bớt mảng khi đã có dữ liệu !
            }
            $arrayDayOrder['time'] = $dateIn30Days;
            $arrayDayOrder['money'] = $orderIn30Days;

            $dataChart[] = $arrayDayOrder;
        }
        $dashboardChart = [];
        $dashboardChart['week'] = array_slice($dataChart, -7, 7);
        $dashboardChart['month'] = $dataChart;
        $dashboardChart['registerTotal30Days'] = $orderTotal30Days;
        $dashboardChart['registerTotal7Days'] = $orderTotal7Days;

        return $dashboardChart;
    }

    public function registerYear()
    {
        $data = User::select(
            DB::raw('count(*) as count'),
            DB::raw("(DATE_FORMAT(created_at, '%m/%Y')) as my_date")
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(36))
            ->orderByDesc('created_at')
            ->groupBy('my_date')
            ->get()->toArray();
        $dataChart = [];

        // đơn hàng trong 1 năm và 3 năm
        $orderTotalThreeYear = 0;
        $orderTotalOneYear = 0;

        for ($i = 36; $i >= 0; $i--) {
            $dateIn30Days = Carbon::now()->subMonths($i)->format('m/Y');
            $arrayDayOrder = [];
            $orderIn30Days = 0;


            foreach ($data as $key => $value) {
                if ($dateIn30Days == $value['my_date']) {
                    $orderIn30Days = $value['count'];

                    // + đơn hàng trong 1 năm và 3 năm
                    $orderTotalThreeYear += $value['count'];
                    if ($i < 12) {
                        $orderTotalOneYear += $value['count'];
                    }
                    break;
                } else {
                    $orderIn30Days = 0;
                }
                // khi dữ liệu lớn nếu muốn cải thiện tốc độ thì sẽ cắt bớt mảng khi đã có dữ liệu !
            }
            $arrayDayOrder['time'] = $dateIn30Days;
            $arrayDayOrder['money'] = $orderIn30Days;

            $dataChart[] = $arrayDayOrder;
        }
        $dashboardChart = [];
        $dashboardChart['one_year'] = array_slice($dataChart, -12, 12);
        $dashboardChart['three_year'] = $dataChart;
        $dashboardChart['registerTotalOneYear'] = $orderTotalOneYear;
        $dashboardChart['registerTotalThreeYear'] = $orderTotalThreeYear;

        return $dashboardChart;
    }

    public function requestProductMonth()
    {
        $data = RequestProduct::select(
            DB::raw('count(*) as count'),
            DB::raw("(DATE_FORMAT(created_at, '%d/%m/%Y')) as my_date")
        )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->where('status', 3)
            ->orderByDesc('created_at')
            ->groupBy('my_date')
            ->get()->toArray();
        $dataChart = [];

        // đơn hàng trong 1 tuần và 1 tháng
        $orderTotal30Days = 0;
        $orderTotal7Days = 0;

        for ($i = 29; $i >= 0; $i--) {
            $dateIn30Days = Carbon::now()->subDays($i)->format('d/m/Y');
            $arrayDayOrder = [];
            $orderIn30Days = 0;


            foreach ($data as $key => $value) {
                if ($dateIn30Days == $value['my_date']) {
                    $orderIn30Days = $value['count'];

                    // + đơn hàng trong 1 tuần và 1 tháng
                    $orderTotal30Days += $value['count'];
                    if ($i < 7) {
                        $orderTotal7Days += $value['count'];
                    }
                    break;
                } else {
                    $orderIn30Days = 0;
                }
                // khi dữ liệu lớn nếu muốn cải thiện tốc độ thì sẽ cắt bớt mảng khi đã có dữ liệu !
            }
            $arrayDayOrder['time'] = $dateIn30Days;
            $arrayDayOrder['money'] = $orderIn30Days;

            $dataChart[] = $arrayDayOrder;
        }
        $dashboardChart = [];
        $dashboardChart['week'] = array_slice($dataChart, -7, 7);
        $dashboardChart['month'] = $dataChart;
        $dashboardChart['registerTotal30Days'] = $orderTotal30Days;
        $dashboardChart['registerTotal7Days'] = $orderTotal7Days;

        return $dashboardChart;
    }

    public function requestProductYear()
    {
        $data = RequestProduct::select(
            DB::raw('count(*) as count'),
            DB::raw("(DATE_FORMAT(created_at, '%m/%Y')) as my_date")
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(36))
            ->orderByDesc('created_at')
            ->groupBy('my_date')
            ->get()->toArray();
        $dataChart = [];

        // đơn hàng trong 1 năm và 3 năm
        $orderTotalThreeYear = 0;
        $orderTotalOneYear = 0;

        for ($i = 36; $i >= 0; $i--) {
            $dateIn30Days = Carbon::now()->subMonths($i)->format('m/Y');
            $arrayDayOrder = [];
            $orderIn30Days = 0;


            foreach ($data as $key => $value) {
                if ($dateIn30Days == $value['my_date']) {
                    $orderIn30Days = $value['count'];

                    // + đơn hàng trong 1 năm và 3 năm
                    $orderTotalThreeYear += $value['count'];
                    if ($i < 12) {
                        $orderTotalOneYear += $value['count'];
                    }
                    break;
                } else {
                    $orderIn30Days = 0;
                }
                // khi dữ liệu lớn nếu muốn cải thiện tốc độ thì sẽ cắt bớt mảng khi đã có dữ liệu !
            }
            $arrayDayOrder['time'] = $dateIn30Days;
            $arrayDayOrder['money'] = $orderIn30Days;

            $dataChart[] = $arrayDayOrder;
        }
        $dashboardChart = [];
        $dashboardChart['one_year'] = array_slice($dataChart, -12, 12);
        $dashboardChart['three_year'] = $dataChart;
        $dashboardChart['registerTotalOneYear'] = $orderTotalOneYear;
        $dashboardChart['registerTotalThreeYear'] = $orderTotalThreeYear;

        return $dashboardChart;
    }
    public function revenueInMonthNow(){


        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $checkRole = User::where('id', Auth::id())->first()->role_id;

        $data = Order::whereNotIn('order.export_status', [3,5])
            ->whereMonth('order.created_at', '=', $currentMonth)
            ->whereYear('order.created_at', '=', $currentYear)
            ->join('order_item', 'order_item.order_id', 'order.id')
            ->join('products', 'products.id', 'order_item.product_id');
        if ($checkRole == 2) {
            $data = $data->where('products.user_id', Auth::id());
        } else if ($checkRole == 3) {
            $data = $data->where('products.vstore_id', Auth::id());
        }
        $data = $data->select(DB::raw('COALESCE(SUM(order_item.price * order_item.quantity),0) as total'))->value('total');

        return $data;

    }
    public function productRunningOut(){
        $data = ProductWarehouses::query()
            ->select('products.id')
            ->join("products", 'products.id', '=', 'product_warehouses.product_id')
            ->where('user_id', Auth::id())
            ->whereRaw('amount-export < 10')
            ->count();
        return $data;
    }
    public function unapprovedOrder(){
        $data = PreOrderVshop::query()
            ->join('products', 'pre_order_vshop.product_id', '=',
                'products.id')
            ->where('products.user_id', Auth::id())
            ->where('pre_order_vshop.status', 3)
            ->count();
        return $data;
    }
}


