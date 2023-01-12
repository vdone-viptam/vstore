@extends('layouts.manufacture.main')

@section('content')

    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Kho hàng</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black" stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"></path>
        </svg>
        <a href="./them-san-pham.html" class="text-blueMain font-medium">Thêm sản phẩm vào kho</a>
    </div>

    <div class="px-5 xl:px-16 py-2">
        <h2 class="text-4xl text-title font-medium">Thêm sản phẩm vào kho</h2>
    </div>
    @if(Session::has('message'))
        <p class="text-green-600 px-5 xl:px-16 py-2">{{Session::get('message')}}</p>
    @endif
    <div class="grid grid-cols-1  gap-y-4 lg:gap-4 px-5 xl:px-16 py-4">
        <div class="box-act flex flex-col justify-start items-start gap-4 p-5 shadow-lg">
            <h4 class="font-medium text-[#141414] text-2xl">Thông tin cơ bản</h4>
            <form  method="POST" class="w-full flex flex-col justify-start items-start gap-6">
                @csrf
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 w-full">
                <div class="col-span-6 flex flex-col justify-start items-start gap-4">
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Chọn sản phẩm<strong
                                class="text-[#FF4D4F]">*</strong></span>
                        <select name="product_id" id=""
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
                        <select name="ware_id" id=""
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
                <div class="col-span-12 flex flex-col justify-start items-start gap-4">
                    <div class="flex flex-col justify-start items-start gap-2 ">
                        <span class="text-title font-medium">Số lượng tồn (sản phẩm):
                        </span>
                        <input disabled type="number" min="0" max="" value=""
                               class="view-amount outline-none w-[100px] py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    </div>
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Số lượng sản phẩm<strong
                                class="text-[#FF4D4F]">*</strong></span>
                        <input type="number" name="amount" placeholder="Nhập số lượng sản phẩm"
                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        @error('amount')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex justify-center flex-wrap md:flex-nowrap md:justify-center items-center gap-5  w-full">
                <button class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 text-title">Hủy
                    bỏ</button>
                <button type="submit" class="bg-[#0d6efd] outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 bg-primary text-[#FFF]">Lưu lại</button>
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
            var val = $(".chon_sp").val();
            $.ajax({
                url:' {{route('amount')}}',
                type: 'GET',
                dataType: 'json',
                success:function (data){
                    console.log(data);
                    $('.view-amount').val(data)
                }
            });
            // alert( a );
        });
    </script>
@endsection
