@extends('layouts.manufacture.main')
@section('page_title','Quản lý xuất - nhập sản phẩm')



@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
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
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Quản lý xuất - nhập sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý kho hàng</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý xuất - nhập sản phẩm</li>
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
                <h5 class="mb-0" style="font-size:18px;">Quản lý xuất - nhập sản phẩm</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input name="key_search" value="{{$key_search ?? ''}}" class="form-control"
                                       type="search"
                                       placeholder="Tìm kiếm..">
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
                            <th>Tên kho hàng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'warehouses.name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="warehouses.name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="warehouses.name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="warehouses.name"></i>
                                    @endif
                                </span>
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
                            <th>Loại yêu cầu
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'type')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="request_warehouses.type"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="request_warehouses.type"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="request_warehouses.type"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Tình trạng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'request_warehouses.status')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="request_warehouses.status"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort"
                                               data-sort="request_warehouses.status"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="request_warehouses.status"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-100">Số lượng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'quantity')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="quantity"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="quantity"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="quantity"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Thòi gian
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'request_warehouses.created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="request_warehouses.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort"
                                               data-sort="request_warehouses.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="request_warehouses.created_at"></i>
                                    @endif
                                </span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->code}}</td>
                                    <td class="white-space-300">{{$product->ware_name}}</td>
                                    <td class="white-space-400">{{$product->name}}</td>
                                    <td>
                                        @if($product->type == 1)
                                            <span class="text-success">Nhập kho</span>
                                        @else
                                            <span class="text-danger">Xuất kho</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->type == 1)
                                            @if($product->status == 0)
                                                <span class="text-secondary">Đang chờ kho duyệt</span>
                                            @elseif($product->status == 1)
                                                <span class="text-success">Đã thêm vào kho</span>
                                            @else
                                                <span class="text-danger">Kho từ chối nhập</span>
                                            @endif
                                        @else
                                            @if($product->status == 0)
                                                <span class="text-secondary">Đang chờ kho duyệt</span>
                                            @elseif($product->status == 1)
                                                <span class="text-success">Đã xuất kho</span>
                                            @else
                                                <span class="text-danger">Kho từ chối xuất</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">{{number_format($product->quantity,0,'.','.')}}</td>
                                    <td class="text-center">{{\Illuminate\Support\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
                            </tr>
                        @endif
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

@endsection

@section('custom_js')
    <script>
        let limit = document.getElementById('limit');
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
                        document.location = '{{route('screens.manufacture.warehouse.swap',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.warehouse.swap',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>

@endsection
