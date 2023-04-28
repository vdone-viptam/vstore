@extends('layouts.storage.main')
@section('page_title','Tất cả sản phẩm')



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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tất cả sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Hàng hóa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
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
                <h5 class="mb-0" style="font-size:18px;">Tất cả sản phẩm</h5>
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

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center white-space-120">Mã sản phẩm</th>
                            <th class="text-center white-space-100">Mã SKU</th>
                            <th>
                            <div class="d-flex justify-content-between align-items-center" style="gap:6px">    
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
                            <th class="white-space-120 text-center">Danh mục
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'cate_name')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="cate_name"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="cate_name"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="cate_name"></i>
                                    @endif
                                </span>
                            </th>

                            <th class="white-space-120 text-center">Nhà cung cấp
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
                            <th class="white-space-100 text-center">Tồn kho
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'in_stock')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="in_stock"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="in_stock"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="in_stock"></i>
                                    @endif
                                </span>
                            </th>

                            <th class="text-center" style="min-width:180px !important;">Số lượng chờ xuất
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'pause_product')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="pause_product"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="pause_product"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="pause_product"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-100"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <tr>
                                    <td class="white-space-150 text-center">{{$product->publish_id}}</td>
                                    <td class="white-space-100 text-center">{{$product->sku_id}}</td>
                                    <td title="{{$product->product_name}}">{{\Illuminate\Support\Str::limit($product->product_name,50,'...')}}</td>
                                    <td class="text-center">{{$product->cate_name}}</td>
                                    <td class="text-center">{{$product->name}}</td>
                                    <td class="text-center">{{$product->in_stock ?? 0}}</td>
                                    <td class="text-center">{{$product->pause_product}}</td>
                                    <td><a href="javascript:void(0)" onclick="showDetail({{$product->product_id}})" class="btn btn-link px-2" style="text-decoration:underline;">Chi
                                            tiết</a></td>
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
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$products->withQueryString()->links('layouts.custom.paginator')}}
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
                url: `{{route('screens.storage.product.detail')}}?product_id=` + id,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                var htmlData = ``;

                if (data.data) {
                    htmlData += `   <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Mã sản phẩm: </h5>
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
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Mã SKU sản phẩm: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.sku_id}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Danh mục sản phẩm: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.cate_name}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Nhà cung cấp: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.name}</span>
                        </div>
               </div>
               <div class="row">
                        <div class="col-5">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Tồn kho: </h5>
                        </div>
                        <div class="col-7">
                            <span style="color:#000">${data.data.in_stock}</span>
                        </div>
               </div>
               <div class="row">
                        ${data.data.ex_im.length != 0 ? `<div class="col-6">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Số lượng chờ xuất: <span class="text-danger" style="font-weight:500">${data.data.ex_im[0] ? data.data.ex_im[0].total : 'Không có'}</span></h5>
                        </div>
                        <div class="col-6">
                            <h5 style="font-size:16px; white-space:nowrap; font-weight:600">Số lượng chờ nhập: <span class="text-success" style="font-weight:500">${data.data.ex_im[1] ? data.data.ex_im[1].total : 'Không có'}</span></h5>
                        </div>` : `<div class="col-5"><h5 style="font-size:16px; white-space:nowrap; font-weight:600">Trạng thái nhập xuất: </h5>
                            </div>
                        <div class="col-7"><span style="color:#000; font-size:14px; font-weight:400">Không có thông tin</span>
            `}

               </div>

                        `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu của sản phẩm!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })


        }

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
                        document.location = '{{route('screens.storage.product.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>

@endsection
