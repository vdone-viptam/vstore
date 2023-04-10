@extends('layouts.storage.main')
@section('page_title','Xuất hàng')

@section('modal')
    <div class="modal fade" id="modalBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông tin hóa đơn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Xuất hóa đơn</button>
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
                    <button type="button" class="btn btn-primary btn-update" data-dismiss="modal">Xuất hàng</button>
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
            <form action="">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                     style="gap:10px">
                    <h5 class="mb-0" style="font-size:18px;">Xuất hàng</h5>
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" name="key_search" value="{{$key_search ?? ''}}"
                                       type="search" placeholder="Tìm kiếm..">
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
                            <th>Mã xuất hàng</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm
                                @if($field == 'product_name')
                                    @if($type == 'desc')
                                        <i class="fa-solid fa-sort-down sort" data-sort="product_name"
                                           style="float: right;cursor: pointer"></i>
                                    @else
                                        <i class="fa-solid fa-sort-up sort" data-sort="product_name"
                                           style="float: right;cursor: pointer"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort sort" data-sort="product_name"
                                       style="float: right;cursor: pointer"></i>
                                @endif
                            </th>
                            <th>Nhà cung cấp
                                @if($field == 'ncc_name')
                                    @if($type == 'desc')
                                        <i class="fa-solid fa-sort-down sort" data-sort="ncc_name"
                                           style="float: right;cursor: pointer"></i>
                                    @else
                                        <i class="fa-solid fa-sort-up sort" data-sort="ncc_name"
                                           style="float: right;cursor: pointer"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort sort" data-sort="ncc_name"
                                       style="float: right;cursor: pointer"></i>
                                @endif
                            </th>
                            <th>Số lượng
                                @if($field == 'quantity')
                                    @if($type == 'desc')
                                        <i class="fa-solid fa-sort-down sort" data-sort="quantity"
                                           style="float: right;cursor: pointer"></i>
                                    @else
                                        <i class="fa-solid fa-sort-up sort" data-sort="quantity"
                                           style="float: right;cursor: pointer"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort sort" data-sort="quantity"
                                       style="float: right;cursor: pointer"></i>
                                @endif
                            </th>
                            <th>Ngày xuất hàng
                                @if($field == 'created_at')
                                    @if($type == 'desc')
                                        <i class="fa-solid fa-sort-down sort" data-sort="created_at"
                                           style="float: right;cursor: pointer"></i>
                                    @else
                                        <i class="fa-solid fa-sort-up sort" data-sort="created_at"
                                           style="float: right;cursor: pointer"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort sort" data-sort="created_at"
                                       style="float: right;cursor: pointer"></i>
                                @endif
                            </th>
                            <th>Thao tác/Trạng thái
                                @if($field == 'status')
                                    @if($type == 'desc')
                                        <i class="fa-solid fa-sort-down sort" data-sort="status"
                                           style="float: right;cursor: pointer"></i>
                                    @else
                                        <i class="fa-solid fa-sort-up sort" data-sort="status"
                                           style="float: right;cursor: pointer"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort sort" data-sort="status"
                                       style="float: right;cursor: pointer"></i>
                                @endif
                            </th>
                            <th>Xuất hóa đơn</th>
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
                                    <td class="status{{$request->id}} text-center">
                                        @if($request->status == 0)
                                            <a href="javascript:void(0)"
                                               onclick="upDateStatus({{$request->id}}, 1)"
                                               class=" bg-primary  text-white font-medium py-2 px-2 rounded btn-up">
                                                Xuất hàng
                                            </a>
                                        @else
                                            <div
                                                class="d-flex font-medium justify-content-center align-items-center  rounded-5 p-2 whitespace-nowrap text-success"
                                                style="gap:14px;">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="white"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="#2ec551"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Đã xuất hàng
                                            </div>

                                        @endif
                                    </td>
                                    <td>
                                        <div class="">
                                            <a href="javascript:void(0)" onclick="showBill({{$request->order_id}})"
                                               class="bg-danger  text-white font-medium py-2 px-2 rounded ">
                                                Xuất hóa đơn
                                            </a>
                                        </div>
                                    </td>
                                    <td><a href="#" onclick="showDetail({{$request->id}})" class="btn btn-link">Chi
                                            tiết</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$requests->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
            integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.5/JsBarcode.all.min.js"
            integrity="sha512-QEAheCz+x/VkKtxeGoDq6nsGyzTx/0LMINTgQjqZ0h3+NjP+bCsPYz3hn0HnBkGmkIFSr7QcEZT+KyEM7lbLPQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                            <label for="quantity">Số lượng xuất:</label>
                            <input type="text" class="form-control form-control-lg" id="quantity" value="${data.data.quantity}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="created_at">Ngày xuất hàng: </label>
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
                        $('.btn-update').on('click', async function () {
                            await $.ajax({
                                type: "PUT",
                                url: `{{route('screens.storage.warehouse.confirmExportProduct')}}?_token={{csrf_token()}}`,
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
                                $('.status' + id).html(`
                       <div
                                                class="d-flex font-medium justify-content-center align-items-center  rounded-5 p-2 whitespace-nowrap text-success"
                                                style="gap:14px;">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="white"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="#2ec551"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Đã xuất hàng
                                            </div>
                    `);
                            })
                        })

                    }


                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })
        }

        $('.btn-accept').on('click', async function () {
                const id = $('.btn-accept').data('key');
                await $.ajax({
                    type: "PUT",
                    url: `{{route('screens.storage.warehouse.confirmExportProduct')}}?_token={{csrf_token()}}`,
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
                })

            }
        )


        function upDateStatus(id, status) {
            $('.btn-accept').data('key', id);
            $('#requestModal').modal('show')
        }

        async function showBill(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.storage.warehouse.exportBill')}}?order_id=${id}`,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'In hóa đơn thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                let htmlData = ``;

                if (data.message) {
                    htmlData = `
                        <div class="row align-items-center" style="gap:10px; flex-wrap:nowrap">
                            <div class="col-4">
                                <svg id="barcode"></svg>
                            </div>
                            <div class="col-4">
                                <h2>Phiếu gửi</h2>
                            </div>
                            <div class="col-4">
                                <span>Viettel Post</span>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-12 py-2">
                            <h4 class="font-medium" style="margin-bottom:8px">Người gửi:</h4>
                            <div class="d-flex" style="gap:4px">
                                <span class="font-medium" >Họ tên người gửi:  </span>
                                <span>${data.message.storage_name}</span>
                            </div>
                            <div class="d-flex" style="gap:4px">
                                <span class="font-medium line-clamp-1">Địa chỉ: </span>
                                <span class="font-normal"> ${data.message.ward_id_boss_storage}, ${data.message.district_id_boss_storage}, ${data.message.province_boss_storage}</span>
                            </div>
                            <div class="d-flex" style="gap:4px">
                                <span class="font-medium line-clamp-1">Điện thoại: </span>
                                <span class="font-normal"> ${data.message.storage_phone}</span>
                            </div>
                            </div>
                        <div class="col-12 py-2">
                                <h4 class="font-medium" style="margin-bottom:8px">Người nhận:</h4>
                            <div class="d-flex" style="gap:4px">
                                <span class="font-medium">Họ tên người nhận:  </span>
                                <span>${data.message.name_customer}</span>
                            </div>
                            <div class="d-flex" style="gap:4px">
                                <span class="font-medium line-clamp-1">Địa chỉ: </span>
                                <span class="font-normal"> ${data.message.address_customer}</span>
                            </div>
                            <div class="d-flex" style="gap:4px">
                                <span class="font-medium line-clamp-1">Điện thoại: </span>
                                <span class="font-normal"> ${data.message.phone_customer}</span>
                            </div>
                            </div>
                            <div class="col-12 py-2">
                                <h4 class="font-medium" style="margin-bottom:8px">Nội dung hàng hóa:</h4>
                            <div class="d-flex justify-content-between align-items-center" style="gap:4px">
                                <span class="font-medium">Tên sản phẩm: <span class="font-normal">${data.message.name}</span></span>
                                <span class="font-medium">Số lượng: <span class="font-normal">${data.message.quantity}</span></span>
                                <span class="font-medium">Khối lượng: <span class="font-normal">${data.message.weight} Gam</span></span>
                            </div>

                            </div>
                            <div class="col-12 d-flex py-2" style="border-top:1px solid grey;">
                                <div class="col-6"> <img src="https://chart.googleapis.com/chart?cht=qr&chl=${data.message.no}&chs=160x160&chld=L|0"
         class="qr-code img-thumbnail img-responsive"></div>
                                <div class="col-6 py-2 px-0">
                                        <h4 class="font-medium " style="margin-bottom:8px">Thanh toán</h4>
                                        <div class="d-flex flex-column " style="gap:4px">
                                            <span class="font-medium">Phí ship: <span class="font-normal">${data.message.shipping} VNĐ</span></span>
                                            <span class="font-medium">Thanh toán phí ship: <span class="font-normal">Người nhận</span></span>
                                            <span class="font-medium">Số tiền phải thu: <span class="font-normal">${data.message.total} VNĐ</span></span>
                                        </div>
                                    </div>



                            </div>

                        </div>

                `

                    $('#modalBill .md-content').html(htmlData)
                    $('#modalBill').modal('show');
                    generateBarcode(data.message.order_number)

                }

            })
        }

        async function generateBarcode(item) {

            if (item) {
                await JsBarcode(`#barcode`, item, {format: "CODE128"})
            }
        }

        $(document).ready(function () {
            let barcode = '';
            var interval;
            document.addEventListener('keypress', event => {
                if (interval) {
                    clearInterval(interval);
                }
                if (event.code == 'Enter') {
                    if (barcode) {
                        handleBarcode(barcode);
                    }
                    barcode = '';
                    return;
                }
                if (event.code != 'Shift') {
                    barcode += event.key;
                }
                interval = setInterval(() => barcode = '', 20);
            });

            async function handleBarcode(scanned_barcode) {
                filter(scanned_barcode)
            }

            $('.top-search-bar').on('keyup', function (e) {
                if (e.key == 'Enter' || e.keyCode == 13) {
                    filter(e.target.value);
                    return;
                }

            })

        })
        document.querySelectorAll('.sort').forEach(item => {
            const {sort} = item.dataset;
            item.addEventListener('click', () => {
                let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                if (orderBy === 'asc') {
                    localStorage.setItem('orderBy', JSON.stringify('desc'));
                } else {
                    localStorage.setItem('orderBy', JSON.stringify('asc'));
                }
                document.location = '{{route('screens.storage.warehouse.export',['key_search' => $key_search])}}&type=' + orderBy +
                    '&field=' + sort
            });
        });
    </script>

@endsection
