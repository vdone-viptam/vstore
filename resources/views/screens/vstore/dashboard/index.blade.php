@extends('layouts.vstore.main')
@section('page_title', 'Tổng quan')

@section('content')
    <div class="container-fluid dashboard-content pt-0">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Tổng quan </h2>

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
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="row row-dash">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <a href="#" class="item-dash">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Doanh thu trong ngày</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{ number_format($dataRevenueToday, 0, '.', '.') }}</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <a href="{{route('screens.vstore.order.index')}}" class="item-dash">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Đơn hàng trong ngày</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{ number_format($dataOrderToday, 0, '.', '.') }}</h1>
                            </div>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <a href="{{route('screens.vstore.product.requestAll')}}" class="item-dash">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Yêu cầu xét duyệt sản phẩm trong ngày</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{number_format($countRequestProductReview,0,'.','.')}}</h1>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                        <h5 class="mb-0" style="font-size:18px;">
                            <a href="{{route('screens.vstore.product.request')}}" class="">Yêu cầu xét duyệt sản phẩm chưa xác nhận
                            </a>
                        </h5>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <div id="custom-search" class="top-search-bar">
                                    <form>
                                        <input name="key_search" value="{{ $key_search ?? '' }}" class="form-control"
                                            type="search" placeholder="Nhập từ khóa tìm kiếm...">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                <th class="white-space-120 text-center">

                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Mã yêu cầu

                                        </div>
                                    </th>

                                <th class="white-space-120">

                                    <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                        Nhà cung cấp
                                        <span style="float: right;cursor:pointer">
                                            @if($field == 'users.name')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="users.name"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="users.name"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="users.name"></i>
                                            @endif
                                        </span>
                                    </div>
                                </th>
                                <th class="white-space-300" style="min-width:200px !important;">

                                    <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                        Tên sản phẩm
                                        <span style="float: right;cursor:pointer">
                                            @if($field == 'products.name')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="products.name"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="products.name"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="products.name"></i>
                                            @endif
                                        </span>
                                    </div>
                                </th>
                                <th>

                                    <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                        Ngành hàng
                                        <span style="float: right;cursor:pointer">
                                            @if($field == 'categories.name')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="categories.name"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="categories.name"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="categories.name"></i>
                                            @endif
                                        </span>
                                    </div>
                                </th>
                                    <th class="white-space-150">
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Giá sản phẩm chưa VAT
                                            <span style="float: right;cursor:pointer">
                                                @if ($field == 'price')
                                                    @if ($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort" data-sort="price"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort" data-sort="price"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="price"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th class="white-space-150">
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Chiết khấu từ Nhà cung cấp
                                            <span style="float: right;cursor:pointer">
                                                @if ($field == 'requests.discount')
                                                    @if ($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort"
                                                            data-sort="requests.discount"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort"
                                                            data-sort="requests.discount"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="requests.discount"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Ngày yêu cầu
                                            <span style="float: right;cursor:pointer">
                                                @if ($field == 'requests.created_at')
                                                    @if ($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort"
                                                            data-sort="requests.created_at"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort"
                                                            data-sort="requests.created_at"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="requests.created_at"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th style="min-width:100px;">
                                        Trạng thái
                                        <span style="float: right;cursor:pointer">
                                            @if ($field == 'requests.status')
                                                @if ($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort"
                                                        data-sort="requests.status"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort"
                                                        data-sort="requests.status"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="requests.status"></i>
                                            @endif
                                        </span>
                                    </div>
                                </th>



                                <th>Thao tác</th>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $product)
                                            <tr>
                                                <td class="white-space-120">
                                                    {{$product->code}}
                                                </td>
                                                <td class="white-space-150">
                                                    {{$product->user_name}}
                                                </td>
                                                <td class="white-space-300" style="min-width:200px !important;">
                                                    {{$product->name}}
                                                </td>
                                                <td class="white-space-150">{{$product->cate_name}}</td>
                                                <td class="white-space-150 text-right">
                                                    {{number_format($product->price,0,'.','.')}} đ
                                                </td>
                                                <td class="text-center">
                                                    {{$product->discount}}%
                                                </td>

                                                <td class="text-center">{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}</td>
                                                <td class="text-center"><span class="font-medium" >Sản phẩm mới</span></td>

                                                <td style="min-width:150px;">
                                                    <a href="#" onclick="appect({{$product->id}},{{$product->discount}},1)"
                                                    class="btn text-primary font-medium px-2" style="text-decoration:underline;">Đồng ý</a>
                                                    <a href="#"
                                                    onclick="unAppect({{$product->id}},{{$product->discount}},2)"
                                                    class="btn text-danger font-medium px-2" style="text-decoration:underline;">Từ chối</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">Không có dữ liệu phù hợp</td>
                                        </tr>

                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-4">
                            {{ $data->withQueryString()->links('layouts.custom.paginator') }}
                            <div class="ml-4">
                                <div class="form-group">
                                    <select class="form-control" id="limit">
                                        <option value="10" {{ $limit == 10 ? 'selected' : '' }}>10 hàng / trang
                                        </option>
                                        <option value="25" {{ $limit == 25 ? 'selected' : '' }}>25 hàng / trang
                                        </option>
                                        <option value="50" {{ $limit == 50 ? 'selected' : '' }}>50 hàng / trang
                                        </option>
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

@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="" method="POST" id="form">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi
                            tiết</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @csrf
                    <div class="modal-body md-content">

                    </div>
                    <div class="modal-footer">
                        <button id="btnConfirm" class="btn btn-success">Cập nhật yêu cầu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@endsection

@section('custom_js')

@if (\Illuminate\Support\Facades\Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
            text: 'Click vào nút bên dưới để đóng',
        })
    </script>
@endif
@if (\Illuminate\Support\Facades\Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ \Illuminate\Support\Facades\Session::get('error') }}',
            text: 'Click vào nút bên dưới để đóng',
        })
    </script>
@endif
<script>
    let limit = document.getElementById('limit');
    let product = {};
    limit.addEventListener('change', (e) => {
        setTimeout(() => {
            document.location =
                '{{ route('screens.vstore.dashboard.index', ['key_search' => $key_search]) }}&type=' +
                '{{ $type }}' +
                '&field=' + '{{ $field }}' + '&limit=' + e.target.value
        }, 200)
    })

    $(document).ready(function() {
        document.querySelectorAll('.sort').forEach(item => {
            const {
                sort
            } = item.dataset;
            item.addEventListener('click', () => {
                let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                if (orderBy === 'asc') {
                    localStorage.setItem('orderBy', JSON.stringify('desc'));
                } else {
                    localStorage.setItem('orderBy', JSON.stringify('asc'));
                }
                setTimeout(() => {
                    document.location =
                        '{{ route('screens.vstore.dashboard.index', ['key_search' => $key_search]) }}&type=' +
                        orderBy +
                        '&field=' + sort + '&limit=' + limit.value
                }, 200)
            });
        });
    });

    document.getElementById('btnConfirm').style.display = 'none';

    function appect(id, discount, status) {
        $('.md-content').html(`
            <div class="form-group">
                <label>Chiết khấu được từ nhà cung cấp</label>
            <input class="form-control number" data-discount="${discount}" name="discount" id="discount" disabled value="${discount} %">
                </div>
                <div class="form-group">
                <label>Chiết khấu cho V-Shop</label>
            <input class="form-control number-percent" name="discount_vShop" id="discount_vShop">
            <p id="messageDis" style="display: none" class="text-danger mt-2 ms-1">Chiết khấu cho V-Shop không được nhỏ hơn ${discount / 2} và lớn hơn ${discount}</p>
            </div>
        `);
        document.querySelector('#form').setAttribute('action', '{{ route('screens.vstore.product.confirm') }}/' + id +
            '?status=' + status)

        document.getElementsByName('discount_vShop')[0].addEventListener('keyup', (e) => {
            if (+e.target.value < Number(document.getElementById('discount').dataset.discount) && +e.target
                .value >= Number(document.getElementById('discount').dataset.discount) / 2) {
                document.getElementById('messageDis').style.display = 'none';
                document.getElementById('btnConfirm').style.display = 'block';

            } else {
                document.getElementById('messageDis').style.display = 'block';
                document.getElementById('btnConfirm').style.display = 'none';
            }

        })
        document.getElementsByName('discount_vShop')[0].addEventListener("keypress", (e) => {
            var regex = new RegExp("^[0-9.]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
        $('#modalDetail').modal('show');

    }

    function unAppect(id, discount, status) {
        $('.md-content').html(`
            <div class="form-group">
                <label for="name">Lý do từ chối</label>
            <textarea name="note" placeholder="Lý do từ chối"
                        class="form-control" ></textarea>
            </div>
        `);
        document.querySelector('#form').setAttribute('action', '{{ route('screens.vstore.product.confirm') }}/' + id +
            '?status=' + status)
        $('#modalDetail').modal('show');
        document.getElementById('btnConfirm').style.display = 'block';
    }
</script>
@endsection
