@extends('layouts.admin.main')
@section('page_title','Quản lý yêu cầu xét duyệt sản phẩm')

@section('modal')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="modal modal-success flex justify-center items-center show-modal">
            <div class="over-lay-modal" onclick="$('.modal-success').toggleClass('show-modal')"></div>
            <div
                class="information bg-[white] flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-success').toggleClass('show-modal')"
                     class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                        fill="white"/>
                </svg>

                <div class="content pt-3 px-3 text-center flex flex-col gap-6">
                    <div class="w-[262px] h-[262px] mx-auto">
                        <img src="{{asset('asset/images/success.gif')}}" class="w-full" alt="">
                    </div>
                    <h2 class="text-title text-2xl font-medium">{{\Illuminate\Support\Facades\Session::get('success')}}</h2>
                </div>
            </div>
        </div>
    @endif
    <div id="modal3"></div>
@endsection
@section('content')
    <form id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Sản phẩm</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="" class="text-blueMain font-medium">Quản lý yêu cầu xét duyệt sản phẩm</a>
        </div>
        <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">

            <div class="flex justify-start items-start gap-2 flex-wrap">
                <input type="text" name="keyword"
                       class="outline-none rounded-xl border-[1px] border-[#EBEBEB] px-4 py-[5px] focus:border-primary transition-all duration-200 "
                       placeholder="Tìm kiếm">
                <button type="submit"
                        class="flex items-center gap-2 cursor-pointer transition-all duration-200 hover:opacity-70 rounded-xl outline-none border-[1px] bg-[#40BAFF] text-[#FFF] px-4 py-[5px] "
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
                    Lọc
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

                        Quản lý yêu cầu xét duyệt sản phẩm
                    </h2>

                </div>
                <div class="w-full overflow-scroll">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <p class="text-green-600">{{\Illuminate\Support\Facades\Session::get('success')}}</p>
                    @endif
                    <table class="w-full dsth">
                        <thead>
                        <tr>


                            <th>
                                Tên sản phẩm
                            </th>
                            <th>
                                Ngành hàng
                            </th>
                            <th>
                                Ngày yêu cầu
                            </th>
                            <th>
                                Nhà cung cấp yêu cầu
                            </th>
                            <th>Mã sản phẩm</th>
                            <th>
                                Trạng thái yêu cầu
                            </th>
                            <th>
                                Chi tiết
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $request)

                                <tr>
                                    <td>
                                        {{$request->product_name}}
                                    </td>
                                    <td>
                                        {{$request->name}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($request->created_at)->format('d/m/Y')}}
                                    </td>
                                    <td>
                                        {{$request->user_name}}
                                    </td>
                                    <td>
                                        {{$request->publish_id}}
                                    </td>
                                    <td class="w-[200px]">

                                        @if($request->status == 1)
                                            <div
                                                class="text-white font-medium flex justify-center items-center gap-4 bg-[#F5C002] rounded-[4px] px-[11px] py-[6px] whitespace-nowrap">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 12.6C8.48521 12.6 9.90959 12.01 10.9598 10.9598C12.01 9.90959 12.6 8.48521 12.6 7C12.6 5.51479 12.01 4.09041 10.9598 3.0402C9.90959 1.99 8.48521 1.4 7 1.4C5.51479 1.4 4.09041 1.99 3.0402 3.0402C1.99 4.09041 1.4 5.51479 1.4 7C1.4 8.48521 1.99 9.90959 3.0402 10.9598C4.09041 12.01 5.51479 12.6 7 12.6ZM7 0C7.91925 0 8.8295 0.18106 9.67878 0.532843C10.5281 0.884626 11.2997 1.40024 11.9497 2.05025C12.5998 2.70026 13.1154 3.47194 13.4672 4.32122C13.8189 5.17049 14 6.08075 14 7C14 8.85651 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85651 14 7 14C3.129 14 0 10.85 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0ZM7.35 3.5V7.175L10.5 9.044L9.975 9.905L6.3 7.7V3.5H7.35Z"
                                                        fill="white"/>
                                                </svg>
                                                V-Store đã duyệt - chờ hệ thống duyệt
                                            </div>
                                        @elseif($request->status == 3)
                                            <div
                                                class="text-white font-medium flex justify-center items-center gap-4 bg-[#2CC09C] rounded-[4px] px-[11px] py-[6px] whitespace-nowrap">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="white"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Hệ thống đã duyệt
                                            </div>
                                        @elseif($request->status == 4)
                                            <div
                                                class="text-white font-medium flex justify-center items-center gap-4 bg-[#FF0101] rounded-[4px] px-[11px] py-[6px] whitespace-nowrap">
                                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.2 12L0 10.8L4.8 6L0 1.2L1.2 0L6 4.8L10.8 0L12 1.2L7.2 6L12 10.8L10.8 12L6 7.2L1.2 12Z"
                                                        fill="white"/>
                                                </svg>
                                                Hệ thống từ chối
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" data-id="{{$request->id}}"
                                           class="more-details text-primary underline">
                                            Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="7">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end items-center gap-4 flex-wrap">
                    <span class="text-sm text-title">Tổng: <strong
                            class="font-bold">{{isset($total) ? $total :  $requests->total()}}</strong></span>
                    @include('layouts.custom.paginator', ['paginator' => $requests])
                    <div class="flex justify-start items-center gap-2 flex-wrap">
                        <select name="limit"
                                class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                            <option {{Request::get('limit') == 10? 'selected':'' }} value="10">10 hàng / trang</option>
                            <option {{Request::get('limit') == 25? 'selected':'' }} value="25">25 hàng / trang</option>
                            <option {{Request::get('limit') == 50? 'selected':'' }} value="50">50 hàng / trang</option>
                        </select>
                        {{--                        <div class="flex justify-start items-center gap-2">--}}
                        {{--                            <span class="text-title text-sm">Đi đến</span>--}}
                        {{--                            <input type="number" name="page1" value="0" id="page"--}}
                        {{--                                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-2 py-[6px] w-[60px] focus:border-primary transition-all duration-200"--}}
                        {{--                            >--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div></div>
        </div>
    </form>
@endsection
<script>

    $(".cursor-pointer").click(function () {
        alert("Handler for .click() called.");
    });
    window.location.href = "{{ route('screens.admin.product.index')}}";
</script>
@section('custom_js')
    <script>
        $('.more-details').each(function (i, e) {
            $(this).on('click', (o) => {
                $.ajax({
                    url: '{{route('screens.admin.product.detail')}}?id=' + e.dataset.id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        $('#modal3').html(result);
                        $('.modal-details').toggleClass('show-modal')
                    },
                });
            });
        });
    </script>
    <script>
        const form = document.getElementById('form');
        const limit = document.getElementsByName('limit')[0];
        const page = document.getElementById('page');
        limit.addEventListener('change', (e) => {
            form.submit();
        });
        page.addEventListener('change', (e) => {
            form.submit();
        });
        $(".cursor-pointer").click(function () {
            let search = $('.search').val();
            let select = $('.select-form').val();
            form.submit();
        });
        {{--window.location.href = "{{ route('screens.admin.product.index')}}";--}}
    </script>
@endsection

