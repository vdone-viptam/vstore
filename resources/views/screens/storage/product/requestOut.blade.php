@extends('layouts.storage.main')

@section('page_title','Xác nhận đơn hàng')

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
                    <button type="button" class="btn btn-primary btn-update" data-dismiss="modal">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
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
@endsection

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Xác nhận đơn hàng</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Hàng hóa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Xác nhận đơn hàng
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
            <form action="">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                    <h5 class="mb-0" style="font-size:18px;">Xác nhận đơn hàng</h5>
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
            </form>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center white-space-120">Mã đơn hàng</th>
                            <th class="text-center white-space-150">Mã sản phẩm</th>
                            <th>
                            <div class="d-flex justify-content-between align-items-center" style="gap:6px">    
                            Tên sản phẩm
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="name"></i>
                                    @endif
                                </span>
</div>
                            </th>
                            <th class="white-space-100 text-center">Số lượng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'quantity')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="quantity"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="quantity"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="quantity"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="text-center" style="min-width:180px !important;">Trạng thái thanh toán
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'method_payment')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="method_payment"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="method_payment"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="method_payment"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="text-center white-space-150">Ngày đặt hàng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="created_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="text-center" style="min-width:180px !important;">Xác nhận / Từ chối
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'export_status')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="export_status"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="export_status"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="export_status"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-100"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($order) > 0)
                            @foreach($order as $ord)
                                <tr>
                                    <td class="text-center white-space-120">{{$ord->no}}</td>
                                    <td class="text-center white-space-150">{{$ord->publish_id}}</td>
                                    <td title="{{$ord->name}}">{{\Illuminate\Support\Str::limit($ord->name,50,'...')}}</td>
                                    <td class="text-center">{{$ord->quantity}}</td>
                                    <td class="text-center" style="min-width:180px !important;">
                                        @if($ord->method_payment == 'COD')
                                            <span class="text-danger font-medium">Chưa thanh toán</span>
                                        @else
                                            <span class="text-success font-medium">Đã thanh toán</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{\Illuminate\Support\Carbon::parse($ord->created_at)->format('d/m/Y H:i')}}</td>
                                    <td class="status{{$ord->id}} text-center" style="min-width:180px !important;">
                                        @if($ord->export_status == 0)
                                            <div style="display:flex; justify-content:center; gap:10px"><a
                                                    href="javascript:void(0)" onclick="upDateStatus({{$ord->id}},1)"
                                                    style="text-decoration:underline"
                                                    class="text-success  ">
                                                    Đồng ý
                                                </a>
                                                <a href="javascript:void(0)" onclick="upDateStatus({{$ord->id}},3)"
                                                   style="text-decoration:underline"
                                                   class="text-danger  ">
                                                    Từ chối
                                                </a></div>
                                        @elseif($ord->export_status == 1)
                                            <div
                                                class="d-flex font-medium justify-content-center align-items-center  rounded-5 p-2 whitespace-nowrap text-success"
                                                style="gap:14px;">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="white"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="#2ec551"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Đồng ý
                                            </div>
                                        @else
                                            <div
                                                class="d-flex justify-content-center font-medium align-items-center gap-4 text-danger rounded-5 p-2 whitespace-nowrap"
                                                style="gap:14px;">
                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.2 12L0 10.8L4.8 6L0 1.2L1.2 0L6 4.8L10.8 0L12 1.2L7.2 6L12 10.8L10.8 12L6 7.2L1.2 12Z"
                                                        fill="#ef172c"/>
                                                </svg>
                                                Từ chối
                                            </div>

                                        @endif
                                    </td>
                                    <td class="white-space-100"><a href="javascript:void(0)" class="btn btn-link px-2" style="text-decoration:underline" onclick="showDetail({{$ord->id}})">Chi tiết</a>
                                    </td>
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
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$order->withQueryString()->links('layouts.custom.paginator')}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $('.btn-accept').on('click', async function () {
                const status = $('.btn-accept').data('status');
                const id = $('.btn-accept').data('key');
                await $.ajax({
                    type: "PUT",
                    url: `{{route('screens.storage.product.updateRequestOut')}}/${$('.btn-accept').data('status')}?_token={{csrf_token()}}`,
                    data: {
                        id: $('.btn-accept').data('key')
                    },

                    error: function (jqXHR, error, errorThrown) {
                        $('#requestModal').modal('hide')
                        var error0 = JSON.parse(jqXHR.responseText)
                        Swal.fire({
                            icon: 'error',
                            title: 'Cập nhật yêu cầu không thành công !',
                            text: error0.message,
                        })
                    }
                }).done(function (data) {
                    Swal.fire(
                        data.message,
                        'Click vào nút bên dưới để đóng',
                        'success'
                    )
                    $('#requestModal').modal('hide')
                    if (+status === 1) {
                        $('.status' + id).html(`
                       <div
                                                class="d-flex font-medium justify-content-center align-items-center  rounded-5 p-2 whitespace-nowrap text-success"
                                                style="gap:14px;">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="white"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="#2ec551"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Đồng ý
                                            </div>
                    `);
                    } else {
                        $('.status' + id).html(`
                   <div
                                                class="d-flex justify-content-center font-medium align-items-center gap-4 text-danger rounded-5 p-2 whitespace-nowrap"
                                                style="gap:14px;">
                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.2 12L0 10.8L4.8 6L0 1.2L1.2 0L6 4.8L10.8 0L12 1.2L7.2 6L12 10.8L10.8 12L6 7.2L1.2 12Z"
                                                        fill="#ef172c"/>
                                                </svg>
                                                Từ chối
                                            </div>
                    `)

                    }
                })

            }
        )


        function upDateStatus(id, status) {
            $('.btn-accept').data('key', id);
            $('.btn-accept').data('status', status);
            $('#requestModal').modal('show')
        }

        function showDetail(id) {
            var formData = {
                id: id,
            }
            $.ajax({
                type: "GET",
                url: `{{route('screens.storage.product.detailRequestOut')}}?id=` + id,
                dataType: "json",
            }).done(function (data) {
                var htmlData = ``;
                if (data.data) {
                    htmlData += `<form method="post" key=${id}>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                            <label for="name">Mã đơn hàng:</label>
                            <input type="text" class="form-control form-control-lg" id="code" value="${data.data.no}" readonly>
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
                            <input type="text" class="form-control form-control-lg" id="product_name" value="${data.data.name}" readonly>
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
                            ${data.data.export_status != 0 ? ` <select class="custom-select" id="inputGroupSelect01" disabled>
                                <option selected >${data.data.export_status == 1 ? 'Đã xác nhận' : 'Đã từ chối'}</option>
                            </select>` : ` <select class="custom-select" id="inputGroupSelect01">
                                <option  value="1">Đồng ý</option>
  <option  value="3" >Từ chối</option>
                            </select>`}

                        </div>
                   </form>     `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                    if (data.data.status == 1) {
                        $('.btn-update').addClass('hidden');
                    } else {
                        $('.btn-update').removeClass('hidden');
                        $('.btn-update').on('click', async function () {
                            const id = data.data.id;
                            await $.ajax({
                                type: "PUT",
                                url: `{{route('screens.storage.product.updateRequestOut')}}/${$('#inputGroupSelect01').val()}?_token={{csrf_token()}}`,
                                data: {
                                    id: data.data.id
                                },

                                error: function (jqXHR, error, errorThrown) {
                                    $('#requestModal').modal('hide')
                                    var error0 = JSON.parse(jqXHR.responseText)
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Xác nhận đơn hàng không thành công !',
                                        text: error0.message,
                                    })
                                }
                            }).done(function (data) {
                                Swal.fire(
                                    data.message,
                                    'Click vào nút bên dưới để đóng',
                                    'success'
                                )
                                $('#requestModal').modal('hide')
                                if (+$('#inputGroupSelect01').val() === 1) {
                                    $('.status' + id).html(`
                       <div
                                                class="d-flex font-medium justify-content-center align-items-center  rounded-5 p-2 whitespace-nowrap text-success"
                                                style="gap:14px;">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="white"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="#2ec551"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Đồng ý
                                            </div>
                    `);
                                } else {
                                    $('.status' + id).html(`
                   <div
                                                class="d-flex justify-content-center font-medium align-items-center gap-4 text-danger rounded-5 p-2 whitespace-nowrap"
                                                style="gap:14px;">
                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.2 12L0 10.8L4.8 6L0 1.2L1.2 0L6 4.8L10.8 0L12 1.2L7.2 6L12 10.8L10.8 12L6 7.2L1.2 12Z"
                                                        fill="#ef172c"/>
                                                </svg>
                                                Từ chối
                                            </div>
                    `)

                                }
                            })
                        });
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
                        document.location = '{{route('screens.storage.product.requestOut',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>

@endsection
