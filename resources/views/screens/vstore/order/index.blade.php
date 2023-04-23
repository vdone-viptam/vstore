@extends('layouts.vstore.main')

@section('modal')
    <div id="modal5"></div>
@endsection

@section('page_title','Tất cả đơn hàng')
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Đơn hàng</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('screens.vstore.product.request')}}"
                                                           class="breadcrumb-link">Đơn hàng</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tất cả đơn hàng
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
                <h5 class="mb-0" style="font-size:18px;">Tất cả đơn hàng</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <input type="search" name="key_search" value="{{$key_search}}"
                                   class="form-control"
                                   placeholder="Nhập từ khóa tìm kiếm">

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
                            <th>Mã đơn hàng</th>
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
                            <th>Giá sản phẩm
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
                            </th>
                            <th>Số lượng
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'order_item.quantity')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="order_item.quantity"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="order_item.quantity"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="order_item.quantity"></i>
                                    @endif
                             </span>
                            </th>
                            <th style="min-width: 250px">Giá trị đơn hàng
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'total')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="total"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="total"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="total"></i>
                                    @endif
                                </span>
                            </th>
                            <th style="min-width: 250px">Thời gian đặt hàng
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'order.created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="order.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="order.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="order.created_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Thời gian hoàn thành
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'order.estimated_date')
                                        @if($type == 'order.estimated_date')
                                            <i class="fa-solid fa-sort-down sort" data-sort="order.estimated_date"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="order.estimated_date"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="order.estimated_date"></i>
                                    @endif
                                </span>
                            </th>
                            <th colspan="2" style="min-width: 250px">Chiết khấu nhận được
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'money')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="money"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="money"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="money"></i>
                                    @endif
                             </span>
                            </th>

                            <th>
                                Chi tiết
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders) > 0)
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->no}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->cate_name}}</td>
                                    <td>{{number_format($order->price,'0','.','.')}}</td>
                                    <td>{{number_format($order->quantity,0,'.','.')}}</td>
                                    <td>{{number_format($order->total,'0','.','.')}}</td>
                                    <td> {{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i')}}</td>
                                    <td>
                                        @if($order->export_status == 4 && \Carbon\Carbon::parse($order->estimated_date)->diffInDays(\Carbon\Carbon::now()) >= 7)
                                            {{\Carbon\Carbon::parse($order->estimated_date)->format('d/m/Y H:i')}}
                                        @else
                                            Đơn hàng chưa hoàn thành
                                        @endif
                                    </td>
                                    <td>
                                        {{$order->discount.' %'}}
                                    </td>
                                    <td>
                                        {{number_format($order->discount * $order->total,0,'.','.')}} đ
                                    </td>
                                    <td><a href="" class="btn btn-link">Chi tiết</a></td>
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
                    {{$orders->withQueryString()->links()}}
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
                        document.location = '{{route('screens.vstore.order.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.vstore.order.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
