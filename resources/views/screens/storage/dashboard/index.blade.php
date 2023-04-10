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
            <h5 class="card-header" style="font-size: 18px;">Những sản phẩm và đơn hàng gần đây
            </h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="partner-datatables" class="table table-striped table-bordered second" style="width:100%">
                        <thead class="bg-light">
                        <tr class="border-0">
                            <th class="border-0">Mã đơn hàng/Mã yêu cầu</th>
                            <th class="border-0">Mã sản phẩm</th>
                            <th class="border-0">Tên sản phẩm</th>
                            <th class="border-0">Nhà cung cấp</th>
                            <th class="border-0">Số lượng</th>
                            <th class="border-0">Chiết khấu</th>
                            <th class="border-0">Thời gian</th>
                            <th class="border-0">Phân loại</th>
                            <th class="border-0">Xác nhận/từ chối</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td> {{$product->code}}</td>
                                <td>{{$product->publish_id}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->ncc_name}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>0</td>
                                <td>{{\Illuminate\Support\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}</td>
                                <td>
                                    @if($product->type == 1)
                                        <span class="text-success">Yêu cầu nhập</span>
                                    @else
                                        <span style="color:#005d1d;">Xác nhận đơn hàng</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->type == 1)
                                        <a href="#" onclick="upDateStatus({{$product->id}},5,1)"
                                           class="btn btn-primary">Đồng ý</a>
                                        <a href="#" onclick="upDateStatus({{$product->id}},10,1)" class="btn btn-danger">Từ
                                            chối</a>
                                    @else
                                        <a href="#" onclick="upDateStatus('{{$product->code}}',1,7)"
                                           class="btn btn-primary">Đồng ý</a>
                                        <a href="#" onclick="upDateStatus('{{$product->code}}',3,7)"
                                           class="btn btn-danger">Từ
                                            chối</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

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
                const status = $('.btn-accept').data('status');
                const id = $('.btn-accept').data('key');
                const type = $('.btn-accept').data('type');
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
            $('.btn-accept').data('key', id);
            $('.btn-accept').data('status', status);
            $('.btn-accept').data('type', type);
            $('#requestModal').modal('show')
        }
    </script>

@endsection
