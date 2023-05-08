@extends('layouts.admin.main')
@section('page_title','Tất cả sản phẩm')

@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <form action="" method="POST" id="form">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @csrf
                    <div class="modal-body md-content">

                    </div>
                    <div class="modal-footer">
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
                    <h2 class="pageheader-title">Tất cả sản phẩm</h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý sản phẩm</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm
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
                        <h5 class="mb-0" style="font-size:18px;">Tất cả sản phẩm
                        </h5>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <form>
                                    <input type="hidden" name="type" value="{{$type}}">
                                    <input type="hidden" name="field" value="{{$field}}">
                                    <input type="hidden" name="limit" value="{{$limit}}">
                                    <input type="search" name="key_search" value="{{$key_search}}"
                                           class="form-control"
                                           placeholder="Nhập từ khóa tìm kiếm">
                                </form>

                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                <thead>
                                <tr>
                                    <th  class="white-space-130 text-center">Mã sản phẩm

                                    </th>
                                    <th >Tên sản phẩm
                                    </th>
                                    <th class="white-space-130 text-center">Ngành hàng
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'category_name')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="category_name"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="category_name"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="category_name"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th class="white-space-130 text-center">Nhà cung cấp
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'name')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="name"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="name"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="name"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th class="white-space-130 text-center">
                                    <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">   
                                    Chiết khấu cho <br> V-Store
</span>
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'discount')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort" data-sort="discount"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="discount"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="discount"></i>
                                            @endif
                                        </span>
</div>
                                    </th>
                                    <th class="white-space-100 text-center">
                                    <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">    
                                    V-Store xét duyệt
</span>
</div>
                                </th>
                                    <th class="white-space-130 text-center">
                                    <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">    
                                    Chiết khấu cho <br> V-Shop
</span>
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'discount_vShop')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort"
                                                       data-sort="discount_vShop"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort" data-sort="discount_vShop"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="discount_vShop"></i>
                                            @endif
                                        </span>
</div>
                                    </th>
                                    <th  class="white-space-100 text-center">
                                    <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-70">    
                                    Số lượng <br> trong kho
</span>
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
</div>
                                    </th>
                                    <th  class="white-space-100 text-center">
                                    <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-70">    
                                    Số lượng <br> đã bán
</span>
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'amount_product_sold')
                                                @if($type == 'desc')
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
                                    <th  class="white-space-130 text-center">Ngày niêm yết
                                        <span style="float: right;cursor: pointer">
                                            @if($field == 'admin_confirm_date')
                                                @if($type == 'desc')
                                                    <i class="fa-solid fa-sort-down sort"
                                                       data-sort="admin_confirm_date"></i>
                                                @else
                                                    <i class="fa-solid fa-sort-up sort"
                                                       data-sort="admin_confirm_date"></i>
                                                @endif
                                            @else
                                                <i class="fas fa-sort sort" data-sort="admin_confirm_date"></i>
                                            @endif
                                        </span>
                                    </th>
                                    <th  class="white-space-80"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $pro)
                                    <tr class="line-clamp3">
                                        <td class="text-center white-space-140">{{$pro->publish_id}}</td>
                                        <td class="white-space-250">{{$pro->product_name}}</td>
                                        <td class="text-center white-space-130">{{$pro->category_name}}</td>
                                        <td class="font-medium text-center white-space-150">{{$pro->name}}</td>
                                        <td class="text-center white-space-100">{{$pro->discount}}%</td>
                                        <td class="text-center white-space-130" style="text-transform: uppercase;">{{$pro->vstore_name}}</td>
                                        <td class="text-center white-space-100">{{$pro->discount_vShop ??0}}%</td>
                                        @if($pro->amount >= 0 )
                                            <td class="text-center white-space-100" style=" white-space: pre-wrap;">{{number_format($pro->amount,0,'.','.')}}</td>
                                        @else
                                            <td class="text-center white-space-100" style=" white-space: pre-wrap;">0</td>
                                        @endif

                                        <td class="text-center white-space-100">{{number_format($pro->amount_product_sold,0,'.','.')}}</td>
                                        <td class="text-center white-space-130">
                                            {{ Carbon\Carbon::parse($pro->admin_confirm_date)->format('d/m/Y H:i')  }}
                                        </td>
                                        <td class=" white-space-80 text-center"><a href="javascript:void(0)" class="btn btn-link p-0" style="text-decoration: underline;"
                                               onclick="showDetail({{$pro->id}})"
                                               data-toggle="modal" data-target=".bd-example-modal-lg">Chi tiết</a>

                                    </tr>
                                @endforeach


                                {{--                                <tr class="line-clamp3">--}}
                                {{--                                    <td>G1231232</td>--}}
                                {{--                                    <td>VN123123123</td>--}}
                                {{--                                    <td class="font-medium">1.000.000đ</td>--}}
                                {{--                                    <td>19038334966011</td>--}}
                                {{--                                    <td style="text-transform: uppercase;">TRAN THANH KHOA</td>--}}
                                {{--                                    <td>Techcombank</td>--}}
                                {{--                                    <td style="min-width: 400px; white-space: pre-wrap;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse dolor ratione et perspiciatis, maxime veniam earum soluta illo quae impedit eveniet adipisci fuga fugit a. Beatae suscipit totam nobis corrupti!</td>--}}
                                {{--                                    <td>10/04/2023</td>--}}
                                {{--                                    <td><span class="text-success font-medium">Thành công</span></td>--}}
                                {{--                                </tr>--}}

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
            <!-- ============================================================== -->
            <!-- end data table  -->
            <!-- ============================================================== -->
        </div>
    </div>

@endsection

@section('custom_js')
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.admin.product.detail')}}?id=` + id + '&type=2',
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
                document.querySelector('#form').setAttribute('action', '#')
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
                        document.location = '{{route('screens.admin.product.all',['key_search' => $key_search])}}&type=' + orderBy +
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
