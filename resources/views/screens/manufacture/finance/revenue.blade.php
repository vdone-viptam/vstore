@extends('layouts.manufacture.main')
@section('page_title','Lịch sử biến động số dư')
@section('content')
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Lịch sử biến động số dư</h2>

                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài
                                                chính</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Lịch sử biến động số dư</li>
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
                                <h5 class="mb-0" style="font-size:18px;">Lịch sử biến động số dư</h5>
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
                                            <th class="white-space-130 text-center">Mã giao dịch</th>
                                            <th class="white-space-120 text-center">
                                                Trạng thái
                                                <span style="float: right;cursor: pointer">
                                                @if($field == 'status')
                                                    @if($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort"
                                                            data-sort="status"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort" data-sort="status"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="status"></i>
                                                @endif
                                        </span>
                                            </th>
                                            <th class="text-center white-space-150">
                                                Số tiền
                                                <span style="float: right;cursor: pointer">
                                            @if($field == 'money_history')
                                                        @if($type == 'desc')
                                                            <i class="fa-solid fa-sort-down sort"
                                                               data-sort="money_history"></i>
                                                        @else
                                                            <i class="fa-solid fa-sort-up sort"
                                                               data-sort="money_history"></i>
                                                        @endif
                                                    @else
                                                        <i class="fas fa-sort sort" data-sort="money_history"></i>
                                                    @endif
                                        </span>
                                            </th>
                                            <th >
                                                Nội dung
                                            </th>
                                            <th class="text-center white-space-130">
                                                Thời gian
                                                <span style="float: right;cursor: pointer">
                                            @if($field == 'created_at')
                                                        @if($type == 'desc')
                                                            <i class="fa-solid fa-sort-down sort"
                                                               data-sort="created_at"></i>
                                                        @else
                                                            <i class="fa-solid fa-sort-up sort"
                                                               data-sort="created_at"></i>
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
                                                    <td class="text-center white-space-130">1{{$histories->code ?? '-'}}</td>
                                                    <td class="text-center white-space-130">
                                                        @if($history->status == 0)
                                                            <p class="text-danger font-medium">Thất bại</p>
                                                        @else
                                                            <p class="text-warning font-medium">Đang chờ duyệt</p>
                                                        @endif
                                                    </td>
                                                    <td class="text-right white-space-130">
                                                        @if($history->type == 1)
                                                            <p class="text-success">
                                                                +{{number_format($history->money_history,0,'.','.')}} đ
                                                                </p>
                                                        @else
                                                            <p class="text-danger">
                                                                -{{number_format($history->money_history,0,'.','.')}} đ</p>
                                                        @endif
                                                    </td>
                                                    <th class="white-space-400">{{$history->title}}</th>
                                                    <td class="text-center white-space-130">
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
                        <div class="d-flex align-items-center justify-content-end mt-4">
                            {{$histories->withQueryString()->links('layouts.custom.paginator')}}
                            <div class=" ml-4">
                                <div class="form-group">
                                    <select class="form-control" id="limit">
                                        <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 hàng / trang</option>
                                        <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 hàng / trang</option>
                                        <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 hàng / trang</option>
                                    </select>
                                </div>
                            </div>
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
                        let limit = document.getElementById('limit');
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
                                    document.location = '{{route('screens.manufacture.finance.revenue')}}?type=' + orderBy +
                                        '&field=' + sort + '&limit=' + limit.value
                                }, 200)
                            });
                        });
                        limit.addEventListener('change', (e) => {
                            setTimeout(() => {
                                document.location = '{{route('screens.manufacture.finance.revenue',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
                            }, 200)
                        })
                    });

                </script>
@endsection
