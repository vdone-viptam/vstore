<div class="">
    @csrf
    <div class="col-12">
        <div class="form-group">
            <label for="">Tên sản phẩm</label>
                <input  value="{{$product1->name}}" readonly
                       class="form-control-lg form-control choose-product"/>
            <input name="product_id" value="{{$product1->id}}" type="hidden"
                   class="form-control-lg form-control choose-product"/>
        </div>
        <div class="form-group">
            <label class="">Giá sản phẩm:</label>
            <input disabled name="price" id="price"
                   class="form-control form-control-lg" value="{{number_format($product1->price,0,'.','.')}} đ">
        </div>
        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Chiết khấu từ nhà cung cấp:</label>
                    <input disabled name="discount_ncc" id="discount_ncc" value="{{$product1->discount}}%"
                           class="form-control-lg form-control">
                </div>
                <div class="col-6">
                    <label class="">Chiết khấu từ nhà cung cấp (thành tiền):</label>
                    <input class="form-control percent-to-vnd form-control-lg" disabled id="moneyDis"
                           value="{{number_format($product1->price * ($product1->discount / 100),0,'.','.')}} đ">
                </div>
            </div>
        </div>
        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Chiết khấu cho V-Shop:</label>
                    <input disabled name="discount_vshop" id="discount_vshop" value="{{$product1->discount_vShop}}%"
                           class="form-control form-control-lg">
                </div>
                <div class="col-6">
                    <label class="">Chiết khấu cho V-Shop (thành tiền):</label>
                    <input class="form-control percent-to-vnd form-control-lg" disabled id="moneyMore"
                           value=" {{number_format($product1->price * ($product1->discount_vShop / 100),0,'.','.')}} đ"
                    >
                </div>
            </div>

        </div>
        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Phần trăm giảm giá:</label>
                    <input name="discount" id="discount1" type="text" value="{{$discount->discount}}"
                           class="form-control form-control-lg number">
                </div>
                <div class="col-6">
                    <label class="">Giảm giá (thành tiền):</label>
                    <input class="form-control form-control-lg percent-to-vnd" disabled id="moneyPrice"
                           value="{{number_format($product1->price * ($product1->discount / 100),0,'.','.')}} đ">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <span class="">Thời gian bắt đầu:</span>
                <input type="datetime-local" name="start_date" id="start_date"
                       required value="{{$discount->start_date}}"
                       class="form-control-lg form-control ">
                @error('start_date')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <span class="">Thời gian kết thúc:</span>
                <input type="datetime-local" id="end_date" name="end_date"
                       required value="{{$discount->end_date}}"
                       min="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}"
                       class="form-control-lg form-control">
                @error('end_date')
                <p class="text-red-600">{{$message}}</p>
                @enderror

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
    var discount_ncc = {{$product1->discount}};
    var discountVshop = {{$product1->discount_vShop}};

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

</script>
