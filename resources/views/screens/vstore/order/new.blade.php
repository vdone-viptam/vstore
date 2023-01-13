@extends('layouts.vstore.main')
@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Quản lý đơn hàng</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black" stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"></path>
        </svg>
        <a href="./don-chua-hoan-thanh.html" class="text-blueMain font-medium">Đơn hàng chưa hoàn thành</a>
    </div>
    <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">
        <div class="flex justify-start items-start gap-2 flex-wrap">
            <select name="" id="" class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                <option value="0" selected="">Tất cả</option>
                <option value="1">Mã sản phẩm</option>
                <option value="2">Tên sản phẩm</option>
                <option value="3">Thương hiệu</option>
                <option value="4">Ngành hàng</option>
            </select>

            <input type="text" class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200" placeholder="Nhập từ khóa">
            <input type="submit" class="text-blue-700 cursor-pointer transition-all duration-200 hover:bg-[#FFF] hover:text-blueMain outline-none rounded-sm border-[1px] border-blueMain bg-blueMain px-4 py-[5px] text-[#FFF]" value="Lọc">
        </div>
        <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <h2 class="text-xl md:text-3xl font-medium">Đơn hàng chưa hoàn thành</h2>


            </div>
            <div class="w-full overflow-scroll">
                <table class="w-full dsth">
                    <thead>
                    <tr>
                        <th>
                            Mã đơn hàng
                        </th>
                        <th>
                            Tên sản phẩm
                        </th>
                        <th>
                            Giá bán
                        </th>
                        <th>
                            Số lượng
                        </th>
                        <th>Kho hàng</th>
                        <th>
                            Ngày đặt hàng
                        </th>
                        <th>
                            Giá trị đơn hàng
                        </th>
                        <th>
                            V-Shop bán hàng
                        </th>
                        <th>
                            Giá trị trừ chiết khấu
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Vcx12x3</td>
                        <td>
                            Xe máy
                        </td>
                        <td>10.000.000</td>
                        <td>
                            50
                        </td>
                        <td>Kho hàng C</td>
                        <td>
                            10/01/2023
                        </td>
                        <td>
                            12.000.000
                        </td>
                        <td>
                            NguyenLinhShop
                        </td>
                        <td>
                            9.000.000
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Vcx12x3</td>
                        <td>
                            Xe máy
                        </td>
                        <td>10.000.000</td>
                        <td>
                            50
                        </td>
                        <td>Kho hàng C</td>
                        <td>
                            10/01/2023
                        </td>
                        <td>
                            12.000.000
                        </td>
                        <td>
                            NguyenLinhShop
                        </td>
                        <td>
                            9.000.000
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Vcx12x3</td>
                        <td>
                            Xe máy
                        </td>
                        <td>10.000.000</td>
                        <td>
                            50
                        </td>
                        <td>Kho hàng C</td>
                        <td>
                            10/01/2023
                        </td>
                        <td>
                            12.000.000
                        </td>
                        <td>
                            NguyenLinhShop
                        </td>
                        <td>
                            9.000.000
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Vcx12x3</td>
                        <td>
                            Xe máy
                        </td>
                        <td>10.000.000</td>
                        <td>
                            50
                        </td>
                        <td>Kho hàng C</td>
                        <td>
                            10/01/2023
                        </td>
                        <td>
                            12.000.000
                        </td>
                        <td>
                            NguyenLinhShop
                        </td>
                        <td>
                            9.000.000
                        </td>
                        <td>
                            <a href="#" class="more-details text-primary underline"> Chi tiết</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Vcx12x3</td>
                        <td>
                            Xe máy
                        </td>
                        <td>10.000.000</td>
                        <td>
                            50
                        </td>
                        <td>Kho hàng C</td>
                        <td>
                            10/01/2023
                        </td>
                        <td>
                            12.000.000
                        </td>
                        <td>
                            NguyenLinhShop
                        </td>
                        <td>
                            9.000.000
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
                    <li><a href="javascript:void(0)"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.66213 2.06646V1.03119C9.66213 0.941456 9.55901 0.891902 9.48936 0.946813L3.45186 5.66244C3.40056 5.70233 3.35906 5.75341 3.3305 5.81179C3.30195 5.87016 3.28711 5.93429 3.28711 5.99927C3.28711 6.06425 3.30195 6.12838 3.3305 6.18675C3.35906 6.24512 3.40056 6.29621 3.45186 6.3361L9.48936 11.0517C9.56034 11.1066 9.66213 11.0571 9.66213 10.9673V9.93208C9.66213 9.86646 9.63133 9.80351 9.58043 9.76333L4.759 5.99994L9.58043 2.23521C9.63133 2.19503 9.66213 2.13208 9.66213 2.06646Z" fill="#D9D9D9"></path>
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
                    <li><a href="javascript:void(0)"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.22 5.66281L4.18253 0.947189C4.16676 0.934768 4.1478 0.92705 4.12783 0.924919C4.10787 0.922788 4.08771 0.926332 4.06966 0.935143C4.05162 0.943955 4.03643 0.957676 4.02584 0.974732C4.01524 0.991787 4.00967 1.01149 4.00977 1.03156V2.06683C4.00977 2.13246 4.04057 2.1954 4.09146 2.23558L8.91289 6.00031L4.09146 9.76505C4.03923 9.80522 4.00977 9.86817 4.00977 9.9338V10.9691C4.00977 11.0588 4.11289 11.1083 4.18253 11.0534L10.22 6.33781C10.2714 6.29779 10.3129 6.24658 10.3414 6.1881C10.37 6.12962 10.3848 6.06539 10.3848 6.00031C10.3848 5.93523 10.37 5.87101 10.3414 5.81253C10.3129 5.75404 10.2714 5.70284 10.22 5.66281Z" fill="black" fill-opacity="0.85"></path>
                            </svg>
                        </a></li>
                </ul>
                <div class="flex justify-start items-center gap-2 flex-wrap">
                    <select name="" class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                        <option value="">10 hàng / trang</option>
                        <option value="">25 hàng / trang</option>
                        <option value="">50 hàng / trang</option>
                    </select>
                    <div class="flex justify-start items-center gap-2">
                        <span class="text-title text-sm">Đi đến</span>
                        <input type="number" class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-2 py-[6px] w-[60px] focus:border-primary transition-all duration-200" min="1">
                    </div>
                </div>
            </div>
        </div>
        <div></div>
    </div>
@endsection
