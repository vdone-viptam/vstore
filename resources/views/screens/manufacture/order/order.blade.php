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


@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Quản lý đơn hàng</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
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
                            <th>Mã đơn hàng
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
                            <th>Giảm giá (nếu có)</th>
                            <th>
                                Số lượng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'request_warehouses.quantity')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="request_warehouses.quantity"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="request_warehouses.quantity"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="request_warehouses.quantity"></i>
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
                        @if(count($orders) > 0)
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->no}}</td>
                                    <td>{{$order->product->name}}</td>
                                    <td>{{number_format($order->product->price,0,'.','.')}} đ</td>
                                    <td>{{(int)$order->discount}} %</td>
                                    <td>{{number_format($order->quantity,0,'.','.')}}</td>
                                    <td>{{number_format(($order->total - ($order->total * $order->discount / 100)) * ($order->deposit_money / 100) ,0,'.','.')}}
                                        đ
                                    </td>
                                    <td>{{number_format($order->total - ($order->total * $order->discount / 100),0,'.','.')}} đ</td>
                                    <td>
                                        @if($order->status == 1)
                                            <span class="text-green-600"> Đã hoàn thành</span>
                                        @elseif($order->status == 3)
                                            <span class="text-blue-600">Đơn hàng mới</span>
                                        @elseif($order->status == 4)
                                            <span class="text-yellow-400">Đang giao hàng</span>
                                        @else
                                            <span class="text-red-600">Hủy</span>
                                        @endif
                                    </td>
                                    <td>{{\Illuminate\Support\Carbon::parse($order->created_at)->format('d/m/Y H:i')}}</td>
                                    <td>
                                        <a href="#" data-id="{{$order->id}}" class="text-blue-600 more-details">Chi
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
                    {{$orders->withQueryString()->links()}}
                </div>


            </div>

        </div>
    </div>
    <p id="hdisi"></p>
@endsection


@section('custom_js')
    <script>
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
                        document.location = '{{route('screens.manufacture.order.order',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });

            document.querySelectorAll('.more-details').forEach(item => {
                item.addEventListener('click', (e) => {
                    $.ajax({
                        url: '{{route('screens.manufacture.order.detail')}}/' + item.dataset.id + '&_token={{csrf_token()}}',
                        success: function (result) {
                            $('#modal2').html('');
                            $('#modal2').append(result);
                            $('.modal-details').toggleClass('show-modal')
                        },
                    });
                })
            })
            async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.product.detail')}}?product_id=` + id + '&product=true',
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Xem chi tiết sản phẩm thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = ``;

                if (data.data) {
                    htmlData += `
                    <form method="post" key=${id}>
                                <div class="form-group">
                            <label for="name">Mã sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" disabled id="code" value="${data.data.publish_id}" readonly>
                        </div>


                                <div class="form-group">
                            <label for="publish_id">Tên sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" disabled id="publish_id" value="${data.data.name}" readonly>

                            </div>

                                <div class="form-group">
                            <label for="product_name">Giá bán:</label>
                            <input type="text" class="form-control form-control-lg" disabled id="product_name" value="${data.data.price}" readonly>
                            </div>
                     <div class="row">
                        <div class="form-group col-6">
                            <label for="quantity">VAT: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="quantity" value="${data.data.vat}" readonly>
                        </div>

                        <div class="form-group col-6">
                            <label for="quantity">Thương hiệu:</label>
                            <input type="text" class="form-control form-control-lg" disabled id="quantity" value="${data.data.brand}" readonly>
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="created_at">Ngành hàng: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="created_at" value="${data.data.cate_name}" readonly>
                        </div>
                       <div class="row">
                        <div class="form-group col-6">
                            <label for="created_at">Chiết khấu V-Store nhận được: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="created_at" value="${data.data.discount}" readonly>
                        </div>
                         <div class="form-group col-6">
                            <label for="created_at">Chiết khấu V-Shop nhận được: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="created_at" value="${data.data.disount_vShop || 0}" readonly>
                        </div>

                    </div>
                    <div class="form-group">
                            <label for="created_at">Số sản phẩm đã bán: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="created_at" value="${data.data.amount_product_sold}" readonly>
                        </div>
                   </form>

                        `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                    if (data.data.availability_status == 1) {
                        document.querySelector('.btnDestroy').innerHTML =
                            `<button class="btn btn-danger">Hủy niêm yết</button>

`;
                        $(".btnDelete").html('');
                    } else {
                        document.querySelector('.btnDestroy').innerHTML = ``;
                        $(".btnDelete").html(`<a class="btn btn-warning btnEdit mx-2" href="{{route('screens.manufacture.product.edit')}}/${data.data.id}">Sửa sản phẩm</a><button  class="btn btn-danger">Xóa sản phẩm</button>`);
                    }
                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })


        }
        });
    </script>
@endsection
