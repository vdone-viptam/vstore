<?php

namespace App\Interfaces\Chart;

interface ChartRepositoryInterface
{
    public function revenueRangeTimeMonth();
    public function revenueRangeTimeYear();
    public function orderRangeTimeMonth();
    public function orderRangeTimeYear();
}
