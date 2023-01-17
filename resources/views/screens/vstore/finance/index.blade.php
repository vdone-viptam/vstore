@extends('layouts.vstore.main')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        <div class="col-span-3">

            <div class="p-6">

                <ul class="tab-sub-user">
                    <li class="active"><a href="{{route('screens.vstore.order.index')}}"
                                          class="flex justify-start items-end gap-2">
                            <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                                 viewBox="0 0 969.486 969.486" xml:space="preserve">
           <g>
               <g>
                   <path d="M806.582,235.309L766.137,87.125l-137.434,37.51L571.451,9.072L114.798,235.309H0v725.105h907.137V764.973h62.35v-337.53
                       h-62.352V235.309H806.582z M718.441,170.63l17.654,64.68h-52.561h-75.887h-126.19l111.159-30.339l66.848-18.245L718.441,170.63z
                        M839.135,892.414H68V522.062v-129.13v-10.233v-69.787v-9.602h35.181h27.538h101.592h409.025h75.889h37.43h35.242h35.244h13.994
                       v51.272v72.86h-15.357h-35.244h-87.85H547.508h-55.217v27.356v75.888v8.758v35.244v35.244v155.039h346.846v127.441H839.135z
                        M901.486,696.973h-28.352h-34H560.291V591.375v-35.244v-35.244v-23.889v-1.555h3.139h90.086h129.129h56.492h34h4.445h23.904
                       V696.973z M540.707,100.191l21.15,42.688l-238.955,65.218L540.707,100.191z"></path>
                   <polygon
                       points="614.146,564.57 614.146,576.676 614.146,631.152 680.73,631.152 680.73,564.57 658.498,564.57 		"></polygon>
               </g>
           </g>
           </svg>
                            Ví</a></li>
                    <li><a href="{{route('screens.vstore.order.index')}}" class="flex justify-start items-end gap-2">
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
                                              d="M75.11,117h0A21.34,21.34,0,0,1,53.83,95.57V31.39A21.34,21.34,0,0,1,75.11,10h0A21.34,21.34,0,0,1,96.39,31.39V95.57A21.34,21.34,0,0,1,75.11,117Z"></path>

                                        <rect class="cls-1" height="64.17" width="319.22" x="96.39" y="31.39"></rect>

                                        <rect class="cls-1" height="320.87" width="319.22" x="96.39" y="95.57"></rect>

                                        <path class="cls-1"
                                              d="M34.34,39.08H53.83a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H34.34A24.34,24.34,0,0,1,10,63.54v-.13A24.34,24.34,0,0,1,34.34,39.08Z"></path>

                                        <path class="cls-1"
                                              d="M436.89,117h0a21.34,21.34,0,0,0,21.28-21.39V31.39A21.34,21.34,0,0,0,436.89,10h0a21.34,21.34,0,0,0-21.28,21.39V95.57A21.34,21.34,0,0,0,436.89,117Z"></path>

                                        <path class="cls-1"
                                              d="M482.51,39.08H502a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H482.51a24.34,24.34,0,0,1-24.34-24.34v-.13a24.34,24.34,0,0,1,24.34-24.34Z"
                                              transform="translate(960.17 126.96) rotate(-180)"></path>

                                        <path class="cls-1"
                                              d="M75.11,395h0a21.34,21.34,0,0,0-21.28,21.39v64.18A21.34,21.34,0,0,0,75.11,502h0a21.34,21.34,0,0,0,21.28-21.39V416.43A21.34,21.34,0,0,0,75.11,395Z"></path>

                                        <rect class="cls-1" height="64.17" width="319.22" x="96.39" y="416.43"></rect>

                                        <path class="cls-1"
                                              d="M34.34,424.12H53.83a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H34.34A24.34,24.34,0,0,1,10,448.58v-.13A24.34,24.34,0,0,1,34.34,424.12Z"></path>

                                        <path class="cls-1"
                                              d="M436.89,395h0a21.34,21.34,0,0,1,21.28,21.39v64.18A21.34,21.34,0,0,1,436.89,502h0a21.34,21.34,0,0,1-21.28-21.39V416.43A21.34,21.34,0,0,1,436.89,395Z"></path>

                                        <path class="cls-1"
                                              d="M482.51,424.12H502a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H482.51a24.34,24.34,0,0,1-24.34-24.34v-.13a24.34,24.34,0,0,1,24.34-24.34Z"
                                              transform="translate(960.17 897.04) rotate(-180)"></path>

                                        <line class="cls-1" x1="143.41" x2="256" y1="140.11" y2="140.11"></line>

                                        <line class="cls-1" x1="143.41" x2="371.26" y1="186.47" y2="186.47"></line>

                                        <line class="cls-1" x1="143.41" x2="371.26" y1="232.82" y2="232.82"></line>

                                        <line class="cls-1" x1="143.41" x2="371.26" y1="279.18" y2="279.18"></line>

                                        <line class="cls-1" x1="143.41" x2="371.26" y1="325.53" y2="325.53"></line>

                                        <line class="cls-1" x1="256" x2="371.26" y1="371.89" y2="371.89"></line>

                                    </g>

                                </g>

                            </svg>
                            Lịch sử thay đổi số dư</a></li>

                </ul>


            </div>
        </div>
        <div class="col-span-9 ">
            <div class="box w-full">
                <div class="flex flex-col justify-start items-start w-full p-6">
                    <div class="flex flex-col justify-start items-start gap-1 pb-6 border-b-[1px] border-grey w-full">
                        <h3 class="captilize font-medium text-xl text-title">Ví của tôi</h3>
                        <div class="flex justify-start item-center gap-2 w-full  flex-wrap md:flex-nowrap">
                            <span class="text-secondary font-medium text-lg w-[150px]">Số dư tài sản:  </span>
                            <span class="text-title font-medium text-lg w-full">2.000.000.000 VNĐ</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 md:gap-y-0 pt-6 w-full md:p-6 ">
                        <div class="col-span-12 order-last md:order-first">
                            <div class="flex flex-col justify-start items-start gap-6 md:px-6  w-full ">

                                <h4 class="text-title text-2xl font-medium">Rút tiền</h4>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <label class="w-full text-title font-medium" for="val-username">Số tiền cần
                                        rút<strong class="text-[#FF4D4F]">*</strong>
                                    </label>
                                    <input type="number"
                                           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                           min="1" placeholder="0đ" style="border-radius: 0.25rem">
                                </div>
                                <div class="flex justify-start items-start w-full flex-wrap md:flex-nowrap">
                                    <label class="w-full" for="val-username">Phương thức nhận tiền:
                                    </label>
                                    <div class="w-full">
                                        <div class="flex justify-between items-center w-full"
                                             style="border: 1px solid #ced4da; border-radius: 0.25rem; padding: 0.375rem 0.75rem;">
                                            <div class="flex justify-start items-center w-full" style="gap: 10px;">
                                                <div style="width:30px; height:30px">
                                                    <img src="{{asset('asset/images/vc.png')}}" alt=""
                                                         style="max-width:100%; width:100%; height:100%">
                                                </div>
                                                <div>
                                                    <h4 class="m-0">Vietcombank</h4>
                                                    <span
                                                        style="font-size: 12px; line-height: 14px">*********8888</span>
                                                </div>
                                            </div>
                                            <div>
                                                <img src="{{asset('asset/images/check_24px.png')}}" alt="">
                                            </div>
                                        </div>
                                        <a href="javascript:void(0)" class="btn-add-bank">
                                            <div
                                                style="border: 1px solid #ced4da; border-radius: 0.25rem; padding: 0.375rem 0.75rem; margin-top: 20px;">
                                                <div class="flex justify-start items-center w-full" style="gap: 20px;">
                                                    <div style="width:20px;height:20px">
                                                        <img src="{{asset('asset/images/plus.png')}}" alt=""
                                                             style="max-width:100%; width:100%; height:100%">
                                                    </div>
                                                    <div>
                                                        <h4 class="m-0">Thêm ngân hàng</h4>
                                                        <span style="font-size: 12px; line-height: 14px">Miễn phí nạp, rút tiền</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="flex justify-end items-center gap-4 p-6">
                                <button
                                    class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 text-center text-[#FFFFFF] hover:opacity-70">
                                    Rút tiền
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


    </div>

@endsection
