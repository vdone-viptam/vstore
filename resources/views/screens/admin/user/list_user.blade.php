@extends('layouts.admin.main')
@section('page_title','Danh sách tài khoản')

@section('content')
<div class="container-fluid dashboard-content pt-0">
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Danh sách tài khoản </h2>

            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý tài
                                khoản</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản
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
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Danh sách tài khoản
                </h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input class="form-control" type="search" placeholder="Nhập từ khóa tìm kiếm..." name="key_search" value="{{$key_search}}">
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
                                <th class="white-space-150">
                                    <div class="d-flex justify-content-center align-items-center" style="gap:6px">
                                        Mã tài khoản
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'account_code')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="account_code"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="account_code"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="account_code"></i>
                                        @endif
                                    </span>
                                    </div>
                                </th>
                                <th class="white-space-120">
                                    <div class="d-flex justify-content-center align-items-center" style="gap:6px">
                                        Vai trò
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'role_id')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="role_id"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="role_id"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="role_id"></i>
                                        @endif
                                    </span>
                                    </div>
                                </th>
                                <th>
                                    <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                        Tên
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
                                    </div>
                                </th>
                                <th>
                                    <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                        Email
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'email')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="email"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="email"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="email"></i>
                                        @endif
                                    </span>
                                    </div>
                                </th>
                                <th class="white-space-150">
                                    <div class="d-flex justify-content-center align-items-center" style="gap:6px">
                                        Số điện thoại
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'phone_number')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="phone_number"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="phone_number"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="phone_number"></i>
                                        @endif
                                    </span>
                                    </div>
                                </th>
                                <th>
                                    <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                        Tên công ty
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'company_name')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="company_name"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="company_name"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="company_name"></i>
                                        @endif
                                    </span>
                                    </div>
                                </th>
                                <th class="white-space-120">
                                    <div class="d-flex justify-content-center align-items-center" style="gap:6px">
                                        Mã số thuế
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'tax_code')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="tax_code"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="tax_code"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="tax_code"></i>
                                        @endif
                                    </span>
                                    </div>
                                </th>
                                <th class="white-space-200">
                                    <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                        Id P-Done người đại diện
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'id_vdone')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="id_vdone"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="id_vdone"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="id_vdone"></i>
                                        @endif
                                    </span>
                                    </div>
                                </th>
                                <th class="white-space-150">
                                    <div class="d-flex justify-content-center align-items-center" style="gap:6px">
                                        Ngày xét duyệt
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'confirm_date')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="confirm_date"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="confirm_date"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="confirm_date"></i>
                                        @endif
                                    </span>
                                    </div>
                                </th>
                                <th class="white-space-120"></th>
                            </tr>
                        </thead>
                        <tbody>

                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{$user->account_code}}</td>
                                    <td class="text-center">
                                        @if($user->role_id == 2)
                                            <span class="text-primary font-medium">Nhà cung cấp</span> </td>
                                        @elseif($user->role_id == 1)
                                            Admin
                                        @elseif($user->role_id == 4)
                                            <span class="text-danger font-medium">Kho</span>
                                        @else
                                            <span class="text-success font-medium">V-Store</span>
                                        @endif
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-center">{{$user->phone_number}}</td>
                                    <td>{{$user->company_name}}</td>
                                    <td class="text-center">{{$user->tax_code}}</td>
                                    <td>{{$user->id_vdone}}</td>
                                    <td class="text-center">{{$user->confirm_date ? \Illuminate\Support\Carbon::parse($user->confirm_date)->format('d/m/Y') : ''}}</td>
                                    <td class="text-center white-space-120">
                                        @if($user->role_id==3 && $user->branch !=2 )
                                            <a onclick="return confirm('Vui lòng xác nhận')"
                                            class="btn btn-primary px-4 py-2"
                                            href="{{route('screens.admin.user.up',['id'=>$user->id])}}">Nâng cấp</a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-center justify-content-end mt-4">
                    {{$users->withQueryString()->links('layouts.custom.paginator')}}
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
            swalNoti('center', 'success', textSuccess,'', 500, true, 2200);
            @endif
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
                        document.location = '{{route('screens.admin.user.list_user')}}?type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    }, 200)
                });
            });
            limit.addEventListener('change', (e) => {
                setTimeout(() => {
                    document.location = '{{route('screens.admin.user.list_user',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                        '&field=' + '{{$field}}' + '&limit=' + e.target.value
                }, 200)
            })
        });

    </script>
@endsection
