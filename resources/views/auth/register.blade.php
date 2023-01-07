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

</head>
<body>
<form action="{{route('post_register')}}" id="formRegister-V" method="POST">
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
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Tên V-Store</span>
                <input type="text" name="name" id="name" placeholder="Nhập tên V-store"
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
                       class="nameDDM outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>

            <div class="flex justify-between items-center gap-6 w-full flex-wrap ">
                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Mật khẩu</span>
                    <div class="pass w-full relative">
                        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu"
                               class="pass outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        <div class="password">
                            <svg width="16" height="16" class="icon cursor-pointer absolute top-[13px] right-[10px]"
                                 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.6822 7.53757C15.0545 6.21507 14.3075 5.1365 13.4412 4.30185L12.5326 5.21043C13.2735 5.91846 13.9188 6.84471 14.4769 7.99828C12.9912 11.0733 10.8822 12.534 8.0001 12.534C7.13498 12.534 6.33813 12.4008 5.60956 12.1344L4.6251 13.1188C5.637 13.5861 6.762 13.8197 8.0001 13.8197C11.4322 13.8197 13.993 12.0322 15.6822 8.45721C15.7502 8.31344 15.7854 8.1564 15.7854 7.99739C15.7854 7.83838 15.7502 7.68135 15.6822 7.53757ZM14.5471 1.81185L13.7858 1.04971C13.7725 1.03643 13.7568 1.02589 13.7394 1.0187C13.7221 1.01151 13.7035 1.00781 13.6847 1.00781C13.666 1.00781 13.6474 1.01151 13.63 1.0187C13.6127 1.02589 13.5969 1.03643 13.5837 1.04971L11.6306 3.00185C10.5538 2.45185 9.34367 2.17685 8.0001 2.17685C4.56796 2.17685 2.00724 3.96435 0.317957 7.53935C0.250055 7.68313 0.21484 7.84017 0.21484 7.99918C0.21484 8.15818 0.250055 8.31522 0.317957 8.459C0.992837 9.88043 1.80534 11.0198 2.75546 11.877L0.865814 13.7661C0.839043 13.7929 0.824005 13.8293 0.824005 13.8671C0.824005 13.905 0.839043 13.9413 0.865814 13.9681L1.62813 14.7304C1.65492 14.7572 1.69125 14.7722 1.72912 14.7722C1.76699 14.7722 1.80331 14.7572 1.8301 14.7304L14.5471 2.014C14.5603 2.00073 14.5709 1.98497 14.5781 1.96763C14.5853 1.95029 14.589 1.9317 14.589 1.91293C14.589 1.89415 14.5853 1.87556 14.5781 1.85822C14.5709 1.84088 14.5603 1.82512 14.5471 1.81185ZM1.52331 7.99828C3.01081 4.92328 5.11974 3.46257 8.0001 3.46257C8.97403 3.46257 9.85956 3.62971 10.663 3.96953L9.4076 5.22489C8.81308 4.90768 8.13234 4.78996 7.46582 4.88908C6.7993 4.9882 6.18228 5.29893 5.7058 5.77541C5.22931 6.2519 4.91859 6.86891 4.81947 7.53544C4.72034 8.20196 4.83807 8.88269 5.15528 9.47721L3.66563 10.9669C2.84117 10.2392 2.13046 9.25328 1.52331 7.99828ZM5.92867 7.99828C5.92898 7.6834 6.00357 7.37303 6.14637 7.09238C6.28917 6.81174 6.49615 6.56874 6.75051 6.38312C7.00487 6.1975 7.29943 6.0745 7.61025 6.02411C7.92108 5.97372 8.23941 5.99736 8.53938 6.0931L6.02349 8.609C5.96043 8.41157 5.92844 8.20554 5.92867 7.99828Z"
                                    fill="black" fill-opacity="0.45"/>
                                <path
                                    d="M7.92897 10.0012C7.86719 10.0012 7.80629 9.99839 7.74594 9.99286L6.80272 10.9361C7.37003 11.1533 7.98812 11.2016 8.58228 11.0751C9.17643 10.9485 9.72122 10.6526 10.1508 10.2231C10.5803 9.7935 10.8763 9.24871 11.0028 8.65455C11.1293 8.0604 11.0811 7.4423 10.8638 6.875L9.92058 7.81821C9.92612 7.87857 9.92897 7.93946 9.92897 8.00125C9.92911 8.26393 9.87748 8.52407 9.77702 8.76678C9.67656 9.0095 9.52925 9.23003 9.3435 9.41578C9.15776 9.60152 8.93722 9.74884 8.69451 9.8493C8.45179 9.94976 8.19166 10.0014 7.92897 10.0012Z"
                                    fill="black" fill-opacity="0.45"/>
                            </svg>
                        </div>

                    </div>
                </div>
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Xác nhận mật khẩu</span>
                    <div class="rePass w-full relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               placeholder="Nhập lại mật khẩu"
                               class="rePass outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        <div class="rePassword">
                            <svg width="16" height="16" class="icon cursor-pointer absolute top-[13px] right-[10px]"
                                 viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.6822 7.53757C15.0545 6.21507 14.3075 5.1365 13.4412 4.30185L12.5326 5.21043C13.2735 5.91846 13.9188 6.84471 14.4769 7.99828C12.9912 11.0733 10.8822 12.534 8.0001 12.534C7.13498 12.534 6.33813 12.4008 5.60956 12.1344L4.6251 13.1188C5.637 13.5861 6.762 13.8197 8.0001 13.8197C11.4322 13.8197 13.993 12.0322 15.6822 8.45721C15.7502 8.31344 15.7854 8.1564 15.7854 7.99739C15.7854 7.83838 15.7502 7.68135 15.6822 7.53757ZM14.5471 1.81185L13.7858 1.04971C13.7725 1.03643 13.7568 1.02589 13.7394 1.0187C13.7221 1.01151 13.7035 1.00781 13.6847 1.00781C13.666 1.00781 13.6474 1.01151 13.63 1.0187C13.6127 1.02589 13.5969 1.03643 13.5837 1.04971L11.6306 3.00185C10.5538 2.45185 9.34367 2.17685 8.0001 2.17685C4.56796 2.17685 2.00724 3.96435 0.317957 7.53935C0.250055 7.68313 0.21484 7.84017 0.21484 7.99918C0.21484 8.15818 0.250055 8.31522 0.317957 8.459C0.992837 9.88043 1.80534 11.0198 2.75546 11.877L0.865814 13.7661C0.839043 13.7929 0.824005 13.8293 0.824005 13.8671C0.824005 13.905 0.839043 13.9413 0.865814 13.9681L1.62813 14.7304C1.65492 14.7572 1.69125 14.7722 1.72912 14.7722C1.76699 14.7722 1.80331 14.7572 1.8301 14.7304L14.5471 2.014C14.5603 2.00073 14.5709 1.98497 14.5781 1.96763C14.5853 1.95029 14.589 1.9317 14.589 1.91293C14.589 1.89415 14.5853 1.87556 14.5781 1.85822C14.5709 1.84088 14.5603 1.82512 14.5471 1.81185ZM1.52331 7.99828C3.01081 4.92328 5.11974 3.46257 8.0001 3.46257C8.97403 3.46257 9.85956 3.62971 10.663 3.96953L9.4076 5.22489C8.81308 4.90768 8.13234 4.78996 7.46582 4.88908C6.7993 4.9882 6.18228 5.29893 5.7058 5.77541C5.22931 6.2519 4.91859 6.86891 4.81947 7.53544C4.72034 8.20196 4.83807 8.88269 5.15528 9.47721L3.66563 10.9669C2.84117 10.2392 2.13046 9.25328 1.52331 7.99828ZM5.92867 7.99828C5.92898 7.6834 6.00357 7.37303 6.14637 7.09238C6.28917 6.81174 6.49615 6.56874 6.75051 6.38312C7.00487 6.1975 7.29943 6.0745 7.61025 6.02411C7.92108 5.97372 8.23941 5.99736 8.53938 6.0931L6.02349 8.609C5.96043 8.41157 5.92844 8.20554 5.92867 7.99828Z"
                                    fill="black" fill-opacity="0.45"/>
                                <path
                                    d="M7.92897 10.0012C7.86719 10.0012 7.80629 9.99839 7.74594 9.99286L6.80272 10.9361C7.37003 11.1533 7.98812 11.2016 8.58228 11.0751C9.17643 10.9485 9.72122 10.6526 10.1508 10.2231C10.5803 9.7935 10.8763 9.24871 11.0028 8.65455C11.1293 8.0604 11.0811 7.4423 10.8638 6.875L9.92058 7.81821C9.92612 7.87857 9.92897 7.93946 9.92897 8.00125C9.92911 8.26393 9.87748 8.52407 9.77702 8.76678C9.67656 9.0095 9.52925 9.23003 9.3435 9.41578C9.15776 9.60152 8.93722 9.74884 8.69451 9.8493C8.45179 9.94976 8.19166 10.0014 7.92897 10.0012Z"
                                    fill="black" fill-opacity="0.45"/>
                            </svg>
                        </div>

                    </div>
                </div>
                @error('password_confirmation')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="text-center my-4"><input type="checkbox"> Bạn đồng ý với điều khoản sử dụng của chúng tôi.</div>
    <div class="flex flex-col gap-5 max-w-[600px] text-center mx-auto px-4 lg:px-10">
        <button type="submit"
                class="active btn-sub text-center w-full text-grey text-xl font-medium bg-btnGrey rounded-lg py-4"
        >Tiếp tục
        </button>
        <span class="text-xl font-medium w-full">Bạn đã có tài khoản? <a href="../dang-nhap/"
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
