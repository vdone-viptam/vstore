@extends('layouts.admin.main')
@section('page_title','Quản lý yêu cầu xét duyệt sản phẩm')

@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <form action="" method="POST" id="form">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @csrf
                    <div class="modal-body md-content">

                    </div>
                    <div class="modal-footer">
                        <button id="btnConfirm" class="btn btn-success"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

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
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý sản phẩm</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu xét duyệt sản
                                    phẩm

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
                        <h5 class="mb-0" style="font-size:18px;">Quản lý yêu cầu xét duyệt sản phẩm
                        </h5>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <form action="">
                                    <div id="custom-search" class="top-search-bar">
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <input type="hidden" name="field" value="{{$field}}">
                                        <input type="hidden" name="limit" value="{{$limit}}">
                                        <input type="search" name="key_search" value="{{$key_search}}"
                                               class="form-control"
                                               placeholder="Nhập từ khóa tìm kiếm">

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
                                    <th>Mã yêu cầu</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ngành hàng</th>
                                    <th>Nhà cung cấp</th>
                                    <th style="min-width: 200px">Chiết khấu cho V-Store
                                        <span style="float: right;cursor: pointer">
                                                 @if($field == 'requests.discount')
                                                @if($type == 'desc')
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
                                    </th>

                                    <th style="min-width: 200px">Chiết khấu cho V-Shop
                                        <span style="float: right;cursor: pointer">
                                                 @if($field == 'requests.discount_vShop')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort"
                                                       data-sort="requests.discount_vShop"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort"
                                                       data-sort="requests.discount_vShop"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="requests.discount_vShop"></i>
                                            @endif
                                </span>
                                    </th>
                                    <th style="min-width: 200px">V-Store xét duyệt</th>
                                    <th>Trạng thái
                                        <span style="float: right;cursor: pointer">
                                                 @if($field == 'requests.status')
                                                @if($type == 'desc')
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
                                    </th>
                                    <th>Thao tác</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($requests) > 0)
                                    @foreach($requests as $request)
                                        <tr class="line-clamp3">
                                            <td>{{$request->code}}</td>
                                            <td>{{$request->product_name}}</td>
                                            <td>{{$request->name}}</td>
                                            <td>{{$request->user_name}}</td>
                                            <td><span class="text-primary">{{$request->discount}}%</span></td>
                                            <td><span class="text-success">{{$request->discount_vShop}}%</span></td>
                                            <td><span>{{$request->vstore_name}}</span></td>
                                            <td>
                                                @if($request->status == 1)
                                                    <div class="bg-warning text-white font-medium px-4 py-2"
                                                         style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>Chờ
                                                        duyệt
                                                    </div>
                                                @elseif($request->status == 3)
                                                    <div class="bg-success text-white font-medium px-4 py-2"
                                                         style="border-radius: 2px;"><i class="fas fa-check mr-2"></i>Hệ
                                                        thống đã
                                                        duyệt
                                                    </div>
                                                @else
                                                    <div class="bg-danger text-white font-medium px-4 py-2"
                                                         style="border-radius: 2px;"><i class="fas fa-times mr-2"></i>Hệ
                                                        thống từ
                                                        chối
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="flex justify-content-center align-items-center text-center"
                                                style="gap:6px">

                                                @if($request->status == 1)
                                                    <button type="button"
                                                            onclick="appect({{$request->id}},{{$request->discount}},3,{{$request->discount_vShop}})"
                                                            class="btn btn-primary">Duyệt
                                                    </button>
                                                    <button type="button"
                                                            onclick="unAppect({{$request->id}},{{$request->discount}},4,{{$request->discount_vShop}})"
                                                            class="btn btn-danger">Từ chối
                                                    </button>
                                                @else
                                                    <p class="text-success"><i class="fas fa-check mr-2"></i>Đã xét
                                                        duyệt</p>
                                                @endif
                                            </td>
                                            <td><a href="javascript:void(0)" style="text-decoration: underline;"
                                                   data-toggle="modal" data-target=".bd-example-modal-lg">Chi tiết</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="10">Không có dữ liệu phù hợp</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-center justify-content-end mt-4">
                            {{$requests->withQueryString()->links('layouts.custom.paginator')}}
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
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{\Illuminate\Support\Facades\Session::get('success')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{\Illuminate\Support\Facades\Session::get('error')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
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
                        document.location = '{{route('screens.admin.product.index')}}?type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    }, 200)
                });
            });
            limit.addEventListener('change', (e) => {
                setTimeout(() => {
                    document.location = '{{route('screens.admin.product.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                        '&field=' + '{{$field}}' + '&limit=' + e.target.value
                }, 200)
            })
        });
        document.getElementById('btnConfirm').style.display = 'none';

        function appect(id, discount, status, discount_vShop) {
            $('.md-content').html(`
 <div class="form-group">
               <label>Chiết khấu được từ nhà cung cấp</label>
<input class="form-control number" data-discount="${discount}" name="discount" id="discount" disabled value="${discount} %">
            </div>
            <div class="form-group">
               <label>Chiết khấu cho V-Shop</label>
<input class="form-control number-percent" name="discount_vShop" id="discount_vShop" value="${discount_vShop}" disabled>
            </div>
            `);
            document.querySelector('#form').setAttribute('action', '{{route('screens.admin.product.confirm')}}/' + id + '?status=' + status)
            $('#btnConfirm').html('Duyệt')
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
            $('#btnConfirm').html('Từ chối')
            document.querySelector('#form').setAttribute('action', '{{route('screens.admin.product.confirm')}}/' + id + '?status=' + status)
            $('#modalDetail').modal('show');


        }
    </script>
@endsection
