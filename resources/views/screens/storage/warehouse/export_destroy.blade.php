@extends('layouts.storage.main')


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
    </div>
@endsection

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Xuất hủy</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý
                                    kho</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Xuất hủy</li>
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
            <div class="card-header">
                <div class=" d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                    <h5 class="mb-0" style="font-size:18px;">Xuất hủy</h5>
                    <div class="d-flex justify-content-start align-items-center" style="gap:8px">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <div id="custom-search" class="top-search-bar">
                                    <input class="form-control" type="search" placeholder="Tìm kiếm..">
                                </div>
                            </li>
                        </ul>
                        <button class="btn btn-primary btn-create">Xuất hủy</button>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>Mã xuất hủy</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Lý do hủy</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{$request->code}}</td>
                                    <td>{{$request->publish_id}}</td>
                                    <td>{{$request->product_name}}</td>
                                    <td>{{$request->quantity}}</td>
                                    <td>{{$request->note}}</td>
                                    <td><a href="#" onclick="showDetail({{$request->id}})" class="btn btn-link">Chi
                                            tiết</a></td>
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
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.storage.warehouse.detailRequest')}}?id=` + id,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                var htmlData = ``;
                if (data.data) {

                    htmlData += `   <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Mã đơn hàng: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.code}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Mã xuất hủy: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.publish_id}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Tên sản phẩm: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.product_name}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Số lượng sản phẩm: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.quantity}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Lý do hủy: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.note}</span>
                        </div>
               </div>
                        `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                }
            })


        }
    </script>

@endsection
