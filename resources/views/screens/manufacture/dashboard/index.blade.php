@extends('layouts.manufacture.main')
@section('page_title','Tổng quan')

@section('custom_css')
    <style>
        .header {
            display: none !important;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Trang chủ </h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Trang
                                    chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nhà cung cấp</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="row row-dash">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <a href="#" class="item-dash">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Doanh thu</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{number_format($dataRevenueToday,0,'.','.')}}</h1>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <a href="#" class="item-dash">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Đơn hàng</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{number_format($dataOrderToday,0,'.','.')}}</h1>
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <a href="#" class="item-dash">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Đơn hàng giao thành công</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{number_format($dataOrderSuccessToday,0,'.','.')}}</h1>
                        </div>

                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                            <select class="custom-select select-revenue">
                                <option value="0" selected>1 Tuần</option>
                                <option value="1">1 tháng</option>
                                <option value="2">1 năm</option>
                                <option value="3">3 năm</option>
                            </select>
                        </div>
                        <h5  style="font-size: 18px;">Doanh thu trong <span
                            class="date-revenue">1 tuần</span></h5>
                </div>
                <div class="card-body">
                    <canvas id="bar-chart-grouped" width="800" height="315"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                            <select class="custom-select select-order">
                                <option value="0" selected>1 Tuần</option>
                                <option value="1">1 tháng</option>
                                <option value="2">1 năm</option>
                                <option value="3">3 năm</option>
                            </select>
                        </div>
                        <h5  style="font-size: 18px;">Đơn hàng trong <span class="date-order">1 tuần</span></h5>
                </div>
                <div class="card-body">
                    <canvas id="bar-chart" width="800" height="315"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
@section('custom_js')

@include('layouts.custom.includeSt.chart-script');

@endsection
