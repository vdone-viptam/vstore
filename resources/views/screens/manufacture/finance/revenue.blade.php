@extends('layouts.manufacture.main')
@section('page_title','Lịch sử biến động số dư')
@section('content')
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Lịch sử biến động số dư</h2>

        <div class="col-span-12 ">
            <div class="brc flex justify-start items-center gap-2 py-4">
                <span class="text-secondary">Tài chính</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18"
                          stroke="black"
                          stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <a href="" class="text-blueMain font-medium italic">Lịch sử biến động số dư</a>
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
                                    <th>Mã giao dịch</th>
                                    <th>
                                        Trạng thái
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'status')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="status"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="status" ></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="status"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>
                                        Số tiền
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'money_history')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="money_history"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="money_history"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="money_history"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>
                                        Nội dung
                                    </th>
                                    <th>
                                        Thời gian
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
                                            <td>{{$histories->code ?? 0012020233}}</td>
                                            <td>
                                                @if($history->status == 0)
                                                    <p class="text-red-600">Thất bại</p>
                                                @else
                                                    <p class="text-green-600">Đang chờ duyệt</p>
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
                        <div class="d-flex align-items-end justify-content-end mt-4">
                            {{$histories->withQueryString()->links()}}
                            <div class="mt-4">
                                <form>
                                    <div class="form-group">
                                        <select class="form-control" id="limit">
                                            <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 phần tử/trang</option>
                                            <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 phần tử/trang</option>
                                            <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 phần tử/trang</option>
                                        </select>
                                    </div>
                                </form>
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
