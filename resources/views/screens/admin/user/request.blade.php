@extends('layouts.admin.main')
@section('page_title','Quản lý yêu cầu cập nhật mã số thuế')



@section('modal')
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn thực hiện thao tác này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-accept">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Quản lý yêu cầu cập nhật mã số thuế</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý tài khoản
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý yêu cầu cập nhật mã số thuế</li>
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
                <h5 class="mb-0" style="font-size:18px;">Quản lý yêu cầu cập nhật mã số thuế</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input type="hidden" name="limit" value="{{$limit}}">
                                <input type="hidden" name="field" value="{{$field}}">
                                <input type="hidden" name="type" value="{{$type}}">
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
                    <table id="example" class="table table-striped table-bordered second    "
                    >
                        <thead>
                        <tr>
                            <th class="white-space-150 text-center">Mã yêu cầu
                            </th>
                            <th class="white-space-150 text-center">Vai trò
                                <span style="float: right;cursor: pointer">
                                    @if($field == 'role_id')
                                        @if($type == 'desc')
                                            <i class="fa-solid fa-sort-down sort" data-sort="role_id"></i>
                                        @else
                                            <i class="fa-solid fa-sort-up sort" data-sort="role_id"></i>
                                        @endif
                                    @else
                                        <i class="fas fa-sort sort" data-sort="role_id"></i>
                                    @endif
                          </span>
                            </th>
                            <th class="white-space-200">
                                Tên
                            </th>
                            <th class="white-space-200">Email
                            </th>
                            <th class="white-space-200 text-center">Id P-Done người đại diện</th>
                            <th class="white-space-200 text-center">Tên công ty</th>
                            <th class="white-space-200 text-center">Mã số thuế cũ</th>
                            <th class="white-space-200 text-center">Mã số thuế mới</th>
                            <th class="white-space-200 text-center">Thao tác / Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @if(count($requests) > 0)
                            @foreach($requests as $request)
                                <tr>
                                    <td class="text-center">{{$request->code ?? 'Chưa có mã'}}</td>
                                    <td class="text-center">
                                        @if($request->role_id == 2)
                                            <span class="text-primary font-medium">Nhà cung cấp</span>
                                        @elseif($request->role_id == 3)
                                            <span class="text-success font-medium">V-Store</span>
                                        @else
                                            <span class="text-danger font-medium">Kho</span>
                                        @endif
                                    </td>
                                    <td class="white-space-200">{{$request->name}}</td>
                                    <td class="white-space-200">{{$request->email}}</td>
                                    <td class="white-space-200 text-center">{{$request->id_vdone}}</td>
                                    <td class="white-space-200">{{$request->company_name}}</td>
                                    <td class="white-space-150 text-center">{{$request->old_tax}}</td>
                                    <td class="white-space-150 text-center">{{$request->tax_code}}</td>
                                    <td class="text-center white-space-200">
                                        @if($request->status == 0)
                                            <a href="#" onclick="upDateStatus({{$request->id}},1)"
                                               class="btn btn-primary ">Đồng
                                                ý</a>
                                            <a href="#" onclick="upDateStatus({{$request->id}},2)"
                                               class="btn btn-danger">Từ chối</a>
                                        @elseif($request->status == 2)
                                            <p class="text-danger"><i class="fas fa-times mr-2"></i>Từ chối</p>

                                        @else
                                            <p class="text-success"><i class="fas fa-check mr-2"></i>Đồng ý</p>
                                        @endif
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
            
                <div class="d-flex align-items-center justify-content-end mt-4">
                    {{$requests->withQueryString()->links('layouts.custom.paginator')}}
                    <div class="ml-4">
                    <div class="form-group ">
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
        $('.btn-accept').on('click', async function () {
                const btn = document.querySelector('.btn-accept');

                const status = btn.dataset.status;
                const id = btn.dataset.key;
                await $.ajax({
                    type: "POST",
                    url: `{{route('screens.admin.user.confirm1')}}?_token={{csrf_token()}}`,
                    data: {
                        status: status,
                        id: id
                    },
                    error: function (jqXHR, error, errorThrown) {
                        $('#requestModal').modal('hide')
                        var error0 = JSON.parse(jqXHR.responseText)
                        Swal.fire({
                            icon: 'error',
                            title: 'Cập nhật yêu cầu không thành công !',
                            text: error0.message,
                        })
                    }
                }).done(function (data) {
                    Swal.fire(
                        data.message,
                        'Click vào nút bên dưới để đóng',
                        'success'
                    ).then(() => location.reload())

                })


            }
        )


        function upDateStatus(id, status) {
            const btn = document.querySelector('.btn-accept');

            btn.setAttribute('data-key', id);
            btn.setAttribute('data-status', status);
            $('#requestModal').modal('show')
        }
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
