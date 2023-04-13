@extends('layouts.manufacture.main')
@section('page_title','Quản lý đơn nhập sẵn')

@section('modal')
    <div id="modal2"></div>
@endsection

@section('content')
    <form action="" id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Quản lý đơn hàng</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="" class="text-blueMain font-medium italic">Quản lý đơn nhập sẵn</a>
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

                        Quản lý đơn nhập sẵn
                    </h2>


                </div>
                <div class="w-full">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <p class="text-green-600">{{\Illuminate\Support\Facades\Session::get('success')}}</p>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <p class="text-red-600">{{\Illuminate\Support\Facades\Session::get('error')}}</p>
                    @endif
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
                                    Giá sản phẩm
                                </th>
                                <th>
                                    Giảm giá (nếu có)
                                </th>
                                <th>
                                    Số lượng
                                </th>
                                <th>Tiền đặt cọc</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>
                                    Ngày tạo đơn
                                <th>

                            </tr>
                            </thead>
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->no}}</td>
                                        <td>{{$order->product->name}}</td>
                                        <td>{{number_format($order->product->price,0,'.','.')}} đ</td>
                                        <td>{{(int)$order->discount}} %</td>
                                        <td>{{$order->quantity}}</td>
                                        <td>{{number_format(($order->total - ($order->total * $order->discount / 100)) * ($order->deposit_money / 100) ,0,'.','.')}}
                                            đ
                                        </td>
                                        <td>{{number_format($order->total - ($order->total * $order->discount / 100),0,'.','.')}} đ</td>
                                        <td>
                                            @if($order->status == 1)
                                                <span class="text-green-600"> Đã hoàn thành</span>
                                            @elseif($order->status == 3)
                                                <span class="text-blue-600">Đơn hàng mới</span>
                                            @elseif($order->status == 4)
                                                <span class="text-yellow-400">Đang giao hàng</span>
                                            @else
                                                <span class="text-red-600">Hủy</span>
                                            @endif
                                        </td>
                                        <td>{{\Illuminate\Support\Carbon::parse($order->created_at)->format('d/m/Y H:i')}}</td>
                                        <td>
                                            <a href="#" data-id="{{$order->id}}" class="text-blue-600 more-details">Chi
                                                tiết</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" class="text-center ">Không có dữ liệu phù hợp</td>
                                </tr>
                            @endif
                            <tbody>

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
                            {{--                        <div class="flex justify-start items-center gap-2">--}}
                            {{--                            <span class="text-title text-sm">Đi đến</span>--}}
                            {{--                            <input type="number"--}}
                            {{--                                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-2 py-[6px] w-[60px] focus:border-primary transition-all duration-200"--}}
                            {{--                                   min="1">--}}
                            {{--                        </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div></div>
        </div>
    </form>
@endsection

@section('custom_js')
    <script>
        const limit = document.getElementsByName('limit')[0];
        limit.addEventListener('change', (e) => {
            form.submit();
        });
        document.querySelectorAll('.more-details').forEach(item => {
            item.addEventListener('click', (e) => {
                $.ajax({
                    url: '{{route('screens.manufacture.order.detail')}}/' + item.dataset.id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        $('#modal2').html('');
                        $('#modal2').append(result);
                        $('.modal-details').toggleClass('show-modal')
                    },
                });
            })
        })
    </script>
@endsection
