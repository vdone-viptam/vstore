@extends('layouts.admin.main')
@section('page_title','Tất cả sản phẩm')

@section('content')

    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Quản lý sản phẩm</h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm
                                    </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                        <h5 class="mb-0" style="font-size:18px;">Tất cả sản phẩm
                        </h5>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <form>
                                    <div id="custom-search" class="top-search-bar">
                                        <input class="form-control" type="search" name="key_search" placeholder="Tìm kiếm..">
                                    </div>
                                </form>

                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Mã sản phẩm
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'deposits.code')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="deposits.code"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="deposits.code"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="deposits.code"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>Ngành hàng
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'users.account_code')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="users.account_code"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="users.account_code"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="users.account_code"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>Nhà cung cấp
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
                                    <th>Chiết khấu cho V-Store</th>
                                    <th>V-Store xét duyệt</th>
                                    <th>Chiết khấu cho V-Shop</th>
                                    <th>Số lượng trong kho</th>
                                    <th>Số lượng đã bán</th>
                                    <th>Ngày niêm yết</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $pro)
                                    <tr class="line-clamp3">
                                        <td>{{$pro->publish_id}}</td>
                                        <td>{{$pro->category_name}}</td>
                                        <td class="font-medium">{{$pro->amount}}</td>
                                        <td>{{$pro->account_number}}</td>
                                        <td style="text-transform: uppercase;">{{$pro->name}}</td>
                                        <td>{{$pro->bank->name}}</td>
                                        <td style="min-width: 400px; white-space: pre-wrap;">Yêu cầu rút tiền đến tài khoản {{$pro->account_number}}</td>
                                        <td>{{$pro->created_at}}</td>
                                        <td>
                                            @if($pro->status == 0)
                                                <span class="text-warning font-medium">Chờ xác nhận</span>
                                            @elseif($pro->status == 1)
                                                <span class="text-success font-medium">Thành công</span>
                                            @elseif($pro->status == 2)
                                                <span class="text-success font-medium">Từ chối</span>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach


                                {{--                                <tr class="line-clamp3">--}}
                                {{--                                    <td>G1231232</td>--}}
                                {{--                                    <td>VN123123123</td>--}}
                                {{--                                    <td class="font-medium">1.000.000đ</td>--}}
                                {{--                                    <td>19038334966011</td>--}}
                                {{--                                    <td style="text-transform: uppercase;">TRAN THANH KHOA</td>--}}
                                {{--                                    <td>Techcombank</td>--}}
                                {{--                                    <td style="min-width: 400px; white-space: pre-wrap;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse dolor ratione et perspiciatis, maxime veniam earum soluta illo quae impedit eveniet adipisci fuga fugit a. Beatae suscipit totam nobis corrupti!</td>--}}
                                {{--                                    <td>10/04/2023</td>--}}
                                {{--                                    <td><span class="text-success font-medium">Thành công</span></td>--}}
                                {{--                                </tr>--}}

                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 float-right mt-4">
                            {{$protories->withQueryString()->links('layouts.custom.paginator')}}
                            <div class="mt-4 ml-4">
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
            <!-- end data table  -->
            <!-- ============================================================== -->
        </div>
    </div>

@endsection

@section('custom_js')

    {{--    <script>--}}

    {{--        document.getElementsByName('start_date')[0].addEventListener('change', (e) => {--}}
    {{--            document.getElementsByName('end_date')[0].setAttribute('min', e.target.value);--}}
    {{--        });--}}
    {{--        const name = document.getElementById('name');--}}
    {{--        const id = document.getElementById('id');--}}
    {{--        const limit = document.getElementById('limit');--}}
    {{--        const form = document.getElementById('form');--}}
    {{--        $(document).keypress(function (event) {--}}
    {{--            var keycode = (event.keyCode ? event.keyCode : event.which);--}}
    {{--            if (keycode == '13') {--}}
    {{--                location.href = "{{route('screens.admin.finance.index')}}?start_date=" + $('#start_date').val() + '&end_date=' + $('#end_date').val();--}}
    {{--            }--}}
    {{--        });--}}
    {{--        limit.addEventListener('change', (e) => {--}}
    {{--            form.submit();--}}
    {{--        });--}}
    {{--    </script>--}}

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
                        document.location = '{{route('screens.admin.finance.index')}}?type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    }, 200)
                });
            });
            limit.addEventListener('change', (e) => {
                setTimeout(() => {
                    document.location = '{{route('screens.admin.finance.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                        '&field=' + '{{$field}}' + '&limit=' + e.target.value
                }, 200)
            })
        });

    </script>
@endsection