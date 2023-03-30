<form action="{{route('screens.vstore.product.updateDis',['id' => $discount->id])}}" method="POST">
    <div class="modal modal-details ">
        <div class="over-lay-modal" onclick="$('.modal-details').toggleClass('show-modal')"></div>
        <div
            class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-4">
            <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                <div></div>
                <h2 class=" text-title font-semibold text-xl">Cập nhật giảm giá</h2>
                <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                     onclick="$('.modal-details').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                        fill="black" fill-opacity="0.45"/>
                </svg>
            </div>
            <div class="content  max-h-[600px] overflow-y-auto">
                @csrf
                <div class="flex flex-col justify-start items-start gap-4 py-3 w-full">
                    <div class=" gap-4 w-full">
                        <span class="text-title font-medium w-[150px]">Lựa chọn sản phẩm tạo mã:</span>
                        <select name="product_id" id="product_id"
                                class="h-[42px] choose-product  outline-none w-full px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">

                            <option value="{{$product1->id}}" selected>{{$product1->name}}</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="gap-4 w-full">
                        <span class="text-title font-medium  ">Giá sản phẩm (đ):</span>
                        <input disabled name="price" id="price" value="{{$product1->price}}"
                               class="h-[42px] choose-vstore  outline-none w-full px-3 border-[1px] border-[#D9D9D9] bg-[#f0f0f0] focus:border-primary transition-all duration-200 rounded-sm">
                    </div>
                    <div class="gap-4 w-full">
                        <span class="text-title font-medium  ">Phần trăm chiết khấu từ nhà cung cấp (%):</span>
                        <input disabled name="discount_ncc" id="discount_ncc" value="{{$product1->discount}}"
                               class="h-[42px] choose-vstore  outline-none w-full px-3 border-[1px] border-[#D9D9D9] bg-[#f0f0f0] focus:border-primary transition-all duration-200 rounded-sm">
                    </div>
                    <div class="gap-4 w-full">
                        <span class="text-title font-medium  ">Phần trăm chiết khấu cho Vshop (%):</span>
                        <input disabled name="discount_vshop" id="discount_vshop" value="{{$product1->discount_vShop}}"
                               class="h-[42px] choose-vstore  outline-none w-full px-3 border-[1px] border-[#D9D9D9] bg-[#f0f0f0] focus:border-primary transition-all duration-200 rounded-sm">
                    </div>
                    <div class="gap-4 w-full">
                        <span class="text-title font-medium  ">Phần trăm giảm giá (%):</span>
                        <input name="discount" id="discount" value="{{$discount->discount}}"
                               class="h-[42px] choose-vstore outline-none w-full px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div>
                            <span class="text-title font-medium  ">Ngày bắt đầu:</span>
                            <input type="datetime-local" id="start_date" name="start_date"
                                   value="{{$discount->start_date}}" required
                                   min="{{ Carbon\Carbon::now()->addMinutes(10)->format('Y-m-d H:i') }}"
                                   class="h-[42px] choose-vstore outline-none w-full px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('start_date')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <span class="text-title font-medium  ">Ngày kết thúc:</span>
                            <input type="datetime-local" id="end_date" name="end_date" value="{{$discount->end_date}}"
                                   required
                                   min="{{ Carbon\Carbon::parse($discount->end_date)->format('Y-m-d H:i') }}"
                                   class="h-[42px] choose-vstore outline-none w-full px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('end_date')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>

                    </div>
                    <p class="text-red-600" id="message">Phần trăm giảm giá phải nhỏ hơn phần trăm còn lại sau chiết
                        khấu</p>
                </div>
                <div class="flex justify-end items-center gap-4 ">
                    <button
                        class="btnSubmit cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3  text-center text-[#FFFFFF] hover:opacity-70"
                    >Lưu thay đổi
                    </button>
                    <a
                        class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70"
                        onclick="$('.modal-details').toggleClass('show-modal')">Đóng lại
                    </a>
                </div>
            </div>
        </div>
    </div>

</form>

<script>
    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
    document.getElementsByName('start_date')[0].addEventListener('change', (e) => {
        document.getElementsByName('end_date')[0].setAttribute('min', e.target.value);
    });
    document.getElementById('discount').addEventListener('keyup', (o) => {
        const value = +o.target.value;
        if (value < document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value
            && value > 0) {
            document.querySelector('.btnSubmit').removeAttribute('disabled');
            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');


        } else {
            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
        }

    });
    document.getElementById('start_date').addEventListener('change', (e) => {
        $.ajax({
            url: '{{route('check_date')}}?_token={{csrf_token()}}&start_date=' + e.target.value,
            success: function (result) {
                if (!result.validated) {
                    document.getElementById('message').innerHTML = result.error.end_date;
                    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                } else {
                    document.getElementById('message').innerHTML = '';
                    if (document.getElementById('end_date').value) {
                        $.ajax({
                            url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + document.getElementById('end_date').value + '&start_date=' + document.getElementById('start_date').value,
                            success: function (result) {
                                if (!result.validated) {
                                    document.getElementById('message').innerHTML = result.error.end_date;
                                    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                } else {
                                    if (document.getElementById('discount').value > 0 && document.getElementById('discount').value < document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value) {
                                        document.querySelector('.btnSubmit').removeAttribute('disabled');
                                        document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                                        document.getElementById('message').innerHTML = '';
                                    } else {
                                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                        document.getElementById('message').innerHTML = 'Phần trăm giảm giá phải nhỏ hơn phần trăm còn lại sau chiết khấu';

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
                    console.log(result);
                    if (!result.validated) {
                        document.getElementById('message').innerHTML = result.error.end_date;
                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');

                    } else {
                        document.querySelector('.btnSubmit').removeAttribute('disabled');
                        document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                        document.getElementById('message').innerHTML = '';
                        if (document.getElementById('discount').value > 0 && document.getElementById('discount').value < document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value) {
                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                            document.getElementById('message').innerHTML = '';
                        } else {
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                            document.getElementById('message').innerHTML = 'Phần trăm giảm giá phải nhỏ hơn phần trăm còn lại sau chiết khấu';

                        }
                    }
                },
            });
        }
    });
    document.querySelector('.choose-product').addEventListener('change', (e) => {
        const value = e.target.value;
        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
        $.ajax({
            url: '{{route('screens.vstore.product.chooseProduct')}}?_token={{csrf_token()}}&product_id=' + value,
            success: function (result) {
                console.log(result)
                if (result) {
                    document.querySelector('#price').value = result.price;
                    document.querySelector('#discount_vshop').value = result.discount_vShop;
                    document.querySelector('#discount_ncc').value = result.discount;
                    document.getElementById('discount').value = 0;
                    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                    document.getElementById('discount').addEventListener('keyup', (o) => {
                        const value = +o.target.value;

                        if (value < (Number(result.discount - result.discount_vShop)) && value > 0 &&
                            document.getElementById('start_date').value && document.getElementById('end_date').value) {
                            $.ajax({
                                url: '{{route('check_date')}}?_token={{csrf_token()}}&end_date=' + e.target.value + '&start_date=' + document.getElementById('start_date').value,
                                success: function (result) {
                                    if (!result.validated) {
                                        document.getElementById('message').innerHTML = result.error.end_date;
                                        document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                        document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                    } else {
                                        if (document.getElementById('discount').value > 0 && document.getElementById('discount').value < document.querySelector('#discount_ncc').value - document.querySelector('#discount_vshop').value) {
                                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                                            document.getElementById('message').innerHTML = '';
                                        } else {
                                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                                            document.getElementById('message').innerHTML = 'Phần trăm giảm giá phải nhỏ hơn phần trăm còn lại sau chiết khấu';

                                        }

                                    }
                                },
                            });
                            document.querySelector('.btnSubmit').removeAttribute('disabled');
                            document.querySelector('.btnSubmit').classList.remove('bg-slate-300');
                        } else {
                            document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                            document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                        }

                    });
                } else {
                    document.querySelector('#price').value = 0 + ' đ';
                    document.querySelector('#discount_vshop').value = ''
                    document.querySelector('#discount_ncc').value = ''
                    document.querySelector('.btnSubmit').setAttribute('disabled', 'true');
                    document.querySelector('.btnSubmit').classList.add('bg-slate-300');
                }
                // console.log(result);
            },
        });
    });
</script>
