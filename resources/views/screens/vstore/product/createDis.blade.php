<div class="">
    @csrf
    <div class="col-12">
        <div class="form-group">
            <label>Lựa chọn sản phẩm tạo giảm giá</label>
            <select name="product_id" id="product_id"
                    class="form-control-lg form-control choose-product">
                <option value="" selected disabled>Chọn sản phẩm</option>
                @foreach($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="">Giá sản phẩm:</label>
            <input disabled name="price" id="price"
                   class="form-control form-control-lg">
        </div>
        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Chiết khấu từ Nhà cung cấp:</label>
                    <input disabled name="discount_ncc" id="discount_ncc"
                           class="form-control-lg form-control">
                </div>
                <div class="col-6">
                    <label class="">Chiết khấu từ Nhà cung cấp thành tiền (thành tiền):</label>
                    <input class="form-control form-control-lg percent-to-vnd" disabled id="moneyDis"
                           placeholder="">
                </div>
            </div>
        </div>
        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Chiết khấu cho V-Shop:</label>
                    <input disabled name="discount_vshop" id="discount_vshop"
                           class="form-control form-control-lg">
                </div>
                <div class="col-6">
                    <label class="">Chiết khấu cho V-Shop (thành tiền):</label>
                    <input class="form-control percent-to-vnd form-control-lg" disabled id="moneyMore">
                </div>
            </div>

        </div>
        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Phần trăm giảm giá:</label>
                    <input name="discount" id="discount1" type="text"
                           class="form-control form-control-lg number">
                </div>
                <div class="col-6">
                    <label class="">Giảm giá (thành tiền):</label>
                    <input class="form-control form-control-lg percent-to-vnd" value="" disabled
                           id="moneyPrice">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <span class="">Thời gian bắt đầu:</span>
                    <input type="datetime-local" name="start_date" id="start_date"
                           required
                           min="{{ Carbon\Carbon::now()->addSeconds(600)->format('Y-m-d H:i') }}"
                           class="form-control-lg form-control ">
                    @error('start_date')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <span class="">Thời gian kết thúc:</span>
                    <input type="datetime-local" id="end_date" name="end_date"
                           required
                           min="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}"
                           class="form-control-lg form-control">
                    @error('end_date')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror

                </div>
            </div>


        </div>
        <p class="text-danger" id="message">Phần trăm giảm giá phải nhỏ hơn phần
            trăm còn lại sau chiết
            khấu <span class="discountFinal"></span></p>

    </div>
</div>

<script>
    var VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });
    var discount_ncc = 0;
    var discountVshop = 0;
    document.querySelectorAll('.number').forEach(item => {
        item.addEventListener("keypress", (e) => {
            var regex = new RegExp("^[0-9.]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
    })
    document.getElementsByName('start_date')[0].addEventListener('change', (e) => {
        document.getElementsByName('end_date')[0].setAttribute('min', e.target.value);
    });
    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
    document.getElementById('start_date').addEventListener('change', (e) => {
        $.ajax({
            url: '{{route('check_date')}}?_token={{csrf_token()}}&start_date=' + e.target.value,
            success: function (result) {
                if (result.validated === false) {
                    document.getElementById('message').innerHTML = result.error.end_date;
                    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                } else {
                    document.getElementById('message').innerHTML = '';
                    if (document.getElementById('end_date').value) {
                        $.ajax({
                            url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + document.getElementById('end_date').value + '&start_date=' + document.getElementById('start_date').value,
                            success: function (result) {
                                if (result.validated === false) {
                                    document.getElementById('message').innerHTML = result.error.end_date;
                                    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                } else {
                                    if (document.getElementById('discount1').value && document.getElementById('discount1').value < discount_ncc - discountVshop) {
                                        document.querySelector('.btnSubmit').removeAttribute('disabled');
                                        document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                                        document.getElementById('message').innerHTML = '';
                                    } else {
                                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                        document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${discount_ncc - discountVshop}`;

                                    }

                                }
                            },
                        });
                    }
                }
            },
        });
    });
    document.getElementById('end_date').addEventListener('change', (e) => {
        if (document.getElementById('start_date').value) {
            $.ajax({
                url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + e.target.value + '&start_date=' + document.getElementById('start_date').value,
                success: function (result) {
                    if (result.validated === false) {
                        document.getElementById('message').innerHTML = result.error.end_date;
                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                    } else {
                        if (document.getElementById('discount1').value && document.getElementById('discount1').value < discount_ncc - discountVshop) {
                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                            document.getElementById('message').innerHTML = '';
                        } else {
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${discount_ncc - discountVshop}`;

                        }

                    }
                },
            });
        }
    });
    document.getElementById('discount1').addEventListener('keyup', (o) => {
        const value = +o.target.value;

        if (value < 100 - discountVshop - discount_ncc && value > 0 && document.getElementById('end_date').value && document.getElementById('start_date').value) {
            $.ajax({
                url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + document.getElementById('end_date').value + '&start_date=' + document.getElementById('start_date').value,
                success: function (result) {
                    if (result.validated === false) {
                        document.getElementById('message').innerHTML = result.error.end_date;
                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                    } else {
                        if (value && value < discount_ncc - discountVshop) {
                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                            document.getElementById('message').innerHTML = ``;
                        } else {
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${discount_ncc - discountVshop}`;

                        }

                    }
                },
            });
            document.querySelector('.btnSubmit').removeAttribute('disabled');
            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${discount_ncc - discountVshop}`;
        } else {
            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${discount_ncc - discountVshop}`;

        }
        const price1 = $('#price').val();
        const priceTrue = price1.replaceAll('.', '').replaceAll(',', '').replaceAll(' ', '').replaceAll('đ', '');
        if (priceTrue > 0) {
            let subMoney1 = VND.format(priceTrue * value / 100) || 0 + ' đ';
            $('#moneyPrice').val(subMoney1);
        }

    });
    document.querySelector('.choose-product').addEventListener('change', (e) => {
        const value = e.target.value;
        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
        document.querySelector('.btnSubmit').classList.add('bg-slate-300');

        $.ajax({
            url: '{{route('screens.vstore.product.chooseProduct')}}?_token={{csrf_token()}}&product_id=' + value,
            success: function (result) {
                if (result) {
                    document.querySelector('#price').value = result.price +' đ';
                    document.querySelector('#discount_ncc').value = result.discount + '%';
                    document.querySelector('#discount_vshop').value = result.discount_vShop + '%';
                    discount_ncc = result.discount;
                    discountVshop = result.discount_vShop;
                    if (result.discount > 0) {
                        const priceTrue = (result.price).replaceAll('.', '').replaceAll(',', '');
                        let subMoney1 = VND.format(priceTrue * result.discount / 100) || 0 + ' đ';
                        $('#moneyDis').val(subMoney1);
                    }
                    if (result.discount_vShop > 0) {
                        const priceTrue = (result.price).replaceAll('.', '').replaceAll(',', '');
                        let subMoney2 = VND.format(priceTrue * result.discount_vShop / 100) || 0 + ' đ';
                        $('#moneyMore').val(subMoney2);
                    }

                } else {
                    document.querySelector('#price').value = 0 + ' đ';
                    document.querySelector('#discount_vshop').value = '';
                    document.querySelector('#discount_ncc').value = '';
                    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                    document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${discount_ncc - discountVshop}`;
                }
            },
        });
    });

</script>
