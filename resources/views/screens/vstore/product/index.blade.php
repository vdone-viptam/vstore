@extends('layouts.vstore.main')

@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_title','Tất cả sản phẩm')
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tất cả sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('screens.vstore.product.index')}}"
                                                           class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
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
                <h5 class="mb-0" style="font-size:18px;">Tất cả sản phẩm</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
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
                    <table id="example" class="table table-striped table-bordered second">
                        <thead>
                        <tr>
                            <th class="white-space-150 text-center">Mã sản phẩm</th>
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
                            <th>
                                Ngành hàng
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
                                Giá sản phẩm
                                <span style="float: right;cursor: pointer">
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
                                Thuế giá trị gia tăng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'vat')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="vat"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="vat"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="vat"></i>
                                    @endif
                                </span>
                                </div>
                            </th>
                            <th class="white-space-120" style="min-width:130px !important;">Nhà cung cấp
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
                            <th class="white-space-120">
                                <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                Chiết khấu từ NCC
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discount')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discount"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discount"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discount"></i>
                                    @endif
                                </span>
                                </div>
                            </th>
                            <th class="white-space-120 text-center">
                                Ngày xét duyệt
                                <span style="float: right;cursor: pointer">

                                @if($field == 'admin_confirm_date')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="admin_confirm_date"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="admin_confirm_date"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="admin_confirm_date"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-130">
                                <div class="d-flex justify-content-between align-items-center" style="gap:6px">
                                Chiết khấu cho V-SHOP
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discount')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discount_vShop"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discount_vShop"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discount_vShop"></i>
                                    @endif
                                </span>
                                </div>
                            </th>
                            <th class="white-space-80">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <tr>
                                    <td class="white-space-150 text-center">
                                        {{$product->publish_id}}
                                    </td>
                                    <td class="white-space-350" style="min-width:180px !important;">
                                        {{$product->name}}
                                    </td>
                                    <td class="white-space-150 text-center">{{$product->cate_name}}</td>
                                    <td class="text-right">
                                        {{number_format($product->price,0,'.','.')}} đ
                                    </td>
                                    <td class="text-center">{{$product->vat}}%</td>
                                    <td>
                                        {{$product->user_name}}
                                    </td>
                                    <td class="text-center">
                                        {{$product->discount}}%
                                    </td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($product->admin_confirm_date)->format('d/m/Y H:i')}}</td>
                                    <td class="text-center">
                                        {{$product->discount_vShop}}%
                                    </td>
                                    <td style="min-width:100px !important;">
                                        <a href="javascript:void(0)" onclick="showDetail({{$product->id}})" class="btn btn-link" style="text-decoration:underline">Chi
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
                    {{$products->withQueryString()->links('layouts.custom.paginator')}}
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
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.vstore.product.detail')}}?id=` + id + '&type=2',
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
                        document.location = '{{route('screens.vstore.product.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.vstore.product.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
