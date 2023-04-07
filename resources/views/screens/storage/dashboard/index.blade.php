@extends('layouts.storage.main')


@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Trang chủ</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Trang
                                    chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tổng quan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('dash')
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <a href="./requestAcp.html" class="item-dash">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Đơn hàng chưa xác nhận</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{$requestEx ?? 0}}</h1>
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
                        <h1 class="mb-1">{{$requestIm ?? 0}}</h1>
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
                        <h1 class="mb-1">{{$productOutStock}}</h1>
                    </div>

                </div>
            </div>
        </a>
    </div>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            <h5 class="card-header" style="font-size: 18px;">Những sản phẩm và đơn hàng gần đây
            </h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="partner-datatables" class="table table-striped table-bordered second" style="width:100%">
                        <thead class="bg-light">
                        <tr class="border-0">
                            <th class="border-0">Mã đơn hàng/Mã yêu cầu</th>
                            <th class="border-0">Mã sản phẩm</th>
                            <th class="border-0">Tên sản phẩm</th>
                            <th class="border-0">Nhà cung cấp</th>
                            <th class="border-0">Số lượng</th>
                            <th class="border-0">Chiết khấu</th>
                            <th class="border-0">Thời gian</th>
                            <th class="border-0">Phân loại</th>
                            <th class="border-0">Xác nhận/từ chối</th>
                            <th class="border-0"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td> {{$product->code}}</td>
                                <td>{{$product->publish_id}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->ncc_name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>0</td>
                                <td>{{\Illuminate\Support\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}</td>
                                <td>
                                    @if($product->type == 1)
                                        <span class="text-success">Yêu cầu nhập</span>
                                    @else
                                        <span style="color:#005d1d;">Xác nhận đơn hàng</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->type == 1)
                                        <a href="" class="btn btn-primary">Đồng ý</a>
                                        <a href="" class="btn btn-danger">Từ chối</a>
                                    @else
                                        <a href="" class="btn btn-primary">Đồng ý</a>
                                        <a href="" class="btn btn-danger">Từ chối</a>
                                    @endif
                                </td>
                                <td><a href="#" class="btn btn-link">Chi tiết</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
                <div id="example_paginate">
                    <ul class="pagination d-flex justify-content-end align-items-center"
                        style="gap:8px ;margin-top:10px;margin-right: 10px;">

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')

    <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('asset/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('asset/assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('asset/assets/vendor/multi-select/js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('asset/assets/libs/js/main-js.js')}}"></script>

@endsection
