@extends('layouts.vstore.main')

@section('modal')
    <form action="{{route('screens.vstore.account.saveChangePassword')}}" method="POST">
        @csrf
        <div class="modal modal-acp">
            <div class="over-lay-modal" onclick="$('.modal-acp').toggleClass('show-modal')"></div>
            <div
                class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-10 md:mt-24">
                <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                    <h2 class="text-base text-title font-medium">Thay đổi mật khẩu</h2>
                    <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                         onclick="$('.modal-acp').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                            fill="black" fill-opacity="0.45"/>
                    </svg>
                </div>
                <div class="content  max-h-[600px] overflow-y-auto">
                    <div class="flex flex-col justify-start items-center gap-4 py-3 w-full text-center">
                        <h2 class="text-title font-medium uppercase"> Bạn có chắc chắn muốn thực hiện không?</h2>
                    </div>
                    <div class="flex justify-end items-center gap-4 ">
                        <button type="button"
                                class=" cursor-pointer outline-none bg-[#FFF] transition-all duration-200 rounded-sm py-2 px-3 text-center text-title hover:opacity-70 border-[1px] border-secondary"
                                onclick="$('.modal-acp').toggleClass('show-modal')">Đóng lại
                        </button>
                        <button
                            class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70">
                            Xác nhận
                        </button>
                    </div>
                </div>
            </div>
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
                                        <a href="../tai-khoan/"><img src="{{asset('asset/images/success.png')}}" alt=""
                                                                     class="w-full rounded-full"></a>
                                    </div>
                                </div>
                                <div class="flex flex-col justify-start items-center gap-1 text-center">
                                    <span class="text-title font-medium">ttkhoa1999</span>
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
                                    <li><a href="{{route('screens.vstore.account.profile')}}">Hồ sơ</a></li>
                                    <li class="active"><a
                                            href="{{route('screens.vstore.account.changePassword')}}">Đổi mật
                                            khẩu</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-9 ">
                    <div class="box w-full">

                        <div class="flex flex-col justify-start items-start w-full p-6">
                            <div
                                class="flex flex-col justify-start items-start pb-6 border-b-[1px] border-grey w-full gap-2">
                                <h3 class="captilize font-medium text-xl text-title">Đổi mật khẩu</h3>
                                <span class="text-secondary">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</span>
                                @if(\Illuminate\Support\Facades\Session::has('success'))
                                    <h4 class="text-green-600">{{Illuminate\Support\Facades\Session::get('success')}}</h4>
                                @endif
                            </div>

                            <div class="flex flex-col justify-center items-center pt-6 md:gap-6 gap-y-4 w-full md:p-6 ">
                                <div class="flex justify-start items-center gap-4 w-full flex-wrap md:flex-nowrap">
                                    <span class="w-full text-title font-medium">Mật khẩu mới</span>
                                    <input type="password" name="old_password" value="{{old('old_password')}}"
                                           class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full">
                                    <div class="w-full">
                                        @error('old_password')
                                        <p class="text-red-600">{{$message}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full flex-wrap md:flex-nowrap">
                                    <span class="w-full text-title font-medium">Mật khẩu mới</span>
                                    <input type="password" name="password" value="{{old('password')}}"
                                           class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full">
                                    <div class="w-full">
                                        @error('password')
                                        <p class="text-red-600">{{$message}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full flex-wrap md:flex-nowrap">
                                    <span class="w-full text-title font-medium">Xác nhận mật khẩu</span>
                                    <input type="password" name="password_confirmation"
                                           value="{{old('password_confirmation')}}"
                                           class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full">
                                    <div class="w-full">
                                        @error('password_confirmation')
                                        <p class="text-red-600">{{$message}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex justify-center items-center">
                                    <a href="#"
                                       class="btn-acp cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70">
                                        Xác nhận
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
    </form>
@endsection

@section('custom_js')
    <script>
        $('.btn-acp').on('click', function () {
            $('.modal-acp').toggleClass('show-modal');
        })
    </script>
@endsection
