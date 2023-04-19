@extends('layouts.manufacture.main')
@section('page_title','Yêu cầu xét duyệt sản phẩm')



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
                <h2 class="pageheader-title">Yêu cầu xét duyệt sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Yêu cầu xét duyệt sản phẩm</li>
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
            <h5 class="card-header" style="font-size: 20px;">Yêu cầu xét duyệt sản phẩm</h5>

            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-12">
                            <h3 style="font-size: 18px;">Thông tin cơ bản</h3>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Chọn V-Store<span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg">
                                    <option>10 phần tử / trang</option>
                                    <option>25 phần tử / trang</option>
                                    <option>50 phần tử / trang</option>
                                </select>
                                <button class="btn btn-primary mt-2">Thay đổi</button>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">VAT (%) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập VAT (%)">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Mức chiết khấu (%) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Mức chiết khấu (%)">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Chọn sản phẩm xét duyệt<span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg">
                                    <option>10 phần tử / trang</option>
                                    <option>25 phần tử / trang</option>
                                    <option>50 phần tử / trang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Giá (đồng) </label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="0 đ" readonly>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Mức chiết khấu (Thành tiền) </label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="0 đ" readonly>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Vai trò đối với sản phẩm<span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg">
                                    <option>10 phần tử / trang</option>
                                    <option>25 phần tử / trang</option>
                                    <option>50 phần tử / trang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Tài liệu sản phẩm<span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-12">
                            <h3 style="font-size: 18px;">Chiết khấu hàng nhập sẵn <span class="text-danger">*</span>
                            </h3>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Số lượng sản phẩm</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Chiết khấu (%)</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Phần trăm cọc nhập hàng sẵn</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Số lượng sản phẩm</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Chiết khấu (%)</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Phần trăm cọc nhập hàng sẵn</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Số lượng sản phẩm</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Chiết khấu (%)</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Phần trăm cọc nhập hàng sẵn</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-12">
                            <h3 style="font-size: 24px;">Thanh toán </h3>
                            <span style="font-size: 18px;">Phương thức thanh toán <span
                                    class="text-danger">*</span></span>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 ">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="radio-inline" checked="" class="custom-control-input"><span
                                    class="custom-control-label"> Chỉ thanh toán trước</span>
                            </label>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 ">

                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="radio-inline" class="custom-control-input"><span
                                    class="custom-control-label">Tất cả phương thức thanh toán</span>
                            </label>
                        </div>
                        <div class="mx-auto my-4 col-12 text-center">
                            <button class="btn btn-secondary">Hủy bỏ</button>
                            <button class="btn btn-primary ml-2">Tạo yêu cầu</button>
                        </div>

                    </div>
                </form>
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
    {{--                    <span >V-Store niêm yết:</label>--}}
    {{--                  <input class="form-control form-control-lg" disabled value="${data.data.user_name}" >--}}
    {{--                </div>--}}
    {{--                <div class="form-group">--}}
    {{--                    <an >Giá bán :</label>--}}
    {{--                  <input class="form-control form-control-lg" disabled value="${data.data.price + 'đ'}">--}}
    {{--                <div class="form-group">--}}
    {{--                    <label>Vat :</label>--}}
    {{--                  <input class="form-control form-control-lg" disabled value="${data.data.vat}" >        </div>--}}
    {{--                <div class="form-group">--}}
    {{--                    <span >Chiết khấu V-Store :</label>--}}
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
