<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ V-Store</title>
    <link rel="stylesheet" href="{{asset('home/dist/style.css')}}">
    <link rel="stylesheet" href="{{asset('home/dist/output.css')}}">
    <meta property="og:title" content="V-store | Ecommerce. Cổng thương mại điện tử dành cho nhà phân phối"/>
    <meta property="og:description" content="Hãy đồng hành cùng 20.000+ người bán hàng cùng những nhà phân phối hàng đầu Việt Nam."/>
    <meta property="og:url" content="{{asset('')}}" />
    <meta property="og:image" content="{{asset('home/img/logo-06.png')}}" />
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
    <meta property="og:image:width" content="120">
    <meta property="og:image:height" content="100">
{{--    <link rel="stylesheet" href="../../dist/output.css">--}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Inter', sans-serif;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
<div class="bg w-full relative h-auto md:h-[1090px]">
    <div class=" w-full md:max-w-[1440px] mx-auto flex flex-col justify-between gap-6 md:gap-20 py-10 md:h-screen xl:px-20 px-[20px]">
        <div class="flex justify-between items-center">
            <div class="w-[168px] h-[36px] md:hidden">
                <a href="./"> <img src="{{asset('home/img/Logo.png')}}" class="w-full object-contain" alt=""></a>
            </div>
            <div class="hidden md:block w-[270px] h-[59px]">
                <a href="./"> <img src="{{asset('home/img/Logo.png')}}" class="w-full object-contain" alt=""></a>
            </div>

            <a href="{{route('login_vstore')}}" class="btn-register text-xs md:text-base rounded-xl  hover:bg-[#0E88FF] transition-all duration-200 px-4 py-[6px] md:py-[10px] md:px-10 font-semibold text-[#FFF]  hover:opacity-70">Đăng nhập</a>
        </div>
        <div class="flex flex-col justify-center items-center md:items-start w-full md:justify-start gap-5 md:max-w-[650px] text-center md:text-left">
            <h2 class="font-semibold text-[#414141] md:text-[70px] md:leading-[90px] text-2xl ">"Cổng thương mại điện tử  <strong class="text-[#1e65ff] font-semibold">V-Store"</strong></h2>
            <span class="text-grayRgb text-base md:text-lg font-medium">Hãy đồng hành cùng <strong class="text-[#1e65ff]">20.000+</strong> người kinh doanh và thương hiệu bậc nhất tại Việt Nam đang tin dùng<strong class="text-[#1e65ff]"> V-Store.</strong></span>
        </div>
        <div class="max-w-[320px] w-full">
            <button class="btn-register text-center w-full rounded-[10px] text-[#FFF] py-4 uppercase transition-all duration-200 hover:opacity-70 "><a class="block w-full h-full"  href="{{route('register_vstore')}}">Đăng ký ngay</a></button>
        </div>
    </div>

</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-16  w-full md:max-w-[1440px] mx-auto md:p-16 my-8 p-4">
    <div class="w-full h-full order-last md:order-first">
        <img src="{{asset('home/img/IMG.png')}}" class="w-full" alt="">
    </div>
    <div class="flex flex-col gap-6 order-first md:order-last text-center md:text-left">
        <h2 class="font-semibold text-lg sm:text-4xl text-[#1D293F]">Cổng thương mại điện tử <br><strong class="text-[#1e65ff] font-semibold">V-Store </strong> là gì?</h2>
        <span class=" text-[#7C8087] leading-[24px] text-[12px] sm:text-xl ">“Cổng thương mại điện tử V-Store” là cổng tiếp nhận đăng kí, kiểm duyệt và đàm phán chiết khấu các sản phẩm, dịch vụ từ nhà cung cấp. Nhà cung cấp muốn kinh doanh sản phẩm của mình trên nền tảng mạng xã hội VDone thì bắt buộc phải khai báo sản phẩm của của mình thông qua các cổng V-Store. Mỗi một V-Store sẽ phụ trách các lĩnh vực sản phẩm khác nhau. Sản phẩm được cổng V-Store kiểm duyệt sẽ được cấp một mã sản phẩm và có thể lưu thông tin trên nền tảng VDone. </span>
    </div>
</div>
<div class="banner flex justify-around items-start w-full md:max-w-[1440px] mx-auto  flex-wrap lg:flex-nowrap">
    <div class="w-[312px]">
        <div class="w-[311px] h-[316px]">
            <img src="{{asset('home/img/ql1.png')}}" class="w-full" alt="">
        </div>
    </div>
    <div class="w-[256px] md:mt-14">
        <div class="w-[255px] h-[255px]">
            <img src="{{asset('home/img/ql2.png')}}" class="w-full" alt="">
        </div>
    </div>
    <div class="w-[300px]">
        <div class="w-[299px] h-[255px]">
            <img src="{{asset('home/img/ql3.png')}}" class="w-full" alt="">
        </div>
    </div>
</div>
<div class="flex flex-col justify-center items-center max-w-[1092px] mx-auto gap-2 px-[20px] my-10 relative">
    <h2 class="text-lg sm:text-4xl font-bold text-[#1D293F] text-center ">Quy trình trở thành <br><strong class="text-[#1e65ff] font-semibold">V-Store </strong></h2>
    <span class="text-[12px] sm:text-lg font-medium text-[#333] text-center ">Quy trình đăng kí V-Store đơn giản nhanh chóng, giúp người dùng dễ dàng nhận được những đặc quyền của V-Store </span>
    <div class="w-[533px] h-[507px] absolute left-[-350px] xl:left-[-550px]">
        <img src="{{asset('home/img/circle.png')}}" class="w-full" alt="">
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 w-full gap-10">
        <div class="flex flex-col w-full relative max-w-[190px] md:max-w-[260px]">
            <div class="w-[97px] h-[97px]">
                <img src="{{asset('home/img/b1.png')}}" class="w-full" alt="">
            </div>
            <h3 class="text-[#1D293F] font-semibold text-2xl">Tạo tài khoản</h3>
            <span class="text-[#7C8087]">
                    Tạo tài khoản dễ dàng bằng cách truy cập cổng đăng ký và điền thông tin theo hướng dẫn
                </span>
            <svg width="199" height="176" class="absolute top-[5px] right-[-75px] rotate-[30deg] md:hidden" viewBox="0 0 199 176" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.9761 50.2162C23.9761 50.2162 106.668 41.4523 168.046 123.883" stroke="#8C97AC" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0 11"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M164.662 127.879L164.548 125.875L170.013 125.838L169.691 120.171L171.623 120.157L172.002 126.827C172.033 127.38 171.626 127.831 171.093 127.835L164.662 127.879Z" fill="#8C97AC"/>
            </svg>

            <svg width="224" class="absolute top-[5px] right-[-95px] hidden md:block" height="89" viewBox="0 0 224 89" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 2C2 2 73.0845 93.3555 214.488 81.2422" stroke="#8C97AC" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0 11"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M216.984 89L215 87.1718L220.613 82L215 76.8282L216.984 75L223.589 81.0859C224.137 81.5908 224.137 82.4092 223.589 82.9141L216.984 89Z" fill="#8C97AC"/>
            </svg>

        </div>
        <div class="flex flex-col w-full items-end md:items-start md:mt-[100px] md:max-w-[260px] relative">
            <div class="w-[97px] h-[97px]">
                <img src="{{asset('home/img/b2.png')}}" class="w-full" alt="">
            </div>
            <h3 class="text-[#1D293F] font-semibold text-2xl">Hoàn thiện hồ sơ</h3>
            <span class="text-[#7C8087] text-right md:text-left">
                    Hoàn thiện thông tin và hồ sơ được yêu cầu theo hướng dẫn, chỉ mất chưa đến 15 phút
                </span>
            <svg width="160" height="119" class="absolute bottom-[-125px] right-[20px] md:hidden" viewBox="0 0 160 119" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M134.072 2C134.072 2 118.032 78.1465 29.6856 111.152" stroke="#8C97AC" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0 11"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M30.2847 116.123L30.9425 114.439L26.0699 112.882L27.9309 108.117L26.2084 107.567L24.0185 113.174C23.8368 113.639 24.0751 114.139 24.5508 114.291L30.2847 116.123Z" fill="#8C97AC"/>
            </svg>


            <svg width="252" height="198" class="absolute top-[-150px] right-[-95px] hidden md:block" viewBox="0 0 252 198" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.6252 70.7864C11.6252 70.7864 122.254 36.7247 231.137 127.753" stroke="#8C97AC" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0 11"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M227.704 133.904L226.945 131.315L234.42 129.773L232.273 122.449L234.915 121.904L237.442 130.522C237.652 131.237 237.23 131.939 236.5 132.089L227.704 133.904Z" fill="#8C97AC"/>
            </svg>

        </div>
        <div class="flex flex-col w-full md:mt-[200px]max-w-[190px] md:max-w-[260px]">
            <div class="w-[97px] h-[97px]">
                <img src="{{asset('home/img/b3.png')}}" class="w-full" alt="">
            </div>
            <h3 class="text-[#1D293F] font-semibold text-2xl">Bắt đầu sử dụng</h3>
            <span class="text-[#7C8087]">
                    Hoàn thiện đăng ký và trở thành V-Store sở hữu những quyền lợi mang tới lợi ích kinh doanh lớn
                </span>
        </div>
    </div>
</div>
<div class="flex flex-col justify-center items-center max-w-[1092px] mx-auto gap-2 xl:px-20 px-[20px]">
    <h2 class="text-[16px] sm:text-4xl font-bold text-[#1D293F] text-center">Lợi ích tham gia <br><strong class="text-[#1e65ff] font-semibold">V-Store </strong> </h2>
    <span class="text-[12px] sm:text-lg font-medium text-[#333] text-center ">“Cổng thương mại điện tử V-Store” là công cụ được sử dụng để kết nối giữa người dùng với hệ thống quản trị thương mại điện tử thông qua hình thức đăng tài hàng hóa, dịch vụ để thực hiện hoạt động thương mại hóa </span>

</div>
<div class="grid grid-cols-1 xl:grid-cols-2 place-items-center gap-2 xl:gap-8   w-full md:max-w-[1440px] mx-auto py-6 xl:px-20 px-[20px]">
    <div class="flex flex-col justify-start items-center md:items-start gap-8 order-last xl:order-first">
        <div class="flex flex-col gap-2 md:whitespace-nowrap">
            <div class="flex justify-center items-start gap-2 ">
                <div class="w-[21px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.67 0L0 9.67H9.67V0Z" fill="#80DDE9"/>
                        <path d="M19.34 9.67L9.66998 0V9.67H19.34Z" fill="#00BAD3"/>
                        <path d="M9.66998 9.66998V19.34L19.34 9.66998H9.66998Z" fill="#00ABBF"/>
                        <path d="M0 9.66998L9.67 19.34V9.66998H0Z" fill="#4DCFE1"/>
                    </svg>
                </div>


                <span class=" text-[#4F4F4F] font-medium ">Hoàn toàn ủy quyền cho 1000+ doanh nghiệp, dễ dàng xác minh nguồn gốc sản phẩm. </span>
            </div>

            <div class="flex justify-start items-start gap-2">
                <div class="w-[21px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.67 0L0 9.67H9.67V0Z" fill="#80DDE9"/>
                        <path d="M19.34 9.67L9.66998 0V9.67H19.34Z" fill="#00BAD3"/>
                        <path d="M9.66998 9.66998V19.34L19.34 9.66998H9.66998Z" fill="#00ABBF"/>
                        <path d="M0 9.66998L9.67 19.34V9.66998H0Z" fill="#4DCFE1"/>
                    </svg>
                </div>

                <span class="text-[#4F4F4F] font-medium">Công nghệ hoàn toàn mới. </span>
            </div>
            <div class="flex justify-start items-start gap-2">
                <div class="w-[21px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.67 0L0 9.67H9.67V0Z" fill="#80DDE9"/>
                        <path d="M19.34 9.67L9.66998 0V9.67H19.34Z" fill="#00BAD3"/>
                        <path d="M9.66998 9.66998V19.34L19.34 9.66998H9.66998Z" fill="#00ABBF"/>
                        <path d="M0 9.66998L9.67 19.34V9.66998H0Z" fill="#4DCFE1"/>
                    </svg>
                </div>

                <span class="text-[#4F4F4F] font-medium">Được cung cấp website quản trị riêng cho tính năng kiểm duyệt, quản trị sản phẩm.  </span>
            </div>
            <div class="flex justify-start items-start gap-2">
                <div class="w-[21px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.67 0L0 9.67H9.67V0Z" fill="#80DDE9"/>
                        <path d="M19.34 9.67L9.66998 0V9.67H19.34Z" fill="#00BAD3"/>
                        <path d="M9.66998 9.66998V19.34L19.34 9.66998H9.66998Z" fill="#00ABBF"/>
                        <path d="M0 9.66998L9.67 19.34V9.66998H0Z" fill="#4DCFE1"/>
                    </svg>
                </div>

                <span class="text-[#4F4F4F] font-medium">Được VDone hỗ trợ kết nối tới các nhà cung cấp. </span>
            </div>
            <div class="flex justify-start items-start gap-2">
                <div class="w-[21px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.67 0L0 9.67H9.67V0Z" fill="#80DDE9"/>
                        <path d="M19.34 9.67L9.66998 0V9.67H19.34Z" fill="#00BAD3"/>
                        <path d="M9.66998 9.66998V19.34L19.34 9.66998H9.66998Z" fill="#00ABBF"/>
                        <path d="M0 9.66998L9.67 19.34V9.66998H0Z" fill="#4DCFE1"/>
                    </svg>
                </div>

                <span class="text-[#4F4F4F] font-medium">Được đăng ký phụ trách theo tỉnh hoặc quốc gia. </span>
            </div>
            <div class="flex justify-start items-start gap-2">
                <div class="w-[21px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.67 0L0 9.67H9.67V0Z" fill="#80DDE9"/>
                        <path d="M19.34 9.67L9.66998 0V9.67H19.34Z" fill="#00BAD3"/>
                        <path d="M9.66998 9.66998V19.34L19.34 9.66998H9.66998Z" fill="#00ABBF"/>
                        <path d="M0 9.66998L9.67 19.34V9.66998H0Z" fill="#4DCFE1"/>
                    </svg>
                </div>

                <span class="text-[#4F4F4F] font-medium">Được hưởng chiết khấu, lợi nhuận trên từng sản phẩm. </span>
            </div>
            <div class="flex justify-start items-start gap-2">
                <div class="w-[21px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.67 0L0 9.67H9.67V0Z" fill="#80DDE9"/>
                        <path d="M19.34 9.67L9.66998 0V9.67H19.34Z" fill="#00BAD3"/>
                        <path d="M9.66998 9.66998V19.34L19.34 9.66998H9.66998Z" fill="#00ABBF"/>
                        <path d="M0 9.66998L9.67 19.34V9.66998H0Z" fill="#4DCFE1"/>
                    </svg>
                </div>

                <span class="text-[#4F4F4F] font-medium">Được chủ động đàm phán, điều chỉnh mức giá, chiết khấu sản phẩm.  </span>
            </div>
            <div class="flex justify-start items-start gap-2">
                <div class="w-[21px]">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.67 0L0 9.67H9.67V0Z" fill="#80DDE9"/>
                        <path d="M19.34 9.67L9.66998 0V9.67H19.34Z" fill="#00BAD3"/>
                        <path d="M9.66998 9.66998V19.34L19.34 9.66998H9.66998Z" fill="#00ABBF"/>
                        <path d="M0 9.66998L9.67 19.34V9.66998H0Z" fill="#4DCFE1"/>
                    </svg>
                </div>
                <span class="text-[#4F4F4F] font-medium">Được quyền hỗ trợ bảo hành nâng cấp hệ thống miễn phí trong 20 năm. </span>
            </div>

        </div>

        <a href="{{route('register_vstore')}}" class="btn-register font-semibold text-xl text-[#FFF] py-4 px-4 md:px-8 rounded-lg uppercase hover:opacity-70 transtion-all duration-200">Đăng ký thành viên</a>
    </div>
    <div class="order-first xl:order-last">
        <img src="{{asset('home/img/bnn.png')}}" class="w-full" alt="">
    </div>

</div>
<div class="bnbot">
    <div class=" flex flex-col justify-center items-center gap-8   w-full md:max-w-[1440px] mx-auto xl:px-20 px-[20px] py-10">
        <h2 class="text-lg sm:text-4xl font-bold text-[#1D293F] text-center md:text-left">1,000 <strong class="text-[#1e65ff] font-semibold">V-Store </strong> nổi bật</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-2 md:gap-9 w-full">
            <div class="box flex flex-col justify-center items-center gap-2 p-5">
                <div class="w-[80px] h-[80px] rounded-full">
                    <img src="{{asset('home/img/avt.png')}}" class="w-full rounded-full" alt="">
                </div>
                <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần ANEED</span>
            </div>
            <div class="box flex flex-col justify-center items-center gap-2 p-5">
                <div class="w-[80px] h-[80px] rounded-full">
                    <img src="{{asset('home/img/avt1.png')}}" class="w-full rounded-full" alt="">
                </div>
                <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần Dược liệu  </span>
            </div>
            <div class="box flex flex-col justify-center items-center gap-2 p-5">
                <div class="w-[80px] h-[80px] rounded-full">
                    <img src="{{asset('home/img/avt2.png')}}" class="w-full rounded-full" alt="">
                </div>
                <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần Dược liệu </span>
            </div>
            <div class="box flex flex-col justify-center items-center gap-2 p-5">
                <div class="w-[80px] h-[80px] rounded-full">
                    <img src="{{asset('home/img/avt3.png')}}" class="w-full rounded-full" alt="">
                </div>
                <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần ANEED </span>
            </div>
            <div class="box flex flex-col justify-center items-center gap-2 p-5">
                <div class="w-[80px] h-[80px] rounded-full">
                    <img src="{{asset('home/img/avt4.png')}}" class="w-full rounded-full" alt="">
                </div>
                <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần ANEED </span>
            </div>
            <div class="box flex flex-col justify-center items-center gap-2 p-5">
                <div class="w-[80px] h-[80px] rounded-full">
                    <img src="{{asset('home/img/avt5.png')}}" class="w-full rounded-full" alt="">
                </div>
                <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần Dược liệu </span>
            </div>
        </div>
    </div>
</div>

<!-- <div class="flex flex-col justify-center items-center gap-8   w-full md:max-w-[1440px] mx-auto py-16 xl:px-20 px-[20px]">
    <h2 class="text-2xl font-bold text-[#4F4F4F] uppercase">NHỮNG CÂU HỎI ĐẶT RA CHO V-STORE </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">
        <div class="w-full h-full">
            <img src="./img/quest.png" class="w-full" alt="">
        </div>
        <ul class="flex flex-col gap-2 w-full">
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-3 md:px-8">V-Store vận hành như thế nào? <div class="w-[25px]">
                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
            </div>
                </a>
                <div class="content py-2 ml-8">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Est modi doloremque quis quo ipsa voluptas, neque odit architecto tenetur ad repellendus nobis fuga sit unde obcaecati! Ex consequuntur nesciunt eaque!
                </div>
            </li>
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-3 md:px-8">Làm sao để trở thành thành viên của V-Store <div class="w-[25px]">
                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
            </div>
                </a>

            </li>
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-3 md:px-8">Thành viên của V-Store sẽ được hưởng những lợi ích gì? <div class="w-[25px]">
                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
            </div>
                </a>

            </li>
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-3 md:px-8">Nhà phát triển V-Store?<div class="w-[25px]">
                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
            </div>
                </a>

            </li>
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-3 md:px-8">Đối tác của V-Store?<div class="w-[25px]">
                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
            </div>
                </a>

            </li>
        </ul>
    </div>
</div> -->
<footer class="bg-[#1E90FF]">
    <div class="grid grid-cols-1 md:grid-cols-2 place-items-center md:place-items-start  w-full md:max-w-[1440px] mx-auto py-4 xl:px-20 px-[20px] gap-y-4">
        <ul class="flex items-center gap-14">
            <li><a href="#"><svg width="25" height="20" viewBox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.6183 2.37575C23.713 2.76628 22.7278 3.04735 21.713 3.15682C22.7666 2.53089 23.5556 1.54202 23.9319 0.375752C22.9433 0.963885 21.8602 1.37629 20.7308 1.59469C20.2587 1.09003 19.6878 0.687999 19.0535 0.413643C18.4193 0.139287 17.7354 -0.00151415 17.0444 1.22793e-05C14.2485 1.22793e-05 12 2.26628 12 5.04735C12 5.43788 12.0473 5.82841 12.1243 6.20415C7.93786 5.98522 4.20414 3.98522 1.72189 0.923089C1.2696 1.69562 1.03258 2.57524 1.0355 3.47042C1.0355 5.2219 1.92603 6.76628 3.28402 7.67456C2.48374 7.64305 1.7022 7.42308 1.00296 7.03255V7.09468C1.00296 9.54734 2.73668 11.5799 5.04733 12.0473C4.61348 12.16 4.16718 12.2177 3.71893 12.2189C3.39053 12.2189 3.07988 12.1864 2.76627 12.142C3.40532 14.142 5.26627 15.5947 7.48224 15.642C5.74852 17 3.57692 17.7988 1.21893 17.7988C0.795858 17.7988 0.405325 17.784 0 17.7367C2.23668 19.1716 4.89053 20 7.74852 20C17.0266 20 22.1035 12.3136 22.1035 5.64202C22.1035 5.42309 22.1035 5.20415 22.0887 4.98522C23.071 4.26628 23.9319 3.37575 24.6183 2.37575Z" fill="#272D4E"/>
                    </svg>
                </a></li>
            <li><a href="#"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.6172 0C5.09516 0 0.618164 4.477 0.618164 9.999C0.618164 14.989 4.27416 19.125 9.05516 19.878V12.89H6.51516V9.999H9.05516V7.796C9.05516 5.288 10.5482 3.905 12.8312 3.905C13.9252 3.905 15.0712 4.1 15.0712 4.1V6.559H13.8072C12.5672 6.559 12.1792 7.331 12.1792 8.122V9.997H14.9502L14.5072 12.888H12.1792V19.876C16.9602 19.127 20.6162 14.99 20.6162 9.999C20.6162 4.477 16.1392 0 10.6172 0Z" fill="#272D4E"/>
                    </svg>
                </a></li>
            <li><a href="#"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.63925 0C12.5911 0 20.6905 8.07576 20.7327 18.0176V18.0182H20.7342V19.0701H20.7224C20.6961 19.3033 20.5917 19.5209 20.4262 19.6874C20.2607 19.8539 20.0439 19.9596 19.8108 19.9875V19.9999H17.9405V19.9978C17.6875 19.9925 17.445 19.8955 17.2582 19.7247C17.0714 19.554 16.953 19.3213 16.925 19.0698H16.9132V18.0179H16.9238C16.8816 10.1756 10.4909 3.80861 2.63895 3.80861C2.63149 3.80861 2.62404 3.80807 2.61659 3.80752C2.61037 3.80707 2.60416 3.80662 2.59795 3.80648V3.82106H1.54604V3.80922C1.31275 3.78293 1.09519 3.67858 0.928667 3.5131C0.76214 3.34762 0.65642 3.13072 0.628661 2.8976H0.616211V1.02731H0.618337C0.62363 0.774312 0.720661 0.531853 0.891372 0.345054C1.06208 0.158255 1.29485 0.0398392 1.54635 0.0118429V0H2.59825V0.00212567C2.60443 0.00198836 2.61055 0.00154061 2.61669 0.00109124C2.62413 0.000546809 2.6316 0 2.63925 0ZM2.63925 7.20619C2.6316 7.20619 2.62413 7.20674 2.61669 7.20728L2.61668 7.20728C2.61054 7.20773 2.60443 7.20818 2.59825 7.20832V7.20619H1.54635V7.21804C1.29485 7.24603 1.06208 7.36445 0.891372 7.55125C0.720661 7.73805 0.62363 7.9805 0.618337 8.2335H0.616211V10.1038H0.628661C0.656472 10.3369 0.762209 10.5538 0.928726 10.7192C1.09524 10.8847 1.31277 10.9891 1.54604 11.0154V11.0273H2.59795V11.0127C2.60416 11.0128 2.61037 11.0133 2.61658 11.0137C2.62404 11.0143 2.63149 11.0148 2.63895 11.0148C6.5174 11.0148 9.67585 14.149 9.71776 18.0177H9.70774V19.0696H9.71958C9.74758 19.3211 9.86599 19.5539 10.0528 19.7246C10.2396 19.8953 10.482 19.9923 10.735 19.9976V19.9997H12.605V19.9873C12.8381 19.9595 13.055 19.8537 13.2205 19.6872C13.3859 19.5207 13.4903 19.3032 13.5166 19.0699H13.5285V18.018H13.5267C13.4851 12.0488 8.61757 7.20619 2.63925 7.20619ZM3.46569 14.5393C3.11545 14.5393 2.76865 14.6083 2.44509 14.7424C2.12154 14.8764 1.82756 15.0729 1.57996 15.3207C1.33237 15.5684 1.136 15.8624 1.00208 16.186C0.868166 16.5097 0.79932 16.8565 0.79948 17.2067C0.79948 17.5569 0.868459 17.9037 1.00248 18.2273C1.1365 18.5508 1.33294 18.8448 1.58057 19.0925C1.82821 19.3401 2.1222 19.5365 2.44575 19.6705C2.7693 19.8046 3.11608 19.8735 3.4663 19.8735C3.81651 19.8735 4.16329 19.8046 4.48684 19.6705C4.81039 19.5365 5.10438 19.3401 5.35202 19.0925C5.59965 18.8448 5.79609 18.5508 5.93011 18.2273C6.06413 17.9037 6.13311 17.5569 6.13311 17.2067C6.13327 16.8564 6.06438 16.5095 5.93039 16.1858C5.7964 15.8621 5.59992 15.5679 5.3522 15.3202C5.10447 15.0725 4.81035 14.876 4.48666 14.742C4.16296 14.608 3.81602 14.5391 3.46569 14.5393Z" fill="#272D4E"/>
                    </svg>

                </a></li>
            <li><a href="#"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.7319 6.66525C8.89563 6.66525 7.39712 8.16376 7.39712 10C7.39712 11.8362 8.89563 13.3348 10.7319 13.3348C12.5681 13.3348 14.0666 11.8362 14.0666 10C14.0666 8.16376 12.5681 6.66525 10.7319 6.66525ZM20.7336 10C20.7336 8.61907 20.7461 7.25064 20.6686 5.87221C20.591 4.27113 20.2258 2.85017 19.055 1.67938C17.8817 0.506085 16.4632 0.14334 14.8622 0.065788C13.4812 -0.0117644 12.1128 0.000744113 10.7344 0.000744113C9.35344 0.000744113 7.98502 -0.0117644 6.60659 0.065788C5.0055 0.14334 3.58454 0.508587 2.41375 1.67938C1.24046 2.85267 0.877715 4.27113 0.800163 5.87221C0.722611 7.25314 0.735119 8.62157 0.735119 10C0.735119 11.3784 0.722611 12.7494 0.800163 14.1278C0.877715 15.7289 1.24296 17.1498 2.41375 18.3206C3.58705 19.4939 5.0055 19.8567 6.60659 19.9342C7.98752 20.0118 9.35594 19.9993 10.7344 19.9993C12.1153 19.9993 13.4837 20.0118 14.8622 19.9342C16.4632 19.8567 17.8842 19.4914 19.055 18.3206C20.2283 17.1473 20.591 15.7289 20.6686 14.1278C20.7486 12.7494 20.7336 11.3809 20.7336 10ZM10.7319 15.131C7.89245 15.131 5.60091 12.8394 5.60091 10C5.60091 7.16058 7.89245 4.86903 10.7319 4.86903C13.5713 4.86903 15.8628 7.16058 15.8628 10C15.8628 12.8394 13.5713 15.131 10.7319 15.131ZM16.073 5.8572C15.41 5.8572 14.8747 5.32184 14.8747 4.65889C14.8747 3.99594 15.41 3.46058 16.073 3.46058C16.7359 3.46058 17.2713 3.99594 17.2713 4.65889C17.2715 4.81631 17.2406 4.97222 17.1805 5.1177C17.1203 5.26317 17.0321 5.39535 16.9208 5.50666C16.8094 5.61798 16.6773 5.70624 16.5318 5.76639C16.3863 5.82654 16.2304 5.8574 16.073 5.8572Z" fill="#272D4E"/>
                    </svg>

                </a></li>
        </ul>
        <span class="uppercase text-xs text-[#272D4E]">Copyright <script>document.write(new Date().getFullYear());</script> © viptam.com</span>
    </div>
</footer>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</body>
</html>
