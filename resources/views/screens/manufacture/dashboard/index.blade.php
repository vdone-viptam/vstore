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
                        <h5 class="text-muted">Doanh thu trong tháng</h5>
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
                        <h5 class="text-muted">Số lượng sản phẩm sắp hết</h5>
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
                        <h5 class="text-muted">Đơn hàng nhập sẵn mới</h5>
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
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                    style="gap:10px">
                    <h5 class="mb-0" style="font-size:18px;">
                        <a href="{{route('screens.vstore.product.request')}}" class="">Quản lý yêu cầu xét duyệt
                        </a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second"
                            style="width:100%">
                            <thead>
                                <th>Mã yêu cầu</th>
                                <th>Tên sản phẩm</th>
                                <th>Ngành hàng</th>
                                <th>Ngày yêu cầu</th>
                                <th>V-Store niêm yết</th>
                                <th>Trạng thái yêu cầu</th>
                                <th>Chức năng</th>
                            </thead>
                            <tbody>
                                @if(count($data) > 0)
                            @foreach($data as $request)
                                <tr>
                                    <td>
                                        {{$request->code}}
                                    </td>
                                    <td>
                                        {{$request->product_name}}
                                    </td>
                                    <td>
                                        {{$request->name}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($request->created_at)->format('d/m/Y')}}
                                    </td>
                                    <td>
                                        {{$request->user_name}}
                                    </td>
                                    <td class="w-[200px]">
                                        @if($request->status == 0)
                                            <div
                                                class="alert alert-warning">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 12.6C8.48521 12.6 9.90959 12.01 10.9598 10.9598C12.01 9.90959 12.6 8.48521 12.6 7C12.6 5.51479 12.01 4.09041 10.9598 3.0402C9.90959 1.99 8.48521 1.4 7 1.4C5.51479 1.4 4.09041 1.99 3.0402 3.0402C1.99 4.09041 1.4 5.51479 1.4 7C1.4 8.48521 1.99 9.90959 3.0402 10.9598C4.09041 12.01 5.51479 12.6 7 12.6ZM7 0C7.91925 0 8.8295 0.18106 9.67878 0.532843C10.5281 0.884626 11.2997 1.40024 11.9497 2.05025C12.5998 2.70026 13.1154 3.47194 13.4672 4.32122C13.8189 5.17049 14 6.08075 14 7C14 8.85651 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85651 14 7 14C3.129 14 0 10.85 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0ZM7.35 3.5V7.175L10.5 9.044L9.975 9.905L6.3 7.7V3.5H7.35Z"
                                                        fill="white"/>
                                                </svg>
                                                Đang xét duyệt lên V-Store
                                            </div>
                                        @elseif($request->status == 1)
                                            <div
                                                class="alert alert-primary">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 12.6C8.48521 12.6 9.90959 12.01 10.9598 10.9598C12.01 9.90959 12.6 8.48521 12.6 7C12.6 5.51479 12.01 4.09041 10.9598 3.0402C9.90959 1.99 8.48521 1.4 7 1.4C5.51479 1.4 4.09041 1.99 3.0402 3.0402C1.99 4.09041 1.4 5.51479 1.4 7C1.4 8.48521 1.99 9.90959 3.0402 10.9598C4.09041 12.01 5.51479 12.6 7 12.6ZM7 0C7.91925 0 8.8295 0.18106 9.67878 0.532843C10.5281 0.884626 11.2997 1.40024 11.9497 2.05025C12.5998 2.70026 13.1154 3.47194 13.4672 4.32122C13.8189 5.17049 14 6.08075 14 7C14 8.85651 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85651 14 7 14C3.129 14 0 10.85 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0ZM7.35 3.5V7.175L10.5 9.044L9.975 9.905L6.3 7.7V3.5H7.35Z"
                                                        fill="white"/>
                                                </svg>
                                                V-Store đồng ý - chờ hệ thống duyệt
                                            </div>
                                        @elseif($request->status == 2)
                                            <div
                                                class="alert alert-danger">
                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.2 12L0 10.8L4.8 6L0 1.2L1.2 0L6 4.8L10.8 0L12 1.2L7.2 6L12 10.8L10.8 12L6 7.2L1.2 12Z"
                                                        fill="white"/>
                                                </svg>
                                                V-Store từ chối
                                            </div>
                                        @elseif($request->status == 3)
                                            <div
                                                class="alert alert-success">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="white"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Hệ thống đã duyệt
                                            </div>
                                        @else
                                            <div
                                                class="text-white font-medium flex justify-center items-center gap-4 bg-[#FF0101] rounded-[4px] px-[11px] py-[6px] whitespace-nowrap">
                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.2 12L0 10.8L4.8 6L0 1.2L1.2 0L6 4.8L10.8 0L12 1.2L7.2 6L12 10.8L10.8 12L6 7.2L1.2 12Z"
                                                        fill="white"/>
                                                </svg>
                                                Hệ thống từ chối
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-link" type="button"
                                                onclick="showDetail({{$request->id}})">Chi tiết
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <td colspan="9">Không có dữ liệu phù hợp</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end data table  -->
        <!-- ============================================================== -->
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


@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')

@include('layouts.custom.includeSt.chart-script');
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.product.detail')}}?id=` + id,
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Xem chi tiết sản phẩm thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = `${data.view}`;

                $('.md-content').html(htmlData)
                $('#modalDetail').modal('show');
            })


        }
    </script>
@endsection
