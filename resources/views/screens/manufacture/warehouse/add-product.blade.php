@extends('layouts.manufacture.main')
@section('page_title','Thêm sản phẩm vào kho')

@section('content')

    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Kho hàng</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black" stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"></path>
        </svg>
        <a href="" class="text-blueMain font-medium italic">Thêm sản phẩm vào kho</a>
    </div>

    <div class="px-5 xl:px-16 py-2">
    <h2 class="text-xl md:text-3xl font-medium flex items-center gap-4"><svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.4" d="M9.98897 20.501L1.87431 24.4191C1.26151 24.7407 0.497103 24.526 0.154355 23.9361C0.0542551 23.7506 0.0013219 23.5445 0 23.3349V14.5648C0 15.4343 0.507167 15.971 1.84123 16.5722L9.98897 20.501Z" fill="url(#paint0_linear_98_611)"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M6.11907 0.416626H13.8368C17.2216 0.416626 19.9669 1.70477 20 5.00028V23.3349C19.9986 23.541 19.9457 23.7437 19.8456 23.9253C19.6849 24.2216 19.4074 24.4415 19.0768 24.5347C18.7462 24.6278 18.391 24.5861 18.0926 24.4191L9.98897 20.501L1.84123 16.5721C0.507167 15.971 0 15.4343 0 14.5648V5.00028C0 1.70477 2.74531 0.416626 6.11907 0.416626ZM5.28115 9.62687H14.6858C15.2277 9.62687 15.667 9.19913 15.667 8.67149C15.667 8.14386 15.2277 7.71612 14.6858 7.71612H5.28115C4.73921 7.71612 4.29989 8.14386 4.29989 8.67149C4.29989 9.19913 4.73921 9.62687 5.28115 9.62687Z" fill="url(#paint1_linear_98_611)"/>
<defs>
<linearGradient id="paint0_linear_98_611" x1="4.99449" y1="14.5648" x2="4.99449" y2="24.5684" gradientUnits="userSpaceOnUse">
<stop stop-color="#7280FD"/>
<stop offset="0.0001" stop-color="#1E90FF"/>
<stop offset="1" stop-color="#4062FF"/>
</linearGradient>
<linearGradient id="paint1_linear_98_611" x1="10" y1="0.416626" x2="10" y2="24.5833" gradientUnits="userSpaceOnUse">
<stop stop-color="#7280FD"/>
<stop offset="0.0001" stop-color="#1E90FF"/>
<stop offset="1" stop-color="#4062FF"/>
</linearGradient>
</defs>
</svg>
Thêm sản phẩm vào kho</h2>

    </div>
    @if(Session::has('message'))
        <p class="text-green-600 px-5 xl:px-16 py-2">{{Session::get('message')}}</p>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-12  gap-y-4 lg:gap-4 px-5 xl:px-16 py-4">
        <div class="flex flex-col justify-start items-start gap-4 p-5 col-span-12">
            <h4 class="font-medium text-[#141414] text-2xl">Thông tin cơ bản</h4>
            <form  method="POST" class="w-full flex flex-col justify-start items-start gap-6">
                @csrf
            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 md:gap-8 w-full">
                <div class="col-span-6 flex flex-col justify-start items-start gap-4">
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Chọn sản phẩm<strong
                                class="text-[#FF4D4F]">*</strong></span>
                        <select name="product_id" id="product_id"
                                class="chon_sp th choose-vstore text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            <option value="">Chọn sản phẩm</option>

                            @foreach($products as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach

{{--                            <option value="1">V-store 1</option>--}}
{{--                            <option value="2">V-store 2</option>--}}
                        </select>
                        @error('product_id')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>


                </div>
                <div class="col-span-6 flex flex-col justify-start items-start gap-4">
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Chọn kho hàng<strong
                                class="text-[#FF4D4F]">*</strong></span>
                        <select name="ware_id" id="ware_id"
                                class="th choose-vstore text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            <option value="">Chọn kho hàng</option>

                            @foreach($warehouses as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
{{--                            <option value="1">V-store 1</option>--}}
{{--                            <option value="2">V-store 2</option>--}}
                        </select>
                        @error('ware_id')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
{{--                <div class="col-span-6 flex flex-col justify-start items-start gap-2 ">--}}
{{--                        <span class="text-title font-medium">Số lượng tồn (sản phẩm):--}}
{{--                        </span>--}}
{{--                        <input disabled type="number"  value=""--}}
{{--                               class="view-amount outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">--}}
{{--                    </div>--}}
                <div class="col-span-6 flex flex-col justify-start items-start gap-4">

                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Số lượng sản phẩm<strong
                                class="text-[#FF4D4F]">*</strong></span>
                        <input type="number" name="amount"  placeholder="Nhập số lượng sản phẩm"
                               class="amount outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        @error('amount')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-end items-center gap-5  w-full">
                <a href="{{route('screens.manufacture.warehouse.index')}}" id=""huy_bo class="outline-none rounded-xl  px-[30px] md:px-[45px] py-2 transition-all duration-500 hover:opacity-70 text-[#1D1D1D] bg-[#C6E6FF]">Hủy
                    bỏ</a>
                <button type="submit" style="background: linear-gradient(180deg, #7280FD 0%, #7280FD 0.01%, #4C5DF4 100%) ;" class="btnGra outline-none rounded-xl  px-[30px] md:px-[45px] py-2 transition-all duration-500 hover:opacity-70 text-[#FFF]">Lưu lại</button>
            </div>
            </form>
        </div>


    </div>

@endsection
@section('custom_js')
    <script>
        $('.change-avt').on('click', function () {
            let input = document.createElement('input');
            input.type = 'file';
            // input.name = 'img'
            // input.setAttribute('hidden', 'true')
            input.setAttribute('name', 'img');
            input.click();

            input.onchange = _ => {
                var files = Array.from(input.files);
                const reader = new FileReader();
                $('#form').submit();
                return new Promise(resolve => {
                    reader.onload = ev => {
                        resolve(ev.target.result)


                        $('.file-avt').html(` <div class="w-[100px] h-[100px] rounded-full shadow-xl">
            <img src="${ev.target.result}" alt="" class="w-full rounded-full">
        </div>`)
                    }
                    reader.readAsDataURL(files[0])

                })


            };
            $('#image').append(input);
        })

        $('.change-bn').on('click', function () {
            let input = document.createElement('input');
            input.type = 'file';

            input.setAttribute('name', 'banner');
            input.click();
            input.onchange = _ => {
                var files = Array.from(input.files);
                const reader = new FileReader();
                $('#form').submit();
                return new Promise(resolve => {
                    reader.onload = ev => {
                        resolve(ev.target.result)
                        $('.file-banner').html(`  <div class="w-full h-[100px] rounded-full shadow-xl">
            <img src="${ev.target.result}" alt="" class="w-full">
        </div>`)
                    }
                    reader.readAsDataURL(files[0])

                })
            };
            $('#image2').append(input);
        })
    </script>
    <script>

        $(".js-example-tags").select2({
            tags: true
        });
        $('.choose-vstore').select2();

    </script>
    <script>
        $(".chon_sp").change(function() {

            var val = $("#ware_id").val();
            if(val >0){
                $.ajax({
                    url:' {{route('amount')}}',
                    type: 'GET',
                    data: {
                        product_id: $('#product_id').val(),
                        ware_id: $('#ware_id').val()
                    },
                    dataType: 'json',
                    success:function (data){

                        console.log(data);
                        $('.view-amount').val(data)

                    }
                });
            }



        });
        $("#ware_id").change(function() {

            var val = $(".chon_sp").val();
            if(val >0){
                $.ajax({
                    url:' {{route('amount')}}',
                    type: 'GET',
                    data: {
                        product_id: $('#product_id').val(),
                        ware_id: $('#ware_id').val()
                    },
                    dataType: 'json',
                    success:function (data){

                        console.log(data);
                        $('.view-amount').val(data)

                    }
                });
            }



        });
    </script>
    <script>
        // $('#huy_bo').click(function (){
        //     window.location.replace("http://nha_cung_cap.ngo/add-product-warehouse");
        // })


    </script>
@endsection
