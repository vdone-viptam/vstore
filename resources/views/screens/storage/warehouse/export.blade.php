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
                            <th class="white-space-130 text-center">Mã xuất hàng</th>
                            <th class="white-space-130 text-center">Mã sản phẩm</th>
                            <th >
                               
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
                                
                            </th>
                            <th class="white-space-130 text-center">Nhà cung cấp
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
                            <th class="white-space-150 text-center">Thời gian xuất hàng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'updated_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="updated_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="updated_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="updated_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-180 text-center">
                                Thời gian tạo yêu cầu
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
                            <th class="white-space-160">
                               
                                Thao tác/Trạng thái
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
                            <th class="text-center white-space-120">Xuất hóa đơn</th>
                            <th class="white-space-80"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $request)
                                <tr>
                                    <td class="text-center white-space-140">{{$request->code}}</td>
                                    <td class="text-center  white-space-140">{{$request->publish_id}}</td>
                                    <td title="{{$request->product_name}}" class="white-space-300">{{\Illuminate\Support\Str::limit($request->product_name,50,'...')}}</td>
                                    <td class="text-center white-space-150">{{$request->ncc_name}}</td>
                                    <td class="text-center white-space-100">{{$request->quantity}}</td>

                                    <td class="text-center white-space-130">
                                        @if($request->status == 1 )
                                            {{\Carbon\Carbon::parse($request->updated_at)->format('d/m/Y H:i')}}
                                        @else
                                            -
                                        @endif


                                    </td>
                                    <td class="text-center white-space-130"> {{\Carbon\Carbon::parse($request->created_at)->format('d/m/Y H:i')}}</td>

                                    <td class="status{{$request->id}} text-center white-space-150">
                                        @if($request->status == 0)
                                            <a href="javascript:void(0)"
                                               onclick="upDateStatus({{$request->id}}, 1)"
                                               class=" bg-primary  text-white font-medium py-2 px-2 rounded btn-up">
                                                Xuất hàng
                                            </a>
                                        @else
                                            <div
                                                class="d-flex font-medium justify-content-center align-items-center  rounded-5  whitespace-nowrap text-success"
                                                style="gap:14px;">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="transparent"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="#2ec551"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Đã xuất hàng
                                            </div>

                                        @endif
                                    </td>
                                    <td class="text-center white-space-150">
                                        <div class="">
                                            <a href="javascript:void(0)" onclick="showBill({{$request->order_number}})"
                                               class="bg-danger  text-white font-medium py-2 px-2 rounded ">
                                                In hóa đơn
                                            </a>
                                        </div>
                                    </td>
                                    <td class="white-space-80 text-center"><a href="javascript:void(0)"
                                                                   onclick="showDetail({{$request->id}})"
                                                                   class="btn btn-link px-2 py-0"
                                                                   style="text-decoration:underline">Chi
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
                    htmlData = `<form method="post" key=${id}>
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
                            </div>
                        <div class="form-group">
                            <label for="quantity">Mã vận chuyển: </label>
                            <input type="text" class="form-control form-control-lg" id="quantity" value="${data.data.order_number || 'Chưa có mã vận chuyển'}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Số lượng xuất:</label>
                            <input type="text" class="form-control form-control-lg" id="quantity" value="${data.data.quantity}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="created_at">Thời gian yêu cầu: </label>
                            <input type="text" class="form-control form-control-lg" id="created_at" value="${convertTimeVN(data.data.created_at)}" readonly>
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
                        $('.btn-update').on('click', function () {
                            $.ajax({
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
                                    }).then(() => {
                                        location.reload()
                                    })
                                }
                            }).done(function (data) {
                                Swal.fire(
                                    data.message,
                                    'Click vào nút bên dưới để đóng',
                                    'success'
                                ).then(() => location.reload())
                                $('#requestModal').modal('hide')
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
                    ).then(() => location.reload())
                    $('#requestModal').modal('hide')
                })

            }
        )


        function upDateStatus(id, status) {
            $('.btn-accept').data('key', id);
            $('#requestModal').modal('show')
        }

        async function showBill(order_number) {
            await $.ajax({
                type: "GET",
                url: `{{route('billViet')}}/${order_number}`,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                window.open(data.href, "_blank");
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
                        document.location = '{{route('screens.storage.warehouse.export',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>

@endsection
