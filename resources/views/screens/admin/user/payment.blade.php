@extends('layouts.admin.main')
@section('page_title','Lịch sử thanh toán đăng ký tài khoản')



@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <div id="saveChange"></div>
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
                <h2 class="pageheader-title">Lịch sử thanh toán đăng ký tài khoản</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý tài khoản
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Lịch sử thanh toán đăng ký tài
                                khoản
                            </li>
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
                <h5 class="mb-0" style="font-size:18px;">Lịch sử thanh toán đăng ký tài khoản</h5>
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
                            <th class="white-space-130 text-center">Mã hóa đơn
                            </th>
                            <th class="white-space-120 text-center">Phân loại

                            </th>
                            <th >
                                Tên
                            </th>
                            <th >Email
                            </th>
                            <th class="white-space-100 text-center">Số điện thoại</th>
                            <th class="white-space-130">Tên công ty</th>
                            <th class="white-space-130 text-center">
                            <div class="d-flex align-items-center justify-content-around">
                                <span class="white-space-90">    
                            Phương thức <br> thanh toán
</span>
                        </th>
                            <th class="white-space-100 text-center">Số tiền</th>
                            <th class="white-space-120 text-center">Thời gian</th>
                            <th class="white-space-130 text-center">Trạng thái</th>
                            <th class="white-space-80 text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @if(count($histories) > 0)
                            @foreach($histories as $history)
                                <tr>
                                    <td class="text-center white-space-140">{{$history->no ?? 'Chưa có mã'}}</td>
                                    <td class="text-center white-space-120">
                                        @if($history->type == 'NCC')
                                            <span class="text-primary font-medium">Nhà cung cấp</span>
                                        @elseif($history->type == 'KHO')
                                            <span class="text-success font-medium">Kho</span>
                                        @else
                                            <span class="text-danger font-medium">V-Store</span>
                                        @endif
                                    </td>
                                    <td class="white-space-200">{{$history->name}}</td>
                                    <td class="white-space-150">{{$history->email}}</td>
                                    <td class="text-center white-space-110">{{$history->phone_number}}</td>
                                    <td  class="white-space-150 text-center">{{$history->company_name}}</td>
                                    <td  class="text-center white-space-150"><span class="text-success">Thanh toán trước</span></td>
                                    <td class="text-right white-space-130">{{number_format($history->total,0,'.','.')}} đ</td>
                                    <td class="text-center white-space-130">{{\Carbon\Carbon::parse($history->created_at)->format('d/m/Y H:i')}}</td>
                                    <td class="text-center white-space-120">
                                        @if($history->status == 3 && $history->payment_status == 1)
                                            <p class="text-success"><i class="fas fa-check mr-2"></i>Thành công</p>
                                        @else
                                            <p class="text-danger"><i class="fas fa-times mr-2"></i>Thất bại</p>
                                        @endif
                                    </td>
                                    <td class="text-center white-space-80"><a href="javascript:void(0)" style="text-decoration:underline;" onclick="checkPayment({{$history->id}})" class="btn btn-link px-2 py-0">Chi
                                            tiết</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-center justify-content-end mt-4">
                    {{$histories->withQueryString()->links('layouts.custom.paginator')}}
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

        async function checkPayment(id) {
            $.ajax({
                url: '{{route('screens.admin.user.checkPayment')}}?id=' + id + '&_token={{csrf_token()}}',
                success: function (result) {
                    const data = JSON.parse(result.request);
                    const tax_code = result.tax_code;
                    const name = result.name;
                    const phone_number = result.phone_number;
                    const present_status = result.status;
                    const payment_status = result.payment_status;
                    let status = '';
                    switch (data.status) {
                        case 2:
                            status = 'Giao dịch đang xủ lý';
                            break;
                        case 3:
                            status = "Giao dịch đang chờ kiểm tra (Giao dịch bị nghi ngờ vi phạm quy định về quản trị rủi ro của đối tác thanh toán)";
                            break;
                        case 5 :
                            status = "Giao dịch thành công";
                            break;
                        case 6:
                            status = "Giao dịch thất bại";
                            break;
                        case 8:
                            status = "Giao dịch bị hủy";
                            break;
                        case 9 :
                            status = "Giao dịch bị từ chối (Giao dịch bị từ chối do vi phạm quy định về quản trị rủi ro của đói tác thanh toán)";
                            break;
                        default:
                            status = "Giao dịch đã nhận tiền (Chỉ áp dụng với phương thức thanh toánChuyển khoản ngân hàng)";
                            break;
                    }
                    const html = `
<div class="">
    <div class="row">
        <div class="form-group col-6">
            <label>Mã giao dịch:</label>
            <input class="form-control form-control-lg" disabled value="${data.invoice_no}">
        </div>
        <div class="form-group col-6">
            <label>Tên khách hàng:</label>
            <input class="form-control form-control-lg" disabled value="${name}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label>Số điện thoại:</label>
            <input class="form-control form-control-lg" disabled value="${phone_number}">
        </div>
        <div class="form-group col-6">
            <label>Mã số thuế:</label>
            <input class="form-control form-control-lg" disabled value="${tax_code}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label>Loại thẻ:</label>
            <input class="form-control form-control-lg" disabled value="${data.card_brand}">
        </div>
        <div class="form-group col-6">
            <label>Loại tiền tệ:</label>
            <input class="form-control form-control-lg" disabled value="${data.currency}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label>Nội dung:</label>
            <input class="form-control form-control-lg" disabled value="${data.description}">
        </div>
        <div class="form-group col-6">
            <label>Phương thức thanh toán:</label>
            <input class="form-control form-control-lg" disabled value="${data.method}">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label>Trạng thái thanh toán:</label>
            <input class="form-control form-control-lg" disabled
                   value="${present_status == 3 && payment_status == 1 ? 'Thành công' : 'Thất bại'}">
        </div>
        <div class="form-group col-6">
            <label>Trạng thái thanh toán thực tế:</label>
            <input class="form-control form-control-lg" disabled value="${status}">
        </div>
    </div>
    <div class="row">
<div class="form-group col-12">
        <label>Thời gian giao dịch:</label>
        <input class="form-control form-control-lg" disabled value="${convertTimeVN(data.created_at)}">
</div>

    </div>
</div>
                    `;
                    if (data.status == 5 && !(payment_status == 1 && present_status == 3)) {
                        $('#saveChange').html(`<a
            href="{{route('screens.admin.user.updatePayment')}}?id=${id}"
            onclick="return confirm('Bạn có chắc muốn thay đổi trạng thái giao dịch này')"
            class="btn btn-success">Chuyển
            trạng thái</a>`);
                    }
                    $('.modal-body').html(html);
                    $('#modalDetail').modal('show');
                },
            });
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
