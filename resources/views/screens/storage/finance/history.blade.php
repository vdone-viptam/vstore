@extends('layouts.storage.main')
@section('page_title','Yêu cầu rút tiền')

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
                    <h2 class="pageheader-title">Yêu cầu rút tiền</h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài
                                        chính</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Yêu cầu rút tiền</li>
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
                        <h5 class="mb-0" style="font-size:18px;">Yêu cầu rút tiền</h5>
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
                                    <th>Trạng thái</th>
                                    <th>Số tiền
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'amount')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="amount"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="amount"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="amount"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>Nội dung</th>
                                    <th>Ngày tạo yêu cầu
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'created_at')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="created_at"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="created_at"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="created_at"></i>
                                            @endif
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($histories) > 0)
                                    @foreach($histories as $history)
                                        <tr>
                                            <td>{{$history->code}}</td>

                                            @if($history->status == 0)
                                                <td class="text-yellow-400">
                                                    Đang chờ duyệt
                                                </td>
                                            @elseif($history->status == 1)
                                                <td class="text-green-700">
                                                    Đang chờ duyệt
                                                </td>
                                            @else
                                                <td class="text-red-600">
                                                    Thất bại
                                                </td>
                                            @endif
                                            <td>
                                                {{number_format($history->amount,0,'.','.')}}
                                            </td>
                                            <td>
                                                Chuyển khoản ra ngoài
                                            </td>


                                            <td>
                                                {{\Illuminate\Support\Carbon::parse($history->created_at)->format('d/m/Y')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
                                    </tr>
                                @endif


                                </tbody>
                            </table>
                        </div>
                        <div id="example_paginate">
                            <ul class="pagination d-flex justify-content-end align-items-center"
                                style="gap:8px ;margin-top:10px;margin-right: 10px;">
                                {{$histories->withQueryString()->links()}}
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
            if ($('#check-success').val() == 1) {
                swalNoti('center', 'success', 'Gửi yêu cầu thay đổi mã số thuế thành công','', 500, true, 2200);
            }
            document.querySelectorAll('.sort').forEach(item => {
                const {sort} = item.dataset;
                item.addEventListener('click', () => {
                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                    if (orderBy === 'asc') {
                        localStorage.setItem('orderBy', JSON.stringify('desc'));
                    } else {
                        localStorage.setItem('orderBy', JSON.stringify('asc'));
                    }
                    setTimeout(() => {
                        document.location = '{{route('screens.storage.finance.history')}}?type=' + orderBy +
                            '&field=' + sort
                    }, 200)
                });
            });
        });

    </script>
@endsection
