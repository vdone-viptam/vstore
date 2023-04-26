@extends('layouts.vstore.main')
@section('page_title','Tổng quan')

@section('content')
    <div class="container-fluid dashboard-content pt-0">
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
                            <h5 class="text-muted">Doanh thu trong ngày</h5>
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
                            <h5 class="text-muted">Đơn hàng trong ngày</h5>
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
                            <h5 class="text-muted">Đơn hàng giao thành công trong ngày</h5>
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
                            <a href="{{route('screens.vstore.product.request')}}" class="">Sản phẩm chờ duyệt</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second"
                                   style="width:100%">
                                <thead>
                                <th class="white-space-120">Mã yêu cầu</th>
                                <th class="white-space-150">Nhà cung cấp</th>
                                <th class="white-space-300">Tên sản phẩm</th>
                                <th>Ngành hàng</th>
                                <th class="white-space-150">Giá sản phẩm (đ) chưa VAT</th>
                                <th class="white-space-150">Chiết khấu từ Nhà cung cấp (%)</th>
                                <th>Ngày yêu cầu</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                                </thead>
                                <tbody>
                                @if(count($data) > 0)
                                    @foreach($data as $product)
                                        <tr>
                                            <td class="white-space-120">
                                                {{$product->code}}
                                            </td>
                                            <td class="white-space-150">
                                                {{$product->user_name}}
                                            </td>
                                            <td class="white-space-300">
                                                {{$product->name}}
                                            </td>
                                            <td class="white-space-150">{{$product->cate_name}}</td>
                                            <td class="white-space-150 text-right">
                                                {{number_format($product->price,0,'.','.')}}
                                            </td>
                                            <td class="text-right">
                                                {{$product->discount}}
                                            </td>

                                            <td>{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}</td>
                                            <td><span class="text-warning">Yêu cầu mới</span></td>

                                            <td>
                                                <a href="#" onclick="appect({{$product->id}},{{$product->discount}},1)"
                                                   class="btn btn-success">Đồng ý</a>
                                                <a href="#"
                                                   onclick="unAppect({{$product->id}},{{$product->discount}},2)"
                                                   class="btn btn-danger">Từ chối</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">Không có dữ liệu phù hợp</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end data table  -->
            <!-- ============================================================== -->
        </div>

    </div>

    @section('modal')
        <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <form action="" method="POST" id="form">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi
                                tiết</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @csrf
                        <div class="modal-body md-content">

                        </div>
                        <div class="modal-footer">
                            <button id="btnConfirm" class="btn btn-success">Cập nhật yêu cầu</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endsection

@endsection

@section('custom_js')

    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{\Illuminate\Support\Facades\Session::get('success')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{\Illuminate\Support\Facades\Session::get('error')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    <script>

        document.getElementById('btnConfirm').style.display = 'none';

        function appect(id, discount, status) {
            $('.md-content').html(`
        <div class="form-group">
            <label>Chiết khấu được từ nhà cung cấp</label>
        <input class="form-control number" data-discount="${discount}" name="discount" id="discount" disabled value="${discount} %">
            </div>
            <div class="form-group">
            <label>Chiết khấu cho V-Shop</label>
        <input class="form-control number-percent" name="discount_vShop" id="discount_vShop">
        <p id="messageDis" style="display: none" class="text-danger mt-2 ms-1">Chiết khấu cho V-Shop không được nhỏ hơn ${discount / 2} và lớn hơn ${discount}</p>
        </div>
    `);
            document.querySelector('#form').setAttribute('action', '{{route('screens.vstore.product.confirm')}}/' + id + '?status=' + status)

            document.getElementsByName('discount_vShop')[0].addEventListener('keyup', (e) => {
                if (+e.target.value < Number(document.getElementById('discount').dataset.discount) && +e.target.value >= Number(document.getElementById('discount').dataset.discount) / 2) {
                    document.getElementById('messageDis').style.display = 'none';
                    document.getElementById('btnConfirm').style.display = 'block';

                } else {
                    document.getElementById('messageDis').style.display = 'block';
                    document.getElementById('btnConfirm').style.display = 'none';
                }

            })
            document.getElementsByName('discount_vShop')[0].addEventListener("keypress", (e) => {
                var regex = new RegExp("^[0-9.]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#modalDetail').modal('show');

        }

        function unAppect(id, discount, status) {
            $('.md-content').html(`
            <div class="form-group">
                <label for="name">Lý do từ chối</label>
            <textarea name="note" placeholder="Lý do từ chối"
                        class="form-control" ></textarea>
            </div>
        `);
            document.querySelector('#form').setAttribute('action', '{{route('screens.vstore.product.confirm')}}/' + id + '?status=' + status)
            $('#modalDetail').modal('show');
            document.getElementById('btnConfirm').style.display = 'block';
        }
    </script>
@endsection
