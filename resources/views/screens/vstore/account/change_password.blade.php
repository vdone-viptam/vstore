@extends('layouts.vstore.main')

@section('page_title','Đổi mật khẩu')

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
                <div class="col-span-12">
                    <div class="box w-full">

                        <div class="flex flex-col justify-start items-start w-full p-6">
                            <div
                                class="flex flex-col justify-start items-start pb-6 border-b-[1px] border-grey w-full gap-2">
                                <h3 class="captilize font-medium text-xl text-title">Đổi mật khẩu</h3>
                                <span class="text-secondary">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</span>

                            </div>

                            <div class="flex flex-col justify-center items-center pt-6 md:gap-6 gap-y-4 w-full md:p-6 ">
                                <div class="flex justify-start items-center gap-4 w-full flex-wrap md:flex-nowrap">
                                    <span class="w-full text-title font-medium">Mật khẩu cũ</span>
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
