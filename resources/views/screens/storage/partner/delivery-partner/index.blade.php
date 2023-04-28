@extends('layouts.storage.main')
@section('custom_css')
@endsection

@section('page_title','Đối tác giao hàng')

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
                    <h2 class="pageheader-title">Đối tác giao hàng</h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Đối tác</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đối tác giao hàng</li>
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
                        <h5 class="mb-0" style="font-size:18px;">Đối tác giao hàng</h5>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <div id="custom-search" class="top-search-bar">
                                    <form action="">
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <input type="hidden" name="field" value="{{$field}}">
                                        <input class="form-control" name="key_search" value="{{$key_search ?? ''}}"
                                               type="search" placeholder="Nhập từ khóa tìm kiếm...">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="delivery-partner-datatables" class="table table-striped table-bordered second"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th class="white-space-120 text-center">Mã đối tác</th>
                                    <th class="white-space-120 text-center">Tên đối tác
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'name_partner')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="name_partner"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="name_partner"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="name_partner"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th class="text-center white-space-200">Tổng đơn hàng đã giao
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'count_product')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="count_product"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="count_product"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="count_product"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th class="text-center white-space-300">Số đơn hàng không hoàn thành
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'destroy_order')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="destroy_order"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="destroy_order"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="destroy_order"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th class="white-space-100"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($deliveryPartners) > 0)
                                    @foreach($deliveryPartners as $deliveryPartners)
                                        <tr>
                                            <td class="text-center">{{$deliveryPartners->code_partner}}</td>
                                            <td class="text-center">{{$deliveryPartners->name_partner}}</td>
                                            <td class="text-center">{{$deliveryPartners->count_product}}</td>
                                            <td class="text-center">{{$deliveryPartners->destroy_order}}</td>
                                            <td class="text-center white-space-100"><a class="text-primary" href="javascript:void(0)" style="text-decoration:underline;"
                                                onclick="showDetail({{$deliveryPartners->delivery_partner_id}})">Chi
                                                    tiết</a></td>
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
                        document.location = '{{route('screens.storage.finance.revenue')}}?type=' + orderBy +
                            '&field=' + sort
                    }, 200)
                    setTimeout(() => {
                        document.location = '{{route('screens.storage.delivery.partner',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    }, 200)
                });
            });
        });

        async function showDetail(id) {

            await $.ajax({
                type: "GET",
                url: '{{ route('storage.detail.delivery.partner') }}',
                dataType: "json",
                data: {delivery_partner_id: id},
                encode: true,
            }).done(function (data) {

                var htmlData = ``;
                if (data.data) {
                    htmlData += `   <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Mã đối tác: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data[0].code_partner}</span>
                        </div>
                </div>
                <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Tên đối tác: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data[0].name_partner}</span>
                        </div>
                </div>
                <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Tổng đơn hàng đã giao: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data[0].count_product}</span>
                        </div>
                </div>

                <div class="row">
                        <div class="col-7">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Số đơn hàng không hoàn thành: </h5>
                        </div>
                        <div class="col-5">
                            <span style="color:#000">${data.data[0].destroy_order}</span>
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
