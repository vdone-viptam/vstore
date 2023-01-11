@extends('layouts.admin.main')

@section('modal')
    <div class="modal modal-hd @if(\Illuminate\Support\Facades\Session::has('validate')) show-modal @endif">
        <div class="over-lay-modal" onclick="$('.modal-hd').toggleClass('show-modal')"></div>
        <form action="{{route('screens.admin.account.editPro',['id' => $infoAccount->id])}}" method="POST">
            <div
                class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-10 md:mt-24">
                <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                    <h2 class="text-base text-title font-medium">Chỉnh sửa hồ sơ</h2>
                    <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                         onclick="$('.modal-hd').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                            fill="black" fill-opacity="0.45"/>
                    </svg>
                </div>
                @csrf
                <div class="content  max-h-[600px] overflow-y-auto">
                    <div class="flex flex-col justify-start items-start gap-6 p-6 w-full ">
                        <div class="flex justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-[280px]">Tên V-Store:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="name" name="name"
                                       class="w-full outline-none py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->name}}">
                                @error('name')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>


                        </div>

                        <div class="flex justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-[280px]">Tên Công ty:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="company_name" name="company_name"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->company_name}}">
                                @error('company_name')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-[280px]">Mã số thuê:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="tax_code" name="tax_code"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->tax_code}}">
                                @error('tax_code')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-[280px]">Địa chỉ:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="address" id="address"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->address}}">
                                @error('address')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-[280px]">Số diện thoại:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="phone_number" name="phone_number"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->phone_number}}">
                                @error('phone_number')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-[280px]">ID người đại diện:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="id_vdone" id="id_vdone"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->id_vdone}}">
                                @error('id_vdone')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-[280px]">ID người đại diện (khác):</span>
                            <input type="text" name="id_vdone_diff" id="id_vdone_diff"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                   value="{{$infoAccount->id_vdone_diff}}">
                        </div>


                    </div>
                    <div class="flex justify-end items-center gap-4 px-6">
                        <button type="button"
                                class=" cursor-pointer outline-none bg-[#FFF] transition-all duration-200 rounded-sm py-2 px-3 text-center text-title hover:opacity-70 border-[1px] border-secondary"
                                onclick="$('.modal-hd').toggleClass('show-modal')">Đóng lại
                        </button>
                        <button
                            class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70">
                            Lưu lại
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        <div class="col-span-3">
            <div class="p-6 border-b-[1px] border-grey">
                <div class="flex flex-col justify-start items-start w-full">
                    <div class="flex justify-start items-center gap-6 w-full">
                        <div class="w-[49px]">
                            <div class="w-[48px] h-[48px] rounded-full">
                                <a href="../tai-khoan/"><img
                                        src="{{$infoAccount->avatar ? asset('image/users/'.$infoAccount->avatar) : asset('asset/images/success.png')}}"
                                        alt=""
                                        class="w-full rounded-full"></a>
                            </div>
                        </div>
                        <div class="flex flex-col justify-start items-center gap-1 text-center">
                            <span class="text-title font-medium">{{$infoAccount->account_code}}</span>
                            <span class="text-sm text-secondary">Sửa hồ sơ</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <ul class="tab-side-user flex flex-col justify-start items-start gap-3 w-full">

                    <li><a href="#" class="flex justify-start items-center gap-3">
                            <div class="w-[21px]">
                                <div class="w-[20px] h-[20px] rounded-full">
                                    <img src="https://cf.shopee.vn/file/ba61750a46794d8847c3f463c5e71cc4" alt=""
                                         class="w-full rounded-full">
                                </div>
                            </div>
                            <span class="text-title">Tài khoản</span>
                        </a>
                        <ul class="tab-sub-user">
                            <li class="active"><a href="{{route('screens.admin.account.profile')}}">Hồ sơ</a></li>
                            <li><a href="{{route('screens.admin.account.changePassword')}}">Đổi mật khẩu</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-span-9">
            <div class="box w-full">
                <div class="flex flex-col justify-start items-start w-full p-6">
                    <div class="flex flex-col justify-start items-start gap-1 pb-6 border-b-[1px] border-grey w-full">
                        <h3 class="captilize font-medium text-xl text-title">Hồ sơ của tôi</h3>
                        <span class="text-secondary text-sm">Quản lý thông tin hồ sơ để bảo mật tài khoản</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 md:gap-y-0 w-full md:p-6 ">
                        <div class="col-span-8 order-last md:order-first">
                            <div class="flex flex-col justify-start items-start gap-6 md:p-6 w-full ">
                                <div class="flex justify-start items-start gap-4">
                                    <span class="text-secondary">Tên V-Store:</span>
                                    <span>{{$infoAccount->name}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Tên công ty: </span>
                                    <span>{{$infoAccount->company_name}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Mã số thuế:</span>
                                    <span>{{$infoAccount->tax_code}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Địa chỉ:</span>
                                    <span>{{$infoAccount->address}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Số điện thoại: </span>
                                    <span>{{$infoAccount->phone_number}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">ID Người đại diện:</span>
                                    <span>{{$infoAccount->id_vdone}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">ID Người đại diện (khác):</span>
                                    <span>{{$infoAccount->id_vdone_diff}}</span>
                                </div>

                                <div class="flex justify-start items-center gap-4 ">
                                    <a href="#"
                                       class="edit-hs cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 w-full text-center text-[#FFFFFF] hover:opacity-70">
                                        Chỉnh sửa thông tin
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 order-first md:order-last">
                            <form action="{{route('screens.admin.account.upload',['id' => $infoAccount->id])}}"
                                  id="form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="flex flex-col justify-center items-center gap-4 w-full text-center border-l-0 md:border-l-[2px] border-grey">
                                    <div class="w-[101px] file-avt">
                                        <div class="w-[100px] h-[100px] rounded-full shadow-xl">
                                            <img
                                                src="{{$infoAccount->avatar ? asset('image/users/'.$infoAccount->avatar) : asset('asset/images/success.png')}}"
                                                alt=""
                                                class="w-full rounded-full">
                                        </div>
                                    </div>
                                    <button type="button"
                                            class="change-avt flex justify-center items-center border-[1px] rounded-sm border-grey px-4 py-2 outline-none hover:bg-primary hover:text-[#FFF] transition-all duration-200">
                                        Chọn ảnh
                                    </button>
                                    <div id="image"></div>
                                    {{--                                    <span class="text-secondary text-sm w-[200px]">Dụng lượng file tối đa 1 MB--}}
                                    {{--                                    Định dạng:.JPEG, .PNG</span>--}}
                                    {{--                                    <div class="flex flex-col justify-center items-center text-center gap-4 w-full p-4">--}}
                                    {{--                                        <div class="w-full file-banner">--}}
                                    {{--                                            <div class="w-full h-[100px] rounded-full shadow-xl">--}}
                                    {{--                                                <img--}}
                                    {{--                                                    src="{{asset('image/users/'.$infoAccount->banner) ?? asset('asset/images/bannerlg.png')}}"--}}
                                    {{--                                                    alt="" class="w-full">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <button type="button"--}}
                                    {{--                                                class="change-bn flex justify-center items-center border-[1px] rounded-sm border-grey px-4 py-2 outline-none hover:bg-primary hover:text-[#FFF] transition-all duration-200">--}}
                                    {{--                                            Chọn ảnh Banner--}}
                                    {{--                                        </button>--}}
                                    {{--                                        <div id="image2"></div>--}}
                                    {{--                                        --}}{{--                                        <span class="text-secondary text-sm w-[200px]">Dụng lượng file tối đa 1 MB--}}
                                    {{--                                        --}}{{--                                            Định dạng:.JPEG, .PNG</span>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

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
@endsection
