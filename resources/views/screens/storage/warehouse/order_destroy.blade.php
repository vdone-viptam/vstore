@extends('layouts.storage.main')


@section('modal')

@endsection

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Đơn hàng hủy</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý
                                    kho</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Đơn hàng hủy</li>
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
                <h5 class="mb-0" style="font-size:18px;">Đơn hàng hủy</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <input class="form-control" type="search" placeholder="Tìm kiếm..">
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Lý do hủy</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders) > 0)
                            @foreach($orders as $request)
                                <tr>
                                    <td>{{$request->no}}</td>
                                    <td>{{$request->publish_id}}</td>
                                    <td>{{$request->product_name}}</td>
                                    <td>{{$request->quantity}}</td>
                                    <td>{{$request->note}}</td>
                                    <td><a href="#" onclick="showDetail({{$request->id}},{{$request->cancel_status}})"
                                           class="btn btn-link">Chi tiết</a></td>
                                </tr>
                            @endforeach
                        @else
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        async function showDetail(id, cancel_status) {
            if (cancel_status == 1) {
                $(".btn-update").removeClass("hidden")
            } else {
                $(".btn-update").addClass("hidden")

            }
            await $.ajax({
                type: "GET",
                url: `{{route('screens.storage.warehouse.detailDestroyOrder')}}id=`,
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Token': customToken,
                    'Content-Type': 'application/json'
                },
                dataType: "json",
                encode: true,
            }).done(function (data) {
                var htmlData = ``;

                if (data.data) {
                    htmlData += `<form method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                            <label for="name">Mã đơn hàng:</label>
                            <input type="text" class="form-control form-control-lg" id="code" value="${data.data.no}" readonly>
                        </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                            <label for="publish_id">Mã sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" id="publish_id" value="${data.data.publish_id}" readonly>
                        </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                            <label for="product_name">Tên sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" id="product_name" value="${data.data.product_name}" readonly>
                        </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                            <label for="quantity">Số lượng sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" id="quantity" value="${data.data.quantity}" readonly>
                        </div>
                        </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="id_vdone">Lý do hủy: </label>
                            <textarea  class="form-control form-control-lg" readonly>${data.data.note}</textarea>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-3">
                                <label for="created_at">Nhập lại kho: </label>
                            </div>
                            <div class="col-9">
                                 ${cancel_status == 1 ? `<input type="checkbox" value="${data.data.id}" class="btn_proBack" >` : cancel_status == 3 ? `<input disabled type="checkbox" value="${data.data.id}" class="btn_proBack" >` : `<input disabled type="checkbox" value="${data.data.id}" class="btn_proBack" >`}
                            </div>
                        </div>
                        ${cancel_status == 1 ? `<p class="error_proBack text-danger"></p>` : cancel_status == 3 ? `<p class="error_proBack text-success">Đã nhập lại hàng</p>` : `<p class="error_proBack text-danger">Hàng chưa xuất kho</p>`}

                   </form>
                        `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })
        }
    </script>

@endsection
