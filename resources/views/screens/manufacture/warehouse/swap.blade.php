@extends('layouts.manufacture.main')
@section('page_title','Quản lý xuất - nhập sản phẩm')



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
                                        @foreach($productAc as $product)
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
                                        <p class="text-danger ml-4">Chọn kho để hiển thị thông tin loại kho</p>
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
@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Quản lý xuất - nhập sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý kho hàng</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý xuất - nhập sản phẩm</li>
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
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="    gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Quản lý xuất - nhập sản phẩm</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input name="key_search" value="{{$key_search ?? ''}}" class="form-control"
                                       type="search"
                                       placeholder="Nhập từ khóa tìm kiếm...">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <button class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModalCenter"
                        type="button">
                    Thêm sản phẩm vào kho
                </button>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th class="text-center white-space-120">Mã yêu cầu</th>
                            <th class="white-space-150">

                                Tên kho hàng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'warehouses.name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="warehouses.name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="warehouses.name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="warehouses.name"></i>
                                    @endif
                                </span>
                            </th>
                            <th>

                                Tên sản phẩm
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'products.name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="products.name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="products.name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="products.name"></i>
                                    @endif
                                </span>

                            </th>
                            <th class="white-space-150">

                                Loại yêu cầu
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'type')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="request_warehouses.type"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="request_warehouses.type"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="request_warehouses.type"></i>
                                    @endif
                                </span>

                            </th>
                            <th class="white-space-130">

                                Tình trạng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'request_warehouses.status')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="request_warehouses.status"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort"
                                               data-sort="request_warehouses.status"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="request_warehouses.status"></i>
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
                            <th class="white-space-130">
                                Thời gian
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'request_warehouses.created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort"
                                               data-sort="request_warehouses.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort"
                                               data-sort="request_warehouses.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="request_warehouses.created_at"></i>
                                    @endif
                                </span>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <tr>
                                    <td class="white-space-140">{{$product->code}}</td>
                                    <td class="white-space-200 text-center">{{$product->ware_name}}</td>
                                    <td class="white-space-300">{{$product->name}}</td>
                                    <td class="text-center white-space-120">
                                        @if($product->type == 1)
                                            <span class="text-success">Nhập kho</span>
                                        @else
                                            <span class="text-danger">Xuất kho</span>
                                        @endif
                                    </td>
                                    <td class="text-center white-space-150">
                                        @if($product->type == 1)
                                            @if($product->status == 0 || $product->status == 5 || $product->status == 7)
                                                <span class="text-warning">Đang chờ kho duyệt</span>
                                            @elseif($product->status == 1)
                                                <span class="text-success">Đã thêm vào kho</span>
                                            @else
                                                <span class="text-danger">Kho từ chối nhập</span>
                                            @endif
                                        @else
                                            @if($product->status == 0)
                                                <span class="text-warning">Đang chờ kho duyệt</span>
                                            @elseif($product->status == 1)
                                                <span class="text-success">Đã xuất kho</span>
                                            @else
                                                <span class="text-danger">Kho từ chối xuất</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center white-space-100">{{number_format($product->quantity,0,'.','.')}}</td>
                                    <td class="text-center white-space-130">{{\Illuminate\Support\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}</td>
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
                    {{$products->withQueryString()->links('layouts.custom.paginator')}}
                    <div class="ml-4">
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
    <script>

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
        let limit = document.getElementById('limit');
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
                        document.location = '{{route('screens.manufacture.warehouse.swap',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.warehouse.swap',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>

@endsection
