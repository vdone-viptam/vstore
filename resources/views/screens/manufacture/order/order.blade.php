@extends('layouts.manufacture.main')
@section('page_title','Đơn hàng nhập sẵn')

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Đơn hàng nhập sẵn</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý đơn hàng</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Đơn hàng nhập sẵn</li>
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
                        <h5 class="modal-title" style="font-size: 20px;">Thông tin đơn hàng nhập sẵn</h5>
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
                                        <label for="name">Thời gian tạo đơn:</label>
                                        <input type="text" class="form-control form-control-lg"
                                               id="created_at" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Mã sản phẩm: </label>
                                        <input type="text" class="form-control form-control-lg" id="sp" readonly>
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
                                        <label for="name">Đơn giá:</label>
                                        <input type="text" class="form-control form-control-lg" id="price" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Số lượng</label>
                                        <input type="text" class="form-control form-control-lg" id="quantity" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tổng tiền:</label>
                                        <input type="text" class="form-control form-control-lg" id="total" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Chiết khấu nhập sẵn (nếu có):</label>
                                        <input type="text" class="form-control form-control-lg" id="discount" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Giá trị trừ chiết khấu:</label>
                                        <input type="text" class="form-control form-control-lg" id="discountA" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tỷ lệ cọc(nếu có):</label>
                                        <input type="text" class="form-control form-control-lg" id="depositP" readonly>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tiền cọc(nếu có):</label>
                                        <input type="text" class="form-control form-control-lg" id="deposits" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Trạng thái:</label>
                                        <input type="text" class="form-control form-control-lg" id="status" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h2>Địa chỉ nhận hàng</h2>
                                    <p id="address"></p>
                                    <p id="nameC"></p>
                                    <p id="phone"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                            lại
                        </button>
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
                <h5 class="mb-0" style="font-size:18px;">Đơn hàng nhập sẵn</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form action="">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input class="form-control" name="key_search" value="{{$key_search ?? ''}}"
                                       type="search" placeholder="Nhập từ khóa tìm kiếm...">
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
                            <th class="white-space-120">

                            Mã đơn hàng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'pre_order_vshop.no')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="pre_order_vshop.no"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="pre_order_vshop.no"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="pre_order_vshop.no"></i>
                                    @endif
                                </span>

                            </th>
                            <th >

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
                            <th class="white-space-130 text-center">
                                Giá sản phẩm
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'price')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="price"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="price"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="price"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-110 text-center">Giảm giá
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'pre_order_vshop.discount')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="pre_order_vshop.discount"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort"
                                               data-sort="pre_order_vshop.discount"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="pre_order_vshop.discount"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-100 text-center">
                                Số lượng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'pre_order_vshop.quantity')
                                        @if($type == 'desc')
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
                            <th class="white-space-130 text-center">Tiền đặt cọc
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'deposit_money')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="deposit_money"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="deposit_money"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="deposit_money"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-120 text-center">Tổng tiền
                                <span style="float: right;cursor: pointer">
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
                            <th class="white-space-120">Trạng thái
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'pre_order_vshop.status')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="pre_order_vshop.status"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort"
                                               data-sort="pre_order_vshop.status"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="pre_order_vshop.status"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-150 text-center">Thời gian tạo đơn
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'pre_order_vshop.created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="pre_order_vshop.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort"
                                               data-sort="pre_order_vshop.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="pre_order_vshop.created_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-80"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders) > 0)
                            @foreach($orders as $order)
                                <tr>
                                    <td class="text-center white-space-140">{{$order->no}}</td>
                                    <td class="white-space-200">{{$order->product->name}}</td>
                                    <td class="text-right white-space-130">{{number_format($order->product->price,0,'.','.')}}</td>
                                    <td class="text-center white-space-100">{{(int)$order->discount}}%</td>
                                    <td class="text-center white-space-100">{{number_format($order->quantity,0,'.','.')}}</td>
                                    <td class="text-right white-space-130">{{number_format($order->deposit_money ,0,'.','.')}} đ</td>
                                    <td class="text-right white-space-140">{{number_format($order->total * (100 - $order->discount) / 100,0,'.','.')}}
                                    <td class="text-center white-space-140">
                                        @if($order->status == 1)
                                            <span class="text-success "> Đã hoàn thành</span>
                                        @elseif($order->status == 3)
                                            <span class="text-primary ">Chờ xác nhận</span>
                                        @elseif($order->status == 4)
                                            <span class="text-warning ">Đang giao hàng</span>
                                        @else
                                            <span class="text-danger ">Từ chối</span>
                                        @endif
                                    </td>
                                    <td class="text-center white-space-130">{{\Illuminate\Support\Carbon::parse($order->created_at)->format('d/m/Y H:i')}}</td>
                                    <td class="text-center white-space-80">
                                        <a href="javascript:void(0)" data-toggle="modal"
                                           data-target=".bd-example-modal-lg" data-id="{{$order->id}}"
                                           class="btn btn-link more-details p-0" style="text-decoration:underline">Chi tiết</a>
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
                <div class="d-flex align-items-center justify-content-end mt-4">
                    {{$orders->withQueryString()->links('layouts.custom.paginator')}}
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
                        document.location =
                            '{{ route('screens.manufacture.order.order', ['key_search' => $key_search]) }}&type=' +
                            orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
            limit.addEventListener('change', (e) => {
                setTimeout(() => {
                    document.location =
                        '{{ route('screens.manufacture.order.order', ['key_search' => $key_search]) }}&type=' +
                        '{{ $type }}' +
                        '&field=' + '{{ $field }}' + '&limit=' + e.target.value
                }, 200)
            })
            document.querySelectorAll('.more-details').forEach(item => {
                item.addEventListener('click', (e) => {
                    $.ajax({
                        url: '{{ route('screens.manufacture.order.detail') }}/' + item
                            .dataset.id,
                        success: function (result) {
                            if (result) {
                                $("#no").val(result.no);
                                $("#sp").val(result.product.publish_id);
                                $("#name").val(result.product.name);
                                $("#price").val(convertVND(result.product.price));
                                const deposits = (result.total - (result.total * result
                                    .discount / 100)) * (result.deposit_money / 100);
                                const total = result.total - (result.total * result
                                    .discount / 100);

                                const status = result.status == 1 ? 'Đã hoàn thành' :
                                    result.status == 3 ? 'Đơn hàng mới' : result
                                        .status == 4 ? 'Đang giao hàng' : 'Hủy';

                                $("#discount").val(parseInt(result.discount) + ' %');
                                $("#discountA").val(convertVND(result.product.price * result.quantity * (100 - result.discount) / 100));                                $("#quantity").val(Intl.NumberFormat().format(result.quantity).replaceAll(',', '.'));
                                $("#deposits").val(convertVND(deposits));
                                $("#total").val(convertVND(result.product.price * result.quantity));
                                $("#status").val(status);
                                $("#nameC").html(result.fullname);
                                $("#address").html(result.address);
                                $("#phone").html(result.phone);
                                $("#depositP").val(deposits / total * 100+' %');
                                $("#created_at").val(convertTimeVN(result.created_at));
                            }
                        },
                    });
                })
            })

            function datetimeLocal(datetime) {
                const dt = new Date(datetime);
                dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
                return dt.toISOString().slice(0, 16);
            }
        });

    </script>
@endsection
