@extends('layouts.vstore.main')
@section('page_title','Danh sách Vshop liên kết')

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Danh sách V-Shop liên kết</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Đối tác</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách V-Shop liên kết</li>
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
                <h5 class="mb-0" style="font-size:18px;">Danh sách Vshop liên kết</h5>
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
                    <table id="example" class="table table-striped table-bordered second">
                        <thead>
                        <tr>
                            <th class="white-space-100 text-center">Mã V-Shop</th>
                            <th class="text-center">Tên V-Shop

                            </th>
                            <th class="white-space-200 text-center">Số sản phẩm tiếp thị
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'amount_product')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="amount_product"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="amount_product"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="amount_product"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-200 text-center">Đơn hàng hoàn thành
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'count_order')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="count_order"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="count_order"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="count_order"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="white-space-200 text-center">Doanh thu
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'doanh_thu')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="doanh_thu"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="doanh_thu"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="doanh_thu"></i>
                                    @endif
                                </span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($vshop) > 0)
                            @foreach($vshop as $value)
                                <tr>

                                    <td class="text-center white-space-130">{{$value->vshop_id}}</td>
                                    <td class="td_name white-space-400">{{$value->nick_name}}</td>
                                    <td class="text-center white-space-200">{{number_format($value->amount_product,0,'.','.')}}</td>
                                    <td class="text-center white-space-300">{{number_format($value->count_order,0,'.','.') }}</td>
                                    <td class="text-right white-space-130">{{number_format($value->doanh_thu,0,'.','.')}} đ</td>
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
                    {{$vshop->withQueryString()->links('layouts.custom.paginator')}}
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
        console.log(document.querySelectorAll('.sort'))
        $(document).ready(function () {
            document.querySelectorAll('.sort').forEach(item => {
                const {sort} = item.dataset;

                item.addEventListener('click', () => {
                    console.log(sort)
                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';
                    if (orderBy === 'asc') {
                        localStorage.setItem('orderBy', JSON.stringify('desc'));
                    } else {
                        localStorage.setItem('orderBy', JSON.stringify('asc'));
                    }
                    setTimeout(() => {
                        document.location = '{{route('screens.vstore.partner.vshop',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
        let limit = document.getElementById('limit');
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.vstore.partner.vshop',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
@endsection
