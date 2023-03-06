<header class="top-0 hidden md:block " >
<div class=" w-full bg-[#F2F8FF] nav py-2 xl:px-12 px-4 fixed top-0 right-0 z-[6]">
<div class="flex justify-end lg:justify-end items-center">
        <div
            class="flex justify-end gap-6 xl:justify-end lg:justify-between items-center xl:gap-6 py-4 md:py-0">

            <div class="user relative flex items-center gap-2">
            <div class="flex flex-col gap-[3px] justify-center">
                    <p class="text-black 2xl:text-base xl:text-sm font-medium cursor-pointer">Xin chào, {{strtoupper(\Illuminate\Support\Facades\Auth::user()->account_code) }}!</p>
                </div>
                <div class="w-[51px]">
                    <div class="w-[50px] h-[65px] ">
                        <img class="w-[45px] h-[100px] cursor-pointer object-fill"
                             src="{{asset('asset/images/userNCC.png')}}" >

                    </div>
                </div>
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
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
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
            <div class="notify relative cursor-pointer ">
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
                                <a href="{{$notification['data']['href']}}&noti_id={{$notification->id}}"
                                   class="flex justify-between items-center w-full text-sm text-title font-bold">{{$notification['data']['message']}}
                                    <span>{{\Illuminate\Support\Carbon::parse($notification->created_at)->format('h:i A')}} </span></a>
                            </li>
                        @endforeach
                    @else
                        <div class="text-center"><p>Bạn chưa có thông báo mới nào</p></div>
                    @endif


                </ul>
            </div>
        </div>
    </div>
</div>
<div class="hidden cursor-pointer md:flex  justify-end  my-6  max-w-[1240px] h-[300px] mx-auto">
    @if(\Illuminate\Support\Facades\Auth::user()->banner)
        <img src="{{asset('image/users/'.\Illuminate\Support\Facades\Auth::user()->banner)}}" class="w-full object-fill"
             alt="">
    @endif
    {{--                <img src="{{asset('/image/users/'. \Illuminate\Support\Facades\Auth::user()->banner)}}">--}}

</div>
</header>
