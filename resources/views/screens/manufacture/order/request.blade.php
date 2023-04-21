@extends('layouts.manufacture.main')
@section('page_title', 'Yêu cầu nhập sẵn sản phẩm')

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Yêu cầu nhập sẵn sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý đơn hàng</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Yêu cầu nhập sẵn sản phẩm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal-order">
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" id="modal-order-oder">
        <form action="" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-size: 20px;">Thông tin Yêu cầu nhập sẵn sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Mã đơn hàng: </label>
                                        <input type="text" class="form-control form-control-lg" id="no" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tên sản phẩm:</label>
                                        <input type="text" class="form-control form-control-lg" id="name" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Giá sản phẩm:</label>
                                        <input type="text" class="form-control form-control-lg" id="price" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Giảm giá (nếu có):</label>
                                        <input type="text" class="form-control form-control-lg" id="discount" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Số lượng sản phẩm</label>
                                        <input type="text" class="form-control form-control-lg" id="quantity" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tiền đặt cọc (nếu có):</label>
                                        <input type="text" class="form-control form-control-lg" id="deposits" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tổng tiền:</label>
                                        <input type="text" class="form-control form-control-lg" id="total" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Trạng thái:</label>
                                        <input type="text" class="form-control form-control-lg" id="status" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Ngày tạo đơn:</label>
                                        <input type="datetime-local" class="form-control form-control-lg" id="created_at"
                                            readonly>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary update-request" data-status="4" data-id>Đồng
                            ý</button>
                        <button type="button" class="btn btn-secondary update-request" data-status="5" data-id>Từ
                            chối</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Quản lý đơn hàng</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input name="key_search" value="{{ $key_search ?? '' }}" class="form-control"
                                    type="search" placeholder="Tìm kiếm..">
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
                                <th>Mã đơn hàng
                                    <span style="float: right;cursor: pointer">
                                        @if ($field == 'pre_order_vshop.no')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="pre_order_vshop.no"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="pre_order_vshop.no"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="pre_order_vshop.no"></i>
                                        @endif
                                    </span>
                                </th>
                                <th>Tên sản phẩm
                                    <span style="float: right;cursor: pointer">
                                        @if ($field == 'products.name')
                                            @if ($type == 'desc')
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
                                    Giá sản phẩm
                                    <span style="float: right;cursor:pointer">
                                        @if ($field == 'price')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="price"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="price"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="price"></i>
                                        @endif
                                    </span>
                                </th>
                                <th>Giảm giá (nếu có)</th>
                                <th>
                                    Số lượng
                                    <span style="float: right;cursor: pointer">
                                        @if ($field == 'pre_order_vshop.quantity')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort"
                                                    data-sort="pre_order_vshop.quantity"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort"
                                                    data-sort="pre_order_vshop.quantity"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="pre_order_vshop.quantity"></i>
                                        @endif
                                    </span>
                                </th>
                                <th>Tiền đặt cọc</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo đơn</th>
                                <th>
                                    Chức năng
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->no }}</td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>{{ number_format($order->product->price, 0, '.', '.') }} đ</td>
                                        <td>{{ (int) $order->discount }} %</td>
                                        <td>{{ number_format($order->quantity, 0, '.', '.') }}</td>
                                        <td>{{ number_format(($order->total - ($order->total * $order->discount) / 100) * ($order->deposit_money / 100), 0, '.', '.') }}
                                            đ
                                        </td>
                                        <td>{{ number_format($order->total - ($order->total * $order->discount) / 100, 0, '.', '.') }}
                                            đ</td>
                                        <td>
                                            @if ($order->status == 1)
                                                <span class="text-green-600"> Đã hoàn thành</span>
                                            @elseif($order->status == 3)
                                                <span class="text-blue-600">Đơn hàng mới</span>
                                            @elseif($order->status == 4)
                                                <span class="text-yellow-400">Đang giao hàng</span>
                                            @else
                                                <span class="text-red-600">Hủy</span>
                                            @endif
                                        </td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"
                                                data-id="{{ $order->id }}" class="text-blue-600 more-details">Chi
                                                tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" class="text-center ">Không có dữ liệu phù hợp</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{ $orders->withQueryString()->links() }}
                    <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 float-right mt-4">
                        <form>
                            <div class="form-group">
                                <select class="form-control" id="limit">
                                    <option value="10" {{ $limit == 10 ? 'selected' : '' }}>10 phần tử / trang
                                    </option>
                                    <option value="25" {{ $limit == 25 ? 'selected' : '' }}>25 phần tử / trang
                                    </option>
                                    <option value="50" {{ $limit == 50 ? 'selected' : '' }}>50 phần tử / trang
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('custom_js')
    <script>
        $(document).ready(function() {
            document.querySelectorAll('.sort').forEach(item => {
                const {
                    sort
                } = item.dataset;
                item.addEventListener('click', () => {
                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                    if (orderBy === 'asc') {
                        localStorage.setItem('orderBy', JSON.stringify('desc'));
                    } else {
                        localStorage.setItem('orderBy', JSON.stringify('asc'));
                    }
                    setTimeout(() => {
                        document.location =
                            '{{ route('screens.manufacture.order.order', ['key_search' => $key_search]) }}&type=' +
                            orderBy +
                            '&field=' + sort
                    })
                });
            });
            document.querySelectorAll('.more-details').forEach(item => {
                item.addEventListener('click', (e) => {
                    $.ajax({
                        url: '{{ route('screens.manufacture.order.detail') }}/' + item
                            .dataset.id,
                        success: function(result) {
                            if (result) {
                                $("#no").val(result.no);
                                $("#name").val(result.product.name);
                                $("#price").val(result.product.price);
                                const deposits = (result.total - (result.total * result
                                    .discount / 100)) * (result.deposit_money / 100);
                                const total = result.total - (result.total * result
                                    .discount / 100);
                                const today = (datetimeLocal(result.created_at));
                                const status = result.status == 1 ? 'Đã hoàn thành' :
                                    result.status == 3 ? 'Đơn hàng mới' : result
                                    .status == 4 ? 'Đang giao hàng' : 'Hủy';

                                $("#discount").val(parseInt(result.discount) + ' %');
                                $("#quantity").val(result.quantity);
                                $("#deposits").val(convertVND(deposits));
                                $("#total").val(convertVND(total));
                                $("#status").val(status);
                                $("#created_at").val(today);

                                $(".update-request").attr('data-id', result.id);

                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            swalNoti('center', 'error', 'Error, Please try again', '',
                                500, true, 3000);
                        }
                    });
                })
            })

            function datetimeLocal(datetime) {
                const dt = new Date(datetime);
                dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
                return dt.toISOString().slice(0, 16);
            }
            $('.update-request').click(function(e) {
                e.preventDefault();
                const status = $(this).attr('data-status')
                const id = $(this).attr('data-id')
                $.ajax({
                    type: "POST",
                    url: '{{ route('screens.manufacture.order.update') }}/' + id,
                    data: {
                        status: status,
                    },
                    success: function(result) {
                        if (result) {
                            swalNoti('center', 'success', 'Cập nhật đơn hàng thành công', '',
                                500, true, 3000);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swalNoti('center', 'error', 'Error, Please try again', '', 500, true,
                            3000);
                    }
                });
            });
        });

        let limit = document.getElementById('limit');
        console.log(limit)
        $(document).ready(function() {
            document.querySelectorAll('.sort').forEach(item => {
                const {
                    sort
                } = item.dataset;
                item.addEventListener('click', () => {
                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                    if (orderBy === 'asc') {
                        localStorage.setItem('orderBy', JSON.stringify('desc'));
                    } else {
                        localStorage.setItem('orderBy', JSON.stringify('asc'));
                    }
                    setTimeout(() => {
                        document.location =
                            '{{ route('screens.manufacture.order.request', ['key_search' => $key_search]) }}&type=' +
                            orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location =
                    '{{ route('screens.manufacture.order.request', ['key_search' => $key_search]) }}&type=' +
                    '{{ $type }}' +
                    '&field=' + '{{ $field }}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
