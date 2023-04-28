@extends('layouts.manufacture.main')

@section('modal')
    <div
        class="modal fade"
        id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form method="post" action="{{route('screens.manufacture.warehouse.addProduct')}}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thêm sản phẩm vào
                            kho</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body md-content">

                        <div class="row">
                            <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chọn sản phẩm <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" id="product_id" name="product_id">
                                        <option value="" selected disabled>Lựa chọn sản phẩm thêm vào kho</option>
                                        @foreach($products as $product)
                                            <option
                                                value="{{$product->id}}" {{old('product_id') == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chọn kho liên kết <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" id="ware_id" name="ware_id">
                                        <option value="" selected disabled>Lựa chọn kho liên kết</option>
                                        @foreach($warehouses as $ware)
                                            <option
                                                value="{{$ware->id}}" {{old('ware_id') == $ware->id ? 'selected' : ''}}>{{$ware->ware_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ware_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            @csrf

                            <div class="col-xl-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Nhập số lượng <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg number" id="quantity"
                                           name="quantity"
                                           value="{{old('quantity')}}" placeholder="Nhập Số lượng sản phẩm">
                                    @error('quantity')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-xl-12 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Loại kho <span class="text-danger">*</span></label>
                                    <div id="selectType" class="form-group row">
                                        <p class="text-danger ml-4">Chọn kho để hiện thị thông tin loại kho</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button id="btnAddPro" class="btn btn-success">Gửi yêu cầu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div
        class="modal fade"
        id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form method="post" action="{{route('screens.manufacture.warehouse.addProduct')}}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Sản phẩm trong kho</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body md-content1">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </form>
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
                                    <input id="account_code" class="form-control" type="text"
                                           placeholder="Nhập ID Kho">
                                </div>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-primary" id="btnAffWa" type="button" onclick="affWarehouse()">
                                    Thêm kho
                                </button>
                                <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"
                                        type="button">
                                    Thêm sản phẩm vào kho
                                </button>
                            </li>
                        </ul>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                            <tr>
                                <th class="white-space-400">Tên kho hàng</th>
                                <th>Số điện thoại</th>
                                <th class="white-space-400">Địa chỉ

                                </th>
                                <th >Tổng số mặt hàng
                                    <span style="float: right;cursor: pointer">
                                    @if($field == 'amount')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="amount"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="amount"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="amount"></i>
                                        @endif
                                    </span>
                                </th>
                                <th class="th th_quantity">Sản phẩm có trong kho
                                    <span style="float: right;cursor: pointer">
                                    @if($field == 'amount_product')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="amount_product"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="amount_product"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="amount_product"></i>
                                        @endif
                                </span>
                                </th>

                                <th class="th th_status"></th>
                            </tr>
                            </thead>
                            <tbody>
                        @if(count($warehouses) > 0)
                            @foreach($warehouses as $val)
                                <tr>
                                    <td class="white-space-400">{{$val->ware_name}}</td>
                                    <td class="text-center">{{$val->phone_number}}</td>
                                    <td class="white-space-400">{{$val->address}}</td>
                                    <td class="text-center">{{$val->amount ?? 0}}</td>
                                    <td class="text-center">{{$val->amount_product ?? 0}}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-link"
                                                onclick="showDetail({{$val->id}})">Chi tiết
                                        </button>

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
                    <div class="d-flex align-items-center justify-content-end mt-4">
                        {{$warehouses->withQueryString()->links('layouts.custom.paginator')}}
                        <div class=" ml-4">
                            <div class="form-group">
                                <select class="form-control" id="limit">
                                    <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 hàng / trang</option>
                                    <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 hàng / trang</option>
                                    <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 hàng / trang</option>
                                </select>
                            </div>
                        </div>
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
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{\Illuminate\Support\Facades\Session::get('success')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{\Illuminate\Support\Facades\Session::get('error')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif

    @if(\Illuminate\Support\Facades\Session::has('validate') & old('ware_id') && old('product_id'))
        <script>
            $('#exampleModalCenter').modal('show');
            $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.warehouse.getTypeWarehouse')}}`,
                dataType: "json",
                data: {
                    "id": {{old('ware_id')}}, "product_id": {{old('product_id')}}
                },
                encode: true,
                error: function (jqXHR, error, errorThrown) {

                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Liên kết kho không thành công',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                const html = data.ware_type.map((item, index) => {
                    let name = '';
                    if (item.type === 1) {
                        name = 'Kho thường';
                    } else if (item.type === 2) {
                        name = 'Kho lạnh';
                    } else {
                        name = 'Kho bãi';
                    }
                    return `
<div class="col-4">
<label class="custom-control custom-radio custom-control-inline" id="type${index}" style="margin: 0;">
                                                            <input type="radio" name="type" value="${item.type}" ${item.type == data.product_ware || data.ware_type.length == 1 ? 'checked' : 'disabled'}  id="type${index}" class="custom-control-input"><span class="custom-control-label">${name}</span>
                                                        </label>
</div>k`;
                }).join("");
                $('#selectType').html(html);
            })

        </script>
    @endif
    <script>
        $('#appect').on('change', (e) => {
            if (e.target.checked && $('#discount_vShop').val()) {
                if ($('#appect').is(":checked")) {
                    document.getElementById('btnConfirm').style.display = 'block';
                } else {
                    document.getElementById('btnConfirm').style.display = 'none';

                }
            } else {
                document.getElementById('btnConfirm').style.display = 'none';
            }
        });
        $('#btnAddPro').attr('disabled', 'true')

        $('#quantity').on('keyup', (e) => {
                if (!e.target.value) {
                    $('#btnAddPro').attr('disabled', 'true')
                } else {
                    $('#btnAddPro').removeAttr('disabled')

                }
            }
        );
        document.getElementById('btnAffWa').setAttribute('disabled', 'true');

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
                    htmlData += `



                    <div class="col-12">
                    <div class="table-responsive">

                        <table id="example" class="table table-striped table-bordered second" style="width:100%">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc"  style="width: 250px;">Tên sản phẩm</th>
                                <th style="min-width: 250px;">Số lượng</th>

                            </tr>
                            </thead>
                            <tbody>`

                    $.each(data.data, function (key, value) {

                            htmlData += `
<tr role="row" class="odd">
                                <td class="text-nowrap" >${value.name}</td>
                                <td>${value.amount_product}</td>

                            </tr>

`

                        }
                    )


                    htmlData += `</tbody>

                        </table>
</div>
</div>
   `;
                    ;
                    $('.md-content1').html(htmlData)
                    $('#modalDetail').modal('show');
                } else {

                    $('#modalDetail').modal('show');
                    $('.md-content1').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })
        }

        document.querySelector('#product_id').addEventListener('change', async (e) => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.warehouse.getTypeWarehouse')}}`,
                dataType: "json",
                data: {"product_id": e.target.value, "id": $('#ware_id').val()},
                encode: true,
                error: function (jqXHR, error, errorThrown) {

                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Liên kết kho không thành công',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                if ($('#ware_id').val()) {
                    const html = data.ware_type.map((item, index) => {
                        let name = '';
                        if (item.type === 1) {
                            name = 'Kho thường';
                        } else if (item.type === 2) {
                            name = 'Kho lạnh';
                        } else {
                            name = 'Kho bãi';
                        }
                        let checked = '';
                        if (data.product_ware == 0 && index == 0) {
                            checked = 'checked';
                        } else if (data.product_ware == 0 && index != 0) {
                            checked = '';
                        } else if (item.type == data.product_ware) {
                            checked = 'checked';
                        } else {
                            checked = 'disabled';
                        }
                        console.log(checked);

                        return `
<div class="col-4">
<label class="custom-control custom-radio custom-control-inline" id="type${index}" style="margin: 0;">
                                                            <input type="radio" name="type" value="${item.type}" ${checked}   id="type${index}" class="custom-control-input"><span class="custom-control-label">${name}</span>
                                                        </label>
</div>`;
                    }).join("");

                    $('#selectType').html(html);
                }
            })
        });

        document.querySelector('#ware_id').addEventListener('change', async (e) => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.warehouse.getTypeWarehouse')}}`,
                dataType: "json",
                data: {"id": e.target.value, "product_id": $('#product_id').val()},
                encode: true,
                error: function (jqXHR, error, errorThrown) {

                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Liên kết kho không thành công',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                const html = data.ware_type.map((item, index) => {
                    let name = '';
                    if (item.type === 1) {
                        name = 'Kho thường';
                    } else if (item.type === 2) {
                        name = 'Kho lạnh';
                    } else {
                        name = 'Kho bãi';
                    }
                    let checked = '';
                    if (data.product_ware == 0 && index == 0) {
                        checked = 'checked';
                    } else if (data.product_ware == 0 && index != 0) {
                        checked = '';
                    } else if (item.type == data.product_ware) {
                        checked = 'checked';
                    } else {
                        checked = 'disabled';
                    }
                    console.log(checked);
                    return `
<div class="col-4">
<label class="custom-control custom-radio custom-control-inline" id="type${index}" style="margin: 0;">
                                                            <input type="radio" name="type" value="${item.type}" ${checked}   id="type${index}" class="custom-control-input"><span class="custom-control-label">${name}</span>
                                                        </label>
</div>`;
                }).join("");
                $('#selectType').html(html);
            })
        });

        async function affWarehouse() {
            const account_code = $("#account_code").val().trim();

            await $.ajax({
                type: "POST",
                url: `{{route('screens.manufacture.warehouse.affWarehouse')}}`,
                dataType: "json",
                data: {"account_code": account_code},
                encode: true,
                error: function (jqXHR, error, errorThrown) {

                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Liên kết kho không thành công',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    text: 'Click nút bên dưới để đóng',
                }).then(() => location.reload())
            })
        }

        document.getElementById('account_code').addEventListener('keyup', (e) => {
            if (e.target.value) {
                document.getElementById('btnAffWa').removeAttribute('disabled');
            } else {
                document.getElementById('btnAffWa').setAttribute('disabled', 'true');

            }
        });
        let limit = document.getElementById('limit');
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.warehouse.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
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
                        document.location = '{{route('screens.manufacture.warehouse.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    }, 200)
                });
            });
        });
    </script>
@endsection



