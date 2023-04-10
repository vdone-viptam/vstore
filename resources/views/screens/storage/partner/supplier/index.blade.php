@extends('layouts.storage.main')
@section('custom_css')

@endsection

@section('page_title','Danh sách Nhà cung cấp')

@section('content')


@section('page')
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
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Nhà cung cấp</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Đối tác</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nhà cung cấp</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                    style="gap:10px">
                    <h5 class="mb-0" style="font-size:18px;">Nhà cung cấp</h5>
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <form>
                                    <input name="key_search" value="{{$key_search ?? ''}}" class="form-control"
                                           type="search"
                                           placeholder="Tìm kiếm..">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="supplier-datatables" class="table table-striped table-bordered second"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Mã nhà cung cấp</th>
                                    <th>Tên nhà cung cấp</th>
                                    <th>Khu vực</th>
                                    <th>Số loại sản phẩm</th>
                                    <th>Số lượng tồn</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                    <tr>
                                        <td>{{$supplier->account_code}}</td>
                                        <td> {{$supplier->name}}</td>
                                        <td>{{$supplier->province_name}}</td>
                                        <td>{{$supplier->count_product}}</td>
                                        <td>{{$supplier->amount_product}}</td>
                                        <td> <a class="text-primary underline" href="#" onclick="showDetail({{$supplier->user_id}})">Chi tiết</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="example_paginate">
                        <ul class="pagination d-flex justify-content-end align-items-center"
                            style="gap:8px ;margin-top:10px;margin-right: 10px;">
                            {{$suppliers->render()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end data table  -->
        <!-- ============================================================== -->
    </div>

@endsection

@endsection
{{--
@section('js-library')

@endsection --}}

@section('custom_js')

    <script>
        /*
        $(document).ready(function () {
            $('#supplier-datatables').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: '{{ route('screens.storage.partner.index') }}',
                    type: 'GET',
                    data: function(param) {
                        param.limit = '';
                        param.search = '';
                    }
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                "oLanguage": {
                    "sLengthMenu": "Hiển thị _MENU_ đối tác",
                    "sZeroRecords": "Không tìm thấy đối tác nào",
                    "sInfo": "Hiển thị _START_ đến _END_ của _TOTAL_ đối tác",
                    "sInfoEmpty": "Hiển thị 0 to 0 of 0 danh sách",
                    "sInfoFiltered": "(Lọc từ tổng số _MAX_ đối tác)",
                    "sProcessing": "<div id='loader-datatable'></div>",
                },
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'account_code', name: 'account_code' },
                    { data: 'province_name', name: 'province_name' },
                    { data: 'count_product', name: 'count_product' },
                    { data: 'amount_product', name: 'amount_product' },
                    {
                        data: '', name: '',
                        render: function(data, type, row) {
                            console.log(row);
                            return `<a class="text-primary underline" href="#" onclick="showDetail(${row.user_id})">Chi tiết</a>`;
                        }
                    },
                ],
                "dom": '<<t>ip>',
            });
        });
        */
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: '{{ route('storage.detail.ncc') }}',
                dataType: "json",
                data: { user_id: id},
                encode: true,
            }).done(function (data) {
                var htmlData = ``;
                if (data.data) {
                    htmlData += `   <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Mã nhà cung cấp: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.account_code}</span>
                        </div>
            </div>
            <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Tên nhà cung cấp: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.name}</span>
                        </div>
            </div>
            <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Khu vực: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.province_name}</span>
                        </div>
            </div>
            <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Số loại sản phẩm: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.count_product}</span>
                        </div>
            </div>
            <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Số lượng tồn: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.amount_product}</span>
                        </div>
            </div>

                        `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })

        }

    </script>
@endsection
