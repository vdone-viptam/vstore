
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="{{asset('landingpage/output.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
{{--    <link rel="stylesheet" href="../dist/output.css">--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <meta property="og:title" content="NCC" />
    <meta property="og:title" content="NCC | Ecommerce. Cổng thương mại điện tử dành cho nhà cung cấp và sản xuất"/>
    <meta property="og:description" content="Hãy đồng hành cùng 20.000+ người kinh doanh và nhà phân phối uy tín tại việt nam."/>
    <meta property="og:description" content="" />
    <meta property="og:url" content="{{asset('')}}" />
    <meta property="og:image" content="{{asset('home/img/ncc11.png')}}" />
    <meta property="og:image:width" content="120">
    <meta property="og:image:height" content="100">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    @vite('resources/css/app.css')
    <style>
    * {
        font-family: 'Inter', sans-serif;
        transition: all .1s ease;
    }

    .slick-dots li button:before {
        color: #258AFF;
        font-size: 7px;
        width: 18px;
        height: 8px;
    }

    .slider2 .slick-dots li button:before {
        color: white
    }

    .slick-dots li button:before {
        top: -5px;
        left: 0;
    }

    .slick-dots li.slick-active button:before {
        top: 0;
        left: 0;
    }

    .slick-dots li {
        width: 18px;
        height: 8px;
    }

    .slick-dots li button {
        width: 18px;
        height: 8px;
        padding: 0;
    }

    .slider .slick-dots li.slick-active button:before {
        color: #258AFF;
        opacity: 1;
        background-color: #258AFF;
        content: "";
        width: 18px;
        height: 8px;
        border-radius: 4px;
    }

    .slider2 .slick-dots li.slick-active button:before {
        color: #fff;
        opacity: 1;
        content: "";
        background-color: #fff;
        width: 18px;
        height: 8px;
        border-radius: 4px;
    }

    .slider .slick-slide {
        display: flex;
    }

    .slider2 .slick-slide {
        display: flex;
        margin: 0 10px;
    }

    /*  */
    .gg {
        background-image: url('{{asset('landingpage/images/img5.png')}}');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .btn-prev:hover svg path {
        stroke: white;
    }

    /* scrollbar */
    *::-webkit-scrollbar {
        width: 6px;
        height: 10px;
    }

    *::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }

    *::-webkit-scrollbar-thumb {
        background-color: darkgrey;
    }

    /*  */
    @media screen and (max-width: 490px) {
        .grid-shop {
            grid-template-columns: auto;
        }
    }

    .show {
        right: 0;
        transition: ease-in-out all 0.5s;
    }

    .menu-hidden {
        right: -1000px;
        transition: ease-in-out all 0.5s;
    }

    html {
        scroll-behavior: smooth;
    }

    .menu-active {
        color: #258AFF;
    }

    .page-active {
        background-color: #006FFD;
    }

    .page-active p {
        color: white;
    }
</style>

<body class="bg-[#F1F8FF] section" id="home">
    <div class="h-[68px]"></div>
    <div class="fixed top-0 left-0 w-full bg-[#F1F8FF] z-[20] shadow-md">
        <div
            class=" flex justify-between gap-2 items-center py-5 mx-auto xl:px-0 px-5 md:max-w-[710px] lg:max-w-[1000px] xl:max-w-[1200px] 2xl:max-w-[1440px]">
            <div class="max-w-[118px]">
            <div class="w-full h-[50px]">
                @if($user->avatar == '')
                    <a href="#"><img src="{{asset('home/img/NCC.png')}}" class="w-full object-contain " alt=""></a>
                @else
                    <a href="#"><img src="{{asset('/image/users/'.$user->avatar)}}" class="w-full object-contain" alt=""></a>
                @endif
            </div>
        </div>
            <div class="hidden md:flex gap-6 lg:gap-10 justify-center items-center menu">
                <a href="#home">
                    <p
                        class="hover:text-[#258AFF] text-[#696984] menu-active text-sm lg:text-lg font-semibold leading-7 cursor-pointer">
                        Trang chủ
                    </p>
                </a>
                <a href="#gt">
                    <p
                        class="hover:text-[#258AFF] text-[#696984] text-sm lg:text-lg font-semibold leading-7 cursor-pointer">
                        Giới thiệu
                    </p>
                </a>
                <a href="#dm">
                    <p
                        class="hover:text-[#258AFF] text-[#696984] text-sm lg:text-lg font-semibold leading-7 cursor-pointer">
                        Danh mục
                    </p>
                </a>
                <a href="#bs">
                    <p
                        class="hover:text-[#258AFF] text-[#696984] text-sm lg:text-lg font-semibold leading-7 cursor-pointer">
                        Big Sale
                    </p>
                </a>
                <a href="#sp">
                    <p
                        class="hover:text-[#258AFF] text-[#696984] text-sm lg:text-lg font-semibold leading-7 cursor-pointer">
                        Sản phẩm
                        nổi bật</p>
                </a>
                <a href="#vs">
                    <p
                        class="hover:text-[#258AFF] text-[#696984] text-sm lg:text-lg font-semibold leading-7 cursor-pointer">
                        V-Store
                    </p>
                </a>
            </div>
            <div class="md:hidden block cursor-pointer btn-menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M20.75 6C20.75 6.41421 20.4142 6.75 20 6.75L4 6.75C3.58579 6.75 3.25 6.41421 3.25 6C3.25 5.58579 3.58579 5.25 4 5.25L20 5.25C20.4142 5.25 20.75 5.58579 20.75 6Z"
                        fill="#258AFF" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M20.75 12C20.75 12.4142 20.4142 12.75 20 12.75L4 12.75C3.58579 12.75 3.25 12.4142 3.25 12C3.25 11.5858 3.58579 11.25 4 11.25L20 11.25C20.4142 11.25 20.75 11.5858 20.75 12Z"
                        fill="#258AFF" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M20.75 18C20.75 18.4142 20.4142 18.75 20 18.75H4C3.58579 18.75 3.25 18.4142 3.25 18C3.25 17.5858 3.58579 17.25 4 17.25H20C20.4142 17.25 20.75 17.5858 20.75 18Z"
                        fill="#258AFF" />
                </svg>
            </div>
            <div class="block md:hidden menu-show p-5 bg-white w-full fixed h-full top-[66px] -right-[1000px] z-[99]">
                <div class="btn-close float-right">
                    <svg class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.9998 13.4L7.0998 18.3C6.91647 18.4834 6.68314 18.575 6.3998 18.575C6.11647 18.575 5.88314 18.4834 5.6998 18.3C5.51647 18.1167 5.4248 17.8834 5.4248 17.6C5.4248 17.3167 5.51647 17.0834 5.6998 16.9L10.5998 12L5.6998 7.10005C5.51647 6.91672 5.4248 6.68338 5.4248 6.40005C5.4248 6.11672 5.51647 5.88338 5.6998 5.70005C5.88314 5.51672 6.11647 5.42505 6.3998 5.42505C6.68314 5.42505 6.91647 5.51672 7.0998 5.70005L11.9998 10.6L16.8998 5.70005C17.0831 5.51672 17.3165 5.42505 17.5998 5.42505C17.8831 5.42505 18.1165 5.51672 18.2998 5.70005C18.4831 5.88338 18.5748 6.11672 18.5748 6.40005C18.5748 6.68338 18.4831 6.91672 18.2998 7.10005L13.3998 12L18.2998 16.9C18.4831 17.0834 18.5748 17.3167 18.5748 17.6C18.5748 17.8834 18.4831 18.1167 18.2998 18.3C18.1165 18.4834 17.8831 18.575 17.5998 18.575C17.3165 18.575 17.0831 18.4834 16.8998 18.3L11.9998 13.4Z"
                            fill="#2C2C37" />
                    </svg>
                </div>
                <div class="text-center flex flex-col gap-[30px] pt-[60px]">
                    <a href="#home">
                        <p class="hover:text-[#258AFF] text-[#696984] text-base font-semibold cursor-pointer">Trang chủ
                        </p>
                    </a>
                    <a href="#gt">
                        <p class="hover:text-[#258AFF] text-[#696984] text-base font-semibold cursor-pointer">Giới thiệu
                        </p>
                    </a>
                    <a href="#dm">
                        <p class="hover:text-[#258AFF] text-[#696984] text-base font-semibold cursor-pointer">Danh mục
                        </p>
                    </a>
                    <a href="#bs">
                        <p class="hover:text-[#258AFF] text-[#696984] text-base font-semibold cursor-pointer">Big Sale
                        </p>
                    </a>
                    <a href="#sp">
                        <p class="hover:text-[#258AFF] text-[#696984] text-base font-semibold cursor-pointer">Sản phẩm
                            nổi
                            bật
                        </p>
                    </a>
                    <a href="#vs">
                        <p class="hover:text-[#258AFF] text-[#696984] text-base font-semibold cursor-pointer">V-Store
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-[#E8F7FF]">
        <div class="z-[2]">
            <img class="object-cover block lg:hidden md:h-[360px] h-[260px] w-full" src="{{asset('landingpage/images/bg.png')}}" alt="">
            <img class="object-cover hidden lg:block lg:h-[450px] w-full" src="{{asset('landingpage/images/bg1.png')}}" alt="">
        </div>
        <!--  -->
        <div class="mt-[40px] md:mt-[90px] section">
            <p class="uppercase text-[#258AFF] text-[20px] md:text-[30px] font-bold text-center" id="gt">GIỚi THIỆU
            </p>
            <div class="w-[37px] mx-auto border-b-[#258AFF] border-b-[3px]"></div>
        
            <div
                class="w-[90vw] md:w-[710px] lg:w-[1000px] xl:w-[1200px] 2xl:w-[1440px] mx-auto grid grid-cols-1 gap-4 md:gap-0 md:grid-cols-2 justify-between py-[30px] md:py-[40px] lg:py-[60px] bg-[#E8F7FF]">
                <div class="flex gap-[30px] md:pr-6 items-center md:items-start">
                    <img class="w-[82px] h-[82px] md:w-[138px] md:h-[138px] rounded-full"
                        src="{{asset('landingpage/images/img1.png')}}" alt="">
                    <div class="max-w-none md:max-w-[300px] lg:max-w-none">
                        <p class="text-[#2C2C37] md:text-base xl:text-lg font-bold">ID: <span
                                class="text-[#696984] font-normal">{{$user->account_code}}</span>
                        </p>
                        <p class="text-[#2C2C37] md:text-base xl:text-lg font-bold">Liên hệ: <span
                                class="text-[#696984] font-normal">{{$user->phone_number}}</span>
                        </p>
                        <p class="text-[#2C2C37] md:text-base xl:text-lg font-bold">Số sản phẩm: <span
                                class="text-[#696984] font-normal">{{$count_products}}</span>
                        </p>
                        <p class="text-[#2C2C37] md:text-base xl:text-lg font-bold">Danh mục: <span
                                class="text-[#696984] font-normal">@foreach($arrCategory as $val) {{$val->name}}, @endforeach...</span>
                        </p>
                    </div>
                </div>
                <div class="md:border-l md:border-[#258AFF80] md:pl-6 flex flex-col gap-5">
                <span class="font-semibold text-xl"> Giới thiệu</span>
                    <p class="text-[#696984] text-sm md:text-base xl:text-lg">{{$user->description != null ? $user->description : 'Chưa có thông tin mô tả'}}</p>
                    <div class="flex gap-4 items-center slider3">
                        <img class="mx-2 w-[82.5px] h-[82.5px] md:w-[102px] md:h-[102px]"
                            src="{{asset('landingpage/images/img2.png')}}" alt="">
                        <img class="mx-2 w-[82.5px] h-[82.5px] md:w-[102px] md:h-[102px]"
                            src="{{asset('landingpage/images/img2.png')}}" alt="">
                        <img class="mx-2 w-[82.5px] h-[82.5px] md:w-[102px] md:h-[102px]"
                            src="{{asset('landingpage/images/img2.png')}}" alt="">
                        <img class="mx-2 w-[82.5px] h-[82.5px] md:w-[102px] md:h-[102px]"
                            src="{{asset('landingpage/images/img2.png')}}" alt="">
                        <img class="mx-2 w-[82.5px] h-[82.5px] md:w-[102px] md:h-[102px]"
                            src="{{asset('landingpage/images/img2.png')}}" alt="">
                        <img class="mx-2 w-[82.5px] h-[82.5px] md:w-[102px] md:h-[102px]"
                            src="{{asset('landingpage/images/img2.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-[90vw] md:max-w-[710px] lg:max-w-[1000px] xl:max-w-[1200px] 2xl:max-w-[1440px]">
        <p class="uppercase text-[#258AFF] text-[20px] md:text-[30px] font-bold text-center mt-[30px] md:mt-[60px] section"
            id="dm">DANH
            MỤC
        </p>
        <div class="w-[37px] mx-auto border-b-[#258AFF] border-b-[3px]"></div>
        <div class="slider py-[30px] md:py-[50px]">
        @foreach($arrCategory as $cate)
            <div class="flex flex-col gap-4 items-center cursor-pointer">
                <div
                    class="bg-white md:w-[100px] md:h-[100px] w-[60px] h-[60px] flex items-center justify-center rounded-full">
                    @if($cate->img !=null)
                        <img src="{{asset($cate->img)}}" class="md:w-[50px] md:h-[50px] w-[40px] h-[40px]" alt="">
                    @else
                        <img src="{{asset('landingpage/images/wm.png')}}"class="md:w-[50px] md:h-[50px] w-[40px] h-[40px]" alt="">
        
                    @endif
                </div>
                <p class="text-sm text-sm lg:text-base xl:text-lg text-[#2C2C37] text-center">{{$cate->name}}</p>
            </div>
            @endforeach
      
        </div>
        <!--  -->
        <div class="mt-[68px] mb-[60px] section" id="bs">
            <img class="w-full object-contain rounded-tl-2xl rounded-tr-2xl" src="./src/assets/img/bg2.png" alt="">
            <div class="md:min-h-[434px] rounded-bl-2xl rounded-br-2xl pt-[30px] md:pt-[60px] px-[10px] md:pb-[60px] pb-[20px]"
                style="background: linear-gradient(180deg, #258AFF 0%, #99D7FF 100%);">
                <!-- slider2 -->
                <div class="slider2">
                    <div class="w-[256px] flex flex-col relative cursor-pointer">
                        <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                            <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                            <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                        </div>
                        <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                            src="{{asset('landingpage/images/img4.png')}}" alt="">
                        <div
                            class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                            <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">
                                Giày Sneaker
                                MLB NY
                                đẹp đế nâu
                                chuẩn
                                bản
                                Trun</p>
                            <div class="flex gap-1 items-center">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000đ
                                </p>
                                <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                    150.000đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-[256px] flex flex-col relative cursor-pointer">
                        <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                            <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                            <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                        </div>
                        <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                            src="{{asset('landingpage/images/img4.png')}}" alt="">
                        <div
                            class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                            <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">
                                Giày Sneaker
                                MLB NY
                                đẹp đế nâu
                                chuẩn
                                bản
                                Trun</p>
                            <div class="flex gap-1 items-center">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000đ
                                </p>
                                <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                    150.000đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-[256px] flex flex-col relative cursor-pointer">
                        <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                            <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                            <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                        </div>
                        <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                            src="{{asset('landingpage/images/img4.png')}}" alt="">
                        <div
                            class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                            <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">
                                Giày Sneaker
                                MLB NY
                                đẹp đế nâu
                                chuẩn
                                bản
                                Trung</p>
                            <div class="flex gap-1 items-center">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000đ
                                </p>
                                <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                    150.000đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-[256px] flex flex-col relative cursor-pointer">
                        <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                            <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                            <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                        </div>
                        <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                            src="{{asset('landingpage/images/img4.png')}}" alt="">
                        <div
                            class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                            <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">
                                Vans old skool
                                classic CHÍNH HÃNG</p>
                            <div class="flex gap-1 items-center">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000đ
                                </p>
                                <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                    150.000đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-[256px] flex flex-col relative cursor-pointer">
                        <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                            <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                            <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                        </div>
                        <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                            src="{{asset('landingpage/images/img4.png')}}" alt="">
                        <div
                            class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                            <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">
                                Giày tiểu thư
                                vintage hottrend 2023</p>
                            <div class="flex gap-1 items-center">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000đ
                                </p>
                                <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                    150.000đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-[256px] flex flex-col relative cursor-pointer">
                        <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                            <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                            <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                        </div>
                        <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                            src="{{asset('landingpage/images/img4.png')}}" alt="">
                        <div
                            class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                            <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">
                                Set váy hoa nhí
                                tiểu thư vintage hottrend 2023 g...</p>
                            <div class="flex gap-1 items-center">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000đ
                                </p>
                                <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                    150.000đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-[256px] flex flex-col relative cursor-pointer">
                        <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                            <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                            <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                        </div>
                        <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                            src="{{asset('landingpage/images/img4.png')}}" alt="">
                        <div
                            class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                            <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">
                                Váy hoa nhí
                                tiểu
                                thư</p>
                            <div class="flex gap-1 items-center">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                                <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000đ
                                </p>
                                <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                    150.000đ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        <p class="uppercase text-[#258AFF] text-[20px] md:text-[30px] font-bold text-center mt-[30px] md:mt-[60px] section"
            id="sp">SẢN
            PHẨM NỔI BẬT
        </p>
        <div class="w-[37px] mx-auto border-b-[#258AFF] border-b-[3px] mb-[60px]"></div>
        <div
            class="grid grid-cols-2 gap-4 lg:gap-6 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 place-items-center grid-shop">
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/h1.jpg')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/h2.jpg')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/h3.jpg')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                    <p class="text-white text-sm md:text-[17px] font-bold">5%</p>
                    <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                </div>
                <img class="h-[146px] w-full rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                    src="{{asset('landingpage/images/img4.png')}}" alt="">
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]">Giày
                        Sneaker MLB NY đẹp
                        đế
                        nâu chuẩn
                        bản
                        Trun</p>
                    <div class="flex gap-1 items-center">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">120.000.000đ</p>
                        <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                            150.000.000.000đ</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex md:justify-end justify-center">
            <div class="mt-6 flex items-center bg-white border-[#DEE2E6] border rounded-lg divide-x divide-[#DEE2E6]">
                <div class="px-2 md:px-4 py-1 cursor-pointer btn-prev hover:bg-[#006FFD] rounded-tl-lg rounded-bl-lg">
                    <svg width=" 29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.4463 12.6308L15.7546 14.6044L17.4463 16.5781" stroke="#3A57E8" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.4014 12.6308L12.7096 14.6044L14.4014 16.5781" stroke="#3A57E8" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div
                    class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] page-active hover:text-white cursor-pointer">
                    <p class="leading-[28px] text-sm md:text-base">1</p>
                </div>
                <div
                    class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] hover:text-white cursor-pointer">
                    <p class="leading-[28px] text-sm md:text-base">2</p>
                </div>
                <div
                    class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] hover:text-white cursor-pointer">
                    <p class="leading-[28px] text-sm md:text-base">3</p>
                </div>
                <div
                    class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] hover:text-white cursor-pointer">
                    <p class="leading-[28px] text-sm md:text-base">4</p>
                </div>
                <div
                    class="px-[13.5px] py-[4px] md:py-[5px] hover:bg-[#006FFD] text-[#3A57E8] hover:text-white cursor-pointer">
                    <p class="leading-[28px] text-sm md:text-base">...</p>
                </div>
                <div class="px-2 md:px-4 py-1 cursor-pointer btn-prev hover:bg-[#006FFD] rounded-tr-lg rounded-br-lg">
                    <svg width="29" height="30" viewBox="0 0 29 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.9209 12.6308L13.6126 14.6044L11.9209 16.5781" stroke="#3A57E8" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.9658 12.6308L16.6576 14.6044L14.9658 16.5781" stroke="#3A57E8" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </div>
        <!--  -->
        <p class="uppercase text-[#258AFF] text-[20px] md:text-[30px] font-bold text-center mt-[30px] md:mt-[90px] section"
            id="vs">
            V-Store liên kết
        </p>
        <div class="w-[37px] mx-auto border-b-[#258AFF] border-b-[3px] mb-[60px]"></div>
        <div class="slider mb-[30px] md:pb-[50px] text-center">
        @foreach($vstore as $vsto)
            <div class="flex flex-col gap-4 items-center cursor-pointer">
            <a href="{{route("intro_vstore",['slug'=>$vsto->slug])}}">
                                        <div class="max-w-[120px]">
                                            @if($vsto->avatar =='')
                                                <img src="{{asset('home/img/Logo.png')}}" class="md:w-[100px] md:h-[100px] w-[60px] h-[60px] rounded-full" alt="">
                                            @else
                                                <img src="{{asset('image/users/'. $vsto->avatar)}}" class="md:w-[100px] md:h-[100px] w-[60px] h-[60px] rounded-full" alt="">
                                            @endif
                                        </div>
                                        <span class="text-sm text-sm lg:text-base xl:text-lg text-[#2C2C37] text-center">{{ mb_strimwidth($vsto->name,0,15,'...')}}</span>
                                    </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="h-[63px] pt-[22px] bg-[#1E90FF] mt-[56px]">
        <div
            class="max-w-[90vw] md:max-w-[710px] lg:max-w-[1000px] xl:max-w-[1200px] 2xl:max-w-[1500px] mx-auto flex justify-between">
            <div class="flex items-center gap-4 md:gap-[54px]">
                <div class="w-[16px] h-[13px] md:w-[26px] md:h-[20px] cursor-pointer">
                    <svg viewBox="0 0 26 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M25.4953 2.37575C24.59 2.76628 23.6047 3.04735 22.59 3.15682C23.6435 2.53089 24.4325 1.54202 24.8089 0.375752C23.8202 0.963885 22.7372 1.37629 21.6077 1.59469C21.1357 1.09003 20.5647 0.687999 19.9305 0.413643C19.2963 0.139287 18.6123 -0.00151415 17.9213 1.22793e-05C15.1255 1.22793e-05 12.8769 2.26628 12.8769 5.04735C12.8769 5.43788 12.9243 5.82841 13.0012 6.20415C8.81482 5.98522 5.08109 3.98522 2.59885 0.923089C2.14655 1.69562 1.90954 2.57524 1.91246 3.47042C1.91246 5.2219 2.80299 6.76628 4.16097 7.67456C3.36069 7.64305 2.57915 7.42308 1.87991 7.03255V7.09468C1.87991 9.54734 3.61364 11.5799 5.92429 12.0473C5.49044 12.16 5.04413 12.2177 4.59589 12.2189C4.26748 12.2189 3.95683 12.1864 3.64322 12.142C4.28228 14.142 6.14322 15.5947 8.3592 15.642C6.62547 17 4.45387 17.7988 2.09589 17.7988C1.67281 17.7988 1.28228 17.784 0.876953 17.7367C3.11364 19.1716 5.76748 20 8.62547 20C17.9036 20 22.9805 12.3136 22.9805 5.64202C22.9805 5.42309 22.9805 5.20415 22.9657 4.98522C23.9479 4.26628 24.8089 3.37575 25.4953 2.37575Z"
                            fill="white" />
                    </svg>
                </div>
                <div class="w-[16px] h-[16px] md:w-[21px] md:h-[20px] cursor-pointer">
                    <svg viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.4941 0C4.97212 0 0.495117 4.477 0.495117 9.999C0.495117 14.989 4.15112 19.125 8.93212 19.878V12.89H6.39212V9.999H8.93212V7.796C8.93212 5.288 10.4251 3.905 12.7081 3.905C13.8021 3.905 14.9481 4.1 14.9481 4.1V6.559H13.6841C12.4441 6.559 12.0561 7.331 12.0561 8.122V9.997H14.8271L14.3841 12.888H12.0561V19.876C16.8371 19.127 20.4931 14.99 20.4931 9.999C20.4931 4.477 16.0161 0 10.4941 0Z"
                            fill="white" />
                    </svg>
                </div>
                <div class="w-[16px] h-[16px] md:w-[21px] md:h-[20px] cursor-pointer">
                    <svg viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.5162 0C12.468 0 20.5675 8.07576 20.6097 18.0176V18.0182H20.6112V19.0701H20.5993C20.573 19.3033 20.4686 19.5209 20.3032 19.6874C20.1377 19.8539 19.9208 19.9596 19.6877 19.9875V19.9999H17.8174V19.9978C17.5644 19.9925 17.322 19.8955 17.1352 19.7247C16.9484 19.554 16.83 19.3213 16.802 19.0698H16.7901V18.0179H16.8008C16.7585 10.1756 10.3679 3.80861 2.5159 3.80861C2.50845 3.80861 2.50099 3.80807 2.49354 3.80752C2.48733 3.80707 2.48111 3.80662 2.4749 3.80648V3.82106H1.423V3.80922C1.18971 3.78293 0.972147 3.67858 0.80562 3.5131C0.639093 3.34762 0.533373 3.13072 0.505615 2.8976H0.493164V1.02731H0.49529C0.500584 0.774312 0.597614 0.531853 0.768325 0.345054C0.939036 0.158255 1.1718 0.0398392 1.4233 0.0118429V0H2.47521V0.00212567C2.48139 0.00198836 2.4875 0.00154061 2.49364 0.00109124C2.50108 0.000546809 2.50855 0 2.5162 0ZM2.5162 7.20619C2.50855 7.20619 2.50108 7.20674 2.49364 7.20728L2.49363 7.20728C2.4875 7.20773 2.48138 7.20818 2.47521 7.20832V7.20619H1.4233V7.21804C1.1718 7.24603 0.939036 7.36445 0.768325 7.55125C0.597614 7.73805 0.500584 7.9805 0.49529 8.2335H0.493164V10.1038H0.505615C0.533425 10.3369 0.639162 10.5538 0.805679 10.7192C0.972196 10.8847 1.18973 10.9891 1.423 11.0154V11.0273H2.4749V11.0127C2.48111 11.0128 2.48732 11.0133 2.49353 11.0137C2.50099 11.0143 2.50844 11.0148 2.5159 11.0148C6.39435 11.0148 9.5528 14.149 9.59471 18.0177H9.58469V19.0696H9.59653C9.62453 19.3211 9.74295 19.5539 9.92974 19.7246C10.1165 19.8953 10.359 19.9923 10.612 19.9976V19.9997H12.482V19.9873C12.7151 19.9595 12.932 19.8537 13.0974 19.6872C13.2629 19.5207 13.3673 19.3032 13.3936 19.0699H13.4054V18.018H13.4036C13.362 12.0488 8.49452 7.20619 2.5162 7.20619ZM3.34264 14.5393C2.99241 14.5393 2.64561 14.6083 2.32205 14.7424C1.99849 14.8764 1.70451 15.0729 1.45692 15.3207C1.20932 15.5684 1.01296 15.8624 0.879037 16.186C0.745119 16.5097 0.676273 16.8565 0.676433 17.2067C0.676433 17.5569 0.745412 17.9037 0.879432 18.2273C1.01345 18.5508 1.20989 18.8448 1.45752 19.0925C1.70516 19.3401 1.99915 19.5365 2.3227 19.6705C2.64626 19.8046 2.99304 19.8735 3.34325 19.8735C3.69346 19.8735 4.04024 19.8046 4.36379 19.6705C4.68735 19.5365 4.98133 19.3401 5.22897 19.0925C5.47661 18.8448 5.67304 18.5508 5.80706 18.2273C5.94108 17.9037 6.01006 17.5569 6.01006 17.2067C6.01022 16.8564 5.94134 16.5095 5.80734 16.1858C5.67335 15.8621 5.47687 15.5679 5.22915 15.3202C4.98142 15.0725 4.68731 14.876 4.36361 14.742C4.03991 14.608 3.69298 14.5391 3.34264 14.5393Z"
                            fill="white" />
                    </svg>
                </div>
                <div class="w-[16px] h-[16px] md:w-[21px] md:h-[20px] cursor-pointer">
                    <svg viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.6088 6.66525C8.77258 6.66525 7.27407 8.16376 7.27407 10C7.27407 11.8362 8.77258 13.3348 10.6088 13.3348C12.4451 13.3348 13.9436 11.8362 13.9436 10C13.9436 8.16376 12.4451 6.66525 10.6088 6.66525ZM20.6106 10C20.6106 8.61907 20.6231 7.25064 20.5455 5.87221C20.468 4.27113 20.1027 2.85017 18.9319 1.67938C17.7587 0.506085 16.3402 0.14334 14.7391 0.065788C13.3582 -0.0117644 11.9898 0.000744113 10.6113 0.000744113C9.23039 0.000744113 7.86197 -0.0117644 6.48354 0.065788C4.88246 0.14334 3.4615 0.508587 2.29071 1.67938C1.11741 2.85267 0.754669 4.27113 0.677116 5.87221C0.599564 7.25314 0.612072 8.62157 0.612072 10C0.612072 11.3784 0.599564 12.7494 0.677116 14.1278C0.754669 15.7289 1.11992 17.1498 2.29071 18.3206C3.464 19.4939 4.88246 19.8567 6.48354 19.9342C7.86447 20.0118 9.2329 19.9993 10.6113 19.9993C11.9923 19.9993 13.3607 20.0118 14.7391 19.9342C16.3402 19.8567 17.7612 19.4914 18.9319 18.3206C20.1052 17.1473 20.468 15.7289 20.5455 14.1278C20.6256 12.7494 20.6106 11.3809 20.6106 10ZM10.6088 15.131C7.76941 15.131 5.47786 12.8394 5.47786 10C5.47786 7.16058 7.76941 4.86903 10.6088 4.86903C13.4482 4.86903 15.7398 7.16058 15.7398 10C15.7398 12.8394 13.4482 15.131 10.6088 15.131ZM15.9499 5.8572C15.287 5.8572 14.7516 5.32184 14.7516 4.65889C14.7516 3.99594 15.287 3.46058 15.9499 3.46058C16.6129 3.46058 17.1482 3.99594 17.1482 4.65889C17.1484 4.81631 17.1176 4.97222 17.0574 5.1177C16.9973 5.26317 16.909 5.39535 16.7977 5.50666C16.6864 5.61798 16.5542 5.70624 16.4087 5.76639C16.2633 5.82654 16.1074 5.8574 15.9499 5.8572Z"
                            fill="white" />
                    </svg>
                </div>
            </div>
            <span class="uppercase text-xs text-[#FFF]">Copyright <script>document.write(new Date().getFullYear());</script> © viptam.com</span>
        </div>
    </div>
    <!-- jq -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!--  -->
    <script>
        $(".slider").slick({
            arrows: false,
            focusOnSelect: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed:1500,
            slidesToScroll: 8,
            slidesToShow: 8,
            autoplaySpeed: 3000,
            pauseOnFocus: true,
            dots: true,
            // the magic
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 6,
                    infinite: true
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    dots: true
                }
            }, {
                breakpoint: 490,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: true
                }
            }]
        });
        $(".slider2").slick({
            arrows: false,
            focusOnSelect: true,
            infinite: true,
            autoplay: true,
            autoplaySpeed:3000,
            pauseOnFocus: true,
            slidesToScroll: 5,
            slidesToShow: 5,
            autoplaySpeed: 3000,
            rows: 1,

            dots: true,
            // the magic
            responsive: [{
                breakpoint: 1280,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                }
            },
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,

                }
            }, {
                breakpoint: 376,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }]
        });
        $(".slider3").slick({
            arrows: false,
            focusOnSelect: true,
            infinite: false,
            autoplay: true,
            autoplaySpeed:3000,
            slidesToShow: 6,
            slidesToScroll: 6,
            autoplaySpeed: 3000,
            pauseOnFocus: true,
            dots: false,
            // the magic
            responsive: [{
                breakpoint: 1536,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                }
            },
            {
                breakpoint: 1279,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                }
            },
            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 4,
                }
            },
            {
                breakpoint: 545,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                }
            },
            {
                breakpoint: 444,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 320,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }]
        });
        // menu mobile
        $(".btn-menu").on("click", () => {
            $('.menu-show').addClass("show")
            $('.menu-show').removeClass("menu-hidden")
        })
        $(".btn-close").on("click", () => {
            $('.menu-show').addClass("menu-hidden")
            $('.menu-show').removeClass("show")
        })
        // scroll
        $('a[href*="#"]').on('click', function (e) {
            $('a[href*="#"] p').removeClass("menu-active")
            $(this).children().addClass("menu-active")
            $('.menu-show').addClass("menu-hidden")
            $('.menu-show').removeClass("show")
            $('html,body').animate({
                scrollTop: $($(this).attr('href')).offset().top - 100
            }, 100);
            e.preventDefault();
        });
    </script>

    <!-- <style>
        .slick-dots {
            bottom: -40px;
        }
        .slick-dots li button:before{
            font-size: 8px;
            color:#258AFF;
        }
        .slick-dots li.slick-active button:before{
            opacity: 1;
            color:#258AFF;

        }
        .slick-dots li.slick-active button:before{
            top:-5px;
        }
        .slick-dots li.slick-active button {
            width: 18px;
            height: 8px;
            padding: 4px;
            cursor: pointer;
            background: #258AFF;
            border-radius:4px;
        }
        .slick-dots li button:before{
            top:2px;
        }
    </style>
</head>
<body class="bg-[#F2F9FF]">
<header>
    <div class="max-w-[1320px] lg:flex justify-between items-center mx-auto w-full px-[15px] xl:px-0 hidden">
        <div class="max-w-[118px]">
            <div class="w-full h-[118px]">
                @if($user->avatar =='')
                    <a href="#"><img src="{{asset('home/img/NCC.png')}}" class="w-full object-contain " alt=""></a>
                @else
                    <a href="#"><img src="{{asset('/image/users/'.$user->avatar)}}" class="w-full object-contain" alt=""></a>
                @endif
            </div>
        </div>
        <ul class="nav-menu lg:flex items-center gap-10 ">
                <li class="active"><a href="#" class="text-lg text-[#2C2C37] ">Trang chủ</a></li>
                <li><a href="{{asset('#gioi_thieu')}}" class="text-lg text-[#2C2C37] ">Giới thiệu</a></li>
                <li><a href="{{asset('#sale')}}" class="text-lg text-[#2C2C37] ">Sales</a></li>
                <li><a href="{{asset('#noi_bat')}}" class="text-lg text-[#2C2C37] ">Sản phẩm nổi bật</a></li>
                <li><a href="{{asset('#nha_cung_cap')}}" class="text-lg text-[#2C2C37] ">V-Store</a></li>
            </ul>
    </div>
    <div class="max-w-[1320px] flex justify-between items-center px-[15px] xl:px-0 lg:hidden relative">
        <div class="max-w-[83px]">
            <div class="w-full h-[83px]">
                <a href="#"><img src="{{asset('landingpage/images/HPlogo.png')}}" class="w-full " alt=""></a>
            </div>
        </div>
        <ul class="nav-menu-mb flex flex-col gap-4 right-[15px] top-[60px] bg-[#FFF] absolute min-w-[172px] text-center rounded-[10px] p-[30px]">
                <li class="active"><a href="#" class="text-lg text-[#2C2C37] ">Trang chủ</a></li>
                <li><a href="#" class="text-lg text-[#2C2C37] ">Giới thiệu</a></li>
                <li><a href="#" class="text-lg text-[#2C2C37] ">Sales</a></li>
                <li><a href="#" class="text-lg text-[#2C2C37] ">Sản phẩm nổi bật</a></li>
                <li><a href="#" class="text-lg text-[#2C2C37] ">V-Store</a></li>
        </ul>
        <div class="w-[24px] btn-menu">
                <svg viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.75 6.5C20.75 6.91421 20.4142 7.25 20 7.25L4 7.25C3.58579 7.25 3.25 6.91421 3.25 6.5C3.25 6.08579 3.58579 5.75 4 5.75L20 5.75C20.4142 5.75 20.75 6.08579 20.75 6.5Z" fill="#258AFF"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.75 12.5C20.75 12.9142 20.4142 13.25 20 13.25L4 13.25C3.58579 13.25 3.25 12.9142 3.25 12.5C3.25 12.0858 3.58579 11.75 4 11.75L20 11.75C20.4142 11.75 20.75 12.0858 20.75 12.5Z" fill="#258AFF"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.75 18.5C20.75 18.9142 20.4142 19.25 20 19.25H4C3.58579 19.25 3.25 18.9142 3.25 18.5C3.25 18.0858 3.58579 17.75 4 17.75H20C20.4142 17.75 20.75 18.0858 20.75 18.5Z" fill="#258AFF"/>
        </svg>

        </div>
    </div>
</header>
    <div class="max-w-[1320px] mx-auto w-full flex flex-col gap-5 px-[15px] xl:px-0">
        <div class="md:max-w-[1320px] w-full h-auto md:h-[320px] md:rounded-[20px] relative">
            <img src="{{asset('landingpage/images/bg.png')}}" class="w-full rounded-[20px] object-contain md:object-cover" alt="">
            <div class="box p-4 xl:p-8 absolute w-full hidden md:block center-ab max-w-[640px] lg:max-w-[960px] xl:max-w-[1124px]">
                <div class="flex justfy-center md:justify-between items-center w-full flex-wrap lg:flex-nowrap gap-6">
                    <div class="flex flex-col justify-center md:flex-row md:justify-start items-center gap-2 lg:gap-6 w-full">
                    <svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" width="60" height="60" rx="30" fill="#258AFF"/>
                    <g clip-path="url(#clip0_102_2404)">
                    <path d="M15.5 20.6113C15.6455 20.0596 15.8753 19.5578 16.368 19.2107C17.0526 18.7279 17.7971 18.6328 18.5648 18.961C19.3325 19.2891 19.7738 19.8848 19.8496 20.7064C19.8814 21.0465 19.8594 21.3913 19.8802 21.7337C19.8973 22.0191 20.0159 22.075 20.2359 21.8919C20.4254 21.7337 20.588 21.5423 20.7445 21.3521C22.3961 19.3391 24.4523 17.8599 26.9242 16.9396C29.1565 16.1085 31.4682 15.7946 33.8325 16.1371C39.4413 16.9503 43.4315 19.9098 45.4597 25.0463C47.4584 30.1091 46.5391 34.858 43.0073 39.0564C40.9095 41.5498 38.1626 43.0919 34.9108 43.7245C33.9792 43.9052 33.0159 43.973 32.0636 43.9991C30.8472 44.0324 29.8655 43.2298 29.6002 42.0967C29.3484 41.023 29.9059 39.8816 30.9914 39.406C31.39 39.2312 31.8631 39.1646 32.3068 39.1468C35.0966 39.0326 37.4169 37.959 39.2127 35.8948C41.0183 33.8188 41.7176 31.3968 41.3264 28.699C41 26.4446 39.9169 24.5778 38.1528 23.0904C36.7555 21.9121 35.1345 21.1725 33.2971 20.9728C29.5122 20.5614 26.5073 21.9038 24.2738 24.8929C24.1577 25.0487 24.0648 25.2306 24.0049 25.4137C23.8716 25.8239 24.0587 26.0475 24.4976 26.0724C24.9572 26.0974 25.4328 26.0831 25.8704 26.1973C26.8802 26.4636 27.4597 27.4148 27.3447 28.5016C27.2494 29.4064 26.3998 30.2732 25.4291 30.2875C22.7714 30.3255 20.1125 30.322 17.4535 30.2899C16.5685 30.2792 15.835 29.6038 15.5795 28.737C15.555 28.6538 15.5269 28.5705 15.5 28.4885C15.5 25.862 15.5 23.2366 15.5 20.6113Z" fill="white"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_102_2404">
                    <rect width="31" height="28" fill="white" transform="translate(15.5 16)"/>
                    </clipPath>
                    </defs>
                    </svg>

                        <div class="flex flex-col justify-start items-center md:items-start text-center md:text-left ">
                            <span class="font-semibold text-lg text-text">7 ngày miễn phí trả hàng </span>
                            <span class="text-tGrey text-sm">Trả hàng miễn phí trong 7 ngày </span>
                        </div>

                    </div>
                    <div class="flex flex-col justify-center md:flex-row md:justify-start items-center gap-2 lg:gap-6 w-full">
                    <svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.5" width="60" height="60" rx="30" fill="#258AFF"/>
                    <g clip-path="url(#clip0_102_2405)">
                    <path d="M39.7083 20.0834H37.5833V19.3751C37.5833 18.06 37.0609 16.7989 36.1311 15.869C35.2012 14.9391 33.94 14.4167 32.625 14.4167H18.4583C17.1433 14.4167 15.8821 14.9391 14.9523 15.869C14.0224 16.7989 13.5 18.06 13.5 19.3751V41.3334H17.8322C17.7803 41.566 17.7527 41.8034 17.75 42.0417C17.75 42.9811 18.1231 43.8819 18.7873 44.5461C19.4515 45.2103 20.3524 45.5834 21.2917 45.5834C22.231 45.5834 23.1318 45.2103 23.796 44.5461C24.4602 43.8819 24.8333 42.9811 24.8333 42.0417C24.8306 41.8034 24.8031 41.566 24.7512 41.3334H36.2488C36.1969 41.566 36.1694 41.8034 36.1667 42.0417C36.1667 42.9811 36.5398 43.8819 37.204 44.5461C37.8682 45.2103 38.769 45.5834 39.7083 45.5834C40.6476 45.5834 41.5485 45.2103 42.2127 44.5461C42.8769 43.8819 43.25 42.9811 43.25 42.0417C43.2473 41.8034 43.2197 41.566 43.1678 41.3334H47.5V27.8751C47.4974 25.8094 46.6756 23.8291 45.215 22.3684C43.7543 20.9078 41.774 20.086 39.7083 20.0834ZM33.3333 37.0834H17.75V19.3751C17.75 19.1872 17.8246 19.0071 17.9575 18.8742C18.0903 18.7414 18.2705 18.6667 18.4583 18.6667H32.625C32.8129 18.6667 32.993 18.7414 33.1259 18.8742C33.2587 19.0071 33.3333 19.1872 33.3333 19.3751V37.0834ZM39.7083 24.3334C40.6476 24.3334 41.5485 24.7066 42.2127 25.3707C42.8769 26.0349 43.25 26.9358 43.25 27.8751V31.4167H37.5833V24.3334H39.7083Z" fill="white"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_102_2405">
                    <rect width="34" height="34" fill="white" transform="translate(13.5 13)"/>
                    </clipPath>
                    </defs>
                    </svg>
                        <div class="flex flex-col justify-start items-center md:items-start text-center md:text-left">
                            <span class="font-semibold text-lg text-text">Hàng chính hãng 100% </span>
                            <span class="text-tGrey text-sm">Đảm bảo hàng chính hãng hoặc hoàn tiền gấp đôi</span>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center md:flex-row md:justify-start items-center gap-2 lg:gap-6 w-full">
                        <svg width="52" height="56" viewBox="0 0 52 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.512801 17.6841C0.512801 15.6148 0.479374 13.544 0.520759 11.4764C0.592387 7.89338 2.93063 4.95188 6.41173 4.15443C12.3584 2.79191 18.321 1.49784 24.274 0.16557C25.8164 -0.179834 27.311 0.0668828 28.8168 0.407512C34.321 1.65224 39.8363 2.85081 45.3373 4.10986C49.1049 4.97257 51.4193 7.89179 51.4368 11.7469C51.4527 15.4875 51.5291 19.2328 51.4081 22.9702C51.0643 33.6459 46.7858 42.4879 38.7364 49.4931C35.8634 51.9937 32.6115 53.8989 29.0906 55.3506C27.0373 56.1974 25.0062 56.2324 22.9513 55.357C12.0194 50.706 4.92346 42.6678 1.68908 31.244C0.778618 28.0287 0.455499 24.7259 0.504842 21.3864C0.522351 20.1528 0.508025 18.9192 0.508025 17.6857C0.509617 17.6841 0.511209 17.6841 0.512801 17.6841ZM24.0369 28.9503C23.8634 28.7847 23.7201 28.6495 23.5801 28.5126C22.3863 27.3426 21.2132 26.1504 19.9939 25.0092C18.5566 23.6642 16.3138 24.2579 15.7822 26.1138C15.4877 27.1437 15.7933 28.0255 16.5574 28.772C18.3512 30.5213 20.1372 32.2802 21.9263 34.0358C23.3636 35.4461 24.6895 35.4509 26.1236 34.0422C29.7002 30.5293 33.2752 27.0148 36.8502 23.5002C37.2052 23.1516 37.5331 22.7712 37.9183 22.4608C39.05 21.5488 39.1933 19.9905 38.2159 18.9001C37.2195 17.7891 35.5769 17.7509 34.4499 18.8428C31.1646 22.0263 27.8888 25.2209 24.6083 28.4107C24.4253 28.589 24.2374 28.7625 24.0369 28.9503Z" fill="#258AFF"/>
                            </svg>

                            <div class="flex flex-col justify-start items-center md:items-start text-center md:text-left">
                                <span class="font-semibold text-lg text-text">Miễn phí vận chuyển </span>
                                <span class="text-tGrey text-sm">Giao hàng miễn phí toàn quốc </span>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-[30px] md:mt-[100px] lg:my-16">
            <h2 id="gioi_thieu" class="text-[#258AFF] text-xl md:text-4xl font-semibold">Giới thiệu</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-[50px] lg:gap-[105px] px-[20px] py-[40px] bg-[#FFF] rounded-[20px]">
                <div class="flex items-start gap-6">
                    <div class="max-w-[222px]">
                        <img src="{{asset('landingpage/images/HPlogo.png')}}" class="w-full object-contain" alt="">
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-[#696984] text-xl"><strong class="font-semibold">ID:</strong> {{$user->account_code}}</span>
                        <span class="text-[#696984] text-xl"><strong class="font-semibold">Liên hệ:</strong> {{$user->phone_number}}</span>

                        <span class="text-[#696984] text-xl"><strong class="font-semibold">Số sản phẩm:</strong>  {{$count_products}}</span>

                        <span class="text-[#696984] text-xl"><strong class="font-semibold">Danh mục: </strong>@foreach($arrCategory as $val) {{$val->name}}, @endforeach...</span>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <span class="font-semibold text-xl text-[#696984]"> Giới thiệu</span>
                    <span class="line-clamp-3 text-[#696984] text-xl">{{$user->description != null ? $user->description : 'Chưa có thông tin mô tả'}} </span>

                </div>
            </div>
        </div>
        <div class="flex flex-col gap-[30px] ">
            <h2 class="text-[#258AFF] text-xl lg:text-4xl font-semibold uppercase">Danh mục</h2>
            <div class="">
                <section class="">
                    <ul class="slider-cate tab-cate    gap-3">
                        @foreach($arrCategory as $cate)
                            <li>
                                <a href="#" class="w-full h-[210px] p-[30px] bg-[#FFF] rounded-[20px] flex flex-col items-center gap-3 px-[10px] ">
                                    <div class="max-w-[120px]">
                                        @if($cate->img !=null)
                                            <img src="{{asset($cate->img)}}" class="w-full object-contain" alt="">
                                        @else
                                            <img src="{{asset('landingpage/images/wm.png')}}" class="w-full object-contain" alt="">
{{--                                            http://vstore.ngo/landingpage/images/wm.png--}}
                                        @endif

                                    </div>
                                    <span class="text-[#2C2C37] text-center">{{$cate->name}}</span>
                                </a>
                            </li>
                        @endforeach
{{--                        <li>--}}
{{--                            <a href="#" class="w-full h-full p-[30px] bg-[#FFF] rounded-[20px] flex flex-col items-center gap-3 px-[10px] ">--}}
{{--                                <div class="max-w-[120px]">--}}
{{--                                    <img src="{{asset('landingpage/images/wm.png')}}" class="w-full object-contain" alt="">--}}
{{--                                </div>--}}
{{--                                <span class="text-[#2C2C37] text-center">Thời trang nữ</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}



                    </ul>
                </section>

            </div>
            <div id="sale" class=" sales grid grid-cols-2 xl:grid-cols-4 gap-2 lg:gap-6 p-[15px] md:pt-[250px] xl:pt-[200px] py-[60px] md:px-[48px] md:my-16">
                @foreach($product_super as $ps)
                    <div class="product-item  bg-[#FFF] rounded-[20px]">
                        <div class="w-full h-[114px] md:h-[242px] rounded-tl-[20px] rounded-tr-[20px]">
                            <img src="{{asset(json_decode($ps->images)[0])}}" class="w-full rounded-tl-[20px] rounded-tr-[20px] " alt="">
                        </div>
                        <div class=" p-[10px] md:p-[20px]">
                            <div class="flex flex-col">
                                <h2 class="text-[#2C2C37] text-base md:text-2xl font-bold">{{$ps->name}}</h2>
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                </fieldset>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center gap-1 md:gap-2 flex-wrap">
                                    <span class="text-xl md:text-2xl font-semibold text-[#FF3750]">đ {{number_format($ps->gia_khuyen_mai)}}</span>
                                    <span class="text-xs md:text-lg text-[#CBCBD5] line-through">đ {{number_format($ps->price)}}</span>
                                </div>
                                <span class="text-[#696984] text-xs md:text-lg">{{$ps->amount_product_sold}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="flex flex-col gap-[30px]">
            <h2 id="noi_bat" class="text-[#258AFF] text-xl lg:text-4xl font-semibold uppercase">Sản phẩm nổi bật</h2>
            <div class=" grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 xl:gap-6">
                @foreach($products as $pro)
{{--                    {{ json_decode($pro->images)[0]}}--}}
                    <div class="product-item  bg-[#FFF] rounded-[20px]">
                        <div class="w-full h-[114px] md:h-[242px] rounded-tl-[20px] rounded-tr-[20px]">

                            <img src="{{asset(json_decode($pro->images)[0])}}" class="w-full rounded-tl-[20px] rounded-tr-[20px] " alt="">

                        </div>
                        <div class=" p-[10px] md:p-[20px]">
                            <div class="flex flex-col">
                                <h2 class="text-[#2C2C37] text-base md:text-2xl font-bold">{{\Illuminate\Support\Str::limit($pro->name,20)}}</h2>
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                </fieldset>
                            </div>
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center gap-1 md:gap-2 flex-wrap">
                                    @if($pro->price_discount)
                                        <span class="text-xl md:text-2xl font-semibold text-[#FF3750]">đ {{ number_format($pro->price_discount) }}</span>
                                        <span class="text-xs md:text-lg text-[#CBCBD5] line-through">đ {{number_format($pro->price)}}</span>
                                    @else
                                        <span class="text-xl md:text-2xl font-semibold text-[#FF3750]">đ {{number_format( $pro->price) }}</span>
                                    @endif

                                </div>
                                <span class="text-[#696984] text-xs md:text-lg">Đã bán {{$pro->amount_product_sold}}</span>
                            </div>

                        </div>
                    </div>
                @endforeach


{{--                <div class="product-item  bg-[#FFF] rounded-[20px]">--}}
{{--                    <div class="w-full h-[114px] md:h-[242px] rounded-tl-[20px] rounded-tr-[20px]">--}}
{{--                        <img src="{{asset('landingpage/images/bn2.jpg')}}" class="w-full rounded-tl-[20px] rounded-tr-[20px] " alt="">--}}
{{--                    </div>--}}
{{--                    <div class=" p-[10px] md:p-[20px]">--}}
{{--                        <div class="flex flex-col">--}}
{{--                            <h2 class="text-[#2C2C37] text-base md:text-2xl font-bold">Giày học sinh</h2>--}}
{{--                            <fieldset class="rating">--}}
{{--                                <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>--}}
{{--                                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>--}}
{{--                                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>--}}
{{--                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>--}}
{{--                                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>--}}
{{--                            </fieldset>--}}
{{--                        </div>--}}
{{--                        <div class="flex flex-col gap-3">--}}
{{--                            <div class="flex items-center gap-1 md:gap-2 flex-wrap">--}}
{{--                                <span class="text-xl md:text-2xl font-semibold text-[#FF3750]">đ 20.000</span>--}}
{{--                                <span class="text-xs md:text-lg text-[#CBCBD5] line-through">đ 20.000</span>--}}
{{--                            </div>--}}
{{--                           <span class="text-[#696984] text-xs md:text-lg">Đã bán 426</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


            </div>
{{--            <ul class="pagination flex items-center justify-end">--}}
{{--                    <li><div class="cursor-pointer"><svg width="61" height="38" viewBox="0 0 61 38" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--<path d="M59.9993 0.5H8.86768C4.72554 0.5 1.36768 3.85786 1.36768 8V30C1.36768 34.1421 4.72555 37.5 8.86768 37.5H59.9993V0.5Z" fill="white"/>--}}
{{--<path d="M33.4468 16.6308L31.755 18.6044L33.4468 20.5781" stroke="#3A57E8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--<path d="M30.4016 16.6308L28.7099 18.6044L30.4016 20.5781" stroke="#3A57E8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--<path d="M59.9993 0.5H8.86768C4.72554 0.5 1.36768 3.85786 1.36768 8V30C1.36768 34.1421 4.72555 37.5 8.86768 37.5H59.9993V0.5Z" stroke="#DEE2E6"/>--}}
{{--</svg>--}}
{{--</div></li>--}}
{{--<li class="active"><a href="#">1</a></li>--}}
{{--<li><a href="#">2</a></li>--}}
{{--<li><a href="#">3</a></li>--}}
{{--<li><a href="#">4</a></li>--}}
{{--<li><a href="#">5</a></li>--}}
{{--<li><div  class="cursor-pointer"><svg width="61" height="38" viewBox="0 0 61 38" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--<path d="M1.36841 0.5H52.5C56.6421 0.5 60 3.85786 60 8V30C60 34.1421 56.6421 37.5 52.5 37.5H1.36841V0.5Z" fill="white"/>--}}
{{--<path d="M27.9209 16.6308L29.6126 18.6044L27.9209 20.5781" stroke="#3A57E8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--<path d="M30.9661 16.6308L32.6578 18.6044L30.9661 20.5781" stroke="#3A57E8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--<path d="M1.36841 0.5H52.5C56.6421 0.5 60 3.85786 60 8V30C60 34.1421 56.6421 37.5 52.5 37.5H1.36841V0.5Z" stroke="#DEE2E6"/>--}}
{{--</svg>--}}

{{--</div></li>--}}
{{--                </ul>--}}
        </div>

            <div class="flex flex-col gap-[30px] my-16">
            <h2 id="nha_cung_cap" class="text-[#258AFF] text-xl lg:text-4xl font-semibold uppercase">V-Store liên kết</h2>
                <div class="">
                    <section>
                        <ul class="slider-cate tab-ncc  gap-3">
                            @foreach($vstore as $vsto)
                                <li>
                                    <a href="{{route("intro_vstore",['slug'=>$vsto->slug])}}" class="w-full h-full p-[30px] bg-[#FFF] rounded-[20px] flex flex-col items-center gap-3 px-[10px] ">
                                        <div class="max-w-[120px]">

{{--                                            <img src="{{asset('image/users/'. $vsto->avatar)}}" class="w-full object-contain" alt="">--}}
                                            @if($vsto->avatar =='')
                                                <img src="{{asset('home/img/Logo.png')}}" class="w-full object-contain" alt="">
                                            @else
                                                <img src="{{asset('image/users/'. $vsto->avatar)}}" class="w-full object-contain" alt="">
                                            @endif
                                        </div>
                                        <span class="text-[#2C2C37] text-center">{{ mb_strimwidth($vsto->name,0,15,'...')}}</span>
                                    </a>
                                </li>
                            @endforeach


                        </ul>
                    </section>


                </div>

            </div>

        </div>
    </div>
    <footer>
        <div class="bg-[#258AFF] py-3 ">
            <div class="max-w-[1320px] flex justify-between items-center flex-col gap-4 md:flex-row mx-auto px-[15px] xl:px-0">
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
        </div>
    </footer> -->
<!-- <script>
    var slide = 6;
    if (window.matchMedia('screen and (max-width: 768px)').matches) {
        slide=2;
    }
    $(document).ready(function(){
        $('.btn-menu').on('click',function(){
            $('.nav-menu-mb').toggleClass('show-menu')
        })
    })
    $('.slider-cate').slick({
  dots: true,
  infinite: false,
  arrows:false,
//   autoplay: true,
//   autoplaySpeed: 2000,
  speed: 300,
  slidesToShow: slide,
  slidesToScroll: slide,
//   responsive: [
//     {
//       breakpoint: 1024,
//       settings: {
//         slidesToShow: 3,
//         slidesToScroll: 3,
//         infinite: true,
//         dots: true
//       }
//     },
//     {
//       breakpoint: 600,
//       settings: {
//         slidesToShow: 2,
//         slidesToScroll: 2
//       }
//     },
//     {
//       breakpoint: 480,
//       settings: {
//         slidesToShow: 1,
//         slidesToScroll: 1
//       }
//     }
//     // You can unslick at a given breakpoint now by adding:
//     // settings: "unslick"
//     // instead of a settings object
 // ]
});
    if (window.matchMedia('screen and (max-width: 768px)').matches) {
        console.log(1);
    }
</script> -->

</body>
</html>
