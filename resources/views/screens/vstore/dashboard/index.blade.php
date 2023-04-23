@extends('layouts.vstore.main')
@section('page_title','Tổng quan')


@section('page')
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

@endsection

@section('dash')
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <a href="./reAcp.html" class="item-dash">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Đơn hàng chưa xác nhận</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1"></h1>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <a href="./request.html" class="item-dash">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Yêu cầu nhập kho</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1"></h1>
                    </div>

                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <a href="./product.html" class="item-dash">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Số mặt hàng sắp hết</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1"></h1>
                    </div>

                </div>
            </div>
        </a>
    </div>

@endsection
@section('content')
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <select class="custom-select">
                        <option selected>Today</option>
                        <option value="1">Weekly</option>
                        <option value="2">Monthly</option>
                        <option value="3">Yearly</option>
                    </select>
                </div>
                <h5  style="font-size: 18px;">Doanh thu theo danh mục</h5>
            </div>
            <div class="card-body">
                <canvas id="chartjs_bar" style="height: 320px;"></canvas>

            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <select class="custom-select">
                        <option selected>Today</option>
                        <option value="1">Weekly</option>
                        <option value="2">Monthly</option>
                        <option value="3">Yearly</option>
                    </select>
                </div>
                <h5  style="font-size: 18px;">Doanh thu theo danh mục</h5>
            </div>

            <div class="card-body">
                <div id="c3chart_combine" class="c3" style="max-height: 320px; position: relative;"></div>
            </div>
        </div>
    </div>
@endsection
