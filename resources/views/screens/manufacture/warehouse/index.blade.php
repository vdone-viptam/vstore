@extends('layouts.manufacture.main')

@section('modal')
    <div class="modal modal-details">
        <div class="over-lay-modal" onclick="$('.modal-details').toggleClass('show-modal')"></div>
        <div
            class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-4">
            <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                <h2 class="text-base text-title font-medium">Thông tin chi tiết</h2>
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
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Mã sản phẩm:</span>
                        <span class="text-title">VSC1232</span>
                    </div>

                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Tên sản phẩm:</span>
                        <span class="text-title">Sữa</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Nhà cung cấp:</span>
                        <span class="text-title">30,000</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Giá bán:</span>
                        <span class="text-title">VSC1232</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Chiết khấu:</span>
                        <span class="text-title">2%</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Số lượng bán:</span>
                        <span class="text-title">50</span>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-4 ">
                    <button
                        class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70"
                        onclick="$('.modal-details').toggleClass('show-modal')">Đóng lại
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Kho hàng</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="./" class="text-blueMain font-medium">Quản lý kho hàng</a>
    </div>
    <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">

        <div class="flex justify-start items-start gap-2 flex-wrap">
            <select name="" id=""
                    class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                <option value="0" selected>Tất cả</option>
                <option value="1">Mã sản phẩm</option>
                <option value="2">Tên sản phẩm</option>
                <option value="3">Thương hiệu</option>
                <option value="4">Ngành hàng</option>
            </select>

            <input type="text"
                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200"
                   placeholder="Nhập từ khóa">
            <input type="submit"
                   class="cursor-pointer transition-all duration-200 hover:bg-[#FFF] hover:text-blueMain outline-none rounded-sm border-[1px] border-blueMain bg-blueMain px-4 py-[5px] text-[#FFF]"
                   value="Lọc">
        </div>
        <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <h2 class="text-xl md:text-3xl font-medium">Quản lý kho hàng</h2>
                <div class="flex justify-start md:justify-end items-center gap-2 flex-wrap md:flex-nowrap">
                    <button
                        class="bg-primary border-primary hover:opacity-70 transition-all duration-300 shadow-lg rounded-sm py-[6px] px-[15px] text-[#FFF] flex justify-start items-center gap-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_4_2870)">
                                <rect width="20" height="20" fill="white" fill-opacity="0.01"/>
                                <path
                                    d="M10 1.25C5.16797 1.25 1.25 5.16797 1.25 10C1.25 14.832 5.16797 18.75 10 18.75C14.832 18.75 18.75 14.832 18.75 10C18.75 5.16797 14.832 1.25 10 1.25ZM13.75 10.4688C13.75 10.5547 13.6797 10.625 13.5938 10.625H10.625V13.5938C10.625 13.6797 10.5547 13.75 10.4688 13.75H9.53125C9.44531 13.75 9.375 13.6797 9.375 13.5938V10.625H6.40625C6.32031 10.625 6.25 10.5547 6.25 10.4688V9.53125C6.25 9.44531 6.32031 9.375 6.40625 9.375H9.375V6.40625C9.375 6.32031 9.44531 6.25 9.53125 6.25H10.4688C10.5547 6.25 10.625 6.32031 10.625 6.40625V9.375H13.5938C13.6797 9.375 13.75 9.44531 13.75 9.53125V10.4688Z"
                                    fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_4_2870">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Thêm mới</span>
                    </button>

                </div>

            </div>
            <div class="w-full overflow-scroll">
                <table class="w-full dsth">
                    <thead>
                    <tr>
                        <th>
                            Tên kho hàng
                        </th>
                        <th>
                            Số điện thoại
                        </th>
                        <th>
                            Địa chỉ
                        </th>
                        <th>
                            Loại sản phẩm
                        </th>
                        <th>
                            Sản phẩm đã hết
                        </th>
                        <th>

                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Kho cấp C</td>
                        <td>
                            0356384355
                        </td>
                        <td>
                            67 Khúc Thừa Dụ
                        </td>
                        <td>
                            Lớn
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>

                    </tr>
                    <tr>
                        <td>Kho cấp C</td>
                        <td>
                            0356384355
                        </td>
                        <td>
                            67 Khúc Thừa Dụ
                        </td>
                        <td>
                            Lớn
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>

                    </tr>
                    <tr>
                        <td>Kho cấp C</td>
                        <td>
                            0356384355
                        </td>
                        <td>
                            67 Khúc Thừa Dụ
                        </td>
                        <td>
                            Lớn
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>

                    </tr>
                    <tr>
                        <td>Kho cấp C</td>
                        <td>
                            0356384355
                        </td>
                        <td>
                            67 Khúc Thừa Dụ
                        </td>
                        <td>
                            Lớn
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>

                    </tr>
                    <tr>
                        <td>Kho cấp C</td>
                        <td>
                            0356384355
                        </td>
                        <td>
                            67 Khúc Thừa Dụ
                        </td>
                        <td>
                            Lớn
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>

                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="flex justify-end items-center gap-4 flex-wrap">
                <span class="text-sm text-title">Tổng: <strong class="font-bold">1.241</strong></span>
                <ul class="pagination flex justify-start items-center gap-2 flex-wrap">
                    <li><a href="javascript:void(0)">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.66213 2.06646V1.03119C9.66213 0.941456 9.55901 0.891902 9.48936 0.946813L3.45186 5.66244C3.40056 5.70233 3.35906 5.75341 3.3305 5.81179C3.30195 5.87016 3.28711 5.93429 3.28711 5.99927C3.28711 6.06425 3.30195 6.12838 3.3305 6.18675C3.35906 6.24512 3.40056 6.29621 3.45186 6.3361L9.48936 11.0517C9.56034 11.1066 9.66213 11.0571 9.66213 10.9673V9.93208C9.66213 9.86646 9.63133 9.80351 9.58043 9.76333L4.759 5.99994L9.58043 2.23521C9.63133 2.19503 9.66213 2.13208 9.66213 2.06646Z"
                                    fill="#D9D9D9"/>
                            </svg>
                        </a></li>
                    <li><a href="javascript:void(0)">1</a></li>
                    <li><a href="javascript:void(0)">...</a></li>
                    <li><a href="javascript:void(0)">4</a></li>
                    <li><a href="javascript:void(0)">5</a></li>
                    <li class="active"><a href="">6</a></li>
                    <li><a href="javascript:void(0)">7</a></li>
                    <li><a href="javascript:void(0)">8</a></li>
                    <li><a href="javascript:void(0)">...</a></li>
                    <li><a href="javascript:void(0)">50</a></li>
                    <li><a href="javascript:void(0)">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.22 5.66281L4.18253 0.947189C4.16676 0.934768 4.1478 0.92705 4.12783 0.924919C4.10787 0.922788 4.08771 0.926332 4.06966 0.935143C4.05162 0.943955 4.03643 0.957676 4.02584 0.974732C4.01524 0.991787 4.00967 1.01149 4.00977 1.03156V2.06683C4.00977 2.13246 4.04057 2.1954 4.09146 2.23558L8.91289 6.00031L4.09146 9.76505C4.03923 9.80522 4.00977 9.86817 4.00977 9.9338V10.9691C4.00977 11.0588 4.11289 11.1083 4.18253 11.0534L10.22 6.33781C10.2714 6.29779 10.3129 6.24658 10.3414 6.1881C10.37 6.12962 10.3848 6.06539 10.3848 6.00031C10.3848 5.93523 10.37 5.87101 10.3414 5.81253C10.3129 5.75404 10.2714 5.70284 10.22 5.66281Z"
                                    fill="black" fill-opacity="0.85"/>
                            </svg>
                        </a></li>
                </ul>
                <div class="flex justify-start items-center gap-2 flex-wrap">
                    <select name=""
                            class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                        <option value="">10 hàng / trang</option>
                        <option value="">25 hàng / trang</option>
                        <option value="">50 hàng / trang</option>
                    </select>
                    <div class="flex justify-start items-center gap-2">
                        <span class="text-title text-sm">Đi đến</span>
                        <input type="number"
                               class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-2 py-[6px] w-[60px] focus:border-primary transition-all duration-200"
                               min="1">
                    </div>
                </div>
            </div>
        </div>
        <div></div>
    </div>
@endsection
