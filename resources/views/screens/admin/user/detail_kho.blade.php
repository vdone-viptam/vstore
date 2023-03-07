<div class="modal modal-details">
    <div class="over-lay-modal" onclick="$('.modal-details').toggleClass('show-modal')"></div>
    <div
        class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-4">
        <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
            <div></div>
            <h2 class="text-xl text-title font-semibold">Thông tin đăng ký</h2>
            <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                 onclick="$('.modal-details').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                    fill="black" fill-opacity="0.45"/>
            </svg>
        </div>
        <div class="content  max-h-[600px] overflow-y-auto">
            <div class="flex flex-col justify-start items-start gap-4 py-3 w-full">
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Diện tích sàn:</span>
                    <span class="text-title">{{$user->floor_area}}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Thể tích:</span>
                    <span class="text-title">{{$user->volume}}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Ảnh kho hàng:</span>
                    <span class="text-title">
                        @foreach(json_decode($user->image_storage) as $img)
                           <p> <img style="width: 200px;height: 50px" src="{{asset($img) ?? ''}}" alt=""></p>
                        @endforeach
                    </span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Ảnh chứng nhận PCCC:</span>
                    <span class="text-title">
                                    @foreach(json_decode($user->image_pccc) as $img)
                           <p> <img style="width: 200px;height: 50px" src="{{asset($img) ?? ''}}" alt=""></p>
                        @endforeach

                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Diện tích kho lạnh:</span>
                    <span class="text-title">{{$user->cold_storage}} m2</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Diện tích kho bãi:</span>
                    <span class="text-title">{{$user->warehouse}} m2</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Diện tích kho thường:</span>
                    <span class="text-title">{{$user->normal_storage}} m2</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Ngày đăng ký:</span>
                    <span
                        class="text-title">{{\Illuminate\Support\Carbon::parse($user->created_at)->format('d/m/Y h:i A')}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
