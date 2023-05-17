@extends('layouts.admin.main')
@section('page_title','Quản lý yêu cầu xét duyệt sản phẩm')

@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <form action="" method="POST" id="form">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Chi tiết yêu cầu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @csrf
                    <div class="modal-body md-content">

                    </div>
                    <div class="modal-footer">
                        <button id="btnConfirm" class="btn btn-success">Duyệt sản phẩm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')

    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Quản lý sản phẩm</h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý sản phẩm</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu xét duyệt sản
                                    phẩm

                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                         style="gap:10px">
                        <h5 class="mb-0" style="font-size:18px;">Quản lý yêu cầu xét duyệt sản phẩm
                        </h5>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <form action="">
                                    <div id="custom-search" class="top-search-bar">
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <input type="hidden" name="field" value="{{$field}}">
                                        <input type="hidden" name="limit" value="{{$limit}}">
                                        <input type="search" name="key_search" value="{{$key_search}}"
                                               class="form-control"
                                               placeholder="Nhập từ khóa tìm kiếm">

                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="white-space-130 text-center">Mã yêu cầu</th>
                                    <th class="">Tên sản phẩm</th>
                                    <th class="white-space-130 text-center">Ngành hàng</th>
                                    <th class="white-space-130 text-center">Nhà cung cấp</th>
                                    <th class="white-space-130">
                                        <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    Chiết khấu cho <br> V-Store
</span>
                                            <span style="float: right;cursor: pointer">
                                                 @if($field == 'requests.discount')
                                                    @if($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort"
                                                           data-sort="requests.discount"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort"
                                                           data-sort="requests.discount"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="requests.discount"></i>
                                                @endif
                                </span>
                                        </div>
                                    </th>

                                    <th class="white-space-130">
                                        <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    Chiết khấu cho <br> V-Shop
</span>
                                            <span style="float: right;cursor: pointer">
                                                 @if($field == 'requests.discount_vShop')
                                                    @if($type == 'desc')
                                                        <i class="fa-solid fa-sort-down sort"
                                                           data-sort="requests.discount_vShop"></i>
                                                    @else
                                                        <i class="fa-solid fa-sort-up sort"
                                                           data-sort="requests.discount_vShop"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort sort" data-sort="requests.discount_vShop"></i>
                                                @endif
                                </span>
                                        </div>
                                    </th>
                                    <th class="white-space-100">
                                        <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    V-Store xét duyệt
</span>
                                    </th>
                                    <th class="white-space-120 text-center">Trạng thái
                                        <span style="float: right;cursor: pointer">
                                                 @if($field == 'requests.status')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort"
                                                       data-sort="requests.status"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort"
                                                       data-sort="requests.status"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="requests.status"></i>
                                            @endif
                                </span>
                                    </th>
                                    <th class="text-center white-space-120">Thao tác</th>
                                    <th class="white-space-80 text-center"></th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($requests) > 0)
                                    @foreach($requests as $request)
                                        <tr class="line-clamp3">
                                            <td class="text-center white-space-130">{{$request->code}}</td>
                                            <td class="white-space-300">{{$request->product_name}}</td>
                                            <td class="text-center white-space-150">{{$request->name}}</td>
                                            <td class="text-center font-medium white-space-130">{{$request->user_name}}</td>
                                            <td class="text-center white-space-100">{{$request->discount}}%</td>
                                            <td class="text-center white-space-100">{{$request->discount_vShop}}%</td>
                                            <td class="text-center white-space-100">
                                                <span>{{$request->vstore_name}}</span></td>
                                            <td class="text-center white-space-160">
                                                @if($request->status == 1)
                                                    <div class="text-warning  "
                                                         style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>Chờ
                                                        duyệt
                                                    </div>
                                                @elseif($request->status == 3)
                                                    <div class="text-success  "
                                                         style="border-radius: 2px;"><i class="fas fa-check mr-2"></i>Hệ
                                                        thống đã
                                                        duyệt
                                                    </div>
                                                @else
                                                    <div class="text-danger "
                                                         style="border-radius: 2px;"><i class="fas fa-times mr-2"></i>Hệ
                                                        thống từ
                                                        chối
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="white-space-180 flex justify-content-center align-items-center text-center"
                                                style="gap:6px">

                                                @if($request->status == 1)
                                                    <a href="javascript:void(0)"
                                                       onclick="appect({{$request->id}},{{$request->discount}},3,{{$request->discount_vShop}})"
                                                       class="btn text-primary font-medium px-2 py-0"
                                                       style="text-decoration:underline;">Duyệt
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                       onclick="unAppect({{$request->id}},{{$request->discount}},4,{{$request->discount_vShop}})"
                                                       class="btn text-danger font-medium px-2 py-0"
                                                       style="text-decoration:underline;">Từ chối
                                                    </a>
                                                @else
                                                    <p class="text-success"><i class="fas fa-check mr-2"></i>Đã xét
                                                        duyệt</p>
                                                @endif
                                            </td>
                                            <td class="white-space-80 text-center"><a href="javascript:void(0)"
                                                                                      class="btn btn-link p-0"
                                                                                      style="text-decoration: underline;"
                                                                                      onclick="showDetail({{$request->id}})"
                                                                                      data-toggle="modal"
                                                                                      data-target=".bd-example-modal-lg">Chi
                                                    tiết</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="10">Không có dữ liệu phù hợp</td>
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
            <!-- ============================================================== -->
            <!-- end data table  -->
            <!-- ============================================================== -->
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
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.admin.product.detail')}}?id=` + id,
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
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
                document.querySelector('#form').setAttribute('action', '{{route('screens.admin.product.confirm')}}/' + id)
            })


        }

        $(document).ready(function () {


            let limit = document.getElementById('limit');
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
                        document.location = '{{route('screens.admin.product.index')}}?type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    }, 200)
                });
            });
            limit.addEventListener('change', (e) => {
                setTimeout(() => {
                    document.location = '{{route('screens.admin.product.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                        '&field=' + '{{$field}}' + '&limit=' + e.target.value
                }, 200)
            })
        });

        function appect(id, discount, status, discount_vShop) {
            $('.md-content').html(`
 <div class="form-group">
               <label>Chiết khấu được từ nhà cung cấp</label>
<input class="form-control number" data-discount="${discount}" name="discount" id="discount" disabled value="${discount} %">
            </div>
            <div class="form-group">
               <label>Chiết khấu cho V-Shop</label>
<input class="form-control number-percent" name="discount_vShop" id="discount_vShop" value="${discount_vShop}" disabled>
            </div>
            `);
            document.querySelector('#form').setAttribute('action', '{{route('screens.admin.product.confirm')}}/' + id + '?status=' + status)
            $('#btnConfirm').html('Duyệt')
            $('#btnConfirm').css('display', 'block');
            $('#modalDetail').modal('show');

        }

        function unAppect(id, discount, status) {
            $('.md-content').html(`
 <div class="form-group">
              <label for="name">Lý do từ chối</label>
<textarea name="note" placeholder="Lý do từ chối"
                             class="form-control" ></textarea>
            </div>
            `);
            $('#btnConfirm').html('Từ chối')
            $('#btnConfirm').css('display', 'block');

            document.querySelector('#form').setAttribute('action', '{{route('screens.admin.product.confirm')}}/' + id + '?status=' + status)
            $('#modalDetail').modal('show');


        }
    </script>
@endsection
