@extends('layouts.manufacture.main')
@section('page_title','Danh sách địa chỉ kho hàng')
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
                    <h2 class="text-title text-2xl font-medium">{{\Illuminate\Support\Facades\Session::get('success')}}</h2>
                </div>
            </div>
        </div>
    @endif
    <form action="{{route('screens.manufacture.account.saveCreate')}}" method="POST">
        <div class="modal modal-address @if(count($errors->all())) show-modal @endif">

            @csrf
            <div class="over-lay-modal" onclick="$('.modal-address').toggleClass('show-modal')"></div>
            <div
                class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-10 md:mt-24">
                <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                    <h2 class="text-base text-title font-medium">Địa chỉ mới</h2>
                    <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                         onclick="$('.modal-address').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                            fill="black" fill-opacity="0.45"/>
                    </svg>
                </div>
                <div class="content  max-h-[600px] overflow-y-auto">
                    @foreach($errors->all() as $error)
                        <p class="text-red-600">{{$error}}</p>
                    @endforeach
                    <div class="flex flex-col justify-start items-start gap-4 py-3 w-full">

                        <div class="flex justify-between flex-wrap md:flex-nowrap items-center gap-4 w-full">
                            <input type="text" name="name"
                                   class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                                   placeholder="Tên">
                            <input type="text" name="phone_number"
                                   class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                                   placeholder="Số điện thoại">
                        </div>
                        <div class="flex flex-col justify-start items-start gap-4 py-3 w-full">

                            <div class="flex justify-between flex-wrap md:flex-nowrap items-center gap-4 w-full">
                                <select
                                    class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                                    name="city_id" id="city" aria-label=".form-select-sm">
                                    <option value="" selected>Chọn tỉnh thành</option>
                                </select>

                                <select
                                    class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                                    name="district_id" id="district" aria-label=".form-select-sm">
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>

                                <select
                                    class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                                    name="ward_id" id="ward" aria-label=".form-select-sm">
                                    <option value="" selected>Chọn phường xã</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-2 w-full">
                        <textarea name="address" placeholder="Địa chỉ cụ thể"
                                  class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"></textarea>
                        </div>
                    </div>


                    <div class="flex justify-end items-center gap-4 ">
                        <button type="button"
                                class=" cursor-pointer outline-none bg-[#FFF] transition-all duration-200 rounded-sm py-2 px-3 text-center text-title hover:opacity-70 border-[1px] border-secondary"
                                onclick="$('.modal-address').toggleClass('show-modal')">Đóng lại
                        </button>
                        <button
                            class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70">
                            Lưu lại
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <!-- modal dia chi -->
    <!-- modal edit dia chi -->
    <div id="edit">

    </div>
    <div id="delete">

    </div>
@endsection


@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        {{--        <div class="col-span-3">--}}
        {{--            <div class="p-6 border-b-[1px] border-grey">--}}
        {{--                <div class="flex flex-col justify-start items-start w-full">--}}
        {{--                    <div class="flex justify-start items-center gap-6 w-full">--}}
        {{--                        <div class="w-[49px]">--}}
        {{--                            <div class="w-[48px] h-[48px] rounded-full">--}}
        {{--                                <a href="{{route('screens.manufacture.account.profile')}}"><img--}}
        {{--                                        src="{{$infoAccount->avatar ? asset('image/users/'.$infoAccount->avatar) : asset('asset/images/success.png')}}"--}}
        {{--                                        alt=""--}}
        {{--                                        class="w-full rounded-full"></a>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <div class="flex flex-col justify-start items-center gap-1 text-center">--}}
        {{--                            <span class="text-title font-medium">{{$infoAccount->account_code}}</span>--}}
        {{--                            <span class="text-sm text-secondary">Sửa hồ sơ</span>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="p-6">--}}
        {{--                <ul class="tab-side-user flex flex-col justify-start items-start gap-3 w-full">--}}

        {{--                    <li><a href="#" class="flex justify-start items-center gap-3">--}}
        {{--                            <div class="w-[21px]">--}}
        {{--                                <div class="w-[20px] h-[20px] rounded-full">--}}
        {{--                                    <img src="https://cf.shopee.vn/file/ba61750a46794d8847c3f463c5e71cc4" alt=""--}}
        {{--                                         class="w-full rounded-full">--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <span class="text-title text-lg font-medium">Tài khoản</span>--}}
        {{--                        </a>--}}
        {{--                        <ul class="tab-sub-user">--}}
        {{--                            <li><a href="{{route('screens.manufacture.account.profile')}}">Hồ sơ</a></li>--}}
        {{--                            <li class="active"><a href="{{route('screens.manufacture.account.address')}}">Địa chỉ kho--}}
        {{--                                    hàng</a>--}}
        {{--                            </li>--}}
        {{--                            <li><a href="{{route('screens.manufacture.account.changePassword')}}">Đổi mật khẩu</a></li>--}}
        {{--                        </ul>--}}
        {{--                    </li>--}}
        {{--                    <!-- <li><a href="#" class="flex justify-start items-center gap-3"><div class="w-[21px]">--}}
        {{--                        <div class="w-[20px] h-[20px] rounded-full">--}}
        {{--                            <img src="https://cf.shopee.vn/file/f0049e9df4e536bc3e7f140d071e9078" alt="" class="w-full rounded-full">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <span class="text-title">Đơn mua</span>--}}
        {{--                </a></li>--}}
        {{--                <li><a href="#" class="flex justify-start items-center gap-3"><div class="w-[21px]">--}}
        {{--                    <div class="w-[20px] h-[20px] rounded-full">--}}
        {{--                        <img src="https://cf.shopee.vn/file/e10a43b53ec8605f4829da5618e0717c" alt="" class="w-full rounded-full">--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <span class="text-title">Thông báo</span>--}}
        {{--            </a></li>--}}
        {{--            <li><a href="#" class="flex justify-start items-center gap-3"><div class="w-[21px]">--}}
        {{--                <div class="w-[20px] h-[20px] rounded-full">--}}
        {{--                    <img src="https://cf.shopee.vn/file/84feaa363ce325071c0a66d3c9a88748" alt="" class="w-full rounded-full">--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <span class="text-title">Kho Voucher</span>--}}
        {{--            </a></li>--}}
        {{--            <li><a href="#" class="flex justify-start items-center gap-3"><div class="w-[21px]">--}}
        {{--                <div class="w-[20px] h-[20px] rounded-full">--}}
        {{--                    <img src="https://cf.shopee.vn/file/a0ef4bd8e16e481b4253bd0eb563f784" alt="" class="w-full rounded-full">--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <span class="text-title">Shoppe Xu</span>--}}
        {{--            </a></li> -->--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="col-span-12 ">
            <div class="box w-full">
                <div class="flex flex-col justify-start items-start w-full p-6">
                    <div
                        class="flex justify-between items-center pb-6 border-b-[1px] border-grey w-full flex-wrap gap-4 md:flex-nowrap">
                        <h3 class="captilize font-medium text-xl text-title">Địa chỉ nhận hàng</h3>
                        <button
                            class="btn-add-address cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 text-center text-[#FFFFFF] hover:opacity-70 flex justify-start items-center gap-2">
                            <svg enable-background="new 0 0 10 10" viewBox="0 0 10 10" x="0" y="0"
                                 class="cursor-pointer w-4 h-4 fill-[#FFF]">
                                <polygon
                                    points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5"></polygon>
                            </svg>
                            Thêm địa chỉ mới
                        </button>
                    </div>
                    @foreach($infoAccount->Warehouses() as $warehouse)
                        <div class="flex flex-col justify-start items-start pt-6 md:gap-6 gap-y-4 w-full md:p-6 ">
                            <span class="text-title text-xl font-medium">Địa chỉ{{$loop->iteration}} </span>
                            <div class="flex justify-between flex-wrap md-flex-nowrap items-start w-full gap-4">
                                <div class="flex flex-col justify-start items-start gap-2">
                                    <div class="flex justify-start items-center flex-wrap md:flex-nowrap">
                                        <span
                                            class="text-title text-lg md:border-r-[1px] border-r-0 border-secondary pr-2">{{$warehouse->name}}</span>
                                        <span class="text-title text-lg md:pl-2">{{$warehouse->phone_number}}</span>
                                    </div>

                                    <span class="text-secondary">{{$warehouse->address}}</span>


                                </div>
                                <div class="flex justify-start items-center gap-2">
                                    <a href="#" data-id="{{$warehouse->id}}"
                                       class="edit-address text-primary font-medium hover:opacity-70 transition-all duration-200">Cập
                                        nhật</a>
                                    {{--                                    <a href="#" data-id="{{$warehouse->id}}"--}}
                                    {{--                                       class="delete-address text-primary font-medium hover:opacity-70 transition-all duration-200">--}}
                                    {{--                                        Xóa</a>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div>

                        @include('layouts.custom.paginator', ['paginator' => $infoAccount->Warehouses()])
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('custom_js')
    <script>
        $('.edit-address').each(function (i, e) {
            $(this).on('click', (o) => {
                $.ajax({
                    url: '{{route('screens.manufacture.account.edit')}}?id=' + e.dataset.id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        $('#edit').html('');
                        $('#edit').append(result);
                        $('.modal-edit-add').toggleClass('show-modal')
                    },
                });
            });
        });


        // on('click', function () {
        //     $('.modal-dell').toggleClass('show-modal')
        // })
    </script>
    <script !src="">
        const divCity = document.getElementById('city');
        const divDistrict = document.getElementById('district');
        const divWard = document.getElementById('ward');
        $(function () {


            $.ajax({
                url: "https://provinces.open-api.vn/api/p",
                type: 'GET',
                success: function (result) {
                    divCity.innerHTML +=
                        `${
                            result.map(item => `<option value="${item.code}">${item.name}</option>`).join('')
                        }`;
                }
            });
            divCity.addEventListener('change', (e) => {
                const id = e.target.value;
                if (+id !== 0) {
                    $.ajax({
                        url: `https://provinces.open-api.vn/api/p/${id}/?depth=2`,
                        type: 'GET',
                        success: function (result) {
                            divDistrict.innerHTML = '<option value="">Lựa chọn huyện</option>' + result.districts.map(districtitem => `<option value="${districtitem.code}">${districtitem.name}</option>`).join('');

                        }
                    });
                } else {
                    divDistrict.innerHTML = '<option value="">Bạn chưa chọn thành phố</option>';
                }

            })
            divDistrict.addEventListener('change', (e) => {
                const id = e.target.value;
                if (+id !== 0) {
                    $.ajax({
                        url: `https://provinces.open-api.vn/api/d/${id}?depth=2`,
                        type: 'GET',
                        success: function (result) {
                            divWard.innerHTML = '<option value="">Lựa chọn phường xã</option>' + result.wards.map(wardItem => `<option value="${wardItem.code}">${wardItem.name}</option>`).join('');
                        }
                    });
                } else {
                    divWard.innerHTML = '<option value="">Bạn chưa chọn quận huyện</option>';
                }
            })
        });

    </script>
@endsection
