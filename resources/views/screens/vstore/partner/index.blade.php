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
                            <li class="breadcrumb-item"><a href="{{route('screens.vstore.partner.index')}}" class="breadcrumb-link">Liên kết NCC</a>
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
                            <th>Tổng số sản phẩm

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
                            <th>Sản phẩm liên kết
                                <span style="float: right;cursor: pointer">
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
                                    <td></td>
                                    <td>{{$value->countProduct}}</td>
                                    <td> <button type="button" class="btn btn-link"
                                                 onclick="showDetail({{$value->id}})">Chi tiết
                                        </button></td></td>
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
                        document.location = '{{route('screens.manufacture.partner.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort
                    })
                });
            });
        });
    </script>
    <script>
        async function showDetail(id) {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.vstore.partner.detail')}}`,
                dataType: "json",
                data: {"id": id},
                encode: true,
                error: function (jqXHR, error, errorThrown) {

                    console.log(jqXHR.responseText);
                    $('#requestModal').modal('hide')
                    Swal.fire({
                        icon: 'error',
                        title: 'Xem chi tiết sản phẩm thất bại !',
                    })
                }
            }).done(function (data) {
                console.log(data)

   ;
;
                    // $('.md-content').html(htmlData)
                    $('#modalDetail').modal('show');

            })
        }
    </script>
@endsection
