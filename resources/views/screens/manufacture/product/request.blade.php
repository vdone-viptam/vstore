@extends('layouts.manufacture.main')
@section('page_title','Quản lý yêu cầu xét duyệt')



@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
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
                <h2 class="pageheader-title">Quản lý yêu cầu xét duyệt</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu xét duyệt</li>
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
                <h5 class="mb-0" style="font-size:18px;">Quản lý yêu cầu xét duyệt</h5>
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
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th>Mã yêu cầu</th>
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
                            <th>Ngành hàng
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'brand')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="brand"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="brand"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="brand"></i>
                                    @endif
                                </span>
                            </th>

                            <th>Ngày yêu cầu
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'requests.created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="requests.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="requests.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="requests.created_at"></i>
                                    @endif
                                </span>
                            </th>
                            <th>V-Store niêm yết
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'users.name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="users.name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="users.name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="users.name"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Trạng thái yêu cầu
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'requests.status')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="requests.status"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="requests.status"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="requests.status"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-90"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $request)
                                <tr>
                                    <td>
                                        {{$request->code}}
                                    </td>
                                    <td class="white-space-400">
                                        {{$request->product_name}}
                                    </td>
                                    <td>
                                        {{$request->name}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($request->created_at)->format('d/m/Y')}}
                                    </td>
                                    <td>
                                        {{$request->user_name}}
                                    </td>
                                    <td class="w-[200px]">
                                        @if($request->status == 0)
                                            <div class="bg-warning text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>Chờ
                                                Đang xét duyệt lên V-Store
                                            </div>
                                        @elseif($request->status == 1)
                                            <div class="bg-warning text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>Chờ
                                                V-Store đồng ý - chờ hệ thống duyệt
                                            </div>
                                        @elseif($request->status == 2)
                                            <div class="bg-danger text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-times mr-2"></i>V-Store từ
                                                chối
                                            </div>
                                        @elseif($request->status == 3)
                                            <div class="bg-success text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-check mr-2"></i>Hệ thống
                                                đã duyệt
                                            </div>
                                        @else
                                            <div class="bg-danger text-white font-medium px-4 py-2"
                                                 style="border-radius: 2px;"><i class="fas fa-times mr-2"></i>Hệ thống
                                                từ chối
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-link" type="button"
                                                onclick="showDetail({{$request->id}})">Chi tiết
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-center justify-content-end mt-4">
                    {{$requests->withQueryString()->links('layouts.custom.paginator')}}
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

@section('custom_js')
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.manufacture.product.detail')}}?id=` + id,
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Xem chi tiết sản phẩm thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = `${data.view}`;

                $('.md-content').html(htmlData)
                $('#modalDetail').modal('show');
            })


        }

        let limit = document.getElementById('limit');
        console.log(limit)
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
                        document.location = '{{route('screens.manufacture.product.request',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.manufacture.product.request',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>

@endsection
