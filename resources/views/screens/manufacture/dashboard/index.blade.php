@extends('layouts.manufacture.main')
@section('page_title','Tổng quan')

@section('custom_css')
    <style>
        .header {
            display: none !important;
        }
        .modal:nth-of-type(even) {
            z-index: 1052 !important;
        }
        .modal-backdrop.show:nth-of-type(even) {
            z-index: 1051 !important;
        }

    </style>
@endsection

@section('modal')
    <div class="modal fade" id="modalDetail">
        <div class="modal-dialog modal-lg" role="document">
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
                    <button class="btn btn-success add-product-warehouse" href="#myModal2"  data-toggle="modal" >Thêm sản phẩm vào kho</button>
                    <div class="btnDestroy"></div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div
        class="modal fade"
        id="exampleModalCenter">
        <form method="post" action="{{route('screens.manufacture.warehouse.addProduct')}}">
            @csrf
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelv2" style="font-size: 18px;">Thêm sản phẩm vào
                            kho</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body md-content">

                        <div class="row">
                            <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chọn sản phẩm <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" id="product_id" name="product_id">
                                        <option value="" selected disabled>Lựa chọn sản phẩm thêm vào kho</option>
                                        {{-- @foreach($products as $product)
                                            <option
                                                value="{{$product->id}}" {{old('product_id') == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('product_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chọn kho liên kết <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" id="ware_id" name="ware_id">
                                        <option value="" selected disabled>Lựa chọn kho liên kết</option>
                                        @foreach($warehouses as $ware)
                                            <option
                                                value="{{$ware->id}}" {{old('ware_id') == $ware->id ? 'selected' : ''}}>{{$ware->ware_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ware_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            @csrf

                            <div class="col-xl-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Nhập số lượng <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg number only-number" id="quantity"
                                           name="quantity"
                                           value="{{old('quantity')}}" placeholder="Nhập Số lượng sản phẩm">
                                    @error('quantity')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-xl-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Loại kho <span class="text-danger">*</span></label>
                                    <div id="selectType" class="form-group row">
                                        <p class="text-danger ml-4">Chọn kho để hiện thị thông tin loại kho</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button id="btnAddPro" type="submit" class="btn btn-success">Gửi yêu cầu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
                            <li class="breadcrumb-item active" aria-current="page">Nhà cung cấp</li>
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
                                <th style="white-space: pre-wrap;width: 100px !important;min-width: 120px;">Chiết khấu cho V-Store (%)</th>
                                <th>Ngày xét duyệt</th>
                                <th>Số lượng đã bán</th>
                                <th style="white-space: pre-wrap;width: 100px !important;min-width: 10px;">Số lượng trong kho</th>
                                <th>Chức năng</th>
                            </thead>
                            <tbody>
                                @if(count($data) > 0)
                                    @foreach($data as $product)
                                        <tr>
                                            <td>{{$product->publish_id}}</td>
                                            <td style="white-space: pre-wrap">{{$product->name}}</td>
                                            <td >{{$product->cate_name}}</td>
                                            <td>{{number_format($product->price,0,'.','.')}} đ</td>
                                            <td>{{$product->vstore_name && $product->status == 2 ? $product->vstore_name : 'Sản phẩm chưa niêm yết'}}</td>
                                            <td>{{$product->discount != null ? $product->discount : 'Chưa niêm yết'}}</td>
                                            <td>{{\Illuminate\Support\Carbon::parse($product->admin_confirm_date)->format('d/m/Y H:i')}}</td>
                                            <td>{{number_format($product->amount_product_sold,0,'.','.')}}</td>
                                            <td>{{number_format($product->amount,0,'.','.')}}</td>
                                            <td style="min-width: 70px">
                                                <button type="button" class="btn btn-link pl-0"
                                                        onclick="showDetail({{$product->id}},'{{$product->name}}')">Chi tiết
                                                </button>
                                            </td>
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
                                        <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 hàng / trang</option>
                                        <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 hàng / trang</option>
                                        <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 hàng / trang</option>
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
        let limit = document.getElementById('limit');
        let product = {};
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.dashboard.index',[])}}?limit=' + e.target.value
            }, 200)
        })
        async function showDetail(id,name) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.product.detail')}}?product_id=` + id + '&product=true',
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Xem chi tiết sản phẩm thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = ``;
                product.id = id;
                product.name = name;
                if (data.data) {
                    htmlData = data.data;
                    $('#modalDetail .md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                    if (data.availability_status == 1) {
                        document.querySelector('.btnDestroy').innerHTML =
                            `<button class="btn btn-danger">Hủy niêm yết</button>`;
                        $(".btnDelete").html('');
                    } else {
                        document.querySelector('.btnDestroy').innerHTML = ``;
                        $(".btnDelete").html(`<a class="btn btn-warning btnEdit mx-2" href="{{route('screens.manufacture.product.edit')}}/${data.id}">Sửa sản phẩm</a><a href="{{route('screens.manufacture.product.destroy')}}/${data.id}"  class="btn btn-danger">Xóa sản phẩm</a>`);
                    }
                } else {
                    $('#modalDetail').modal('show');
                    $('#modalDetail .md-content').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })


        }
        $('.add-product-warehouse').click(function (e) {
            e.preventDefault();
            $('#modalDetail').modal('hide');
            $('#exampleModalCenter').modal('show');
            $('#product_id').html('');
            $('#product_id').append($('<option>', {
                value: product.id,
                text: product.name,
            }));
        });

        document.querySelector('#ware_id').addEventListener('change', async (e) => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.warehouse.getTypeWarehouse')}}`,
                dataType: "json",
                data: {"id": e.target.value, "product_id": $('#product_id').val()},
                encode: true,
                error: function (jqXHR, error, errorThrown) {

                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Liên kết kho không thành công',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                const html = data.ware_type.map((item, index) => {
                    let name = '';
                    if (item.type === 1) {
                        name = 'Kho thường';
                    } else if (item.type === 2) {
                        name = 'Kho lạnh';
                    } else {
                        name = 'Kho bãi';
                    }
                    let checked = '';
                    if (data.product_ware == 0 && index == 0) {
                        checked = 'checked';
                    } else if (data.product_ware == 0 && index != 0) {
                        checked = '';
                    } else if (item.type == data.product_ware) {
                        checked = 'checked';
                    } else {
                        checked = 'disabled';
                    }
                    console.log(checked);
                    return `
                        <div class="col-4">
                        <label class="custom-control custom-radio custom-control-inline" id="type${index}" style="margin: 0;">
                                                                                    <input type="radio" name="type" value="${item.type}" ${checked}   id="type${index}" class="custom-control-input"><span class="custom-control-label">${name}</span>
                                                                                </label>
                        </div>`;
                }).join("");
                $('#selectType').html(html);
            })
        });
        $('#quantity').on('keyup', (e) => {
                if (!e.target.value) {
                    $('#btnAddPro').attr('disabled', 'true')
                } else {
                    $('#btnAddPro').removeAttr('disabled')

                }
            }
        );
    </script>
@endsection
