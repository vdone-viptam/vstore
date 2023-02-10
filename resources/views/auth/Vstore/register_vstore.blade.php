<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký V-Store</title>
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/dist/output.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body>
@if(\Illuminate\Support\Facades\Session::has('success'))
    <div class="modal modal-success  flex justify-center items-center show-modal">
        <div class="over-lay-modal" onclick="$('.modal-success').toggleClass('show-modal')"></div>
        <div
            class="information success flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px] h-[400px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
            <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-success').toggleClass('show-modal')"
                 class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                 fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                    fill="white"/>
            </svg>

            <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
                <h2 class="text-title text-2xl font-medium">Bạn đã gửi thông tin đăng ký thành công</h2>
                <span
                    class="text-[#000]">Thông tin đăng ký của bạn đang chờ duyệt. Vui lòng chờ kết quả trong vòng (24 giờ)</span>
            </div>
        </div>
    </div>
@endif

<div class="modal modal-hd">
    <div class="over-lay-modal" onclick="$('.modal-hd').toggleClass('show-modal')"></div>
    <div
        class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-10 md:mt-24">
        <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
            <h2 class="text-base text-title">Hợp đồng điện tử</h2>
            <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                 onclick="$('.modal-hd').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                    fill="black" fill-opacity="0.45"/>
            </svg>
        </div>
        <div class="content pt-3 px-3 border-r-[1px] border-l-[1px] border-grey max-h-[500px] overflow-y-auto">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae est commodi eum amet voluptatum sint
            culpa dolore, provident nisi nobis, animi facere dignissimos modi voluptatem assumenda. Consectetur,
            praesentium aperiam!
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae est commodi eum amet voluptatum sint
            culpa dolore, provident nisi nobis, animi facere dignissimos modi voluptatem assumenda. Consectetur,
            praesentium aperiam!
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae est commodi eum amet voluptatum sint
            culpa dolore, provident nisi nobis, animi facere dignissimos modi voluptatem assumenda. Consectetur,
            praesentium aperiam!
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae est commodi eum amet voluptatum sint
            culpa dolore, provident nisi nobis, animi facere dignissimos modi voluptatem assumenda. Consectetur,
            praesentium aperiam!
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae est commodi eum amet voluptatum sint
            culpa dolore, provident nisi nobis, animi facere dignissimos modi voluptatem assumenda. Consectetur,
            praesentium aperiam!
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae est commodi eum amet voluptatum sint
            culpa dolore, provident nisi nobis, animi facere dignissimos modi voluptatem assumenda. Consectetur,
            praesentium aperiam!
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi beatae est commodi eum amet voluptatum sint
            culpa dolore, provident nisi nobis, animi facere dignissimos modi voluptatem assumenda. Consectetur,
            praesentium aperiam!
        </div>
    </div>
</div>
<form action="{{route('post_register',['role_id' => 3])}}" id="formRegister-V" method="POST">
    @csrf
    <div class=" grid grid-cols-1 lg:grid-cols-2">
        <div class="register-1 flex flex-col justify-start items-start gap-6 xl:px-32 p-10 px-4 lg:px-10">
{{--            <a href="#"--}}
{{--               class="flex justify-start items-center gap-2 hover:opacity-75 transition-all duration-500">--}}
{{--                <div>--}}
{{--                    <img src="{{asset('asset/icons/back.png')}}" alt="">--}}
{{--                </div>--}}
{{--                <span class="text-title">Quay lại</span>--}}
{{--            </a>--}}
            <div class="w-[162px]">
                <img src="{{asset('asset/images/Logo.png')}}" alt="">
            </div>
            <h1 class="text-4xl font-medium max-w-[520px]">Đăng ký</h1>

        </div>
    </div>
    <div class="flex flex-col lg:flex-row justify-between item-start gap-6 xl:gap-28 xl:px-32 p-10 pt-0 px-4 lg:px-10">
        <div class="flex flex-col justify-start items-start gap-6 w-full">
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Email</span>
                <input type="text" name="email" id="email" placeholder="Nhập địa chỉ thư điện tử"
                       class="mail outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('email')
            <p class="text-red-600">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Tên V-Store</span>
                <input type="text" name="name" id="name" placeholder="Nhập tên V-store"
                       class="nameV outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('name')
            <p class="text-red-600">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Tên Công ty</span>
                <input type="text" name="company_name" id="company_name" placeholder="Nhập tên công ty"
                       class="comp outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('company_name')
            <p class="text-red-600">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Mã số thuế</span>
                <input type="text" name="tax_code" id="tax_code" placeholder="Nhập mã số thuế"
                       class="maV outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('tax_code')
            <p class="text-red-600">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Địa chỉ</span>
                <input type="text" name="address" id="address" placeholder="Nhập địa chỉ"
                       class="addr outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>


        </div>
        <div class="flex flex-col justify-start items-start gap-6 w-full">
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong>Số điện thoại</span>
                <input type="text" name="phone_number" placeholder="Nhập số điện thoại"
                       class="sdt outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('phone_number')
            <p class="text-red-600">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-sm font-medium flex justify-start items-center gap-1"><strong
                            class="text-[#FF4D4F]">*</strong> Người đại diện <svg class="cursor-pointer" width="14"
                                                                                  height="14" viewBox="0 0 14 14"
                                                                                  fill="none"
                                                                                  xmlns="http://www.w3.org/2000/svg">
                        <title>Vui lòng nhập ID của người đại diện cho V-Store của bạn</title>
                        <path
                            d="M7 0C3.13437 0 0 3.13437 0 7C0 10.8656 3.13437 14 7 14C10.8656 14 14 10.8656 14 7C14 3.13437 10.8656 0 7 0ZM7 12.8125C3.79063 12.8125 1.1875 10.2094 1.1875 7C1.1875 3.79063 3.79063 1.1875 7 1.1875C10.2094 1.1875 12.8125 3.79063 12.8125 7C12.8125 10.2094 10.2094 12.8125 7 12.8125Z"
                            fill="black" fill-opacity="0.45"/>
                        <path
                            d="M6.24976 4.25C6.24976 4.44891 6.32877 4.63968 6.46943 4.78033C6.61008 4.92098 6.80084 5 6.99976 5C7.19867 5 7.38943 4.92098 7.53009 4.78033C7.67074 4.63968 7.74976 4.44891 7.74976 4.25C7.74976 4.05109 7.67074 3.86032 7.53009 3.71967C7.38943 3.57902 7.19867 3.5 6.99976 3.5C6.80084 3.5 6.61008 3.57902 6.46943 3.71967C6.32877 3.86032 6.24976 4.05109 6.24976 4.25ZM7.37476 6H6.62476C6.55601 6 6.49976 6.05625 6.49976 6.125V10.375C6.49976 10.4438 6.55601 10.5 6.62476 10.5H7.37476C7.44351 10.5 7.49976 10.4438 7.49976 10.375V6.125C7.49976 6.05625 7.44351 6 7.37476 6Z"
                            fill="black" fill-opacity="0.45"/>
                        </svg>
                        </span>
                <input type="text" name="id_vdone" placeholder="Nhập ID người đại diện"
                       class="nameDD outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('id_vdone')
            <p class="text-red-600">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"> Đại diện thêm</span>
                <input type="text" name="id_vdone_diff" placeholder="Nhập ID đại diện thêm"
                       class="nameDDM outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>


        </div>
    </div>
    <div class="text-center my-4"><input type="checkbox" required> Bạn đồng ý với điều khoản sử dụng của chúng tôi.<a
            href="#" onclick="$('.modal-hd').toggleClass('show-modal')">Xem thêm</a>
    </div>
    <div class="flex flex-col gap-5 max-w-[600px] text-center mx-auto px-4 lg:px-10">
        <button type="submit"
                class="active btn-sub text-center w-full text-grey text-xl font-medium  text-[#FFF] rounded-lg py-4 bg-sky-500/100"
        >Tiếp tục
        </button>
        <span class="text-xl font-medium w-full">Bạn đã có tài khoản? <a href="{{route('login_vstore')}}"
                                                                         class="text-primary hover:opacity-70 transition-all duration-500">Đăng nhập</a></span>
    </div>
</form>

<script src="{{asset('asset/js/main.js')}}"></script>
<script>
    $('#formRegister-V').validate({
        rules: {
            name: {
                required: true,
            },
            id_vdone: {
                required: true,
            },
            email: {
                required: true,
            },
            company_name: {
                required: true,
            },
            tax_code: {
                required: true,
            },
            address: {
                required: true,
            },
            phone_number: {
                required: true,
            },
            password: {
                required: true,

            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },
        messages: {
            name: {
                required: 'Bạn cần nhập tên V-Store'
            },
            id_vdone: {
                required: 'Bạn cần nhập ID người đại diện'
            },
            email: {
                required: 'Bạn cần nhập địa chỉ Email'
            },
            company_name: {
                required: 'Bạn cần nhập tên công ty'
            },
            tax_code: {
                required: 'Bạn cần nhập mã số thuế'
            },
            address: {
                required: 'Bạn cần nhập địa chỉ'
            },
            password: {
                required: 'Bạn phải nhập mật khẩu',

            },
            password_confirmation: {
                required: 'Bạn phải nhập lại mật khẩu',
                equalTo: 'Mật khẩu không khớp'
            },
            phone_number: {
                required: 'Số điện thoại bắt buộc nhập',
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
</script>
</body>
</html>
