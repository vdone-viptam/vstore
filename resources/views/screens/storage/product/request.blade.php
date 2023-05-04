@extends('layouts.storage.main')
@section('page_title','Quản lý yêu cầu nhập kho')


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
                    <button type="button" class="btn btn-primary btn-update" data-dismiss="modal">Lưu thay đổi</button>
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
                    <table id="example" class="table table-striped table-bordered second"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th class="white-space-120 text-center">Mã yêu cầu</th>
                            <th class="white-space-150 text-center">Mã sản phẩm</th>
                            <th>
                            <div class="white-space-400 text-center" style="gap:6px">
                                Tên sản phẩm
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'product_name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="product_name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="product_name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="product_name"></i>
                                    @endif
                                </span>
                                </div>
                            </th>
                            <th class="white-space-150 text-center">Nhà cung cấp
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'ncc_name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="ncc_name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="ncc_name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="ncc_name"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-150 text-center">Số lượng nhập
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
                            </th>
                            <th class="text-center white-space-150">Ngày yêu cầu
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
                            <th class="text-center" style="min-width:180px !important;">Xác nhận / từ chối
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'status')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="status"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="status"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="status"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-100"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $product)
                                <tr>
                                    <td class="text-center white-space-120">{{$product->code}}</td>
                                    <td class="text-center white-space-150">{{$product->publish_id}}</td>
                                    <td title="{{$product->product_name}}" class="white-space-400">{{\Illuminate\Support\Str::limit($product->product_name,50,'...')}}</td>
                                    <td class="text-center ">{{$product->ncc_name}}</td>
                                    <td class="text-center">{{$product->quantity}}</td>
                                    <td class="text-center">{{\Illuminate\Support\Carbon::parse($product->created_at)}}</td>
                                    <td class="status{{$product->id}} text-center" style="min-width:180px !important;">
                                        @if($product->status == 0)
                                            <div style="display:flex; justify-content:center; gap:10px"><a
                                                    href="javascript:void(0)" onclick="upDateStatus({{$product->id}},5)"
                                                    style="text-decoration:underline"
                                                    class="text-success">
                                                    Đồng ý
                                                </a>
                                                <a href="javascript:void(0)" onclick="upDateStatus({{$product->id}},10)"
                                                   style="text-decoration:underline"
                                                   class="text-danger">
                                                    Từ chối
                                                </a></div>
                                        @elseif($product->status == 5 || $product->status == 1 ||  $product->status == 7)
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
                                    <td class="white-space-100 text-center"><a href="javascript:void(0)" class="btn btn-link px-2" style="text-decoration:underline" onclick="showDetail({{$product->id}})">Chi
                                            tiết</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$requests->withQueryString()->links('layouts.custom.paginator')}}
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
                    url: `{{route('screens.storage.product.updateRequest')}}/${$('.btn-accept').data('status')}?_token={{csrf_token()}}`,
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
                    if (+status === 5) {
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

        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.storage.product.detailRequest')}}?id=` + id,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                $('.btn-accept').data('key', id);
                var htmlData = ``;
                if (data.data) {
                    htmlData = `
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
                                <option selected > ${data.data.status == 5 || data.data.status == 1 || data.data.status == 7 ? `Đồng ý` : `Từ chối`}</option>
                            </select>` : ` <select class="custom-select" id="inputGroupSelect01">
                                <option  value="5">Đồng ý</option>
                                <option  value="10">Từ chối</option>
                            </select>`}

                        </div>
           `;

                    if (data.data.status != 0) {
                        $('.btn-update').addClass('hidden');
                    } else {
                        $('.btn-update').removeClass('hidden');
                        $('.btn-update').on('click', async function () {
                            const id = data.data.id;
                            await $.ajax({
                                type: "PUT",
                                url: `{{route('screens.storage.product.updateRequest')}}/${$('#inputGroupSelect01').val()}?_token={{csrf_token()}}`,
                                data: {
                                    id: data.data.id
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
                                if (+$('#inputGroupSelect01').val() === 5) {
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
                        document.location = '{{route('screens.storage.product.request',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>

@endsection
