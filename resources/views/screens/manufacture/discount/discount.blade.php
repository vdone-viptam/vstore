@extends('layouts.manufacture.main')
@section('page_title','Quản lý giảm giá')



@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <form action="" id="form-AC" method="POST">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Sửa mã giảm giá</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body md-content">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btnSubmit" id="btnAC"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Quản lý giảm giá</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý giảm giá</li>
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
                <h5 class="mb-0" style="font-size:18px;">Quản lý giảm giá</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input name="key_search" value="" class="form-control"
                                       type="search"
                                       placeholder="Tìm kiếm..">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" id="btnA" class="btn btn-primary my-2">
                        Thêm mới giảm giá
                    </button>
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th class="white-space-50">STT</th>
                            <th>Tên sản phẩm
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
                            <th>Phần trăm giảm giá
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discounts.discount')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discounts.discount"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discounts.discount"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discounts.discount"></i>
                                    @endif
                                </span>
                            </th>

                            <th>Ngày bắt đầu
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discounts.start_date')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discounts.start_date"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discounts.start_date"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discounts.start_date"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Ngày kết thúc
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discounts.end_date')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discounts.end_date"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discounts.end_date"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discounts.end_date"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Ngày tạo
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'discounts.created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="discounts.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="discounts.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="discounts.created_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-100">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @if(count($discounts) > 0)
                            @foreach($discounts as $discount)
                                <tr>
                                    <td class="white-space-50 text-center">{{$loop->iteration}}</td>
                                    <td class="white-space-500">{{$discount->name}}</td>
                                    <td class="text-center">{{$discount->discount}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($discount->start_date)->format('d/m/Y')}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($discount->end_date)->format('d/m/Y')}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($discount->created_at)->format('d/m/Y')}}</td>
                                    <td class="white-space-100 text-center"><a href="#" data-id="{{$discount->id}}"
                                           class="btn btn-warning more-details"
                                           onclick="edit({{$discount->id}})">Sửa</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$discounts->withQueryString()->links('layouts.custom.paginator')}}
                    <div class="mt-4 ml-4">
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
                        document.location = '{{route('screens.manufacture.product.discount',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
        });

        document.querySelector('#btnA').addEventListener('click', async () => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.product.createDis')}}`,
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Thêm mới giảm giá thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = ``;

                if (data.view) {
                    htmlData += data.view;
                    $('.md-content').html(htmlData)
                    document.getElementById('form-AC').setAttribute('action', '{{route('screens.manufacture.product.createDis')}}')
                    $("#btnAC").html('Thêm mới');
                    $('#modalDetail').modal('show');

                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })
        });

        const edit = async (id) => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.product.editDis')}}?id=` + id,
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Thêm mới giảm giá thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = ``;

                if (data.view) {
                    htmlData += data.view;
                    $('.md-content').html(htmlData)
                    $("#btnAC").html('Lưu thay đổi');
                    $('#modalDetail').modal('show');
                    document.getElementById('form-AC').setAttribute('action', '{{route('screens.manufacture.product.updateDis')}}/' + id)
                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })
        };
        let limit = document.getElementById('limit');
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.product.discount',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>

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
@endsection
