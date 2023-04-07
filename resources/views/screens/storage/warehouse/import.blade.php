@extends('layouts.storage.main')



@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Nhập hàng</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý
                                    kho</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nhập hàng</li>
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
                <h5 class="mb-0" style="font-size:18px;">Nhập hàng</h5>
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
                            <th>Mã nhập kho</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Nhà cung cấp</th>
                            <th>Số lượng</th>
                            <th>Ngày nhập hàng</th>
                            <th>Thao tác/Trạng thái</th>
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
                                    <td>{{$request->ncc_name}}</td>
                                    <td>{{$request->quantity}}</td>
                                    <td>{{\Carbon\Carbon::parse($request->created_at)->format('d/m/Y H:i')}}</td>
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