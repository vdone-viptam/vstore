@extends('layouts.manufacture.main')
@section('page_title','Yêu cầu hủy niêm yết sản phẩm')



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
                <h2 class="pageheader-title">Yêu cầu hủy niêm yết sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Yêu cầu hủy niêm yết sản phẩm</li>
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
                <h5 class="mb-0" style="font-size:18px;">Yêu cầu hủy niêm yết sản phẩm</h5>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <form>
                                <input name="key_search" value="" class="form-control"
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
                            <th>Mã yêu cầu</th>
                            <th>Tên sản phẩm
                                <span style="float: right;cursor: pointer">
                                <i class="fas fa-sort sort" data-sort="products.name"></i>
                                </span>
                            </th>
                            <th class="text-center">Ngành hàng
                                <span style="float: right;cursor: pointer">
                          <i class="fas fa-sort sort" data-sort="brand"></i>
                                </span>
                            </th>

                            <th>Ngày yêu cầu
                                <span style="float: right;cursor: pointer">
                             <i class="fas fa-sort sort" data-sort="cate_name"></i>
                                </span>
                            </th>
                            <th>Trạng thái yêu cầu
                                <span style="float: right;cursor:pointer">
                           <i class="fas fa-sort sort" data-sort="price"></i>
                                </span>
                            </th>
                            <th>
                                
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="8" class="text-center">Không có dữ liệu phù hợp</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="d-flex align-items-end justify-content-end mt-4">
{{--                    {{$requests->withQueryString()->links()}}--}}
                    <select name="" id="" class="form-control col-1">
                        <option value="">10 hàng / trang</option>
                        <option value="">25 hàng / trang</option>
                        <option value="">50 hàng / trang</option>
                    </select>
                </div>


            </div>

        </div>
    </div>

@endsection

@section('custom_js')
{{--    <script>--}}
{{--        async function showDetail(id) {--}}
{{--            await $.ajax({--}}
{{--                type: "GET",--}}
{{--                url: `{{route('screens.manufacture.product.detail')}}?id=` + id,--}}
{{--                dataType: "json",--}}
{{--                encode: true,--}}
{{--                error: function (jqXHR, error, errorThrown) {--}}
{{--                    $('#requestModal').modal('hide')--}}
{{--                    var error0 = JSON.parse(jqXHR.responseText)--}}
{{--                    Swal.fire({--}}
{{--                        icon: 'error',--}}
{{--                        title: 'Xem chi tiết sản phẩm thất bại !',--}}
{{--                        text: error0.message,--}}
{{--                    })--}}
{{--                }--}}
{{--            }).done(function (data) {--}}
{{--                var htmlData = ``;--}}

{{--                if (data.data) {--}}
{{--                    htmlData += `--}}
{{--<form method="post" key=${id}>--}}


{{--                           <div class="form-group">--}}
{{--                    <label >Mã yêu cầu :</label>--}}
{{--                  <input class="form-control form-control-lg" disabled value="${data.data.code}" />           </div>--}}

{{--                <div class="form-group">--}}
{{--                    <span >Tên sản phẩm :</label>--}}
{{--                  <input class="form-control form-control-lg" disabled value="${data.data.product_name}">--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <span >Store niêm yết:</label>--}}
{{--                  <input class="form-control form-control-lg" disabled value="${data.data.user_name}" >--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <an >Giá bán :</label>--}}
{{--                  <input class="form-control form-control-lg" disabled value="${data.data.price + 'đ'}">--}}
{{--                <div class="form-group">--}}
{{--                    <label>Vat :</label>--}}
{{--                  <input class="form-control form-control-lg" disabled value="${data.data.vat}" >        </div>--}}
{{--                <div class="form-group">--}}
{{--                    <span >Chiết khấu Store :</label>--}}
{{--                  <input class="form-control form-control-lg" disabled value="${data.data.discount}" >--}}
{{--                   </form>--}}

{{--                        `;--}}
{{--                    $('.md-content').html(htmlData)--}}
{{--                    $('#modalDetail').modal('show');--}}
{{--                    if (data.data.availability_status == 1) {--}}
{{--                        document.querySelector('.btnDestroy').innerHTML =--}}
{{--                            `<button class="btn btn-danger">Hủy niêm yết</button>--}}

{{--`;--}}
{{--                        $(".btnDelete").html('');--}}
{{--                    } else {--}}
{{--                        document.querySelector('.btnDestroy').innerHTML = ``;--}}
{{--                        $(".btnDelete").html('<a class="btn btn-warning btnEdit mx-2" href="">Sửa sản phẩm</a><button  class="btn btn-danger">Xóa sản phẩm</button>');--}}
{{--                    }--}}
{{--                } else {--}}
{{--                    $('#modalDetail').modal('show');--}}
{{--                    $('.md-content').html('Chưa có dữ liệu của sản phẩm!')--}}
{{--                    setTimeout(() => {--}}
{{--                        $('#modalDetail').modal('hide');--}}
{{--                    }, 1000);--}}
{{--                }--}}
{{--            })--}}


{{--        }--}}

{{--        $(document).ready(function () {--}}
{{--            document.querySelectorAll('.sort').forEach(item => {--}}
{{--                const {sort} = item.dataset;--}}
{{--                item.addEventListener('click', () => {--}}
{{--                    let orderBy = JSON.parse(localStorage.getItem('orderBy')) || 'asc';--}}
{{--                    if (orderBy === 'asc') {--}}
{{--                        localStorage.setItem('orderBy', JSON.stringify('desc'));--}}
{{--                    } else {--}}
{{--                        localStorage.setItem('orderBy', JSON.stringify('asc'));--}}
{{--                    }--}}
{{--                    setTimeout(() => {--}}
{{--                        document.location = '{{route('screens.manufacture.product.index',['key_search' => $key_search])}}&type=' + orderBy +--}}
{{--                            '&field=' + sort--}}
{{--                    })--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

@endsection
