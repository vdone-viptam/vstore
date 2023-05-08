@extends('layouts.admin.main')
@section('page_title', 'Quản lý ngân hàng')

@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="" enctype="multipart/form-data" id="form-AC" method="POST">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Cập nhật ngân hàng
                        </h5>
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
                <h2 class="pageheader-title">Quản lý ngân hàng</h2>
            </div>
        </div>
    </div>
@endsection



@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px">
                <h5 class="mb-0" style="font-size:18px;">Danh sách ngân hàng</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input type="hidden" name="limit" value="{{ $limit }}">
                                <input type="hidden" name="field" value="{{ $field }}">
                                <input type="hidden" name="type" value="{{ $type }}">
                                <input name="key_search" value="{{ $key_search ?? '' }}" class="form-control" type="search"
                                    placeholder="Nhập từ khóa tìm kiếm...">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" onclick="create()" id="btnA" class="btn btn-success my-2">
                        Thêm mới ngân hàng
                    </button>
                    <table id="example" class="table table-striped table-bordered second    ">
                        <thead>
                            <tr>
                                <th class="white-space-400 text-center">Tên ngân hàng
                                </th>
                                <th class="text-center white-space-150">Hình ảnh
                                </th>

                                <th class="text-center white-space-200">Tên chi tiết ngân hàng
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if (count($banks) > 0)
                                    @foreach ($banks as $request)
                            <tr>
                                <td>{{ $request->name }}</td>
                                <td class="text-center"><img src="{{$request->image}}" style="width: 75px;height: 75px;object-fit: contain" alt="">
                                </td>
                                <td>{{ $request->full_name }}</td>
                                <td class="white-space-120 text-center">
                                    <a href="javascript:void(0)" onclick="edit({{$request->id}})" class="btn btn-primary">Cập
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
                    {{ $banks->withQueryString()->links('layouts.custom.paginator') }}
                    <div class="ml-4">
                        <div class="form-group ">
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
    <script>
        let limit = document.getElementById('limit');
        limit.addEventListener('change', (e) => {
            setTimeout(() => {
                document.location = '{{route('screens.admin.bank.index',['key_search' => $key_search])}}&limit=' + e.target.value
            }, 200)
        })
        const create = async () => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.admin.bank.create')}}`,
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
                $('#exampleModalLabel').html('Thêm mới ngân hàng');
                $('#modalDetail').modal('show');
                document.getElementById('form-AC').setAttribute('action', '{{route('screens.admin.bank.store')}}')
            })
        };
        const edit = async (id) => {
            await $.ajax({
                type: "GET",
                url: `{{route('screens.admin.bank.edit')}}/` + id,
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

                    $('#exampleModalLabel').html('Cập nhật ngân hàng');
                    $('#modalDetail').modal('show');
                    document.getElementById('form-AC').setAttribute('action', '{{route('screens.admin.bank.update')}}/' + id)
                } else {
                    $('#modalDetail').modal('show');
                    $('.md-content').html('Chưa có dữ liệu của ngân hàng!')
                    setTimeout(() => {
                        $('#modalDetail').modal('hide');
                    }, 1000);
                }
            })
        };
    </script>

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{\Illuminate\Support\Facades\Session::get('success')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{\Illuminate\Support\Facades\Session::get('error')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
@endsection
