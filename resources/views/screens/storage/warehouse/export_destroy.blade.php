@extends('layouts.storage.main')
@section('page_title','Xuất hủy')


@section('modal')
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">\index.html
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-create">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-createProDel">Tạo</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">\index.html
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-detail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Xuất hủy</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý
                                    kho</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Xuất hủy</li>
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
            <div class="card-header">
                <form action="">
                    <div class=" d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                        <h5 class="mb-0" style="font-size:18px;">Xuất hủy</h5>
                        <div class="d-flex justify-content-start align-items-center" style="gap:8px">
                            <ul class="navbar-nav ">
                                <li class="nav-item">
                                    <div id="custom-search" class="top-search-bar">
                                        <input class="form-control" name="key_search" value="{{$key_search ?? ''}}"
                                               type="search" placeholder="Tìm kiếm..">
                                    </div>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-create">Xuất hủy</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>Mã xuất hủy</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm
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
                            <th>Số lượng
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
                            <th>Lý do hủy</th>
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
                                    <td>{{$request->quantity}}</td>
                                    <td>{{$request->note}}</td>
                                    <td><a href="#" onclick="showDetail({{$request->id}})" class="btn btn-link">Chi
                                            tiết</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
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
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.storage.warehouse.detailRequest')}}?id=` + id,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                var htmlData = ``;
                if (data.data) {

                    htmlData = `   <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Mã đơn hàng: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.code}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Mã xuất hủy: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.publish_id}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Tên sản phẩm: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.product_name}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Số lượng sản phẩm: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.quantity}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Lý do hủy: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.note}</span>
                        </div>
               </div>
                        `;
                    $('.md-detail').html(htmlData)
                    $('#modalDetail').modal('show');
                }
            })


        }

        async function createProDel() {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.storage.warehouse.createRequestDestroy')}}`,
            }).done(function (data) {

                if (data.data.length < 1) {
                    $('table tbody').html(`<tr style="text-align:center;"><td colspan="8">Không có dữ liệu phù hợp!</td></tr>`)
                } else {
                    var op = ``
                    data.data.map((item, index) => {
                        op += `<option data-ware_id ="${item.ware_id}" value ="${item.id}">${item.name}</option>`
                    })
                    $('.md-create').html(`
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Tạo xuất hủy</label>
                            <select class="form-control" id="product_id">
                                ${op}
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Nhập số lượng hủy</label>
                        <input type="number" class="form-control" id="quantity" placeholder="">
                        <p class="text-danger mt-1 error_quantity"></p>
                    </div>
                    <div class="form-group">
                        <label for="note">Lí do hủy</label>
                        <textarea class="form-control" id="note" rows="3"></textarea>
                        <p class="text-danger mt-1 error_note"></p>
                    </div>
                    `);

                }
            });
        }

        $(".btn-createProDel").click(function () {
            const formData = {
                product_id: $("#product_id").val(),
                quantity: $("#quantity").val(),
                warehouse_id: $("#product_id").find(':selected').attr('data-ware_id'),
                note: $("#note").val()
            }
            $.ajax({
                type: "POST",
                url: `{{route('screens.storage.warehouse.storeRequestDestroy')}}?_token={{csrf_token()}}`,
                data: formData,
                error: function (jqXHR, error, errorThrown) {

                    var error0 = JSON.parse(jqXHR.responseText)
                    console.log(error0);
                    $(".error_quantity").html(`${error0.message || ''}`)
                    $(".error_quantity").html(`${error0.errors.quantity ? error0.errors.quantity[0] : ''}`)
                    $(".error_note").html(`${error0.errors.note ? error0.errors.note[0] : ''}`)
                },
            }).done(function (data) {
                Swal.fire(
                    data.message,
                    'Click vào nút bên dưới để đóng',
                    'success'
                ).then(() => location.reload()
                )


            })
        })
        $(".btn-create").click(async function () {
            await createProDel();
            $('#modalCreate').modal('show');
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
                        document.location = '{{route('screens.storage.warehouse.exportDestroyProduct',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>

@endsection
