@extends('layouts.manufacture.main')
@section('page_title','Tất cả đơn hàng')

@section('modal')
    <form action="" id="form">
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
                        <div class="flex items-center gap-4 w-full">
                            <span class="text-title font-medium w-[200px]">Mã sản phẩm:</span>
                            <span class="text-title ">VSC1232</span>
                        </div>

                        <div class="flex items-center gap-4 w-full">
                            <span class="text-title font-medium w-[200px]">Tên sản phẩm:</span>
                            <span class="text-title ">Sữa</span>
                        </div>
                        <div class="flex items-center gap-4 w-full">
                            <span class="text-title font-medium w-[200px]">Nhà cung cấp:</span>
                            <span class="text-title ">30,000</span>
                        </div>
                        <div class="flex items-center gap-4 w-full">
                            <span class="text-title font-medium w-[200px]">Giá bán:</span>
                            <span class="text-title ">VSC1232</span>
                        </div>
                        <div class="flex items-center gap-4 w-full">
                            <span class="text-title font-medium w-[200px]">Chiết khấu:</span>
                            <span class="text-title ">2%</span>
                        </div>
                        <div class="flex items-center gap-4 w-full">
                            <span class="text-title font-medium w-[200px]">Số lượng bán:</span>
                            <span class="text-title ">50</span>
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
                <span class="text-secondary">Quản lý đơn hàng</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                          stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <a href="" class="text-blueMain font-medium italic">Tất các đơn hàng</a>
            </div>
            <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">
                <div class="flex justify-start items-start gap-2 flex-wrap">
                    <input type="text" id="key_search" name="key_search"
                           class="outline-none rounded-xl border-[1px] border-[#EBEBEB] px-4 py-[5px] focus:border-primary transition-all duration-200"
                           placeholder="Nhập từ khóa">
                    <button type="submit"
                            class="btnA flex items-center gap-2 cursor-pointer transition-all duration-200 hover:opacity-70 rounded-xl outline-none border-[1px] bg-[#40BAFF] text-[#FFF] px-4 py-[5px] "
                    >
                        <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6H4L6.28571 11.1316V19.8158L7.80952 21L9.33333 19.8158V11.1316L12 6Z"
                                  fill="white"/>
                            <path d="M13 11H18" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            <path d="M13 15H18" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            <path d="M13 19H18" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            <path
                                d="M1.21336 2.32558L6.69784 10.7209V17.7907C6.69784 18.6744 6.69784 20 7.9635 20C8.97602 20 9.281 18.5271 9.30692 17.7907V10.7209C10.8279 8.36434 14.0386 3.38605 14.7136 2.32558C15.3886 1.26512 14.7136 1 14.2918 1H2.05712C0.707096 1 0.9321 1.88372 1.21336 2.32558Z"
                                stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Tìm kiếm
                    </button>
                </div>
                <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
                    <div class="flex justify-between items-center flex-wrap gap-4">
                        <h2 class="text-xl md:text-3xl font-medium flex items-center gap-4">
                            <svg width="20" height="25" viewBox="0 0 20 25" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
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

                            Tất cả đơn hàng
                        </h2>

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
                                <th>Tình trạng</th>
                                <th>
                                    Giá bán
                                </th>
                                <th>
                                    Số lượng
                                </th>
                                <th>Kho hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>
                                    Ngày hoàn thành
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
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->no}}</td>
                                        <td>{{$order->orderItem[0]->product->name}}</td>
                                        <td>
                                            @if($order->export_status == 0)
                                                <span class="text-yellow-400">Chờ xác nhận</span>
                                            @elseif($order->export_status == 1)
                                                <span class="text-blue-600">Chờ giao hàng</span>
                                            @elseif($order->export_status == 2)
                                                <span class="text-blue-600">Đang giao hàng</span>
                                            @else
                                                <span class="text-green-600">Hoàn thành</span>
                                            @endif
                                        </td>
                                        <td>{{number_format($order->orderItem[0]->price,'0','.','.')}} đ</td>
                                        <td>{{$order->orderItem[0]->quantity}}</td>
                                        <td>{{$order->orderItem[0]->warehouse->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y h:i')}}</td>
                                        <td>
                                            @if($order->export_status == 4)
                                                {{\Carbon\Carbon::now()->format('d/m/Y h:i')}}
                                            @else
                                                Chưa xác định
                                            @endif
                                        </td>
                                        <td>
                                            {{number_format($order->orderItem[0]->price * $order->orderItem[0]->quantity,0,'.','.')}} đ
                                        </td>
                                        <td>
                                            {{$order->orderItem[0]->vshop->name ?? 'Viptam'}}
                                        </td>
                                        <td>
                                            {{number_format(($order->orderItem[0]->price * $order->orderItem[0]->quantity) * (100 - $order->orderItem[0]->product->discount - $order->orderItem[0]->discount_vShop) / 100,0,'.','.')}}
                                            đ
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11">Không có dữ liệu phù hợp</td>
                                </tr>
                            @endif


                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end items-center gap-4 flex-wrap">
                        <span class="text-sm text-title">Tổng: <strong
                                class="font-bold">{{$orders->total()}}</strong></span>
                        {{$orders->withQueryString()->links()}}
                        <div class="flex justify-start items-center gap-2 flex-wrap">
                            <select name="limit"
                                    class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                                <option
                                    {{--                            value="10" {{isset($params['limit']) && $params['limit'] == 10 ? 'selected' : ''}}>10--}}
                                    {{--                            hàng / trang--}}
                                    value="10"
                                    @if(app('request')->input('limit') && app('request')->input('limit') ==10)selected @endif >
                                    10
                                    hàng / trang
                                    {{--                            {{ app('request')->input('limit') }}--}}
                                </option>
                                <option
                                    {{--                            value="25" {{isset($params['limit']) && $params['limit'] == 25 ? 'selected' : ''}}>25--}}
                                    {{--                            hàng / trang--}}
                                    value="25"
                                    @if(app('request')->input('limit') && app('request')->input('limit') ==25)selected @endif >
                                    25
                                    hàng / trang
                                </option>
                                <option
                                    value="50"
                                    @if(app('request')->input('limit') && app('request')->input('limit') ==50)selected @endif >
                                    50
                                    hàng / trang
                                </option>
                            </select>

                        </div>
                    </div>
                </div>
                <div></div>
            </div>
    </form>
@endsection

@section('custom_js')
    <script>
        const form = document.getElementById('form');
        const limit = document.getElementsByName('limit')[0];
        const page = document.getElementById('page1');
        limit.addEventListener('change', (e) => {
            form.submit();
        });

        $('.more-details').each(function () {
            $(this).on('click', function () {
                // console.log(1)
                $('.modal-details').toggleClass('show-modal');
            });
        })
    </script>
@endsection
