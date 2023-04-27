@extends('layouts.admin.main')
@section('page_title','Quản lý yêu cầu xét duyệt sản phẩm')

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
                                <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu xét duyệt sản phẩm

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
                                <div id="custom-search" class="top-search-bar">
                                    <input class="form-control" type="search" placeholder="Tìm kiếm..">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Mã yêu cầu</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ngành hàng</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Chiết khấu cho V-Store</th>
                                    <th>V-Store xét duyệt</th>
                                    <th>Chiết khấu cho V-Shop</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr class="line-clamp3">
                                    <td>SP123123123</td>
                                    <td>Giày nam Nike</td>
                                    <td>Giày dép</td>
                                    <td>ACV Deep</td>
                                    <td><span class="text-primary">10%</span></td>
                                    <td><span class="text-success">5%</span></td>
                                    <td><span class="text-success">3%</span></td>
                                    <td>
                                        <div class="bg-warning text-white font-medium px-4 py-2"
                                             style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>Chờ V-Store
                                            duyệt
                                        </div>
                                    </td>
                                    <td class="flex justify-content-center align-items-center" style="gap:6px">
                                        <button class="btn btn-primary">Duyệt</button>
                                        <button class="btn btn-danger">Từ chối</button>
                                    </td>
                                    <td><a href="javascript:void(0)" style="text-decoration: underline;"
                                           data-toggle="modal" data-target=".bd-example-modal-lg">Chi tiết</a></td>
                                </tr>
                                <tr class="line-clamp3">
                                    <td>SP123123123</td>
                                    <td>Giày nam Nike</td>
                                    <td>Giày dép</td>
                                    <td>ACV Deep</td>
                                    <td><span class="text-primary">10%</span></td>
                                    <td><span class="text-success">5%</span></td>
                                    <td><span class="text-success">3%</span></td>
                                    <td>
                                        <div class="bg-warning text-white font-medium px-4 py-2"
                                             style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>V-Store từ
                                            chối
                                        </div>
                                    </td>
                                    <td class="flex justify-content-center align-items-center" style="gap:6px">
                                        <button class="btn btn-primary">Duyệt</button>
                                        <button class="btn btn-danger">Từ chối</button>
                                    </td>
                                    <td><a href="javascript:void(0)" style="text-decoration: underline;"
                                           data-toggle="modal" data-target=".bd-example-modal-lg">Chi tiết</a></td>
                                </tr>
                                <tr class="line-clamp3">
                                    <td>SP123123123</td>
                                    <td>Giày nam Nike</td>
                                    <td>Giày dép</td>
                                    <td>ACV Deep</td>
                                    <td><span class="text-primary">10%</span></td>
                                    <td><span class="text-success">5%</span></td>
                                    <td><span class="text-success">3%</span></td>
                                    <td>
                                        <div class="bg-warning text-white font-medium px-4 py-2"
                                             style="border-radius: 2px;"><i class="fas fa-clock mr-2"></i>Chờ hệ thống
                                            duyệt
                                        </div>
                                    </td>
                                    <td class="flex justify-content-center align-items-center" style="gap:6px">
                                        <button class="btn btn-primary">Duyệt</button>
                                        <button class="btn btn-danger">Từ chối</button>
                                    </td>
                                    <td><a href="javascript:void(0)" style="text-decoration: underline;"
                                           data-toggle="modal" data-target=".bd-example-modal-lg">Chi tiết</a></td>
                                </tr>
                                <tr class="line-clamp3">
                                    <td>SP123123123</td>
                                    <td>Giày nam Nike</td>
                                    <td>Giày dép</td>
                                    <td>ACV Deep</td>
                                    <td><span class="text-primary">10%</span></td>
                                    <td><span class="text-success">5%</span></td>
                                    <td><span class="text-success">3%</span></td>
                                    <td>
                                        <div class="bg-success text-white font-medium px-4 py-2"
                                             style="border-radius: 2px;"><i class="fas fa-check mr-2"></i>Hệ thống đã
                                            duyệt
                                        </div>
                                    </td>
                                    <td class="flex justify-content-center align-items-center" style="gap:6px">
                                    </td>
                                    <td><a href="javascript:void(0)" style="text-decoration: underline;"
                                           data-toggle="modal" data-target=".bd-example-modal-lg">Chi tiết</a></td>
                                </tr>
                                <tr class="line-clamp3">
                                    <td>SP123123123</td>
                                    <td>Giày nam Nike</td>
                                    <td>Giày dép</td>
                                    <td>ACV Deep</td>
                                    <td><span class="text-primary">10%</span></td>
                                    <td><span class="text-success">5%</span></td>
                                    <td><span class="text-success">3%</span></td>
                                    <td>
                                        <div class="bg-danger text-white font-medium px-4 py-2"
                                             style="border-radius: 2px;"><i class="fas fa-times mr-2"></i>Hệ thống từ
                                            chối
                                        </div>
                                    </td>
                                    <td class="flex justify-content-center align-items-center" style="gap:6px">

                                    </td>
                                    <td><a href="javascript:void(0)" style="text-decoration: underline;"
                                           data-toggle="modal" data-target=".bd-example-modal-lg">Chi tiết</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2 float-right mt-4">
                            <form>
                                <div class="form-group">
                                    <select class="form-control form-control-lg">
                                        <option>10 phần tử / trang</option>
                                        <option>25 phần tử / trang</option>
                                        <option>50 phần tử / trang</option>
                                    </select>
                                </div>
                            </form>
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

    {{--    <script>--}}

    {{--        document.getElementsByName('start_date')[0].addEventListener('change', (e) => {--}}
    {{--            document.getElementsByName('end_date')[0].setAttribute('min', e.target.value);--}}
    {{--        });--}}
    {{--        const name = document.getElementById('name');--}}
    {{--        const id = document.getElementById('id');--}}
    {{--        const limit = document.getElementById('limit');--}}
    {{--        const form = document.getElementById('form');--}}
    {{--        $(document).keypress(function (event) {--}}
    {{--            var keycode = (event.keyCode ? event.keyCode : event.which);--}}
    {{--            if (keycode == '13') {--}}
    {{--                location.href = "{{route('screens.admin.finance.index')}}?start_date=" + $('#start_date').val() + '&end_date=' + $('#end_date').val();--}}
    {{--            }--}}
    {{--        });--}}
    {{--        limit.addEventListener('change', (e) => {--}}
    {{--            form.submit();--}}
    {{--        });--}}
    {{--    </script>--}}

    <script>
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
                        document.location = '{{route('screens.admin.product.all')}}?type=' + orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    }, 200)
                });
            });
            limit.addEventListener('change', (e) => {
                setTimeout(() => {
                    document.location = '{{route('screens.admin.product.all',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                        '&field=' + '{{$field}}' + '&limit=' + e.target.value
                }, 200)
            })
        });

    </script>
@endsection
