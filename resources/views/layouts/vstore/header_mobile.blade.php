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
    @media (min-width: 320px) and (max-width: 769.99px) {
        .sub-nav-help {
            left: 0;
            top: 38px;
        }

        .sub-nav-notify {
            top: 45px;
            right: -145px;
        }

        .sub-nav-user {
            top: 100px;
            right: 15px;
        }
    }
</style>
{{--menu--}}
<div class="menu md:hidden">
    <div class="h-[100vh] min-w-[200px] fixed -left-[300px] menu_show z-20 bg-[#F2F8FF] ">
        <div class="flex items-center justify-center py-3 border-b ">
            <div class="w-[110px]">
                <svg viewBox="0 0 162 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M43.9944 7.0003C43.5507 7.0003 43.2229 7.0003 42.895 7.0003C40.0983 7.0003 37.321 7.03941 34.5243 7.0003C32.0748 6.96118 30.3004 8.03692 29.1046 10.1688C26.7515 14.3349 24.3792 18.5009 22.0068 22.6669C22.5469 23.6057 23.0869 24.5446 23.627 25.5029C24.9385 27.8109 27.4073 28.9649 29.8568 28.2999C30.8597 28.026 31.7855 27.4002 32.7113 26.9503C32.7113 26.9503 32.7113 26.9503 32.7113 26.9699C36.3373 20.6132 39.944 14.2566 43.57 7.9C43.6858 7.62618 43.8015 7.37191 43.9944 7.0003Z"
                          fill="#006AFF"/>
                    <path
                        d="M29.8374 28.2803C27.388 28.9453 24.9192 27.7913 23.6077 25.4834C23.0676 24.5446 22.5276 23.6057 21.9875 22.6474C19.6152 18.4813 17.2428 14.3348 14.8898 10.1688C13.694 8.03691 11.9195 6.98073 9.47006 7.01985C6.6734 7.05896 3.89603 7.01985 1.09938 7.01985C0.771492 7.01985 0.443608 7.01985 0 7.01985C0.192873 7.39146 0.308597 7.64573 0.462895 7.88044C4.10819 14.2957 7.77278 20.711 11.4181 27.1263C13.2504 30.334 15.0827 33.5612 16.915 36.7688C17.8022 38.3335 19.0751 39.331 20.4445 39.7613C22.8362 40.5046 25.5557 39.5071 27.1179 36.7688C28.9888 33.5025 30.8404 30.2166 32.7113 26.9503C32.7113 26.9503 32.7113 26.9503 32.7113 26.9307C31.7662 27.3806 30.8597 28.0065 29.8374 28.2803Z"
                        fill="#40A9FF"/>
                    <path
                        d="M41.4 24.276H50.024V28.364H41.4V24.276ZM70.2682 35.28C68.7749 35.28 67.3096 35.028 65.8722 34.524C64.4349 34.0013 63.1282 33.208 61.9522 32.144L64.5002 29.092C65.3962 29.82 66.3109 30.3987 67.2442 30.828C68.1962 31.2573 69.2322 31.472 70.3522 31.472C71.2482 31.472 71.9389 31.3133 72.4242 30.996C72.9282 30.66 73.1802 30.2027 73.1802 29.624V29.568C73.1802 29.288 73.1242 29.0453 73.0122 28.84C72.9189 28.616 72.7229 28.4107 72.4242 28.224C72.1442 28.0373 71.7429 27.8507 71.2202 27.664C70.7162 27.4773 70.0536 27.2813 69.2322 27.076C68.2429 26.8333 67.3469 26.5627 66.5442 26.264C65.7416 25.9653 65.0602 25.6013 64.5002 25.172C63.9402 24.724 63.5016 24.1733 63.1842 23.52C62.8856 22.8667 62.7362 22.0547 62.7362 21.084V21.028C62.7362 20.132 62.9042 19.3293 63.2402 18.62C63.5762 17.892 64.0429 17.2667 64.6402 16.744C65.2562 16.2213 65.9842 15.82 66.8242 15.54C67.6642 15.26 68.5882 15.12 69.5962 15.12C71.0336 15.12 72.3496 15.3347 73.5442 15.764C74.7576 16.1933 75.8682 16.8093 76.8762 17.612L74.6362 20.86C73.7589 20.2627 72.9002 19.796 72.0602 19.46C71.2202 19.1053 70.3802 18.928 69.5402 18.928C68.7002 18.928 68.0656 19.096 67.6362 19.432C67.2256 19.7493 67.0202 20.1507 67.0202 20.636V20.692C67.0202 21.0093 67.0762 21.2893 67.1882 21.532C67.3189 21.756 67.5429 21.9613 67.8602 22.148C68.1776 22.3347 68.6069 22.512 69.1482 22.68C69.7082 22.848 70.4082 23.044 71.2482 23.268C72.2376 23.5293 73.1149 23.828 73.8802 24.164C74.6642 24.4813 75.3176 24.8733 75.8402 25.34C76.3816 25.788 76.7829 26.32 77.0442 26.936C77.3242 27.552 77.4642 28.2893 77.4642 29.148V29.204C77.4642 30.1747 77.2869 31.0427 76.9322 31.808C76.5776 32.5547 76.0829 33.1893 75.4482 33.712C74.8136 34.216 74.0576 34.608 73.1802 34.888C72.3029 35.1493 71.3322 35.28 70.2682 35.28ZM85.9202 19.376H79.9562V15.4H96.1962V19.376H90.2322V35H85.9202V19.376ZM108.745 35.336C107.233 35.336 105.842 35.0747 104.573 34.552C103.303 34.0107 102.202 33.292 101.269 32.396C100.354 31.4813 99.6355 30.4173 99.1128 29.204C98.6088 27.972 98.3568 26.656 98.3568 25.256V25.2C98.3568 23.8 98.6181 22.4933 99.1408 21.28C99.6635 20.048 100.382 18.9747 101.297 18.06C102.23 17.1267 103.331 16.3987 104.601 15.876C105.889 15.3347 107.289 15.064 108.801 15.064C110.313 15.064 111.703 15.3347 112.973 15.876C114.242 16.3987 115.334 17.1173 116.249 18.032C117.182 18.928 117.901 19.992 118.405 21.224C118.927 22.4373 119.189 23.744 119.189 25.144V25.2C119.189 26.6 118.927 27.916 118.405 29.148C117.882 30.3613 117.154 31.4347 116.221 32.368C115.306 33.2827 114.205 34.0107 112.917 34.552C111.647 35.0747 110.257 35.336 108.745 35.336ZM108.801 31.36C109.659 31.36 110.453 31.2013 111.181 30.884C111.909 30.5667 112.525 30.128 113.029 29.568C113.551 29.008 113.953 28.364 114.233 27.636C114.531 26.8893 114.681 26.096 114.681 25.256V25.2C114.681 24.36 114.531 23.5667 114.233 22.82C113.953 22.0733 113.542 21.42 113.001 20.86C112.478 20.3 111.853 19.8613 111.125 19.544C110.397 19.208 109.603 19.04 108.745 19.04C107.867 19.04 107.065 19.1987 106.337 19.516C105.627 19.8333 105.011 20.272 104.489 20.832C103.985 21.392 103.583 22.0453 103.285 22.792C103.005 23.52 102.865 24.304 102.865 25.144V25.2C102.865 26.04 103.005 26.8333 103.285 27.58C103.583 28.3267 103.994 28.98 104.517 29.54C105.058 30.1 105.683 30.548 106.393 30.884C107.121 31.2013 107.923 31.36 108.801 31.36ZM123.574 15.4H132.534C135.017 15.4 136.921 16.0627 138.246 17.388C139.366 18.508 139.926 20.0013 139.926 21.868V21.924C139.926 23.5107 139.534 24.808 138.75 25.816C137.985 26.8053 136.977 27.5333 135.726 28L140.514 35H135.474L131.274 28.728H127.886V35H123.574V15.4ZM132.254 24.92C133.318 24.92 134.13 24.668 134.69 24.164C135.269 23.66 135.558 22.988 135.558 22.148V22.092C135.558 21.1587 135.259 20.4587 134.662 19.992C134.065 19.5253 133.234 19.292 132.17 19.292H127.886V24.92H132.254ZM144.368 15.4H159.152V19.236H148.652V23.212H157.892V27.048H148.652V31.164H159.292V35H144.368V15.4Z"
                        fill="#002766"/>
                </svg>
            </div>
        </div>
        <div class="px-4 py-3 box-shadow h-full">
            <div class="pr-[7px] flex flex-col gap-6 h-full choose-tab">
                {{--                Tổng quan--}}
                <a href="{{route('screens.vstore.dashboard.index')}}">
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
                                        <p class="text-[#495057] text-sm text__menu">Tổng
                                            quan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                {{--                Hàng hóa--}}
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
                                    <p class="text-[#495057] text-sm  text__menu">Sản phẩm</p>
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
                        <li><a href="{{route('screens.vstore.product.index')}}">Tất cả sản phẩm</a></li>
                        <li><a href="{{route('screens.vstore.product.request')}}">Quản lý yêu cầu xét duyệt sản phẩm</a>
                        <li><a href="{{route('screens.vstore.product.discount')}}">Quản lý giảm giá</a>
                    </ul>
                </div>
                {{--                Quản lý đơn hàng--}}
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
                                    <p class="text-[#495057] text-sm  text__menu">Quản lý đơn hàng</p>
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

                        <li><a href="{{Route('screens.vstore.order.index')}}">Tất cả đơn hàng</a></li>
                    </ul>
                </div>
                {{----}}
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
                                    <p class="text-[#495057] text-sm  text__menu">Đối tác</p>
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
                        <li><a href="{{Route('screens.vstore.partner.index')}}">Danh sách nhà cung cấp</a></li>
                        <li><a href="{{Route('screens.vstore.partner.vshop')}}">Danh sách V-Shop</a></li>
                        {{--                        <li><a href="{{Route('screens.vstore.partner.ship')}}">Dối tác giao hàng</a></li>--}}
                    </ul>
                </div>
                {{--                Tài chính--}}
                <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none tab__menu ">
                    <div class="flex items-center">
                        <div class="tab__left rounded-[16px] p-2">
                            <div
                                class="flex items-center gap-3">
                                <div class="w-[12px]">
                                    <svg viewBox="0 0 14 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="svgFill"
                                              d="M7.53635 10.8644C4.41454 10.053 3.41061 9.21415 3.41061 7.90766C3.41061 6.40864 4.79961 5.36346 7.12377 5.36346C9.57171 5.36346 10.4794 6.53242 10.5619 8.25147H13.6012C13.5049 5.88605 12.0609 3.71316 9.18664 3.01179V0H5.0609V2.97053C2.39293 3.54813 0.247544 5.28094 0.247544 7.93517C0.247544 11.112 2.87426 12.6935 6.7112 13.6149C10.1493 14.4401 10.8369 15.6503 10.8369 16.9293C10.8369 17.8782 10.1631 19.391 7.12377 19.391C4.29077 19.391 3.17682 18.1257 3.02554 16.5029H0C0.165029 19.5147 2.42043 21.2063 5.0609 21.7701V24.7544H9.18664V21.7976C11.8684 21.2888 14 19.7348 14 16.9155C14 13.0098 10.6582 11.6758 7.53635 10.8644Z"
                                              fill="#B8BED9"></path>
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
                        <li><a href="{{Route('screens.vstore.finance.index')}}">Ví</a></li>
                        <li><a href="{{Route('screens.vstore.finance.revenue')}}">Lịch
                                sử biến động số dư</a></li>
                        <li><a href="{{Route('screens.vstore.finance.history')}}">Yêu cầu rút tiền</a></li>
                    </ul>
                </div>
                <!-- tài khoản -->
                <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none tab__menu ">
                    <div class="flex items-center">
                        <div class="tab__left rounded-[16px] p-2">
                            <div
                                class="flex items-center gap-3">
                                <div class="w-[12px]">
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
                        <li data-page="/"><a class="hover:underline" href="{{route('screens.vstore.account.profile')}}">Hồ
                                sơ
                                của tôi</a></li>
                        <li data-page="change-password"><a class="hover:underline"
                                                           href="{{route('screens.vstore.account.changePassword')}}">Đổi
                                mật
                                khẩu</a>
                        </li>
                    </ul>
                </div>

                {{--                log out--}}
                <div data-index="3" class="flex flex-col gap-3 cursor-pointer select-none">
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
    <div class="bg-[#E6F7FF] w-full py-4 flex justify-between items-center px-4">
        <a href="{{route('screens.vstore.dashboard.index')}}" class="">
            <div class=" w-[130px] h-[62px]">
                @if(\Illuminate\Support\Facades\Auth::user()->avatar != null )
                    <img src="{{asset('image/users/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}"
                         class="w-full object-contain"
                         alt="">
                @else
                    <img src="{{asset('home/img/logo-06.png')}}" class="w-full" alt="">
                @endif
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
        <div class="flex justify-end items-center">
            <!-- <div class="help relative flex items-center gap-3 justify-end">
                <div class="w-[35px]">
                    <svg viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="35" height="35" rx="12" fill="#F5F5F5"/>
                        <path
                            d="M17.5 8.5C12.5312 8.5 8.5 12.5312 8.5 17.5C8.5 22.4687 12.5312 26.5 17.5 26.5C22.4687 26.5 26.5 22.4687 26.5 17.5C26.5 12.5312 22.4687 8.5 17.5 8.5ZM17.2187 22.75C17.0333 22.75 16.8521 22.695 16.6979 22.592C16.5437 22.489 16.4236 22.3426 16.3526 22.1713C16.2817 22 16.2631 21.8115 16.2993 21.6296C16.3354 21.4477 16.4247 21.2807 16.5558 21.1496C16.6869 21.0185 16.854 20.9292 17.0359 20.893C17.2177 20.8568 17.4062 20.8754 17.5775 20.9464C17.7488 21.0173 17.8952 21.1375 17.9983 21.2916C18.1013 21.4458 18.1562 21.6271 18.1562 21.8125C18.1562 22.0611 18.0575 22.2996 17.8817 22.4754C17.7058 22.6512 17.4674 22.75 17.2187 22.75ZM18.7862 17.9687C18.0264 18.4787 17.9219 18.9461 17.9219 19.375C17.9219 19.549 17.8527 19.716 17.7297 19.839C17.6066 19.9621 17.4397 20.0312 17.2656 20.0312C17.0916 20.0312 16.9247 19.9621 16.8016 19.839C16.6785 19.716 16.6094 19.549 16.6094 19.375C16.6094 18.348 17.0819 17.5314 18.0541 16.8784C18.9578 16.2719 19.4687 15.8875 19.4687 15.0423C19.4687 14.4677 19.1406 14.0312 18.4614 13.7083C18.3016 13.6323 17.9458 13.5583 17.508 13.5634C16.9586 13.5705 16.532 13.7017 16.2034 13.9661C15.5837 14.4648 15.5312 15.0077 15.5312 15.0156C15.5271 15.1018 15.506 15.1863 15.4692 15.2644C15.4324 15.3424 15.3805 15.4124 15.3167 15.4704C15.2528 15.5284 15.1781 15.5732 15.0969 15.6024C15.0157 15.6315 14.9295 15.6444 14.8434 15.6402C14.7572 15.6361 14.6727 15.615 14.5946 15.5782C14.5166 15.5414 14.4466 15.4895 14.3886 15.4256C14.3306 15.3618 14.2857 15.2871 14.2566 15.2059C14.2275 15.1247 14.2146 15.0385 14.2187 14.9523C14.2239 14.8384 14.3031 13.8123 15.3798 12.9461C15.9381 12.497 16.6483 12.2636 17.4892 12.2533C18.0845 12.2462 18.6437 12.347 19.023 12.5261C20.1578 13.0628 20.7812 13.9577 20.7812 15.0423C20.7812 16.6281 19.7214 17.3402 18.7862 17.9687Z"
                            fill="#A2A1A1"/>
                    </svg>
                </div>
                <p class="text-black font-normal text-sm">Hỗ trợ</p>
                <ul class="sub-nav-help">
                    <li><a href="#">Hướng dẫn sử dụng</a></li>
                    <li><a href="#">Biểu phí</a></li>
                    <li><a href="#">Chính sách quy định</a></li>
                </ul>
            </div> -->
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
                            <a href="{{route('vstore_all_noti')}}"
                               class="duration-200 transition-all text-title font-medium">Tất
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
                                 src="{{asset('asset/images/userVstore.png')}}">
                        </div>
                    </div>
                    <p class="text-black 2xl:text-base xl:text-sm font-medium cursor-pointer">
                        ID:{{\Illuminate\Support\Facades\Auth::user()->account_code}}</p>
                    <ul class="sub-nav-user">
                        <li><a href="{{route('screens.vstore.account.profile')}}"
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

