@extends('layouts.manufacture.main')
@section('page_title','Yêu cầu xét duyệt sản phẩm')

@section('modal')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="modal modal-success flex justify-center items-center show-modal">
            <div class="over-lay-modal" onclick="$('.modal-success').toggleClass('show-modal')"></div>
            <div
                class="information bg-[white] flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-success').toggleClass('show-modal')"
                     class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                        fill="white"/>
                </svg>

                <div class="content pt-3 px-3 text-center flex flex-col gap-6">
                    <div class="w-[262px] h-[262px] mx-auto">
                        <img src="{{asset('asset/images/success.gif')}}" class="w-full" alt="">
                    </div>
                    <h2 class="text-title text-2xl font-medium">Gửi yêu cầu niêm yết sản phẩm thành công!</h2>
                </div>
            </div>
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <div class="modal modal-pend flex justify-center items-center show-modal">
            <div class="over-lay-modal" onclick="$('.modal-pend').toggleClass('show-modal')"></div>
            <div
                class="information failed flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px] h-[400px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-pend').toggleClass('show-modal')"
                     class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                        fill="white"/>
                </svg>

                <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
                    <h2 class="text-title text-2xl font-medium">Có lỗi xảy ra, vui lòng thử lại !</h2>

                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary whitespace-nowrap">Sản phẩm</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="" class="text-blueMain font-medium whitespace-nowrap italic">Yêu cầu xét duyệt sản
            phẩm</a>
    </div>
    <div class="px-5 xl:px-16 py-2">
        <h2 class="text-xl md:text-3xl font-medium flex items-center gap-4">
            <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.4"
                      d="M9.98897 20.501L1.87431 24.4191C1.26151 24.7407 0.497103 24.526 0.154355 23.9361C0.0542551 23.7506 0.0013219 23.5445 0 23.3349V14.5648C0 15.4343 0.507167 15.971 1.84123 16.5722L9.98897 20.501Z"
                      fill="url(#paint0_linear_98_611)"/>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M6.11907 0.416626H13.8368C17.2216 0.416626 19.9669 1.70477 20 5.00028V23.3349C19.9986 23.541 19.9457 23.7437 19.8456 23.9253C19.6849 24.2216 19.4074 24.4415 19.0768 24.5347C18.7462 24.6278 18.391 24.5861 18.0926 24.4191L9.98897 20.501L1.84123 16.5721C0.507167 15.971 0 15.4343 0 14.5648V5.00028C0 1.70477 2.74531 0.416626 6.11907 0.416626ZM5.28115 9.62687H14.6858C15.2277 9.62687 15.667 9.19913 15.667 8.67149C15.667 8.14386 15.2277 7.71612 14.6858 7.71612H5.28115C4.73921 7.71612 4.29989 8.14386 4.29989 8.67149C4.29989 9.19913 4.73921 9.62687 5.28115 9.62687Z"
                      fill="url(#paint1_linear_98_611)"/>
                <defs>
                    <linearGradient id="paint0_linear_98_611" x1="4.99449" y1="14.5648" x2="4.99449" y2="24.5684"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#7280FD"/>
                        <stop offset="0.0001" stop-color="#1E90FF"/>
                        <stop offset="1" stop-color="#4062FF"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_98_611" x1="10" y1="0.416626" x2="10" y2="24.5833"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#7280FD"/>
                        <stop offset="0.0001" stop-color="#1E90FF"/>
                        <stop offset="1" stop-color="#4062FF"/>
                    </linearGradient>
                </defs>
            </svg>
            Yêu cầu xét duyệt sản phẩm
        </h2>
    </div>

    <form action="{{route('screens.manufacture.product.storeRequest')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1  gap-y-4 lg:gap-4 px-5 xl:px-16 py-4">
            <div class=" flex flex-col justify-start items-start gap-4 p-5 ">
                <h4 class="font-medium text-[#141414] text-2xl">Thông tin cơ bản</h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 w-full">
                    <div class="col-span-12 flex flex-row justify-start items-start gap-4">
                        <div class="col-span-6 flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Chọn V-Store<strong
                                class="text-[#FF4D4F]">*</strong></span>

                            <div class="w-full">
                                @if(isset($vstore->id))
                                    <div id="boxHid">
                                    </div>
                                    <div id="vstore">
                                        <select disabled
                                                class="th choose-vstore  outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#f0f0f0]  rounded-sm">
                                            <option value="{{$vstore->id}}">{{$vstore->name}}</option>

                                        </select>
                                        @error('vstore_id')
                                        <p class="text-red-600">{{$message}}</p>
                                        @enderror
                                        <input type="hidden" name="vstore_id" value="{{$vstore->id}}">
                                        <button type="button" id="btnAc"
                                                class="p-2 bg-blue-600 text-white mt-2">Thay đổi
                                        </button>

                                    </div>
                                @else
                                    <select name="vstore_id" id="vstore_id"
                                            class="th choose-vstore text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                        <option value="">Chọn V-Store</option>
                                        @foreach($v_stores as $v_store)
                                            <option
                                                {{old('vstore_id') == $v_store->id ? 'selected' : ''}}
                                                value="{{$v_store->id}}">{{$v_store->name}} </option>
                                        @endforeach
                                    </select>
                                    @error('vstore_id')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                @endif

                            </div>

                        </div>
                        <div class="col-span-6 flex flex-col justify-start items-start gap-2 w-full">
                            <div class="flex flex-row justify-start items-start gap-2 w-full ">
                                <div class="col-span-6 w-full">
                                    <p class="text-title font-medium mb-2">VAT (%)<strong
                                            class="text-[#FF4D4F]">*</strong>
                                    </p>

                                    <input type="number" min="0" max="99" name="vat"
                                           value="{{old('vat')}}"
                                           placeholder="Nhập VAT (%)"
                                           class="w-full outline-none  py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                    <span class="total"></span>


                                    @error('vat')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-span-6 w-full">
                                    <p class="text-title font-medium mb-2">Mức chiết khấu (%)<strong
                                            class="text-[#FF4D4F]">*</strong>
                                    </p>

                                    <input type="number" name="discount" id="discount" min="0" max="99"
                                           value="{{old('discount')}}"
                                           placeholder="Nhập mức chiết khấu (%)"
                                           class="w-full outline-none  py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                    <span class="total"></span>


                                    @error('discount')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>


                        </div>

                    </div>


                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-8">
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                                                        <span
                                                            class="text-title font-medium">Chọn sản phẩm xét duyệt <strong
                                                                class="text-[#FF4D4F]">*</strong></span>
                        <select name="product_id" id="product_id"
                                class="th choose-sp text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            <option value="">Chọn sản phẩm cần xét duyệt</option>
                            @foreach($products as $product)
                                <option
                                    value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>

                    <div class=" flex flex-row justify-start items-start gap-2 w-full">
                        <div class="col-span-6 justify-start items-start gap-2 w-full">
                            <p class="text-title font-medium mb-2">Giá (đồng)</p>
                            <input type="text" value="0 đ" name="price" id="price" readonly
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#f0f0f0]  rounded-sm" {{old('price')}}>
                            {{--                            @error('price')--}}
                            {{--                            <p class="text-red-600">{{$message}}</p>--}}
                            {{--                            @enderror--}}
                        </div>
                        <div class="col-span-6 justify-start items-start gap-2 w-full">
                            <p
                                class="text-title font-medium whitespace-nowrap mb-2">Mức chiết khấu (Thành tiền)</p>
                            <input type="text" value="0 đ" name="money" id="money" readonly
                                   class=" outline-none w-full bg-opa py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#f0f0f0]   rounded-sm">
                            {{--                            @error('price')--}}
                            {{--                            <p class="text-red-600">{{$message}}</p>--}}
                            {{--                            @enderror--}}
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-8">
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Vai trò đối với sản phẩm<strong
                                    class="text-[#FF4D4F]">*</strong></span>
                        <select name="role" id="role"
                                class="th choose-vt text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            <option value="">Chọn vai trò</option>
                            <option value="1" {{old('role') == 1 ? 'selected' : '' }}>Nhà sản xuất</option>
                            <option value="2" {{old('role') == 2 ? 'selected' : '' }}>Nhà nhập khẩu</option>
                            <option value="3" {{old('role') == 3 ? 'selected' : '' }}>Nhà phân phối</option>
                        </select>
                    </div>
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Tài liệu sản phẩm <strong
                                class="text-[#FF4D4F]">*</strong></span>
                        {{--                        <div class="file-sp flex justify-center items-start gap-4 flex-wrap md:justify-start"></div>--}}
                        <input type="file" id="images[]" name="images[]" multiple>
                        @error('images')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>

                </div>


                <div class="  items-center gap-8 w-full">
                    <span class="text-title font-med">Chiết khấu hàng nhập sẵn <strong
                            class="text-[#FF4D4F]">*</strong></span>
                    <div class="flex md:flex-row flex-col items-center gap-2 md:gap-8 w-full">

                        <div class="flex flex-col justify-start items-start gap-2 w-full">

                            <span class="text-title font-medium">Số lượng sản phẩm</span>
                            <input type="number" value="{{isset(old('sl')[0]) ? old('sl')[0] : ''}}" required
                                   name="sl[]" id=""
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9]   rounded-sm">
                            <div></div>
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span
                                    class="text-title font-medium whitespace-nowrap">Chiết khấu (%)</span>
                            <input type="number" value="{{isset(old('moneyv')[0]) ? old('moneyv')[0] : ''}}" min="1"
                                   max="100" name="moneyv[]" id=""
                                   class="moneyv outline-none w-full bg-opa py-2 px-3 border-[1px] border-[#D9D9D9]    rounded-sm">
                            <p class="text-red-600 messageE"></p>
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span
                                    class="text-title font-medium whitespace-nowrap">Phần trăm cọc nhập hàng sẵn</span>
                            <input type="number"
                                   value="{{isset(old('deposit_money')[0]) ? old('deposit_money')[0] : ''}}" min="1"
                                   max="100" name="deposit_money[]" id=""
                                   class=" outline-none w-full bg-opa py-2 px-3 border-[1px] border-[#D9D9D9]    rounded-sm">
                            <div></div>
                        </div>
                    </div>
                    <div class="flex md:flex-row flex-col items-center gap-2 md:gap-8 w-full">

                        <div class="flex flex-col justify-start items-start gap-2 w-full">

                            <span class="text-title font-medium">Số lượng sản phẩm</span>
                            <input type="number" value="{{isset(old('sl')[1]) ? old('sl')[1] : ''}}" required
                                   name="sl[]" id=""
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9]   rounded-sm">
                            <div></div>
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span
                                    class="text-title font-medium whitespace-nowrap">Chiết khấu (%)</span>
                            <input type="number" value="{{isset(old('moneyv')[1]) ? old('moneyv')[1] : ''}}" min="1"
                                   max="100" name="moneyv[]"
                                   class="moneyv outline-none w-full bg-opa py-2 px-3 border-[1px] border-[#D9D9D9]    rounded-sm">
                            <p class="text-red-600 messageE"></p>
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span
                                    class="text-title font-medium whitespace-nowrap">Phần trăm cọc nhập hàng sẵn</span>
                            <input type="number"
                                   value="{{isset(old('deposit_money')[1]) ? old('deposit_money')[1] : ''}}" min="1"
                                   max="100" name="deposit_money[]" id=""
                                   class=" outline-none w-full bg-opa py-2 px-3 border-[1px] border-[#D9D9D9]    rounded-sm">
                            <div></div>
                        </div>
                    </div>
                    <div class="flex md:flex-row flex-col items-center gap-2 md:gap-8 w-full">

                        <div class="flex flex-col justify-start items-start gap-2 w-full">

                            <span class="text-title font-medium">Số lượng sản phẩm</span>
                            <input type="number" value="{{isset(old('sl')[2]) ? old('sl')[2] : ''}}" required
                                   name="sl[]" id=""
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9]   rounded-sm">
                            <div></div>
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span
                                    class="text-title font-medium whitespace-nowrap">Chiết khấu (%)</span>
                            <input type="number" value="{{isset(old('moneyv')[2]) ? old('moneyv')[2] : ''}}" min="1"
                                   max="100" name="moneyv[]" id=""
                                   class="moneyv outline-none w-full bg-opa py-2 px-3 border-[1px] border-[#D9D9D9]    rounded-sm">
                            <p class="text-red-600 messageE"></p>
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span
                                    class="text-title font-medium whitespace-nowrap">Phần trăm cọc nhập hàng sẵn</span>
                            <input type="number"
                                   value="{{isset(old('deposit_money')[2]) ? old('deposit_money')[2] : ''}}" min="1"
                                   max="100" name="deposit_money[]" id=""
                                   class=" outline-none w-full bg-opa py-2 px-3 border-[1px] border-[#D9D9D9]    rounded-sm">
                            <div></div>
                        </div>

                    </div>
                    @error('sl')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                    @error('deposit_money')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>


                <h4 class="font-medium text-[#141414] text-2xl">Thanh toán</h4>
                <div class="flex flex-col justify-start items-start gap-4">
                <span class="text-title font-medium">Phương thức thanh toán<strong
                        class="text-[#FF4D4F]">*</strong></span>
                    <div class="flex justify-start items-center gap-4 flex-wrap">
                        <div>
                            <input type="radio" name="prepay"
                                   {{old('prepay') == 1 ? 'checked' : ''}} value="1"
                                   class="accent-primary w-4 h-4">
                            <span class="text-s   document.getElementById('discount')econdary">Chỉ thanh toán trước</span>
                        </div>
                        <div>
                            <input type="radio" name="prepay" value="2" {{old('prepay') == 2 ? 'checked' : ''}}
                            class="accent-primary w-4 h-4">
                            <span class="text-s">Tất cả phương thức thanh toán</span>
                        </div>
                        {{--                        <div>--}}
                        {{--                            <input type="checkbox" name="prepay[]"--}}
                        {{--                                   {{isset(old('prepay')[1]) && old('prepay')[1] == 2 ? 'checked' : ''}} value="2"--}}
                        {{--                                   class="accent-primary w-4 h-4">--}}
                        {{--                            <span class="text-secondary">Thanh toán sau khi nhận hàng</span>--}}
                        {{--                        </div>--}}

                    </div>
                </div>
                @error('prepay')
                <p class="text-red-600">{{$message}}</p>
                @enderror


                <div class="flex justify-center md:justify-center items-center gap-5  w-full">
                    <a href="{{route('screens.manufacture.product.index')}}"
                       class="outline-none rounded-xl  px-[20px] md:px-[45px] py-2 transition-all duration-500 hover:opacity-70 text-[#1D1D1D] bg-[#C6E6FF]">
                        Hủy
                        bỏ
                    </a>
                    <button
                        class="btnGra outline-none rounded-xl  px-[20px] md:px-[45px] py-2 transition-all duration-500 hover:opacity-70 text-white">
                        Tạo yêu cầu
                    </button>
                </div>
            </div>


        </div>
    </form>

@endsection

@section('custom_js')
    <script>
        const discounts = document.querySelectorAll('.moneyv');

        discounts.forEach((item, index) => {
            item.addEventListener('keyup', (e) => {
                if (document.getElementsByName('discount')[0].value && Number(document.getElementsByName('discount')[0].value) + Number(e.target.value) >= 100) {
                    document.querySelectorAll('.messageE')[index].innerHTML = `Phần trăm chiết khẩu phải nhỏ hơn ${100 - Number(document.getElementsByName('discount')[0].value)}`;
                    document.querySelector('.btnGra ').style.display = 'none';
                } else {
                    document.querySelectorAll('.messageE')[index].innerHTML = '';
                    if (document.querySelectorAll('.messageE')[0].innerHTML == '' && document.querySelectorAll('.messageE')[1].innerHTML == '' && document.querySelectorAll('.messageE')[2].innerHTML == '') {
                        document.querySelector('.btnGra ').style.display = 'block';
                    }

                }
            });
        })
        document.getElementsByName('discount')[0].addEventListener('keyup', (e) => {
            if (e.target.value > 100) {
                document.getElementById('discount').value = 100;
            }
            discounts.forEach((item, index) => {

                if (document.getElementsByName('discount')[0].value && Number(e.target.value) + Number(item.value) >= 100) {
                    document.querySelectorAll('.messageE')[index].innerHTML = `Phần trăm chiết khẩu phải nhỏ hơn ${100 - Number(document.getElementsByName('discount')[0].value)}`;
                    document.querySelector('.btnGra ').style.display = 'none';
                } else {
                    document.querySelectorAll('.messageE')[index].innerHTML = '';
                    if (document.querySelectorAll('.messageE')[0].innerHTML == '' && document.querySelectorAll('.messageE')[1].innerHTML == '' && document.querySelectorAll('.messageE')[2].innerHTML == '') {
                        document.querySelector('.btnGra ').style.display = 'block';
                    }

                }
            })
        });
        $(".js-example-tags").select2({
            tags: true
        });
        let i = 1;
        let arrImage = [];
        let arrUnit = [];
        $('select').select2();
    </script>
    <script>
        let price = 0;
        let discount = 0;
        const VND = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        });
        $('#product_id').on('select2:select', function (e) {
            // Do something
            var data = e.params.data;
            if (data.id) {
                $.ajax({
                    url: '{{route('screens.manufacture.product.getDataProduct')}}/?product_id=' + data.id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        price = result;
                        document.getElementById('price').value = VND.format(price);
                        document.getElementById('money').value = VND.format((discount / 100) * price);
                    },
                });
            } else {
                price = 0;
                document.getElementById('price').value = VND.format(price);
                document.getElementById('money').value = VND.format((discount / 100) * price);
            }
        });
        document.getElementById('discount').addEventListener('keyup', (e) => {
            discount = e.target.value;
            if (discount > 100) {
                document.getElementById('discount').value = 100;
            }
            if (discount) {
                document.getElementById('money').value = VND.format((e.target.value / 100) * price);
            } else {
                document.getElementById('money').value = '0 đ';
            }
        })
    </script>

    @if(isset($vstore->id))
        <script>
            function abc() {
                document.getElementById('btnAc').addEventListener('click', () => {
                    document.getElementById('boxHid').innerHTML = `
                                               <select name="vstore_id" id="vstore_id"
                                                                       class="th choose-vstore text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                                                                                    <option value="" disabled selected>Chọn V-Store</option>
                                                                                                    @foreach($v_stores as $v_store)
                    <option
{{old('vstore_id') == $v_store->id ? 'selected' : ''}}
                    value="{{$v_store->id}}">{{$v_store->name}} </option>
                                                                   @endforeach
                    </select>
                                                 <button type="button" id="btnRe" class="p-2 bg-blue-600 text-white mt-2">Bỏ chọn</button>
@error('vstore_id')
                    <p class="text-red-600">{{$message}}</p>
                                                                                                @enderror
                    `;
                    document.getElementById('vstore').innerHTML = '';
                    document.getElementById('btnRe').addEventListener('click', () => {
                        document.getElementById('boxHid').innerHTML = '';
                        document.getElementById('vstore').innerHTML = `
                   <select disabled
                                            class="th choose-vstore  outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#f0f0f0]  rounded-sm">
                                        <option value="{{$vstore->id}}">{{$vstore->name}}</option>
                                    </select>
                                    @error('vstore_id')
                        <p class="text-red-600">{{$message}}</p>
                                    @enderror
                        <input type="hidden" name="vstore_id" value="{{$vstore->id}}">
                                    <button type="button" id="btnAc"
                                            class="p-2 bg-blue-600 text-white mt-2">Thay đổi
                                    </button>
                `;
                        abc();
                    });
                })
            }

            abc();
        </script>
    @endif
@endsection
