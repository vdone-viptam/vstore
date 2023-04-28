@extends('layouts.vstore.main')

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
                        <button id="btnConfirm" class="btn btn-success">Cập nhật yêu cầu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('page_title','Yêu cầu xét duyệt sản phẩm đã xác nhận')
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Yêu cầu xét duyệt sản phẩm đã xác nhận</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('screens.vstore.product.request')}}"
                                                           class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Yêu cầu xét duyệt sản phẩm đã xác nhận
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Yêu cầu xét duyệt sản phẩm đã xác nhận</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form action="">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input type="search" name="key_search" value="{{$key_search}}"
                                       class="form-control"
                                       placeholder="Nhập từ khóa tìm kiếm">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th class="white-space-90">Mã yêu cầu</th>
                            <th class="white-space-120">
                                <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                    Nhà cung cấp
                                    <span style="float: right;cursor: pointer">
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
                            <th>
                            <div class="d-flex justify-content-between align-items-center" style="gap:6px">    
                            Tên sản phẩm
                                <span style="float: right;cursor: pointer">
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
                            <th class="white-space-120">Ngành hàng
                                <span style="float: right;cursor: pointer">
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
                            </th>
                            <th class="white-space-120">
                                <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                    Giá sản phẩm chưa VAT
                                    <span style="float: right;cursor:pointer">
                                    @if($field == 'products.price')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="products.price"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="products.price"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="products.price"></i>
                                        @endif
                                </span>
                                </div>
                            </th>
                            <th class="white-space-120">
                                <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                    Chiết khấu từ Nhà cung cấp
                                    <span style="float: right;cursor:pointer">
                                    @if($field == 'requests.discount')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="requests.discount"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="requests.discount"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="requests.discount"></i>
                                        @endif
                                </span>
                                </div>
                            </th>
                            <th class="white-space-120 text-center" style="min-width:130px !important;">Ngày yêu cầu
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'requests.created_at')
                                        @if($type == 'products.price')
                                            <i class="fa-solid fa-sort-down sort" data-sort="requests.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="requests.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="requests.created_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-120 text-center" style="min-width:130px !important;">Ngày xét duyệt
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'products.vstore_confirm_date')
                                        @if($type == 'products.vstore_confirm_date')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="products.vstore_confirm_date"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort"
                                               data-sort="products.vstore_confirm_date"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="products.vstore_confirm_date"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="text-center">Trạng thái
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'requests.status')
                                        @if($type == 'products.price')
                                            <i class="fa-solid fa-sort-down sort" data-sort="requests.status"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="requests.status"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="requests.status"></i>
                                    @endif
                                </span>
                            </th>

                            <th>Thao tác</th>
                            <th class="white-space-50">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $product)
                                <tr>
                                    <td class="white-space-90">
                                        {{$product->code}}
                                    </td>
                                    <td class="white-space-90">
                                        {{$product->user_name}}
                                    </td>
                                    <td class="white-space-300" style="min-width:250px !important;">
                                        {{$product->name}}
                                    </td>
                                    <td class="white-space-100">{{$product->cate_name}}</td>
                                    <td class="white-space-120 text-right">
                                        {{number_format($product->price,0,'.','.')}} đ
                                    </td>
                                    <td class="white-space-120 text-center">
                                        {{$product->discount}}%
                                    </td>
                                    <td class="white-space-120 text-center">{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}</td>
                                    <td class="white-space-120 text-center">{{$product->vstore_confirm_date ?
\Carbon\Carbon::parse($product->vstore_confirm_date)->format('d/m/Y') : 'Chưa xét duyệt'}}</td>
                                    <td class="white-space-200" style="min-width:155px !important;">
                                        @if($product->status == 0)
                                            <div
                                                class="text-warning d-flex align-items-center font-medium" style="gap:6px;">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 12.6C8.48521 12.6 9.90959 12.01 10.9598 10.9598C12.01 9.90959 12.6 8.48521 12.6 7C12.6 5.51479 12.01 4.09041 10.9598 3.0402C9.90959 1.99 8.48521 1.4 7 1.4C5.51479 1.4 4.09041 1.99 3.0402 3.0402C1.99 4.09041 1.4 5.51479 1.4 7C1.4 8.48521 1.99 9.90959 3.0402 10.9598C4.09041 12.01 5.51479 12.6 7 12.6ZM7 0C7.91925 0 8.8295 0.18106 9.67878 0.532843C10.5281 0.884626 11.2997 1.40024 11.9497 2.05025C12.5998 2.70026 13.1154 3.47194 13.4672 4.32122C13.8189 5.17049 14 6.08075 14 7C14 8.85651 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85651 14 7 14C3.129 14 0 10.85 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0ZM7.35 3.5V7.175L10.5 9.044L9.975 9.905L6.3 7.7V3.5H7.35Z"
                                                        fill="#ffc107"/>
                                                </svg>
                                                Đang chờ duyệt
                                            </div>
                                        @elseif($product->status == 1)
                                            <div
                                            class="text-warning d-flex align-items-center font-medium" style="gap:6px;">
                                            <div style="width:15px;">
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 12.6C8.48521 12.6 9.90959 12.01 10.9598 10.9598C12.01 9.90959 12.6 8.48521 12.6 7C12.6 5.51479 12.01 4.09041 10.9598 3.0402C9.90959 1.99 8.48521 1.4 7 1.4C5.51479 1.4 4.09041 1.99 3.0402 3.0402C1.99 4.09041 1.4 5.51479 1.4 7C1.4 8.48521 1.99 9.90959 3.0402 10.9598C4.09041 12.01 5.51479 12.6 7 12.6ZM7 0C7.91925 0 8.8295 0.18106 9.67878 0.532843C10.5281 0.884626 11.2997 1.40024 11.9497 2.05025C12.5998 2.70026 13.1154 3.47194 13.4672 4.32122C13.8189 5.17049 14 6.08075 14 7C14 8.85651 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85651 14 7 14C3.129 14 0 10.85 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0ZM7.35 3.5V7.175L10.5 9.044L9.975 9.905L6.3 7.7V3.5H7.35Z"
                                                        fill="#ffc107"/>
                                                </svg>
                                            </div>

                                                Đã duyệt - chờ hệ thống duyệt
                                            </div>
                                        @elseif($product->status == 2)
                                            <div
                                            class="text-danger d-flex align-items-center font-medium" style="gap:6px;">
                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.2 12L0 10.8L4.8 6L0 1.2L1.2 0L6 4.8L10.8 0L12 1.2L7.2 6L12 10.8L10.8 12L6 7.2L1.2 12Z"
                                                        fill="#ef172c"/>
                                                </svg>
                                                Từ chối
                                            </div>
                                        @elseif($product->status == 3)
                                            <div
                                            class="text-success d-flex align-items-center font-medium" style="gap:6px;">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="#2ec551"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Hệ thống đồng ý
                                            </div>
                                        @else
                                            <div class="bg-danger text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-times mr-2"></i> Hệ thống
                                                từ chối
                                            </div>
                                        @endif
                                    </td>

                                    <td class="text-center" style="min-width:140px !important;">
                                    @if($product->status == 0)
                                            <a href="#" onclick="appect({{$product->id}},{{$product->discount}},1)"
                                               class="btn text-success px-2" style="text-decoration:underline">Đồng ý</a>
                                            <a href="#" onclick="unAppect({{$product->id}},{{$product->discount}},2)"
                                               class="btn text-danger px-2" style="text-decoration:underline">Từ chối</a>
                                        @endif
                                    </td>
                                    <td class="text-center" style="min-width:80px !important;">
                                    
                                        <a href="#" onclick="showDetail({{$product->id}})" class="btn btn-link px-2" style="text-decoration:underline;">Chi
                                            tiết</a>
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
        document.getElementById('btnConfirm').style.display = 'none';

        function appect(id, discount, status) {
            $('.md-content').html(`
 <div class="form-group">
               <label>Chiết khấu được từ nhà cung cấp</label>
<input class="form-control number" data-discount="${discount}" name="discount" id="discount" disabled value="${discount} %">
            </div>
            <div class="form-group">
               <label>Chiết khấu cho V-Shop</label>
<input class="form-control number" name="discount_vShop" id="discount_vShop">
            <p id="messageDis" style="display: none" class="text-danger mt-2 ms-1">Chiết khấu cho V-Shop không được nhỏ hơn ${discount / 2} và lớn hơn ${discount}</p>
            </div>
            `);
            document.querySelector('#form').setAttribute('action', '{{route('screens.vstore.product.confirm')}}/' + id + '?status=' + status)

            document.getElementsByName('discount_vShop')[0].addEventListener('keyup', (e) => {
                if (+e.target.value < Number(document.getElementById('discount').dataset.discount) && +e.target.value >= Number(document.getElementById('discount').dataset.discount) / 2) {
                    document.getElementById('messageDis').style.display = 'none';
                    document.getElementById('btnConfirm').style.display = 'block';

                } else {
                    document.getElementById('messageDis').style.display = 'block';
                    document.getElementById('btnConfirm').style.display = 'none';
                }

            })
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
            document.querySelector('#form').setAttribute('action', '{{route('screens.vstore.product.confirm')}}/' + id + '?status=' + status)
            $('#modalDetail').modal('show');
            document.getElementById('btnConfirm').style.display = 'block';

        }

        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.vstore.product.detail')}}?id=` + id + '&type=1',
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Xem chi tiết sản phẩm thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = `${data.view}`;
                $('.md-content').html(htmlData)
                $('#modalDetail').modal('show');
                document.querySelector('#form').setAttribute('action', '{{route('screens.vstore.product.confirm')}}/' + id)
            })


        }

        let limit = document.getElementById('limit');
        console.log(limit)
        $(document).ready(function () {
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
                        document.location = '{{route('screens.vstore.product.requestAll',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.vstore.product.requestAll',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
