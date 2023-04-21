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
@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Tất cả sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection



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
    </script>
@endsection