@extends('layouts.admin.main')
@section('page_title','Tất cả sản phẩm')

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
                                <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm
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
                        <h5 class="mb-0" style="font-size:18px;">Tất cả sản phẩm
                        </h5>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <form>
                                    <input type="hidden" name="type" value="{{$type}}">
                                    <input type="hidden" name="field" value="{{$field}}">
                                    <input type="hidden" name="limit" value="{{$limit}}">
                                    <input type="search" name="key_search" value="{{$key_search}}"
                                           class="form-control"
                                           placeholder="Nhập từ khóa tìm kiếm">
                                </form>

                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Mã sản phẩm

                                    </th>
                                    <th>Ngành hàng
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'category_name')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="category_name"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="category_name"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="category_name"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>Nhà cung cấp
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
                                    </th>
                                    <th class="white-space-200">Chiết khấu cho V-Store
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
                                    <th>V-Store xét duyệt</th>
                                    <th class="white-space-200">Chiết khấu cho V-Shop
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'discount_vShop')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort"
                                                       data-sort="discount_vShop"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="discount_vShop"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="discount_vShop"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>Số lượng trong kho
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'amount')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="amount"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="amount"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="amount"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>Số lượng đã bán
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'amount_product_sold')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort"
                                                       data-sort="amount_product_sold"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort"
                                                       data-sort="amount_product_sold"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="amount_product_sold"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>Ngày niêm yết
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'admin_confirm_date')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort"
                                                       data-sort="admin_confirm_date"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort"
                                                       data-sort="admin_confirm_date"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="admin_confirm_date"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $pro)
                                    <tr class="line-clamp3">
                                        <td>{{$pro->publish_id}}</td>
                                        <td>{{$pro->category_name}}</td>
                                        <td class="font-medium">{{$pro->name}}</td>
                                        <td class="text-center">{{$pro->discount}}</td>
                                        <td style="text-transform: uppercase;">{{$pro->vstore_name}}</td>
                                        <td class="text-center">{{$pro->discount_vShop ??0}}</td>
                                        @if($pro->amount >= 0 )
                                            <td style=" white-space: pre-wrap;">{{$pro->amount}}</td>
                                        @else
                                            <td style=" white-space: pre-wrap;">0</td>
                                        @endif

                                        <td class="text-center">{{$pro->amount_product_sold ??0}}</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($pro->admin_confirm_date)->format('i:H d-m-Y')  }}
                                        </td>
                                        <td>


                                        </td>
                                    </tr>
                                @endforeach


                                {{--                                <tr class="line-clamp3">--}}
                                {{--                                    <td>G1231232</td>--}}
                                {{--                                    <td>VN123123123</td>--}}
                                {{--                                    <td class="font-medium">1.000.000đ</td>--}}
                                {{--                                    <td>19038334966011</td>--}}
                                {{--                                    <td style="text-transform: uppercase;">TRAN THANH KHOA</td>--}}
                                {{--                                    <td>Techcombank</td>--}}
                                {{--                                    <td style="min-width: 400px; white-space: pre-wrap;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse dolor ratione et perspiciatis, maxime veniam earum soluta illo quae impedit eveniet adipisci fuga fugit a. Beatae suscipit totam nobis corrupti!</td>--}}
                                {{--                                    <td>10/04/2023</td>--}}
                                {{--                                    <td><span class="text-success font-medium">Thành công</span></td>--}}
                                {{--                                </tr>--}}

                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-end justify-content-end mt-4">
                            {{$products->withQueryString()->links('layouts.custom.paginator')}}
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
            <!-- ============================================================== -->
            <!-- end data table  -->
            <!-- ============================================================== -->
        </div>
    </div>

@endsection

@section('custom_js')
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
                        document.location = '{{route('screens.admin.product.all',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    }, 200)
                });
            });
            limit.addEventListener('change', (e) => {
                setTimeout(() => {
                    document.location = '{{route('screens.admin.product.all',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                        '&field=' + '{{$field}}' + '&limit=' + e.target.value
                }, 200)
            })
        });

    </script>
@endsection
