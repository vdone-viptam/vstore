@extends('layouts.vstore.main')

@section('modal')
    <div id="modal2"></div>
@endsection

@section('page_title','Danh sách đơn xét duyệt')

@section('content')

    <div class="modal modal-verify show-modal">
        <div class="over-lay"></div>
        <div class="information rounded-[8px] bg-[#FFF] mx-auto max-w-[300px] md:max-w-[500px] p-6 xl:p-10 mt-4 md:mt-10">
            <div class="flex justify-end items-center">
                <svg width="20" height="20" class="cursor-pointer hover:opacity-70 transition-all duration-200"
                     viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M18.7708 0L9.97917 8.78125L1.22917 0.0416667L0 1.27083L8.75 10L0 18.7396L1.22917 19.9583L9.97917 11.2292L18.7708 20L20 18.7812L11.2083 10L20 1.22917L18.7708 0Z"
                          fill="#D0D0D0"/>
                </svg>

            </div>
            <form class="validate-fail" action="#">
                <div class="flex flex-col justify-start items-start w-full gap-2">
                    <h2 class="text-xl text-mineShaft font-semibold">Xác thực tài khoản qua số điện thoại</h2>
                    <span class="text-sm text-mineShaft">Xin vui lòng nhập mã OTP vừa được gửi tới số điện thoại :
                        <strong class="font-semibold text-pictonBlue">(+84) 987654321</strong></span>
                </div>
                <div class="flex flex-col justify-center items-center gap-2 py-10">
                    <ul class="input-code flex justify-center items-center gap-4">
                        <li><input type="number"
                                   class="outline-none border-b-2 border-logan w-[30px] text-center text-mineShaft text-4xl font-medium"
                                   autofocus></li>
                        <li><input type="number"
                                   class="outline-none border-b-2 border-logan w-[30px] text-center text-mineShaft text-4xl font-medium">
                        </li>
                        <li><input type="number"
                                   class="outline-none border-b-2 border-logan w-[30px] text-center text-mineShaft text-4xl font-medium">
                        </li>
                        <li><input type="number"
                                   class="outline-none border-b-2 border-logan w-[30px] text-center text-mineShaft text-4xl font-medium">
                        </li>
                        <li><input type="number"
                                   class="outline-none border-b-2 border-logan w-[30px] text-center text-mineShaft text-4xl font-medium">
                        </li>
                        <li><input type="number"
                                   class="outline-none border-b-2 border-logan w-[30px] text-center text-mineShaft text-4xl font-medium">
                        </li>
                    </ul>
                    <div class="text-war w-full max-w-[260px]">
                        <span>OTP không hợp lệ </span>
                    </div>
                </div>

            </form>
            <button
                class="mb-4 w-full btn-verify uppercase text-white text-lg font-semibold bg-logan py-[15px] rounded-[10px] cursor-pointer">
                Xác
                nhận
            </button>
            <div class="w-full text-center">
                <span class="text-sm text-mineShaft ">Chưa nhận được mã <a href="#"
                                                                           class="text-pictonBlue underline">Gửi lại (60s)</a></span>

            </div>
        </div>
    </div>
    <script>

    </script>
@endsection
