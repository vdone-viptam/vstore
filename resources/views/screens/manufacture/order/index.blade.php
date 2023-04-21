@extends('layouts.manufacture.main')
@section('page_title', 'Tất cả đơn hàng')
@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <div class="btnDelete">
                        <button class="btn btn-danger">Xóa sản phẩm</button>
                        <a class="btn btn-warning btnEdit" href="">Sửa sản phẩm</a>
                    </div>
                    <div class="btnDestroy"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Danh sách đơn hàng khách mua sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý đơn hàng </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
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
                <h5 class="mb-0" style="font-size:18px;">Danh sách đơn hàng </h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input name="key_search" value="{{ $key_search }}" class="form-control" type="search"
                                    placeholder="Tìm kiếm..">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table id="example" class="table table-striped table-bordered second    ">
                        <thead>
                            <tr>
                                <th>
                                    Mã đơn hàng
                                </th>
                                <th>
                                    Tên sản phẩm

                                </th>
                                <th>Tình trạng</th>
                                <th>
                                    Giá bán
                                </th>
                                <th>
                                    Số lượng
                                </th>
                                <th>Kho hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>
                                    Ngày hoàn thành
                                </th>
                                <th>
                                    Giá trị đơn hàng
                                </th>
                                <th>
                                    V-Shop bán hàng
                                </th>
                                <th>
                                    Giá trị trừ chiết khấu
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($orders) > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->no }}</td>
                                        <td>{{ $order->orderItem[0]->product->name }}</td>
                                        <td>
                                            @if ($order->export_status == 0)
                                                <span class="text-yellow-400">Chờ xác nhận</span>
                                            @elseif($order->export_status == 1)
                                                <span class="text-blue-600">Chờ giao hàng</span>
                                            @elseif($order->export_status == 2)
                                                <span class="text-blue-600">Đang giao hàng</span>
                                            @else
                                                <span class="text-green-600">Hoàn thành</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($order->orderItem[0]->price, '0', '.', '.') }} đ</td>
                                        <td>{{ $order->orderItem[0]->quantity }}</td>
                                        <td>{{ $order->orderItem[0]->warehouse->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y h:i') }}</td>
                                        <td>
                                            @if ($order->export_status == 4)
                                                {{ \Carbon\Carbon::now()->format('d/m/Y h:i') }}
                                            @else
                                                Chưa xác định
                                            @endif
                                        </td>
                                        <td>
                                            {{ number_format($order->orderItem[0]->price * $order->orderItem[0]->quantity, 0, '.', '.') }}
                                            đ
                                        </td>
                                        <td>
                                            {{ $order->orderItem[0]->vshop->name ?? 'Viptam' }}
                                        </td>
                                        <td>
                                            {{ number_format(($order->orderItem[0]->price * $order->orderItem[0]->quantity * (100 - $order->orderItem[0]->product->discount - $order->orderItem[0]->discount_vShop)) / 100, 0, '.', '.') }}
                                            đ
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11">Không có dữ liệu phù hợp</td>
                                </tr>
                            @endif



                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{ $orders->withQueryString()->links() }}

                </div>


            </div>

        </div>
    </div>
@endsection
