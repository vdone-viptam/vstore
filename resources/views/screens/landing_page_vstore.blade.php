<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="{{asset('landingpage/style.css')}}">
    <link rel="stylesheet" href="{{asset('landingpage/output.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
{{--    <link rel="stylesheet" href="../dist/output.css">--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    @vite('resources/css/app.css')
</head>
<body>
<header>
    <div class=" w-full bg-shark">
        <div class="hidden lg:flex justify-between items-center xl:max-w-[1320px] mx-auto px-6 xl:px-0">
            <ul class="top-bar flex justify-start items-center">
                <li class="border-r-[1px] border-[#E0E0E0]"><a href="#">Trang chủ</a></li>
                <li class="border-r-[1px] border-[#E0E0E0]"><a href="#">Trở thành người bán</a></li>
                <li class="border-r-[1px] border-[#E0E0E0]"><a href="#">Tải ứng dụng</a></li>
                <li><a href="#">Kết nối</a></li>
                <div class="flex justify-start gap-2">
                    <a href="#">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="20" height="20" rx="10" fill="#337FFF"/>
                            <path d="M12.4451 10.6511L12.73 8.84053H10.9747V7.66368C10.9747 7.16861 11.2198 6.68486 12.0034 6.68486H12.8127V5.14307C12.3414 5.06791 11.8652 5.02726 11.3879 5.02142C9.94313 5.02142 8.99991 5.88992 8.99991 7.45999V8.84053H7.39844V10.6511H8.99991V15.0303H10.9747V10.6511H12.4451Z" fill="white"/>
                        </svg>

                    </a>
                    <a href="#">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="20" height="20" rx="10" fill="url(#paint0_linear_348_1253)"/>
                            <path d="M8.3356 10.0256C8.3356 9.10437 9.08201 8.35734 10.003 8.35734C10.924 8.35734 11.6708 9.10437 11.6708 10.0256C11.6708 10.9469 10.924 11.6939 10.003 11.6939C9.08201 11.6939 8.3356 10.9469 8.3356 10.0256ZM7.43402 10.0256C7.43402 11.4449 8.58415 12.5953 10.003 12.5953C11.4219 12.5953 12.572 11.4449 12.572 10.0256C12.572 8.60636 11.4219 7.4559 10.003 7.4559C8.58415 7.4559 7.43402 8.60636 7.43402 10.0256ZM12.0733 7.35401C12.0733 7.47279 12.1084 7.58891 12.1744 7.68769C12.2403 7.78647 12.334 7.86348 12.4437 7.90898C12.5534 7.95448 12.6741 7.96642 12.7906 7.94329C12.907 7.92017 13.014 7.86301 13.098 7.77906C13.182 7.69511 13.2392 7.58813 13.2625 7.47164C13.2857 7.35516 13.2738 7.23441 13.2284 7.12466C13.183 7.01491 13.1061 6.92109 13.0074 6.85506C12.9087 6.78903 12.7927 6.75377 12.6739 6.75372H12.6737C12.5145 6.75379 12.3619 6.81705 12.2493 6.92961C12.1368 7.04216 12.0735 7.1948 12.0733 7.35401ZM7.98179 14.0991C7.49402 14.0769 7.2289 13.9956 7.05271 13.927C6.81913 13.836 6.65247 13.7277 6.47725 13.5526C6.30202 13.3776 6.19356 13.2111 6.10302 12.9774C6.03434 12.8012 5.95309 12.536 5.93092 12.0481C5.90666 11.5206 5.90182 11.3621 5.90182 10.0257C5.90182 8.68924 5.90706 8.53122 5.93092 8.00327C5.95313 7.51535 6.03498 7.2506 6.10302 7.07392C6.19396 6.84027 6.30226 6.67357 6.47725 6.49829C6.65223 6.32302 6.81873 6.21452 7.05271 6.12396C7.22882 6.05526 7.49402 5.97399 7.98179 5.95181C8.50914 5.92754 8.66756 5.9227 10.003 5.9227C11.3384 5.9227 11.497 5.92794 12.0248 5.95181C12.5126 5.97403 12.7773 6.0559 12.9539 6.12396C13.1875 6.21452 13.3541 6.32326 13.5294 6.49829C13.7046 6.67333 13.8126 6.84027 13.9036 7.07392C13.9723 7.25008 14.0535 7.51535 14.0757 8.00327C14.0999 8.53122 14.1048 8.68924 14.1048 10.0257C14.1048 11.3621 14.0999 11.5201 14.0757 12.0481C14.0535 12.536 13.9718 12.8012 13.9036 12.9774C13.8126 13.2111 13.7043 13.3778 13.5294 13.5526C13.3544 13.7275 13.1875 13.836 12.9539 13.927C12.7778 13.9957 12.5126 14.0769 12.0248 14.0991C11.4975 14.1234 11.339 14.1282 10.003 14.1282C8.66696 14.1282 8.50898 14.1234 7.98179 14.0991ZM7.94036 5.05149C7.40776 5.07575 7.04383 5.16022 6.72599 5.28393C6.39684 5.41169 6.11819 5.58308 5.83974 5.86117C5.5613 6.13925 5.39039 6.41842 5.26268 6.74767C5.139 7.06579 5.05455 7.42964 5.0303 7.96239C5.00564 8.49599 5 8.66658 5 10.0256C5 11.3847 5.00564 11.5553 5.0303 12.0889C5.05455 12.6216 5.139 12.9855 5.26268 13.3036C5.39039 13.6326 5.56134 13.9121 5.83974 14.1901C6.11815 14.468 6.39684 14.6392 6.72599 14.7673C7.04443 14.891 7.40776 14.9755 7.94036 14.9998C8.47408 15.024 8.64435 15.0301 10.003 15.0301C11.3617 15.0301 11.5322 15.0244 12.0656 14.9998C12.5983 14.9755 12.962 14.891 13.28 14.7673C13.609 14.6392 13.8878 14.4682 14.1663 14.1901C14.4447 13.912 14.6152 13.6326 14.7433 13.3036C14.867 12.9855 14.9518 12.6216 14.9757 12.0889C15 11.5549 15.0056 11.3847 15.0056 10.0256C15.0056 8.66658 15 8.49599 14.9757 7.96239C14.9514 7.4296 14.867 7.06559 14.7433 6.74767C14.6152 6.41862 14.4443 6.13969 14.1663 5.86117C13.8882 5.58264 13.609 5.41169 13.2804 5.28393C12.962 5.16022 12.5982 5.07535 12.066 5.05149C11.5326 5.02722 11.3621 5.02118 10.0034 5.02118C8.64475 5.02118 8.47408 5.02682 7.94036 5.05149Z" fill="white"/>
                            <defs>
                                <linearGradient id="paint0_linear_348_1253" x1="19.6156" y1="20" x2="-0.384399" y2="-5.38344e-07" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#FBE18A"/>
                                    <stop offset="0.21" stop-color="#FCBB45"/>
                                    <stop offset="0.38" stop-color="#F75274"/>
                                    <stop offset="0.52" stop-color="#D53692"/>
                                    <stop offset="0.74" stop-color="#8F39CE"/>
                                    <stop offset="1" stop-color="#5B4FE9"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>

                </div>
            </ul>
            <div class="flex justify-end items-center gap-8">
                <ul class="top-bar flex justify-start items-center gap-2">
                    <li><a href="#" class="flex justify-start items-center gap-1"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.8889 6.00964C12.8889 4.7694 12.3738 3.57996 11.457 2.70298C10.5401 1.826 9.29661 1.33331 8 1.33331C6.70339 1.33331 5.45988 1.826 4.54303 2.70298C3.62619 3.57996 3.11111 4.7694 3.11111 6.00964C3.11111 9.60408 1.76067 11.507 0.839241 12.387C0.648546 12.5691 0.793366 13.0241 1.05706 13.0241H4.94806C5.06503 13.0241 5.16696 13.1041 5.20392 13.2151C5.38817 13.7684 6.07913 15.3333 8 15.3333C9.92088 15.3333 10.6118 13.7684 10.7961 13.2151C10.833 13.1041 10.935 13.0241 11.0519 13.0241H14.9429C15.2066 13.0241 15.3515 12.5691 15.1608 12.387C14.2393 11.507 12.8889 9.60408 12.8889 6.00964Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Thông báo
                        </a></li>
                    <li><a href="#" class="flex justify-start items-center gap-1"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8.0013" cy="8.00002" r="7.33333" stroke="white"/>
                                <path d="M8 9.33334V9.33334C8 8.37631 8.79514 7.62356 9.4839 6.95909C9.8485 6.60735 10.108 6.08944 10 5.33331C9.71429 3.33329 7 4.33331 7 4.33331" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 11.3333V11.6666" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Hỗ trợ
                        </a></li>
                    <li><a href="#" class="flex justify-start items-center"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8.0013" cy="8.00002" r="7.33333" stroke="white"/>
                                <path d="M0.667969 8H15.3346" stroke="white"/>
                                <path d="M8 0.666687C8 0.666687 5.33333 2.13335 5.33333 8.00002C5.33333 13.8667 8 15.3334 8 15.3334" stroke="white"/>
                                <path d="M8 0.666687C8 0.666687 10.6667 2.13335 10.6667 8.00002C10.6667 13.8667 8 15.3334 8 15.3334" stroke="white"/>
                            </svg>
                            <select name="" id="" class="outline-none px-2 bg-shark">
                                <option value="0">Tiếng Việt</option>
                                <option value="1">Tiếng Anh</option>
                            </select>
                        </a></li>
                </ul>
                <ul class="top-bar flex justify-start items-center">
                    <li class="border-r-[1px] border-[#E0E0E0]"><a href="https://vstore.vdone.vn/dang-ky/">Đăng ký</a></li>
                    <li><a href="{{route('login_vstore')}}">Đăng nhập</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="nav">
        <div class="flex justify-between items-center max-w-[1320px] mx-auto px-6 xl:px-0 py-4">
            <div class="w-[301px]">
                <div class=" w-[300px] h-[64px]">
                    @if(!empty($logo))
                        <a href="/"><img src="{{asset('/image/users/'.$logo)}}" alt="" class="object-contain"></a>
                    @else
                        <a href="/"><img src="{{asset('landingpage/images/logo.png')}}" alt="" class="w-[300px] h-[64px]"></a>
                    @endif
{{--                    <a href="/"><img src="{{asset('landingpage/images/logo.png')}}" alt="" class="w-full"></a>--}}
                </div>
            </div>
            <div class="w-[730px] hidden lg:block">
                <div class="w-[729px] h-[120px]">
                    <img src=" {{asset('landingpage/images/bn.jpg')}}" alt="" class="w-full">
                </div>
            </div>

        </div>


    </div>
{{--    @if(!empty($banner))--}}
{{--        <a href="/"><img src="{{asset('/image/users/'.$banner)}}" alt="" class="w-full"></a>--}}
{{--    @else--}}
{{--        <div class="w-full h-full">--}}
{{--            <img src="{{asset('landingpage/images/bn.jpg')}}" alt="" class="w-full">--}}
{{--        </div>--}}
{{--    @endif--}}
</header>
<div class="xl:max-w-[1320px] mx-auto w-full flex flex-col gap-5 px-6 xl:px-0">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 md:gap-4 py-5 w-full ">
        <div class="col-span-8 h-[265px] ">
{{--            <div class="w-full h-full">--}}
{{--                <img src="../images/sp.png" alt="" class="w-full">--}}
{{--            </div>--}}

            @if(!empty($banner))
                <div class="w-full h-full">
                <a href="/"><img src="{{asset('/image/users/'.$banner)}}" alt="" class="w-full"></a>
                </div>
            @else
                <div class="w-full h-full">
                    <img src="{{asset('landingpage/images/bn.jpg')}}" alt="" class="w-full">
                </div>
            @endif

        </div>
        <div class="col-span-4 flex flex-col justify-between items-center h-[265px]">
            <div class="row-span-2 w-full h-[128px]">
                <div class="w-full h-full">
                    <img src="{{asset('landingpage/images/bn3.jpg')}}" alt="" class="w-full">
                </div>
            </div>
            <div class="row-span-2 w-full h-[128px]">
                <div class="w-full h-full">
                    <img src="{{asset('landingpage/images/bn2.jpg')}}" alt="" class="w-full">
                </div>
            </div>
        </div>
    </div>
{{--    <div class="grid grid-cols-12 gap-4 py-5 w-full">--}}
{{--        <div class="col-span-8 h-[265px] ">--}}
{{--            @if(!empty($banner))--}}
{{--                <a href="/"><img src="{{asset('/image/users/'.$banner)}}" alt="" class="w-full"></a>--}}
{{--            @else--}}
{{--                <div class="w-full h-full">--}}
{{--                    <img src="{{asset('landingpage/images/bn.jpg')}}" alt="" class="w-full">--}}
{{--                </div>--}}
{{--            @endif--}}

{{--        </div>--}}
{{--        <div class="col-span-4 flex flex-col justify-between items-center h-[265px]">--}}
{{--            <div class="row-span-2 w-full">--}}
{{--                <div class="w-full h-full">--}}
{{--                    <img src="{{asset('landingpage/images/bn3.jpg')}}" alt="" class="w-full">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row-span-2 w-full">--}}
{{--                <div class="w-full h-full">--}}
{{--                    <img src="{{asset('landingpage/images/bn2.jpg')}}" alt="" class="w-full">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="box p-4 lg:p-8">
        <div class="flex justfy-center md:justify-between items-center w-full flex-wrap lg:flex-nowrap gap-6">
            <div class="flex flex-col justify-center md:flex-row md:justify-start items-center gap-2 lg:gap-6 w-full">
                <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="26" cy="26" r="26" fill="#056DD2"/>
                    <path d="M33.5003 22.25H19.1153L21.0653 20.315C21.3478 20.0325 21.5065 19.6495 21.5065 19.25C21.5065 18.8506 21.3478 18.4675 21.0653 18.185C20.7829 17.9025 20.3998 17.7439 20.0003 17.7439C19.6009 17.7439 19.2178 17.9025 18.9353 18.185L14.4353 22.685C14.2988 22.8277 14.1917 22.9959 14.1203 23.18C13.9703 23.5452 13.9703 23.9548 14.1203 24.32C14.1917 24.5041 14.2988 24.6723 14.4353 24.815L18.9353 29.315C19.0748 29.4556 19.2407 29.5672 19.4235 29.6433C19.6063 29.7195 19.8023 29.7587 20.0003 29.7587C20.1984 29.7587 20.3944 29.7195 20.5772 29.6433C20.76 29.5672 20.9259 29.4556 21.0653 29.315C21.2059 29.1756 21.3175 29.0097 21.3937 28.8269C21.4698 28.6441 21.509 28.448 21.509 28.25C21.509 28.052 21.4698 27.8559 21.3937 27.6731C21.3175 27.4904 21.2059 27.3244 21.0653 27.185L19.1153 25.25H33.5003C33.8982 25.25 34.2797 25.408 34.561 25.6893C34.8423 25.9706 35.0003 26.3522 35.0003 26.75V32.75C35.0003 33.1478 35.1584 33.5294 35.4397 33.8107C35.721 34.092 36.1025 34.25 36.5003 34.25C36.8982 34.25 37.2797 34.092 37.561 33.8107C37.8423 33.5294 38.0003 33.1478 38.0003 32.75V26.75C38.0003 25.5565 37.5262 24.4119 36.6823 23.568C35.8384 22.7241 34.6938 22.25 33.5003 22.25Z" fill="white"/>
                </svg>
                <div class="flex flex-col justify-start items-center md:items-start text-center ">
                    <span class="font-semibold text-lg text-text">7 ngày miễn phí trả hàng </span>
                    <span class="text-tGrey text-sm">Trả hàng miễn phí trong 7 ngày </span>
                </div>

            </div>
            <div class="flex flex-col justify-center md:flex-row md:justify-start items-center gap-2 lg:gap-6 w-full">
                <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.50514 8.66666L25.9998 2.16666L45.4949 8.66666C45.4949 8.66666 45.5 15.1667 45.5 28.1667C45.5 41.1667 25.9998 49.8333 25.9998 49.8333C25.9998 49.8333 6.50004 41.1667 6.50002 28.1667C6.5 15.1667 6.50514 8.66666 6.50514 8.66666Z" fill="#056DD2" stroke="#056DD2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18 23.3137L23.6569 28.9706L34.9706 17.6569" stroke="white" stroke-width="3" stroke-linecap="round"/>
                </svg>

                <div class="flex flex-col justify-start items-center md:items-start text-center">
                    <span class="font-semibold text-lg text-text">Hàng chính hãng 100% </span>
                    <span class="text-tGrey text-sm">Đảm bảo hàng chính hãng hoặc hoàn tiền gấp đôi</span>
                </div>

            </div>
            <div class="flex flex-col justify-center md:flex-row md:justify-start items-center gap-2 lg:gap-6 w-full">
                <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="26" cy="26" r="26" fill="#056DD2"/>
                    <rect x="13.168" y="15.5" width="16.3333" height="15.1667" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M29.5 21.3333H34.1667L38.8333 26V30.6667H29.5V21.3333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="18.4167" cy="33.5833" r="2.91667" fill="white" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="32.4167" cy="33.5833" r="2.91667" fill="white" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="flex flex-col justify-start items-center md:items-start text-center">
                    <span class="font-semibold text-lg text-text">Miễn phí vận chuyển </span>
                    <span class="text-tGrey text-sm">Giao hàng miễn phí toàn quốc </span>
                </div>

            </div>
        </div>
    </div>
    <div class="box p-2 md:p-4 lg:p-8">
        <div class="flex flex-col justify-center items-center gap-6">
            <h3 class="text-lg font-bold text-text uppercase">DANH MỤC</h3>
            <div class="">
                <section>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 gap-2 md:gap-8">
                        @foreach($arrCategory as $cate)
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">{{$cate->name}}</span>
                        </div>
                        @endforeach
                    </div>

                </section>
                <!-- <section>
                    <div class="grid grid-cols-8 gap-8">
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">Ô tô - xe đạp - xe máy </span>
                        </div>
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">Ô tô - xe đạp - xe máy </span>
                        </div>
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">Ô tô - xe đạp - xe máy </span>
                        </div>
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">Ô tô - xe đạp - xe máy</span>
                        </div>
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">Ô tô - xe đạp - xe máy </span>
                        </div>
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">Ô tô - xe đạp - xe máy </span>
                        </div>
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">Ô tô - xe đạp - xe máy </span>
                        </div>
                        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]">
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">Ô tô - xe đạp - xe máy</span>
                        </div>
                    </div>
                </section> -->
            </div>

        </div>
    </div>
    <div class="flex flex-col justify-center items-center gap-6 py-10">
        <h2 class="text-sciblue text-3xl font-bold uppercase text-center">Thương hiệu nổi bật</h2>
        <div class="w-full h-full">
            <img src="{{asset('landingpage/images/bnbg.jpg')}}" alt="" class="w-full">
        </div>
        <div class="content-item grid grid-cols- md:grid-cols-3 lg:grid-cols-6 gap-2">
            @foreach($user->vstoreProducts()->where('status',2)->orderBy('id','desc')->limit(6)->get() as $pro)
                <a href="#">
                    <div class="item">
                        <div class="item-img" style="height: 150px;">
                            <img src="{{asset(json_decode($pro->images)[0])}}" alt="">
                        </div>
                        <div class="content">
                            <h3>{{$pro->name}} </h3>
                            <div class="discount">
                                <span class="cost">₫{{number_format($pro->price,0,'.','.')}}</span>
                                <span class="real">₫{{number_format($pro->price - ($pro->price * ($pro->discount_vShop / 100)),0,'.','.')}}</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.832031 10.4167V14.5833C0.832031 14.8044 0.919829 15.0163 1.07611 15.1726C1.23239 15.3289 1.44435 15.4167 1.66536 15.4167H2.4987C2.4987 16.0797 2.76209 16.7156 3.23093 17.1844C3.69977 17.6533 4.33566 17.9167 4.9987 17.9167C5.66174 17.9167 6.29762 17.6533 6.76647 17.1844C7.23531 16.7156 7.4987 16.0797 7.4987 15.4167H12.4987C12.4987 16.0797 12.7621 16.7156 13.2309 17.1844C13.6998 17.6533 14.3357 17.9167 14.9987 17.9167C15.6617 17.9167 16.2976 17.6533 16.7665 17.1844C17.2353 16.7156 17.4987 16.0797 17.4987 15.4167H18.332C18.553 15.4167 18.765 15.3289 18.9213 15.1726C19.0776 15.0163 19.1654 14.8044 19.1654 14.5833V4.58334C19.1654 3.9203 18.902 3.28442 18.4331 2.81558C17.9643 2.34674 17.3284 2.08334 16.6654 2.08334H9.16537C8.50232 2.08334 7.86644 2.34674 7.3976 2.81558C6.92876 3.28442 6.66536 3.9203 6.66536 4.58334V6.25001H4.9987C4.61059 6.25001 4.2278 6.34037 3.88066 6.51394C3.53353 6.68751 3.23157 6.93952 2.9987 7.25001L0.998698 9.91668C0.974324 9.9529 0.954718 9.99211 0.940365 10.0333L0.890365 10.125C0.853586 10.2179 0.833827 10.3167 0.832031 10.4167ZM14.1654 15.4167C14.1654 15.2519 14.2142 15.0907 14.3058 14.9537C14.3974 14.8167 14.5275 14.7099 14.6798 14.6468C14.8321 14.5837 14.9996 14.5672 15.1613 14.5994C15.3229 14.6315 15.4714 14.7109 15.588 14.8274C15.7045 14.944 15.7839 15.0924 15.816 15.2541C15.8482 15.4158 15.8317 15.5833 15.7686 15.7356C15.7055 15.8879 15.5987 16.018 15.4617 16.1096C15.3246 16.2011 15.1635 16.25 14.9987 16.25C14.7777 16.25 14.5657 16.1622 14.4094 16.0059C14.2532 15.8497 14.1654 15.6377 14.1654 15.4167ZM8.33203 4.58334C8.33203 4.36233 8.41983 4.15037 8.57611 3.99409C8.73239 3.83781 8.94435 3.75001 9.16537 3.75001H16.6654C16.8864 3.75001 17.0983 3.83781 17.2546 3.99409C17.4109 4.15037 17.4987 4.36233 17.4987 4.58334V13.75H16.8487C16.6144 13.4922 16.3288 13.2862 16.0102 13.1453C15.6916 13.0043 15.3471 12.9315 14.9987 12.9315C14.6503 12.9315 14.3058 13.0043 13.9872 13.1453C13.6686 13.2862 13.383 13.4922 13.1487 13.75H8.33203V4.58334ZM6.66536 9.58334H3.33203L4.33203 8.25001C4.40965 8.14651 4.51031 8.06251 4.62602 8.00465C4.74173 7.9468 4.86933 7.91668 4.9987 7.91668H6.66536V9.58334ZM4.16536 15.4167C4.16536 15.2519 4.21424 15.0907 4.30581 14.9537C4.39737 14.8167 4.52752 14.7099 4.6798 14.6468C4.83207 14.5837 4.99962 14.5672 5.16127 14.5994C5.32292 14.6315 5.47141 14.7109 5.58795 14.8274C5.7045 14.944 5.78386 15.0924 5.81602 15.2541C5.84817 15.4158 5.83167 15.5833 5.7686 15.7356C5.70552 15.8879 5.59871 16.018 5.46167 16.1096C5.32463 16.2011 5.16352 16.25 4.9987 16.25C4.77768 16.25 4.56572 16.1622 4.40944 16.0059C4.25316 15.8497 4.16536 15.6377 4.16536 15.4167ZM2.4987 11.25H6.66536V13.5667C6.17356 13.1271 5.52798 12.8998 4.86928 12.9341C4.21057 12.9685 3.59213 13.2617 3.1487 13.75H2.4987V11.25Z" fill="#219653"/>
                                </svg>

                            </div>
                            <div class="has-sell">
                                <span class="rating">
                                  @php
                                    $random_star = rand(1,5);
                                  @endphp
                                      @for($i = 1; $i < 6;$i++ )
                                        @if($i <  $random_star)
                                        <svg  viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <title>star-solid</title>
                                        <g id="Layer_2" data-name="Layer 2">
                                          <g id="invisible_box" data-name="invisible box">
                                            <rect width="48" height="48" fill="none"/>
                                          </g>
                                          <g id="icons_Q2" data-name="icons Q2">
                                            <path d="M24,3a2.1,2.1,0,0,0-1.8,1.1L16.5,15.7,3.7,17.5A2.1,2.1,0,0,0,2.6,21l9.2,8.9L9.7,42.7A2,2,0,0,0,11.6,45l1-.2,11.4-6,11.4,6,1,.2a2,2,0,0,0,1.9-2.3L36.2,29.9,45.4,21a2.1,2.1,0,0,0-1.1-3.5L31.5,15.7,25.8,4.1A2.1,2.1,0,0,0,24,3Z"/>
                                          </g>
                                        </g>
                                      </svg>
                                      @else
              <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>action / 11 - action, favorite, favourite, like, rating, star icon</title>
                                        <g id="Free-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g transform="translate(-303.000000, -156.000000)" id="Group" stroke="#000000" stroke-width="2">
                                                <g transform="translate(301.000000, 154.000000)" id="Shape">
                                                    <polygon points="11.9999754 3 15 9.00030843 21.0006915 9.00030843 16 14 18 21 12.0003457 17.5 6 21 8 14 3 9.00030843 9 9.00030843">

                                    </polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                        @endif

                                      @endfor


                                </span>
                                <span class="sell">Đã bán 426</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col justify-center items-center gap-16">
        <div>
            <div class="w-full h-full">
                <img src="{{asset('landingpage/images/bnbg1.png')}}" alt="" class="w-full">
            </div>
            <div class="content-item grid grid-cols- md:grid-cols-3 lg:grid-cols-6 gap-2">
            @foreach($user->vstoreProducts()->where('status',2)->orderBy('id','asc')->limit(6)->get() as $pro)
                <a href="#">
                    <div class="item">
                        <div class="item-img" style="height: 150px;">
                            <img src="{{asset(json_decode($pro->images)[0])}}" alt="">
                        </div>
                        <div class="content">
                            <h3>{{$pro->name}} </h3>
                            <div class="discount">
                            <span class="cost">₫{{number_format($pro->price,0,'.','.')}}</span>
                                <span class="real">₫{{number_format($pro->price - ($pro->price * ($pro->discount_vShop / 100 ?? 0)),0,'.','.')}}</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.832031 10.4167V14.5833C0.832031 14.8044 0.919829 15.0163 1.07611 15.1726C1.23239 15.3289 1.44435 15.4167 1.66536 15.4167H2.4987C2.4987 16.0797 2.76209 16.7156 3.23093 17.1844C3.69977 17.6533 4.33566 17.9167 4.9987 17.9167C5.66174 17.9167 6.29762 17.6533 6.76647 17.1844C7.23531 16.7156 7.4987 16.0797 7.4987 15.4167H12.4987C12.4987 16.0797 12.7621 16.7156 13.2309 17.1844C13.6998 17.6533 14.3357 17.9167 14.9987 17.9167C15.6617 17.9167 16.2976 17.6533 16.7665 17.1844C17.2353 16.7156 17.4987 16.0797 17.4987 15.4167H18.332C18.553 15.4167 18.765 15.3289 18.9213 15.1726C19.0776 15.0163 19.1654 14.8044 19.1654 14.5833V4.58334C19.1654 3.9203 18.902 3.28442 18.4331 2.81558C17.9643 2.34674 17.3284 2.08334 16.6654 2.08334H9.16537C8.50232 2.08334 7.86644 2.34674 7.3976 2.81558C6.92876 3.28442 6.66536 3.9203 6.66536 4.58334V6.25001H4.9987C4.61059 6.25001 4.2278 6.34037 3.88066 6.51394C3.53353 6.68751 3.23157 6.93952 2.9987 7.25001L0.998698 9.91668C0.974324 9.9529 0.954718 9.99211 0.940365 10.0333L0.890365 10.125C0.853586 10.2179 0.833827 10.3167 0.832031 10.4167ZM14.1654 15.4167C14.1654 15.2519 14.2142 15.0907 14.3058 14.9537C14.3974 14.8167 14.5275 14.7099 14.6798 14.6468C14.8321 14.5837 14.9996 14.5672 15.1613 14.5994C15.3229 14.6315 15.4714 14.7109 15.588 14.8274C15.7045 14.944 15.7839 15.0924 15.816 15.2541C15.8482 15.4158 15.8317 15.5833 15.7686 15.7356C15.7055 15.8879 15.5987 16.018 15.4617 16.1096C15.3246 16.2011 15.1635 16.25 14.9987 16.25C14.7777 16.25 14.5657 16.1622 14.4094 16.0059C14.2532 15.8497 14.1654 15.6377 14.1654 15.4167ZM8.33203 4.58334C8.33203 4.36233 8.41983 4.15037 8.57611 3.99409C8.73239 3.83781 8.94435 3.75001 9.16537 3.75001H16.6654C16.8864 3.75001 17.0983 3.83781 17.2546 3.99409C17.4109 4.15037 17.4987 4.36233 17.4987 4.58334V13.75H16.8487C16.6144 13.4922 16.3288 13.2862 16.0102 13.1453C15.6916 13.0043 15.3471 12.9315 14.9987 12.9315C14.6503 12.9315 14.3058 13.0043 13.9872 13.1453C13.6686 13.2862 13.383 13.4922 13.1487 13.75H8.33203V4.58334ZM6.66536 9.58334H3.33203L4.33203 8.25001C4.40965 8.14651 4.51031 8.06251 4.62602 8.00465C4.74173 7.9468 4.86933 7.91668 4.9987 7.91668H6.66536V9.58334ZM4.16536 15.4167C4.16536 15.2519 4.21424 15.0907 4.30581 14.9537C4.39737 14.8167 4.52752 14.7099 4.6798 14.6468C4.83207 14.5837 4.99962 14.5672 5.16127 14.5994C5.32292 14.6315 5.47141 14.7109 5.58795 14.8274C5.7045 14.944 5.78386 15.0924 5.81602 15.2541C5.84817 15.4158 5.83167 15.5833 5.7686 15.7356C5.70552 15.8879 5.59871 16.018 5.46167 16.1096C5.32463 16.2011 5.16352 16.25 4.9987 16.25C4.77768 16.25 4.56572 16.1622 4.40944 16.0059C4.25316 15.8497 4.16536 15.6377 4.16536 15.4167ZM2.4987 11.25H6.66536V13.5667C6.17356 13.1271 5.52798 12.8998 4.86928 12.9341C4.21057 12.9685 3.59213 13.2617 3.1487 13.75H2.4987V11.25Z" fill="#219653"/>
                                </svg>

                            </div>
                            <div class="has-sell">
                                <span class="rating">
                                  @php
                                    $random_star = rand(1,5);
                                  @endphp
                                      @for($i = 1; $i < 6;$i++ )
                                        @if($i <  $random_star)
                                        <svg  viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <title>star-solid</title>
                                        <g id="Layer_2" data-name="Layer 2">
                                          <g id="invisible_box" data-name="invisible box">
                                            <rect width="48" height="48" fill="none"/>
                                          </g>
                                          <g id="icons_Q2" data-name="icons Q2">
                                            <path d="M24,3a2.1,2.1,0,0,0-1.8,1.1L16.5,15.7,3.7,17.5A2.1,2.1,0,0,0,2.6,21l9.2,8.9L9.7,42.7A2,2,0,0,0,11.6,45l1-.2,11.4-6,11.4,6,1,.2a2,2,0,0,0,1.9-2.3L36.2,29.9,45.4,21a2.1,2.1,0,0,0-1.1-3.5L31.5,15.7,25.8,4.1A2.1,2.1,0,0,0,24,3Z"/>
                                          </g>
                                        </g>
                                      </svg>
                                      @else
              <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>action / 11 - action, favorite, favourite, like, rating, star icon</title>
                                        <g id="Free-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g transform="translate(-303.000000, -156.000000)" id="Group" stroke="#000000" stroke-width="2">
                                                <g transform="translate(301.000000, 154.000000)" id="Shape">
                                                    <polygon points="11.9999754 3 15 9.00030843 21.0006915 9.00030843 16 14 18 21 12.0003457 17.5 6 21 8 14 3 9.00030843 9 9.00030843">

                                    </polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                        @endif

                                      @endfor


                                </span>
                                <span class="sell">Đã bán 426</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            </div>
        </div>
        <div>
            <div class="w-full h-full py-2">
                <img src="{{asset('landingpage/images/bnbg.jpg')}}" alt="" class="w-full">
            </div>
            <div class="content-item grid grid-cols- md:grid-cols-3 lg:grid-cols-6 gap-2">
            @foreach($user->vstoreProducts()->where('status',2)->orderBy('id','desc')->limit(6)->get() as $pro)
                <a href="#">
                    <div class="item">
                        <div class="item-img" style="height: 150px;">
                            <img src="{{asset(json_decode($pro->images)[0])}}" alt="">
                        </div>
                        <div class="content">
                            <h3>{{$pro->name}} </h3>
                            <div class="discount">
                            <span class="cost">₫{{number_format($pro->price,0,'.','.')}}</span>
                                <span class="real">₫{{number_format($pro->price - ($pro->price * ($pro->discount_vShop / 100)),0,'.','.')}}</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.832031 10.4167V14.5833C0.832031 14.8044 0.919829 15.0163 1.07611 15.1726C1.23239 15.3289 1.44435 15.4167 1.66536 15.4167H2.4987C2.4987 16.0797 2.76209 16.7156 3.23093 17.1844C3.69977 17.6533 4.33566 17.9167 4.9987 17.9167C5.66174 17.9167 6.29762 17.6533 6.76647 17.1844C7.23531 16.7156 7.4987 16.0797 7.4987 15.4167H12.4987C12.4987 16.0797 12.7621 16.7156 13.2309 17.1844C13.6998 17.6533 14.3357 17.9167 14.9987 17.9167C15.6617 17.9167 16.2976 17.6533 16.7665 17.1844C17.2353 16.7156 17.4987 16.0797 17.4987 15.4167H18.332C18.553 15.4167 18.765 15.3289 18.9213 15.1726C19.0776 15.0163 19.1654 14.8044 19.1654 14.5833V4.58334C19.1654 3.9203 18.902 3.28442 18.4331 2.81558C17.9643 2.34674 17.3284 2.08334 16.6654 2.08334H9.16537C8.50232 2.08334 7.86644 2.34674 7.3976 2.81558C6.92876 3.28442 6.66536 3.9203 6.66536 4.58334V6.25001H4.9987C4.61059 6.25001 4.2278 6.34037 3.88066 6.51394C3.53353 6.68751 3.23157 6.93952 2.9987 7.25001L0.998698 9.91668C0.974324 9.9529 0.954718 9.99211 0.940365 10.0333L0.890365 10.125C0.853586 10.2179 0.833827 10.3167 0.832031 10.4167ZM14.1654 15.4167C14.1654 15.2519 14.2142 15.0907 14.3058 14.9537C14.3974 14.8167 14.5275 14.7099 14.6798 14.6468C14.8321 14.5837 14.9996 14.5672 15.1613 14.5994C15.3229 14.6315 15.4714 14.7109 15.588 14.8274C15.7045 14.944 15.7839 15.0924 15.816 15.2541C15.8482 15.4158 15.8317 15.5833 15.7686 15.7356C15.7055 15.8879 15.5987 16.018 15.4617 16.1096C15.3246 16.2011 15.1635 16.25 14.9987 16.25C14.7777 16.25 14.5657 16.1622 14.4094 16.0059C14.2532 15.8497 14.1654 15.6377 14.1654 15.4167ZM8.33203 4.58334C8.33203 4.36233 8.41983 4.15037 8.57611 3.99409C8.73239 3.83781 8.94435 3.75001 9.16537 3.75001H16.6654C16.8864 3.75001 17.0983 3.83781 17.2546 3.99409C17.4109 4.15037 17.4987 4.36233 17.4987 4.58334V13.75H16.8487C16.6144 13.4922 16.3288 13.2862 16.0102 13.1453C15.6916 13.0043 15.3471 12.9315 14.9987 12.9315C14.6503 12.9315 14.3058 13.0043 13.9872 13.1453C13.6686 13.2862 13.383 13.4922 13.1487 13.75H8.33203V4.58334ZM6.66536 9.58334H3.33203L4.33203 8.25001C4.40965 8.14651 4.51031 8.06251 4.62602 8.00465C4.74173 7.9468 4.86933 7.91668 4.9987 7.91668H6.66536V9.58334ZM4.16536 15.4167C4.16536 15.2519 4.21424 15.0907 4.30581 14.9537C4.39737 14.8167 4.52752 14.7099 4.6798 14.6468C4.83207 14.5837 4.99962 14.5672 5.16127 14.5994C5.32292 14.6315 5.47141 14.7109 5.58795 14.8274C5.7045 14.944 5.78386 15.0924 5.81602 15.2541C5.84817 15.4158 5.83167 15.5833 5.7686 15.7356C5.70552 15.8879 5.59871 16.018 5.46167 16.1096C5.32463 16.2011 5.16352 16.25 4.9987 16.25C4.77768 16.25 4.56572 16.1622 4.40944 16.0059C4.25316 15.8497 4.16536 15.6377 4.16536 15.4167ZM2.4987 11.25H6.66536V13.5667C6.17356 13.1271 5.52798 12.8998 4.86928 12.9341C4.21057 12.9685 3.59213 13.2617 3.1487 13.75H2.4987V11.25Z" fill="#219653"/>
                                </svg>

                            </div>
                            <div class="has-sell">
                                <span class="rating">
                                  @php
                                    $random_star = rand(1,5);
                                  @endphp
                                      @for($i = 1; $i < 6;$i++ )
                                        @if($i <  $random_star)
                                        <svg  viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <title>star-solid</title>
                                        <g id="Layer_2" data-name="Layer 2">
                                          <g id="invisible_box" data-name="invisible box">
                                            <rect width="48" height="48" fill="none"/>
                                          </g>
                                          <g id="icons_Q2" data-name="icons Q2">
                                            <path d="M24,3a2.1,2.1,0,0,0-1.8,1.1L16.5,15.7,3.7,17.5A2.1,2.1,0,0,0,2.6,21l9.2,8.9L9.7,42.7A2,2,0,0,0,11.6,45l1-.2,11.4-6,11.4,6,1,.2a2,2,0,0,0,1.9-2.3L36.2,29.9,45.4,21a2.1,2.1,0,0,0-1.1-3.5L31.5,15.7,25.8,4.1A2.1,2.1,0,0,0,24,3Z"/>
                                          </g>
                                        </g>
                                      </svg>
                                      @else
              <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>action / 11 - action, favorite, favourite, like, rating, star icon</title>
                                        <g id="Free-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g transform="translate(-303.000000, -156.000000)" id="Group" stroke="#000000" stroke-width="2">
                                                <g transform="translate(301.000000, 154.000000)" id="Shape">
                                                    <polygon points="11.9999754 3 15 9.00030843 21.0006915 9.00030843 16 14 18 21 12.0003457 17.5 6 21 8 14 3 9.00030843 9 9.00030843">

                                    </polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                        @endif

                                      @endfor


                                </span>
                                <span class="sell">Đã bán 426</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            </div>
        </div>

    </div>
Ưu đã
    <div class="flex flex-col justify-center items-center gap-6">
        <h2 class="text-s ciblue text-3xl font-bold uppercase text-center">Thương hiệu nổi bật</h2>
        @foreach($arrUser as $user1)
        <div class="flex flex-col justify-center items-center gap-3 text-center">
                            <div class="bg-botti rounded-xl w-[115px] h-[115px]" style=>
                            </div>
                            <span class="text-sm font-semibold text-emperor max-w-[100px]">{{$user1->name}}</span>
                        </div>
                        @endforeach
    </div>
    <div class="flex flex-col justify-center items-center gap-6 py-10">
        <h2 class="text-sciblue text-3xl font-bold uppercase text-center">Gợi ý hôm nay</h2>
        <div class="content-item grid grid-cols- md:grid-cols-3 lg:grid-cols-6 gap-2">

        @foreach($user->vstoreProducts()->where('status',2)->orderBy('id','desc')->limit(18)->get() as $pro)
                <a href="#">
                    <div class="item">
                        <div class="item-img" style="height: 150px;">
                            <img src="{{asset(json_decode($pro->images)[0])}}" alt="">
                        </div>
                        <div class="content">
                            <h3>{{$pro->name}} </h3>
                            <div class="discount">
                            <span class="cost">₫{{number_format($pro->price,0,'.','.')}}</span>
                                <span class="real">₫{{number_format($pro->price - ($pro->price * ($pro->discount_vShop / 100)),0,'.','.')}}</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.832031 10.4167V14.5833C0.832031 14.8044 0.919829 15.0163 1.07611 15.1726C1.23239 15.3289 1.44435 15.4167 1.66536 15.4167H2.4987C2.4987 16.0797 2.76209 16.7156 3.23093 17.1844C3.69977 17.6533 4.33566 17.9167 4.9987 17.9167C5.66174 17.9167 6.29762 17.6533 6.76647 17.1844C7.23531 16.7156 7.4987 16.0797 7.4987 15.4167H12.4987C12.4987 16.0797 12.7621 16.7156 13.2309 17.1844C13.6998 17.6533 14.3357 17.9167 14.9987 17.9167C15.6617 17.9167 16.2976 17.6533 16.7665 17.1844C17.2353 16.7156 17.4987 16.0797 17.4987 15.4167H18.332C18.553 15.4167 18.765 15.3289 18.9213 15.1726C19.0776 15.0163 19.1654 14.8044 19.1654 14.5833V4.58334C19.1654 3.9203 18.902 3.28442 18.4331 2.81558C17.9643 2.34674 17.3284 2.08334 16.6654 2.08334H9.16537C8.50232 2.08334 7.86644 2.34674 7.3976 2.81558C6.92876 3.28442 6.66536 3.9203 6.66536 4.58334V6.25001H4.9987C4.61059 6.25001 4.2278 6.34037 3.88066 6.51394C3.53353 6.68751 3.23157 6.93952 2.9987 7.25001L0.998698 9.91668C0.974324 9.9529 0.954718 9.99211 0.940365 10.0333L0.890365 10.125C0.853586 10.2179 0.833827 10.3167 0.832031 10.4167ZM14.1654 15.4167C14.1654 15.2519 14.2142 15.0907 14.3058 14.9537C14.3974 14.8167 14.5275 14.7099 14.6798 14.6468C14.8321 14.5837 14.9996 14.5672 15.1613 14.5994C15.3229 14.6315 15.4714 14.7109 15.588 14.8274C15.7045 14.944 15.7839 15.0924 15.816 15.2541C15.8482 15.4158 15.8317 15.5833 15.7686 15.7356C15.7055 15.8879 15.5987 16.018 15.4617 16.1096C15.3246 16.2011 15.1635 16.25 14.9987 16.25C14.7777 16.25 14.5657 16.1622 14.4094 16.0059C14.2532 15.8497 14.1654 15.6377 14.1654 15.4167ZM8.33203 4.58334C8.33203 4.36233 8.41983 4.15037 8.57611 3.99409C8.73239 3.83781 8.94435 3.75001 9.16537 3.75001H16.6654C16.8864 3.75001 17.0983 3.83781 17.2546 3.99409C17.4109 4.15037 17.4987 4.36233 17.4987 4.58334V13.75H16.8487C16.6144 13.4922 16.3288 13.2862 16.0102 13.1453C15.6916 13.0043 15.3471 12.9315 14.9987 12.9315C14.6503 12.9315 14.3058 13.0043 13.9872 13.1453C13.6686 13.2862 13.383 13.4922 13.1487 13.75H8.33203V4.58334ZM6.66536 9.58334H3.33203L4.33203 8.25001C4.40965 8.14651 4.51031 8.06251 4.62602 8.00465C4.74173 7.9468 4.86933 7.91668 4.9987 7.91668H6.66536V9.58334ZM4.16536 15.4167C4.16536 15.2519 4.21424 15.0907 4.30581 14.9537C4.39737 14.8167 4.52752 14.7099 4.6798 14.6468C4.83207 14.5837 4.99962 14.5672 5.16127 14.5994C5.32292 14.6315 5.47141 14.7109 5.58795 14.8274C5.7045 14.944 5.78386 15.0924 5.81602 15.2541C5.84817 15.4158 5.83167 15.5833 5.7686 15.7356C5.70552 15.8879 5.59871 16.018 5.46167 16.1096C5.32463 16.2011 5.16352 16.25 4.9987 16.25C4.77768 16.25 4.56572 16.1622 4.40944 16.0059C4.25316 15.8497 4.16536 15.6377 4.16536 15.4167ZM2.4987 11.25H6.66536V13.5667C6.17356 13.1271 5.52798 12.8998 4.86928 12.9341C4.21057 12.9685 3.59213 13.2617 3.1487 13.75H2.4987V11.25Z" fill="#219653"/>
                                </svg>

                            </div>
                            <div class="has-sell">
                                <span class="rating">
                                  @php
                                    $random_star = rand(1,5);
                                  @endphp
                                      @for($i = 1; $i < 6;$i++ )
                                        @if($i <  $random_star)
                                        <svg  viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                        <title>star-solid</title>
                                        <g id="Layer_2" data-name="Layer 2">
                                          <g id="invisible_box" data-name="invisible box">
                                            <rect width="48" height="48" fill="none"/>
                                          </g>
                                          <g id="icons_Q2" data-name="icons Q2">
                                            <path d="M24,3a2.1,2.1,0,0,0-1.8,1.1L16.5,15.7,3.7,17.5A2.1,2.1,0,0,0,2.6,21l9.2,8.9L9.7,42.7A2,2,0,0,0,11.6,45l1-.2,11.4-6,11.4,6,1,.2a2,2,0,0,0,1.9-2.3L36.2,29.9,45.4,21a2.1,2.1,0,0,0-1.1-3.5L31.5,15.7,25.8,4.1A2.1,2.1,0,0,0,24,3Z"/>
                                          </g>
                                        </g>
                                      </svg>
                                      @else
              <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>action / 11 - action, favorite, favourite, like, rating, star icon</title>
                                        <g id="Free-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g transform="translate(-303.000000, -156.000000)" id="Group" stroke="#000000" stroke-width="2">
                                                <g transform="translate(301.000000, 154.000000)" id="Shape">
                                                    <polygon points="11.9999754 3 15 9.00030843 21.0006915 9.00030843 16 14 18 21 12.0003457 17.5 6 21 8 14 3 9.00030843 9 9.00030843">

                                    </polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                        @endif

                                      @endfor


                                </span>
                                <span class="sell">Đã bán 426</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>
