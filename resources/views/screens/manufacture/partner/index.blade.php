@extends('layouts.manufacture.main')
@section('page_title','Danh sách V-Store liên kết')

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Danh sách V-Store liên kết</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Liên kết V-Store</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách V-Store liên kết</li>
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
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Danh sách V-Store liên kết</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form action="">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input class="form-control" name="key_search" value="{{$key_search ?? ''}}"
                                       type="search" placeholder="Nhập từ khóa tìm kiếm...">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second">
                        <thead>
                        <tr>
                            <th class="white-space-130 text-center">Mã V-Store</th>
                            <th class="white-space-150 text-center">Tên V-Store
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'vstore_name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="vstore_name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="vstore_name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="vstore_name"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-150 text-center">Số điện thoại V-Store
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'phone_number')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="phone_number"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="phone_number"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="phone_number"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-250 text-center">

                                    Tổng số sản phẩm niêm yết trên V-Store
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'total_product')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="total_product"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="total_product"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="total_product"></i>
                                        @endif
                                    </span>

                            </th>
                            <th class="white-space-200 text-center">

                                    Số loại sản phẩm niêm yết
                                    <span style="float: right;cursor: pointer">
                                        @if($field == 'users.id')
                                            @if($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="users.id"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="users.id"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="users.id"></i>
                                        @endif
                                    </span>

                            </th>
                            <th class="white-space-80">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $value)
                                <tr>
                                    <td class="white-space-140 text-center">{{$value->account_code}}</td>
                                    <td class="white-space-200 text-center">{{$value->vstore_name}}</td>
                                    <td class="text-center white-space-150">{{$value->phone_number}}</td>
                                    <td class="text-center white-space-150">{{$value->total_product}}</td>
                                    <td class="text-center white-space-150">{{$value->total_category}}</td>
                                    <td class="text-center white-space-80"><a href="javascript:void(0)" data-toggle="modal"
                                           data-target=".bd-example-modal-lg"
                                           data-account_code="{{$value->account_code}}"
                                           data-vstore_name="{{$value->vstore_name}}"
                                           data-phone_number="{{$value->phone_number}}"
                                           data-company_name="{{$value->company_name}}"
                                           data-address="{{$value->address}}"
                                           data-total_product="{{$value->total_product}}"
                                           data-total_category="{{$value->total_category}}"
                                           data-id="{{$value->vstore_id}}" class="btn btn-link more-details p-0" style="text-decoration:underline">Chi
                                            tiết</a>
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
                    {{$products->withQueryString()->links('layouts.custom.paginator')}}
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

@endsection


@section('modal')
    <div class="modal-order">
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="modal-order-oder">
        <form action="" method="POST">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-size: 20px;">Thông tin V-Store niêm yết sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Mã V-Store: </label>
                                        <input type="text" class="form-control form-control-lg" id="account_code"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tên V-Store:</label>
                                        <input type="text" class="form-control form-control-lg" id="name" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Số điện thoại V-Store:</label>
                                        <input type="text" class="form-control form-control-lg" id="phone" readonly>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tên công ty:</label>
                                        <input type="text" class="form-control form-control-lg" id="name_company"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Địa chỉ:</label>
                                        <input type="text" class="form-control form-control-lg" id="address" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tổng số sản phẩm niêm yết trên V-Store:</label>
                                        <input type="text" class="form-control form-control-lg" id="total-product"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Số loại sản phẩm niêm yết</label>
                                        <input type="text" class="form-control form-control-lg" id="total-category"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Tổng chiết khấu đã nhận</label>
                                        <input type="text" class="form-control form-control-lg"
                                               id="total-money-discount" readonly>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                            lại
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('custom_js')
    <script>
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
                        document.location = '{{route('screens.manufacture.partner.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    })
                });
            });
            document.querySelectorAll('.more-details').forEach(item => {
                item.addEventListener('click', (e) => {
                    $.ajax({
                        url: '{{route('screens.manufacture.partner.detail')}}',
                        data: {vstore_id: item.dataset.id},
                        success: function (result) {
                            if (result) {
                                $("#account_code").val(item.dataset.account_code);
                                $("#name").val(item.dataset.vstore_name);
                                $("#phone").val(item.dataset.phone_number);
                                $("#name_company").val(item.dataset.company_name);
                                $("#address").val(item.dataset.address);
                                $("#total-product").val(parseInt(item.dataset.total_product));
                                $("#total-category").val(item.dataset.total_category);
                                $("#total-money-discount").val(convertNumberVN(result.money)+ ' đ');
                            }
                        },
                    });
                })
            })

        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.partner.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
