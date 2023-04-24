<div class="">
    @csrf
    <div class="col-12">
        <div class="form-group">
            <label>Lựa chọn sản phẩm tạo giảm giá</label>
            <select name="product_id" id="product_id" readonly
                    class="form-control-lg form-control choose-product">
                <option
                    value="{{$product1->id}}" selected >{{$product1->name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label class="">Giá sản phẩm (đ):</label>
            <input disabled name="price" id="price"
                   class="form-control form-control-lg" value="{{$product1->price}}">
        </div>
        <div class="form-group">
            <label class="">Phần trăm chiết khấu từ nhà cung cấp (%):</label>
            {{-- <input disabled name="discount_ncc" id="discount_ncc" value="{{$product1->discount}}"
                   class="form-control-lg form-control"> --}}
            <div class="input-group mb-3">
                <input disabled name="discount_ncc" id="discount_ncc" value="{{$product1->discount}}"
                   class="form-control-lg form-control">
                <span class="input-group-text percent-to-vnd">
                    {{number_format($product1->price * $product1->discount *10,0,'.','.')}} đ
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="">Phần trăm chiết khấu cho V-Shop (%):</label>
            {{-- <input disabled name="discount_vshop" id="discount_vshop" value="{{$product1->discount_vShop}}"
                   class="form-control form-control-lg"> --}}
            <div class="input-group mb-3">
                <input disabled name="discount_vshop" id="discount_vshop" value="{{$product1->discount_vShop}}"
                   class="form-control form-control-lg">
                <span class="input-group-text percent-to-vnd">
                    {{number_format($product1->price * $product1->discount_vShop *10,0,'.','.')}} đ
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="">Phần trăm giảm giá (%):</label>
            {{-- <input name="discount" id="discount1" type="number" value="{{$discount->discount}}"
                   class="form-control form-control-lg"> --}}
            <div class="input-group mb-3">
                <input name="discount" id="discount1" type="number" value="{{$discount->discount}}"
                   class="form-control form-control-lg">
                <span class="input-group-text percent-to-vnd">
                    {{number_format($product1->price * $product1->discount *10,0,'.','.')}} đ
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <span class="">Ngày bắt đầu:</span>
                <input type="datetime-local" name="start_date" id="start_date"
                       required value="{{$discount->start_date}}"
                       min="{{ Carbon\Carbon::now()->addSeconds(600)->format('Y-m-d H:i') }}"
                       class="form-control-lg form-control ">
                @error('start_date')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <span class="">Ngày kết thúc:</span>
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
                    console.log(result)
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
                                    if (document.getElementById('discount1').value && document.getElementById('discount1').value < document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value) {
                                        document.querySelector('.btnSubmit').removeAttribute('disabled');
                                        document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                                        document.getElementById('message').innerHTML = '';
                                    } else {
                                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                        document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value}`;

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
                        if (document.getElementById('discount1').value && document.getElementById('discount1').value < document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value) {
                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                            document.getElementById('message').innerHTML = '';
                        } else {
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value}`;

                        }

                    }
                },
            });
        }
    });
    document.getElementById('discount1').addEventListener('keyup', (o) => {
        const value = +o.target.value;

        if (value < 100 - document.querySelector('#discount_vshop').value - document.querySelector('#discount_ncc').value && value > 0 && document.getElementById('end_date').value && document.getElementById('start_date').value) {
            $.ajax({
                url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + document.getElementById('end_date').value + '&start_date=' + document.getElementById('start_date').value,
                success: function (result) {
                    if (result.validated === false) {
                        document.getElementById('message').innerHTML = result.error.end_date;
                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                    } else {
                        if (value && value < document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value) {
                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                            document.getElementById('message').innerHTML = ``;
                        } else {
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value}`;

                        }

                    }
                },
            });
            document.querySelector('.btnSubmit').removeAttribute('disabled');
            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value}`;
        } else {
            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value}`;

        }
        const price1 = $('#price').val();
        const priceTrue = price1.replaceAll('.', '').replaceAll(',', '');
        if(priceTrue > 0){
            let subMoney1 = VND.format(priceTrue * value / 100) || 0 + ' đ';
            $('#discount1').siblings(".percent-to-vnd").html(subMoney1);
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
                    console.log(result)
                    document.querySelector('#price').value = result.price;
                    document.querySelector('#discount_ncc').value = result.discount;
                    document.querySelector('#discount_vshop').value = result.discount_vShop;

                    if(result.discount > 0){
                        const priceTrue = (result.price).replaceAll('.', '').replaceAll(',', '');
                        let subMoney1 = VND.format(priceTrue * result.discount / 100) || 0 + ' đ';
                        $('#discount_ncc').siblings(".percent-to-vnd").html(subMoney1);
                    }
                    if(result.discount_vShop > 0){
                        const priceTrue = (result.price).replaceAll('.', '').replaceAll(',', '');
                        let subMoney2 = VND.format(priceTrue * result.discount_vShop / 100) || 0 + ' đ';
                        $('#discount_vshop').siblings(".percent-to-vnd").html(subMoney2);
                    }

                } else {
                    document.querySelector('#price').value = 0 + ' đ';
                    document.querySelector('#discount_vshop').value = ''
                    document.querySelector('#discount_ncc').value = ''
                    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                    document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value}`;
                }
                // console.log(result);
            },
        });
    });

</script>
