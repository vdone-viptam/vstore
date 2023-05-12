@extends('layouts.manufacture.main')
@section('page_title', 'Tất cả sản phẩm')



@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý sản phẩm</a>
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
                                <input type="hidden" name="type" value="{{ $type }}">
                                <input type="hidden" name="field" value="{{ $field }}">
                                <input type="hidden" name="limit" value="{{ $limit }}">
                                <input name="key_search" value="{{ $key_search ?? '' }}" class="form-control"
                                       type="search"
                                       placeholder="Nhập từ khóa tìm kiếm...">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered second    ">
                        <thead>
                        <tr>
                            <th class="white-space-130 text-center">Mã sản phẩm</th>
                            <th class="text-center white-space-100">Hình ảnh</th>
                            <th>

                                    Tên sản phẩm

                            </th>
                            <th class="white-space-120 text-center">Ngành hàng
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
                            <th class="white-space-100">

                                    Giá bán
                                    <span style="float: right;cursor:pointer">
                                            @if ($field == 'price')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="price"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="price"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="price"></i>
                                        @endif
                                        </span>


                            </th>
                            <th class="white-space-130">
                            <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    Thuế giá trị <br> gia tăng
</span>
                                    <span style="float: right;cursor:pointer">
                                            @if ($field == 'vat')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="vat"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="vat"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="vat"></i>
                                        @endif
                                        </span>
</div>
                            </th>
                            <th class="white-space-120">

                                    Trạng thái
                                    <span style="float: right;cursor:pointer">
                                            @if ($field == 'status')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="status"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="status"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="status"></i>
                                        @endif
                                        </span>

                            </th>

                            <th class="white-space-140">

                                    V-Store niêm yết
                                    <span style="float: right;cursor: pointer">
                                            @if ($field == 'vstore_name')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="vstore_name"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="vstore_name"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="vstore_name"></i>
                                        @endif
                                        </span>

                            </th>
                            <th class="white-space-130">
                            <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    Chiết khấu cho <br> V-Store
</span>
                                    <span style="float: right;cursor: pointer">
                                            @if ($field == 'products.discount')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort"
                                                   data-sort="products.discount"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="products.discount"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="products.discount"></i>
                                        @endif
                                        </span>
</div>
                            </th>
                            <th class="white-space-120">
                            <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    Số lượng <br> đã bán
</span>
                                    <span style="float: right;cursor: pointer">
                                            @if ($field == 'amount_product_sold')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort"
                                                   data-sort="amount_product_sold"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort"
                                                   data-sort="amount_product_sold"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="amount_product_sold"></i>
                                        @endif
                                        </span>
</div>
                            </th>
                            <th class="white-space-120">
                            <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">
                                    Số lượng <br> trong kho
</span>
                                    <span style="float: right;cursor: pointer">
                                            @if ($field == 'amount')
                                            @if ($type == 'desc')
                                                <i class="fa-solid fa-sort-down sort" data-sort="amount"></i>
                                            @else
                                                <i class="fa-solid fa-sort-up sort" data-sort="amount"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort sort" data-sort="amount"></i>
                                        @endif
                                        </span>
</div>
                            </th>
                            <th class="white-space-80">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center white-space-140">{{ $product->publish_id }}</td>
                                    <td class="text-center white-space-100"><img class="img-fluid"
                                                                 src="{{ strlen(json_decode($product->images)[0]) > 0 ? asset(json_decode($product->images)[0]) : 'https://www.charlotteathleticclub.com/assets/camaleon_cms/image-not-found-4a963b95bf081c3ea02923dceaeb3f8085e1a654fc54840aac61a57a60903fef.png' }}"/>
                                    </td>
                                    <td class="white-space-250">{{ $product->name }}</td>
                                    <td class="text-center white-space-150">{{ $product->cate_name }}</td>
                                    <td class="text-right white-space-140">{{ number_format($product->price, 0, '.', '.') }} đ</td>
                                    <td class="text-center white-space-80">{{ isset($product->vat) ? $product->vat.'%' : '_'}}</td>
                                    <td class="text-center white-space-180">
                                        @if ($product->status == 0)
                                            <div class="text-danger d-flex justify-content-center align-items-center "
                                                 style="gap:6px;">
                                                <svg width="12" height="12" viewBox="0 0 12 12"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.2 12L0 10.8L4.8 6L0 1.2L1.2 0L6 4.8L10.8 0L12 1.2L7.2 6L12 10.8L10.8 12L6 7.2L1.2 12Z"
                                                        fill="#ef172c"/>
                                                </svg>
                                                Chưa xét duyệt
                                            </div>
                                        @elseif($product->status == 1)
                                            <div class="text-warning d-flex justify-content-center align-items-center "
                                                 style="gap:6px;">
                                                <svg width="14" height="14" viewBox="0 0 14 14"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 12.6C8.48521 12.6 9.90959 12.01 10.9598 10.9598C12.01 9.90959 12.6 8.48521 12.6 7C12.6 5.51479 12.01 4.09041 10.9598 3.0402C9.90959 1.99 8.48521 1.4 7 1.4C5.51479 1.4 4.09041 1.99 3.0402 3.0402C1.99 4.09041 1.4 5.51479 1.4 7C1.4 8.48521 1.99 9.90959 3.0402 10.9598C4.09041 12.01 5.51479 12.6 7 12.6ZM7 0C7.91925 0 8.8295 0.18106 9.67878 0.532843C10.5281 0.884626 11.2997 1.40024 11.9497 2.05025C12.5998 2.70026 13.1154 3.47194 13.4672 4.32122C13.8189 5.17049 14 6.08075 14 7C14 8.85651 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85651 14 7 14C3.129 14 0 10.85 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0ZM7.35 3.5V7.175L10.5 9.044L9.975 9.905L6.3 7.7V3.5H7.35Z"
                                                        fill="#ff8d00"/>
                                                </svg>
                                                Đang chờ xét duyệt
                                            </div>
                                        @elseif($product->status == 2)
                                            <div class="text-success d-flex justify-content-center align-items-center "
                                                 style="gap:6px;">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="#005d1d"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Đã xét duyệt
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center white-space-150">{{ $product->vstore_name && $product->status == 2 ? $product->vstore_name : '' }}
                                    </td>
                                    <td class="text-center white-space-80">{{ $product->discount != null ? $product->discount.'%' : '_' }}
                                    </td>

                                    <td class="text-center white-space-80">
                                        {{ number_format($product->amount_product_sold, 0, '.', '.') }}</td>
                                    <td class="text-center white-space-80">{{ number_format($product->amount, 0, '.', '.') }}</td>
                                    <td class="white-space-80 text-center">
                                        <button type="button" class="btn btn-link p-0" style="text-decoration:underline"
                                                onclick="showDetail({{ $product->id }})">Chi tiết
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12" class="text-center">Không tìm thấy dữ liệu phù hợp</td>
                            <tr>
                        @endif
                    </table>

                </div>
                <div class="d-flex align-items-center justify-content-end mt-4">
                    {{ $products->withQueryString()->links('layouts.custom.paginator') }}
                    <div class=" ml-4">
                        <div class="form-group">
                            <select class="form-control" id="limit">
                                <option value="10" {{ $limit == 10 ? 'selected' : '' }}>10 hàng / trang</option>
                                <option value="25" {{ $limit == 25 ? 'selected' : '' }}>25 hàng / trang</option>
                                <option value="50" {{ $limit == 50 ? 'selected' : '' }}>50 hàng / trang</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('custom_js')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ \Illuminate\Support\Facades\Session::get('error') }}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{ route('screens.manufacture.product.detail') }}?product_id=` + id + '&product=true',
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
                    htmlData = data.data;
                    $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');
                    if (data.status == 2 || data.status == 1) {
                        $(".btnDelete").html('');
                    } else {
                        document.querySelector('.btnDestroy').innerHTML = ``;
                        $(".btnDelete").html(
                            `<a class="btn btn-warning btnEdit mx-2" href="{{ route('screens.manufacture.product.edit') }}/${data.id}">Sửa sản phẩm</a><a href="{{ route('screens.manufacture.product.destroy') }}/${data.id}"  class="btn btn-danger">Xóa sản phẩm</a>`
                        );
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

        let limit = document.getElementById('limit');
        $(document).ready(function () {
            document.querySelectorAll('.sort').forEach(item => {
                const {
                    sort
                } = item.dataset;
                item.addEventListener('click', () => {
                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                    if (orderBy === 'asc') {
                        localStorage.setItem('orderBy', JSON.stringify('desc'));
                    } else {
                        localStorage.setItem('orderBy', JSON.stringify('asc'));
                    }
                    setTimeout(() => {
                        document.location =
                            '{{ route('screens.manufacture.product.index', ['key_search' => $key_search]) }}&type=' +
                            orderBy +
                            '&field=' + sort + '&limit=' + limit.value
                    }, 200)
                });
            });
        });

        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location =
                    '{{ route('screens.manufacture.product.index', ['key_search' => $key_search]) }}&type=' +
                    '{{ $type }}' +
                    '&field=' + '{{ $field }}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>

@endsection
