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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <meta property="og:title" content="V-Store"/>
    <meta property="og:title"
          content="V-Store | Ecommerce. Cổng thương mại điện tử dành cho nhà phân phối và sản xuất"/>
    <meta property="og:description"
          content="Hãy đồng hành cùng 20.000+ người kinh doanh và nhà phân phối uy tín tại việt nam."/>
    <meta property="og:description" content=""/>
    <meta property="og:url" content="{{asset('')}}"/>
    <meta property="og:image" content="{{asset('home/img/vstore11.png')}}"/>
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

        .slider3 .slick-track {
            width: 100% !important;
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

        .page-active a {
            color: white;
        }
    </style>
</head>
<body class="bg-[#F1F8FF] section" id="home">
<div class="h-[68px]"></div>
<div class="fixed top-0 left-0 w-full bg-[#F1F8FF] z-[20] shadow-md">
    <div
        class=" flex justify-between gap-2 items-center py-5 mx-auto xl:px-0 px-5 md:max-w-[710px] lg:max-w-[1000px] xl:max-w-[1200px] 2xl:max-w-[1440px]">
        <div class="max-w-[138px]">
            <div class="w-full h-[50px]">
                <a href="{{route('landingpagevstore')}}"><img src="{{asset('home/img/Logo.png')}}"
                                                              class="w-full object-contain "
                                                              style="height: 50px" alt=""></a>
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
                    Nhà cung cấp
                </p>
            </a>
        </div>
        <div class="md:hidden block cursor-pointer btn-menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M20.75 6C20.75 6.41421 20.4142 6.75 20 6.75L4 6.75C3.58579 6.75 3.25 6.41421 3.25 6C3.25 5.58579 3.58579 5.25 4 5.25L20 5.25C20.4142 5.25 20.75 5.58579 20.75 6Z"
                      fill="#258AFF"/>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M20.75 12C20.75 12.4142 20.4142 12.75 20 12.75L4 12.75C3.58579 12.75 3.25 12.4142 3.25 12C3.25 11.5858 3.58579 11.25 4 11.25L20 11.25C20.4142 11.25 20.75 11.5858 20.75 12Z"
                      fill="#258AFF"/>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M20.75 18C20.75 18.4142 20.4142 18.75 20 18.75H4C3.58579 18.75 3.25 18.4142 3.25 18C3.25 17.5858 3.58579 17.25 4 17.25H20C20.4142 17.25 20.75 17.5858 20.75 18Z"
                      fill="#258AFF"/>
            </svg>
        </div>
        <div class="block md:hidden menu-show p-5 bg-white w-full fixed h-full top-[66px] -right-[1000px] z-[99]">
            <div class="btn-close float-right">
                <svg class="cursor-pointer" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.9998 13.4L7.0998 18.3C6.91647 18.4834 6.68314 18.575 6.3998 18.575C6.11647 18.575 5.88314 18.4834 5.6998 18.3C5.51647 18.1167 5.4248 17.8834 5.4248 17.6C5.4248 17.3167 5.51647 17.0834 5.6998 16.9L10.5998 12L5.6998 7.10005C5.51647 6.91672 5.4248 6.68338 5.4248 6.40005C5.4248 6.11672 5.51647 5.88338 5.6998 5.70005C5.88314 5.51672 6.11647 5.42505 6.3998 5.42505C6.68314 5.42505 6.91647 5.51672 7.0998 5.70005L11.9998 10.6L16.8998 5.70005C17.0831 5.51672 17.3165 5.42505 17.5998 5.42505C17.8831 5.42505 18.1165 5.51672 18.2998 5.70005C18.4831 5.88338 18.5748 6.11672 18.5748 6.40005C18.5748 6.68338 18.4831 6.91672 18.2998 7.10005L13.3998 12L18.2998 16.9C18.4831 17.0834 18.5748 17.3167 18.5748 17.6C18.5748 17.8834 18.4831 18.1167 18.2998 18.3C18.1165 18.4834 17.8831 18.575 17.5998 18.575C17.3165 18.575 17.0831 18.4834 16.8998 18.3L11.9998 13.4Z"
                        fill="#2C2C37"/>
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
        <img class="object-cover block lg:hidden md:h-[360px] h-[260px] w-full"
             src="{{asset('landingpage/images/bg.png')}}" alt="">
        <img class="object-cover hidden lg:block lg:h-[450px] w-full" src="{{asset('landingpage/images/bg1.png')}}"
             alt="">
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
                            class="text-[#696984] font-normal">
                            @foreach($arrCategory as $index => $val)
                                @if($index < 5)
                                    {{$val->name}}
                                    @if($index < count($arrCategory) - 1)
                                        ,
                                    @endif
                                @endif
                            @endforeach
                            @if(count($arrCategory) > 5)
                                ...</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="md:border-l md:border-[#258AFF80] md:pl-6 flex flex-col gap-5">
                <span class="font-semibold text-xl"> Giới thiệu</span>
                <p class="text-[#696984] text-sm md:text-base xl:text-lg">{{$user->description}}</p>
                <div class="flex gap-4 items-center slider3">
                    @if(count($fiveImage) > 0)
                        @foreach($fiveImage as $image)
                            <img
                                class="mx-2 w-[82.5px] h-[82.5px] md:min-w-[102px] md:h-[102px] object-cover !shadow-lg border border-[#1e90ff80]"
                                src="{{asset(json_decode($image->images)[0])}}" alt="">
                        @endforeach
                    @endif
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
                    class="bg-white md:w-[100px] md:h-[100px] w-[60px] h-[60px] flex items-center justify-center rounded-full shadow-md">
                    @if($cate->img !=null)
                        <img src="{{asset($cate->img)}}" class="md:w-[50px] md:h-[50px] w-[40px] h-[40px]" alt="">
                    @else
                        <img src="{{asset('landingpage/images/wm.png')}}"
                             class="md:w-[50px] md:h-[50px] w-[40px] h-[40px]" alt="">

                    @endif
                </div>
                <p class="text-sm text-sm lg:text-base xl:text-lg text-[#2C2C37] text-center">{{$cate->name}}</p>
            </div>
        @endforeach

    </div>
    <!--  -->
    <div class="mt-[68px] mb-[60px] section" id="bs">
        <img class="w-full object-contain rounded-tl-2xl rounded-tr-2xl" src="{{asset('landingpage/images/bg2.png')}}"
             alt="">
        <div
            class="md:min-h-[434px] rounded-bl-2xl rounded-br-2xl pt-[30px] md:pt-[60px] px-[10px] md:pb-[60px] pb-[20px]"
            style="background: linear-gradient(180deg, #258AFF 0%, #99D7FF 100%);">
            <!-- slider2 -->
            <div class="slider2">
                @foreach($big_sale as $pro)
                    <div class="w-[256px] flex flex-col relative cursor-pointer">
                        <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                            <p class="text-white text-sm md:text-[17px] font-bold">{{$pro->discount}}%</p>
                            <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                        </div>
                        <a href="{{config('domain.big_store').'products/'.$pro->id}}" target="_blank">
                            <img class="h-[146px] w-full object-cover rounded-tl-lg rounded-tr-lg"
                                 src="{{asset(json_decode($pro->images)[0])}}" alt="">
                        </a>
                        <div
                            class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                            <a href="{{config('domain.big_store').'products/'.$pro->id}}" target="_blank">
                                <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]"
                                   title="{{$pro->name}}">
                                    {{\Illuminate\Support\Str::limit($pro->name,50,'...')}}</p>
                            </a>
                            <div class="flex gap-1 items-center">
                                @for($i = 1; $i <= 5;$i++)
                                    @if($pro->vote > 1)
                                        <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                                    @elseif($pro->vote > 0 && $pro->vote < 1)
                                        <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                                    @else
                                        <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                                    @endif
                                    @php $pro->vote =  $pro->vote > 0 ? $pro->vote - 1 : $pro->vote @endphp
                                @endfor
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">
                                    {{number_format($pro->order_price,0,'.','.')}}đ
                                </p>
                                <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                    {{number_format($pro->price,0,'.','.')}}đđ</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <p class="uppercase text-[#258AFF] text-[20px] md:text-[30px] font-bold text-center mt-[30px] md:mt-[60px] section"
       id="sp">SẢN
        PHẨM NỔI BẬT
    </p>
    <div class="w-[37px] mx-auto border-b-[#258AFF] border-b-[3px] mb-[60px]"></div>
    <div
        class="grid grid-cols-2 gap-4 lg:gap-6 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 place-items-center grid-shop">
        @foreach($hot_products as $product)
            <div class="w-[220px] flex flex-col relative cursor-pointer shadow-md">
                @if($product->discount_sale > 0)
                    <div class="text-center gg w-[51px] h-[52px] absolute left-[15px] top-0">
                        <p class="text-white text-sm md:text-[17px] font-bold">{{$product->discount_sale}}%</p>
                        <p class="text-[9px] md:text-xs text-[#FFFA00] font-medium">GIẢM</p>
                    </div>
                @endif
                <a href="{{config('domain.big_store').'products/'.$product->id}}" target="_blank">
                    <img class="h-[146px] w-full object-cover rounded-tl-lg rounded-tr-lg border-b border-[#f0f8ff]"
                         src="{{asset(json_decode($product->images)[0])}}" alt="">
                </a>
                <div class="pt-2 pb-4 px-4 flex flex-col gap-2.5 justify-center bg-white rounded-bl-lg rounded-br-lg">
                    <a href="{{config('domain.big_store').'products/'.$product->id}}" target="_blank">
                        <p class="text-[#2C2C37] text-sm md:text-lg leading-[22px] line-clamp-2 min-h-[56px]"
                           title="{{$product->name}}">
                            {{\Illuminate\Support\Str::limit($product->name,50,'...')}}</p>
                    </a>
                    <div class="flex gap-1 items-center">
                        @for($i = 1; $i <= 5;$i++)
                            @if($product->vote > 1)
                                <img src="{{asset('landingpage/images/star_full.png')}}" alt="">
                            @elseif($product->vote > 0 && $product->vote < 1)
                                <img src="{{asset('landingpage/images/star_half.png')}}" alt="">
                            @else
                                <img src="{{asset('landingpage/images/star_white.png')}}" alt="">
                            @endif
                            @php $product->vote =  $product->vote > 0 ? $product->vote - 1 : $product->vote @endphp
                        @endfor
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        @if($product->discount_sale > 0)
                            <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">{{number_format($product->price - ($product->price * $product->discount_sale / 100),0,'.','.')}}
                                đ</p>
                            <p class="text-[#696984] text-xs md:text-sm leading-[38px] line-through truncate">
                                {{number_format($product->price,0,'.','.')}}đ</p>
                        @else
                            <p class="text-[#FF3750] text-sm md:text-lg font-semibold leading-[22px]">{{number_format($product->price,0,'.','.')}}
                                đ</p>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$hot_products->withQueryString()->links('layouts.custom.pagi_landing')}}

    <!--  -->
    <p class="uppercase text-[#258AFF] text-[20px] md:text-[30px] font-bold text-center mt-[30px] md:mt-[90px] section"
       id="vs">
        Nhà cung cấp liên kết
    </p>
    <div class="w-[37px] mx-auto border-b-[#258AFF] border-b-[3px] mb-[60px]"></div>
    <div class="slider mb-[30px] md:pb-[50px] text-center">
        @foreach($vstore as $vsto)
            <div class="flex flex-col gap-4 items-center cursor-pointer">
                <a href="{{route("intro",['slug'=>$vsto->slug])}}" target="_blank">
                    <div class="max-w-[120px]" style="margin: auto">
                        @if($vsto->avatar =='')
                            <img src="{{asset('home/img/ncc-vuong.png')}}"
                                 class="md:w-[100px] md:h-[100px] w-[60px] h-[60px] rounded-full shadow-md" alt=""
                                 style="object-fit: contain;margin: auto">
                        @else
                            <img src="{{asset('image/users/'. $vsto->avatar)}}"
                                 class="md:w-[100px] md:h-[100px] w-[60px] h-[60px] rounded-full shadow-md" alt=""
                                 style="object-fit: contain;margin: auto">
                        @endif
                    </div>
                    <span
                        class="text-sm text-sm lg:text-base xl:text-lg text-[#2C2C37] text-center">{{ mb_strimwidth($vsto->name,0,30,'...')}}</span>
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
                        fill="white"/>
                </svg>
            </div>
            <div class="w-[16px] h-[16px] md:w-[21px] md:h-[20px] cursor-pointer">
                <svg viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.4941 0C4.97212 0 0.495117 4.477 0.495117 9.999C0.495117 14.989 4.15112 19.125 8.93212 19.878V12.89H6.39212V9.999H8.93212V7.796C8.93212 5.288 10.4251 3.905 12.7081 3.905C13.8021 3.905 14.9481 4.1 14.9481 4.1V6.559H13.6841C12.4441 6.559 12.0561 7.331 12.0561 8.122V9.997H14.8271L14.3841 12.888H12.0561V19.876C16.8371 19.127 20.4931 14.99 20.4931 9.999C20.4931 4.477 16.0161 0 10.4941 0Z"
                        fill="white"/>
                </svg>
            </div>
            <div class="w-[16px] h-[16px] md:w-[21px] md:h-[20px] cursor-pointer">
                <svg viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M2.5162 0C12.468 0 20.5675 8.07576 20.6097 18.0176V18.0182H20.6112V19.0701H20.5993C20.573 19.3033 20.4686 19.5209 20.3032 19.6874C20.1377 19.8539 19.9208 19.9596 19.6877 19.9875V19.9999H17.8174V19.9978C17.5644 19.9925 17.322 19.8955 17.1352 19.7247C16.9484 19.554 16.83 19.3213 16.802 19.0698H16.7901V18.0179H16.8008C16.7585 10.1756 10.3679 3.80861 2.5159 3.80861C2.50845 3.80861 2.50099 3.80807 2.49354 3.80752C2.48733 3.80707 2.48111 3.80662 2.4749 3.80648V3.82106H1.423V3.80922C1.18971 3.78293 0.972147 3.67858 0.80562 3.5131C0.639093 3.34762 0.533373 3.13072 0.505615 2.8976H0.493164V1.02731H0.49529C0.500584 0.774312 0.597614 0.531853 0.768325 0.345054C0.939036 0.158255 1.1718 0.0398392 1.4233 0.0118429V0H2.47521V0.00212567C2.48139 0.00198836 2.4875 0.00154061 2.49364 0.00109124C2.50108 0.000546809 2.50855 0 2.5162 0ZM2.5162 7.20619C2.50855 7.20619 2.50108 7.20674 2.49364 7.20728L2.49363 7.20728C2.4875 7.20773 2.48138 7.20818 2.47521 7.20832V7.20619H1.4233V7.21804C1.1718 7.24603 0.939036 7.36445 0.768325 7.55125C0.597614 7.73805 0.500584 7.9805 0.49529 8.2335H0.493164V10.1038H0.505615C0.533425 10.3369 0.639162 10.5538 0.805679 10.7192C0.972196 10.8847 1.18973 10.9891 1.423 11.0154V11.0273H2.4749V11.0127C2.48111 11.0128 2.48732 11.0133 2.49353 11.0137C2.50099 11.0143 2.50844 11.0148 2.5159 11.0148C6.39435 11.0148 9.5528 14.149 9.59471 18.0177H9.58469V19.0696H9.59653C9.62453 19.3211 9.74295 19.5539 9.92974 19.7246C10.1165 19.8953 10.359 19.9923 10.612 19.9976V19.9997H12.482V19.9873C12.7151 19.9595 12.932 19.8537 13.0974 19.6872C13.2629 19.5207 13.3673 19.3032 13.3936 19.0699H13.4054V18.018H13.4036C13.362 12.0488 8.49452 7.20619 2.5162 7.20619ZM3.34264 14.5393C2.99241 14.5393 2.64561 14.6083 2.32205 14.7424C1.99849 14.8764 1.70451 15.0729 1.45692 15.3207C1.20932 15.5684 1.01296 15.8624 0.879037 16.186C0.745119 16.5097 0.676273 16.8565 0.676433 17.2067C0.676433 17.5569 0.745412 17.9037 0.879432 18.2273C1.01345 18.5508 1.20989 18.8448 1.45752 19.0925C1.70516 19.3401 1.99915 19.5365 2.3227 19.6705C2.64626 19.8046 2.99304 19.8735 3.34325 19.8735C3.69346 19.8735 4.04024 19.8046 4.36379 19.6705C4.68735 19.5365 4.98133 19.3401 5.22897 19.0925C5.47661 18.8448 5.67304 18.5508 5.80706 18.2273C5.94108 17.9037 6.01006 17.5569 6.01006 17.2067C6.01022 16.8564 5.94134 16.5095 5.80734 16.1858C5.67335 15.8621 5.47687 15.5679 5.22915 15.3202C4.98142 15.0725 4.68731 14.876 4.36361 14.742C4.03991 14.608 3.69298 14.5391 3.34264 14.5393Z"
                          fill="white"/>
                </svg>
            </div>
            <div class="w-[16px] h-[16px] md:w-[21px] md:h-[20px] cursor-pointer">
                <svg viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.6088 6.66525C8.77258 6.66525 7.27407 8.16376 7.27407 10C7.27407 11.8362 8.77258 13.3348 10.6088 13.3348C12.4451 13.3348 13.9436 11.8362 13.9436 10C13.9436 8.16376 12.4451 6.66525 10.6088 6.66525ZM20.6106 10C20.6106 8.61907 20.6231 7.25064 20.5455 5.87221C20.468 4.27113 20.1027 2.85017 18.9319 1.67938C17.7587 0.506085 16.3402 0.14334 14.7391 0.065788C13.3582 -0.0117644 11.9898 0.000744113 10.6113 0.000744113C9.23039 0.000744113 7.86197 -0.0117644 6.48354 0.065788C4.88246 0.14334 3.4615 0.508587 2.29071 1.67938C1.11741 2.85267 0.754669 4.27113 0.677116 5.87221C0.599564 7.25314 0.612072 8.62157 0.612072 10C0.612072 11.3784 0.599564 12.7494 0.677116 14.1278C0.754669 15.7289 1.11992 17.1498 2.29071 18.3206C3.464 19.4939 4.88246 19.8567 6.48354 19.9342C7.86447 20.0118 9.2329 19.9993 10.6113 19.9993C11.9923 19.9993 13.3607 20.0118 14.7391 19.9342C16.3402 19.8567 17.7612 19.4914 18.9319 18.3206C20.1052 17.1473 20.468 15.7289 20.5455 14.1278C20.6256 12.7494 20.6106 11.3809 20.6106 10ZM10.6088 15.131C7.76941 15.131 5.47786 12.8394 5.47786 10C5.47786 7.16058 7.76941 4.86903 10.6088 4.86903C13.4482 4.86903 15.7398 7.16058 15.7398 10C15.7398 12.8394 13.4482 15.131 10.6088 15.131ZM15.9499 5.8572C15.287 5.8572 14.7516 5.32184 14.7516 4.65889C14.7516 3.99594 15.287 3.46058 15.9499 3.46058C16.6129 3.46058 17.1482 3.99594 17.1482 4.65889C17.1484 4.81631 17.1176 4.97222 17.0574 5.1177C16.9973 5.26317 16.909 5.39535 16.7977 5.50666C16.6864 5.61798 16.5542 5.70624 16.4087 5.76639C16.2633 5.82654 16.1074 5.8574 15.9499 5.8572Z"
                        fill="white"/>
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
        autoplaySpeed: 1500,
        slidesToScroll: 8,
        slidesToShow: 8,

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
        autoplay: false,
        autoplaySpeed: 3000,
        pauseOnFocus: true,
        slidesToScroll: 5,
        slidesToShow: 5,
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
        autoplay: false,
        autoplaySpeed: 3000,
        slidesToShow: 6,
        slidesToScroll: 6,
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


</body>

</html>
