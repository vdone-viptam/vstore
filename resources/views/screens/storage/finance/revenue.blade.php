@extends('layouts.storage.main')
@section('page_title','Lịch sử biến động só dư')

@section('custom_css')

@endsection
@section('modal')

@endsection
@section('content')
<div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Lịch sử biến động só dư</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài
                                    chính</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lịch sử biến động só dư</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                    style="gap:10px">
                    <h5 class="mb-0" style="font-size:18px;">Lịch sử biến động só dư</h5>
                    {{-- <ul class="navbar-nav ">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="search" placeholder="Tìm kiếm..">
                            </div>
                        </li>
                    </ul> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Mã giao dịch</th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th>
                                        Số tiền
                                    </th>
                                    <th>
                                        Nội dung
                                    </th>
                                    <th>
                                        Thời gian
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($histories) > 0)
                                        @foreach($histories as $history)
                                            <tr>
                                                <td>{{$histories->code ?? 0012020233}}</td>
                                                <td>
                                                    @if($history->status == 0)
                                                        <p class="text-red-600">Thất bại</p>
                                                    @else
                                                        <p class="text-green-600">Thành công</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($history->type == 1)
                                                        <p class="text-green-600">
                                                            +{{number_format($history->money_history,0,'.','.')}}
                                                            đ</p>
                                                    @else
                                                        <p class="text-red-600">
                                                            -{{number_format($history->money_history,0,'.','.')}}</p>
                                                    @endif
                                                </td>
                                                <th>{{$history->title}}</th>
                                                <td>
                                                    {{\Carbon\Carbon::parse($history->created_at)->format('d/m/Y H:i')}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
                                        </tr>
                                    @endif

                                </tbody>
                        </table>
                    </div>
                    <div id="example_paginate">
                        <ul class="pagination d-flex justify-content-end align-items-center"
                            style="gap:8px ;margin-top:10px;margin-right: 10px;">
                            {{$histories->render()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end striped table -->
        <!-- ============================================================== -->
    </div>
</div>

@endsection
@section('custom_js')

<script>
    $(document).ready(function () {
        if($('#check-success').val() == 1){
            swalNoti('center', 'success', 'Gửi yêu cầu thay đổi mã số thuế thành công', 500, true, 2200);
        }
    });
</script>
@endsection
