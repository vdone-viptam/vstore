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

    .choose-tab::-webkit-scrollbar-track {
        background: #F2F8FF;
    }
</style>
<div class="bg-[#F2F8FF] fixed left-0 h-full md:block hidden z-[7]">
    <a href="{{route('screens.admin.dashboard.index')}}" class="">
        <div class=" w-[178px] h-[85px] mx-auto my-6">
            {{--            <svg viewBox="0 0 162 40" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
            {{--                <path fill-rule="evenodd" clip-rule="evenodd"--}}
            {{--                      d="M43.9944 7.0003C43.5508 7.0003 43.2229 7.0003 42.895 7.0003C40.0983 7.0003 37.321 7.03941 34.5243 7.0003C32.0748 6.96118 30.3004 8.03692 29.1046 10.1688C26.7515 14.3349 24.3792 18.5009 22.0068 22.6669C22.5469 23.6057 23.0869 24.5446 23.627 25.5029C24.9385 27.8109 27.4073 28.9649 29.8568 28.2999C30.8597 28.026 31.7855 27.4002 32.7113 26.9503C32.7113 26.9503 32.7113 26.9503 32.7113 26.9699C36.3373 20.6132 39.944 14.2566 43.57 7.9C43.6858 7.62618 43.8015 7.37192 43.9944 7.0003Z"--}}
            {{--                      fill="#006AFF"></path>--}}
            {{--                <path--}}
            {{--                    d="M29.8374 28.2803C27.388 28.9453 24.9192 27.7913 23.6077 25.4834C23.0676 24.5446 22.5276 23.6057 21.9875 22.6474C19.6152 18.4813 17.2428 14.3348 14.8898 10.1688C13.694 8.03691 11.9195 6.98073 9.47006 7.01985C6.6734 7.05896 3.89603 7.01985 1.09938 7.01985C0.771492 7.01985 0.443608 7.01985 0 7.01985C0.192873 7.39146 0.308597 7.64573 0.462895 7.88044C4.10819 14.2957 7.77278 20.711 11.4181 27.1263C13.2504 30.334 15.0827 33.5612 16.915 36.7688C17.8022 38.3335 19.0751 39.331 20.4445 39.7613C22.8362 40.5046 25.5557 39.5071 27.1179 36.7688C28.9888 33.5025 30.8404 30.2166 32.7113 26.9503C32.7113 26.9503 32.7113 26.9503 32.7113 26.9307C31.7662 27.3806 30.8597 28.0065 29.8374 28.2803Z"--}}
            {{--                    fill="#40A9FF"></path>--}}
            {{--                <path--}}
            {{--                    d="M41.4 24.276H50.024V28.364H41.4V24.276ZM70.2682 35.28C68.7749 35.28 67.3096 35.028 65.8722 34.524C64.4349 34.0013 63.1282 33.208 61.9522 32.144L64.5002 29.092C65.3962 29.82 66.3109 30.3987 67.2442 30.828C68.1962 31.2573 69.2322 31.472 70.3522 31.472C71.2482 31.472 71.9389 31.3133 72.4242 30.996C72.9282 30.66 73.1802 30.2027 73.1802 29.624V29.568C73.1802 29.288 73.1242 29.0453 73.0122 28.84C72.9189 28.616 72.7229 28.4107 72.4242 28.224C72.1442 28.0373 71.7429 27.8507 71.2202 27.664C70.7162 27.4773 70.0536 27.2813 69.2322 27.076C68.2429 26.8333 67.3469 26.5627 66.5442 26.264C65.7416 25.9653 65.0602 25.6013 64.5002 25.172C63.9402 24.724 63.5016 24.1733 63.1842 23.52C62.8856 22.8667 62.7362 22.0547 62.7362 21.084V21.028C62.7362 20.132 62.9042 19.3293 63.2402 18.62C63.5762 17.892 64.0429 17.2667 64.6402 16.744C65.2562 16.2213 65.9842 15.82 66.8242 15.54C67.6642 15.26 68.5882 15.12 69.5962 15.12C71.0336 15.12 72.3496 15.3347 73.5442 15.764C74.7576 16.1933 75.8682 16.8093 76.8762 17.612L74.6362 20.86C73.7589 20.2627 72.9002 19.796 72.0602 19.46C71.2202 19.1053 70.3802 18.928 69.5402 18.928C68.7002 18.928 68.0656 19.096 67.6362 19.432C67.2256 19.7493 67.0202 20.1507 67.0202 20.636V20.692C67.0202 21.0093 67.0762 21.2893 67.1882 21.532C67.3189 21.756 67.5429 21.9613 67.8602 22.148C68.1776 22.3347 68.6069 22.512 69.1482 22.68C69.7082 22.848 70.4082 23.044 71.2482 23.268C72.2376 23.5293 73.1149 23.828 73.8802 24.164C74.6642 24.4813 75.3176 24.8733 75.8402 25.34C76.3816 25.788 76.7829 26.32 77.0442 26.936C77.3242 27.552 77.4642 28.2893 77.4642 29.148V29.204C77.4642 30.1747 77.2869 31.0427 76.9322 31.808C76.5776 32.5547 76.0829 33.1893 75.4482 33.712C74.8136 34.216 74.0576 34.608 73.1802 34.888C72.3029 35.1493 71.3322 35.28 70.2682 35.28ZM85.9202 19.376H79.9562V15.4H96.1962V19.376H90.2322V35H85.9202V19.376ZM108.745 35.336C107.233 35.336 105.842 35.0747 104.573 34.552C103.303 34.0107 102.202 33.292 101.269 32.396C100.354 31.4813 99.6355 30.4173 99.1128 29.204C98.6088 27.972 98.3568 26.656 98.3568 25.256V25.2C98.3568 23.8 98.6181 22.4933 99.1408 21.28C99.6635 20.048 100.382 18.9747 101.297 18.06C102.23 17.1267 103.331 16.3987 104.601 15.876C105.889 15.3347 107.289 15.064 108.801 15.064C110.313 15.064 111.703 15.3347 112.973 15.876C114.242 16.3987 115.334 17.1173 116.249 18.032C117.182 18.928 117.901 19.992 118.405 21.224C118.927 22.4373 119.189 23.744 119.189 25.144V25.2C119.189 26.6 118.927 27.916 118.405 29.148C117.882 30.3613 117.154 31.4347 116.221 32.368C115.306 33.2827 114.205 34.0107 112.917 34.552C111.647 35.0747 110.257 35.336 108.745 35.336ZM108.801 31.36C109.659 31.36 110.453 31.2013 111.181 30.884C111.909 30.5667 112.525 30.128 113.029 29.568C113.551 29.008 113.953 28.364 114.233 27.636C114.531 26.8893 114.681 26.096 114.681 25.256V25.2C114.681 24.36 114.531 23.5667 114.233 22.82C113.953 22.0733 113.542 21.42 113.001 20.86C112.478 20.3 111.853 19.8613 111.125 19.544C110.397 19.208 109.603 19.04 108.745
            19.04C107.867 19.04 107.065 19.1987 106.337 19.516C105.627 19.8333 105.011 20.272 104.489 20.832C103.985 21.392 103.583 22.0453 103.285 22.792C103.005 23.52 102.865 24.304 102.865 25.144V25.2C102.865 26.04 103.005 26.8333 103.285 27.58C103.583 28.3267 103.994 28.98 104.517 29.54C105.058 30.1 105.683 30.548 106.393 30.884C107.121 31.2013 107.923 31.36 108.801 31.36ZM123.574 15.4H132.534C135.017 15.4 136.921 16.0627 138.246 17.388C139.366 18.508 139.926 20.0013 139.926 21.868V21.924C139.926 23.5107 139.534 24.808 138.75 25.816C137.985 26.8053 136.977 27.5333 135.726 28L140.514 35H135.474L131.274 28.728H127.886V35H123.574V15.4ZM132.254 24.92C133.318 24.92 134.13 24.668 134.69 24.164C135.269 23.66 135.558 22.988 135.558 22.148V22.092C135.558 21.1587 135.259 20.4587 134.662 19.992C134.065 19.5253 133.234 19.292 132.17 19.292H127.886V24.92H132.254ZM144.368 15.4H159.152V19.236H148.652V23.212H157.892V27.048H148.652V31.164H159.292V35H144.368V15.4Z"--}}
            {{--                    fill="#002766"></path>--}}
            {{--            </svg>--}}
            <img src="{{asset('home/img/logo-06.png')}}" class="w-full object-fill" alt="">
        </div>
    </a>
    <div class="pr-[7px] flex flex-col gap-6 h-full choose-tab w-full max-h-[700px] overflow-y-scroll">
        {{--      Tổng quan--}}
        <a href="{{route('screens.admin.dashboard.index')}}">
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
                            <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Sản
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-16 list hidden xl:max-w-[230px] md:max-w-[200px]">

                <li data-page="index" class="hover:underline"><a href="{{route('screens.admin.product.index')}}">Quản lý
                        yêu cầu
                        xét duyệt
                        phẩm</a></li>
            </ul>
        </div>
        {{--                Danh mục--}}
        <a href="{{route('screens.admin.category.index')}}">
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
                                <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Ngành hàng</p>
                                <svg width="0" height="6" viewBox="0 0 11 6" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        {{--        Quản lý tài khoản--}}
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
                            <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Quản lý tài
                                khoản</p>
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-16 list hidden xl:max-w-[230px] md:max-w-[200px]">
                <li data-page="/"><a class="hover:underline" href="{{route('screens.admin.user.list_user')}}">Danh sách
                        tài
                        khoản</a></li>
                <li data-page="register-account"><a class="hover:underline"
                                                    href="{{route('screens.admin.user.index')}}">Danh sách đơn đăng
                        ký tài khoản </a>
                <li data-page="request-change-tax-code"><a class="hover:underline"
                                                           href="{{route('screens.admin.user.tax_code')}}">Yêu cầu cập
                        nhật mã số thuế</a>
                </li>
            </ul>
        </div>

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
                <li data-page="request-deposit"><a class="hover:underline"
                                                   href="{{route('screens.admin.finance.index')}}">Yêu cầu rút tiền</a>
                </li>

            </ul>
        </div>
        {{--        Tài khoản--}}
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
                <li data-page="/"><a class="hover:underline" href="{{route('screens.admin.account.profile')}}">Hồ sơ của
                        tôi</a></li>
                <li data-page="change-password"><a class="hover:underline"
                                                   href="{{route('screens.admin.account.changePassword')}}">Đổi mật
                        khẩu</a>
                </li>
                <li data-page="banners"><a class="hover:underline" href="{{route('screens.admin.banner.index')}}">Quản
                        lý banner</a></li>

            </ul>
        </div>
        {{--        log out--}}
        <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none">
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
                                <p class="text-[#FF4842] text-base font-bold a">Đăng xuất</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
