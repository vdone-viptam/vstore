@extends('layouts.vstore.main')
@section('page_title','Danh sách NCC liên kết')

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Liên kết NCC</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('screens.vstore.partner.index')}}"
                                                           class="breadcrumb-link">Liên kết NCC</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách NCC liên kết</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Danh sách NCC liên kết</h5>
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
                    <table id="example" class="table table-striped table-bordered second">
                        <thead>
                        <tr>
                            <th>Mã nhà cung cấp</th>
                            <th>Tên nhà cung cấp

                            </th>
                            <th>Số điện thoại

                            </th>
                            <th>Khu vực

                            </th>
                            <th class="white-space-150">Tổng số sản phẩm

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
                            </th>
                            <th class="white-space-150">Sản phẩm liên kết
                                <span style="float: right;cursor: pointer">
                                @if($field == 'amount_product_sold')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="countProduct"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="countProduct"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="countProduct"></i>
                                    @endif
                                </span>
                            </th>
                            <th>Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $value)
                                <tr>
                                    {{--                                    <td>{{$value->publish_id}}</td>--}}
                                    {{--                                    <td class="td_name">{{$value->name}}</td>--}}
                                    {{--                                    <td>{{ number_format($value->price,0,',','.')  }}</td>--}}
                                    {{--                                    <td>{{$value->vstore_name}}</td>--}}
                                    {{--                                    <td>{{$value->discount}}</td>--}}
                                    {{--                                    <td>{{$value->amount_product_sold != null ? $value->amount_product_sold: '-'}}</td>--}}
                                    {{--                                    <td></td>--}}
                                    <td>{{$value->account_code}}</td>
                                    <td class="td_name">{{$value->name}}</td>
                                    <td>{{$value->phone_number}}</td>
                                    <td>{{$value->khu_vuc }}</td>
                                    <td class="text-right"> {{number_format($value->amount,0,'.','.')}}</td>
                                    <td class="text-right">{{number_format($value->countProduct,0,'.','.')}}</td>
                                    <td>
                                        <button type="button" class="btn btn-link"
                                                onclick="showDetail({{$value->id}})">Chi tiết
                                        </button>
                                    </td>
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
                    {{$users->withQueryString()->links()}}
                    <div class="mt-4">
                        <form>
                            <div class="form-group">
                                <select class="form-control" id="limit">
                                    <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 phần tử/trang</option>
                                    <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 phần tử/trang</option>
                                    <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 phần tử/trang</option>
                                </select>
                            </div>
                        </form>
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
                        document.location = '{{route('screens.vstore.partner.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
        });
        let limit = document.getElementById('limit');
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.vstore.partner.index',['key_search' => $key_search])}}&type=' + '{{$type}}' +
                    '&field=' + '{{$field}}' + '&limit=' + e.target.value
            }, 200)
        })
    </script>
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.vstore.partner.detail')}}?id=` + id,
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
            })


        }
    </script>

@endsection
