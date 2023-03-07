@extends('layouts.manufacture.main')
@section('page_title','Quản lý xuất - nhập kho')

@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Kho hàng</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="" class="text-blueMain font-medium italic">Quản lý xuất - nhập kho</a>
    </div>
    <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">
        {{--        <div class="flex justify-start items-start gap-2 flex-wrap">--}}
        {{--            <select name="" id=""--}}
        {{--                    class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">--}}
        {{--                <option value="0" selected>Tất cả</option>--}}
        {{--                <option value="1">Mã sản phẩm</option>--}}
        {{--                <option value="2">Tên sản phẩm</option>--}}
        {{--                <option value="3">Thương hiệu</option>--}}
        {{--                <option value="4">Ngành hàng</option>--}}
        {{--            </select>--}}

        {{--            <input type="text"--}}
        {{--                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200"--}}
        {{--                   placeholder="Nhập từ khóa">--}}
        {{--            <input type="submit"--}}
        {{--                   class="text-blue-700  cursor-pointer transition-all duration-200 hover:bg-[#FFF] hover:text-blueMain outline-none rounded-sm border-[1px] border-blueMain bg-blueMain px-4 py-[5px] text-[#FFF]"--}}
        {{--                   value="Lọc">--}}
        {{--        </div>--}}
        <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <h2 class="text-xl md:text-3xl font-medium flex items-center gap-4">
                    <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4"
                              d="M9.98897 20.501L1.87431 24.4191C1.26151 24.7407 0.497103 24.526 0.154355 23.9361C0.0542551 23.7506 0.0013219 23.5445 0 23.3349V14.5648C0 15.4343 0.507167 15.971 1.84123 16.5722L9.98897 20.501Z"
                              fill="url(#paint0_linear_98_611)"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M6.11907 0.416626H13.8368C17.2216 0.416626 19.9669 1.70477 20 5.00028V23.3349C19.9986 23.541 19.9457 23.7437 19.8456 23.9253C19.6849 24.2216 19.4074 24.4415 19.0768 24.5347C18.7462 24.6278 18.391 24.5861 18.0926 24.4191L9.98897 20.501L1.84123 16.5721C0.507167 15.971 0 15.4343 0 14.5648V5.00028C0 1.70477 2.74531 0.416626 6.11907 0.416626ZM5.28115 9.62687H14.6858C15.2277 9.62687 15.667 9.19913 15.667 8.67149C15.667 8.14386 15.2277 7.71612 14.6858 7.71612H5.28115C4.73921 7.71612 4.29989 8.14386 4.29989 8.67149C4.29989 9.19913 4.73921 9.62687 5.28115 9.62687Z"
                              fill="url(#paint1_linear_98_611)"/>
                        <defs>
                            <linearGradient id="paint0_linear_98_611" x1="4.99449" y1="14.5648" x2="4.99449"
                                            y2="24.5684" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#7280FD"/>
                                <stop offset="0.0001" stop-color="#1E90FF"/>
                                <stop offset="1" stop-color="#4062FF"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear_98_611" x1="10" y1="0.416626" x2="10" y2="24.5833"
                                            gradientUnits="userSpaceOnUse">
                                <stop stop-color="#7280FD"/>
                                <stop offset="0.0001" stop-color="#1E90FF"/>
                                <stop offset="1" stop-color="#4062FF"/>
                            </linearGradient>
                        </defs>
                    </svg>

                    Quản lý xuất - nhập kho
                </h2>

                <div class="flex justify-start md:justify-end items-center gap-2 flex-wrap md:flex-nowrap">
                    {{--                    <button--}}
                    {{--                        class="bg-primary border-primary hover:opacity-70 transition-all duration-300 shadow-lg rounded-[10px] py-[6px] px-[15px] text-[#FFF] flex justify-start items-center gap-3">--}}
                    {{--                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
                    {{--                            <g clip-path="url(#clip0_4_2870)">--}}
                    {{--                                <rect width="20" height="20" fill="white" fill-opacity="0.01"/>--}}
                    {{--                                <path--}}
                    {{--                                    d="M10 1.25C5.16797 1.25 1.25 5.16797 1.25 10C1.25 14.832 5.16797 18.75 10 18.75C14.832 18.75 18.75 14.832 18.75 10C18.75 5.16797 14.832 1.25 10 1.25ZM13.75 10.4688C13.75 10.5547 13.6797 10.625 13.5938 10.625H10.625V13.5938C10.625 13.6797 10.5547 13.75 10.4688 13.75H9.53125C9.44531 13.75 9.375 13.6797 9.375 13.5938V10.625H6.40625C6.32031 10.625 6.25 10.5547 6.25 10.4688V9.53125C6.25 9.44531 6.32031 9.375 6.40625 9.375H9.375V6.40625C9.375 6.32031 9.44531 6.25 9.53125 6.25H10.4688C10.5547 6.25 10.625 6.32031 10.625 6.40625V9.375H13.5938C13.6797 9.375 13.75 9.44531 13.75 9.53125V10.4688Z"--}}
                    {{--                                    fill="white"/>--}}
                    {{--                            </g>--}}
                    {{--                            <defs>--}}
                    {{--                                <clipPath id="clip0_4_2870">--}}
                    {{--                                    <rect width="20" height="20" fill="white"/>--}}
                    {{--                                </clipPath>--}}
                    {{--                            </defs>--}}
                    {{--                        </svg>--}}
                    {{--                        <span>Thêm mới</span>--}}
                    {{--                    </button>--}}
                    {{--                    <button--}}
                    {{--                        class="bg-primary border-primary hover:opacity-70 transition-all duration-300 shadow-lg rounded-sm py-[6px] px-[15px] text-[#FFF] flex justify-start items-center gap-3">--}}
                    {{--                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
                    {{--                            <g clip-path="url(#clip0_4_2870)">--}}
                    {{--                                <rect width="20" height="20" fill="white" fill-opacity="0.01"/>--}}
                    {{--                                <path--}}
                    {{--                                    d="M10 1.25C5.16797 1.25 1.25 5.16797 1.25 10C1.25 14.832 5.16797 18.75 10 18.75C14.832 18.75 18.75 14.832 18.75 10C18.75 5.16797 14.832 1.25 10 1.25ZM13.75 10.4688C13.75 10.5547 13.6797 10.625 13.5938 10.625H10.625V13.5938C10.625 13.6797 10.5547 13.75 10.4688 13.75H9.53125C9.44531 13.75 9.375 13.6797 9.375 13.5938V10.625H6.40625C6.32031 10.625 6.25 10.5547 6.25 10.4688V9.53125C6.25 9.44531 6.32031 9.375 6.40625 9.375H9.375V6.40625C9.375 6.32031 9.44531 6.25 9.53125 6.25H10.4688C10.5547 6.25 10.625 6.32031 10.625 6.40625V9.375H13.5938C13.6797 9.375 13.75 9.44531 13.75 9.53125V10.4688Z"--}}
                    {{--                                    fill="white"/>--}}
                    {{--                            </g>--}}
                    {{--                            <defs>--}}
                    {{--                                <clipPath id="clip0_4_2870">--}}
                    {{--                                    <rect width="20" height="20" fill="white"/>--}}
                    {{--                                </clipPath>--}}
                    {{--                            </defs>--}}
                    {{--                        </svg>--}}
                    {{--                        <span>Thêm mới</span>--}}
                    {{--                    </button>--}}

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
                            Tên sản phẩm
                        </th>
                        <th>
                            Tình trạng
                        </th>
                        <th>
                            Số lượng
                        </th>
                        <th>
                            Thời gian
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(count($products) > 0)
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->ware_name}}</td>
                                <td>
                                    {{$product->name}}
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        Đã nhập
                                    @elseif($product->status == 2)
                                        Đã xuất
                                    @elseif($product->status == 3)
                                        Chờ duyệt
                                    @elseif($product->status == 5 )
                                        Từ chối nhập
                                    @elseif($product->status == 0 )
                                        Chờ nhập
                                    @endif
                                </td>
                                <td>
                                    {{$product->amount}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
                                </td>


                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">Không tìm thấy dữ liệu phù hợp</td>
                        </tr>
                    @endif


                    </tbody>
                </table>
            </div>
            <div class="flex justify-end items-center gap-4 flex-wrap">

                {{$products->withQueryString()->links()}}
                <div class="flex justify-start items-center gap-2 flex-wrap">
                    <select name=""
                            class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                        <option value="">10 hàng / trang</option>
                        <option value="">25 hàng / trang</option>
                        <option value="">50 hàng / trang</option>
                    </select>
                </div>
            </div>
        </div>
        <div></div>
    </div>
@endsection
