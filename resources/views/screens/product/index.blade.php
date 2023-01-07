@extends('layouts.main')

@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Sản phẩm</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="../san-pham/" class="text-blueMain font-medium">Quản lý sản phẩm</a>
    </div>
    <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">
        <ul class="tab-th flex justify-start items-start">
            <li class="active"><a href="../san-pham/">Bộ lọc</a></li>
            <li><a href="./lich-su.html">Lịch sử sửa xóa</a></li>
        </ul>
        <div class="flex justify-start items-start gap-2 flex-wrap">
            <select name="" id=""
                    class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                <option value="">Danh mục</option>
            </select>
            <select name="" id=""
                    class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                <option value="">Thương hiệu</option>
            </select>
            <input type="text"
                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200"
                   placeholder="ID">
            <input type="text"
                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200"
                   placeholder="Tên sản phẩm">
            <input type="submit"
                   class="cursor-pointer transition-all duration-200 hover:bg-[#FFF] hover:text-blueMain outline-none rounded-sm border-[1px] border-blueMain bg-blueMain px-4 py-[5px] text-[#FFF]"
                   value="Lọc">
        </div>
        <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <h2 class="text-xl md:text-3xl font-medium">Quản lý sản phẩm</h2>
                <div class="flex justify-start md:justify-end items-center gap-2 flex-wrap md:flex-nowrap">
                    <input type="search"
                           class="py-[6px] px-[15px] border-[#D9D9D9] border-[1px] rounded-sm outline-none focus:border-primary transition-all duration-200"
                           placeholder="Tìm kiếm">
                    <a href="{{route('screens.product.create')}}"
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
                    </a>
                    <button
                        class="border-[#D9D9D9] border-[1px] hover:opacity-70 transition-all duration-300 shadow-lg rounded-sm py-[6px] px-[15px] text-title flex justify-start items-center gap-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1485_11083)">
                                <rect width="20" height="20" fill="white" fill-opacity="0.01"/>
                                <path
                                    d="M4.75 9.98438C4.75 10.0993 4.77263 10.2131 4.81661 10.3192C4.86058 10.4254 4.92503 10.5218 5.00628 10.6031C5.08753 10.6843 5.18399 10.7488 5.29015 10.7928C5.39631 10.8367 5.51009 10.8594 5.625 10.8594C5.73991 10.8594 5.85369 10.8367 5.95985 10.7928C6.06601 10.7488 6.16247 10.6843 6.24372 10.6031C6.32497 10.5218 6.38942 10.4254 6.43339 10.3192C6.47737 10.2131 6.5 10.0993 6.5 9.98438C6.5 9.86947 6.47737 9.75569 6.43339 9.64953C6.38942 9.54337 6.32497 9.44691 6.24372 9.36566C6.16247 9.28441 6.06601 9.21995 5.95985 9.17598C5.85369 9.13201 5.73991 9.10938 5.625 9.10938C5.51009 9.10938 5.39631 9.13201 5.29015 9.17598C5.18399 9.21995 5.08753 9.28441 5.00628 9.36566C4.92503 9.44691 4.86058 9.54337 4.81661 9.64953C4.77263 9.75569 4.75 9.86947 4.75 9.98438ZM9.125 9.98438C9.125 10.2164 9.21719 10.439 9.38128 10.6031C9.54538 10.7672 9.76794 10.8594 10 10.8594C10.2321 10.8594 10.4546 10.7672 10.6187 10.6031C10.7828 10.439 10.875 10.2164 10.875 9.98438C10.875 9.75231 10.7828 9.52975 10.6187 9.36566C10.4546 9.20156 10.2321 9.10938 10 9.10938C9.76794 9.10938 9.54538 9.20156 9.38128 9.36566C9.21719 9.52975 9.125 9.75231 9.125 9.98438ZM13.5 9.98438C13.5 10.2164 13.5922 10.439 13.7563 10.6031C13.9204 10.7672 14.1429 10.8594 14.375 10.8594C14.6071 10.8594 14.8296 10.7672 14.9937 10.6031C15.1578 10.439 15.25 10.2164 15.25 9.98438C15.25 9.75231 15.1578 9.52975 14.9937 9.36566C14.8296 9.20156 14.6071 9.10938 14.375 9.10938C14.1429 9.10938 13.9204 9.20156 13.7563 9.36566C13.5922 9.52975 13.5 9.75231 13.5 9.98438Z"
                                    fill="black" fill-opacity="0.85"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_1485_11083">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Thao thác</span>
                    </button>
                </div>

            </div>
            <div class="w-full overflow-scroll">
                <table class="w-full dsth">
                    <thead>
                    <tr>
                        <th>
                            Tên sản phẩm
                        </th>
                        <th>
                            Mã hàng
                        </th>
                        <th>
                            Số lượng
                        </th>
                        <th>
                            Giá bán
                        </th>
                        <th>
                            Giá vốn
                        </th>
                        <th>
                            Trạng thái
                        </th>
                        <th>
                            Cập nhập
                        </th>
                        <th>
                            Hoạt động
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="flex justify-start items-center gap-2">
                            <div class="w-[48px] h-[48px] rounded">
                                <img src="{{asset('asset/images/sp.png')}}" alt="">
                            </div>
                            <span>Sữa tươi Vinamilk</span>
                        </td>
                        <td>
                            893 GS1
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            30,000
                        </td>
                        <td>
                            10,000
                        </td>
                        <td class="text-[#52C41A]">
                            Đã duyệt
                        </td>
                        <td>
                            1 tuần
                        </td>
                        <td>
                            05/12/2022 - 15:30
                        </td>
                    </tr>
                    <tr>
                        <td class="flex justify-start items-center gap-2">
                            <div class="w-[48px] h-[48px] rounded">
                                <img src="{{asset('asset/images/sp.png')}}" alt="">
                            </div>
                            <span>Sữa tươi Vinamilk</span>
                        </td>
                        <td>
                            893 GS1
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            30,000
                        </td>
                        <td>
                            10,000
                        </td>
                        <td class="text-[#52C41A]">
                            Đã duyệt
                        </td>
                        <td>
                            1 tuần
                        </td>
                        <td>
                            05/12/2022 - 15:30
                        </td>
                    </tr>
                    <tr>
                        <td class="flex justify-start items-center gap-2">
                            <div class="w-[48px] h-[48px] rounded">
                                <img src="{{asset('asset/images/sp.png')}}" alt="">
                            </div>
                            <span>Sữa tươi Vinamilk</span>
                        </td>
                        <td>
                            893 GS1
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            30,000
                        </td>
                        <td>
                            10,000
                        </td>
                        <td class="text-[#52C41A]">
                            Đã duyệt
                        </td>
                        <td>
                            1 tuần
                        </td>
                        <td>
                            05/12/2022 - 15:30
                        </td>
                    </tr>
                    <tr>
                        <td class="flex justify-start items-center gap-2">
                            <div class="w-[48px] h-[48px] rounded">
                                <img src="{{asset('asset/images/sp.png')}}" alt="">
                            </div>
                            <span>Sữa tươi Vinamilk</span>
                        </td>
                        <td>
                            893 GS1
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            30,000
                        </td>
                        <td>
                            10,000
                        </td>
                        <td class="text-[#FAAD14]">
                            Chờ duyệt
                        </td>
                        <td>
                            1 tuần
                        </td>
                        <td>
                            05/12/2022 - 15:30
                        </td>
                    </tr>
                    <tr>
                        <td class="flex justify-start items-center gap-2">
                            <div class="w-[48px] h-[48px] rounded">
                                <img src="{{asset('asset/images/sp.png')}}" alt="">
                            </div>
                            <span>Sữa tươi Vinamilk</span>
                        </td>
                        <td>
                            893 GS1
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            30,000
                        </td>
                        <td>
                            10,000
                        </td>
                        <td class="text-[#52C41A]">
                            Đã duyệt
                        </td>
                        <td>
                            1 tuần
                        </td>
                        <td>
                            05/12/2022 - 15:30
                        </td>
                    </tr>
                    <tr>
                        <td class="flex justify-start items-center gap-2">
                            <div class="w-[48px] h-[48px] rounded">
                                <img src="{{asset('asset/images/sp.png')}}" alt="">
                            </div>
                            <span>Sữa tươi Vinamilk</span>
                        </td>
                        <td>
                            893 GS1
                        </td>
                        <td>
                            12
                        </td>
                        <td>
                            30,000
                        </td>
                        <td>
                            10,000
                        </td>
                        <td class="text-[#FF4D4F]">
                            Thất bại
                        </td>
                        <td>
                            1 tuần
                        </td>
                        <td>
                            05/12/2022 - 15:30
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
