@extends('layouts.admin.main')
@section('custom_css')
    <style>

    </style>
@endsection
@section('page_title','Tổng quan')

@section('modal')
    <div id="modal1">

    </div>
@endsection
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
                        <h5 class="text-muted">Tài khoản đăng ký chờ xét duyệt</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{number_format($countRegisterAccountPending,0,'.','.')}}</h1>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <a href="#" class="item-dash">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Sản phẩm chờ xét duyệt</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{number_format($countRequestProductToday,0,'.','.')}}</h1>
                        </div>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
            <a href="#" class="item-dash">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Yêu cầu cập nhật Mã Số thuế</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{number_format($countRequestTaxCodeToday,0,'.','.')}}</h1>
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
                    <h5 class="mb-0" style="font-size:18px;">Yêu cầu đăng ký tài khoản chờ xét duyệt
                    </h5>
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <form >
                                <input class="form-control" type="search" placeholder="Tìm kiếm.." name="key_search_users" value="{{$key_search_users}}">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Tên
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'users.name')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="users.name"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="users.name"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="users.name"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Email
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'email')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="email"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="email"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="email"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th class="white-space-120">
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Số điện thoại
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'phone_number')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="phone_number"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="phone_number"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="phone_number"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Tên công ty
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'company_name')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="company_name"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="company_name"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="company_name"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th class="white-space-120">
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Mã số thuế
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'tax_code')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="tax_code"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="tax_code"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="tax_code"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Id P-Done người đại diện
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'id_vdone')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="id_vdone"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="id_vdone"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="id_vdone"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Phân loại tài khoản
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'users.role_id')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="users.role_id"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="users.role_id"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="users.role_id"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th class="white-space-120">
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Ngày đăng ký
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'users.created_at')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="users.created_at"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="users.created_at"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="users.created_at"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Mã người giới thiệu
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'users.referral_code')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-users" data-sort="users.referral_code"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-users" data-sort="users.referral_code"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-users" data-sort="users.referral_code"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            @if(count($users) > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{ Str::limit($user->email, 15) }}</td>
                                    <td class="text-center">{{$user->phone_number}}</td>
                                    <td>{{$user->company_name}}</td>
                                    <td class="text-center">{{$user->tax_code}}</td>
                                    <td class="text-center">{{$user->id_vdone}}</td>
                                    <td>
                                        @if($user->role_id == 2)
                                            <span class="text-primary font-medium">Nhà cung cấp</span>
                                        @elseif($user->role_id == 1)
                                            Admin
                                        @elseif($user->role_id == 4)
                                            <span class="text-danger font-medium">Kho</span>
                                        @else
                                            <span class="text-success font-medium">V-Store</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{\Illuminate\Support\Carbon::parse($user->created_at)->format('d/m/Y')}}</td>
                                    <td class="text-center">
                                        {{strlen($user->referral_code) > 0 ? $user->referral_code : ''}}
                                    </td>
                                    <td class="text-center">
                                        @if($user->confirm_date)

                                        @else
                                        <button data-abc="{{$loop->iteration - 1}}" data-href="{{route('screens.admin.user.confirm',['id' => $user->id])}}" class="duyet btn btn-primary">Duyệt</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="12" class="text-center">Không có dữ liệu phù hợp</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex align-items-end justify-content-end mt-4">
                        {{$users->withQueryString()->links('layouts.custom.paginator')}}
                        <div class="mt-4 ml-4">
                            <div class="form-group">
                                <select class="form-control" id="limit_users">
                                    <option value="10" {{$limit_users == 10 ? 'selected' : ''}}>10 hàng / trang</option>
                                    <option value="25" {{$limit_users == 25 ? 'selected' : ''}}>25 hàng / trang</option>
                                    <option value="50" {{$limit_users == 50 ? 'selected' : ''}}>50 hàng / trang</option>
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
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                    style="gap:10px">
                    <h5 class="mb-0" style="font-size:18px;">Sản phẩm xét duyệt lên V-Store chưa xác
                        nhận</h5>
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <form >
                                    <input class="form-control" type="search" placeholder="Tìm kiếm.." name="key_search_request" value="{{$key_search_request}}">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>

                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Mã yêu cầu
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'requests.code')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-request" data-sort="requests.code"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-request" data-sort="requests.code"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-request" data-sort="requests.code"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Tên sản phẩm
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'products.name')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-request" data-sort="products.name"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-request" data-sort="products.name"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-request" data-sort="products.name"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Ngành hàng
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'categories.name')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-request" data-sort="categories.name"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-request" data-sort="categories.name"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-request" data-sort="categories.name"></i>
                                                @endif
                                            </span>
                                        </div>

                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Nhà cung cấp
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'users.name')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-request" data-sort="users.name"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-request" data-sort="users.name"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-request" data-sort="users.name"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Chiết khấu cho V-Store
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'products.discount')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-request" data-sort="products.discount"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-request" data-sort="products.discount"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-request" data-sort="products.discount"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            V-Store xét duyệt
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'vstore_name')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-request" data-sort="vstore_name"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-request" data-sort="vstore_name"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-request" data-sort="vstore_name"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                            Chiết khấu cho V-Shop
                                            <span style="float: right;cursor:pointer">
                                                @if($field_request == 'requests.discount_vshop')
                                                    @if($type_request == 'desc')
                                                        <i class="fa-solid fa-sort-down sort-request" data-sort="requests.discount_vshop"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort-request" data-sort="requests.discount_vshop"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort-request" data-sort="requests.discount_vshop"></i>
                                                @endif
                                            </span>
                                        </div>
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($requests) > 0)
                            @foreach($requests as $request)
                                <tr>
                                    <td>
                                        {{$request->code}}
                                    </td>
                                    <td>
                                        {{$request->product_name}}
                                    </td>
                                    <td class="">
                                        {{$request->name}}
                                    </td>
                                    <td class="">
                                        {{$request->user_name}}
                                    </td>
                                    <td class="text-center">
                                        {{$request->discount}}
                                    </td>
                                    <td class="">
                                        {{$request->vstore_name}}
                                    </td>
                                    <td class="text-center">
                                        {{$request->discount_vshop}}
                                    </td>
                                    <td class="text-center">
                                        <button data-toggle="modal" data-target="#exampleModal" data-id="{{ $request->id }}" class="update-request btn btn-primary">Duyệt</button>

                                    </td>
                                    </tr>
                            @endforeach

                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Không có dữ liệu phù hợp</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex align-items-end justify-content-end mt-4">
                        {{$requests->withQueryString()->links('layouts.custom.paginator')}}
                        <div class="mt-4 ml-4">
                            <div class="form-group">
                                <select class="form-control" id="limit_request">
                                    <option value="10" {{$limit_request == 10 ? 'selected' : ''}}>10 hàng / trang</option>
                                    <option value="25" {{$limit_request == 25 ? 'selected' : ''}}>25 hàng / trang</option>
                                    <option value="50" {{$limit_request == 50 ? 'selected' : ''}}>50 hàng / trang</option>
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
<script>
    $(document).ready(function () {
        @if(Session::has('success'))
        const textSuccess = '{{ Session::get('success')}}';
        swalNoti('center', 'success', 'Duyệt tài khoản thành công','', 500, true, 2200);
        @endif
    });
    $('.update-request').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Xác nhận duyệt?',
            text: "Bạn có chắc chắn muốn đồng ý ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Huỷ bỏ'
            }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr('data-id')

                var url = '{{ route("screens.admin.product.confirm", ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data : {id : id,status :3},
                    success: function (result) {
                        swalNoti('center', 'success', 'Duyệt sản phẩm thành công','', 500, true, 2200);
                        setInterval(function () {
                            location.reload();
                        }, 1500);
                    },
                });
            }
        })
    });


    document.querySelectorAll('.duyet').forEach((item, index3) => {
        const index = +item.dataset.abc
        item.addEventListener('click', (e) => {
            document.querySelectorAll('.duyet').forEach((item2, index2) => {
                if (item2.dataset.abc == index) {
                    if (item2.dataset.href) {
                        document.location = item2.dataset.href;
                    }
                } else {
                    item2.removeAttribute('data-href');
                }
            });
        })


    })

    let limit_request = document.getElementById('limit_request');
    let limit_users = document.getElementById('limit_users');

    $(document).ready(function () {
        document.querySelectorAll('.sort-request').forEach(item => {
            const {sort} = item.dataset;
            item.addEventListener('click', () => {
                let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                if (orderBy === 'asc') {
                    localStorage.setItem('orderBy', JSON.stringify('desc'));
                } else {
                    localStorage.setItem('orderBy', JSON.stringify('asc'));
                }
                setTimeout(() => {
                    document.location = '{{route('screens.admin.dashboard.index',['key_search_request' => $key_search_request])}}&type_request=' + orderBy +
                        '&field_request=' + sort
                })
            });
        });
        document.querySelectorAll('.sort-users').forEach(item => {
            const {sort} = item.dataset;
            item.addEventListener('click', () => {
                let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                if (orderBy === 'asc') {
                    localStorage.setItem('orderBy', JSON.stringify('desc'));
                } else {
                    localStorage.setItem('orderBy', JSON.stringify('asc'));
                }
                setTimeout(() => {
                    document.location = '{{route('screens.admin.dashboard.index',['key_search_users' => $key_search_users])}}&type_users=' + orderBy +
                        '&field_users=' + sort
                })
            });
        });
    });
    limit_request.addEventListener('change', (e) => {
        setTimeout(() => {
            document.location = '{{route('screens.admin.dashboard.index',['key_search_request' => $key_search_request])}}&type_request=' + '{{$type_request}}' +
                '&field_request=' + '{{$field_request}}' + '&limit_request=' + e.target.value
        }, 200)
    })
    limit_users.addEventListener('change', (e) => {
        setTimeout(() => {
            document.location = '{{route('screens.admin.dashboard.index',['key_search_users' => $key_search_users])}}&type_users=' + '{{$type_request}}' +
                '&field_users=' + '{{$field_users}}' + '&limit_users=' + e.target.value
        }, 200)
    })

</script>
<script !src="">
    $('.duyet').click(function (e) {
        e.preventDefault()
    })

</script>
@endsection
