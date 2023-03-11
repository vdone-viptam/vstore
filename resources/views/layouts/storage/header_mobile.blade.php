<style>
    .active .tab__left {
        background: #4062FF;
    }

    .active .text__menu {
        color: white;
    }

    .active .svgFill {
        fill: white;
    }

    .active .svg {
        stroke: white;
    }

    .active .svg_arr {
        stroke: white;
    }

    .show .menu_show {
        left: 0;
        transition: all 0.5s ease-in-out;
    }

    .show .show_bg {
        display: block;
    }

    .show .nav_show {
        display: block !important;
    }

    .show .nav_hidden {
        display: none !important;
    }

    /*    */
    @media (max-width: 767px) {
        .sub-nav-help {
            left: 0;
            top: 38px;
        }

        .sub-nav-notify {
            top: 45px;
            right: -160px;
        }

        .sub-nav-user {
            top: 105px;
            right: 15px;
        }
    }
</style>
{{--menu--}}
<div class="menu md:hidden">
    <div class="h-full min-w-[200px]  -left-[300px] fixed menu_show z-20 bg-[#F2F8FF] ">
        <div class="flex items-center justify-center py-3 ">
            <div class="w-[60px] mx-auto">
                <img class="w-full"
                     src="{{asset('image/users/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}"
                     alt="">
            </div>
        </div>
        <div class="px-4 py-3 box-shadow h-full w-[250px] md:w-full max-w-[250px] ">
            <div class="pr-[7px] flex flex-col gap-6 h-full choose-tab">
                {{--                Dashboard--}}
                <a href="{{route('screens.storage.dashboard.index')}}">
                    <div class="flex flex-col gap-3 select-none cursor-pointer tab__menu">
                        <div class="flex items-center">
                            <div class="tab__left rounded-[16px] p-2">
                                <div
                                    class="flex items-center gap-3">
                                    <div class="w-[20px]">
                                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path class="svgFill"
                                                  d="M12.1799 27.6978V23.6208C12.1799 22.58 13.0297 21.7364 14.0781 21.7364H17.9103C18.4137 21.7364 18.8966 21.9349 19.2525 22.2883C19.6085 22.6417 19.8085 23.121 19.8085 23.6208V27.6978C19.8053 28.1304 19.9762 28.5465 20.2833 28.8535C20.5904 29.1606 21.0082 29.3333 21.4441 29.3333H24.0586C25.2797 29.3364 26.4518 28.8571 27.3164 28.001C28.1809 27.145 28.6668 25.9826 28.6668 24.7704V13.1558C28.6668 12.1766 28.2296 11.2477 27.473 10.6195L18.5789 3.56778C17.0317 2.33137 14.815 2.3713 13.314 3.6626L4.62285 10.6195C3.83048 11.2292 3.3569 12.1608 3.3335 13.1558V24.7585C3.3335 27.2851 5.39667 29.3333 7.94173 29.3333H10.4965C11.4018 29.3333 12.1375 28.6082 12.1441 27.7096L12.1799 27.6978Z"
                                                  fill="#B8BED9"/>
                                        </svg>
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <p class="text-[#495057] text-sm text__menu">Tổng quan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                {{--                quan ly sp--}}
                <div data-index="1" class="flex flex-col gap-3 cursor-pointer select-none tab__menu ">
                    <div class="flex items-center">
                        <div class="tab__left rounded-[16px] p-2">
                            <div
                                class="flex items-center gap-3">
                                <div class="w-[18px]">
                                    <svg viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="svg" d="M27 8.25L14.5 2L2 8.25V20.75L14.5 27L27 20.75V8.25Z"
                                              stroke="#B8BED9"
                                              stroke-width="3" stroke-linejoin="round"/>
                                        <path class="svg" d="M2 8.25L14.5 14.5" stroke="#B8BED9" stroke-width="3"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg" d="M14.5 27V14.5" stroke="#B8BED9" stroke-width="3"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path class="svg" d="M27 8.25L14.5 14.5" stroke="#B8BED9" stroke-width="3"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path class="svg" d="M20.75 5.125L8.25 11.375" stroke="#B8BED9" stroke-width="3"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <p class="text-[#495057] text-sm  text__menu">Sản
                                        phẩm</p>
                                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="flex flex-col gap-2 pl-7 text-[#3369D1] text-[12px] font-medium  list hidden">
                        <li class="hover:underline" data-page="/"><a href="{{route('screens.storage.product.index')}}">Tất
                                cả sản phẩm</a>
                        </li>
                        <li class="hover:underline" data-page="create-request"><a
                                href="{{route('screens.storage.product.request')}}">
                                Yêu cầu gửi sản phẩm</a></li>
                        <li class="hover:underline" data-page="create-request"><a
                                href="{{route('screens.storage.product.requestOut')}}">Yêu cầu xuất kho</a></li>
                    </ul>
                </div>
                {{--                Kho hàng--}}
                <div data-index="2" class="flex flex-col gap-3 cursor-pointer select-none tab__menu ">
                    <div class="flex items-center">
                        <div class="tab__left rounded-[16px] p-2">
                            <div
                                class="flex items-center gap-3">
                                <div class="w-[16px]">
                                    <svg viewBox="0 0 26 26" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path class="svgFill"
                                              d="M24.7811 8.78146C24.6303 8.78213 24.4813 8.74532 24.3455 8.67384L12.8999 2.3245L1.4543 8.63079C1.21009 8.75638 0.929982 8.77137 0.6756 8.67248C0.421217 8.57359 0.213397 8.36891 0.0978565 8.10348C-0.0176839 7.83804 -0.0314796 7.53359 0.0595038 7.2571C0.150487 6.98061 0.338797 6.75472 0.583007 6.62914L12.8999 0L25.2168 6.62914C25.4764 6.69507 25.7017 6.8695 25.8439 7.11466C25.986 7.35982 26.0336 7.65598 25.9763 7.93901C25.919 8.22203 25.7615 8.46914 25.5378 8.62681C25.3141 8.78449 25.0422 8.84005 24.7811 8.78146ZM7.94938 19.543H2.00876V26H7.94938V19.543ZM15.8702 19.543H9.92958V26H15.8702V19.543ZM23.791 19.543H17.8504V26H23.791V19.543ZM19.8306 10.9338H13.89V17.3907H19.8306V10.9338ZM11.9098 10.9338H5.96917V17.3907H11.9098V10.9338Z"
                                              fill="#B8BED9"/>
                                    </svg>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <p class="text-[#495057] text-sm  text__menu">Đối tác</p>
                                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="flex flex-col gap-2 pl-7 text-[#3369D1] text-[12px] font-medium  list hidden">
                        <li><a class="hover:underline" href="{{route('screens.storage.partner.index')}}">Danh sách nhà
                                cung cấp</a></li>
                    </ul>
                </div>
                {{--                Quản lý V-Store--}}
                <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none tab__menu ">
                    <div class="flex items-center">
                        <div class="tab__left rounded-[16px] p-2">
                            <div
                                class="flex items-center gap-3">
                                <div class="w-[16px]">
                                    <svg viewBox="0 0 25 19" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path class="svgFill" fill-rule="evenodd" clip-rule="evenodd"
                                              d="M24.9999 0.00058515C24.7478 0.00058515 24.5615 0.00058515 24.3752 0.00058515C22.786 0.00058515 21.2077 0.022814 19.6185 0.00058515C18.2266 -0.0216437 17.2182 0.58965 16.5387 1.80112C15.2016 4.16849 13.8535 6.53587 12.5054 8.90324C12.8123 9.43673 13.1191 9.97022 13.426 10.5148C14.1713 11.8263 15.5742 12.4821 16.9661 12.1042C17.5361 11.9486 18.0622 11.5929 18.5882 11.3373C18.5882 11.3373 18.5882 11.3373 18.5882 11.3484C20.6487 7.73622 22.6983 4.12404 24.7588 0.511849C24.8246 0.356247 24.8903 0.211759 24.9999 0.00058515Z"
                                              fill="#B8BED9"/>
                                        <path class="svgFill"
                                              d="M16.9553 12.0931C15.5634 12.471 14.1605 11.8152 13.4152 10.5037C13.1083 9.97023 12.8014 9.43674 12.4945 8.89213C11.1464 6.52476 9.79835 4.1685 8.46122 1.80113C7.78169 0.589654 6.77336 -0.010525 5.38142 0.0117039C3.7922 0.0339327 2.21395 0.0117039 0.624727 0.0117039C0.438405 0.0117039 0.252083 0.0117039 0 0.0117039C0.109601 0.222878 0.175362 0.367366 0.263043 0.500739C2.33451 4.14627 4.41693 7.7918 6.4884 11.4373C7.52961 13.2601 8.57082 15.094 9.61203 16.9167C10.1162 17.8059 10.8396 18.3727 11.6177 18.6173C12.9768 19.0396 14.5222 18.4728 15.4099 16.9167C16.4731 15.0606 17.5252 13.1934 18.5884 11.3373C18.5884 11.3373 18.5884 11.3373 18.5884 11.3262C18.0513 11.5818 17.5362 11.9375 16.9553 12.0931Z"
                                              fill="#D2D7ED"/>
                                    </svg>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <p class="text-[#495057] text-sm  text__menu">Tài chính</p>
                                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                              stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="flex flex-col gap-2 pl-7 text-[#3369D1] text-[12px] font-medium  list hidden">
                        <li data-page="/"><a class="hover:underline" href="{{route('screens.storage.finance.index')}}">Ví</a>
                        </li>
                        <li data-page="history"><a class="hover:underline"
                                                   href="{{route('screens.storage.finance.history')}}">Lịch sử thay đổi
                                số dư</a>
                        </li>
                        <li><a class="hover:underline" href="{{route('screens.manufacture.order.destroy')}}">Đơn hủy</a>
                        </li>
                        <li><a class="hover:underline" href="{{route('screens.manufacture.order.pending')}}">Trả hàng,
                                hoàn tiền</a></li>
                        <li><a class="hover:underline" href="{{route('screens.manufacture.order.pending')}}">Trả hàng,
                                hoàn
                                tiền</a></li>
                    </ul>
                </div>
                {{--                Tài chính--}}
                <div data-index="5" class="flex flex-col gap-3 cursor-pointer select-none tab__menu ">
                    <div class="flex items-center">
                        <div class="tab__left rounded-[16px] p-2">
                            <div
                                class="flex items-center gap-3">
                                <div class="w-[10px]">
                                    <svg viewBox="0 0 14 25" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path class="svgFill"
                                              d="M7.53635 10.8644C4.41454 10.053 3.41061 9.21415 3.41061 7.90766C3.41061 6.40864 4.79961 5.36346 7.12377 5.36346C9.57171 5.36346 10.4794 6.53242 10.5619 8.25147H13.6012C13.5049 5.88605 12.0609 3.71316 9.18664 3.01179V0H5.0609V2.97053C2.39293 3.54813 0.247544 5.28094 0.247544 7.93517C0.247544 11.112 2.87426 12.6935 6.7112 13.6149C10.1493 14.4401 10.8369 15.6503 10.8369 16.9293C10.8369 17.8782 10.1631 19.391 7.12377 19.391C4.29077 19.391 3.17682 18.1257 3.02554 16.5029H0C0.165029 19.5147 2.42043 21.2063 5.0609 21.7701V24.7544H9.18664V21.7976C11.8684 21.2888 14 19.7348 14 16.9155C14 13.0098 10.6582 11.6758 7.53635 10.8644Z"
                                              fill="#B8BED9"/>
                                    </svg>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <p class="text-[#495057] text-sm  text__menu">Tài chính</p>
                                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                              stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="flex flex-col gap-2 pl-7 text-[#3369D1] text-[12px] font-medium  list hidden">
                        <li><a class="hover:underline" href="{{route('screens.manufacture.finance.index')}}">Ví</a></li>
                        <li><a class="hover:underline" href="{{route('screens.manufacture.finance.history')}}">Lịch sử thay đổi số dư</a></li>
                        <!-- <li><a class="hover:underline" href="{{route('screens.manufacture.finance.history')}}">Doanh
                                thu</a>
                        </li> -->
                    </ul>
                </div>

                <div data-index="5" class="flex flex-col gap-3 cursor-pointer select-none tab__menu ">
                    <div class="flex items-center">
                        <div class="tab__left rounded-[16px] p-2">
                            <div
                                class="flex items-center gap-3">
                                <div class="w-[10px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path class="svgFill" fill="#B8BED9"
                                              d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                                    </svg>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <p class="text-[#495057] text-sm  text__menu">Tài khoản</p>
                                    <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                              stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="flex flex-col gap-2 pl-7 text-[#3369D1] text-[12px] font-medium  list hidden">
                        <li data-page="/"><a class="hover:underline" href="{{route('screens.manufacture.account.profile')}}">Hồ sơ của tôi</a></li>
                        <li data-page="change-password"><a class="hover:underline" href="{{route('screens.manufacture.account.changePassword')}}">Đổi mật khẩu</a>
                        </li>
                    </ul>
                </div>
                {{--                log out--}}
                <div data-index="6" class="flex flex-col gap-3 cursor-pointer">
                    <div class="flex items-center">
                        <div class="tab__left rounded-[16px] p-2">
                            <div
                                class="flex items-center gap-3">
                                <div class="flex gap-2 items-center">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.324 2.66669C18.634 2.66669 21.3337 5.32002 21.3337 8.58669V14.9734H13.1941C12.6108 14.9734 12.1496 15.4267 12.1496 16C12.1496 16.56 12.6108 17.0267 13.1941 17.0267H21.3337V23.4C21.3337 26.6667 18.634 29.3334 15.2968 29.3334H8.69025C5.3666 29.3334 2.66699 26.68 2.66699 23.4134V8.60002C2.66699 5.32002 5.38017 2.66669 8.70381 2.66669H15.324ZM24.7206 11.4003C25.1206 10.987 25.7739 10.987 26.1739 11.387L30.0673 15.267C30.2673 15.467 30.3739 15.7203 30.3739 16.0003C30.3739 16.267 30.2673 16.5336 30.0673 16.7203L26.1739 20.6003C25.9739 20.8003 25.7073 20.907 25.4539 20.907C25.1873 20.907 24.9206 20.8003 24.7206 20.6003C24.3206 20.2003 24.3206 19.547 24.7206 19.147L26.8539 17.027H21.3339V14.9736H26.8539L24.7206 12.8536C24.3206 12.4536 24.3206 11.8003 24.7206 11.4003Z"
                                            fill="#FF4842"/>
                                    </svg>
                                    <a href="{{route('logout')}}">
                                        <p class="text-[#FF4842] text-sm font-bold a">Đăng xuất</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed h-full w-full z-10 bg-[#00000066] hidden left-0 top-0 show_bg"></div>
</div>
{{--hedder--}}
<header class="menu block md:hidden ">
    <div class="bg-[#E6F7FF] w-full py-4 flex justify-between items-center px-4 shadow-lg">
        <a href="{{route('screens.storage.dashboard.index')}}" class="">
            <div class="w-[180px] h-[36px]">
                <img class="w-full object-contain" src="{{asset('home/img/titleK.png')}}" alt="">
            </div>
        </a>
        <div class="w-[24px] cursor-pointer nav_hidden" id="nav">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                    d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
            </svg>
        </div>
        <div class="w-[24px] hidden nav_show">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path
                    d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/>
            </svg>
        </div>
    </div>
    <div class="py-3 px-5">
        <div class="flex justify-end items-center flex-wrap md:flex-nowrap gap-4 md:gap-0">
            <div class="flex justify-end gap-6 items-center xl:gap-6">
                <div class="notify relative cursor-pointer">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.2841 25.6372C13.9506 25.4962 18.0122 25.4962 18.6788 25.6372C19.2486 25.7688 19.8648 26.0763 19.8648 26.7477C19.8316 27.387 19.4566 27.9536 18.9385 28.3135C18.2666 28.8373 17.4782 29.169 16.6539 29.2885C16.1981 29.3476 15.7502 29.3489 15.3102 29.2885C14.4847 29.169 13.6962 28.8373 13.0257 28.3122C12.5062 27.9536 12.1312 27.387 12.0981 26.7477C12.0981 26.0763 12.7143 25.7688 13.2841 25.6372ZM16.0601 2.66663C18.8337 2.66663 21.6668 3.98265 23.3498 6.16618C24.4417 7.57218 24.9426 8.97683 24.9426 11.1604V11.7284C24.9426 13.403 25.3852 14.39 26.3592 15.5274C27.0973 16.3654 27.3332 17.441 27.3332 18.608C27.3332 19.7736 26.9502 20.8801 26.1829 21.7785C25.1785 22.8555 23.7619 23.5431 22.3162 23.6626C20.2211 23.8412 18.1247 23.9916 16.0005 23.9916C13.875 23.9916 11.7799 23.9016 9.68484 23.6626C8.23778 23.5431 6.8212 22.8555 5.81806 21.7785C5.0508 20.8801 4.6665 19.7736 4.6665 18.608C4.6665 17.441 4.90371 16.3654 5.64049 15.5274C6.64495 14.39 7.0584 13.403 7.0584 11.7284V11.1604C7.0584 8.91775 7.61761 7.45132 8.76916 6.01578C10.4813 3.92222 13.2256 2.66663 15.9409 2.66663H16.0601Z"
                            fill="#637381"/>
                    </svg>
                    <div class="w-[10px] h-[10px] bg-[#FF4842] rounded-[50%] absolute top-1.5 right-0"></div>
                    <ul class="sub-nav-notify">
                        <div class="flex justify-between items-center w-full pb-3 px-3">
                            <h2 class="text-xl font-normal text-title">Thông báo</h2>
                            <a href="{{route('ncc_all_noti')}}"
                               class="hover:text-primary duration-200 transition-all text-title font-medium">Tất
                                cả</a>
                        </div>
                        @if(count(Auth::user()->unreadNotifications) > 0)
                            @foreach (Auth::user()->unreadNotifications as $index =>$notification)
                                <li>
                                    <a href="{{$notification['data']['href']}}?noti_id={{$notification->id}}"
                                       class="flex justify-between items-center w-full text-sm text-title font-bold"><span>{{$notification['data']['message']}} </span>
                                        <span>{{\Illuminate\Support\Carbon::parse($notification->created_at)->format('h:i A')}} </span></a>
                                </li>
                            @endforeach
                        @else
                            <div class="text-center"><p>Bạn chưa có thông báo mới nào</p></div>
                        @endif
                    </ul>
                </div>
                <div class="user flex items-center gap-2">
                    <div class="w-[51px]">
                        <div class="w-[50px] h-[65px] ">
                            <img class="w-full cursor-pointer"
                                 src="{{asset('asset/images/userkho.png')}}" class="w-full">
                        </div>
                    </div>

                    <p class="text-black 2xl:text-base xl:text-sm font-medium cursor-pointer">
                        ID:{{\Illuminate\Support\Facades\Auth::user()->account_code}}</p>

                    <ul class="sub-nav-user">
                        <li><a href="{{route('screens.manufacture.account.profile')}}"
                               class="font-medium flex justify-start items-center gap-2">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 20C5.33579 17.5226 8.50702 16 12 16C15.493 16 18.6642 17.5226 21 20M16.5 7.5C16.5 9.98528 14.4853 12 12 12C9.51472 12 7.5 9.98528 7.5 7.5C7.5 5.01472 9.51472 3 12 3C14.4853 3 16.5 5.01472 16.5 7.5Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                                Thông tin tài khoản</a></li>
                        <li><a href="{{route('logout')}}"
                               class="font-medium flex justify-start items-center gap-2 ">
                                <svg fill="#FF4D4F" height="18" width="18" version="1.1" id="Capa_1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 384.971 384.971" xml:space="preserve">
                                   <g>
                                       <g id="Sign_Out">
                                           <path d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03
                                               C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03
                                               C192.485,366.299,187.095,360.91,180.455,360.91z"/>
                                           <path d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279
                                               c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179
                                               c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z"/>
                                       </g>
                                       <g>
                                       </g>
                                       <g>
                                       </g>
                                       <g>
                                       </g>
                                       <g>
                                       </g>
                                       <g>
                                       </g>
                                       <g>
                                       </g>
                                   </g>
                                   </svg>
                                Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

