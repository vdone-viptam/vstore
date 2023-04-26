@extends('layouts.manufacture.main')
@section('page_title','Tổng quan')

@section('custom_css')
    <style>
        .header {
            display: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Trang chủ </h2>

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
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="row row-dash">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <a href="#" class="item-dash">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Doanh thu trong tháng</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{number_format($dataRevenueToday,0,'.','.')}}</h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <a href="#" class="item-dash">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Số lượng sản phẩm sắp hết</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{number_format($dataOrderToday,0,'.','.')}}</h1>
                            </div>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <a href="#" class="item-dash">
                    <div class="card border-3 border-top border-top-primary">
                        <div class="card-body">
                            <h5 class="text-muted">Đơn hàng nhập sẵn mới</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{number_format($dataOrderSuccessToday,0,'.','.')}}</h1>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                         style="gap:10px">
                        <h5 class="mb-0" style="font-size:18px;">
                            <a href="#" class="">Sản phẩm đã xét duyệt
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second"
                                   style="width:100%">
                                <thead>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Ngành hàng</th>
                                <th>Giá bán</th>
                                <th>V-Store niêm yết</th>
                                <th style="white-space: pre-wrap;width: 100px !important;min-width: 120px;">Chiết khấu
                                    cho V-Store (%)
                                </th>
                                <th>Ngày xét duyệt</th>
                                <th>Số lượng đã bán</th>
                                <th>Số lượng trong kho</th>
                                </thead>
                                <tbody>
                                @if(count($data) > 0)
                                    @foreach($data as $product)
                                        <tr>
                                            <td>{{$product->publish_id}}</td>
                                            <td style="white-space: pre-wrap">{{$product->name}}</td>
                                            <td>{{$product->cate_name}}</td>
                                            <td>{{number_format($product->price,0,'.','.')}} đ</td>
                                            <td>{{$product->vstore_name && $product->status == 2 ? $product->vstore_name : 'Sản phẩm chưa niêm yết'}}</td>
                                            <td>{{$product->discount != null ? $product->discount : 'Chưa niêm yết'}}</td>
                                            <td>{{\Illuminate\Support\Carbon::parse($product->admin_confirm_date)->format('d/m/Y H:i')}}</td>
                                            <td>{{number_format($product->amount_product_sold,0,'.','.')}}</td>
                                            <td>{{number_format($product->amount,0,'.','.')}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">Không có dữ liệu phù hợp</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-end justify-content-end mt-4">
                            {{$data->withQueryString()->links()}}
                            <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 float-right mt-4">
                                <form>
                                    <div class="form-group">
                                        <select class="form-control" id="limit">
                                            <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 hàng / trang
                                            </option>
                                            <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 hàng / trang
                                            </option>
                                            <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 hàng / trang
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end data table  -->
            <!-- ============================================================== -->
        </div>

    </div>

@endsection

@section('custom_js')
    <script>
        let limit = document.getElementById('limit');

        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.dashboard.index',[])}}?limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
