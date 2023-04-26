    @extends('layouts.manufacture.main')
@section('page_title','Yêu cầu xét duyệt sản phẩm')



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

    <form method="POST" action="{{route('screens.manufacture.product.storeRequest')}}" enctype="multipart/form-data">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header" style="font-size: 20px;">Yêu cầu xét duyệt sản phẩm</h5>

                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-12">
                                <h3 style="font-size: 18px;">Thông tin cơ bản</h3>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12" id="div1">
                                <div class="form-group">
                                    <label for="name">Chọn V-Store<span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" disabled name="vstore_id">
                                        <option value="{{$vstore->id}}">{{$vstore->name}}</option>
                                    </select>
                                    <button onclick="changeHidden(1)" class="btn btn-primary mt-2" type="button">Thay
                                        đổi
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12" style="display: none" id="div2">
                                <div class="form-group">
                                    <label for="name">Chọn V-Store<span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" name="vstore_id" id="selectVs">
                                        @foreach($v_stores as $v)
                                            <option value="{{$v->id}}">{{$v->name}}</option>

                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-primary mt-2" onclick="changeHidden(2)">Thay
                                        đổi
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">VAT (%) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg number discountA" id="vat" required
                                           name="vat"
                                           pattern="^[1-9][0-9]?$|^100$"
                                           title="Giá trị thích hợp từ 1 => 100"
                                           value="{{old('vat')}}" placeholder="Nhập VAT (%)">
                                    <p class="ml-1 mt-2 messageE text-danger" data-title="VAT"></p>
                                    @error('vat')
                                    <p class="text-danger ml-1 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Mức chiết khấu (%) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg number discountA" required
                                           id="discountA"
                                           name="discountA"
                                           pattern="^[1-9][0-9]?$|^100$"
                                           title="Giá trị thích hợp từ 1 => 100"
                                           value="{{old('discountA')}}" placeholder="Mức chiết khấu (%)">
                                    <p data-title="Chiết khấu" class="ml-1 mt-2 messageE text-danger"></p>
                                    @error('discountA')
                                    <p class="text-danger ml-1 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chọn sản phẩm xét duyệt
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control form-control-lg" style="height: 50px !important;" required
                                            name="product_id" id="product_id">
                                        <option value="" disabled selected>Lựa chọn sản phẩm xét duyệt</option>
                                        @foreach($products as $product)
                                            <option
                                                value="{{$product->id}}" {{old('product_id') == $product->id ? 'selected' : ''}}> {{$product->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Giá (đồng) </label>
                                    <input type="text" class="form-control form-control-lg" id="price" name="price"
                                           value="{{old('price')}}" placeholder="0 đ" readonly>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Mức chiết khấu (Thành tiền) </label>
                                    <input type="text" class="form-control form-control-lg" id="money_discountA"
                                           name="money_discountA"
                                           value="{{old('money_discountA')}}" placeholder="0 đ" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Vai trò đối với sản phẩm<span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" name="role" required>
                                        <option value="" disabled selected>Lựa chọn vai trò đối với sản phẩm</option>
                                        <option value="1" {{old('role') == 1 ? 'selected' : ''}}>Nhà sản xuất</option>
                                        <option value="2" {{old('role') == 2 ? 'selected' : ''}}>Nhà nhập khẩu</option>
                                        <option value="3" {{old('role') == 3 ? 'selected' : ''}}>Nhà phân phối</option>
                                    </select>
                                    @error('role')
                                    <p class="text-danger ml-1 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tài liệu sản phẩm<span class="text-danger">*</span></label>
                                    <input type="file" required  accept=
                                        "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                                        text/plain, application/pdf, image/*" class="form-control form-control-lg"
                                           id="images" name="images[]" multiple>
                                    @error('images')
                                    <p class="text-danger ml-1 mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            @csrf
                            <div class="col-12">
                                <h3 style="font-size: 18px;">Chiết khấu hàng nhập sẵn <span class="text-danger">*</span>
                                </h3>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Số lượng sản phẩm</label>
                                    <input type="text" class="form-control form-control-lg number" id="sl[]" name="sl[]"
                                           value="{{isset(old('sl')[0]) ?(int)old('sl')[0] : ''}}" required
                                           placeholder="Nhập số lượng sản phẩm nhập sẵn chiết khấu mức 1">
                                    <p class="ml-1 mt-2 text-danger"></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Chiết khấu (%)</label>
                                                <div class="input-group mb-3" style="gap: 12px">
                                                    <input type="text" class="form-control form-control-lg number discountA"
                                                        name="moneyv[]"
                                                        pattern="^[1-9][0-9]?$|^100$"
                                                        title="Giá trị thích hợp từ 1 => 100"
                                                        id="moneyv[]" required
                                                        value="{{isset(old('moneyv')[0]) ? old('moneyv')[0] : ''}}"
                                                        placeholder="% chiết khẩu nhập sẵn mức 1">
                                                </div>
                                                <p class="ml-1 mt-2 messageE text-danger" data-title="Số phần trăm chiết khẩu"></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="name">Số tiền</label>
                                            <input type="text" class="form-control form-control-lg number sub-moneyv" value="0 đ" readonly style="pointer-events: none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Phần trăm cọc nhập hàng sẵn</label>
                                    <input type="text" class="form-control form-control-lg number discountA sp"
                                           id="deposit_money[]" required
                                           name="deposit_money[]"
                                           pattern="^[1-9][0-9]?$|^100$"
                                           title="Giá trị thích hợp từ 1 => 100"
                                           value="{{isset(old('deposit_money')[0]) ? old('deposit_money')[0] : ''}}"
                                           placeholder="Nhập phần trăm cọc mức 1">
                                    <p class="ml-1 mt-2 messageE text-danger" data-title="Phần trăm cọc"></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Số lượng sản phẩm</label>
                                    <input type="text" class="form-control form-control-lg number" id="sl[]" name="sl[]"
                                           value="{{isset(old('sl')[1]) ? (int)old('sl')[1]  : '' }}"
                                           placeholder="Nhập số lượng sản phẩm nhập sẵn chiết khấu mức 2">
                                    <p class="ml-1 mt-2 text-danger"></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Chiết khấu (%)</label>
                                                <div class="input-group mb-3" style="gap: 12px">
                                                    <input type="text" class="form-control form-control-lg number discountA"
                                                       name="moneyv[]"
                                                       id="moneyv[]"
                                                       pattern="^[1-9][0-9]?$|^100$"
                                                        title="Giá trị thích hợp từ 1 => 100"
                                                       value="{{isset(old('moneyv')[1]) ? old('moneyv')[1] : ''}}"
                                                       placeholder="% chiết khẩu nhập sẵn mức 2">
                                                </div>
                                                <p class="ml-1 mt-2 messageE text-danger" data-title="Số phần trăm chiết khẩu"></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="name">Số tiền</label>
                                            <input type="text" class="form-control form-control-lg number sub-moneyv" value="0 đ" readonly style="pointer-events: none">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Phần trăm cọc nhập hàng sẵn</label>
                                    <input type="text" class="form-control form-control-lg number discountA sp"
                                           id="deposit_money[]"
                                           name="deposit_money[]"
                                           pattern="^[1-9][0-9]?$|^100$"
                                           title="Giá trị thích hợp từ 1 => 100"
                                           value="{{isset(old('deposit_money')[1]) ? old('deposit_money')[1] : ''}}"
                                           placeholder="Nhập phần trăm cọc mức 2">
                                    <p class="ml-1 mt-2 messageE text-danger" data-title="Phần trăm cọc"></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Số lượng sản phẩm</label>
                                    <input type="text" class="form-control form-control-lg number" id="sl[]" name="sl[]"
                                           value="{{isset(old('sl')[2]) ?(int)old('sl')[2]: ''}}"
                                           placeholder="Nhập số lượng sản phẩm nhập sẵn chiết khấu mức 3">
                                    <p class="ml-1 mt-2 text-danger"></p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name">Chiết khấu (%)</label>
                                                <div class="input-group mb-3" style="gap: 12px">
                                                    <input type="text" class="form-control form-control-lg number discountA"
                                                        name="moneyv[]"
                                                        id="moneyv[]"
                                                        pattern="^[1-9][0-9]?$|^100$"
                                                        title="Giá trị thích hợp từ 1 => 100"
                                                        value="{{isset(old('moneyv')[2]) ? old('moneyv')[2] : ''}}"
                                                        placeholder="% chiết khẩu nhập sẵn mức 3">
                                                </div>
                                                <p class="ml-1 mt-2 messageE text-danger" data-title="Số phần trăm chiết khẩu"></p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="name">Số tiền</label>
                                            <input type="text" class="form-control form-control-lg number sub-moneyv" value="0 đ" readonly style="pointer-events: none">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Phần trăm cọc nhập hàng sẵn</label>
                                    <input type="text" class="form-control form-control-lg number discountA sp"
                                           id="deposit_money[]"
                                           pattern="^[1-9][0-9]?$|^100$"
                                           title="Giá trị thích hợp từ 1 => 100"
                                           name="deposit_money[]"
                                           value="{{isset(old('deposit_money')[2]) ? old('deposit_money')[2] : ''}}"
                                           placeholder="Nhập phần trăm cọc mức 3">
                                    <p class="ml-1 mt-2 messageE text-danger" data-title="Phần trăm cọc"></p>
                                </div>
                            </div>

                            <div class="col-12">
                                <h3 style="font-size: 24px;">Thanh toán </h3>
                                <span style="font-size: 18px;">Phương thức thanh toán <span
                                        class="text-danger">*</span></span>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 ">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="prepay" checked="" value="1"
                                           class="custom-control-input"><span
                                        class="custom-control-label"> Chỉ thanh toán trước</span>
                                </label>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 ">

                                <label class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="prepay" value="2" class="custom-control-input"><span
                                        class="custom-control-label">Tất cả phương thức thanh toán</span>
                                </label>
                            </div>
                            <div class="mx-auto my-4 col-12 text-center">
                                <button type="button" class="btn btn-secondary" onClick="window.location.reload();">Hủy bỏ</button>
                                <button type="submit" class="btn btn-primary ml-2" id="appect">Tạo yêu cầu</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </form>
@endsection

@section('custom_js')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{\Illuminate\Support\Facades\Session::get('success')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    @if ($errors->has('moneyv.*'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ $errors->first('moneyv.*')}}',
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
    <script>


        document.querySelector('#appect').setAttribute('disabled', 'true');

        document.querySelectorAll('.discountA').forEach((item, index) => {
            item.addEventListener('keypress', (e) => {
                if (e.target.value !== null) {
                    const currentValue = e.target.value.replaceAll('.', '');
                    if (item.classList.contains('sp')) {
                        if (currentValue > 100) {
                            document.querySelectorAll('.messageE')[index].innerHTML = document.querySelectorAll('.messageE')[index].dataset.title + ' không được vượt quá 100 %';
                            item.value = 10;
                            document.querySelector('#appect').setAttribute('disabled', 'true');
                        } else {
                            document.querySelectorAll('.messageE')[index].innerHTML = '';
                            document.querySelector('#appect').removeAttribute('disabled');

                        }
                    } else {
                        if (currentValue >= 100) {
                            document.querySelectorAll('.messageE')[index].innerHTML = document.querySelectorAll('.messageE')[index].dataset.title + ' không được vượt quá 100 %';
                            item.value = 10;
                            document.querySelector('#appect').setAttribute('disabled', 'true');
                        } else {
                            document.querySelectorAll('.messageE')[index].innerHTML = '';
                            document.querySelector('#appect').removeAttribute('disabled');

                        }
                    }

                }
            })
        });

        function changeHidden(type) {
            if (type === 1) {
                document.querySelector('#div1').style.display = 'none';
                document.querySelector('#div2').style.display = 'block';
            } else {
                document.querySelector('#div2').style.display = 'none';
                document.querySelector('#div1').style.display = 'block';
            }
        }

        let price = 0;
        let discount = 0;
        const VND = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });


        document.querySelector('#product_id').addEventListener('change', (e) => {
            if (e.target.value) {
                $.ajax({
                    url: '{{route('screens.manufacture.product.getDataProduct')}}?product_id=' + e.target.value + '&_token=XMq2eSZnk6BkEYFCh0NbP91gCQz4AaVYtQjOAO6T',
                    success: function (result) {
                        price = result;
                        document.getElementById('price').value = VND.format(price);
                        document.getElementById('money_discountA').value = VND.format((discount / 100) * price);

                        $(".sub-moneyv" ).each(function( index ) {
                            let percent = $(this).closest(".w-100").find('.discountA').val();
                            let subMoney = VND.format(price * percent / 100) || 0 + ' đ';
                            $(this).val(subMoney);
                        });
                    },
                });
            } else {
                price = 0;
                document.getElementById('price').value = VND.format(price);
                document.getElementById('money').value = VND.format((discount / 100) * price);

            }
        })

        // document.querySelector('#vat').addEventListener('keyup', (e) => {
        //     document.querySelector('#money_vat').value = VND.format(price * e.target.value / 100) || 0 + ' đ';

        // });
        document.getElementById('discountA').addEventListener('keyup', (e) => {
            discount = e.target.value;
            if (discount > 100) {
                document.getElementById('discountA').value = 100;
            }
            if (discount) {
                document.getElementById('money_discountA').value = VND.format((e.target.value / 100) * price);

            } else {
                document.getElementById('money_discountA').value = '0 đ';
            }

        })
        $("[name='moneyv[]']").keyup(function (e) {
            if( $('#discountA').val() > 100 || $('#discountA').val() < 0  || $('#discountA').val() == '' ){
                return;
            }
            let subMoney = VND.format(price * $(this).val() / 100) || 0 + ' đ';
            $(this).closest(".w-100").find('.sub-moneyv').val(subMoney);
        });
        $("[name='moneyv[]']").change(function (e) {
            if( $('#discountA').val() <= 100 || $('#discountA').val() >= 0){
                if( 100 - $('#discountA').val() - $(this).val() >= 0 && 100 - $('#discountA').val() - $(this).val() <= 100 ){
                    $(this).closest(".form-group").find('.messageE').hide();
                    return;
                }
                let percent = 100 - $('#discountA').val();
                $(this).closest(".form-group").find('.messageE').html(`Chiết khấu không được vượt quá ${percent} %`);
                $(this).closest(".form-group").find('.messageE').show();
                $(this).focus();
            }else{
                $(this).closest(".form-group").find('.messageE').hide();
            }

            let subMoney = VND.format(price * $(this).val() / 100) || 0 + ' đ';
            $(this).closest(".w-100").find('.sub-moneyv').val(subMoney);
        });
        // $('#form').submit(function (evt) {
        //     evt.preventDefault();
        //     window.history.back();
        // });
    </script>

@endsection
