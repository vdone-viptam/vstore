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
                                    <th class="white-space-130 text-center">Mã Yêu cầu</th>
                                    <th class="white-space-120 text-center">Trạng thái</th>
                                    <th class="text-center white-space-150">Số tiền
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
                                    <th class="white-space-150 text-center">Số tài khoản
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'account_number')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="account_number"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="account_number"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="account_number"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th class="white-space-200 text-center">Tên chủ tài khoản
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'name')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="name"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="name"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="name"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th class="white-space-120 text-center">Ngân hàng
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'bank_name')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="bank_name"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="bank_name"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="bank_name"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th class=" text-center white-space-300">Nội dung</th>
                                    <th class="white-space-150 text-center">Thời gian yêu cầu
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
                                            <td class="text-center white-space-140">{{$history->code}}</td>

                                            @if($history->status == 0)
                                                <td class="text-warning font-medium text-center">
                                                    Đang chờ duyệt
                                                </td>
                                            @elseif($history->status == 1)
                                                <td class="text-success font-medium text-center">
                                                    Đã duyệt
                                                </td>
                                            @else
                                                <td class="text-danger font-medium text-center">
                                                    Thất bại
                                                </td>
                                            @endif
                                            <td class="text-right white-space-130">
                                                {{number_format($history->amount,0,'.','.')}} đ
                                            </td>
                                            <td>
                                                {{ $history->account_number }}
                                            </td>
                                            <td class="white-space-200 text-center">
                                                {{ $history->name }}
                                            </td>
                                            <td>
                                                {{ $history->bank_name }}
                                            </td>
                                            <td class="white-space-300">
                                                Chuyển khoản ra ngoài
                                            </td>


                                            <td class="text-center white-space-130">
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
                                {{$histories->withQueryString()->links('layouts.custom.paginator')}}
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
