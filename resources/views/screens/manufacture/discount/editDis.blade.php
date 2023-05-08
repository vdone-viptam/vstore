<div class="">
    @csrf

    <div class="col-12">
        <div class="form-group">
            <label>Lựa chọn sản phẩm tạo giảm giá</label>
            <select name="product_id" id="product_id" readonly
                    class="form-control-lg form-control choose-product">
                <option
                    value="{{$product1->id}}" selected>{{$product1->name}}</option>
            </select>
        </div>
        <div class="form-group">
            <label class="">Giá sản phẩm:</label>
            <input disabled name="price" id="price"
                   class="form-control form-control-lg" value="{{number_format($product1->price,0,'.','.')}} đ">
        </div>
        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Chiết khấu cho V-Store:</label>
                    <input disabled name="discount_ncc" id="discount_ncc"
                           class="form-control-lg form-control" value="{{$product1->discount}}%">
                </div>
                <div class="col-6">
                    <label class="">Chiết khấu cho V-Store (thành tiền):</label>
                    <input type="text" class="form-control form-control-lg" id="moneyDis" disabled
                           placeholder=""
                           value="{{number_format($product1->price * ($product1->discount / 100),0,'.','.') }} đ">
                </div>
            </div>
        </div>
        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Chiết khấu mua nhiều:</label>
                    <input disabled name="buy_more" id="buy_more"
                           class="form-control-lg form-control" value="{{$product1->buy_more}}%">
                </div>
                <div class="col-6">
                    <label class="">Chiết khấu mua nhiều (thành tiền):</label>
                    <input type="text" class="form-control form-control-lg" id="moneyMore" disabled
                           placeholder=""
                           value="{{number_format($product1->price * ($product1->buy_more / 100),0,'.','.') }} đ">
                </div>
            </div>
        </div>

        <div class="form-group">

            <div class="row">
                <div class="col-6">
                    <label class="">Phần trăm giảm giá:</label>
                    <input name="discount" id="discount1"
                           class="form-control-lg form-control" value="{{$discount->discount}}">
                </div>
                <div class="col-6">
                    <label class="">Giảm giá (thành tiền):</label>
                    <input type="text" class="form-control form-control-lg" id="moneyPrice" disabled
                           value=" {{number_format($product1->price * ($discount->discount / 100),0,'.','.')}} đ">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-6">
                    <span class="">Thời gian bắt đầu:</span>
                    <input type="datetime-local" name="start_date" id="start_date"
                           required value="{{$discount->start_date}}"
                           min="{{ Carbon\Carbon::now()->addSeconds(600)->format('Y-m-d H:i') }}"
                           class="form-control-lg form-control ">
                    @error('start_date')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-6">
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

        </div>
        <p class="text-danger" id="message">Phần trăm giảm giá phải nhỏ hơn phần
            trăm còn lại sau chiết
            khấu <span class="discountFinal"></span></p>
    </div>


</div>
</div>

<script>
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
    var VND = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    });
    var discount_ncc = {{$product1->discount}};
    var buy_more = {{$product1->buy_more}};
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
                                    if (document.getElementById('discount1').value && document.getElementById('discount1').value < 100 - buy_more - discount_ncc) {
                                        document.querySelector('.btnSubmit').removeAttribute('disabled');
                                        document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                                        document.getElementById('message').innerHTML = '';
                                    } else {
                                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                        document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - buy_more - discount_ncc}`;

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
                        if (document.getElementById('discount1').value && document.getElementById('discount1').value < 100 - buy_more - discount_ncc) {
                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                            document.getElementById('message').innerHTML = '';
                        } else {
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - buy_more - discount_ncc}`;

                        }

                    }
                },
            });
        }
    });
    document.getElementById('discount1').addEventListener('keyup', (o) => {
        const value = +o.target.value;

        if (value < 100 - buy_more - discount_ncc && value > 0 && document.getElementById('end_date').value && document.getElementById('start_date').value) {
            $.ajax({
                url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + document.getElementById('end_date').value + '&start_date=' + document.getElementById('start_date').value,
                success: function (result) {
                    if (result.validated === false) {
                        document.getElementById('message').innerHTML = result.error.end_date;
                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                    } else {
                        if (value && value < 100 - buy_more - discount_ncc) {
                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                            document.getElementById('message').innerHTML = ``;
                        } else {
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - buy_more - discount_ncc}`;

                        }

                    }
                },
            });
            document.querySelector('.btnSubmit').removeAttribute('disabled');
            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - buy_more - discount_ncc}`;
        } else {
            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
            document.getElementById('message').innerHTML = `Phần trăm giảm giá phải nhỏ hơn ${100 - buy_more - discount_ncc}`;

        }

        const price1 = $('#price').val();
        const priceTrue = price1.replaceAll('.', '').replaceAll(',', '').replaceAll(' ', '').replaceAll('đ', '');
        if (priceTrue > 0) {
            let subMoney1 = VND.format(priceTrue * value / 100) || 0 + 'đ';
            $('#moneyPrice').val(subMoney1);
        }
    });

</script>
