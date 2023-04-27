@extends('layouts.admin.main')
@section('page_title','Danh mục ngành hàng')



@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <form action="" enctype="multipart/form-data" id="form-AC" method="POST">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Cập nhật danh mục ngành
                            hàng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body md-content">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button class="btn btn-primary btnSubmit">Lưu thay đổi</button>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Danh mục ngành hàng</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Ngành hàng</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Danh mục ngành hàng</li>
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
                <h5 class="mb-0" style="font-size:18px;">Danh mục ngành hàng</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input name="key_search" value="" class="form-control"
                                       type="search"
                                       placeholder="Tìm kiếm..">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" onclick="create()" id="btnA" class="btn btn-success my-2">
                        Thêm mới danh mục ngành hàng
                    </button>
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th class="white-space-400">Ngành hàng
                            </th>
                            <th>Ảnh hiện thị
                            </th>
                            <th>
                                Ngày tạo
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'categories.created_at')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="categories.created_at"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="categories.created_at"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="categories.created_at"></i>
                                    @endif
                             </span>
                            </th>
                            <th>Số loại sản phẩm
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'count_product')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="count_product"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="count_product"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="count_product"></i>
                                    @endif
                             </span>
                            </th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td class="text-center"><img src="{{asset($category->img)}}"
                                                                 style="width: 75px;height: 75px" alt="">
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($category->created_at)->format('d/m/Y H:i')}}</td>
                                    <td>{{number_format($category->count_product,0,'.','.')}}</td>
                                    <td>
                                        <a href="#" onclick="edit({{$category->id}})" class="btn btn-primary">Cập
                                            nhật</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
                    {{$categories->withQueryString()->links('layouts.custom.paginator')}}
                </div>
                <div class="form-group col-2 float-right">
                    <select class="form-control" id="limit">
                        <option value="10" {{$limit == 10 ? 'selected' : ''}}>10 hàng / trang</option>
                        <option value="25" {{$limit == 25 ? 'selected' : ''}}>25 hàng / trang</option>
                        <option value="50" {{$limit == 50 ? 'selected' : ''}}>50 hàng / trang</option>
                    </select>
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
                        document.location = '{{route('screens.admin.category.index',['key_search' => $key_search])}}&type=' + orderBy +
                            '&field=' + sort + '&limit={{$limit}}'
                    })
                });
            });
        });

        let limit = document.getElementById('limit');
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.admin.category.index',['key_search' => $key_search])}}&limit=' + e.target.value
            }, 200)
        })
        const create = async () => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.admin.category.create')}}`,
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Thêm danh mục thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = ``;
                htmlData += data.view;
                $('.btnSubmit').attr('disabled', true);

                $('.btnSubmit').html('Thêm mới');
                $('.md-content').html(htmlData)
                $('#exampleModalLabel').html('Thêm mới danh mục nghành hàng');
                $('#modalDetail').modal('show');
                document.getElementById('form-AC').setAttribute('action', '{{route('screens.admin.category.store')}}')
            })
        };
        const edit = async (id) => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.admin.category.edit')}}/` + id,
                dataType: "json",
                encode: true,
                error: function (jqXHR, error, errorThrown) {
                    $('#requestModal').modal('hide')
                    var error0 = JSON.parse(jqXHR.responseText)
                    Swal.fire({
                        icon: 'error',
                        title: 'Sửa danh mục thất bại !',
                        text: error0.message,
                    })
                }
            }).done(function (data) {
                var htmlData = ``;

                if (data.view) {
                    htmlData += data.view;
                    $('.md-content').html(htmlData)
                    $('.btnSubmit').html('Lưu thay đổi');

                    $('#exampleModalLabel').html('Cập nhật danh mục ngành hàng');
                    $('#modalDetail').modal('show');
                    document.getElementById('form-AC').setAttribute('action', '{{route('screens.admin.category.update')}}/' + id)
                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu của danh mục ngành hàng!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })
        };
    </script>

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
@endsection
