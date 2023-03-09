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
<div class=" fixed left-0 h-screen md:block hidden z-[7] ">

    <div class="flex  justify-between items-center gap-10 w-[305px]">
        <div></div>
        <a href="{{route('screens.manufacture.dashboard.index')}}" class="">
            <div class="w-[80px] h-[80px] ">
{{--                <img class="w-full object-contain" src="{{asset('asset/images/Logoncc.png')}}" alt="">--}}
                @if(!empty(Auth::user()->avatar))
                    <img class="w-full object-contain" src="{{asset( 'image/users/'.\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="">
                @else
                    <img class="w-full object-contain" src="{{asset('asset/images/Logoncc.png')}}" alt="">
                @endif


            </div>
        </a>
        <div class="w-[20px] h-[20px] cursor-pointer hover:opacity-70 transition-all duration-200 btn-small-menu"><img
                class="w-full" src="{{asset('asset/images/iconmenu.png')}}" alt=""></div>
    </div>
    <div class="w-full h-full bg-[#F2F8FF] side-bar-tab">
        <div
            class="pr-[7px] flex flex-col gap-2 h-full choose-tab w-full max-h-[700px] overflow-y-scroll overflow-x-hidden  ">
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
                                    <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Tổng
                                        quan</p>
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
                    <li class="hover:underline" data-page="create"><a
                            href="{{route('screens.manufacture.product.create')}}">Thêm sản phẩm</a>
                    </li>
                    <li class="hover:underline" data-page="create-request"><a
                            href="{{route('screens.manufacture.product.createRequest')}}"
                        >Yêu cầu xét duyệt
                            sản
                            phẩm</a></li>
                    <li class="hover:underline" data-page="request"><a
                            href="{{route('screens.manufacture.product.request')}}"
                        >Quản lý yêu cầu
                            xét duyệt sản phẩm</a></li>
                    <li class="hover:underline" data-page="discount"><a
                            href="{{route('screens.manufacture.product.discount')}}"
                        >Mã giảm giá</a></li>

                </ul>
            </div>
            {{--        Kho hàng--}}
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
                                <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Kho hàng</p>
                                <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="flex flex-col gap-2 text-[#3369D1] text-[15px] font-medium xl:pl-20 md:pl-8 list hidden md:max-w-[150px] xl:max-w-[230px] ">
                    <li data-page="/"><a class="hover:underline"
                                         href="{{route('screens.manufacture.warehouse.index')}}">Quản
                            lý kho
                            hàng</a></li>
                    <li data-page="add-product-warehouse"><a class="hover:underline"
                                                             href="{{route('screens.manufacture.warehouse.addProduct')}}">Thêm
                            sản
                            phẩm vào kho</a></li>
                    <li data-page="swap"><a class="hover:underline"
                                            href="{{route('screens.manufacture.warehouse.swap')}}">Quản
                            lý xuất - nhập
                            kho</a></li>
                </ul>
            </div>
            {{--        Quản lý V-Store--}}
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
                                <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Quản lý
                                    V-Store</p>
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
                    <li data-page="/"><a class="hover:underline" data-page="/"
                                         href="{{route('screens.manufacture.partner.index')}}">Quản lý hàng tại
                            <br> V-Store</a></li>
                    <li data-page="report"><a class="hover:underline" data-page="report"
                                              href="{{route('screens.manufacture.partner.report')}}">Báo cáo
                            V-Store</a>
                    </li>
                </ul>
            </div>
            {{--        Quản lý đơn hàng--}}
            <div class="flex flex-col gap-3 cursor-pointer select-none tab__menu tab__hover">
                <div class="flex xl:gap-4 lg:gap-2 md:gap-1 items-center">
                    <div
                        class="tab__left xl:min-w-[12px] rounded-tr-[16px] rounded-br-[16px] lg:min-w-[8px] md:min-w-[3px] xl:min-h-[58px] lg:min-h-[40px] md:min-h-[30px]"></div>
                    <div class="tab__left rounded-[16px]">
                        <div
                            class="xl:py-5 lg:py-3 md:py-2 xl:px-6 lg:px-4 md:px-2 flex items-center gap-5 xl:min-w-[250px] lg:min-w-[200px] md:min-w-[180px]">
                            <div class="md:w-[18px] lg:w-[22px] md:h-[22px] md:pt-0.5">
                                <svg viewBox="0 0 25 26" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path class="svgFill"
                                          d="M9.37501 10.63H12.5C12.8315 10.63 13.1495 10.4983 13.3839 10.2638C13.6183 10.0294 13.75 9.71148 13.75 9.37996C13.75 9.04844 13.6183 8.7305 13.3839 8.49608C13.1495 8.26166 12.8315 8.12996 12.5 8.12996H11.25V7.50497C11.25 7.17344 11.1183 6.8555 10.8839 6.62108C10.6495 6.38666 10.3315 6.25497 10 6.25497C9.66849 6.25497 9.35054 6.38666 9.11612 6.62108C8.8817 6.8555 8.75001 7.17344 8.75001 7.50497V8.19246C7.99054 8.34668 7.31546 8.77759 6.85583 9.40154C6.3962 10.0255 6.18481 10.798 6.26269 11.569C6.34057 12.3401 6.70217 13.0547 7.2773 13.5741C7.85242 14.0935 8.60004 14.3807 9.37501 14.38H10.625C10.7908 14.38 10.9497 14.4458 11.0669 14.563C11.1842 14.6802 11.25 14.8392 11.25 15.005C11.25 15.1707 11.1842 15.3297 11.0669 15.4469C10.9497 15.5641 10.7908 15.63 10.625 15.63H7.50001C7.16849 15.63 6.85054 15.7617 6.61612 15.9961C6.3817 16.2305 6.25001 16.5484 6.25001 16.88C6.25001 17.2115 6.3817 17.5294 6.61612 17.7638C6.85054 17.9983 7.16849 18.13 7.50001 18.13H8.75001V18.755C8.75001 19.0865 8.8817 19.4044 9.11612 19.6388C9.35054 19.8733 9.66849 20.005 10 20.005C10.3315 20.005 10.6495 19.8733 10.8839 19.6388C11.1183 19.4044 11.25 19.0865 11.25 18.755V18.0675C12.0095 17.9132 12.6846 17.4823 13.1442 16.8584C13.6038 16.2344 13.8152 15.4619 13.7373 14.6909C13.6594 13.9199 13.2978 13.2053 12.7227 12.6858C12.1476 12.1664 11.4 11.8792 10.625 11.88H9.37501C9.20925 11.88 9.05027 11.8141 8.93306 11.6969C8.81585 11.5797 8.75001 11.4207 8.75001 11.255C8.75001 11.0892 8.81585 10.9302 8.93306 10.813C9.05027 10.6958 9.20925 10.63 9.37501 10.63ZM23.75 12.505H20V1.25497C20.0009 1.03471 19.9435 0.818123 19.8338 0.62715C19.724 0.436178 19.5658 0.277599 19.375 0.167468C19.185 0.0577579 18.9694 0 18.75 0C18.5306 0 18.315 0.0577579 18.125 0.167468L14.375 2.31747L10.625 0.167468C10.435 0.0577579 10.2194 0 10 0C9.78059 0 9.56503 0.0577579 9.37501 0.167468L5.62501 2.31747L1.87501 0.167468C1.68499 0.0577579 1.46943 0 1.25001 0C1.03059 0 0.815034 0.0577579 0.62501 0.167468C0.434254 0.277599 0.275987 0.436178 0.166233 0.62715C0.0564785 0.818123 -0.000864605 1.03471 9.8536e-06 1.25497V21.255C9.8536e-06 22.2495 0.395098 23.2034 1.09836 23.9066C1.80162 24.6099 2.75545 25.005 3.75001 25.005H21.25C22.2446 25.005 23.1984 24.6099 23.9017 23.9066C24.6049 23.2034 25 22.2495 25 21.255V13.755C25 13.4234 24.8683 13.1055 24.6339 12.8711C24.3995 12.6367 24.0815 12.505 23.75 12.505ZM3.75001 22.505C3.41849 22.505 3.10055 22.3733 2.86613 22.1388C2.63171 21.9044 2.50001 21.5865 2.50001 21.255V3.41747L5.00001 4.84247C5.19293 4.94323 5.40736 4.99586 5.62501 4.99586C5.84266 4.99586 6.05709 4.94323 6.25001 4.84247L10 2.69247L13.75 4.84247C13.9429 4.94323 14.1574 4.99586 14.375 4.99586C14.5927 4.99586 14.8071 4.94323 15 4.84247L17.5 3.41747V21.255C17.5034 21.6814 17.5795 22.1041 17.725 22.505H3.75001ZM22.5 21.255C22.5 21.5865 22.3683 21.9044 22.1339 22.1388C21.8995 22.3733 21.5815 22.505 21.25 22.505C20.9185 22.505 20.6005 22.3733 20.3661 22.1388C20.1317 21.9044 20 21.5865 20 21.255V15.005H22.5V21.255Z"
                                          fill="#B8BED9"/>
                                </svg>
                                </svg>
                                </svg>
                            </div>
                            <div class="flex gap-2 items-center">
                                <p class="text-[#495057] xl:text-base lg:text-sm md:text-xs text__menu">Quản lý đơn
                                    hàng</p>
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
                    <li data-page="/">
                        <a class="hover:underline" href="{{route('screens.manufacture.order.index')}}">Tất cả đơn
                            hàng</a>
                    </li>
                    <li data-page="destroy"><a class="hover:underline"
                                               href="{{route('screens.manufacture.order.destroy')}}">Đơn
                            hủy</a></li>
                    <li data-page="pending"><a class="hover:underline"
                                               href="{{route('screens.manufacture.order.pending')}}">Trả
                            hàng, hoàn
                            tiền</a></li>

                </ul>
            </div>
            {{--        Tài chính--}}
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
                    <li data-page="/"><a class="hover:underline" href="{{route('screens.manufacture.finance.index')}}">Ví</a>
                    </li>
                    <li data-page="history"><a class="hover:underline"
                                               href="{{route('screens.manufacture.finance.history')}}">Lịch sử thay đổi
                            số dư</a>
                    </li>

                </ul>
            </div>
            {{--        Tài khoản--}}
            <div class="flex flex-col gap-3 cursor-pointer select-none tab__menu tab__hover">
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
                    <li data-page="/"><a class="hover:underline"
                                         href="{{route('screens.manufacture.account.profile')}}">Hồ sơ của tôi</a></li>
                    <li data-page="change-password"><a class="hover:underline"
                                                       href="{{route('screens.manufacture.account.changePassword')}}">Đổi
                            mật khẩu</a>
                    </li>

                </ul>
            </div>
            {{--        log out--}}
            <div class="flex flex-col gap-3 cursor-pointer select-none">
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


</div>
