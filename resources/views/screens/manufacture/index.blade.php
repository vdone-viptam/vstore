<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ nhà cung cấp V-Store</title>
    <link rel="stylesheet" href="{{asset('home/dist/style.css')}}">
    <link rel="stylesheet" href="{{asset('home/dist/output.css')}}">
    {{--    <link rel="stylesheet" href="../../dist/output.css">--}}
    <meta property="og:title" content="V-Ncc" />
    <meta property="og:title" content="V-ncc | Ecommerce. Cổng thương mại điện tử dành cho nhà cung cấp và sản xuất"/>
    <meta property="og:description" content="Hãy đồng hành cùng 20.000+ người kinh doanh và nhà phân phối uy tín tại việt nam."/>
    <meta property="og:description" content="" />
    <meta property="og:url" content="{{asset('')}}" />
    <meta property="og:image" content="{{asset('home/img/logo-05.png')}}" />
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
    <meta property="og:image:width" content="120">
    <meta property="og:image:height" content="100">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<style>
    body{
        font-family: 'Nunito Sans';
    }
</style>
    @vite('resources/css/app.css')
</head>
<body>
<div class="bgncc w-full relative h-auto md:h-screen">
    <div class=" w-full md:max-w-[1440px] mx-auto flex flex-col justify-start gap-6 md:gap-3 py-10 md:h-screen xl:px-20 px-[20px]">
        <div class="flex justify-between items-center">
            <div class=" w-[107px] h-[38px]">
                <a href="./">
                <img src="{{asset('home/img/NCC.png')}}" class="w-full object-contain" alt="">
                </a>
            </div>
            <div class="w-[105px] h-[82px]">
            <img src="{{asset('home/img/vdone.png')}}" class="w-full object-contain" alt="">

            </div>
        </div>
        <div class="flex flex-col justify-center w-full md:justify-start gap-8 md:max-w-[750px] text-center md:text-left">
            <h2 class="font-extrabold text-[#FFF] md:text-[64px] md:leading-[90px] text-2xl ">Trở thành Nhà cung cấp</h2>
            <span class="text-[#FFF] max-w-[450px]">Tham gia vào hệ thống Thương mại điện tử V-Store để mang sản phẩm của bạn đến tay người tiêu dùng.</span>
            <div class="max-w-[625px] relative">
                <img src="{{asset('home/img/bannerK.png')}}" alt="" class="w-full object-contain">
                <div
                    class="absolute top-1/2 md:-translate-y-[40px] -translate-y-[30px] left-[100px] font-bold text-2xl md:text-4xl text-[#FFF]">
                    12.000.000đ
                </div>
                <div class="absolute text-center top-3/4 center-content w-full px-2 md:px-10 md:py-8 py-5 ">
                    <div class="flex items-center md:gap-2">
                        <div class="w-[25px]">
                            <div class="w-[24px] h-[24px]">
                                <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.0003 18.775L7.85033 21.275C7.667 21.3916 7.47533 21.4416 7.27533 21.4249C7.07533 21.4083 6.90033 21.3416 6.75033 21.225C6.60033 21.1083 6.48366 20.9623 6.40033 20.787C6.317 20.6116 6.30033 20.416 6.35033 20.2L7.45033 15.475L3.77533 12.3C3.60866 12.15 3.50466 11.979 3.46333 11.787C3.422 11.595 3.43433 11.4076 3.50033 11.225C3.567 11.0416 3.667 10.8916 3.80033 10.775C3.93366 10.6583 4.117 10.5833 4.35033 10.55L9.20033 10.125L11.0753 5.67495C11.1587 5.47495 11.288 5.32495 11.4633 5.22495C11.6387 5.12495 11.8177 5.07495 12.0003 5.07495C12.1837 5.07495 12.3627 5.12495 12.5373 5.22495C12.712 5.32495 12.8413 5.47495 12.9253 5.67495L14.8003 10.125L19.6503 10.55C19.8837 10.5833 20.067 10.6583 20.2003 10.775C20.3337 10.8916 20.4337 11.0416 20.5003 11.225C20.567 11.4083 20.5797 11.596 20.5383 11.788C20.497 11.98 20.3927 12.1506 20.2253 12.3L16.5503 15.475L17.6503 20.2C17.7003 20.4166 17.6837 20.6126 17.6003 20.788C17.517 20.9633 17.4003 21.109 17.2503 21.225C17.1003 21.3416 16.9253 21.4083 16.7253 21.4249C16.5253 21.4416 16.3337 21.3916 16.1503 21.275L12.0003 18.775Z"
                                        fill="#F0B90B"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs md:text-lg whitespace-nowrap font-bold text-[#258AFF]">Sở hữu Tài khoản NCC sử dụng trong 1 năm.</span>
                    </div>
                    <div class="flex items-center md:gap-2">
                        <div class="w-[25px]">
                            <div class="w-[24px] h-[24px]">
                                <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.0003 18.775L7.85033 21.275C7.667 21.3916 7.47533 21.4416 7.27533 21.4249C7.07533 21.4083 6.90033 21.3416 6.75033 21.225C6.60033 21.1083 6.48366 20.9623 6.40033 20.787C6.317 20.6116 6.30033 20.416 6.35033 20.2L7.45033 15.475L3.77533 12.3C3.60866 12.15 3.50466 11.979 3.46333 11.787C3.422 11.595 3.43433 11.4076 3.50033 11.225C3.567 11.0416 3.667 10.8916 3.80033 10.775C3.93366 10.6583 4.117 10.5833 4.35033 10.55L9.20033 10.125L11.0753 5.67495C11.1587 5.47495 11.288 5.32495 11.4633 5.22495C11.6387 5.12495 11.8177 5.07495 12.0003 5.07495C12.1837 5.07495 12.3627 5.12495 12.5373 5.22495C12.712 5.32495 12.8413 5.47495 12.9253 5.67495L14.8003 10.125L19.6503 10.55C19.8837 10.5833 20.067 10.6583 20.2003 10.775C20.3337 10.8916 20.4337 11.0416 20.5003 11.225C20.567 11.4083 20.5797 11.596 20.5383 11.788C20.497 11.98 20.3927 12.1506 20.2253 12.3L16.5503 15.475L17.6503 20.2C17.7003 20.4166 17.6837 20.6126 17.6003 20.788C17.517 20.9633 17.4003 21.109 17.2503 21.225C17.1003 21.3416 16.9253 21.4083 16.7253 21.4249C16.5253 21.4416 16.3337 21.3916 16.1503 21.275L12.0003 18.775Z"
                                        fill="#F0B90B"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-xs md:text-lg whitespace-nowrap font-bold text-[#258AFF]">Tặng thêm 10 tài khoản KHO miễn phí trong 1 năm.</span>
                    </div>
                </div>
            </div>
                <div class="flex justify-center md:justify-start items-center gap-6">
                    <a href="{{route('register_ncc')}}"
                       class="text-xs md:text-base rounded-[4px] text-[#00A8DB]  hover:opacity-70 transition-all duration-200 px-4 py-[6px] md:py-[10px]  font-semibold bg-[#fff] border-[#FFF] border-[1px] md:px-10">Đăng
                        ký ngay</a>

        <a class="text-xs md:text-base text-center  rounded-[4px] text-[#FFF] px-4 py-[6px] md:py-[10px] bg-[#5AC3ED]  border-[#FFF] border-[1px] md:px-10 font-semibold transition-all duration-200 hover:opacity-70"  href="{{route('login_ncc')}}">Đăng nhập</a>

        </div>
        </div>


    </div>

    </div>
    <div
        class="grid grid-cols-1 lg:grid-cols-2 gap-16  w-full md:max-w-[1440px] place-items-end mx-auto md:p-16 my-8 p-4">
        <div class="w-full h-full order-last md:order-first">
            <img src="{{asset('home/img/imgncc.png')}}" class="w-full" alt="">
        </div>
        <div class="flex flex-col gap-6 order-first md:order-last text-center md:text-left">
            <h2 class="font-bold text-2xl md:text-4xl text-[#034D82]">Nhà cung cấp là gì?</h2>
            <span class=" text-[#90A3B4] tracking-[0.3px] ">"Nhà cung cấp" là mắt xích vô cùng quan trọng trong chuỗi hoạt động thương mại điện tử của nền tảng VDone. Tại VDone, Các nhà cung cấp là tổ chức bao gồm Doanh nghiệp, Hợp tác xã, Hộ kinh doanh, có đủ nguồn lực cung cấp sản phẩm hoặc dịch vụ cho V-Store, đảm bảo nguồn hàng liên tục cho hoạt động kinh doanh. Mỗi Nhà cung cấp sẽ đăng ký sản phẩm và đưa đến người tiêu dùng thông qua Cổng thương mại điện tử V-Store.</span>
            <a href="{{route('register_ncc')}}"
               class="flex items-center gap-5 font-bold text-[#04AADD] hover:opacity-70 transition-all duration-200">Trở
                thành Nhà cung cấp
                <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.5303 6.53033C15.8232 6.23744 15.8232 5.76256 15.5303 5.46967L10.7574 0.6967C10.4645 0.403807 9.98959 0.403807 9.6967 0.6967C9.40381 0.989593 9.40381 1.46447 9.6967 1.75736L13.9393 6L9.6967 10.2426C9.40381 10.5355 9.40381 11.0104 9.6967 11.3033C9.98959 11.5962 10.4645 11.5962 10.7574 11.3033L15.5303 6.53033ZM-6.55671e-08 6.75L15 6.75L15 5.25L6.55671e-08 5.25L-6.55671e-08 6.75Z"
                        fill="#04AADD"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="relative w-full h-full">
        <div class="absolute top-[-30px] right-0 bannerncc z-[-1] md:-rotate-[5deg]">

   </div>
   <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 w-full md:max-w-[1440px] mx-auto place-items-center p-4">
        <div class="flex flex-col gap-6 max-w-[485px]">
            <h2 class="text-[#034D82] font-bold text-2xl md:text-4xl tracking-[0.3px] text-center">Quy trình trở thành <br> Nhà cung cấp</h2>
            <span class="font-semibold tracking-[0.3px] text-[#90A3B4]">Quy trình đăng kí V-Store đơn giản nhanh chóng, giúp người dùng dễ dàng nhận được những đặc quyền của Nhà cung cấp</span>
            <ul class="step">
                <li><a href="#" class="flex flex-col text-[#FEB30D] font-bold gap-1"><div class="dot"></div> Bước 1: Tạo tài khoản <span class="text-sm text-[#90A3B4] font-semibold">Tạo tài khoản dễ dàng bằng cách truy cập cổng đăng ký và điền thông tin theo hướng dẫn</span></a></li>
                <li><a href="#" class="flex flex-col text-[#FEB30D] font-bold gap-1"><div class="dot"></div>Bước 2: Đưa sản phẩm lên V-Store<span class="text-sm text-[#90A3B4] font-semibold">Hoàn thiện thông tin sản phẩm trên V-Store theo hướng dẫn</span></a></li>
                <li><a href="#" class="flex flex-col text-[#FEB30D] font-bold gap-1"><div class="dot"></div>Bước 3: Quản lý bán hàng <span class="text-sm text-[#90A3B4] font-semibold">Quản lý đơn hàng trên hệ thống và đưa sản phẩm tới người tiêu dùng</span></a></li>
            </ul>
        </div>
        <div class="order-first md:order-last">
        <img src="{{asset('home/img/bncom.png')}}" class="w-full" alt="">
        </div>
   </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-y-10 lg:gap-16  w-full md:max-w-[1440px] mx-auto md:p-16 my-8 p-4">
    <div class="w-full h-full grid grid-cols-2 md:grid-cols-3 gap-x-[4px] md:gap-x-[23px] gap-y-[10px]  col-span-8">
       <div class="text-center boxli w-full p-3 mx-auto">
            <div class="w-[35px] md:w-[76px] mx-auto mb-4">
                <div class="w-[34px] h-[34px] md:w-[75px] md:h-[75px] rounded-full">
                    <img src="{{asset('home/img/iconpla.png')}}" class="w-full rounded-full" alt="">
                </div>
            </div>
            <span class="text-sm font-semibold text-[#034D82] text-center">
            Được quyền hỗ trợ bảo hành nâng cấp hệ thống
            </span>
       </div>
       <div class="text-center boxli w-full p-3 mx-auto">
       <div class="w-[35px] md:w-[76px] mx-auto mb-4">
                <div class="w-[34px] h-[34px] md:w-[75px] md:h-[75px] rounded-full">
                    <img src="{{asset('home/img/iconpla.png')}}" class="w-full rounded-full" alt="">
                </div>
            </div>
            <span class="text-sm font-semibold text-[#034D82] text-center">
            Được cung cấp website quản trị riêng cho tính năng quản trị sản phẩm, quản lý bán hàng.
            </span>
       </div>
       <div class="text-center boxli w-full p-3 mx-auto">
       <div class="w-[35px] md:w-[76px] mx-auto mb-4">
                <div class="w-[34px] h-[34px] md:w-[75px] md:h-[75px] rounded-full">
                    <img src="{{asset('home/img/iconpla.png')}}" class="w-full rounded-full" alt="">
                </div>
            </div>
            <span class="text-sm font-semibold text-[#034D82] text-center">
            Được chủ động đàm phán, điều chỉnh mức giá, chiết khấu sản phẩm.
            </span>
       </div>
       <div class="text-center boxli w-full p-3 mx-auto">
       <div class="w-[35px] md:w-[76px] mx-auto mb-4">
                <div class="w-[34px] h-[34px] md:w-[75px] md:h-[75px] rounded-full">
                    <img src="{{asset('home/img/iconpla.png')}}" class="w-full rounded-full" alt="">
                </div>
            </div>
            <span class="text-sm font-semibold text-[#034D82] text-center">
            Được hưởng chiết khấu, lợi nhuận trên từng sản phẩm.
            </span>
            </div>
            <div class="text-center boxli w-full p-3 mx-auto">
                <div class="w-[35px] md:w-[76px] mx-auto mb-4">
                    <div class="w-[34px] h-[34px] md:w-[75px] md:h-[75px] rounded-full">
                        <img src="{{asset('home/img/iconpla.png')}}" class="w-full rounded-full" alt="">
                    </div>
                </div>
                <span class="text-sm font-semibold text-[#034D82] text-center">
            Được VDone hỗ trợ kết nối tới các V-Shop.
            </span>
       </div>
       <div class="text-center boxli w-full p-3 mx-auto">
       <div class="w-[35px] md:w-[76px] mx-auto mb-4">
                <div class="w-[34px] h-[34px] md:w-[75px] md:h-[75px] rounded-full">
                    <img src="{{asset('home/img/iconpla.png')}}" class="w-full rounded-full" alt="">
                </div>
            </div>
            <span class="text-sm font-semibold text-[#034D82] text-center">
            Công nghệ hoàn toàn mới
            </span>
       </div>
    </div>
    <div class="flex flex-col gap-6 text-center md:text-left col-span-4">
        <h2 class="font-bold text-2xl md:text-4xl text-[#034D82]">Lợi ích khi trở thành <br> Nhà cung cấp</h2>
        <span class=" text-[#90A3B4] tracking-[0.3px] ">Khi trở thành “Nhà cung cấp” bạn sẽ được kết nối với hệ thống quản trị thương mại điện tử thông qua hình thức đăng tài hàng hóa, dịch vụ trên cổng V-Store để thực hiện hoạt động thương mại hóa cho các sản phẩm của doanh nghiêp.</span>
        <a href="#" class="flex items-center gap-5 font-bold text-[#04AADD] hover:opacity-70 transition-all duration-200">Trở thành Nhà cung cấp <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.5303 6.53033C15.8232 6.23744 15.8232 5.76256 15.5303 5.46967L10.7574 0.6967C10.4645 0.403807 9.98959 0.403807 9.6967 0.6967C9.40381 0.989593 9.40381 1.46447 9.6967 1.75736L13.9393 6L9.6967 10.2426C9.40381 10.5355 9.40381 11.0104 9.6967 11.3033C9.98959 11.5962 10.4645 11.5962 10.7574 11.3033L15.5303 6.53033ZM-6.55671e-08 6.75L15 6.75L15 5.25L6.55671e-08 5.25L-6.55671e-08 6.75Z" fill="#04AADD"/>
</svg>
</a>
    </div>
</div>


<div class="bg-[#D4F0FF]">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8   w-full md:max-w-[1440px] mx-auto xl:px-20 px-[20px] py-10">
        <div class="flex flex-col gap-6">
            <h2 class="text-[#034D82] font-bold text-4xl text-center">Nhà cung cấp nói gì khi hợp tác với <br> V-Store</h2>
            <span class="text-[#90A3B4]">V-Store đang hợp tác với hơn 1000 nhà cung cấp ở đa dạng ngành hàng. Phối hợp cung ứng hàng hoá mang lại doanh thu vượt trội so với các nền tảng thương mại điện tử thông thường.</span>
        </div>
        <div class="slider">
            <section>
                <div class="flex relative flex-col gap-6 max-w-[442px] mx-auto">
                <svg width="122" height="18" viewBox="0 0 122 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.09375 1.5625L6.0625 5.71875L1.46875 6.375C0.65625 6.5 0.34375 7.5 0.9375 8.09375L4.21875 11.3125L3.4375 15.8438C3.3125 16.6562 4.1875 17.2812 4.90625 16.9062L9 14.75L13.0625 16.9062C13.7812 17.2812 14.6562 16.6562 14.5312 15.8438L13.75 11.3125L17.0312 8.09375C17.625 7.5 17.3125 6.5 16.5 6.375L11.9375 5.71875L9.875 1.5625C9.53125 0.84375 8.46875 0.8125 8.09375 1.5625Z" fill="#FAAD13"/>
                <path d="M34.0938 1.5625L32.0625 5.71875L27.4688 6.375C26.6562 6.5 26.3438 7.5 26.9375 8.09375L30.2188 11.3125L29.4375 15.8438C29.3125 16.6562 30.1875 17.2812 30.9062 16.9062L35 14.75L39.0625 16.9062C39.7812 17.2812 40.6562 16.6562 40.5312 15.8438L39.75 11.3125L43.0312 8.09375C43.625 7.5 43.3125 6.5 42.5 6.375L37.9375 5.71875L35.875 1.5625C35.5312 0.84375 34.4688 0.8125 34.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M60.0938 1.5625L58.0625 5.71875L53.4688 6.375C52.6562 6.5 52.3438 7.5 52.9375 8.09375L56.2188 11.3125L55.4375 15.8438C55.3125 16.6562 56.1875 17.2812 56.9062 16.9062L61 14.75L65.0625 16.9062C65.7812 17.2812 66.6562 16.6562 66.5312 15.8438L65.75 11.3125L69.0312 8.09375C69.625 7.5 69.3125 6.5 68.5 6.375L63.9375 5.71875L61.875 1.5625C61.5312 0.84375 60.4688 0.8125 60.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M86.0938 1.5625L84.0625 5.71875L79.4688 6.375C78.6562 6.5 78.3438 7.5 78.9375 8.09375L82.2188 11.3125L81.4375 15.8438C81.3125 16.6562 82.1875 17.2812 82.9062 16.9062L87 14.75L91.0625 16.9062C91.7812 17.2812 92.6562 16.6562 92.5312 15.8438L91.75 11.3125L95.0312 8.09375C95.625 7.5 95.3125 6.5 94.5 6.375L89.9375 5.71875L87.875 1.5625C87.5312 0.84375 86.4688 0.8125 86.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M112.094 1.5625L110.062 5.71875L105.469 6.375C104.656 6.5 104.344 7.5 104.938 8.09375L108.219 11.3125L107.438 15.8438C107.312 16.6562 108.188 17.2812 108.906 16.9062L113 14.75L117.062 16.9062C117.781 17.2812 118.656 16.6562 118.531 15.8438L117.75 11.3125L121.031 8.09375C121.625 7.5 121.312 6.5 120.5 6.375L115.938 5.71875L113.875 1.5625C113.531 0.84375 112.469 0.8125 112.094 1.5625Z" fill="#FAAD13"/>
                </svg>
                <span class="text-[#90A3B4]">Tôi và công ty của mình đã có bước đầu thành công khi đưa sản phẩm của mình lên nền tảng V-Store. Việc vận hành cũng vô cùng đơn giản nhờ công cụ quản lý thông minh</span>
                <div class="flex items-center gap-2">
                    <div class="w-[57px]">
                        <div class="w-[56px] h-[56px] rounded-full">
                        <img src="{{asset('home/img/avtcm.png')}}" class="w-full rounded-full" alt="">
                        </div>
                    </div>
                    <div>
                        <h2 class="font-bold text-xl text-[#034D82]">Minh Nguyễn</h2>
                        <span class="text-[#90A3B4]">Giám đốc Cty ABC Việt Nam</span>
                    </div>
                </div>
                <div class="absolute top-[-70px] left-[-55px] text-[130px] text-[#034D82]">
                    "
                </div>
                </div>

            </section>
            <section>
                <div class="flex relative flex-col gap-6 max-w-[442px] mx-auto">
                <svg width="122" height="18" viewBox="0 0 122 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.09375 1.5625L6.0625 5.71875L1.46875 6.375C0.65625 6.5 0.34375 7.5 0.9375 8.09375L4.21875 11.3125L3.4375 15.8438C3.3125 16.6562 4.1875 17.2812 4.90625 16.9062L9 14.75L13.0625 16.9062C13.7812 17.2812 14.6562 16.6562 14.5312 15.8438L13.75 11.3125L17.0312 8.09375C17.625 7.5 17.3125 6.5 16.5 6.375L11.9375 5.71875L9.875 1.5625C9.53125 0.84375 8.46875 0.8125 8.09375 1.5625Z" fill="#FAAD13"/>
                <path d="M34.0938 1.5625L32.0625 5.71875L27.4688 6.375C26.6562 6.5 26.3438 7.5 26.9375 8.09375L30.2188 11.3125L29.4375 15.8438C29.3125 16.6562 30.1875 17.2812 30.9062 16.9062L35 14.75L39.0625 16.9062C39.7812 17.2812 40.6562 16.6562 40.5312 15.8438L39.75 11.3125L43.0312 8.09375C43.625 7.5 43.3125 6.5 42.5 6.375L37.9375 5.71875L35.875 1.5625C35.5312 0.84375 34.4688 0.8125 34.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M60.0938 1.5625L58.0625 5.71875L53.4688 6.375C52.6562 6.5 52.3438 7.5 52.9375 8.09375L56.2188 11.3125L55.4375 15.8438C55.3125 16.6562 56.1875 17.2812 56.9062 16.9062L61 14.75L65.0625 16.9062C65.7812 17.2812 66.6562 16.6562 66.5312 15.8438L65.75 11.3125L69.0312 8.09375C69.625 7.5 69.3125 6.5 68.5 6.375L63.9375 5.71875L61.875 1.5625C61.5312 0.84375 60.4688 0.8125 60.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M86.0938 1.5625L84.0625 5.71875L79.4688 6.375C78.6562 6.5 78.3438 7.5 78.9375 8.09375L82.2188 11.3125L81.4375 15.8438C81.3125 16.6562 82.1875 17.2812 82.9062 16.9062L87 14.75L91.0625 16.9062C91.7812 17.2812 92.6562 16.6562 92.5312 15.8438L91.75 11.3125L95.0312 8.09375C95.625 7.5 95.3125 6.5 94.5 6.375L89.9375 5.71875L87.875 1.5625C87.5312 0.84375 86.4688 0.8125 86.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M112.094 1.5625L110.062 5.71875L105.469 6.375C104.656 6.5 104.344 7.5 104.938 8.09375L108.219 11.3125L107.438 15.8438C107.312 16.6562 108.188 17.2812 108.906 16.9062L113 14.75L117.062 16.9062C117.781 17.2812 118.656 16.6562 118.531 15.8438L117.75 11.3125L121.031 8.09375C121.625 7.5 121.312 6.5 120.5 6.375L115.938 5.71875L113.875 1.5625C113.531 0.84375 112.469 0.8125 112.094 1.5625Z" fill="#FAAD13"/>
                </svg>
                <span class="text-[#90A3B4]">Tôi và công ty của mình đã có bước đầu thành công khi đưa sản phẩm của mình lên nền tảng V-Store. Việc vận hành cũng vô cùng đơn giản nhờ công cụ quản lý thông minh</span>
                <div class="flex items-center gap-2">
                    <div class="w-[57px]">
                        <div class="w-[56px] h-[56px] rounded-full">
                        <img src="{{asset('home/img/avtcm.png')}}" class="w-full rounded-full" alt="">
                        </div>
                    </div>
                    <div>
                        <h2 class="font-bold text-xl text-[#034D82]">Minh Nguyễn</h2>
                        <span class="text-[#90A3B4]">Giám đốc Cty ABC Việt Nam</span>
                    </div>
                </div>
                <div class="absolute top-[-70px] left-[-55px] text-[130px] text-[#034D82]">
                    "
                </div>
                </div>

            </section>
            <section>
                <div class="flex relative flex-col gap-6 max-w-[442px] mx-auto">
                <svg width="122" height="18" viewBox="0 0 122 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.09375 1.5625L6.0625 5.71875L1.46875 6.375C0.65625 6.5 0.34375 7.5 0.9375 8.09375L4.21875 11.3125L3.4375 15.8438C3.3125 16.6562 4.1875 17.2812 4.90625 16.9062L9 14.75L13.0625 16.9062C13.7812 17.2812 14.6562 16.6562 14.5312 15.8438L13.75 11.3125L17.0312 8.09375C17.625 7.5 17.3125 6.5 16.5 6.375L11.9375 5.71875L9.875 1.5625C9.53125 0.84375 8.46875 0.8125 8.09375 1.5625Z" fill="#FAAD13"/>
                <path d="M34.0938 1.5625L32.0625 5.71875L27.4688 6.375C26.6562 6.5 26.3438 7.5 26.9375 8.09375L30.2188 11.3125L29.4375 15.8438C29.3125 16.6562 30.1875 17.2812 30.9062 16.9062L35 14.75L39.0625 16.9062C39.7812 17.2812 40.6562 16.6562 40.5312 15.8438L39.75 11.3125L43.0312 8.09375C43.625 7.5 43.3125 6.5 42.5 6.375L37.9375 5.71875L35.875 1.5625C35.5312 0.84375 34.4688 0.8125 34.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M60.0938 1.5625L58.0625 5.71875L53.4688 6.375C52.6562 6.5 52.3438 7.5 52.9375 8.09375L56.2188 11.3125L55.4375 15.8438C55.3125 16.6562 56.1875 17.2812 56.9062 16.9062L61 14.75L65.0625 16.9062C65.7812 17.2812 66.6562 16.6562 66.5312 15.8438L65.75 11.3125L69.0312 8.09375C69.625 7.5 69.3125 6.5 68.5 6.375L63.9375 5.71875L61.875 1.5625C61.5312 0.84375 60.4688 0.8125 60.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M86.0938 1.5625L84.0625 5.71875L79.4688 6.375C78.6562 6.5 78.3438 7.5 78.9375 8.09375L82.2188 11.3125L81.4375 15.8438C81.3125 16.6562 82.1875 17.2812 82.9062 16.9062L87 14.75L91.0625 16.9062C91.7812 17.2812 92.6562 16.6562 92.5312 15.8438L91.75 11.3125L95.0312 8.09375C95.625 7.5 95.3125 6.5 94.5 6.375L89.9375 5.71875L87.875 1.5625C87.5312 0.84375 86.4688 0.8125 86.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M112.094 1.5625L110.062 5.71875L105.469 6.375C104.656 6.5 104.344 7.5 104.938 8.09375L108.219 11.3125L107.438 15.8438C107.312 16.6562 108.188 17.2812 108.906 16.9062L113 14.75L117.062 16.9062C117.781 17.2812 118.656 16.6562 118.531 15.8438L117.75 11.3125L121.031 8.09375C121.625 7.5 121.312 6.5 120.5 6.375L115.938 5.71875L113.875 1.5625C113.531 0.84375 112.469 0.8125 112.094 1.5625Z" fill="#FAAD13"/>
                </svg>
                <span class="text-[#90A3B4]">Tôi và công ty của mình đã có bước đầu thành công khi đưa sản phẩm của mình lên nền tảng V-Store. Việc vận hành cũng vô cùng đơn giản nhờ công cụ quản lý thông minh</span>
                <div class="flex items-center gap-2">
                    <div class="w-[57px]">
                        <div class="w-[56px] h-[56px] rounded-full">
                        <img src="{{asset('home/img/avtcm.png')}}" class="w-full rounded-full" alt="">
                        </div>
                    </div>
                    <div>
                        <h2 class="font-bold text-xl text-[#034D82]">Minh Nguyễn</h2>
                        <span class="text-[#90A3B4]">Giám đốc Cty ABC Việt Nam</span>
                    </div>
                </div>
                <div class="absolute top-[-70px] left-[-55px] text-[130px] text-[#034D82]">
                    "
                </div>
                </div>

            </section>
            <section>
                <div class="flex relative flex-col gap-6 max-w-[442px] mx-auto">
                <svg width="122" height="18" viewBox="0 0 122 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.09375 1.5625L6.0625 5.71875L1.46875 6.375C0.65625 6.5 0.34375 7.5 0.9375 8.09375L4.21875 11.3125L3.4375 15.8438C3.3125 16.6562 4.1875 17.2812 4.90625 16.9062L9 14.75L13.0625 16.9062C13.7812 17.2812 14.6562 16.6562 14.5312 15.8438L13.75 11.3125L17.0312 8.09375C17.625 7.5 17.3125 6.5 16.5 6.375L11.9375 5.71875L9.875 1.5625C9.53125 0.84375 8.46875 0.8125 8.09375 1.5625Z" fill="#FAAD13"/>
                <path d="M34.0938 1.5625L32.0625 5.71875L27.4688 6.375C26.6562 6.5 26.3438 7.5 26.9375 8.09375L30.2188 11.3125L29.4375 15.8438C29.3125 16.6562 30.1875 17.2812 30.9062 16.9062L35 14.75L39.0625 16.9062C39.7812 17.2812 40.6562 16.6562 40.5312 15.8438L39.75 11.3125L43.0312 8.09375C43.625 7.5 43.3125 6.5 42.5 6.375L37.9375 5.71875L35.875 1.5625C35.5312 0.84375 34.4688 0.8125 34.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M60.0938 1.5625L58.0625 5.71875L53.4688 6.375C52.6562 6.5 52.3438 7.5 52.9375 8.09375L56.2188 11.3125L55.4375 15.8438C55.3125 16.6562 56.1875 17.2812 56.9062 16.9062L61 14.75L65.0625 16.9062C65.7812 17.2812 66.6562 16.6562 66.5312 15.8438L65.75 11.3125L69.0312 8.09375C69.625 7.5 69.3125 6.5 68.5 6.375L63.9375 5.71875L61.875 1.5625C61.5312 0.84375 60.4688 0.8125 60.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M86.0938 1.5625L84.0625 5.71875L79.4688 6.375C78.6562 6.5 78.3438 7.5 78.9375 8.09375L82.2188 11.3125L81.4375 15.8438C81.3125 16.6562 82.1875 17.2812 82.9062 16.9062L87 14.75L91.0625 16.9062C91.7812 17.2812 92.6562 16.6562 92.5312 15.8438L91.75 11.3125L95.0312 8.09375C95.625 7.5 95.3125 6.5 94.5 6.375L89.9375 5.71875L87.875 1.5625C87.5312 0.84375 86.4688 0.8125 86.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M112.094 1.5625L110.062 5.71875L105.469 6.375C104.656 6.5 104.344 7.5 104.938 8.09375L108.219 11.3125L107.438 15.8438C107.312 16.6562 108.188 17.2812 108.906 16.9062L113 14.75L117.062 16.9062C117.781 17.2812 118.656 16.6562 118.531 15.8438L117.75 11.3125L121.031 8.09375C121.625 7.5 121.312 6.5 120.5 6.375L115.938 5.71875L113.875 1.5625C113.531 0.84375 112.469 0.8125 112.094 1.5625Z" fill="#FAAD13"/>
                </svg>
                <span class="text-[#90A3B4]">Tôi và công ty của mình đã có bước đầu thành công khi đưa sản phẩm của mình lên nền tảng V-Store. Việc vận hành cũng vô cùng đơn giản nhờ công cụ quản lý thông minh</span>
                <div class="flex items-center gap-2">
                    <div class="w-[57px]">
                        <div class="w-[56px] h-[56px] rounded-full">
                        <img src="{{asset('home/img/avtcm.png')}}" class="w-full rounded-full" alt="">
                        </div>
                    </div>
                    <div>
                        <h2 class="font-bold text-xl text-[#034D82]">Minh Nguyễn</h2>
                        <span class="text-[#90A3B4]">Giám đốc Cty ABC Việt Nam</span>
                    </div>
                </div>
                <div class="absolute top-[-70px] left-[-55px] text-[130px] text-[#034D82]">
                    "
                </div>
                </div>

            </section>
            <section>
                <div class="flex relative flex-col gap-6 max-w-[442px] mx-auto">
                <svg width="122" height="18" viewBox="0 0 122 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.09375 1.5625L6.0625 5.71875L1.46875 6.375C0.65625 6.5 0.34375 7.5 0.9375 8.09375L4.21875 11.3125L3.4375 15.8438C3.3125 16.6562 4.1875 17.2812 4.90625 16.9062L9 14.75L13.0625 16.9062C13.7812 17.2812 14.6562 16.6562 14.5312 15.8438L13.75 11.3125L17.0312 8.09375C17.625 7.5 17.3125 6.5 16.5 6.375L11.9375 5.71875L9.875 1.5625C9.53125 0.84375 8.46875 0.8125 8.09375 1.5625Z" fill="#FAAD13"/>
                <path d="M34.0938 1.5625L32.0625 5.71875L27.4688 6.375C26.6562 6.5 26.3438 7.5 26.9375 8.09375L30.2188 11.3125L29.4375 15.8438C29.3125 16.6562 30.1875 17.2812 30.9062 16.9062L35 14.75L39.0625 16.9062C39.7812 17.2812 40.6562 16.6562 40.5312 15.8438L39.75 11.3125L43.0312 8.09375C43.625 7.5 43.3125 6.5 42.5 6.375L37.9375 5.71875L35.875 1.5625C35.5312 0.84375 34.4688 0.8125 34.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M60.0938 1.5625L58.0625 5.71875L53.4688 6.375C52.6562 6.5 52.3438 7.5 52.9375 8.09375L56.2188 11.3125L55.4375 15.8438C55.3125 16.6562 56.1875 17.2812 56.9062 16.9062L61 14.75L65.0625 16.9062C65.7812 17.2812 66.6562 16.6562 66.5312 15.8438L65.75 11.3125L69.0312 8.09375C69.625 7.5 69.3125 6.5 68.5 6.375L63.9375 5.71875L61.875 1.5625C61.5312 0.84375 60.4688 0.8125 60.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M86.0938 1.5625L84.0625 5.71875L79.4688 6.375C78.6562 6.5 78.3438 7.5 78.9375 8.09375L82.2188 11.3125L81.4375 15.8438C81.3125 16.6562 82.1875 17.2812 82.9062 16.9062L87 14.75L91.0625 16.9062C91.7812 17.2812 92.6562 16.6562 92.5312 15.8438L91.75 11.3125L95.0312 8.09375C95.625 7.5 95.3125 6.5 94.5 6.375L89.9375 5.71875L87.875 1.5625C87.5312 0.84375 86.4688 0.8125 86.0938 1.5625Z" fill="#FAAD13"/>
                <path d="M112.094 1.5625L110.062 5.71875L105.469 6.375C104.656 6.5 104.344 7.5 104.938 8.09375L108.219 11.3125L107.438 15.8438C107.312 16.6562 108.188 17.2812 108.906 16.9062L113 14.75L117.062 16.9062C117.781 17.2812 118.656 16.6562 118.531 15.8438L117.75 11.3125L121.031 8.09375C121.625 7.5 121.312 6.5 120.5 6.375L115.938 5.71875L113.875 1.5625C113.531 0.84375 112.469 0.8125 112.094 1.5625Z" fill="#FAAD13"/>
                </svg>
                <span class="text-[#90A3B4]">Tôi và công ty của mình đã có bước đầu thành công khi đưa sản phẩm của mình lên nền tảng V-Store. Việc vận hành cũng vô cùng đơn giản nhờ công cụ quản lý thông minh</span>
                <div class="flex items-center gap-2">
                    <div class="w-[57px]">
                        <div class="w-[56px] h-[56px] rounded-full">
                        <img src="{{asset('home/img/avtcm.png')}}" class="w-full rounded-full" alt="">
                        </div>
                    </div>
                    <div>
                        <h2 class="font-bold text-xl text-[#034D82]">Minh Nguyễn</h2>
                        <span class="text-[#90A3B4]">Giám đốc Cty ABC Việt Nam</span>
                    </div>
                </div>
                <div class="absolute top-[-70px] left-[-55px] text-[130px] text-[#034D82]">
                    "
                </div>
                </div>

            </section>

        </div>
    </div>
</div>


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

<script>
    $('.slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        dots: true,
        });
</script>
</body>
</html>
