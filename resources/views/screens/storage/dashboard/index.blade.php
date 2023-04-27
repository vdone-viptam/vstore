@extends('layouts.storage.main')
@section('page_title','Tổng quan')


@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Trang chủ</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Trang
                                    chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tổng quan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn thực hiện thao tác này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-accept">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('dash')
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <a href="{{route('screens.storage.product.requestOut')}}" class="item-dash">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Đơn hàng chưa xác nhận</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{$requestEx ?? 0}}</h1>
                    </div>

                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <a href="{{route('screens.storage.product.request')}}" class="item-dash">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Yêu cầu nhập kho</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{$requestIm ?? 0}}</h1>
                    </div>

                </div>
            </div>
        </a>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
        <a href="{{route('screens.storage.product.index')}}" class="item-dash">
            <div class="card border-3 border-top border-top-primary">
                <div class="card-body">
                    <h5 class="text-muted">Số mặt hàng sắp hết</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">{{$productOutStock}}</h1>
                    </div>

                </div>
            </div>
        </a>
    </div>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            <h5 class="card-header" style="font-size: 18px;">Đơn hàng mới/Yêu cầu nhập kho chưa xác nhận
            </h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="partner-datatables" class="table table-striped table-bordered second" style="width:100%">
                        <thead class="bg-light">
                        <tr>
                            <th>Mã đơn hàng/Mã yêu cầu</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'product_name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="product_name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="product_name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="product_name"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Nhà cung cấp
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'ncc_name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="ncc_name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="ncc_name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="ncc_name"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Số lượng
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
                            <th>Chiết khấu</th>
                            <th>Thời gian
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="created_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Phân loại
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'type')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="type"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="type"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="type"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Xác nhận/từ chối</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($products) > 0)
                        @foreach($products as $product)
                            <tr>
                                <td> {{$product->code}}</td>
                                <td>{{$product->publish_id}}</td>
                                <td title="{{$product->product_name}}">{{\Illuminate\Support\Str::limit($product->product_name,50,'...')}}</td>
                                <td>{{$product->ncc_name}}</td>
                                <td class="text-center">{{$product->quantity}}</td>
                                <td class="text-center">0</td>
                                <td class="text-center">{{\Illuminate\Support\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}</td>
                                <td>
                                    @if($product->type == 1)
                                        <span class="text-success">Đơn hàng mới</span>
                                    @else
                                        <span style="color:#005d1d;">Đơn hàng mới</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->type == 1)
                                        <div style="display:flex; justify-content:center; gap:10px"><a
                                                href="javascript:void(0)" onclick="upDateStatus({{$product->id}},5,1)"
                                                style="text-decoration:underline"
                                                class="text-primary  text-white font-medium  rounded">
                                                Đồng ý
                                            </a>
                                            <a href="javascript:void(0)" onclick="upDateStatus({{$product->id}},10,1)"
                                               style="text-decoration:underline"
                                               class="text-danger  text-white font-medium  rounded">
                                                Từ chối
                                            </a></div>
                                    @else
                                        <div style="display:flex; justify-content:center; gap:10px"><a
                                                href="javascript:void(0)"
                                                onclick="upDateStatus('{{$product->code}}',1,7)"
                                                style="text-decoration:underline"
                                                class="text-primary  text-white font-medium  rounded">
                                                Đồng ý
                                            </a>
                                            <a href="javascript:void(0)"
                                               onclick="upDateStatus('{{$product->code}}',3,7)"
                                               style="text-decoration:underline"
                                               class="text-danger  text-white font-medium  rounded">
                                                Từ chối
                                            </a></div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>

                </div>
                <div id="example_paginate">
                    <ul class="pagination d-flex justify-content-end align-items-center"
                        style="gap:8px ;margin-top:10px;margin-right: 10px;">

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>

        $('.btn-accept').on('click', async function () {
            const btn = document.querySelector('.btn-accept');

            const status = btn.dataset.status;
                const id = btn.dataset.key;
                const type = btn.dataset.type;
                if (type == 1) {
                    await $.ajax({
                        type: "PUT",
                        url: `{{route('screens.storage.product.updateRequest')}}/${status}?_token={{csrf_token()}}`,
                        data: {
                            id: id
                        },

                        error: function (jqXHR, error, errorThrown) {
                            $('#requestModal').modal('hide')
                            var error0 = JSON.parse(jqXHR.responseText)
                            Swal.fire({
                                icon: 'error',
                                title: 'Cập nhật yêu cầu không thành công !',
                                text: error0.message,
                            })
                        }
                    }).done(function (data) {
                        Swal.fire(
                            data.message,
                            'Click vào nút bên dưới để đóng',
                            'success'
                        ).then(() => location.reload())

                    })
                } else {
                    await $.ajax({
                        type: "PUT",
                        url: `{{route('screens.storage.product.updateRequestOut')}}/${status}?_token={{csrf_token()}}`,
                        data: {
                            id: id
                        },

                        error: function (jqXHR, error, errorThrown) {
                            $('#requestModal').modal('hide')
                            var error0 = JSON.parse(jqXHR.responseText)
                            Swal.fire({
                                icon: 'error',
                                title: 'Xác nhận đơn hàng không thành công !',
                                text: error0.message,
                            })
                        }
                    }).done(function (data) {
                        Swal.fire(
                            data.message,
                            'Click vào nút bên dưới để đóng',
                            'success'
                        ).then(() => location.reload())


                    })
                }


            }
        )


        function upDateStatus(id, status, type) {
            const btn = document.querySelector('.btn-accept');

            btn.setAttribute('data-key', id);
            btn.setAttribute('data-status', status);
            btn.setAttribute('data-type', type);
            $('#requestModal').modal('show')
        }

        $(document).ready(function () {


            document.addEventListener('keypress', event => {
                if (interval) {
                    clearInterval(interval);
                }
                if (event.code == 'Enter') {
                    if (barcode) {
                        call(barcode);
                    }
                    barcode = '';
                    return;
                }
                if (event.code != 'Shift') {
                    barcode += event.key;
                }
                interval = setInterval(() => barcode = '', 20);
            });

            function call(code) {
                $('#search').val(code);
            }

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
                        document.location = '{{route('screens.storage.dashboard.index')}}?type=' + orderBy +
                            '&field=' + sort
                    }, 200);
                });
            });
        });

    </script>

@endsection
