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
                    <button type="button" class="btn btn-primary btn-update" data-dismiss="modal">Cập nhập</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Quản lý yêu cầu nhập kho</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Hàng hóa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu nhập
                                kho
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
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                 style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Quản lý yêu cầu nhập kho</h5>
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
                            <th>Mã yêu cầu</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Nhà cung cấp</th>
                            <th>Số lượng nhập</th>
                            <th>Chiết khấu</th>
                            <th>Ngày yêu cầu</th>
                            <th>Xác nhận / từ chối</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $product)
                                <tr>
                                    <td>{{$product->code}}</td>
                                    <td>{{$product->publish_id}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->ncc_name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>0</td>
                                    <td>{{\Illuminate\Support\Carbon::parse($product->created_at)}}</td>
                                    <td>
                                        <a href="" class="btn btn-primary">Đồng ý</a>
                                        <a href="" class="btn btn-danger">Từ chối</a>
                                    </td>
                                    <td><a href="#" class="btn btn-link" onclick="showDetail({{$product->id}})">Chi
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
                url: `{{route('screens.storage.product.detailRequest')}}?id=` + id,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                var htmlData = ``;
                if (data.data) {
                    htmlData += ` <form method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                            <label for="name">Mã yêu cầu:</label>
                            <input type="text" class="form-control form-control-lg" id="code" value="${data.data.code}" readonly>
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
                            <input type="text" class="form-control form-control-lg" id="product_name" value="${data.data.product_name}" readonly >
                        </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                            <label for="ncc_name">Nhà cung cấp:</label>
                            <input type="text" class="form-control form-control-lg" id="ncc_name" value="${data.data.ncc_name}" readonly>
                        </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="quantity">Số lượng nhập:</label>
                            <input type="text" class="form-control form-control-lg" id="quantity" value="${data.data.quantity}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_vdone">Chiết khấu: </label>
                            <input type="text" class="form-control form-control-lg" id="id_vdone" value="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="created_at">Ngày yêu cầu: </label>
                            <input type="text" class="form-control form-control-lg" id="created_at" value="${convertDate(data.data.created_at)}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_vdone">Trạng thái</label>

                            ${data.data.status != 0 ? ` <select class="custom-select" id="inputGroupSelect01" disabled>
                                <option selected > ${data.data.status == 5 || data.data.status == 1 ? `Đồng ý` : `Từ chối`}</option>
                            </select>` : ` <select class="custom-select" id="inputGroupSelect01">
                                <option  value="5">Đồng ý</option>
                                <option  value="2">Từ chối</option>
                            </select>`}

                        </div>
                   </form>     `;

                    if (data.data.status != 0) {
                        $('.btn-update').addClass('hidden');
                    } else {
                        $('.btn-update').removeClass('hidden');
                    }

                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                    $('.btn-update').data('key', id);


                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })
        }
    </script>

@endsection
