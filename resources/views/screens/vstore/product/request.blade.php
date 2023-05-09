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
                        <button id="btnConfirm" class="btn btn-success">Duyệt sản phẩm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('page_title','Quản lý yêu cầu chưa xét duyệt')
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Yêu cầu xét duyệt sản phẩm chưa xác nhận</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('screens.vstore.product.request')}}"
                                                           class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu chưa xét duyệt sản
                                phẩm
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
                <h5 class="mb-0" style="font-size:18px;">Yêu cầu xét duyệt sản phẩm chưa xác nhận</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <form action="">
                            @csrf
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
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th class="white-space-110">Mã yêu cầu</th>
                            <th class="white-space-130 text-center">Nhà cung cấp
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
                            </th>
                            <th>
                         
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

                            </th>
                            <th class="text-center white-space-110">Ngành hàng
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
                            <th class="white-space-130">
                            <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    Giá sản phẩm <br> chưa VAT
</span>
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
                            <th class="white-space-150">
                            <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    Chiết khấu từ <br> Nhà cung cấp
</span>
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
                            <th class="white-space-130 text-center">Ngày yêu cầu
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
                            <th class="white-space-100 text-center">Trạng thái</th>
                            <th class="white-space-130">
                                Thao tác
                            </th>
                            <th class="white-space-80">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $product)
                                <tr>
                                    <td class="text-center white-space-130" >
                                        {{$product->code}}
                                    </td>
                                    <td class="white-space-150 text-center">
                                        {{$product->user_name}}
                                    </td>
                                    <td class="white-space-250">
                                        {{$product->name}}
                                    </td>
                                    <td class="text-center white-space-150">{{$product->cate_name}}</td>
                                    <td class="text-right white-space-130">
                                        {{number_format($product->price,0,'.','.')}} đ
                                    </td>
                                    <td class="text-center white-space-80">
                                        {{$product->discount}}%
                                    </td>

                                    <td class="text-center white-space-130">{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}</td>
                                    <td class=" text-center white-space-130"><span
                                            class="font-medium ">Yêu cầu mới</span></td>

                                    <td class="text-center white-space-160">
                                        <a href="javascript:void(0)" onclick="appect({{$product->id}},{{$product->discount}},1)"
                                           class="btn px-2 py-0 text-success font-medium" style="text-decoration:underline">Đồng ý</a>
                                        <a href="javascript:void(0)" onclick="unAppect({{$product->id}},{{$product->discount}},2)"
                                           class="btn px-2  py-0 text-danger font-medium" style="text-decoration:underline">Từ chối</a>
                                    </td>
                                    <td class="text-center white-space-80"><a href="javascript:void(0)" 
                                           class="btn px-2 py-0 text-primary" style="text-decoration:underline">Chi tiết</a></td>
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
        let limit = document.getElementById('limit');
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
                <div class="form-group text-left mt-3">
                    <label class="custom-control custom-checkbox custom-control-inline" style="margin: 0;">
                        <input type="checkbox" id="appect" name="type" value="1" class="custom-control-input" onclick="checkHideShow();"><span
                            class="custom-control-label">Chúng tôi đã kiểm định thông tin sản phẩm</span>
                    </label>
                </div>
            `);
            document.querySelector('#form').setAttribute('action', '{{route('screens.vstore.product.confirm')}}/' + id + '?status=' + status)
            document.querySelector('#form').setAttribute('name', '_csrf');

            document.getElementsByName('discount_vShop')[0].addEventListener('keyup', (e) => {
                if (+e.target.value < Number(document.getElementById('discount').dataset.discount) && +e.target.value >= Number(document.getElementById('discount').dataset.discount) / 2) {
                    if ($('#appect').is(":checked")) {
                        document.getElementById('messageDis').style.display = 'none';
                        document.getElementById('btnConfirm').style.display = 'block';
                    } else {
                        document.getElementById('messageDis').style.display = 'block';
                        document.getElementById('btnConfirm').style.display = 'none';
                    }
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

        function checkHideShow(){
            if (Number(document.getElementById('discount').dataset.discount) &&
                $('#discount_vShop').val() < Number(document.getElementById('discount').dataset.discount) &&
                $('#discount_vShop').val() >= Number(document.getElementById('discount').dataset.discount) / 2 &&
                $('#appect').is(":checked")) {
                document.getElementById('messageDis').style.display = 'none';
                document.getElementById('btnConfirm').style.display = 'block';
            } else {
                document.getElementById('messageDis').style.display = 'block';
                document.getElementById('btnConfirm').style.display = 'none';
            }
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
            document.querySelector('#form').setAttribute('name', '_csrf');

            $('#modalDetail').modal('show');
            document.getElementById('btnConfirm').style.display = 'block';

        }

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
                        document.location = '{{route('screens.vstore.product.request',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.vstore.product.request',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
