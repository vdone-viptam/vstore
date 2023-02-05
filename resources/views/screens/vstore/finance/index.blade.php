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
        <div class="brc flex justify-start items-center gap-2 py-4">
        <span class="text-secondary">Tài chính</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="./" class="text-blueMain font-medium italic">Ví</a>
    </div>
            <div class="grid grid-cols-1 md:grid-cols-12">
                 <div class="finance col-span-6 rounded-tl-3xl rounded-tr-3xl bg-[#E8ECFD] px-[20px] md:pl-[60px] py-6">
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
                        </svg>Ví của tôi</h3>
                        <div class="flex flex-col item-center w-full  flex-wrap md:flex-nowrap mt-2">
                            <span class="text-[#A4B6C6] text-sm ">Số dư tài sản:  </span>
                            <span class="text-[#4062FF] font-medium text-lg w-full">2.000.000.000 VNĐ</span>
                        </div>
                    </div>
                 </div>     
                 <div class="col-span-12 box rounded-tr-none md:rounded-tr-[30px] rounded-tl-none grid grid-cols-1 md:grid-cols-2 place-items-center gap-32 w-full px-[20px] md:px-[60px] py-10">
                 <div class="flex flex-col items-start gap-6  w-full ">
                 <h3 class="text-title text-lg font-bold flex items-center gap-4"><svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        </svg>Rút tiền</h3>
<div class="flex flex-col items-center gap-2 w-full">
    <label class="w-full text-[#6A6A6A]  text-sm" for="val-username">Số tiền cần
        rút<strong class="text-[#FF4D4F]">*</strong>
    </label>
    <input type="number"
           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#F1F1F4] focus:border-primary transition-all duration-200 rounded-sm"
           min="1" placeholder="0đ" style="border-radius: 0.25rem">
</div>
<div class="flex flex-col items-start w-full flex-wrap md:flex-nowrap">
    <label class="w-full text-[#6A6A6A]  text-sm" for="val-username">Phương thức nhận tiền:
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
                style="border: 1px dashed #1E90FF; border-radius: 0.25rem; padding: 0.375rem 0.75rem; margin-top: 20px;">
                <div class="flex justify-start items-center w-full" style="gap: 20px;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M18.5714 11.4286H11.4286V18.5714C11.4286 18.9503 11.2781 19.3137 11.0102 19.5816C10.7422 19.8495 10.3789 20 10 20C9.62112 20 9.25776 19.8495 8.98985 19.5816C8.72194 19.3137 8.57143 18.9503 8.57143 18.5714V11.4286H1.42857C1.04969 11.4286 0.686328 11.2781 0.418419 11.0102C0.15051 10.7422 0 10.3789 0 10C0 9.62112 0.15051 9.25776 0.418419 8.98985C0.686328 8.72194 1.04969 8.57143 1.42857 8.57143H8.57143V1.42857C8.57143 1.04969 8.72194 0.686328 8.98985 0.418419C9.25776 0.150509 9.62112 0 10 0C10.3789 0 10.7422 0.150509 11.0102 0.418419C11.2781 0.686328 11.4286 1.04969 11.4286 1.42857V8.57143H18.5714C18.9503 8.57143 19.3137 8.72194 19.5816 8.98985C19.8495 9.25776 20 9.62112 20 10C20 10.3789 19.8495 10.7422 19.5816 11.0102C19.3137 11.2781 18.9503 11.4286 18.5714 11.4286Z" fill="#FF9A62"/>
</svg>

                    <div>
                        <h4 class="m-0 text-[#1E90FF]">Thêm ngân hàng</h4>
                        <span style="font-size: 12px; line-height: 14px; color:#AEAEAE;">Miễn phí nạp, rút tiền</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="text-center md:text-right w-full">
<button
    class="btnGra cursor-pointer outline-none  transition-all duration-200 rounded-xl py-3 px-10 text-center text-[#FFFFFF] hover:opacity-70">
    Rút tiền
</button>
</div>

</div>

                     <div class="w-full hidden md:block">
                        <img src="{{asset('asset/images/bnfinance.png')}}" alt="" class="w-full">
                     </div>                   
                </div>                  
            </div>
              
        </div>


    </div>
@endsection
