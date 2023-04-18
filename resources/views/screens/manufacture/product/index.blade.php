@extends('layouts.manufacture.main')
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

                    <div class="btnDelete">
                        <button class="btn btn-danger">Xóa sản phẩm</button>
                        <a class="btn btn-warning btnEdit" href="">Sửa sản phẩm</a>
                    </div>
                    <div class="btnDestroy"></div>
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
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sản phẩm</a>
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
                            <form>
                                <input name="key_search" value="{{$key_search ?? ''}}" class="form-control"
                                       type="search"
                                       placeholder="Tìm kiếm..">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <a href="" class="btn btn-success my-2">Thêm sản phẩm vào kho</a>
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Hình ảnh</th>
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
                            <th>Thương hiệu
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

                            <th>Ngành hàng
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
                            <th>Giá bán
                                <span style="float: right;cursor:pointer">
                                    @if($field == 'price')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="price"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="price"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="price"></i>
                                    @endif
                                </span>
                            </th>

                            <th>V-Store niêm yết
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
                            <th>Số lượng sản phẩm
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
                            <th>Số lượng đã bán
                                @if($field == 'amount_product_sold')
                                    @if($type == 'desc')
                                        <i class="fa-solid fa-sort-down sort" data-sort="amount_product_sold"></i>
                                    @else
                                        <i class="fa-solid fa-sort-up sort" data-sort="amount_product_sold"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort sort" data-sort="amount_product_sold"></i>
                                    @endif
                                    </span>
                            </th>
                            <th>
                                Chức năng
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->publish_id}}</td>
                                    <td class="text-center"><img style="height: 125px;"
                                                                 src="{{strlen(json_decode($product->images)[0]) > 0 ?  asset(json_decode($product->images)[0]) : 'https://www.charlotteathleticclub.com/assets/camaleon_cms/image-not-found-4a963b95bf081c3ea02923dceaeb3f8085e1a654fc54840aac61a57a60903fef.png'}}"/>
                                    </td>
                                    <td class="td_name">{{$product->name}}</td>
                                    <td>{{$product->brand}}</td>
                                    <td>{{$product->cate_name}}</td>
                                    <td>{{number_format($product->price,0,'.','.')}} đ</td>
                                    <td>{{$product->vstore_name ?? 'Sản phẩm chưa niêm yết'}}</td>
                                    <td>{{number_format($product->amount,0,'.','.')}}</td>
                                    <td>{{number_format($product->amount_product_sold,0,'.','.')}}</td>
                                    <td>
                                        <button type="button" class="btn btn-link"
                                                onclick="showDetail({{$product->id}})">Chi tiết
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
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$products->withQueryString()->links()}}
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
                url: `{{route('screens.manufacture.product.detail')}}?product_id=` + id + '&product=true',
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
                var htmlData = ``;

                if (data.data) {
                    htmlData += `
<form method="post" key=${id}>


                                <div class="form-group">
                            <label for="name">Mã sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" disabled id="code" value="${data.data.publish_id}" readonly>
                        </div>


                                <div class="form-group">
                            <label for="publish_id">Tên sản phẩm:</label>
                            <input type="text" class="form-control form-control-lg" disabled id="publish_id" value="${data.data.name}" readonly>

                            </div>

                                <div class="form-group">
                            <label for="product_name">Giá bán:</label>
                            <input type="text" class="form-control form-control-lg" disabled id="product_name" value="${data.data.price}" readonly>
                            </div>
                     <div class="row">
                        <div class="form-group col-6">
                            <label for="quantity">VAT: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="quantity" value="${data.data.vat}" readonly>
                        </div>

                        <div class="form-group col-6">
                            <label for="quantity">Thương hiệu:</label>
                            <input type="text" class="form-control form-control-lg" disabled id="quantity" value="${data.data.brand}" readonly>
                        </div>
</div>

                        <div class="form-group">
                            <label for="created_at">Ngành hàng: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="created_at" value="${data.data.cate_name}" readonly>
                        </div>
                       <div class="row">
 <div class="form-group col-6">
                            <label for="created_at">Chiết khấu V-Store nhận được: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="created_at" value="${data.data.discount}" readonly>
                        </div>
                         <div class="form-group col-6">
                            <label for="created_at">Chiết khấu V-Shop nhận được: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="created_at" value="${data.data.disount_vShop || 0}" readonly>
                        </div>

</div>
   <div class="form-group">
                            <label for="created_at">Số sản phẩm đã bán: </label>
                            <input type="text" class="form-control form-control-lg" disabled id="created_at" value="${data.data.amount_product_sold}" readonly>
                        </div>
                   </form>

                        `;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                    if (data.data.availability_status == 1) {
                        document.querySelector('.btnDestroy').innerHTML =
                            `<button class="btn btn-danger">Hủy niêm yết</button>

`;
                        $(".btnDelete").html('');
                    } else {
                        document.querySelector('.btnDestroy').innerHTML = ``;
                        $(".btnDelete").html('<a class="btn btn-warning btnEdit mx-2" href="">Sửa sản phẩm</a><button  class="btn btn-danger">Xóa sản phẩm</button>');
                    }
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
                        document.location = '{{route('screens.manufacture.product.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>

@endsection
