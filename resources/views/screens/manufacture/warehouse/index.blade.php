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
                        <span class="text-title font-medium ">Mã kho hàng:</span>
                        <span class="text-title">VSC1232</span>
                    </div>

                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Tên kho hàng:</span>
                        <span class="text-title">Nhà Kho Hải Đăng</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Địa chỉ: </span>
                        <span class="text-title">Việt Nam</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Tổng sản phẩm trong tồn kho: </span>
                        <span class="text-title">100</span>
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
        <a href="#" class="text-blueMain font-medium italic">Quản lý kho hàng</a>
    </div>
    <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">

        <div class="flex justify-start items-start gap-2 flex-wrap">
            <select name="" id=""
                    class="outline-none rounded-xl border-[1px] border-[#C4CDD5] px-4 py-[6px] focus:border-primary transition-all duration-200">
                <option value="0" selected>Tất cả</option>
                <option value="1">Mã sản phẩm</option>
                <option value="2">Tên sản phẩm</option>
                <option value="3">Thương hiệu</option>
                <option value="4">Ngành hàng</option>
            </select>

            <input type="text"
                   class="outline-none rounded-xl border-[1px] border-[#EBEBEB] px-4 py-[5px] focus:border-primary transition-all duration-200"
                   placeholder="Nhập từ khóa">
                   <button type="submit"
                       class="flex items-center gap-2 cursor-pointer transition-all duration-200 hover:opacity-70 rounded-xl outline-none border-[1px] bg-[#40BAFF] text-[#FFF] px-4 py-[5px] "
                       ><svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 6H4L6.28571 11.1316V19.8158L7.80952 21L9.33333 19.8158V11.1316L12 6Z" fill="white"/>
<path d="M13 11H18" stroke="white" stroke-width="2" stroke-linecap="round"/>
<path d="M13 15H18" stroke="white" stroke-width="2" stroke-linecap="round"/>
<path d="M13 19H18" stroke="white" stroke-width="2" stroke-linecap="round"/>
<path d="M1.21336 2.32558L6.69784 10.7209V17.7907C6.69784 18.6744 6.69784 20 7.9635 20C8.97602 20 9.281 18.5271 9.30692 17.7907V10.7209C10.8279 8.36434 14.0386 3.38605 14.7136 2.32558C15.3886 1.26512 14.7136 1 14.2918 1H2.05712C0.707096 1 0.9321 1.88372 1.21336 2.32558Z" stroke="white" stroke-width="2" stroke-linecap="round"/>
</svg>
Lọc</button>
        </div>
        <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
            <div class="flex justify-between items-center flex-wrap gap-4">
            <h2 class="text-xl md:text-3xl font-medium flex items-center gap-4"><svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
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
</svg>

Quản lý kho hàng</h2>

                <div class="flex justify-start md:justify-end items-center gap-2 flex-wrap md:flex-nowrap">
                    <button
                        class="bg-primary border-primary hover:opacity-70 transition-all duration-300 shadow-lg rounded-[10px] py-[6px] px-[15px] text-[#FFF] flex justify-start items-center gap-3">
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
                            Tổng số mặt hàng
                        </th>
                        <th>
                            Sản phẩm có trong kho
                        </th>
                        <th>

                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($warehouses as $ware)
                        <tr>
                            <td>{{$ware->ware_name}}</td>
                            <td>
                                {{$ware->phone_number}}
                            </td>
                            <td>
                                {{$ware->address}}
                            </td>
                            <td>
                                {{$ware->amount}}
                            </td>
                            <td>
                                {{$ware->amount_product}}
                            </td>
                            <td>
                                <a href="#" data-id="{{$ware->id}}" class="more-details text-primary underline"> Chi
                                    tiết</a>
                            </td>

                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
            <div class="flex justify-end items-center gap-4 flex-wrap">
{{--                <span class="text-sm text-title">Tổng: <strong class="font-bold">1.241</strong></span>--}}
                @include('layouts.custom.paginator', ['paginator' => $warehouses])
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

@section('custom_js')
    <script>
        $('.more-details').each(function (i, e) {
            $(this).on('click', (o) => {
                $.ajax({
                    url: '{{route('screens.manufacture.warehouse.detail')}}?id=' + e.dataset.id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        $('#modal8').html(result);
                        // $('.modal-details').toggleClass('show-modal')
                    },
                });
            });
        });
    </script>
@endsection
