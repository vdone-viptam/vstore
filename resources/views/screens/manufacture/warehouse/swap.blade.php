@extends('layouts.manufacture.main')

@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Kho hàng</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="./quan-ly-xuat-nhap.html" class="text-blueMain font-medium">Quản lý xuất - nhập kho</a>
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
                <h2 class="text-xl md:text-3xl font-medium">Quản lý xuất - nhập kho</h2>
                <div class="flex justify-start md:justify-end items-center gap-2 flex-wrap md:flex-nowrap">
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
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->ware_name}}</td>
                            <td>
                                {{$product->name}}
                            </td>
                            <td>
                                @if($product->status == 1)
                                    Đã nhập
                                @else
                                    Đã xuất
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


                    </tbody>
                </table>
            </div>
            <div class="flex justify-end items-center gap-4 flex-wrap">
                <span class="text-sm text-title">Tổng: <strong class="font-bold">1.241</strong></span>
                @include('layouts.custom.paginator', ['paginator' => $products])
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
