@extends('layouts.storage.main')

@section('modal')
    <div id="modal5">

    </div>
@endsection
@section('page_title','Yêu cầu xuât kho')

@section('content')
    <form action="" id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Sản phẩm</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="" class="text-blueMain font-medium italic">Quản lý
                yêu cầu xuất kho</a>
        </div>
        <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">

            <div class="flex justify-start items-start gap-2 flex-wrap">
                <select name="condition" id=""
                        class="outline-none rounded-xl border-[1px] border-[#C4CDD5] px-4 py-[6px] focus:border-primary transition-all duration-200">
                    <option value="0">Tất cả</option>
                    <option
                        value="publish_id" {{isset($params['condition']) && $params['condition'] == 'publish_id' ? 'selected' : ''}}>
                        Mã sản phẩm
                    </option>
                    <option
                        value=products.name {{isset($params['condition']) && $params['condition'] == 'name' ? 'selected' : ''}}>
                        Tên sản phẩm
                    </option>
                    <option
                        value="brand" {{isset($params['condition']) && $params['condition'] == 'brand' ? 'selected' : ''}}>
                        Thương hiệu
                    </option>
                    <option
                        value="categories.name" {{isset($params['condition']) && $params['condition'] == 'categories.name' ? 'selected' : ''}}>
                        Ngành hàng
                    </option>
                </select>

                <input type="text" name="key_search" value="{{$params['key_search'] ?? ''}}"
                       class="outline-none rounded-xl border-[1px] border-[#EBEBEB] px-4 py-[5px] focus:border-primary transition-all duration-200"
                       placeholder="Nhập từ khóa">
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

                        Yêu cầu xuất kho
                    </h2>
                    {{--                    <a href="{{route('screens.manufacture.product.create')}}"--}}
                    {{--                       class="bg-primary border-primary hover:opacity-70 transition-all duration-300 shadow-lg rounded-[10px] py-[6px] px-[15px] text-[#FFF] flex justify-start items-center gap-3">--}}
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
                    {{--                    </a>--}}
                </div>
                <div class="w-full overflow-scroll">
                    <table class="w-full dsth">
                        <thead>
                        <tr>

                            <th>
                                Mã yêu cầu
                            </th>
                            <th>
                                Địa chỉ
                            </th>
                            <th>
                                Tổng tiền đơn hàng
                            </th>
                            <th>
                                Ngày yêu cầu
                            </th>
                            <th>Chi tiêt</th>
                            <th>
                                Trạng thái yêu cầu
                            </th>
                            <th>Xét duyệt</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if(count($bill_detai) > 0)
                            @foreach($bill_detai as $value)
                                <tr>
                                    <td>{{$value->code}}</td>
                                    <td>{{$value->address}}</td>
                                    <td>{{$value->total}}</td>
                                    <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y')}}</td>
                                    <td><a href="#" data-id="{{$value->id}}"
                                           class="more-details text-primary underline"> Xem</a></td>
                                    <td>

                                        @if($value->export_status ==0)
                                            <div
                                                class="text-white font-medium flex justify-center items-center gap-4 bg-[#F5C002] rounded-[4px] px-[11px] py-[6px] whitespace-nowrap">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 12.6C8.48521 12.6 9.90959 12.01 10.9598 10.9598C12.01 9.90959 12.6 8.48521 12.6 7C12.6 5.51479 12.01 4.09041 10.9598 3.0402C9.90959 1.99 8.48521 1.4 7 1.4C5.51479 1.4 4.09041 1.99 3.0402 3.0402C1.99 4.09041 1.4 5.51479 1.4 7C1.4 8.48521 1.99 9.90959 3.0402 10.9598C4.09041 12.01 5.51479 12.6 7 12.6ZM7 0C7.91925 0 8.8295 0.18106 9.67878 0.532843C10.5281 0.884626 11.2997 1.40024 11.9497 2.05025C12.5998 2.70026 13.1154 3.47194 13.4672 4.32122C13.8189 5.17049 14 6.08075 14 7C14 8.85651 13.2625 10.637 11.9497 11.9497C10.637 13.2625 8.85651 14 7 14C3.129 14 0 10.85 0 7C0 5.14348 0.737498 3.36301 2.05025 2.05025C3.36301 0.737498 5.14348 0 7 0ZM7.35 3.5V7.175L10.5 9.044L9.975 9.905L6.3 7.7V3.5H7.35Z"
                                                        fill="white"/>
                                                </svg>
                                                Đang chờ xét duyệt
                                            </div>
                                        @elseif($value->export_status == 1)

                                            <div
                                                class="text-white font-medium flex justify-center items-center gap-4 bg-[#2CC09C] rounded-[4px] px-[11px] py-[6px] whitespace-nowrap">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="white"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Đồng ý
                                            </div>

                                        @elseif($value->export_status == 2)
                                            <div
                                                class="text-white font-medium flex justify-center items-center gap-4 bg-[#FF0101] rounded-[4px] px-[11px] py-[6px] whitespace-nowrap">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 3.4L5.8 8.2L13 1" stroke="white"
                                                          stroke-linecap="round"/>
                                                </svg>
                                                Từ chối
                                            </div>
                                        @endif

                                    </td>
                                    <td>
                                        @if($value->export_status==0)
                                            <a href="{{route('screens.storage.product.updateRequestOut',['status'=>1,'id' => $value->id])}}">
                                                <button type="button"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    Đồng ý
                                                </button>
                                            </a>
                                            <a href="{{route('screens.storage.product.updateRequestOut',['status'=>2,'id' => $value->id])}}">
                                                <button type="button"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Từ chối
                                                </button>
                                            </a>
                                        @endif
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
                    <span class="text-sm text-title">{{$bill_detai->total()}}</span>
                    @include('layouts.custom.paginator', ['paginator' => $bill_detai])
                    <div class="flex justify-start items-center gap-2 flex-wrap">
                        <select name="limit"
                                class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                            <option
                                value="10" {{isset($params['limit']) && $params['limit'] == '10' ? 'selected' : ''}}>10
                                hàng / trang
                            </option>
                            <option
                                value="25" {{isset($params['limit']) && $params['limit'] == '25' ? 'selected' : ''}}>25
                                hàng / trang
                            </option>
                            <option
                                value="50" {{isset($params['limit']) && $params['limit'] == '50' ? 'selected' : ''}}>
                                50 hàng / trang
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
        limit.addEventListener('change', (e) => {
            form.submit();
        });

    </script>
    <script>
        $('.more-details').each(function (i, e) {
            $(this).on('click', (o) => {
                $.ajax({
                    url: '{{route('screens.storage.product.detail')}}?id=' + e.dataset.id + '&_token={{csrf_token()}}&product=abc',
                    success: function (result) {
                        // $('#modal5').html('');
                        $('#modal5').html(result);
                        $('.modal-details').toggleClass('show-modal')
                    },
                });
            });
        });
    </script>
@endsection
