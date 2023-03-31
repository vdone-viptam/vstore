<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="{{asset('asset/css/forgot.css')}}">
    <link rel="stylesheet" href={{asset('asset/dist/forgot.css')}}>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
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

<div class=" grid grid-cols-1 place-items-center">
    <div
        class="login flex flex-col justify-start items-start gap-10 xl:px-10 p-10 px-4 lg:px-10 shadow-2xl bg-[#FFF] rounded-xl w-full md:w-[500px]">
        {{--        <a href="../" class="flex justify-start items-center gap-2 hover:opacity-75 transition-all duration-500">--}}
        {{--            <div>--}}
        {{--                <img src="{{asset('asset/icons/back.png')}}" alt="">--}}
        {{--            </div>--}}
        {{--            <span class="text-title">Quay lại</span>--}}
        {{--        </a>--}}
        <div class="w-[162px]">
            @if($role_id == 3)
                <a href="{{route('login_vstore')}}"><img src="{{asset('asset/images/logo.png')}}" alt=""></a>
            @elseif($role_id == 2)
                <a href="{{route('login_ncc')}}"> <img src="{{asset('home/img/NCC.png')}}" alt=""></a>
            @elseif($role_id == 4)
                <a href="{{route('login_storage')}}"> <img src="{{asset('home/img/titleK.png')}}" alt=""></a>
            @elseif($role_id == 1)
                <a href="{{route('login_admin')}}"><img src="{{asset('asset/images/logo.png')}}" alt=""></a>
            @endif
        </div>
        <h1 class="text-4xl font-medium max-w-[520px]">Quên mật khẩu</h1>

        <form action="#" method="post" class="w-full" id="form-log">
            @csrf
            <div class="flex flex-col justify-center items-center gap-6 w-full py-8">
                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-sm"><strong class="text-[#FF4D4F]">*</strong> Mật khẩu mới </span>
                    <input type="password" name="password" placeholder="Nhập mật khẩu mới"
                           class="usr-email outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    @error('password')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror

                </div>

                <input type="hidden" value="{{$role_id}}" name="role_id">
                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-sm"><strong class="text-[#FF4D4F]">*</strong> Xác nhận mật khẩu </span>
                    <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu mới"
                           class="usr-email outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    @error('password_confirmation')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
            </div>

         <div class="ms-3">
             <p style="font-weight: bold">Mật khẩu bao gồm:</p>
             <p>Ít nhất 8 ký tự</p>
             <p>Ít nhất 1 ký tự số</p>
             <p>Ít nhất 1 ký tự viết hoa</p>
             <p>Ít nhất 1 ký tự đặc biệt</p></div>

            <div class="mt-12 text-center w-full flex flex-col justify-center items-center gap-10">
                <input type="submit"
                       class="btnA cursor-pointer hover:opacity-70 transition-all duration-200 btn-ctn text-center w-full text-white text-xl font-medium rounded-lg py-4 bg-sky-500/100"
                       value="Đồng ý"></input>
                {{--                                <button type="submit" class="text-red-300"> Đòng ý</button>--}}
                {{--                <span class="text-xl font-medium w-full">Bạn chưa có tài khoản? <a href="{{route('register')}}" class="text-primary hover:opacity-70 transition-all duration-500">Đăng ký ngay</a></span>--}}
            </div>

        </form>
    </div>

</div>
{{--<script src="{{asset('asset/js/main.js')}}"></script>--}}


<script>
    document.querySelector('.btnA').setAttribute('disabled', 'true');
    document.querySelector('.btnA').classList.add('bg-slate-300');


    $('.btn-acp').on('click', function () {
        $('.modal-acp').toggleClass('show-modal');
    })
    document.querySelectorAll('input').forEach(item => {
        item.addEventListener('keyup', (e) => {
            let check1 = true;
            let check2 = true;
            if (!document.querySelectorAll('input')[2].value) {
                check1 = false;
            }
            if (!document.querySelectorAll('input')[3].value) {
                check2 = false;
            }
            if (check1 && check2) {
                document.querySelector('.btnA').removeAttribute('disabled');
                document.querySelector('.btnA').classList.remove('bg-slate-300');

            } else {
                document.querySelector('.btnA').setAttribute('disabled', 'true');
                document.querySelector('.btnA').classList.add('bg-slate-300');

            }
        })
    })
</script>

</body>
</html>
