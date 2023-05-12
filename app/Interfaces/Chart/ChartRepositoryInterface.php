<?php

namespace App\Interfaces\Chart;

interface ChartRepositoryInterface
{
    // cho biểu đồ
    public function revenueRangeTimeMonth();
    public function revenueRangeTimeYear();
    public function orderRangeTimeMonth();
    public function orderRangeTimeYear();

    //amdin
    public function requestProductToday();
    public function requestTaxCodeToday();
    public function registerAccountPending();

    public function registerMonth();
    public function registerYear();
    public function requestProductMonth();
    public function requestProductYear();

    // vstore
    // cho biểu doanh số today
    public function revenueToday();
    public function orderToday();
    public function orderSuccessToday();

    // cho ncc
    public function revenueInMonthNow();
    public function productRunningOut();
    public function unapprovedOrder();
}
