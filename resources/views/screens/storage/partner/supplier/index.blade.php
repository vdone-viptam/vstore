@extends('layouts.storage.main')
@section('custom_css')

@endsection

@section('page_title','Nhà cung cấp')

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
                                    <th>Khu vực
                                        @if($field == 'province_name')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="province_name"
                                                   style="float: right;cursor: pointer"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="province_name"
                                                   style="float: right;cursor: pointer"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="province_name"
                                               style="float: right;cursor: pointer"></i>
                                        @endif
                                    </th>
                                    <th>Số loại sản phẩm
                                        @if($field == 'count_product')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="count_product"
                                                   style="float: right;cursor: pointer"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="count_product"
                                                   style="float: right;cursor: pointer"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="count_product"
                                               style="float: right;cursor: pointer"></i>
                                        @endif
                                    </th>
                                    <th>Số lượng tồn
                                        @if($field == 'amount_product')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="amount_product"
                                                   style="float: right;cursor: pointer"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="amount_product"
                                                   style="float: right;cursor: pointer"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="amount_product"
                                               style="float: right;cursor: pointer"></i>
                                        @endif
                                    </th>
                                    <th>Chi tiết</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($suppliers) > 0)
                                    @foreach($suppliers as $supplier)
                                        <tr>
                                            <td>{{$supplier->account_code}}</td>
                                            <td> {{$supplier->name}}</td>
                                            <td>{{$supplier->province_name}}</td>
                                            <td>{{$supplier->count_product}}</td>
                                            <td>{{$supplier->amount_product}}</td>
                                            <td><a class="text-primary underline" href="#"
                                                onclick="showDetail({{$supplier->user_id}})">Chi tiết</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
                                    </tr>
                                @endif
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
        $(document).ready(function () {
            document.querySelectorAll('.sort').forEach(item => {
                const {sort} = item.dataset;
                item.addEventListener('click', () => {
                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                    if (orderBy === 'asc') {
                        localStorage.setItem('orderBy', JSON.stringify('desc'));
                    } else {
                        localStorage.setItem('orderBy', JSON.stringify('asc'));
                    }
                    setTimeout(() => {
                        document.location = '{{route('screens.storage.partner.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        })


        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: '{{ route('storage.detail.ncc') }}',
                dataType: "json",
                data: {user_id: id},
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
