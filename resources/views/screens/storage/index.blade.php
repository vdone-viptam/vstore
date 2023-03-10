<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ Kho</title>
    <link rel="stylesheet" href="{{asset('home/dist/style.css')}}">
    <link rel="stylesheet" href="{{asset('home/dist/output.css')}}">
    <meta property="og:title" content="KHO | Hệ thống quản lý kho chuyên nghiệp."/>
    <meta property="og:description"
          content="Hãy đồng hành cùng 20.000+ người kinh doanh và thương hiệu bậc nhất tại Việt Nam đang tin dùng KHO."/>
    <meta property="og:url" content="{{asset('')}}"/>
    <meta property="og:image" content="{{asset('home/img/logo-07.png')}}"/>
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
    <meta property="og:image:width" content="120">
    <meta property="og:image:height" content="100">
    {{--    <link rel="stylesheet" href="../../dist/output.css">--}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
<div class="bg-kho w-full relative h-auto ">
    <div
        class=" w-full md:max-w-[1440px] mx-auto flex flex-col justify-between gap-6 md:gap-20 py-10 md:h-screen xl:px-20 px-[20px]">
        <div class="flex justify-between items-center">
            <div class="w-[105px] h-[82px]">
                <a href="./">
                    <img src="{{asset('home/img/vdone.png')}}" class="w-full object-contain" alt="">
                </a>
            </div>

            <a href="{{route('login_storage')}}"
               class="text-xs md:text-base rounded-xl  hover:bg-[#0E88FF] transition-all duration-200 px-4 py-[4px] md:py-[10px] md:px-10 font-semibold text-[#258AFF] border-[#258AFF] border-[1px] hover:text-[#FFF]">Đăng
                nhập</a>
        </div>
        <div
            class="flex flex-col justify-center items-center md:items-start w-full md:justify-start gap-8 md:max-w-[800px] text-center md:text-left">
            <h2 class="font-bold text-[#414141] md:text-[70px] md:leading-[90px] text-2xl flex items-center gap-4">Hệ thống quản lý
                <div class="w-[103px] md:w-[174px] h-[60px]">
                    <img src="{{asset('home/img/titleK.png')}}" class="w-full object-contain" alt="">
                </div>
            </h2>
            <span class="text-grayRgb text-base md:text-lg font-medium max-w-[550px]">Hãy đồng hành cùng <strong
                    class="text-[#1E90FF]">20.000+</strong> người kinh doanh và thương hiệu bậc nhất tại Việt Nam đang tin dùng <strong
                    class="text-[#1E90FF]">KHO</strong></span>
                    <div class="max-w-[525px] relative">
                        <img src="{{asset('home/img/bannerK.png')}}" alt="" class="w-full object-contain">
                        <div class="absolute top-1/2 md:-translate-y-[40px] -translate-y-[30px] left-[70px] md:left-[100px] font-bold text-2xl md:text-4xl text-[#FFF]">
                        1.200.000đ
                        </div>
                        <div class="absolute left-0 bottom-0 px-4 py-6 md:p-10">
                            <div class="flex items-center md:gap-2">
                                <div class="w-[25px]">
                                    <div class="w-[24px] h-[24px]">
                                        <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.0003 18.775L7.85033 21.275C7.667 21.3916 7.47533 21.4416 7.27533 21.4249C7.07533 21.4083 6.90033 21.3416 6.75033 21.225C6.60033 21.1083 6.48366 20.9623 6.40033 20.787C6.317 20.6116 6.30033 20.416 6.35033 20.2L7.45033 15.475L3.77533 12.3C3.60866 12.15 3.50466 11.979 3.46333 11.787C3.422 11.595 3.43433 11.4076 3.50033 11.225C3.567 11.0416 3.667 10.8916 3.80033 10.775C3.93366 10.6583 4.117 10.5833 4.35033 10.55L9.20033 10.125L11.0753 5.67495C11.1587 5.47495 11.288 5.32495 11.4633 5.22495C11.6387 5.12495 11.8177 5.07495 12.0003 5.07495C12.1837 5.07495 12.3627 5.12495 12.5373 5.22495C12.712 5.32495 12.8413 5.47495 12.9253 5.67495L14.8003 10.125L19.6503 10.55C19.8837 10.5833 20.067 10.6583 20.2003 10.775C20.3337 10.8916 20.4337 11.0416 20.5003 11.225C20.567 11.4083 20.5797 11.596 20.5383 11.788C20.497 11.98 20.3927 12.1506 20.2253 12.3L16.5503 15.475L17.6503 20.2C17.7003 20.4166 17.6837 20.6126 17.6003 20.788C17.517 20.9633 17.4003 21.109 17.2503 21.225C17.1003 21.3416 16.9253 21.4083 16.7253 21.4249C16.5253 21.4416 16.3337 21.3916 16.1503 21.275L12.0003 18.775Z" fill="#F0B90B"/>
                                        </svg>
                                    </div>
                                </div>
                                <span class="text-sm md:text-lg whitespace-nowrap font-bold text-[#258AFF]">Sở hữu Tài khoản KHO sử dụng trong 1 năm.</span>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-[320px] w-full">
            <button
                class="bg-[#1E90FF] text-center w-full rounded-[10px] text-[#FFF] py-4 font-semibold text-base md:text-2xl transition-all duration-200 hover:opacity-70 ">
                <a class="block w-full h-full" href="{{route('register_storage')}}">Đăng ký ngay</a></button>
        </div>
                </div>
       <div></div>
    </div>

</div>
<div class="bg-gra">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 xl:gap-16 place-items-center w-full md:max-w-[1440px] mx-auto xl::p-16 p-4 md:py-10 xl:py-24">
    <div class="w-full h-full order-last md:order-first">
        <img src="{{asset('home/img/IMGk.png')}}" class="w-full" alt="">
    </div>
    <div class="flex flex-col gap-6 order-first md:order-last text-center ">
        <h2 class="font-semibold text-lg sm:text-4xl text-[#1D293F] flex justify-center items-center gap-[8px]">Hệ thống quản lý <div class="w-[103px] h-36px]">
                    <img src="{{asset('home/img/titleK.png')}}" class="w-full object-contain" alt="">
                </div> là gì?</h2>
        <div class="flex flex-col gap-4">
        <div class="flex items-start gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left ">KHO là nơi lưu trữ hàng hóa, sản phẩm của Nhà cung cấp, mang lại khả năng lưu trữ bảo quản và chuẩn bị hàng hóa cho doanh nghiệp, đảm bảo số lượng hàng hóa luôn được cung ứng liền mạch đến tay người tiêu dùng cả về chất lượng và số lượng.</span>
        </div>
        <div class="flex items-start gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left ">Đa dạng phân loại gồm Kho thường, Kho lạnh, Kho bãi. </span>
        </div>
        <div class="flex items-start gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left ">KHO là mắt xích quan trọng trong chuỗi cung ứng hàng hóa trong hoạt động thương mại điện tử của VDone</span>
        </div>
        </div>

    </div>
</div>
</div>
<div class="md:max-w-[1440px] py-4 px-[20px] md:px-20 w-full mx-auto md:my-10 xl:my-24">
    <div class="flex flex-col items-center gap-6 md:gap-10 ">
        <h2 class=" text-lg sm:text-4xl  text-[#343434] font-semibold text-center flex items-center gap-[8px]">Quy trình trở thành <div class="w-[103px] h-36px] inline">
                    <img src="{{asset('home/img/titleK.png')}}" class="w-full object-contain" alt="">
                </div></h2>
        <span class="text-[#343434] text-sm xl:text-lg font-medium text-center">Quy trình đăng ký KHO đơn giản nhanh chóng, giúp người dùng dễ dàng nhận được những đặc quyền của V-Kho.</span>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[20px] xl:gap-[30px] max-w-[650px] lg:max-w-[900px] xl:max-w-[1440px] mx-auto">
            <div class="item-qt flex flex-col items-center gap-[30px] p-3 py-10">
                <div class="w-[85px] h-[85px] rounded-full bg-[#FFF] flex items-center justify-center text-[#258AFF] text-[40px] font-semibold">
                    1
                </div>
                <h2 class="text-[#258AFF] text-[20px] md:text-[24px] xl:text-[28px] font-semibold text-center">Tạo tài khoản</h2>
                <span class="text-[#343434] text-sm text-center md:text-base xl:text-lg font-semibold">Tạo tài khoản dễ dàng bằng cách truy cập cổng đăng ký và điền thông tin chỉ với 2 bước sau:</span>
                <div class="flex items-center gap-3">
                    <div class="bg-[#FFBA49] text-[#FFF] py-[6px] px-[10px] rounded-[5px] text-sm xl:text-xl font-semibold max-w-[80px] whitespace-nowrap">Bước 1</div>
                    <span class="text-[#525252] text-sm xl:text-lg font-medium">Cung cấp thông tin Người/Cơ quan quản lý KHO</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-[#FFBA49] text-[#FFF] py-[6px] px-[10px] rounded-[5px] text-sm xl:text-xl font-semibold max-w-[80px] whitespace-nowrap">Bước 2</div>
                    <span class="text-[#525252] text-sm xl:text-lg font-medium">Cung cấp thông tin chi tiết về kho hàng.</span>
                </div>
            </div>
            <div class="item-qt flex flex-col items-center gap-[30px] p-3 py-10">
                <div class="w-[85px] h-[85px] rounded-full bg-[#FFF] flex items-center justify-center text-[#258AFF] text-[40px] font-semibold">
                   2
                </div>
                <h2 class="text-[#258AFF] text-[20px] md:text-[24px] xl:text-[28px] font-semibold text-center">Tiếp nhận hàng hóa từ Nhà cung cấp V-Store</h2>
                <span class="text-[#343434] text-sm text-center md:text-base xl:text-lg font-semibold">Hàng nghìn Nhà cung cấp từ khắp cả nước chờ sử dụng KHO của bạn để đấu nối vào chuỗi cung ứng hàng hóa đến tay người dùng.</span>

            </div>
            <div class="item-qt flex flex-col items-center gap-[30px] p-3 py-10">
                <div class="w-[85px] h-[85px] rounded-full bg-[#FFF] flex items-center justify-center text-[#258AFF] text-[40px] font-semibold">
                   3
                </div>
                <h2 class="text-[#258AFF] text-[20px] md:text-[24px] xl:text-[28px] font-semibold text-center">Chuyển giao sản phẩm cho Đối tác vận chuyển</h2>
                <span class="text-[#343434] text-sm text-center md:text-base xl:text-lg font-semibold">Các đơn vị vận chuyển sẽ đến KHO lấy hàng để giao đến tay người dùng.</span>

            </div>
        </div>
    </div>
</div>
<div class="bg-gra">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-16 place-items-center w-full md:max-w-[1440px] mx-auto md:p-16 p-4">
    <div class="flex flex-col gap-6 order-last md:order-first text-center ">
        <h2 class="font-semibold text-lg sm:text-4xl text-[#1D293F] flex justify-center items-center gap-[8px]">Lợi ích tham gia <div class="w-[103px] h-36px]">
                    <img src="{{asset('home/img/titleK.png')}}" class="w-full object-contain" alt=""></h2>
        <div class="flex flex-col gap-4">
        <div class="flex items-center gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left ">Tham gia vào hệ thống thương mại điện tử V-Store</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left ">Được cung cấp website quản trị riêng cho tính năng quản lý KHO. </span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left">Hàng nghìn Nhà cung cấp của V-Store chờ gửi hàng vào <br> KHO.</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left ">Được hưởng chiết khấu, lợi nhuận trên từng sản phẩm.</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left ">Tối ưu chi phí củng cố hiệu quả kinh tế.
                </span>
        </div>
        <div class="flex items-center gap-4">
            <div class="w-[21px]">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.17 0.582764L0.5 10.2528H10.17V0.582764Z" fill="#6FC9FC"/>
<path d="M19.8399 10.2528L10.1699 0.582764V10.2528H19.8399Z" fill="#00A3FF"/>
<path d="M10.1699 10.2528V19.9228L19.8399 10.2528H10.1699Z" fill="#0074C9"/>
<path d="M0.5 10.2528L10.17 19.9228V10.2528H0.5Z" fill="#4D9AE1"/>
</svg>

            </div>
            <span class=" text-[#343434] leading-[24px] text-[12px] sm:text-lg text-left ">Tham gia các khóa đào tạo về công nghệ, chức năng mới của hệ thống VDONE, V-Store.</span>
        </div>
        </div>

    </div>
    <div class="max-w-[421px] h-auto md:h-[478px] order-first md:order-last">
        <img src="{{asset('home/img/loikho.png')}}" class="w-full" alt="">
    </div>
</div>

</div>


<footer class="bg-[#1E90FF]">
    <div class="flex flex-col md:flex-row items-center justify-between  w-full md:max-w-[1440px] mx-auto py-4 xl:px-20 px-[20px] gap-y-4">
        <ul class="flex items-center gap-14">
            <li><a href="#">
            <svg width="25" height="21" viewBox="0 0 25 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M24.6183 2.54128C23.713 2.93181 22.7278 3.21288 21.713 3.32234C22.7666 2.69641 23.5556 1.70755 23.9319 0.541279C22.9433 1.12941 21.8602 1.54182 20.7308 1.76021C20.2587 1.25556 19.6878 0.853527 19.0535 0.579171C18.4193 0.304815 17.7354 0.164013 17.0444 0.16554C14.2485 0.16554 12 2.43181 12 5.21287C12 5.60341 12.0473 5.99394 12.1243 6.36968C7.93786 6.15074 4.20414 4.15074 1.72189 1.08862C1.2696 1.86115 1.03258 2.74076 1.0355 3.63595C1.0355 5.38743 1.92603 6.93181 3.28402 7.84009C2.48374 7.80857 1.7022 7.58861 1.00296 7.19808V7.26021C1.00296 9.71287 2.73668 11.7454 5.04733 12.2129C4.61348 12.3256 4.16718 12.3832 3.71893 12.3845C3.39053 12.3845 3.07988 12.3519 2.76627 12.3075C3.40532 14.3075 5.26627 15.7602 7.48224 15.8075C5.74852 17.1655 3.57692 17.9643 1.21893 17.9643C0.795858 17.9643 0.405325 17.9496 0 17.9022C2.23668 19.3371 4.89053 20.1655 7.74852 20.1655C17.0266 20.1655 22.1035 12.4791 22.1035 5.80755C22.1035 5.58861 22.1035 5.36968 22.0887 5.15074C23.071 4.43181 23.9319 3.54128 24.6183 2.54128Z" fill="white"/>
</svg>
                </a></li>
            <li><a href="#">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.6172 0.165527C5.09516 0.165527 0.618164 4.64253 0.618164 10.1645C0.618164 15.1545 4.27416 19.2905 9.05516 20.0435V13.0555H6.51516V10.1645H9.05516V7.96153C9.05516 5.45353 10.5482 4.07053 12.8312 4.07053C13.9252 4.07053 15.0712 4.26553 15.0712 4.26553V6.72453H13.8072C12.5672 6.72453 12.1792 7.49653 12.1792 8.28753V10.1625H14.9502L14.5072 13.0535H12.1792V20.0415C16.9602 19.2925 20.6162 15.1555 20.6162 10.1645C20.6162 4.64253 16.1392 0.165527 10.6172 0.165527Z" fill="white"/>
</svg>

                </a></li>
            <li><a href="#">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M2.63925 0.165527C12.5911 0.165527 20.6905 8.24128 20.7327 18.1831V18.1837H20.7342V19.2356H20.7224C20.6961 19.4689 20.5917 19.6864 20.4262 19.8529C20.2607 20.0194 20.0439 20.1252 19.8108 20.153V20.1654H17.9405V20.1633C17.6875 20.158 17.445 20.061 17.2582 19.8903C17.0714 19.7196 16.953 19.4868 16.925 19.2353H16.9132V18.1834H16.9238C16.8816 10.3411 10.4909 3.97414 2.63895 3.97414C2.63149 3.97414 2.62404 3.97359 2.61659 3.97305C2.61037 3.9726 2.60416 3.97215 2.59795 3.97201V3.98659H1.54604V3.97474C1.31275 3.94846 1.09519 3.84411 0.928667 3.67863C0.76214 3.51315 0.65642 3.29625 0.628661 3.06313H0.616211V1.19284H0.618337C0.62363 0.939839 0.720661 0.69738 0.891372 0.510581C1.06208 0.323782 1.29485 0.205367 1.54635 0.17737V0.165527H2.59825V0.167653C2.60443 0.167516 2.61055 0.167068 2.61669 0.166619C2.62413 0.166074 2.6316 0.165527 2.63925 0.165527ZM2.63925 7.37172C2.6316 7.37172 2.62413 7.37227 2.61669 7.37281L2.61668 7.37281C2.61054 7.37326 2.60443 7.37371 2.59825 7.37385V7.37172H1.54635V7.38356C1.29485 7.41156 1.06208 7.52997 0.891372 7.71677C0.720661 7.90357 0.62363 8.14603 0.618337 8.39903H0.616211V10.2693H0.628661C0.656472 10.5024 0.762209 10.7193 0.928726 10.8848C1.09524 11.0502 1.31277 11.1546 1.54604 11.1809V11.1928H2.59795V11.1782C2.60416 11.1783 2.61037 11.1788 2.61658 11.1792C2.62404 11.1798 2.63149 11.1803 2.63895 11.1803C6.5174 11.1803 9.67585 14.3145 9.71776 18.1832H9.70774V19.2351H9.71958C9.74758 19.4866 9.86599 19.7194 10.0528 19.8901C10.2396 20.0608 10.482 20.1578 10.735 20.1631V20.1653H12.605V20.1528C12.8381 20.125 13.055 20.0193 13.2205 19.8528C13.3859 19.6862 13.4903 19.4687 13.5166 19.2354H13.5285V18.1835H13.5267C13.4851 12.2143 8.61757 7.37172 2.63925 7.37172ZM3.46569 14.7048C3.11545 14.7048 2.76865 14.7738 2.44509 14.9079C2.12154 15.042 1.82756 15.2385 1.57996 15.4862C1.33237 15.7339 1.136 16.028 1.00208 16.3516C0.868166 16.6752 0.79932 17.022 0.79948 17.3723C0.79948 17.7225 0.868459 18.0693 1.00248 18.3928C1.1365 18.7164 1.33294 19.0103 1.58057 19.258C1.82821 19.5056 2.1222 19.7021 2.44575 19.8361C2.7693 19.9701 3.11608 20.0391 3.4663 20.0391C3.81651 20.0391 4.16329 19.9701 4.48684 19.8361C4.81039 19.7021 5.10438 19.5056 5.35202 19.258C5.59965 19.0103 5.79609 18.7164 5.93011 18.3928C6.06413 18.0693 6.13311 17.7225 6.13311 17.3723C6.13327 17.0219 6.06438 16.675 5.93039 16.3513C5.7964 16.0276 5.59992 15.7335 5.3522 15.4857C5.10447 15.238 4.81035 15.0415 4.48666 14.9076C4.16296 14.7736 3.81602 14.7047 3.46569 14.7048Z" fill="white"/>
</svg>


                </a></li>
            <li><a href="#">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10.7319 6.83077C8.89563 6.83077 7.39712 8.32929 7.39712 10.1655C7.39712 12.0018 8.89563 13.5003 10.7319 13.5003C12.5681 13.5003 14.0666 12.0018 14.0666 10.1655C14.0666 8.32929 12.5681 6.83077 10.7319 6.83077ZM20.7336 10.1655C20.7336 8.78459 20.7461 7.41617 20.6686 6.03774C20.591 4.43666 20.2258 3.0157 19.055 1.84491C17.8817 0.671613 16.4632 0.308868 14.8622 0.231315C13.4812 0.153763 12.1128 0.166271 10.7344 0.166271C9.35344 0.166271 7.98502 0.153763 6.60659 0.231315C5.0055 0.308868 3.58454 0.674114 2.41375 1.84491C1.24046 3.0182 0.877715 4.43666 0.800163 6.03774C0.722611 7.41867 0.735119 8.7871 0.735119 10.1655C0.735119 11.544 0.722611 12.9149 0.800163 14.2933C0.877715 15.8944 1.24296 17.3154 2.41375 18.4861C3.58705 19.6594 5.0055 20.0222 6.60659 20.0997C7.98752 20.1773 9.35594 20.1648 10.7344 20.1648C12.1153 20.1648 13.4837 20.1773 14.8622 20.0997C16.4632 20.0222 17.8842 19.6569 19.055 18.4861C20.2283 17.3129 20.591 15.8944 20.6686 14.2933C20.7486 12.9149 20.7336 11.5465 20.7336 10.1655ZM10.7319 15.2965C7.89245 15.2965 5.60091 13.0049 5.60091 10.1655C5.60091 7.32611 7.89245 5.03456 10.7319 5.03456C13.5713 5.03456 15.8628 7.32611 15.8628 10.1655C15.8628 13.0049 13.5713 15.2965 10.7319 15.2965ZM16.073 6.02273C15.41 6.02273 14.8747 5.48737 14.8747 4.82442C14.8747 4.16147 15.41 3.62611 16.073 3.62611C16.7359 3.62611 17.2713 4.16147 17.2713 4.82442C17.2715 4.98184 17.2406 5.13775 17.1805 5.28323C17.1203 5.4287 17.0321 5.56088 16.9208 5.67219C16.8094 5.7835 16.6773 5.87176 16.5318 5.93191C16.3863 5.99207 16.2304 6.02293 16.073 6.02273Z" fill="white"/>
</svg>


                </a></li>
        </ul>
        <span class="uppercase text-xs text-[#FFF]">Copyright <script>document.write(new Date().getFullYear());</script> © viptam.com</span>
    </div>
</footer>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</body>
</html>
