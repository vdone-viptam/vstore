@extends('layouts.admin.main')
@section('page_title','Danh sách đơn đăng ký tài khoản')
@section('custom_css')
    <style>
        .loader-container {
            width: 100%;
            height: 100vh;
            position: fixed;
            background: #ffffff url("https://img.pikbest.com/png-images/20190918/cartoon-snail-loading-loading-gif-animation_2734139.png!bw340") center no-repeat;
            z-index: 1;
        }
    </style>
@endsection

@section('modal')
    <div class="modal fade" id="modalDetail">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-content pt-0">
                    <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-12">
                                    <h3 style="font-size: 18px;">Thông tin cơ bản</h3>
                                </div> --}}

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tên</label>
                                        <input type="text" class="form-control form-control-lg" disabled="" id="name" value="VN-3meknyCZGo" placeholder="Nhập tên sản phẩm">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="text" class="form-control" disabled="" value="Đồng hồ nam Orient RA-AG0003S10B" id="email">
                                    </div>

                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Số điện thoại:</label>
                                        <input type="text" class="form-control form-control-lg" id="phone_number" disabled="" value="Đồng hồ" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Mã số thuế</label>
                                        <input type="text" disabled="" class="form-control form-control-lg" id="tax_code" value="10.000.000 đ" placeholder="">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Id P-Done người đại diện
                                        </label>
                                        <input type="text" class="form-control form-control-lg" disabled="" id="id_vdone" value="Chưa xác định" placeholder="Nhập tên thương hiệu">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Phân loại tài khoản</label>
                                        <input type="text" disabled="" class="form-control form-control-lg" id="role_id" value="10" placeholder="Nhập xuất xứ">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Thời gian đăng ký</label>
                                        <input type="text" class="form-control form-control-lg" id="created_at" disabled="" value="4" placeholder="Nhập chất liệu sản phẩm">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Thời gian xét duyệt</label>
                                        <input type="text" class="form-control form-control-lg" id="confirm_date" disabled="" value="100" placeholder="Nhập chất liệu sản phẩm">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Mã người giới thiệu</label>
                                        <input type="text" class="form-control form-control-lg" id="referral_code" disabled="" value="100" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Trạng thái</label>
                                        <input type="text" class="form-control form-control-lg" id="status" disabled="" value="100" placeholder="Nhập chất liệu sản phẩm">
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div
        class="modal fade"
        id="exampleModalCenter">
        {{-- <form method="post" action="{{route('screens.manufacture.warehouse.addProduct')}}"> --}}
            {{-- @csrf --}}
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelv2" style="font-size: 18px;">Thêm sản phẩm vào
                            kho</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body md-content">

                        <div class="row">
                            <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chọn sản phẩm <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" id="product_id" name="product_id">
                                        <option value="" selected disabled>Lựa chọn sản phẩm thêm vào kho</option>

                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Nhập số lượng <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg number only-number"
                                           id="quantity"
                                           name="quantity"
                                           value="{{old('quantity')}}" placeholder="Nhập Số lượng sản phẩm">
                                </div>

                            </div>
                            <div class="col-xl-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Loại kho <span class="text-danger">*</span></label>
                                    <div id="selectType" class="form-group row">
                                        <p class="text-danger ml-4">Chọn kho để hiện thị thông tin loại kho</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button id="btnAddPro" type="submit" class="btn btn-success">Gửi yêu cầu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        {{-- </form> --}}
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
                <h2 class="pageheader-title">Quản lý yêu cầu đăng ký tài khoản </h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý tài
                                    khoản</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu đăng
                                ký tài khoản</li>
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
                    <h5 class="mb-0" style="font-size:18px;">Quản lý yêu cầu đăng kí tài khoản
                    </h5>
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <form>
                                    <input name="key_search" value="{{$key_search ?? ''}}" class="form-control"
                                           type="search"
                                           placeholder="Nhập từ khóa tìm kiếm...">
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
                                    <th class="white-space-200 text-center">
                                      
                                            Tên
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
                               
                                    </th>
                                    <th class="white-space-200 text-center">

                                     
                                            Email
                                            <span style="float: right;cursor:pointer">
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
                                      
                                    </th>
                                    <th class="white-space-150">
                                     
                                            Số điện thoại
                                            <span style="float: right;cursor:pointer">
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
                                        
                                    </th>
                                    <th class="white-space-200 text-center">
                                    
                                            Tên công ty
                                            <span style="float: right;cursor:pointer">
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
                                      
                                    </th>
                                    <th class="white-space-150">
                                        
                                            Mã số thuế
                                            <span style="float: right;cursor:pointer">
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
                                       
                                    </th>
                                    <th class="white-space-200 text-center">
                                     
                                            Id P-Done người đại diện
                                            <span style="float: right;cursor:pointer">
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
                                   
                                    </th>
                                    <th class="white-space-200">
                                       
                                            Phân loại tài khoản
                                            <span style="float: right;cursor:pointer">
                                                @if($field == 'users.role_id')
                                                    @if($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort" data-sort="users.role_id"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort" data-sort="users.role_id"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="users.role_id"></i>
                                                @endif
                                            </span>
                                      
                                    </th>
                                    <th class="white-space-200">
                                      
                                            Thời gian đăng ký
                                            <span style="float: right;cursor:pointer">
                                                @if($field == 'users.created_at')
                                                    @if($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort" data-sort="users.created_at"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort" data-sort="users.created_at"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="users.created_at"></i>
                                                @endif
                                            </span>
                                       
                                    </th>
                                    <th class="white-space-200">
                                     
                                            Thời gian xét duyệt
                                            <span style="float: right;cursor:pointer">
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
                                        
                                    </th>
                                    <th class="white-space-200">
                                      
                                            Mã người giới thiệu
                                            <span style="float: right;cursor:pointer">
                                                @if($field == 'users.referral_code')
                                                    @if($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort" data-sort="users.referral_code"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort" data-sort="users.referral_code"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="users.referral_code"></i>
                                                @endif
                                            </span>
                                       
                                    </th>
                                    <th class="white-space-150">
                                 
                                            Trạng thái
                                      
                                    </th>
                                    <th class="white-space-100">Thao tác</th>
                                    <th class="white-space-100"></th>
                                </tr>
                            </thead>
                            <tbody>

                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td class="white-space-200">{{$user->name}}</td>
                                    <td class="white-space-200">{{ Str::limit($user->email, 15) }}</td>
                                    <td class="text-center white-space-150">{{$user->phone_number}}</td>
                                    <td class="white-space-200">{{$user->company_name}}</td>
                                    <td class="text-center">{{$user->tax_code}}</td>
                                    <td class="text-center">{{$user->id_vdone}}</td>
                                    <td class="text-center">
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
                                    <td class="text-center">{{\Illuminate\Support\Carbon::parse($user->created_at)->format('d/m/Y H:i')}}</td>
                                    <td class="text-center">{{$user->confirm_date ? \Illuminate\Support\Carbon::parse($user->confirm_date)->format('d/m/Y H:i') : ''}}</td>
                                    <td class="text-center">
                                        {{strlen($user->referral_code) > 0 ? $user->referral_code : ''}}
                                    </td>
                                    <td class="text-center">
                                        @if(!empty($user->confirm_date))
                                            <div class=" text-success font-medium px-4 py-2" style="border-radius: 2px;"><i class="fas fa-check mr-2"></i>Đã duyệt</div>
                                        @else
                                            <div class=" text-warning font-medium px-4 py-2" style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i> Chờ duyệt</div>
                                        @endif
                                    </td>
                                    <td class="text-center white-space-100">
                                        @if(!$user->confirm_date)
                                            <a data-abc="{{$loop->iteration - 1}}"
                                            href="{{route('screens.admin.user.confirm',['id' => $user->id])}}"
                                            class="duyet btn text-primary font-medium px-2" style="text-decoration:underline;"
                                            href="#">Duyệt
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center white-space-100">
                                            <a href="javascript:void(0)" data-id="{{$user->id}}" data-role="{{$user->role_id}}"
                                                onclick="showDetail({{$user->id}})"
                                            class="more-details text-primary" style="text-decoration:underline">
                                                Chi tiết</a>
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
                    <div class="d-flex align-items-center justify-content-end mt-4">
                            {{$users->withQueryString()->links('layouts.custom.paginator')}}
                            <div class="ml-4">
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

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 20px;">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-12">
                                <h3 style="font-size: 18px;">Thông tin cơ bản</h3>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập tên sản phẩm">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chọn ngành hàng <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg">
                                        <option>10 phần tử / trang</option>
                                        <option>25 phần tử / trang</option>
                                        <option>50 phần tử / trang</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Giá bán sản phẩm (Chưa VAT):</label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name"> Mã SKU sản phẩm<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="">
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chi tiết sản phẩm <span
                                            class="text-danger">*</span></label>
                                    <textarea name="" class="form-control form-control-lg" id=""
                                        cols="30" rows="10"
                                        placeholder="Nhập chi tiết sản phẩm"></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="name">Tóm tắt sản phẩm <span
                                            class="text-danger">*</span></label>
                                    <textarea name="" class="form-control form-control-lg" id=""
                                        cols="30" rows="4"
                                        placeholder="Nhập tóm tắt sản phẩm"></textarea>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="">Hình ảnh sản phẩm:</label>
                                <div class="mb-3  d-flex flex-lg-wrap flex-xl-nowrap w-100">
                                    <div class="col-xl-4 col-sm-6 ">
                                        <img src="./assets/images/card-img-1.jpg" class="w-100 " alt=""
                                            style="object-fit: cover; height: 200px;">
                                    </div>
                                    <div class="col-xl-4 col-sm-6  ">
                                        <img src="./assets/images/card-img-2.jpg" class="w-100 " alt=""
                                            style="object-fit: cover; height: 200px;">
                                    </div>
                                    <div class="col-xl-4 col-sm-6  ">
                                        <img src="./assets/images/card-img-2.jpg" class="w-100 " alt=""
                                            style="object-fit: cover; height: 200px;">
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 mb-3 col-xl-12">
                                <div class="form-group">
                                    <label for="name">Video sản phẩm</label>
                                    <iframe height="300"
                                        {{-- src="https://www.youtube.com/watch?v=gKqGZKo5fVs&list=RDMM5zLhk-HvXsw&index=2" --}}
                                        frameborder="0" style="width: 100%;"></iframe>
                                </div>
                            </div>
                            <div class="col-12">
                                <h3 style="font-size: 18px;">Thông tin chi tiết</h3>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên thương hiệu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập tên thương hiệu">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Xuất xứ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập xuất xứ">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chất liệu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập chất liệu sản phẩm">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Kích cỡ (Cm) <span
                                            class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-12">
                                            <input type="text" class="form-control form-control-lg"
                                                id="name" value="${data.data.name}"
                                                placeholder="Nhập chiều dài (Cm)">
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-12 ">
                                            <input type="text" class="form-control form-control-lg"
                                                id="name" value="${data.data.name}"
                                                placeholder="Nhập chiều rộng (Cm)">
                                        </div>
                                        <div class="col-xl-4  col-lg-4 col-12">
                                            <input type="text" class="form-control form-control-lg"
                                                id="name" value="${data.data.name}"
                                                placeholder="Nhập chiều cao (Cm)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Trọng lượng (Gram) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}"
                                        placeholder="Nhập trọng lượng sản phẩm (Gram)">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Thể tích (Ml)</label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập thể tích sản phẩm">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên tổ chức chịu trách nhiệm sản xuất </label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập tên tổ chức">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Địa chỉ tổ chức chịu trách nhiệm sản xuất</label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập địa chỉ tổ chức">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên đơn vị chịu trách nhiệm nhập khẩu/thương
                                        nhân</label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập tên địa chỉ đơn vị">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Địa chỉ đơn vị chịu trách nhiệm nhập khẩu</label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập tên địa chỉ đơn vị">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Ngày sản xuất</label>
                                    <input type="date" class="form-control form-control-lg" id="name"
                                        value="${data.data.name}" placeholder="Nhập tên thương hiệu">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Kiểu đóng gói <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg">
                                        <option>10 phần tử / trang</option>
                                        <option>25 phần tử / trang</option>
                                        <option>50 phần tử / trang</option>
                                    </select>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                        lại</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
    <script>

        const name = document.getElementById('name');
        const id = document.getElementById('id');
        const limit = document.getElementById('limit');
        const form = document.getElementById('form');

        $(document).ready(function () {
            @if(Session::has('success'))
            const textSuccess = '{{ Session::get('success')}}';
            swalNoti('center', 'success', 'Duyệt tài khoản thành công','', 500, true, 2200);
            @endif

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
                        document.location = '{{route('screens.admin.user.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    })
                });
            });

            limit.addEventListener('change', (e) => {
                setTimeout(() => {
                    document.location = '{{route('screens.admin.user.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                        '&field=' + '{{$field}}' + '&limit=' + e.target.value
                }, 200)
            })

            $('.duyet').click(function (e) {
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
                        window.location = $(this).attr('href');
                        $(".duyet").attr("href", "javascript:void(0)");

                    }
                })
            });
        });

        $('.more-details').each(function (i, e) {
            $(this).on('click', (o) => {
                $.ajax({
                    url: '{{route('screens.admin.user.detail')}}?id=' + e.dataset.id + '&_token={{csrf_token()}}&role_id=' + e.dataset.role,
                    success: function (result) {
                        $('#modal1').html('');
                        $('#modal1').append(result);
                        $('.modal-details').toggleClass('show-modal')
                    },
                });
            });
        });
        let product = {};
        function formatDate (input) {
            var datePart = input.match(/\d+/g),
            year = datePart[0], // get only two digits
            // year = datePart[0].substring(2), // get only two digits
            month = datePart[1], day = datePart[2];

            return day+'/'+month+'/'+year;
        }
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.admin.user.detail')}}?id=` + id + '&product=true',
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
                if (data) {
                    $('#modalDetail').modal('show');
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone_number').val(data.phone_number);
                    $('#id_vdone').val(data.id_vdone);
                    $('#tax_code').val(data.tax_code);
                    $('#created_at').val( convertTimeVN(data.created_at));
                    $('#confirm_date').val(  convertTimeVN(data.confirm_date));
                    $('#referral_code').val(data.referral_code);



                    if(data.role_id == 2){
                        $('#role_id').val('Nhà cung cấp');
                    }else if(data.role_id == 1){
                        $('#role_id').val('Admin');
                    }else if(data.role_id == 4){
                        $('#role_id').val('Kho');
                    }else{
                        $('#role_id').val('V-Store');
                    }
                    if(data.confirm_date){
                        $('#status').val('Đã duyệt');
                    }else{
                        $('#status').val('Chờ duyệt');
                    }
                } else {
                    $('#modalDetail').modal('show');
                    $('#modalDetail .md-content').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })


        }

    </script>
    <script !src="">

    </script>
@endsection
