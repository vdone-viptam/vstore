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
<form action="{{route('post_register',['role_id' => 2])}}" id="formRegister-V" method="POST">
    @csrf
    <div class=" grid grid-cols-1 lg:grid-cols-2">
        <div class="register-1 flex flex-col justify-start items-start gap-6 xl:px-32 p-10 px-4 lg:px-10">
            <a href="../dang-ky/"
               class="flex justify-start items-center gap-2 hover:opacity-75 transition-all duration-500">
                <div>
                    <img src="{{asset('asset/icons/back.png')}}" alt="">
                </div>
                <span class="text-title">Quay lại</span>
            </a>
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
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Tên nhà cung cấp</span>
                <input type="text" name="name" id="name" placeholder="Nhập tên nhà cung cấp"
                       class="nameV outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Tên Công ty</span>
                <input type="text" name="company_name" id="company_name" placeholder="Nhập tên công ty"
                       class="comp outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('company_name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Mã số thuế</span>
                <input type="text" name="tax_code" id="tax_code" placeholder="Nhập mã số thuế"
                       class="maV outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
            @error('tax_code')
            <p class="text-danger">{{$message}}</p>
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
            <p class="text-danger">{{$message}}</p>
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
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"> Đại diện thêm</span>
                <input type="text" name="id_vdone_diff" placeholder="Nhập ID đại diện thêm"
                       class="nameDDM outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm ">
            </div>


        </div>
    </div>
    <div class="text-center my-4"><input type="checkbox"> Bạn đồng ý với điều khoản sử dụng của chúng tôi.</div>
    <div class="flex flex-col gap-5 max-w-[600px] text-center mx-auto px-4 lg:px-10">
        <button type="submit"
                class="active btn-sub text-center w-full text-grey text-xl font-medium bg-btnGrey rounded-lg py-4 bg-sky-500/100 text-[#FFF]"
        >Tiếp tục
        </button>
        <span class="text-xl font-medium w-full">Bạn đã có tài khoản? <a href="{{route('login_ncc')}}"
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
