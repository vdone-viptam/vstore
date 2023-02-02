<header>
    <div class="flex justify-between items-center bg-[#FFF] px-5 xl:px-16 py-4">
        <a href="{{route('screens.vstore.dashboard.index')}}">
            <div class="w-[162px]">
                <img src="{{asset('asset/images/logo.png')}}" alt="">
            </div>
        </a>
        <div class="flex justify-start items-center gap-10">
            <div class="flex justify-start items-center gap-2 md:hidden relative">
                <svg width="20" height="20" class="menuMB" viewBox="0 0 20 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.5 6.4585H2.5C2.15833 6.4585 1.875 6.17516 1.875 5.8335C1.875 5.49183 2.15833 5.2085 2.5 5.2085H17.5C17.8417 5.2085 18.125 5.49183 18.125 5.8335C18.125 6.17516 17.8417 6.4585 17.5 6.4585Z"
                        fill="black" fill-opacity="0.85"/>
                    <path
                        d="M17.5 10.625H2.5C2.15833 10.625 1.875 10.3417 1.875 10C1.875 9.65833 2.15833 9.375 2.5 9.375H17.5C17.8417 9.375 18.125 9.65833 18.125 10C18.125 10.3417 17.8417 10.625 17.5 10.625Z"
                        fill="black" fill-opacity="0.85"/>
                    <path
                        d="M17.5 14.7915H2.5C2.15833 14.7915 1.875 14.5082 1.875 14.1665C1.875 13.8248 2.15833 13.5415 2.5 13.5415H17.5C17.8417 13.5415 18.125 13.8248 18.125 14.1665C18.125 14.5082 17.8417 14.7915 17.5 14.7915Z"
                        fill="black" fill-opacity="0.85"/>
                </svg>


            </div>
            <div class="md:flex justify-start items-center gap-4 hidden">
                <div class="help flex justify-start items-center gap-2 relative cursor-pointer">
                    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12,14a1,1,0,1,0,1,1A1,1,0,0,0,12,14ZM12,2A10,10,0,0,0,2,12a9.89,9.89,0,0,0,2.26,6.33l-2,2a1,1,0,0,0-.21,1.09A1,1,0,0,0,3,22h9A10,10,0,0,0,12,2Zm0,18H5.41l.93-.93a1,1,0,0,0,.3-.71,1,1,0,0,0-.3-.7A8,8,0,1,1,12,20ZM12,8a1,1,0,0,0-1,1v3a1,1,0,0,0,2,0V9A1,1,0,0,0,12,8Z"/>
                    </svg>
                    <span class="text-title ">Hỗ trợ</span>
                    <ul class="sub-nav-help">
                        <li><a href="#">Hướng dẫn sử dụng</a></li>
                        <li><a href="#">Biểu phí</a></li>
                        <li><a href="#">Chính sách quy định</a></li>
                    </ul>
                </div>

                <div class="flex justify-start items-center gap-2">
                    <span class="text-title font-medium">Aneed</span>
                    <div class="user relative">
                        <svg width="48" height="48" class="cursor-pointer hover:opacity-70 transition-all duration-500"
                             viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="48" height="48" rx="24" fill="#F5F5F5"/>
                            <path
                                d="M23.9997 23.9998C26.3009 23.9998 28.1663 22.1344 28.1663 19.8332C28.1663 17.532 26.3009 15.6665 23.9997 15.6665C21.6985 15.6665 19.833 17.532 19.833 19.8332C19.833 22.1344 21.6985 23.9998 23.9997 23.9998Z"
                                stroke="#2F54EB" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                d="M31.1585 32.3333C31.1585 29.1083 27.9501 26.5 24.0001 26.5C20.0501 26.5 16.8418 29.1083 16.8418 32.3333"
                                stroke="#2F54EB" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
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
                            <li><a href="{{route('screens.vstore.account.profile')}}"
                                   class="font-medium flex justify-start items-center gap-2">
                                    <svg width="18" height="18" class="cursor-pointer" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">vstore
                                        <path
                                            d="M14.1361 3.36144L15.1312 3.26194L14.1361 3.36144ZM13.9838 2.54161L13.095 3V3L13.9838 2.54161ZM14.4311 4.81793L15.2261 4.21141L15.2261 4.21141L14.4311 4.81793ZM15.3595 5.20248L15.2261 4.21141L15.3595 5.20248ZM16.5979 4.38113L17.2311 5.15509L17.2311 5.15509L16.5979 4.38113ZM17.2853 3.90918L17.5896 4.86175L17.2853 3.90918ZM17.9872 3.94419L18.3848 3.02663L18.3848 3.02663L17.9872 3.94419ZM18.6243 4.4822L17.9172 5.1893L17.9172 5.18931L18.6243 4.4822ZM19.5178 5.37567L20.2249 4.66856L20.2249 4.66856L19.5178 5.37567ZM20.0558 6.01275L20.9733 5.61517L20.9733 5.61516L20.0558 6.01275ZM20.0908 6.71464L21.0434 7.01895L21.0434 7.01894L20.0908 6.71464ZM19.6188 7.4021L18.8449 6.76886L18.8449 6.76886L19.6188 7.4021ZM18.7975 8.64056L17.8064 8.50724L17.8064 8.50725L18.7975 8.64056ZM19.182 9.56893L18.5755 10.364L18.5755 10.364L19.182 9.56893ZM20.6385 9.86385L20.738 8.86882L20.6385 9.86385ZM21.4584 10.0162L21.9168 9.1275L21.9168 9.1275L21.4584 10.0162ZM21.9299 10.5373L22.8599 10.1696L22.8599 10.1696L21.9299 10.5373ZM21.93 13.4626L21 13.095L21 13.095L21.93 13.4626ZM21.4583 13.9838L21.9166 14.8726L21.9166 14.8726L21.4583 13.9838ZM20.6386 14.1361L20.5391 13.1411L20.5065 13.1444L20.4742 13.1497L20.6386 14.1361ZM20.6386 14.1361L20.7381 15.1312L20.7707 15.1279L20.803 15.1225L20.6386 14.1361ZM19.1825 14.4309L18.5762 13.6357L18.5762 13.6357L19.1825 14.4309ZM18.7979 15.3596L17.8068 15.4931V15.4931L18.7979 15.3596ZM19.619 16.5976L18.845 17.2308H18.845L19.619 16.5976ZM20.0908 17.2848L19.1383 17.5892V17.5892L20.0908 17.2848ZM20.0558 17.9869L19.1383 17.5892L19.1383 17.5892L20.0558 17.9869ZM19.5179 18.6238L20.225 19.3309H20.225L19.5179 18.6238ZM18.6243 19.5174L17.9172 18.8102L17.9172 18.8103L18.6243 19.5174ZM17.9873 20.0554L18.3849 20.9729L18.3849 20.9729L17.9873 20.0554ZM17.2854 20.0904L16.981 21.0429L16.981 21.0429L17.2854 20.0904ZM16.5979 19.6184L17.2312 18.8444L17.2226 18.8376L16.5979 19.6184ZM16.5979 19.6184L15.9646 20.3924L15.9732 20.3993L16.5979 19.6184ZM15.3595 18.7971L15.4928 17.806H15.4928L15.3595 18.7971ZM14.4311 19.1816L15.2262 19.7882L15.2262 19.7881L14.4311 19.1816ZM14.1362 20.6383L13.1411 20.5388V20.5388L14.1362 20.6383ZM13.9837 21.4585L13.095 21L13.095 21L13.9837 21.4585ZM13.4628 21.9299L13.095 21L13.095 21L13.4628 21.9299ZM10.5373 21.9299L10.905 21L10.5373 21.9299ZM10.0162 21.4584L10.905 21H10.905L10.0162 21.4584ZM9.86385 20.6385L8.86882 20.7381V20.7381L9.86385 20.6385ZM9.56892 19.182L8.77387 19.7885L8.77387 19.7885L9.56892 19.182ZM8.64057 18.7975L8.50728 17.8064H8.50727L8.64057 18.7975ZM7.40208 19.6189L6.76884 18.8449L6.753 18.8579L6.73771 18.8714L7.40208 19.6189ZM7.40206 19.6189L8.0353 20.3928L8.05113 20.3799L8.06643 20.3663L7.40206 19.6189ZM6.71458 20.0908L7.01887 21.0434H7.01887L6.71458 20.0908ZM6.01272 20.0558L5.61515 20.9734H5.61515L6.01272 20.0558ZM5.37561 19.5178L6.08271 18.8107H6.08271L5.37561 19.5178ZM4.48217 18.6243L3.77506 19.3315L3.77506 19.3315L4.48217 18.6243ZM3.94414 17.9873L4.86171 17.5897L4.86171 17.5897L3.94414 17.9873ZM3.90913 17.2854L4.86171 17.5897L4.86171 17.5897L3.90913 17.2854ZM4.3811 16.5979L5.15506 17.2311H5.15506L4.3811 16.5979ZM5.20247 15.3594L6.19355 15.4928L5.20247 15.3594ZM4.81792 14.4311L5.42445 13.636L5.42445 13.636L4.81792 14.4311ZM3.36143 14.1361L3.26193 15.1312H3.26193L3.36143 14.1361ZM2.54161 13.9838L3 13.095H3L2.54161 13.9838ZM2.07005 13.4627L1.14009 13.8304L1.14009 13.8304L2.07005 13.4627ZM2.07008 10.5372L1.14017 10.1694L1.14017 10.1694L2.07008 10.5372ZM2.54152 10.0163L2.08305 9.12757L2.08305 9.12757L2.54152 10.0163ZM3.36155 9.86384V8.86384H3.31167L3.26205 8.86881L3.36155 9.86384ZM3.36156 9.86384V10.8638H3.41143L3.46106 10.8589L3.36156 9.86384ZM4.81842 9.56881L4.21178 8.77383L4.21177 8.77383L4.81842 9.56881ZM5.20287 8.64066L6.19396 8.50749L6.19396 8.50749L5.20287 8.64066ZM4.38128 7.40182L5.15523 6.76858H5.15523L4.38128 7.40182ZM3.90914 6.71405L4.86175 6.40988L4.86175 6.40988L3.90914 6.71405ZM3.94413 6.01243L3.02651 5.61498L3.02651 5.61498L3.94413 6.01243ZM4.48233 5.37509L5.18944 6.0822H5.18944L4.48233 5.37509ZM5.37565 4.48177L4.66855 3.77466V3.77466L5.37565 4.48177ZM6.01277 3.94373L5.6152 3.02615L5.6152 3.02616L6.01277 3.94373ZM6.71463 3.90872L7.01892 2.95614V2.95614L6.71463 3.90872ZM7.4022 4.38076L8.03543 3.60681V3.60681L7.4022 4.38076ZM8.64044 5.20207L8.77391 4.21101L8.64044 5.20207ZM9.56907 4.81742L8.77391 4.21101L8.77391 4.21101L9.56907 4.81742ZM9.86387 3.36131L10.8589 3.46081V3.46081L9.86387 3.36131ZM10.0162 2.5417L9.12739 2.08341L9.12739 2.08341L10.0162 2.5417ZM10.5374 2.07001L10.905 3L10.905 3L10.5374 2.07001ZM13.4627 2.07005L13.8304 1.1401V1.1401L13.4627 2.07005ZM15.1312 3.26194C15.1108 3.05831 15.0912 2.85693 15.0626 2.6868C15.0324 2.50684 14.9828 2.29705 14.8725 2.08322L13.095 3C13.0721 2.95549 13.0769 2.93878 13.0902 3.01798C13.1052 3.10701 13.1181 3.23089 13.1411 3.46094L15.1312 3.26194ZM15.2261 4.21141C15.2894 4.29433 15.2693 4.33101 15.2342 4.13595C15.2008 3.95045 15.1739 3.68915 15.1312 3.26194L13.1411 3.46094C13.1805 3.85459 13.2152 4.20895 13.2658 4.49017C13.3147 4.76184 13.4009 5.11633 13.636 5.42445L15.2261 4.21141ZM15.2261 4.21141L15.2261 4.21141L13.636 5.42444C14.0718 5.99575 14.7806 6.28935 15.4928 6.19355L15.2261 4.21141ZM15.9646 3.60717C15.6323 3.87905 15.4286 4.04481 15.2738 4.15238C15.1111 4.26548 15.1228 4.22531 15.2261 4.21141L15.4928 6.19355C15.8768 6.14188 16.1885 5.95223 16.4152 5.7947C16.6498 5.63163 16.9249 5.4056 17.2311 5.15509L15.9646 3.60717ZM16.981 2.95661C16.7518 3.02983 16.5684 3.14308 16.4198 3.24897C16.2793 3.34907 16.123 3.47759 15.9646 3.60717L17.2311 5.15509C17.41 5.00869 17.5068 4.93022 17.5803 4.87784C17.6457 4.83124 17.6373 4.84651 17.5896 4.86175L16.981 2.95661ZM18.3848 3.02663C17.9408 2.83421 17.442 2.80934 16.981 2.95661L17.5896 4.86175L17.5896 4.86175L18.3848 3.02663ZM19.3314 3.77509C19.1867 3.6304 19.044 3.48696 18.9142 3.37338C18.7768 3.25323 18.6056 3.12228 18.3848 3.02663L17.5896 4.86175C17.5437 4.84184 17.5369 4.82581 17.5973 4.87869C17.6653 4.93813 17.7537 5.02583 17.9172 5.1893L19.3314 3.77509ZM20.2249 4.66856L19.3314 3.77509L17.9172 5.18931L18.8107 6.08277L20.2249 4.66856ZM20.9733 5.61516C20.8777 5.39441 20.7467 5.22316 20.6266 5.08581C20.513 4.95597 20.3696 4.81326 20.2249 4.66856L18.8106 6.08277C18.9741 6.24626 19.0618 6.33469 19.1213 6.40264C19.1742 6.46308 19.1581 6.45629 19.1382 6.41034L20.9733 5.61516ZM21.0434 7.01894C21.1906 6.55797 21.1658 6.05922 20.9733 5.61517L19.1382 6.41034L19.1382 6.41034L21.0434 7.01894ZM20.3928 8.03534C20.5224 7.87696 20.6509 7.72069 20.751 7.58019C20.8569 7.43156 20.9701 7.24814 21.0434 7.01895L19.1382 6.41033C19.1535 6.36263 19.1687 6.35427 19.1221 6.41968C19.0697 6.4932 18.9913 6.58992 18.8449 6.76886L20.3928 8.03534ZM19.7885 8.77387C19.7746 8.87723 19.7345 8.88894 19.8476 8.72619C19.9551 8.57141 20.1209 8.36764 20.3928 8.03534L18.8449 6.76886C18.5943 7.07506 18.3683 7.35016 18.2052 7.58481C18.0477 7.81148 17.8581 8.12317 17.8064 8.50724L19.7885 8.77387ZM19.7885 8.77387V8.77386L17.8064 8.50725C17.7106 9.21938 18.0042 9.92816 18.5755 10.364L19.7885 8.77387ZM20.738 8.86882C20.3108 8.82609 20.0495 8.79922 19.864 8.76584C19.6689 8.73073 19.7056 8.7106 19.7885 8.77387L18.5755 10.364C18.8836 10.599 19.2381 10.6853 19.5098 10.7342C19.791 10.7848 20.1454 10.8195 20.539 10.8589L20.738 8.86882ZM21.9168 9.1275C21.703 9.01721 21.4932 8.96759 21.3132 8.93737C21.1431 8.9088 20.9417 8.88918 20.738 8.86882L20.539 10.8589C20.7691 10.8819 20.893 10.8948 20.982 10.9098C21.0612 10.9231 21.0445 10.9279 21 10.905L21.9168 9.1275ZM22.8599 10.1696C22.682 9.71957 22.3469 9.34933 21.9168 9.1275L21 10.905L21 10.905L22.8599 10.1696ZM23 11.3682C23 11.1636 23.0005 10.9613 22.989 10.7891C22.9769 10.607 22.9484 10.3933 22.8599 10.1696L21 10.905C20.9816 10.8584 20.9881 10.8423 20.9935 10.9224C20.9995 11.0125 21 11.137 21 11.3682H23ZM23 12.6319V11.3682H21V12.6319H23ZM22.86 13.8302C22.9484 13.6065 22.9769 13.3929 22.989 13.2108C23.0005 13.0388 23 12.8365 23 12.6319H21C21 12.863 20.9995 12.9875 20.9935 13.0776C20.9881 13.1577 20.9816 13.1416 21 13.095L22.86 13.8302ZM21.9166 14.8726C22.3469 14.6507 22.682 14.2804 22.86 13.8302L21 13.095V13.095L21.9166 14.8726ZM20.7381 15.1312C20.9417 15.1108 21.1431 15.0912 21.3132 15.0626C21.4931 15.0324 21.7028 14.9828 21.9166 14.8726L21 13.095C21.0445 13.0721 21.0612 13.077 20.982 13.0902C20.893 13.1052 20.7691 13.1181 20.5391 13.1411L20.7381 15.1312ZM20.803 15.1225L20.803 15.1225L20.4742 13.1497L20.4742 13.1497L20.803 15.1225ZM19.7889 15.2261C19.706 15.2893 19.6693 15.2692 19.8644 15.2341C20.0498 15.2007 20.311 15.1739 20.7381 15.1312L20.5391 13.1411C20.1456 13.1805 19.7913 13.2151 19.5102 13.2657C19.2386 13.3146 18.8842 13.4008 18.5762 13.6357L19.7889 15.2261ZM19.7889 15.2261L19.7889 15.2261L18.5762 13.6357C18.0046 14.0716 17.7108 14.7807 17.8068 15.4931L19.7889 15.2261ZM20.3929 15.9643C20.1212 15.6322 19.9555 15.4285 19.8479 15.2738C19.7348 15.1111 19.775 15.1228 19.7889 15.2261L17.8068 15.4931C17.8585 15.877 18.0481 16.1886 18.2056 16.4152C18.3686 16.6497 18.5946 16.9247 18.845 17.2308L20.3929 15.9643ZM21.0433 16.9803C20.9701 16.7513 20.8569 16.5679 20.751 16.4193C20.651 16.2789 20.5225 16.1227 20.3929 15.9643L18.845 17.2308C18.9914 17.4097 19.0698 17.5064 19.1222 17.5799C19.1688 17.6453 19.1535 17.6369 19.1383 17.5892L21.0433 16.9803ZM20.9733 18.3846C21.1658 17.9404 21.1907 17.4415 21.0433 16.9803L19.1383 17.5892L19.1383 17.5892L20.9733 18.3846ZM20.225 19.3309C20.3697 19.1862 20.5131 19.0436 20.6266 18.9138C20.7467 18.7765 20.8776 18.6053 20.9733 18.3846L19.1383 17.5892C19.1582 17.5433 19.1742 17.5365 19.1213 17.5969C19.0619 17.6648 18.9742 17.7532 18.8108 17.9167L20.225 19.3309ZM19.3314 20.2245L20.225 19.3309L18.8108 17.9167L17.9172 18.8102L19.3314 20.2245ZM18.3849 20.9729C18.6056 20.8773 18.7769 20.7463 18.9142 20.6262C19.044 20.5126 19.1867 20.3692 19.3314 20.2245L17.9172 18.8103C17.7537 18.9737 17.6653 19.0614 17.5974 19.1209C17.5369 19.1737 17.5437 19.1577 17.5897 19.1378L18.3849 20.9729ZM16.981 21.0429C17.442 21.1902 17.9408 21.1653 18.3849 20.9729L17.5897 19.1378H17.5897L16.981 21.0429ZM15.9647 20.3924C16.1231 20.522 16.2793 20.6505 16.4198 20.7506C16.5684 20.8565 16.7519 20.9697 16.981 21.0429L17.5897 19.1378C17.6374 19.153 17.6457 19.1683 17.5803 19.1217C17.5068 19.0693 17.4101 18.9909 17.2312 18.8445L15.9647 20.3924ZM15.9732 20.3993L15.9732 20.3993L17.2226 18.8376L17.2226 18.8375L15.9732 20.3993ZM15.2262 19.7881C15.1228 19.7742 15.1111 19.7341 15.2738 19.8472C15.4286 19.9547 15.6324 20.1205 15.9647 20.3924L17.2311 18.8445C16.925 18.5939 16.6499 18.3679 16.4152 18.2048C16.1886 18.0473 15.8769 17.8577 15.4928 17.806L15.2262 19.7881ZM15.2262 19.7881H15.2262L15.4928 17.806C14.7807 17.7102 14.0719 18.0038 13.636 18.5751L15.2262 19.7881ZM15.1312 20.7378C15.1739 20.3105 15.2008 20.0492 15.2342 19.8636C15.2693 19.6685 15.2894 19.7052 15.2262 19.7882L13.636 18.5751C13.401 18.8832 13.3147 19.2378 13.2658 19.5094C13.2152 19.7907 13.1805 20.1451 13.1411 20.5388L15.1312 20.7378ZM14.8724 21.917C14.9828 21.7031 15.0324 21.4932 15.0626 21.3132C15.0912 21.143 15.1108 20.9415 15.1312 20.7378L13.1411 20.5388C13.1181 20.769 13.1052 20.8929 13.0902 20.982C13.0769 21.0612 13.072 21.0445 13.095 21L14.8724 21.917ZM13.8306 22.8598C14.2805 22.6819 14.6506 22.3469 14.8724 21.917L13.095 21L13.095 21L13.8306 22.8598ZM12.6316 23C12.8363 23 13.0387 23.0005 13.2109 22.989C13.393 22.9768 13.6068 22.9483 13.8306 22.8598L13.095 21C13.1416 20.9816 13.1577 20.9881 13.0776 20.9935C12.9875 20.9995 12.8629 21 12.6316 21V23ZM11.3682 23H12.6316V21H11.3682V23ZM10.1696 22.8599C10.3933 22.9484 10.607 22.9769 10.7891 22.989C10.9613 23.0005 11.1636 23 11.3682 23V21C11.137 21 11.0125 20.9995 10.9224 20.9935C10.8423 20.9881 10.8584 20.9816 10.905 21L10.1696 22.8599ZM9.1275 21.9168C9.34933 22.3469 9.71958 22.682 10.1696 22.8599L10.905 21L9.1275 21.9168ZM8.86882 20.7381C8.88918 20.9417 8.9088 21.1431 8.93737 21.3132C8.96759 21.4932 9.01721 21.703 9.1275 21.9168L10.905 21C10.9279 21.0445 10.9231 21.0612 10.9098 20.982C10.8948 20.893 10.8819 20.7691 10.8589 20.539L8.86882 20.7381ZM8.77387 19.7885C8.7106 19.7056 8.73073 19.6689 8.76584 19.864C8.79922 20.0495 8.82609 20.3108 8.86882 20.7381L10.8589 20.539C10.8195 20.1454 10.7848 19.791 10.7342 19.5098C10.6853 19.2381 10.599 18.8836 10.364 18.5755L8.77387 19.7885ZM8.77387 19.7885L10.364 18.5755C9.92815 18.0042 9.21939 17.7106 8.50728 17.8064L8.77387 19.7885ZM8.03531 20.3928C8.36763 20.1209 8.5714 19.9551 8.72619 19.8476C8.88895 19.7345 8.87724 19.7746 8.77387 19.7885L8.50727 17.8064C8.12318 17.858 7.81149 18.0477 7.58481 18.2052C7.35015 18.3683 7.07504 18.5944 6.76884 18.8449L8.03531 20.3928ZM8.06643 20.3663L8.06644 20.3663L6.73771 18.8714L6.7377 18.8715L8.06643 20.3663ZM7.01887 21.0434C7.24807 20.9702 7.4315 20.8569 7.58013 20.751C7.72064 20.6509 7.87691 20.5224 8.0353 20.3928L6.76883 18.8449C6.58988 18.9913 6.49316 19.0698 6.41963 19.1222C6.35422 19.1688 6.36258 19.1535 6.41029 19.1383L7.01887 21.0434ZM5.61515 20.9734C6.05919 21.1658 6.55791 21.1907 7.01887 21.0434L6.41029 19.1383L6.41029 19.1383L5.61515 20.9734ZM4.6685 20.2249C4.81321 20.3696 4.95592 20.513 5.08577 20.6266C5.22313 20.7468 5.39438 20.8777 5.61515 20.9734L6.41029 19.1383C6.45624 19.1582 6.46304 19.1742 6.40259 19.1213C6.33464 19.0619 6.2462 18.9742 6.08271 18.8107L4.6685 20.2249ZM3.77506 19.3315L4.6685 20.2249L6.08271 18.8107L5.18927 17.9172L3.77506 19.3315ZM3.02657 18.3848C3.12223 18.6056 3.25318 18.7768 3.37333 18.9142C3.48692 19.044 3.63036 19.1868 3.77506 19.3315L5.18928 17.9172C5.02579 17.7538 4.93809 17.6653 4.87864 17.5974C4.82577 17.5369 4.8418 17.5437 4.86171 17.5897L3.02657 18.3848ZM2.95656 16.9811C2.8093 17.4421 2.83417 17.9408 3.02657 18.3848L4.86171 17.5897V17.5897L2.95656 16.9811ZM3.60715 15.9647C3.47756 16.123 3.34903 16.2793 3.24892 16.4198C3.14303 16.5684 3.02977 16.7519 2.95656 16.9811L4.86171 17.5897C4.84647 17.6374 4.83119 17.6457 4.87779 17.5803C4.93018 17.5068 5.00865 17.4101 5.15506 17.2311L3.60715 15.9647ZM4.2114 15.2261C4.2253 15.1228 4.26548 15.1111 4.15237 15.2738C4.0448 15.4286 3.87903 15.6324 3.60715 15.9647L5.15506 17.2311C5.40558 16.9249 5.63162 16.6498 5.79469 16.4152C5.95222 16.1885 6.14188 15.8768 6.19355 15.4928L4.2114 15.2261ZM4.2114 15.2261L4.2114 15.2261L6.19355 15.4928C6.28934 14.7806 5.99575 14.0718 5.42445 13.636L4.2114 15.2261ZM3.26193 15.1312C3.68915 15.1739 3.95044 15.2008 4.13595 15.2342C4.33101 15.2693 4.29432 15.2894 4.2114 15.2261L5.42445 13.636C5.11633 13.4009 4.76184 13.3147 4.49017 13.2658C4.20894 13.2152 3.85458 13.1805 3.46093 13.1411L3.26193 15.1312ZM2.08323 14.8725C2.29705 14.9828 2.50683 15.0324 2.6868 15.0626C2.85693 15.0912 3.05831 15.1108 3.26193 15.1312L3.46094 13.1411C3.23089 13.1181 3.10701 13.1052 3.01798 13.0902C2.93878 13.0769 2.95549 13.0721 3 13.095L2.08323 14.8725ZM1.14009 13.8304C1.31803 14.2804 1.65311 14.6507 2.08323 14.8725L3 13.095H3L1.14009 13.8304ZM1 12.6318C1 12.8364 0.999483 13.0387 1.01098 13.2109C1.02314 13.393 1.05163 13.6066 1.14009 13.8304L3 13.095C3.01841 13.1416 3.01188 13.1577 3.00653 13.0776C3.00052 12.9875 3 12.863 3 12.6318H1ZM1 11.3683V12.6318H3V11.3683H1ZM1.14017 10.1694C1.05166 10.3932 1.02315 10.607 1.01098 10.7891C0.999483 10.9613 1 11.1637 1 11.3683H3C3 11.1371 3.00052 11.0125 3.00654 10.9224C3.01189 10.8423 3.01842 10.8584 3 10.905L1.14017 10.1694ZM2.08305 9.12757C1.65308 9.34939 1.3181 9.71954 1.14017 10.1694L3 10.905L3 10.905L2.08305 9.12757ZM3.26205 8.86881C3.05837 8.88917 2.85694 8.9088 2.68677 8.93737C2.50676 8.9676 2.29692 9.01724 2.08305 9.12757L3 10.905C2.95548 10.928 2.93877 10.9231 3.01798 10.9098C3.10704 10.8948 3.23094 10.8819 3.46105 10.8589L3.26205 8.86881ZM3.36155 8.86384H3.36155V10.8638H3.36155V8.86384ZM3.36156 8.86384H3.36155V10.8638H3.36156V8.86384ZM4.21177 8.77383C4.29471 8.71055 4.33141 8.73069 4.1363 8.7658C3.95075 8.7992 3.68939 8.82607 3.26205 8.86881L3.46106 10.8589C3.85482 10.8195 4.20927 10.7848 4.49056 10.7342C4.76231 10.6853 5.1169 10.5989 5.42506 10.3638L4.21177 8.77383ZM4.21177 8.77383L4.21178 8.77383L5.42506 10.3638C5.99613 9.92801 6.28962 9.21944 6.19396 8.50749L4.21177 8.77383ZM3.60732 8.03506C3.87929 8.36746 4.04511 8.5713 4.15272 8.72614C4.26586 8.88895 4.22567 8.87724 4.21177 8.77383L6.19396 8.50749C6.14234 8.1233 5.95263 7.81151 5.79506 7.58478C5.63195 7.35006 5.40584 7.07487 5.15523 6.76858L3.60732 8.03506ZM2.95652 7.01822C3.02973 7.24751 3.14303 7.43102 3.24896 7.5797C3.3491 7.72027 3.47768 7.8766 3.60732 8.03506L5.15523 6.76858C5.00876 6.58956 4.93026 6.49279 4.87785 6.41923C4.83123 6.35379 4.84651 6.36215 4.86175 6.40988L2.95652 7.01822ZM3.02651 5.61498C2.83424 6.05887 2.80938 6.5574 2.95652 7.01822L4.86175 6.40988L3.02651 5.61498ZM3.77523 4.66798C3.63047 4.81274 3.48698 4.9555 3.37335 5.08539C3.25316 5.2228 3.12217 5.39412 3.02651 5.61498L4.86175 6.40988C4.84184 6.45585 4.8258 6.46265 4.8787 6.40219C4.93816 6.33421 5.02589 6.24574 5.18944 6.0822L3.77523 4.66798ZM4.66855 3.77466L3.77523 4.66798L5.18944 6.0822L6.08276 5.18888L4.66855 3.77466ZM4.66855 3.77466L4.66855 3.77466L6.08276 5.18888L6.08276 5.18887L4.66855 3.77466ZM5.6152 3.02616C5.39443 3.12181 5.22317 3.25276 5.08582 3.37292C4.95597 3.48651 4.81325 3.62995 4.66855 3.77466L6.08276 5.18887C6.24625 5.02538 6.33469 4.93768 6.40264 4.87824C6.46309 4.82536 6.45629 4.84139 6.41034 4.8613L5.6152 3.02616ZM7.01892 2.95614C6.55795 2.80889 6.05923 2.83377 5.6152 3.02615L6.41033 4.8613H6.41034L7.01892 2.95614ZM8.03543 3.60681C7.87702 3.47719 7.72073 3.34865 7.58021 3.24853C7.43158 3.14264 7.24813 3.02936 7.01892 2.95614L6.41034 4.8613C6.36262 4.84606 6.35426 4.83078 6.41969 4.8774C6.49324 4.9298 6.58999 5.00829 6.76896 5.15472L8.03543 3.60681ZM8.77391 4.21101C8.87727 4.22493 8.88897 4.26509 8.72621 4.15198C8.57144 4.04441 8.36769 3.87865 8.03543 3.60681L6.76896 5.15472C7.07512 5.40521 7.35018 5.63122 7.58477 5.79427C7.81138 5.95176 8.123 6.14141 8.50697 6.19312L8.77391 4.21101ZM8.77391 4.21101L8.77391 4.21101L8.50697 6.19312C9.21932 6.28905 9.92836 5.99536 10.3642 5.42382L8.77391 4.21101ZM8.86883 3.2618C8.82612 3.6889 8.79926 3.95012 8.76589 4.13558C8.7308 4.33059 8.71068 4.29392 8.77391 4.21101L10.3642 5.42382C10.5992 5.11576 10.6854 4.76136 10.7343 4.48976C10.7849 4.20861 10.8196 3.85435 10.8589 3.46081L8.86883 3.2618ZM9.12739 2.08341C9.01716 2.29719 8.96756 2.50692 8.93736 2.68683C8.9088 2.85692 8.88919 3.05824 8.86883 3.2618L10.8589 3.46081C10.8819 3.23082 10.8948 3.10698 10.9098 3.01798C10.923 2.9388 10.9279 2.9555 10.905 3L9.12739 2.08341ZM10.1698 1.14002C9.71962 1.31796 9.34924 1.65315 9.12739 2.08341L10.905 3L10.905 3L10.1698 1.14002ZM11.3681 1C11.1635 1 10.9612 0.999483 10.7892 1.01097C10.6071 1.02313 10.3935 1.05161 10.1698 1.14002L10.905 3C10.8584 3.0184 10.8423 3.01188 10.9224 3.00653C11.0125 3.00052 11.137 3 11.3681 3V1ZM12.6318 1H11.3681V3H12.6318V1ZM13.8304 1.1401C13.6066 1.05163 13.393 1.02314 13.2109 1.01098C13.0387 0.999483 12.8364 1 12.6318 1V3C12.863 3 12.9875 3.00052 13.0776 3.00653C13.1577 3.01188 13.1416 3.01841 13.095 3L13.8304 1.1401ZM14.8725 2.08322C14.6507 1.65312 14.2804 1.31803 13.8304 1.1401L13.095 3L13.095 3L14.8725 2.08322ZM15 12C15 13.6569 13.6569 15 12 15V17C14.7614 17 17 14.7614 17 12H15ZM12 9C13.6569 9 15 10.3431 15 12H17C17 9.23858 14.7614 7 12 7V9ZM9 12C9 10.3431 10.3431 9 12 9V7C9.23858 7 7 9.23858 7 12H9ZM12 15C10.3431 15 9 13.6569 9 12H7C7 14.7614 9.23858 17 12 17V15Z"
                                            fill="#33363F"/>
                                    </svg>
                                    Cài đặt</a></li>
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

    </div>

    <div class="md:flex justify-between items-center px-5 xl:px-16 py-3 bg-geekBlue hidden">
        <ul class="nav-menu flex justify-start items-center max-w-[600px] xl:max-w-full flex-wrap xl:flex-nowrap  xl:gap-4">
            <li><a href="{{route('screens.vstore.dashboard.index')}}"
                   class="flex justify-start items-center gap-2">Tổng quan</a></li>
            <li><a href="#" class="flex justify-start items-center gap-1">Hàng hóa
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 10L12.7071 15.2929C12.3166 15.6834 11.6834 15.6834 11.2929 15.2929L6 10"
                              stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                <ul class="sub-nav">
                    <li><a href="{{route('screens.vstore.product.request')}}">Tất cả sản phẩm</a></li>
                    <li><a href="{{route('screens.vstore.product.request')}}">Quản lý yêu cầu xét duyệt sản phẩm</a></li>

                    {{--                    <li><a href="#">Thiết lập giá</a></li>--}}
                    {{--                    <li><a href="#">Thiết lập khuyến mãi</a></li>--}}
                </ul>
            </li>
            <li><a href="#" class="flex justify-start items-center gap-1">Quản lý đơn hàng
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 10L12.7071 15.2929C12.3166 15.6834 11.6834 15.6834 11.2929 15.2929L6 10"
                              stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                <ul class="sub-nav">
                    <li><a href="{{Route('screens.vstore.order.new')}}">Đơn hàng mới</a></li>
                    <li><a href="{{Route('screens.vstore.order.index')}}">Tất cả đơn hàng</a></li>
                </ul>
            </li>
            {{--            <li><a href="#" class="flex justify-start items-center gap-2">Đối tác--}}
            {{--                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
            {{--                        <path d="M18 10L12.7071 15.2929C12.3166 15.6834 11.6834 15.6834 11.2929 15.2929L6 10"--}}
            {{--                              stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round"/>--}}
            {{--                    </svg>--}}
            {{--                </a>--}}
            {{--                <ul class="sub-nav">--}}
            {{--                    <li><a href="#">Nhà cung cấp</a></li>--}}
            {{--                    <li><a href="#">Vshop</a></li>--}}
            {{--                    <li><a href="#">Đối tác giao hàng</a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            {{--            <li><a href="#" class="flex justify-start items-center gap-2">Nhân viên--}}
            {{--                </a>--}}
            {{--            </li>--}}
            <li><a href="#" class="flex justify-start items-center gap-2">Tài chính
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 10L12.7071 15.2929C12.3166 15.6834 11.6834 15.6834 11.2929 15.2929L6 10"
                              stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                <ul class="sub-nav">
                    <li><a href="{{Route('screens.vstore.finance.index')}}">Ví</a></li>
                    <li><a href="{{Route('screens.vstore.finance.revenue')}}">Doanh thu</a></li>
                </ul>
            </li>
            {{--            <li><a href="#" class="flex justify-start items-center gap-2">Báo cáo--}}
            {{--                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
            {{--                        <path d="M18 10L12.7071 15.2929C12.3166 15.6834 11.6834 15.6834 11.2929 15.2929L6 10"--}}
            {{--                              stroke="#2F54EB" stroke-width="1.5" stroke-linecap="round"/>--}}
            {{--                    </svg>--}}
            {{--                </a>--}}
            {{--                <ul class="sub-nav">--}}
            {{--                    <li><a href="#">Báo cáo bán hàng</a></li>--}}
            {{--                    <li><a href="#">Báo cáo hàng hóa</a></li>--}}
            {{--                    <li><a href="#">Báo cáo nhà cung cấp</a></li>--}}
            {{--                    <li><a href="#">Báo cáo Vshop</a></li>--}}
            {{--                    <li><a href="#">Báo cáo Admin</a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
        </ul>
        <ul class="flex justify-start items-center gap-3">

            <li title="Ngôn ngữ"><a href="#" class="hover:opacity-70 transition-all duration-500">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="48" height="48" rx="24" fill="white"/>
                        <path
                            d="M24.0003 32.3332C28.6027 32.3332 32.3337 28.6022 32.3337 23.9998C32.3337 19.3975 28.6027 15.6665 24.0003 15.6665C19.398 15.6665 15.667 19.3975 15.667 23.9998C15.667 28.6022 19.398 32.3332 24.0003 32.3332Z"
                            stroke="#2F54EB" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.6667 16.5H21.5C19.875 21.3667 19.875 26.6333 21.5 31.5H20.6667" stroke="#2F54EB"
                              stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M26.5 16.5C28.125 21.3667 28.125 26.6333 26.5 31.5" stroke="#2F54EB" stroke-width="1.2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.5 27.3333V26.5C21.3667 28.125 26.6333 28.125 31.5 26.5V27.3333" stroke="#2F54EB"
                              stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.5 21.5C21.3667 19.875 26.6333 19.875 31.5 21.5" stroke="#2F54EB" stroke-width="1.2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a></li>
            <li title="Thông báo" class="notify relative"><a href="#"
                                                             class="hover:opacity-70 transition-all duration-500 relative">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="48" height="48" rx="24" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M22.6033 30.7552C23.035 31.236 23.5892 31.5002 24.1642 31.5002H24.165C24.7425 31.5002 25.2992 31.236 25.7317 30.7543C25.8426 30.6311 25.998 30.557 26.1636 30.5483C26.3291 30.5397 26.4914 30.5971 26.6146 30.7081C26.7378 30.819 26.8119 30.9744 26.8206 31.14C26.8293 31.3055 26.7718 31.4678 26.6608 31.591C25.9875 32.3385 25.1025 32.7502 24.165 32.7502H24.1633C23.23 32.7493 22.345 32.3377 21.6742 31.5902C21.6194 31.5292 21.5771 31.4579 21.5498 31.3806C21.5225 31.3032 21.5107 31.2213 21.515 31.1394C21.5194 31.0575 21.5399 30.9772 21.5753 30.9032C21.6106 30.8292 21.6603 30.7629 21.7213 30.7081C21.7823 30.6533 21.8535 30.611 21.9308 30.5837C22.0082 30.5564 22.0901 30.5446 22.1721 30.5489C22.254 30.5533 22.3342 30.5738 22.4082 30.6092C22.4822 30.6445 22.5485 30.6942 22.6033 30.7552ZM24.2058 14.8335C27.91 14.8335 30.3983 17.7185 30.3983 20.4127C30.3983 21.7985 30.7508 22.386 31.125 23.0093C31.495 23.6243 31.9142 24.3227 31.9142 25.6427C31.6233 29.0152 28.1025 29.2902 24.2058 29.2902C20.3092 29.2902 16.7875 29.0152 16.5 25.696C16.4975 24.3227 16.9167 23.6243 17.2867 23.0093L17.4175 22.7893C17.7392 22.2368 18.0133 21.6352 18.0133 20.4127C18.0133 17.7185 20.5017 14.8335 24.2058 14.8335ZM24.2058 16.0835C21.2933 16.0835 19.2642 18.3652 19.2642 20.4127C19.2642 22.1452 18.7825 22.946 18.3575 23.6527C18.0167 24.2202 17.7475 24.6685 17.7475 25.6427C17.8867 27.2143 18.9242 28.0402 24.2058 28.0402C29.4583 28.0402 30.5283 27.1777 30.6667 25.5885C30.6642 24.6685 30.395 24.2202 30.0542 23.6527C29.6292 22.946 29.1483 22.1452 29.1483 20.4127C29.1483 18.3652 27.1183 16.0835 24.2067 16.0835H24.2058Z"
                              fill="#2F54EB"/>
                    </svg>
                    <span
                        class="text-center absolute top-[-10px] right-0 rounded-full w-[24px] h-[24px] bg-[#FF4D4F] text-[#FFF] text-sm after:content-['{{count(Auth::user()->unreadNotifications) ?? 0}}'] after:text-sm flex justify-center items-center"></span>
                </a>
                <ul class="sub-nav-notify">
                    <div class="flex justify-between items-center w-full pb-3 px-3">
                        <h2 class="text-xl font-normal text-title">Thông báo</h2>
                        <a href="#" class="hover:text-primary duration-200 transition-all text-title font-medium">Tất
                            cả</a>
                    </div>
                    @if(count(Auth::user()->unreadNotifications) > 0)
                        @foreach (Auth::user()->unreadNotifications as $index =>$notification)
                            <li>
                                <a href="{{$notification['data']['href']}}&noti_id={{$notification->id}}"
                                   class="flex justify-between items-center w-full text-sm text-title font-bold"><span>{{$notification['data']['message']}} </span>
                                    <span>{{\Illuminate\Support\Carbon::parse($notification->created_at)->format('h:i A')}} </span></a>
                            </li>
                        @endforeach
                    @else
                        <div class="text-center"><p>Bạn chưa có thông báo mới nào</p></div>
                    @endif


                </ul>
            </li>
            </li>
        </ul>
    </div>
</header>
