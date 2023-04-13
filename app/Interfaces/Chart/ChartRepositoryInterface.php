<?php

namespace App\Interfaces\Chart;

interface ChartRepositoryInterface
{
    // cho biểu đồ
    public function revenueRangeTimeMonth();
    public function revenueRangeTimeYear();
    public function orderRangeTimeMonth();
    public function orderRangeTimeYear();

    // cho biểu doanh số today
    public function revenueToday();
    public function orderToday();
    public function orderSuccessToday();

}
