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
</style>
<div class="bg-[#F2F8FF] sticky left-0 h-full">
    <a href="" class="">
        <div class=" flex items-center justify-center py-9">
            <img class="" src="{{asset('asset/images/logo.png')}}" alt="">
        </div>
    </a>
    <div class="pr-[7px] flex flex-col gap-6 h-full choose-tab">
        {{--      Tổng quan--}}
        <a href="{{route('screens.vstore.dashboard.index')}}">
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
                                <p class="text-[#B8BED9] xl:text-base lg:text-sm md:text-xs text__menu">Tổng quan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        {{--      Hàng hóa--}}
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
                            <p class="text-[#B8BED9] xl:text-base lg:text-sm md:text-xs text__menu">Hàng hóa</p>
                            <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                      stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <ul class=" flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-16 list-disc list hidden">
                <li><a href="{{route('screens.vstore.product.request')}}">Tất cả sản phẩm</a></li>
                <li><a href="{{route('screens.vstore.product.request')}}">Quản lý yêu cầu xét duyệt sản phẩm</a></li>
            </ul>
        </div>
        {{--       Quản lý đơn hàng--}}
        <div data-index="2" class="flex flex-col gap-3 cursor-pointer select-none tab__menu tab__hover">
            <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                <div
                    class="tab__left xl:min-w-[12px] rounded-tr-[16px] rounded-br-[16px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div
                        class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                        <div class="md:w-[16px] lg:w-[20px] xl:w-[26px]">
                            <svg viewBox="0 0 26 26" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="svgFill"
                                      d="M24.7811 8.78146C24.6303 8.78213 24.4813 8.74532 24.3455 8.67384L12.8999 2.3245L1.4543 8.63079C1.21009 8.75638 0.929982 8.77137 0.6756 8.67248C0.421217 8.57359 0.213397 8.36891 0.0978565 8.10348C-0.0176839 7.83804 -0.0314796 7.53359 0.0595038 7.2571C0.150487 6.98061 0.338797 6.75472 0.583007 6.62914L12.8999 0L25.2168 6.62914C25.4764 6.69507 25.7017 6.8695 25.8439 7.11466C25.986 7.35982 26.0336 7.65598 25.9763 7.93901C25.919 8.22203 25.7615 8.46914 25.5378 8.62681C25.3141 8.78449 25.0422 8.84005 24.7811 8.78146ZM7.94938 19.543H2.00876V26H7.94938V19.543ZM15.8702 19.543H9.92958V26H15.8702V19.543ZM23.791 19.543H17.8504V26H23.791V19.543ZM19.8306 10.9338H13.89V17.3907H19.8306V10.9338ZM11.9098 10.9338H5.96917V17.3907H11.9098V10.9338Z"
                                      fill="#B8BED9"/>
                            </svg>
                        </div>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#B8BED9] xl:text-base lg:text-sm md:text-xs text__menu">Quản lý đơn hàng</p>
                            <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                      stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-16 list-disc list hidden">
                <li><a href="{{Route('screens.vstore.order.new')}}">Đơn hàng mới</a></li>
                <li><a href="{{Route('screens.vstore.order.index')}}">Tất cả đơn hàng</a></li>
            </ul>
        </div>
        {{--        Tài chính--}}
        <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none tab__menu tab__hover">
            <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                <div
                    class="tab__left xl:min-w-[12px] rounded-tr-[16px] rounded-br-[16px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div
                        class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                        <div class="md:w-[16px] lg:w-[20px] xl:w-[25px] ">
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
                            <p class="text-[#B8BED9] xl:text-base lg:text-sm md:text-xs text__menu">Tài chính</p>
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-16 list-disc list hidden">
                <li><a href="{{Route('screens.vstore.finance.index')}}">Ví</a></li>
                <li><a href="{{Route('screens.vstore.finance.revenue')}}">Doanh thu</a></li>
            </ul>
        </div>
        {{--        log out--}}
        <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none ">
            <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                <div
                    class="tab__left xl:min-w-[12px] rounded-tr-[16px] rounded-br-[16px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div
                        class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                        <div class="flex gap-4 items-center">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.324 2.66669C18.634 2.66669 21.3337 5.32002 21.3337 8.58669V14.9734H13.1941C12.6108 14.9734 12.1496 15.4267 12.1496 16C12.1496 16.56 12.6108 17.0267 13.1941 17.0267H21.3337V23.4C21.3337 26.6667 18.634 29.3334 15.2968 29.3334H8.69025C5.3666 29.3334 2.66699 26.68 2.66699 23.4134V8.60002C2.66699 5.32002 5.38017 2.66669 8.70381 2.66669H15.324ZM24.7206 11.4003C25.1206 10.987 25.7739 10.987 26.1739 11.387L30.0673 15.267C30.2673 15.467 30.3739 15.7203 30.3739 16.0003C30.3739 16.267 30.2673 16.5336 30.0673 16.7203L26.1739 20.6003C25.9739 20.8003 25.7073 20.907 25.4539 20.907C25.1873 20.907 24.9206 20.8003 24.7206 20.6003C24.3206 20.2003 24.3206 19.547 24.7206 19.147L26.8539 17.027H21.3339V14.9736H26.8539L24.7206 12.8536C24.3206 12.4536 24.3206 11.8003 24.7206 11.4003Z"
                                    fill="#FF4842"/>
                            </svg>
                            <a href="{{route('logout')}}">
                                <p class="text-[#FF4842] text-base font-bold a">Logout</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
