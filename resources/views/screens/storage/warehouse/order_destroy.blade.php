@extends('layouts.storage.main')
@section('page_title','Đơn hàng hủy')


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
                    <button type="button" class="btn btn-primary btn-update" data-dismiss="modal">Nhập hàng trở lại
                        kho
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Đơn hàng hủy</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý
                                    kho</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Đơn hàng hủy</li>
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
                    <h5 class="mb-0" style="font-size:18px;">Đơn hàng hủy</h5>
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
                            <th class="text-center white-space-120">Mã sản phẩm</th>
                            <th>
                            <div class="white-space-300 d-flex justify-content-between align-items-center" style="gap:6px">       
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
                            <th class="white-space-120 text-center">Số lượng
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
                            <th class="white-space-300 text-center">Lý do hủy</th>
                            <th class="white-space-150 text-center">Trạng thái
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'cancel_status')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="cancel_status"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="cancel_status"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="cancel_status"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-100"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders) > 0)
                            @foreach($orders as $request)
                                <tr>
                                    <td class="white-space-120 text-center">{{$request->no}}</td>
                                    <td class="white-space-120 text-center">{{$request->publish_id}}</td>
                                    <td title="{{$request->product_name}}">{{\Illuminate\Support\Str::limit($request->product_name,50,'...')}}</td>
                                    <td class="text-center">{{$request->quantity}}</td>
                                    <td>{{$request->note}}</td>
                                    <td class="text-center">
                                        @if($request->cancel_status == 1)
                                            <p class="text-primary">Chưa hoàn hàng</p>
                                        @elseif($request->cancel_status == 3)
                                            <p class="text-success">Đã hoàn hàng</p>
                                        @else
                                            <p class="text-danger">Hàng chưa xuất kho</p>
                                        @endif
                                    </td>
                                    <td class="text-center white-space-100"><a href="javascript:void(0)" style="text-decoration:underline;"
                                           onclick="showDetail({{$request->order_id}},{{$request->cancel_status}})"
                                           class="btn btn-link">Chi tiết</a></td>
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
                    {{$orders->withQueryString()->links('layouts.custom.paginator')}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        async function showDetail(id, cancel_status) {
            if (cancel_status == 1) {
                $(".btn-update").removeClass("hidden")
                $('.btn-update').data('order_id', id)
            } else {
                $(".btn-update").addClass("hidden")
            }
            await $.ajax({
                type: "GET",
                url: `{{route('screens.storage.warehouse.detailDestroyOrder')}}?id=` + id,
                error: function (jqXHR, error, errorThrown) {
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Nhập hàng trở lại kho thất bại !',
                        text: error0.message,
                    })
                },
            }).done(function (data) {
                var htmlData = ``;

                if (data.data) {
                    htmlData = `<form method="post">
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                            <label for="product_name">Tên sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" id="product_name" value="${data.data.product_name}" readonly>
                        </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                            <label for="quantity">Số lượng sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" id="quantity" value="${data.data.quantity}" readonly>
                        </div>
                        </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="id_vdone">Lý do hủy: </label>
                            <textarea  class="form-control form-control-lg" readonly>${data.data.note}</textarea>
                        </div>
                        ${cancel_status == 1 ? `<p class="error_proBack text-danger"></p>` : cancel_status == 3 ? `<p class="error_proBack text-success">Đã nhập lại hàng</p>` : `<p class="error_proBack text-danger">Hàng chưa xuất kho</p>`}

                   </form>
                        `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu!')
                }
            })
        }

        $(".btn-update").click(function () {
            $.ajax({
                type: "POST",
                url: `{{route('screens.storage.warehouse.storeImportProduct')}}?order_id=${$(".btn-update").data('order_id')}&_token={{csrf_token()}}`,
                error: function (jqXHR, textStatus, errorThrown) {
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Nhập hàng trở lại kho thất bại !',
                        text: error0.message,
                    })

                }
            }).done(function (data) {
                Swal.fire(
                    data.message,
                    'Click vào nút bên dưới để đóng',
                    'success'
                ).then(() => location.reload());
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
                        document.location = '{{route('screens.storage.warehouse.destroyOrder',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>

@endsection
