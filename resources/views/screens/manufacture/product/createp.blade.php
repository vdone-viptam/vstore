@extends('layouts.manufacture.main')
@section('page_title','Thêm sản phẩm')



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
                <h2 class="pageheader-title">Thêm sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
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
            <h5 class="card-header" style="font-size: 20px;">Thêm sản phẩm</h5>

            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-12">
                            <h3 style="font-size: 18px;">Thông tin cơ bản</h3>
                        </div>

                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập tên sản phẩm">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Chọn ngành hàng <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg">
                                    <option>10 phần tử / trang</option>
                                    <option>25 phần tử / trang</option>
                                    <option>50 phần tử / trang</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Giá sản phẩm:</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="0">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">SKU <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Chi tiết sản phẩm <span class="text-danger">*</span></label>
                                <textarea name="" class="form-control form-control-lg" id="" cols="30" rows="10"
                                          placeholder="Nhập chi tiết sản phẩm"></textarea>

                            </div>
                            <div class="form-group">
                                <label for="name">Tóm tắt sản phẩm <span class="text-danger">*</span></label>
                                <textarea name="" class="form-control form-control-lg" id="" cols="30" rows="4"
                                          placeholder="Nhập tóm tắt sản phẩm"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-xl-6">
                            <label for="formFileMultiple" class="form-label">Hình ảnh sản phẩm<span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="formFileMultiple" multiple>
                        </div>
                        <div class="col-12 mb-3 col-xl-6">
                            <div class="form-group">
                                <label for="name">Video sản phẩm<span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="">
                            </div>
                        </div>
                        <div class="col-12">
                            <h3 style="font-size: 18px;">Thông tin chi tiết</h3>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Tên thương hiệu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập tên thương hiệu">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Xuất xứ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập xuất xứ">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Chất liệu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập chất liệu sản phẩm">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="name">Kích cỡ (Cm) <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-12">
                                        <input type="text" class="form-control form-control-lg" id="name"
                                               value="${data.data.name}" placeholder="Nhập chiều dài (Cm)">
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-12 ">
                                        <input type="text" class="form-control form-control-lg" id="name"
                                               value="${data.data.name}" placeholder="Nhập chiều rộng (Cm)">
                                    </div>
                                    <div class="col-xl-4  col-lg-4 col-12">
                                        <input type="text" class="form-control form-control-lg" id="name"
                                               value="${data.data.name}" placeholder="Nhập chiều cao (Cm)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Trọng lượng (Gram) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập trọng lượng sản phẩm (Gram)">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Thể tích (Ml)</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập thể tích sản phẩm">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Tên tổ chức chịu trách nhiệm sản xuất </label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập tên tổ chức">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Địa chỉ tổ chức chịu trách nhiệm sản xuất</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập địa chỉ tổ chức">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Tên đơn vị chịu trách nhiệm nhập khẩu</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập tên địa chỉ đơn vị">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Địa chỉ đơn vị chịu trách nhiệm nhập khẩu</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập tên địa chỉ đơn vị">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Ngày sản xuất / ngày nhập khẩu</label>
                                <input type="date" class="form-control form-control-lg" id="name"
                                       value="${data.data.name}" placeholder="Nhập tên thương hiệu">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Kiểu đóng gói <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg">
                                    <option>10 phần tử / trang</option>
                                    <option>25 phần tử / trang</option>
                                    <option>50 phần tử / trang</option>
                                </select>
                            </div>
                        </div>
                        <div class="mx-auto my-4">
                            <button class="btn btn-secondary">Hủy bỏ</button>
                            <button class="btn btn-primary ml-2">Thêm sản phẩm</button>
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
