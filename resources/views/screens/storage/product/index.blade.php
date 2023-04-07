@extends('layouts.storage.main')



@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tất cả sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Hàng hóa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
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
                    <h5 class="mb-0" style="font-size:18px;">Tất cả sản phẩm</h5>
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
                                <th>Mã sản phẩm</th>
                                <th>Mã SKU</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Nhà cung cấp</th>
                                <th>Tồn kho</th>
                                <th>Số lượng chờ xuất</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($products) > 0)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->publish_id}}</td>
                                        <td>{{$product->sku_id}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->cate_name}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->in_stock ?? 0}}</td>
                                        <td>{{$product->pause_product}}</td>
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
