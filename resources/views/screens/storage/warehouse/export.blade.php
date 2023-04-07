@extends('layouts.storage.main')

@section('modal')
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn thực hiện thao tác này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-accept">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
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
                <h2 class="pageheader-title">Xuất hàng</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý
                                    kho</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Xuất hàng</li>
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
                <h5 class="mb-0" style="font-size:18px;">Xuất hàng</h5>
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
                            <th>Mã xuất hàng</th>
                            <th>Mã sản phẩm</th>
                            <th>Mã vận chuyển</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Ngày xuất hàng</th>
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
        function showDetail(id) {
            var formData = {
                id: id,
            }
            $.ajax({
                type: "GET",
                url: `{{route('screens.storage.warehouse.detailRequest')}}?id=` + id,
                dataType: "json",
            }).done(function (data) {
                var htmlData = ``;
                if (data.data) {
                    htmlData += `<form method="post" key=${id}>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                            <label for="name">Mã xuất hàng:</label>
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
                                <div class="form-group">
                            <label for="product_name">Tên sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" id="product_name" value="${data.data.product_name}" readonly>


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
                            ${data.data.status == 1 ? ` <select class="custom-select" id="inputGroupSelect01" disabled>
                                <option selected >Đã xuất hàng</option>
                            </select>` : ` <select class="custom-select" id="inputGroupSelect01" disabled>
                                <option  value="1"  selected>Đồng ý</option>
                            </select>`}

                        </div>
                   </form>     `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                    if (data.data.status == 1) {
                        $('.btn-update').addClass('hidden');
                    } else {
                        $('.btn-update').removeClass('hidden');
                    }

                    $('.btn-update').on('click', function () {
                        $('#requestModalmore').modal('show');
                        $('#modalDetail').modal('hide');
                        $(this).data('key', id);
                    })

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
