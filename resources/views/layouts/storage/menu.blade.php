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

    .choose-tab::-webkit-scrollbar-track{
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
        <a href="{{route('screens.manufacture.dashboard.index')}}">
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
                <li class="hover:underline" data-page="/"><a href="{{route('screens.manufacture.product.index')}}">Tất
                        cả sản phẩm</a>
                </li>
                <li class="hover:underline" data-page="create-request"><a href="{{route('screens.manufacture.product.createRequest')}}"
                    Yêu cầu gửi sản phẩm</a></li>
            </ul>
        </div>
        {{--        Kho hàng--}}
    </div>

</div>
