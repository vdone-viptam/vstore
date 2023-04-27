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

@section('page_title','Quản lý yêu cầu xét duyệt sản phẩm')
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('screens.vstore.product.request')}}"
                                                           class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu xét duyệt sản phẩm
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
                <h5 class="mb-0" style="font-size:18px;">Quản lý yêu cầu xét duyệt sản phẩm</h5>
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
                            <th class="white-space-90">
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
                            <th>Tên sản phẩm
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
                            </th>
                            <th class="white-space-100">Ngành hàng
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
                            <th class="white-space-120">Ngày yêu cầu
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
                            <th class="white-space-120">Ngày xét duyệt
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
                            <th>Trạng thái
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
                                    <td class="white-space-300">
                                        {{$product->name}}
                                    </td>
                                    <td class="white-space-100">{{$product->cate_name}}</td>
                                    <td class="white-space-120 text-right">
                                        {{number_format($product->price,0,'.','.')}} đ
                                    </td>
                                    <td class="white-space-120 text-right">
                                        {{$product->discount}} %
                                    </td>
                                    <td class="white-space-120">{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}</td>
                                    <td class="white-space-120">{{$product->vstore_confirm_date ?
\Carbon\Carbon::parse($product->vstore_confirm_date)->format('d/m/Y') : 'Chưa xét duyệt'}}</td>
                                    <td class="white-space-200">
                                        @if($product->status == 0)
                                            <div class="bg-warning text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>Chờ
                                                Đang chờ duyệt
                                            </div>
                                        @elseif($product->status == 1)
                                            <div class="bg-warning text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>Chờ
                                                Đã duyệt - chờ hệ thống duyệt
                                            </div>
                                        @elseif($product->status == 2)
                                            <div class="bg-danger text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-times mr-2"></i> Từ chối
                                            </div>
                                        @elseif($product->status == 3)
                                            <div class="bg-success text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-check mr-2"></i>Hệ thống
                                                đồng ý
                                            </div>
                                        @else
                                            <div class="bg-danger text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-times mr-2"></i> Hệ thống
                                                từ chối
                                            </div>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($product->status == 0)
                                            <a href="#" onclick="appect({{$product->id}},{{$product->discount}},1)"
                                               class="btn btn-success">Đồng ý</a>
                                            <a href="#" onclick="unAppect({{$product->id}},{{$product->discount}},2)"
                                               class="btn btn-danger">Từ chối</a>
                                        @endif

                                        <a href="#" onclick="showDetail({{$product->id}})" class="btn btn-link">Chi
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
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$requests->withQueryString()->links('layouts.custom.paginator')}}
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
