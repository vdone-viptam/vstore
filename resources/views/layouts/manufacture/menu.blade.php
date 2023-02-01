<div class="bg-[#F2F8FF]">
    <a href="{{route('screens.manufacture.dashboard.index')}}" class="">
        <img class="min-w-[162px] py-10 px-8" src="{{asset('asset/images/logo.png')}}" alt="">
    </a>
    <div class="pr-[7px] flex flex-col gap-6">
        {{--        Dashboard--}}
        <div class="flex flex-col gap-3 select-none cursor-pointer tab__menu">
            <div class="flex gap-4 items-center">
                <div class="tab__left w-[12px] h-[58px]"></div>
                <div class="tab__left rounded-[16px] ">
                    <div class="py-5 px-6 flex items-center gap-5 min-w-[250px]">
                        <svg width="26" height="28" viewBox="0 0 26 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="svg"
                                  d="M9.17987 25.6978V21.6208C9.17987 20.58 10.0297 19.7364 11.0781 19.7364H14.9103C15.4137 19.7364 15.8966 19.9349 16.2525 20.2883C16.6085 20.6417 16.8085 21.121 16.8085 21.6208V25.6978C16.8053 26.1304 16.9762 26.5465 17.2833 26.8535C17.5904 27.1606 18.0082 27.3333 18.4441 27.3333H21.0586C22.2797 27.3364 23.4518 26.8571 24.3164 26.001C25.1809 25.145 25.6668 23.9826 25.6668 22.7704V11.1558C25.6668 10.1766 25.2296 9.24775 24.473 8.61952L15.5789 1.56778C14.0317 0.331375 11.815 0.371295 10.314 1.6626L1.62285 8.61952C0.830484 9.22923 0.356899 10.1608 0.333496 11.1558V22.7585C0.333496 25.2851 2.39667 27.3333 4.94173 27.3333H7.49655C8.4018 27.3333 9.13749 26.6082 9.14405 25.7096L9.17987 25.6978Z"
                                  fill="#B8BED9"/>
                        </svg>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#B8BED9] text__menu">Dashboard</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        quan ly sp--}}
        <div class="flex flex-col gap-3 cursor-pointer select-none tab__menu">
            <div class="flex gap-4 items-center">
                <div class="tab__left w-[12px] h-[58px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div class="py-5 px-6 flex items-center gap-5 min-w-[250px]">
                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="svg" d="M27 8.25L14.5 2L2 8.25V20.75L14.5 27L27 20.75V8.25Z" stroke="#B8BED9"
                                  stroke-width="3" stroke-linejoin="round"/>
                            <path class="svg" d="M2 8.25L14.5 14.5" stroke="#B8BED9" stroke-width="3"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="svg" d="M14.5 27V14.5" stroke="#B8BED9" stroke-width="3" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path class="svg" d="M27 8.25L14.5 14.5" stroke="#B8BED9" stroke-width="3"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                            <path class="svg" d="M20.75 5.125L8.25 11.375" stroke="#B8BED9" stroke-width="3"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#B8BED9] text__menu">Quản lý sản phẩm</p>
                            <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                      stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[13px] font-medium pl-24 list invisible h-0">
                <li class="hover:underline"><a href="{{route('screens.manufacture.product.index')}}">Tất cả sản phẩm</a>
                </li>
                <li class="hover:underline"><a href="{{route('screens.manufacture.product.create')}}">Yêu cầu thêm sản
                        phẩm</a></li>
                <li class="hover:underline"><a href="{{route('screens.manufacture.product.request')}}">Quản lý yêu cầu
                        thêm sản phẩm</a>
            </ul>
        </div>
        {{--        Kho hàng--}}
        <div class="flex flex-col gap-3 cursor-pointer select-none tab__menu">
            <div class="flex gap-4 items-center">
                <div class="tab__left w-[12px] h-[58px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div class="py-5 px-6 flex items-center gap-5 min-w-[250px]">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="svg"
                                  d="M24.7811 8.78146C24.6303 8.78213 24.4813 8.74532 24.3455 8.67384L12.8999 2.3245L1.4543 8.63079C1.21009 8.75638 0.929982 8.77137 0.6756 8.67248C0.421217 8.57359 0.213397 8.36891 0.0978565 8.10348C-0.0176839 7.83804 -0.0314796 7.53359 0.0595038 7.2571C0.150487 6.98061 0.338797 6.75472 0.583007 6.62914L12.8999 0L25.2168 6.62914C25.4764 6.69507 25.7017 6.8695 25.8439 7.11466C25.986 7.35982 26.0336 7.65598 25.9763 7.93901C25.919 8.22203 25.7615 8.46914 25.5378 8.62681C25.3141 8.78449 25.0422 8.84005 24.7811 8.78146ZM7.94938 19.543H2.00876V26H7.94938V19.543ZM15.8702 19.543H9.92958V26H15.8702V19.543ZM23.791 19.543H17.8504V26H23.791V19.543ZM19.8306 10.9338H13.89V17.3907H19.8306V10.9338ZM11.9098 10.9338H5.96917V17.3907H11.9098V10.9338Z"
                                  fill="#B8BED9"/>
                        </svg>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#B8BED9] text__menu">Kho hàng</p>
                            <svg width="11" height="6" viewBox="0 0 11 6" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="svg_arr" d="M9.99902 1L5.71749 5L1.43596 1" stroke="#B8BED9"
                                      stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[13px] font-medium pl-24 list hidden">
                <li><a class="hover:underline" href="{{route('screens.manufacture.warehouse.index')}}">Quản lý kho hàng</a></li>
                <li><a class="hover:underline" href="{{route('screens.manufacture.warehouse.addProduct')}}">Thêm sản phẩm vào kho</a></li>
                <li><a class="hover:underline" href="{{route('screens.manufacture.warehouse.swap')}}">Quản lý xuất nhập kho</a></li>
            </ul>
        </div>
        {{--        Quản lý V-Store--}}
        <div class="flex flex-col gap-3 cursor-pointer select-none tab__menu">
            <div class="flex gap-4 items-center">
                <div class="tab__left w-[12px] h-[58px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div class="py-5 px-6 flex items-center gap-5 min-w-[250px]">
                        <svg width="25" height="19" viewBox="0 0 25 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="svg" fill-rule="evenodd" clip-rule="evenodd"
                                  d="M24.9999 0.00058515C24.7478 0.00058515 24.5615 0.00058515 24.3752 0.00058515C22.786 0.00058515 21.2077 0.022814 19.6185 0.00058515C18.2266 -0.0216437 17.2182 0.58965 16.5387 1.80112C15.2016 4.16849 13.8535 6.53587 12.5054 8.90324C12.8123 9.43673 13.1191 9.97022 13.426 10.5148C14.1713 11.8263 15.5742 12.4821 16.9661 12.1042C17.5361 11.9486 18.0622 11.5929 18.5882 11.3373C18.5882 11.3373 18.5882 11.3373 18.5882 11.3484C20.6487 7.73622 22.6983 4.12404 24.7588 0.511849C24.8246 0.356247 24.8903 0.211759 24.9999 0.00058515Z"
                                  fill="#B8BED9"/>
                            <path class="svg"
                                  d="M16.9553 12.0931C15.5634 12.471 14.1605 11.8152 13.4152 10.5037C13.1083 9.97023 12.8014 9.43674 12.4945 8.89213C11.1464 6.52476 9.79835 4.1685 8.46122 1.80113C7.78169 0.589654 6.77336 -0.010525 5.38142 0.0117039C3.7922 0.0339327 2.21395 0.0117039 0.624727 0.0117039C0.438405 0.0117039 0.252083 0.0117039 0 0.0117039C0.109601 0.222878 0.175362 0.367366 0.263043 0.500739C2.33451 4.14627 4.41693 7.7918 6.4884 11.4373C7.52961 13.2601 8.57082 15.094 9.61203 16.9167C10.1162 17.8059 10.8396 18.3727 11.6177 18.6173C12.9768 19.0396 14.5222 18.4728 15.4099 16.9167C16.4731 15.0606 17.5252 13.1934 18.5884 11.3373C18.5884 11.3373 18.5884 11.3373 18.5884 11.3262C18.0513 11.5818 17.5362 11.9375 16.9553 12.0931Z"
                                  fill="#D2D7ED"/>
                        </svg>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#B8BED9] text__menu">Quản lý V-Store</p>
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[13px] font-medium pl-24 list hidden">
                <li><a class="hover:underline" href="{{route('screens.manufacture.partner.index')}}">Quản lý hàng tại vstore</a></li>
                <li><a class="hover:underline" href="{{route('screens.manufacture.partner.report')}}">Báo cáo Vstore</a></li>
            </ul>
        </div>
        {{--        Quản lý đơn hàng--}}
        <div class="flex flex-col gap-3 cursor-pointer select-none tab__menu">
            <div class="flex gap-4 items-center">
                <div class="tab__left w-[12px] h-[58px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div class="py-5 px-6 flex items-center gap-5 min-w-[250px]">
                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <svg width="25" height="26" viewBox="0 0 25 26" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="svg"
                                      d="M9.37501 10.63H12.5C12.8315 10.63 13.1495 10.4983 13.3839 10.2638C13.6183 10.0294 13.75 9.71148 13.75 9.37996C13.75 9.04844 13.6183 8.7305 13.3839 8.49608C13.1495 8.26166 12.8315 8.12996 12.5 8.12996H11.25V7.50497C11.25 7.17344 11.1183 6.8555 10.8839 6.62108C10.6495 6.38666 10.3315 6.25497 10 6.25497C9.66849 6.25497 9.35054 6.38666 9.11612 6.62108C8.8817 6.8555 8.75001 7.17344 8.75001 7.50497V8.19246C7.99054 8.34668 7.31546 8.77759 6.85583 9.40154C6.3962 10.0255 6.18481 10.798 6.26269 11.569C6.34057 12.3401 6.70217 13.0547 7.2773 13.5741C7.85242 14.0935 8.60004 14.3807 9.37501 14.38H10.625C10.7908 14.38 10.9497 14.4458 11.0669 14.563C11.1842 14.6802 11.25 14.8392 11.25 15.005C11.25 15.1707 11.1842 15.3297 11.0669 15.4469C10.9497 15.5641 10.7908 15.63 10.625 15.63H7.50001C7.16849 15.63 6.85054 15.7617 6.61612 15.9961C6.3817 16.2305 6.25001 16.5484 6.25001 16.88C6.25001 17.2115 6.3817 17.5294 6.61612 17.7638C6.85054 17.9983 7.16849 18.13 7.50001 18.13H8.75001V18.755C8.75001 19.0865 8.8817 19.4044 9.11612 19.6388C9.35054 19.8733 9.66849 20.005 10 20.005C10.3315 20.005 10.6495 19.8733 10.8839 19.6388C11.1183 19.4044 11.25 19.0865 11.25 18.755V18.0675C12.0095 17.9132 12.6846 17.4823 13.1442 16.8584C13.6038 16.2344 13.8152 15.4619 13.7373 14.6909C13.6594 13.9199 13.2978 13.2053 12.7227 12.6858C12.1476 12.1664 11.4 11.8792 10.625 11.88H9.37501C9.20925 11.88 9.05027 11.8141 8.93306 11.6969C8.81585 11.5797 8.75001 11.4207 8.75001 11.255C8.75001 11.0892 8.81585 10.9302 8.93306 10.813C9.05027 10.6958 9.20925 10.63 9.37501 10.63ZM23.75 12.505H20V1.25497C20.0009 1.03471 19.9435 0.818123 19.8338 0.62715C19.724 0.436178 19.5658 0.277599 19.375 0.167468C19.185 0.0577579 18.9694 0 18.75 0C18.5306 0 18.315 0.0577579 18.125 0.167468L14.375 2.31747L10.625 0.167468C10.435 0.0577579 10.2194 0 10 0C9.78059 0 9.56503 0.0577579 9.37501 0.167468L5.62501 2.31747L1.87501 0.167468C1.68499 0.0577579 1.46943 0 1.25001 0C1.03059 0 0.815034 0.0577579 0.62501 0.167468C0.434254 0.277599 0.275987 0.436178 0.166233 0.62715C0.0564785 0.818123 -0.000864605 1.03471 9.8536e-06 1.25497V21.255C9.8536e-06 22.2495 0.395098 23.2034 1.09836 23.9066C1.80162 24.6099 2.75545 25.005 3.75001 25.005H21.25C22.2446 25.005 23.1984 24.6099 23.9017 23.9066C24.6049 23.2034 25 22.2495 25 21.255V13.755C25 13.4234 24.8683 13.1055 24.6339 12.8711C24.3995 12.6367 24.0815 12.505 23.75 12.505ZM3.75001 22.505C3.41849 22.505 3.10055 22.3733 2.86613 22.1388C2.63171 21.9044 2.50001 21.5865 2.50001 21.255V3.41747L5.00001 4.84247C5.19293 4.94323 5.40736 4.99586 5.62501 4.99586C5.84266 4.99586 6.05709 4.94323 6.25001 4.84247L10 2.69247L13.75 4.84247C13.9429 4.94323 14.1574 4.99586 14.375 4.99586C14.5927 4.99586 14.8071 4.94323 15 4.84247L17.5 3.41747V21.255C17.5034 21.6814 17.5795 22.1041 17.725 22.505H3.75001ZM22.5 21.255C22.5 21.5865 22.3683 21.9044 22.1339 22.1388C21.8995 22.3733 21.5815 22.505 21.25 22.505C20.9185 22.505 20.6005 22.3733 20.3661 22.1388C20.1317 21.9044 20 21.5865 20 21.255V15.005H22.5V21.255Z"
                                      fill="#B8BED9"/>
                            </svg>
                        </svg>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#B8BED9] text__menu">Quản lý sản phẩm</p>
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[13px] font-medium pl-24 list hidden">
                <li><a class="hover:underline" href="{{route('screens.manufacture.order.index')}}">Tất cả đơn hàng</a></li>
                <li><a class="hover:underline" href="{{route('screens.manufacture.order.destroy')}}">Đơn hủy</a></li>
                <li><a class="hover:underline" href="{{route('screens.manufacture.order.pending')}}">Trả hàng, hoàn tiền</a></li>
            </ul>
        </div>
        {{--        Tài chính--}}
        <div class="flex flex-col gap-3 cursor-pointer select-none tab__menu">
            <div class="flex gap-4 items-center">
                <div class="tab__left w-[12px] h-[58px]"></div>
                <div class="tab__left rounded-[16px]">
                    <div class="py-5 px-6 flex items-center gap-5 min-w-[250px]">
                        <svg width="14" height="25" viewBox="0 0 14 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="svg"
                                  d="M7.53635 10.8644C4.41454 10.053 3.41061 9.21415 3.41061 7.90766C3.41061 6.40864 4.79961 5.36346 7.12377 5.36346C9.57171 5.36346 10.4794 6.53242 10.5619 8.25147H13.6012C13.5049 5.88605 12.0609 3.71316 9.18664 3.01179V0H5.0609V2.97053C2.39293 3.54813 0.247544 5.28094 0.247544 7.93517C0.247544 11.112 2.87426 12.6935 6.7112 13.6149C10.1493 14.4401 10.8369 15.6503 10.8369 16.9293C10.8369 17.8782 10.1631 19.391 7.12377 19.391C4.29077 19.391 3.17682 18.1257 3.02554 16.5029H0C0.165029 19.5147 2.42043 21.2063 5.0609 21.7701V24.7544H9.18664V21.7976C11.8684 21.2888 14 19.7348 14 16.9155C14 13.0098 10.6582 11.6758 7.53635 10.8644Z"
                                  fill="#B8BED9"/>
                        </svg>
                        <div class="flex gap-2 items-center">
                            <p class="text-[#B8BED9] text__menu">Quản lý sản phẩm</p>
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
            <ul class="flex flex-col gap-2 text-[#3369D1] text-[13px] font-medium pl-24 list hidden">
                <li><a class="hover:underline" href="{{route('screens.manufacture.finance.index')}}">Ví</a></li>
                <li><a class="hover:underline" href="{{route('screens.manufacture.finance.history')}}">Doanh thu</a></li>
            </ul>
        </div>
    </div>
</div>
