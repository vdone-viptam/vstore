@extends('layouts.vstore.main')

@section('modal')
    <div id="modal5"></div>
@endsection

@section('page_title','Tất cả sản phẩm')
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
                                <div class="row">

                                    <div class="col-5 form-group">
                                        <select name="condition" id="" class="form-control">
                                            <option value="1" {{$condition == 1 ? 'selected' : ''}}>Tất cả</option>
                                            <option value="2" {{$condition == 2 ? 'selected' : ''}}>Mã sản phẩm</option>
                                            <option value="3" {{$condition == 3 ? 'selected' : ''}}>Tên sản phẩm
                                            </option>
                                            <option value="4" {{$condition == 4 ? 'selected' : ''}}>Nhà cung cấp
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-7 form-group">
                                        <input type="search" name="key_search" value="{{$key_search}}"
                                               class="form-control"
                                               placeholder="Nhập từ khóa tìm kiếm">
                                    </div>
                                </div>
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
                            <th>Mã yêu cầu</th>
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
                            <th>Ngành hàng
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

                            <th>Ngày yêu cầu
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'products.price')
                                        @if($type == 'products.price')
                                            <i class="fa-solid fa-sort-down sort" data-sort="products.price"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="products.price"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="products.price"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Nhà cung cấp
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
                            </th>
                            <th>Chiết khấu
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'amount_product_sold')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="amount_product_sold"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="amount_product_sold"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="amount_product_sold"></i>
                                    @endif
                                </span>
                            </th>
                            <th>
                                Chức năng
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        {{$product->publish_id}}
                                    </td>
                                    <td>
                                        {{$product->name}}
                                    </td>
                                    <td>
                                        {{$product->user_name}}
                                    </td>
                                    <td>
                                        {{number_format($product->price,0,'.','.')}}
                                    </td>
                                    <td>
                                        {{$product->discount}}
                                    </td>
                                    <td>
                                        {{number_format($product->amount_product_sold,0,'.','.')}}
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-link">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$products->withQueryString()->links()}}
                    <select id="limit" class="form-control col-1">
                        <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 phần tử / trang</option>
                        <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 phần tử / trang</option>
                        <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 phần tử / trang</option>
                    </select>
                </div>


            </div>

        </div>
    </div>

@endsection

@section('custom_js')
    <script>
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
                        document.location = '{{route('screens.vstore.product.request',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
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
