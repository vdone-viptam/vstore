<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu V-Store</title>
    <link rel="stylesheet" href="{{asset('asset/css/forgot.css')}}">
    <link rel="stylesheet" href={{asset('asset/dist/forgot.css')}}>
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite('resources/css/app.css')
</head>
<body>
<!-- modal tk cho duyet -->
<div class="modal modal-pend flex justify-center items-center">
    <div class="over-lay-modal" onclick="$('.modal-pend').toggleClass('show-modal')"></div>
    <div
        class="information pending flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px] h-[400px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
        <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-pend').toggleClass('show-modal')"
             class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
             fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                fill="white"/>
        </svg>

        <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
            <h2 class="text-title text-2xl font-medium">Tài khoản của bạn đang chờ duyệt</h2>
            <span
                class="text-[#000]">Thông tin đăng ký của bạn đang chờ duyệt. Vui lòng chờ kết quả trong vòng (n giờ)</span>
        </div>
    </div>
</div>
<!-- modal tk k dc duyet -->
<div class="modal modal-failed flex justify-center items-center">
    <div class="over-lay-modal" onclick="$('.modal-failed').toggleClass('show-modal')"></div>
    <div
        class="information failed flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px] h-[400px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
        <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-failed').toggleClass('show-modal')"
             class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
             fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                fill="white"/>
        </svg>

        <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
            <h2 class="text-title text-2xl font-medium">Tài khoản của bạn không được duyệt</h2>
            <span
                class="text-[#000]">Thông tin đăng ký của bạn đang chờ duyệt. Vui lòng chờ kết quả trong vòng (n giờ)</span>
        </div>
    </div>
</div>

<div class=" grid grid-cols-1 place-items-center translate-y-[4rem]">
    <div
        class="login flex flex-col justify-start items-start gap-6 md:gap-10 xl:px-10 p-10 px-4 lg:px-10 shadow-2xl bg-[#FFF] rounded-xl w-full  md:w-[500px] ">
        <div class="w-[162px]">
            @if($role_id == 3)
                <a href="{{route('login_vstore')}}"><img src="{{asset('asset/images/Logo.png')}}" alt=""></a>
            @elseif($role_id == 2)
                <a href="{{route('login_ncc')}}"> <img src="{{asset('asset/images/Logoncc.png')}}" alt=""></a>
            @elseif($role_id == 4)
                <a href="{{route('login_storage')}}"> <img src="{{asset('asset/images/logokho.png')}}" alt=""></a>
            @elseif($role_id == 1)
                <a href="{{route('login_admin')}}"><img src="{{asset('asset/images/Logo.png')}}" alt=""></a>
            @endif
        </div>
        <h1 class="text-4xl font-medium max-w-[520px]">Quên mật khẩu</h1>

        <form action="#" method="post" class="w-full" id="form-log">
            @csrf
            @csrf
            @if(\Illuminate\Support\Facades\Session::has('success'))
                <h4 style="color: green">{{\Illuminate\Support\Facades\Session::get('success')}}</h4>
            @endif
            @if(\Illuminate\Support\Facades\Session::has('error'))
                <h4 style="color: red">{{\Illuminate\Support\Facades\Session::get('error')}}</h4>
            @endif
            <div class="flex flex-col justify-center items-center gap-6 w-full py-6">
                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-sm"><strong class="text-[#FF4D4F]">*</strong> Email </span>
                    <input type="hidden" name="role_id" value="{{$role_id}}">
                    <input type="email" name="email" placeholder="Nhập email"
                           class="usr-email outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    @error('email')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                {{--                <div class="flex flex-col justify-start items-start gap-2 w-full">--}}
                {{--                    <span class="text-sm"><strong class="text-[#FF4D4F]">*</strong> Mật khẩu</span>--}}
                {{--                    <div class="pass w-full relative">--}}
                {{--                        <input type="password" name="pass" placeholder="Nhập mật khẩu" class="usr-pass outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">--}}
                {{--                        <div class="password">--}}
                {{--                            <svg width="16" height="16" class="icon cursor-pointer absolute top-[13px] right-[10px]" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
                {{--                                <path d="M15.6822 7.53757C15.0545 6.21507 14.3075 5.1365 13.4412 4.30185L12.5326 5.21043C13.2735 5.91846 13.9188 6.84471 14.4769 7.99828C12.9912 11.0733 10.8822 12.534 8.0001 12.534C7.13498 12.534 6.33813 12.4008 5.60956 12.1344L4.6251 13.1188C5.637 13.5861 6.762 13.8197 8.0001 13.8197C11.4322 13.8197 13.993 12.0322 15.6822 8.45721C15.7502 8.31344 15.7854 8.1564 15.7854 7.99739C15.7854 7.83838 15.7502 7.68135 15.6822 7.53757ZM14.5471 1.81185L13.7858 1.04971C13.7725 1.03643 13.7568 1.02589 13.7394 1.0187C13.7221 1.01151 13.7035 1.00781 13.6847 1.00781C13.666 1.00781 13.6474 1.01151 13.63 1.0187C13.6127 1.02589 13.5969 1.03643 13.5837 1.04971L11.6306 3.00185C10.5538 2.45185 9.34367 2.17685 8.0001 2.17685C4.56796 2.17685 2.00724 3.96435 0.317957 7.53935C0.250055 7.68313 0.21484 7.84017 0.21484 7.99918C0.21484 8.15818 0.250055 8.31522 0.317957 8.459C0.992837 9.88043 1.80534 11.0198 2.75546 11.877L0.865814 13.7661C0.839043 13.7929 0.824005 13.8293 0.824005 13.8671C0.824005 13.905 0.839043 13.9413 0.865814 13.9681L1.62813 14.7304C1.65492 14.7572 1.69125 14.7722 1.72912 14.7722C1.76699 14.7722 1.80331 14.7572 1.8301 14.7304L14.5471 2.014C14.5603 2.00073 14.5709 1.98497 14.5781 1.96763C14.5853 1.95029 14.589 1.9317 14.589 1.91293C14.589 1.89415 14.5853 1.87556 14.5781 1.85822C14.5709 1.84088 14.5603 1.82512 14.5471 1.81185ZM1.52331 7.99828C3.01081 4.92328 5.11974 3.46257 8.0001 3.46257C8.97403 3.46257 9.85956 3.62971 10.663 3.96953L9.4076 5.22489C8.81308 4.90768 8.13234 4.78996 7.46582 4.88908C6.7993 4.9882 6.18228 5.29893 5.7058 5.77541C5.22931 6.2519 4.91859 6.86891 4.81947 7.53544C4.72034 8.20196 4.83807 8.88269 5.15528 9.47721L3.66563 10.9669C2.84117 10.2392 2.13046 9.25328 1.52331 7.99828ZM5.92867 7.99828C5.92898 7.6834 6.00357 7.37303 6.14637 7.09238C6.28917 6.81174 6.49615 6.56874 6.75051 6.38312C7.00487 6.1975 7.29943 6.0745 7.61025 6.02411C7.92108 5.97372 8.23941 5.99736 8.53938 6.0931L6.02349 8.609C5.96043 8.41157 5.92844 8.20554 5.92867 7.99828Z" fill="black" fill-opacity="0.45"/>--}}
                {{--                                <path d="M7.92897 10.0012C7.86719 10.0012 7.80629 9.99839 7.74594 9.99286L6.80272 10.9361C7.37003 11.1533 7.98812 11.2016 8.58228 11.0751C9.17643 10.9485 9.72122 10.6526 10.1508 10.2231C10.5803 9.7935 10.8763 9.24871 11.0028 8.65455C11.1293 8.0604 11.0811 7.4423 10.8638 6.875L9.92058 7.81821C9.92612 7.87857 9.92897 7.93946 9.92897 8.00125C9.92911 8.26393 9.87748 8.52407 9.77702 8.76678C9.67656 9.0095 9.52925 9.23003 9.3435 9.41578C9.15776 9.60152 8.93722 9.74884 8.69451 9.8493C8.45179 9.94976 8.19166 10.0014 7.92897 10.0012Z" fill="black" fill-opacity="0.45"/>--}}
                {{--                            </svg>--}}
                {{--                        </div>--}}

                {{--                    </div>--}}
                {{--                </div>--}}
            </div>

            {{--            <div class="flex justify-between items-center w-full">--}}

            {{--                <a href="{{route('login')}}" class="font-medium text-[#096DD9]">Đăng nhập</a>--}}
            {{--            </div>--}}
            <div class="mt-24 text-center w-full flex flex-col justify-center items-center gap-10">
                <input type="submit"
                       class="cursor-pointer hover:opacity-70 transition-all duration-200 btn-ctn text-center w-full text-white text-xl font-medium rounded-lg py-4 bg-sky-500/100"
                       value="Đồng ý"></input>
                {{--                <button type="submit" class="text-red-300"> Đòng ý</button>--}}
                {{--                <span class="text-xl font-medium w-full">Bạn chưa có tài khoản? <a href="{{route('register')}}" class="text-primary hover:opacity-70 transition-all duration-500">Đăng ký ngay</a></span>--}}
            </div>

        </form>
    </div>

</div>
{{--<script src="{{asset('asset/js/main.js')}}"></script>--}}
</body>
</html>
