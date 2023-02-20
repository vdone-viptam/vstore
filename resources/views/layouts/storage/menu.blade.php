<style>
    .active .tab__left {
        background: #4062FF;
    }

    .active.text__menu {
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

    .choose-tab::-webkit-scrollbar-track {
        background: #F2F8FF;
    }

    @media screen and (min-width: 768px) {
        .tab__hover:hover .text__menu {
            color: #4062FF;
            font-weight: 600;
        }

        .tab__hover:hover .svg {
            stroke: #4062FF;
        }

        .tab__hover:hover .svgFill {
            fill: #4062FF;
        }

        .tab__hover:hover .svg_arr {
            stroke: #4062FF;
        }
    }
</style>
<div class="bg-[#F2F8FF] fixed left-0 h-screen md:block hidden z-[7]">

    <a href="{{route('screens.manufacture.dashboard.index')}}" class="">
        <div class="w-[195px] h-[45px] mx-auto my-6">
            <img class="w-full" src="{{asset('asset/images/Logoncc.png')}}" alt="">
        </div>
    </a>
    <div class="pr-[15px] flex flex-col gap-2 h-full choose-tab w-full max-h-[700px] ">
        {{--      Dashboard--}}
        <a href="{{route('screens.storage.dashboard.index')}}">
            <div class="flex flex-col gap-3 select-none cursor-pointer tab__menu tab__hover">
                <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                    <div
                        class="tab__left rounded-tr-[16px] rounded-br-[16px] xl:min-w-[12px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                    <div class="tab__left rounded-[16px]">
                        <div
                            class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                            <div class="md:w-[20px] xl:w-[32px]">
                                <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="svgFill"
                                          d="M12.1799 27.6978V23.6208C12.1799 22.58 13.0297 21.7364 14.0781 21.7364H17.9103C18.4137 21.7364 18.8966 21.9349 19.2525 22.2883C19.6085 22.6417 19.8085 23.121 19.8085 23.6208V27.6978C19.8053 28.1304 19.9762 28.5465 20.2833 28.8535C20.5904 29.1606 21.0082 29.3333 21.4441 29.3333H24.0586C25.2797 29.3364 26.4518 28.8571 27.3164 28.001C28.1809 27.145 28.6668 25.9826 28.6668 24.7704V13.1558C28.6668 12.1766 28.2296 11.2477 27.473 10.6195L18.5789 3.56778C17.0317 2.33137 14.815 2.3713 13.314 3.6626L4.62285 10.6195C3.83048 11.2292 3.3569 12.1608 3.3335 13.1558V24.7585C3.3335 27.2851 5.39667 29.3333 7.94173 29.3333H10.4965C11.4018 29.3333 12.1375 28.6082 12.1441 27.7096L12.1799 27.6978Z"
                                          fill="#B8BED9"/>
                                </svg>
                            </div>
                            <div class="flex gap-2 items-center">
                                <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Tổng quan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        {{--        quan ly sp--}}
        <div data-index="1" class="flex flex-col gap-3 cursor-pointer select-none tab__menu tab__hover">
            <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                <div
                    class="tab__left xl:min-w-[12px] rounded-tr-[16px] rounded-br-[16px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div
                        class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                        <div class="lg:w-[22px] md:w-[18px] xl:w-[29px]">
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
                            <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Quản lý sản
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-8 list hidden md:max-w-[150px] xl:max-w-[230px]">
                <li class="hover:underline" data-page="/"><a href="{{route('screens.storage.product.index')}}">Tất
                        cả sản phẩm</a>
                </li>
                <li class="hover:underline" data-page="create-request"><a
                        href="{{route('screens.storage.product.request')}}">
                        Yêu cầu gửi sản phẩm</a></li>
            </ul>
        </div>
        {{-- Đối tác --}}
        <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none tab__menu tab__hover">
            <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                <div
                    class="tab__left xl:min-w-[12px] rounded-tr-[16px] rounded-br-[16px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div
                        class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                        <div class="md:w-[16px] lg:w-[20px] xl:w-[25px] ">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <path class="svgFill" fill="#B8BED9"
                                      d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z"/>
                            </svg>
                        </div>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Đối tác</p>
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-16  list hidden xl:max-w-[230px] md:max-w-[150px]">
                <li data-page="/"><a class="hover:underline" href="{{Route('screens.storage.partner.index')}}">Danh sách nhà cung cấp</a></li>

            </ul>
        </div>
        {{-- Tài chính --}}
        <div class="flex flex-col gap-3 cursor-pointer select-none tab__menu tab__hover">
            <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                <div
                    class="tab__left xl:min-w-[12px] rounded-tr-[16px] rounded-br-[16px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div
                        class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                        <div class="md:w-[18px] lg:w-[22px] md:h-[22px]">
                            <svg viewBox="0 0 25 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1_4)">
                                    <path class="svgFill"
                                          d="M13.2008 10.9942C8.97531 10.1731 7.61644 9.32417 7.61644 8.00208C7.61644 6.48517 9.49652 5.4275 12.6424 5.4275C15.9558 5.4275 17.1844 6.61042 17.2961 8.35H21.4099C21.2796 5.95633 19.3251 3.7575 15.4346 3.04775V0H9.8502V3.006C6.23895 3.5905 3.33506 5.344 3.33506 8.02992C3.33506 11.2447 6.89047 12.8451 12.084 13.7775C16.7376 14.6125 17.6684 15.8372 17.6684 17.1314C17.6684 18.0917 16.7563 19.6225 12.6424 19.6225C8.80778 19.6225 7.29999 18.3422 7.09523 16.7H3C3.22338 19.7477 6.27618 21.4595 9.8502 22.0301V25.05H15.4346V22.0579C19.0645 21.543 21.9497 19.9704 21.9497 17.1175C21.9497 13.1652 17.4264 11.8152 13.2008 10.9942Z"
                                          fill="#B8BED9"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_4">
                                        <rect width="25" height="25" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Tài chính</p>
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-8 list hidden md:max-w-[150px] xl:max-w-[230px] ">
                <li data-page="/"><a class="hover:underline" href="{{route('screens.storage.finance.index')}}">Ví</a></li>
                <li data-page="history"><a class="hover:underline" href="{{route('screens.storage.finance.history')}}">Lịch sử thay đổi
                        số dư</a>
                </li>

            </ul>
        </div>
        <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none tab__menu tab__hover">
            <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                <div
                    class="tab__left xl:min-w-[12px] rounded-tr-[16px] rounded-br-[16px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div
                        class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                        <div class="md:w-[16px] lg:w-[20px] md:h-[22px]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path class="svgFill" fill="#B8BED9"
                                      d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                            </svg>
                        </div>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Tài khoản</p>
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-8 list hidden md:max-w-[150px] xl:max-w-[230px] ">
                <li data-page="/"><a class="hover:underline" href="{{route('screens.storage.account.profile')}}">Hồ sơ của
                        tôi</a></li>
                <li data-page="change-password"><a class="hover:underline"
                                                   href="{{route('screens.storage.account.changePassword')}}">Đổi mật
                        khẩu</a>
                </li>

            </ul>
        </div>

        {{--        Kho hàng--}}
    </div>

</div>
