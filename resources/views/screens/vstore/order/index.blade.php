@extends('layouts.vstore.main')

@section('page_title','Tất cả đơn hàng')

@section('content')
    <form id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Quản lý đơn hàng</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"></path>
            </svg>
            <a href="{{Route('screens.vstore.order.index')}}" class="text-blueMain font-medium italic">Tất cả đơn hàng</a>
        </div>
        <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">
            <div class="flex justify-start items-start gap-2 flex-wrap">
                <input type="text" name="key_search" value="{{$key_search}}" id="key_search"
                       class="outline-none rounded-xl border-[1px] border-[#EBEBEB] px-4 py-[5px] focus:border-primary transition-all duration-200"
                       placeholder="Nhập từ khóa">
                <button type="submit"
                        class="btnA flex items-center gap-2 cursor-pointer transition-all duration-200 hover:opacity-70 rounded-xl outline-none border-[1px] bg-[#40BAFF] text-[#FFF] px-4 py-[5px] "
                >

                    Tìm kiếm
                </button>
            </div>
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
                            <th>Trạng thái</th>
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
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i')}}</td>
                                    <td>
                                        @if($order->export_status == 4)
                                            {{\Carbon\Carbon::now()->format('d/m/Y H:i')}}
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
                                <td colspan="10">Bạn chưa có đơn hàng nào</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end items-center gap-4 flex-wrap">
                    {{--                <span class="text-sm text-title">Tổng: <strong class="font-bold">1.241</strong></span>--}}
                    {{$orders->withQueryString()->links()}}
                    <div class="flex justify-start items-center gap-2 flex-wrap">
                        <select name="limit"
                                class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                            <option value="10" {{isset($limit) && $limit == '10' ? 'selected' : ''}}>10 hàng / trang
                                {{-- value="10"
                                @if(app('request')->input('limit') && app('request')->input('limit') ==10)selected @endif >
                                10
                                hàng / trang --}}
                                {{--                            {{ app('request')->input('limit') }}--}}
                            </option>
                            <option value="25" {{isset($limit) && $limit == '25' ? 'selected' : ''}}>25 hàng / trang
                                {{-- value="25"
                                @if(app('request')->input('limit') && app('request')->input('limit') ==25)selected @endif >
                                25
                                hàng / trang --}}
                            </option>
                            <option value="50" {{isset($limit) && $limit == '50' ? 'selected' : ''}}>50 hàng / trang
                                {{-- value="50"
                                @if(app('request')->input('limit') && app('request')->input('limit') ==50)selected @endif >
                                50
                                hàng / trang --}}
                            </option>
                        </select>

                    </div>
                </div>
                <div></div>
            </div>
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
