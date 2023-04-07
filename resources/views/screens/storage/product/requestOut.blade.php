@extends('layouts.storage.main')



@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Xác nhận đơn hàng</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Hàng hóa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Xác nhận đơn hàng
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
                <h5 class="mb-0" style="font-size:18px;">Xác nhận đơn hàng</h5>
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
                            <th>Trạng thái thanh toán</th>
                            <th>Ngày đặt hàng</th>
                            <th>Xác nhận / Từ chối</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($order) > 0)
                            @foreach($order as $ord)
                                <tr>
                                    <td>{{$ord->no}}</td>
                                    <td>{{$ord->publish_id}}</td>
                                    <td>{{$ord->name}}</td>
                                    <td>{{$ord->quantity}}</td>
                                    <td>
                                        @if($ord->method_payment == 'COD')
                                            <span class="text-danger">Chưa thanh toán</span>
                                        @else
                                            <span class="text-success">Đã thanh toán</span>
                                        @endif
                                    </td>
                                    <td>{{\Illuminate\Support\Carbon::parse($ord->created_at)->format('d/m/Y H:i')}}</td>
                                    <td>
                                        <a href="" class="btn btn-primary">Đồng ý</a>
                                        <a href="" class="btn btn-danger">Từ chối</a>
                                    </td>
                                    <td><a href="" class="btn btn-link">Chi tiết</a></td>
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


@endsection
