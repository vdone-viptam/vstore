@extends('layouts.manufacture.main')

@section('modal')
    <div class="modal modal-bank">
        <div class="over-lay-modal" onclick="$('.modal-bank').toggleClass('show-modal')"></div>
        <div
            class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-10 md:mt-24">
            <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                <h2 class="text-base text-title font-medium">Thêm ngân hàng</h2>
                <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                     onclick="$('.modal-bank').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                        fill="black" fill-opacity="0.45"/>
                </svg>
            </div>
            <div class="content  max-h-[600px] overflow-y-auto">
                <div class="flex flex-col justify-start items-start gap-4 py-3 w-full">
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium w-[200px]">Tên chủ thẻ:</span>
                        <input type="text" name=""
                               class="text-opa outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full">
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium w-[200px]">Tên ngân hàng:</span>
                        <select name=""
                                class="w-full outline-none rounded-sm border-[1px] border-[#D9D9D9] px-3 py-[6px] focus:border-primary transition-all duration-200">
                            <option value="0">Vietcombank</option>
                            <option value="0">Techcombank</option>
                        </select>
                    </div>

                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium w-[200px]">Số thẻ:</span>
                        <input type="text" name=""
                               class="text-opa outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full">
                    </div>
                </div>
                <div class="flex justify-end items-center gap-4 ">
                    <button
                        class=" cursor-pointer outline-none bg-[#FFF] transition-all duration-200 rounded-sm py-2 px-3 text-center text-title hover:opacity-70 border-[1px] border-secondary"
                        onclick="$('.modal-bank').toggleClass('show-modal')">Đóng lại
                    </button>
                    <button
                        class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70">
                        Lưu lại
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        <div class="col-span-3">

            <div class="p-6">
                <ul class="tab-sub-user">
                    <li><a href="{{route('screens.manufacture.finance.index')}}"
                           class="flex justify-start items-end gap-2">
                            <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="20" height="20" viewBox="0 0 969.486 969.486"
                                 xml:space="preserve">
                   <g>
                       <g>
                           <path d="M806.582,235.309L766.137,87.125l-137.434,37.51L571.451,9.072L114.798,235.309H0v725.105h907.137V764.973h62.35v-337.53
                               h-62.352V235.309H806.582z M718.441,170.63l17.654,64.68h-52.561h-75.887h-126.19l111.159-30.339l66.848-18.245L718.441,170.63z
                                M839.135,892.414H68V522.062v-129.13v-10.233v-69.787v-9.602h35.181h27.538h101.592h409.025h75.889h37.43h35.242h35.244h13.994
                               v51.272v72.86h-15.357h-35.244h-87.85H547.508h-55.217v27.356v75.888v8.758v35.244v35.244v155.039h346.846v127.441H839.135z
                                M901.486,696.973h-28.352h-34H560.291V591.375v-35.244v-35.244v-23.889v-1.555h3.139h90.086h129.129h56.492h34h4.445h23.904
                               V696.973z M540.707,100.191l21.15,42.688l-238.955,65.218L540.707,100.191z"/>
                           <polygon
                               points="614.146,564.57 614.146,576.676 614.146,631.152 680.73,631.152 680.73,564.57 658.498,564.57 		"/>
                       </g>
                   </g>
                   </svg>
                            Ví</a></li>
                    <li class="active"><a href="{{route('screens.manufacture.finance.history')}}"
                                          class="flex justify-start items-end gap-2">
                            <svg width="20" height="20" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">

                                <defs>

                                    <style>.cls-1 {
                                            fill: none;
                                            stroke: #000000;
                                            stroke-linecap: round;
                                            stroke-linejoin: round;
                                            stroke-width: 20px;
                                        }</style>

                                </defs>

                                <g data-name="Layer 2" id="Layer_2">

                                    <g data-name="E425, History, log, manuscript" id="E425_History_log_manuscript">

                                        <path class="cls-1"
                                              d="M75.11,117h0A21.34,21.34,0,0,1,53.83,95.57V31.39A21.34,21.34,0,0,1,75.11,10h0A21.34,21.34,0,0,1,96.39,31.39V95.57A21.34,21.34,0,0,1,75.11,117Z"/>

                                        <rect class="cls-1" height="64.17" width="319.22" x="96.39" y="31.39"/>

                                        <rect class="cls-1" height="320.87" width="319.22" x="96.39" y="95.57"/>

                                        <path class="cls-1"
                                              d="M34.34,39.08H53.83a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H34.34A24.34,24.34,0,0,1,10,63.54v-.13A24.34,24.34,0,0,1,34.34,39.08Z"/>

                                        <path class="cls-1"
                                              d="M436.89,117h0a21.34,21.34,0,0,0,21.28-21.39V31.39A21.34,21.34,0,0,0,436.89,10h0a21.34,21.34,0,0,0-21.28,21.39V95.57A21.34,21.34,0,0,0,436.89,117Z"/>

                                        <path class="cls-1"
                                              d="M482.51,39.08H502a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H482.51a24.34,24.34,0,0,1-24.34-24.34v-.13a24.34,24.34,0,0,1,24.34-24.34Z"
                                              transform="translate(960.17 126.96) rotate(-180)"/>

                                        <path class="cls-1"
                                              d="M75.11,395h0a21.34,21.34,0,0,0-21.28,21.39v64.18A21.34,21.34,0,0,0,75.11,502h0a21.34,21.34,0,0,0,21.28-21.39V416.43A21.34,21.34,0,0,0,75.11,395Z"/>

                                        <rect class="cls-1" height="64.17" width="319.22" x="96.39" y="416.43"/>

                                        <path class="cls-1"
                                              d="M34.34,424.12H53.83a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H34.34A24.34,24.34,0,0,1,10,448.58v-.13A24.34,24.34,0,0,1,34.34,424.12Z"/>

                                        <path class="cls-1"
                                              d="M436.89,395h0a21.34,21.34,0,0,1,21.28,21.39v64.18A21.34,21.34,0,0,1,436.89,502h0a21.34,21.34,0,0,1-21.28-21.39V416.43A21.34,21.34,0,0,1,436.89,395Z"/>

                                        <path class="cls-1"
                                              d="M482.51,424.12H502a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H482.51a24.34,24.34,0,0,1-24.34-24.34v-.13a24.34,24.34,0,0,1,24.34-24.34Z"
                                              transform="translate(960.17 897.04) rotate(-180)"/>

                                        <line class="cls-1" x1="143.41" x2="256" y1="140.11" y2="140.11"/>

                                        <line class="cls-1" x1="143.41" x2="371.26" y1="186.47" y2="186.47"/>

                                        <line class="cls-1" x1="143.41" x2="371.26" y1="232.82" y2="232.82"/>

                                        <line class="cls-1" x1="143.41" x2="371.26" y1="279.18" y2="279.18"/>

                                        <line class="cls-1" x1="143.41" x2="371.26" y1="325.53" y2="325.53"/>

                                        <line class="cls-1" x1="256" x2="371.26" y1="371.89" y2="371.89"/>

                                    </g>

                                </g>

                            </svg>
                            Lịch sử thay đổi số dư</a></li>

                </ul>
                </li>

                </ul>
            </div>
        </div>
        <div class="col-span-9 ">
            <div class="box w-full">
                <div class="flex flex-col justify-start items-start w-full p-6">
                    <div class="flex flex-col justify-start items-start gap-1 pb-6 border-b-[1px] border-grey w-full">
                        <h3 class="captilize font-medium text-xl text-title flex items-center gap-4"><svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.4" d="M9.98897 20.501L1.87431 24.4191C1.26151 24.7407 0.497103 24.526 0.154355 23.9361C0.0542551 23.7506 0.0013219 23.5445 0 23.3349V14.5648C0 15.4343 0.507167 15.971 1.84123 16.5722L9.98897 20.501Z" fill="url(#paint0_linear_98_611)"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M6.11907 0.416626H13.8368C17.2216 0.416626 19.9669 1.70477 20 5.00028V23.3349C19.9986 23.541 19.9457 23.7437 19.8456 23.9253C19.6849 24.2216 19.4074 24.4415 19.0768 24.5347C18.7462 24.6278 18.391 24.5861 18.0926 24.4191L9.98897 20.501L1.84123 16.5721C0.507167 15.971 0 15.4343 0 14.5648V5.00028C0 1.70477 2.74531 0.416626 6.11907 0.416626ZM5.28115 9.62687H14.6858C15.2277 9.62687 15.667 9.19913 15.667 8.67149C15.667 8.14386 15.2277 7.71612 14.6858 7.71612H5.28115C4.73921 7.71612 4.29989 8.14386 4.29989 8.67149C4.29989 9.19913 4.73921 9.62687 5.28115 9.62687Z" fill="url(#paint1_linear_98_611)"/>
<defs>
<linearGradient id="paint0_linear_98_611" x1="4.99449" y1="14.5648" x2="4.99449" y2="24.5684" gradientUnits="userSpaceOnUse">
<stop stop-color="#7280FD"/>
<stop offset="0.0001" stop-color="#1E90FF"/>
<stop offset="1" stop-color="#4062FF"/>
</linearGradient>
<linearGradient id="paint1_linear_98_611" x1="10" y1="0.416626" x2="10" y2="24.5833" gradientUnits="userSpaceOnUse">
<stop stop-color="#7280FD"/>
<stop offset="0.0001" stop-color="#1E90FF"/>
<stop offset="1" stop-color="#4062FF"/>
</linearGradient>
</defs>
</svg>Lịch sử thay đổi số dư của tôi</h3>
                        <span class="text-secondary text-sm">Quản lý lịch sử thay đổi số dư của bạn</span>
                    </div>
                    <div class=" pt-6 w-full md:p-6 ">
                        <div class="w-full overflow-scroll">
                            <table class="w-full dsth">
                                <thead>
                                <tr>
                                    <th>Mã giao dịch</th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th>
                                        Số tiền
                                    </th>
                                    <th>
                                        Số dư
                                    </th>
                                    <th>
                                        Nội dung
                                    </th>
                                    <th>
                                        Ngày giao dịch
                                    </th>


                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#48BB78]">
                                        Thành công
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#FF0000]">
                                        Thất bại
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#48BB78]">
                                        Thành công
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#48BB78]">
                                        Thành công
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>
                                <tr>
                                    <td>GD-0231</td>

                                    <td class="text-[#48BB78]">
                                        Thành công
                                    </td>
                                    <td>
                                        10.000.000
                                    </td>
                                    <td>
                                        2.000.000.000
                                    </td>
                                    <td>
                                        Chuyển khoản ra ngoài
                                    </td>


                                    <td>
                                        10/4/2022
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
