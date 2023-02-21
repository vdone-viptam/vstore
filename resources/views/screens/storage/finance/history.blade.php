@extends('layouts.storage.main')


@section('page_title','Lịch sử giao dịch')

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
        <div class="col-span-12 ">
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