@extends('layouts.manufacture.main')

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
@endsection
@section('page_title','Quản lý kho hàng')


@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Quản lý kho hàng</h2>

            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý kho hàng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><a
                                href="{{route('screens.manufacture.warehouse.index')}}">Danh sách kho hàng</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row w-100">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                    <h5 class="mb-0" style="font-size:18px;">Danh sách kho giao nhận</h5>
                    <form method="POST">
                        <ul class="navbar-nav flex-row align-items-center " style="gap: 10px;">
                            <li class="nav-item">
                                <div id="custom-search" class="top-search-bar">
                                    <input name="account_code" class="form-control" type="search" placeholder="Nhập ID Kho">
                                </div>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-primary">Thêm kho</button>
                            </li>
                        </ul>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                            <tr>
                                <th>Tên kho hàng</th>
                                <th>Số điện thoại</th>
                                <th class="th th_product_name">Địa chỉ

                                </th>
                                <th class="th th_ncc_name">Tổng số mặt hàng
                                    <span style="float: right;cursor: pointer">
                                <a href="#">
                                <i id="sort-mh" class="fas fa-sort sort" data-sort="products.name"></i>
                                </a>


                                                                    </span>
                                </th>
                                <th class="th th_quantity">Sản phẩm có trong kho
                                    <span style="float: right;cursor: pointer">
                                                                            <i class="fas fa-sort sort"
                                                                               data-sort="products.name"></i>
                                                                    </span>
                                </th>

                                <th class="th th_status">Thao tác

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($warehouses as $val)
                                <tr>
                                    <td>{{$val->ware_name}}</td>
                                    <td>{{$val->phone_number}}</td>
                                    <td>{{$val->address}}</td>
                                    <td>{{$val->amount}}</td>
                                    <td>{{$val->amount_product}}</td>
                                    <td>
                                        <button type="button" class="btn btn-link"
                                                onclick="showDetail({{$val->id}})">Chi tiết
                                        </button>

                                    </td>
                                </tr>
                            @endforeach

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
@endsection

@section('custom_js')
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.warehouse.detail')}}`,
                dataType: "json",
                data: {"id": id},
                encode: true,
                error: function (jqXHR, error, errorThrown) {

                    // console.log(jqXHR.responseText);
                    $('#requestModal').modal('hide')
                    Swal.fire({
                        icon: 'error',
                        title: 'Xem chi tiết sản phẩm thất bại !',
                    })
                }
            }).done(function (data) {
                console.log(data)
                var htmlData = ``;

                if (data.data) {
                    htmlData += `<div class="modal-content">

    <div class="card-body">
        <div class="table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped table-bordered first dataTable" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 186.844px;">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 304.078px;">Position</th>

                            </tr>
                            </thead>
                            <tbody>`

                    $.each(data.data, function (key, value) {

                            htmlData += `
<tr role="row" class="odd">
                                <td class="sorting_1">${value.name}</td>
                                <td>${value.amount_product}</td>

                            </tr>

`

                        }
                    )


                    htmlData += `</tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
   `;
                    ;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
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
    <script>
        $('.sort').click(function (){
           var a= $(this).data("sort");
           alert(a);
        });
    </script>
@endsection



