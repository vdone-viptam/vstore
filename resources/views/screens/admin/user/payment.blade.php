@extends('layouts.admin.main')
@section('page_title','Lich sử mua tài khoản')

@section('modal')
    <div id="modal1">

    </div>
@endsection
@section('content')
    <form action="" method="GET" id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Quản lý tài khoản</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="#" class="text-blueMain font-medium italic">Lich sử mua tài khoản</a>
        </div>
        <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">


            <div class="flex justify-start items-start gap-2 flex-wrap">
                <input type="text" value="{{isset($key_word) ? $key_word : ''}}"
                       name="key_search" id="key_search"
                       class="outline-none rounded-xl border-[1px] border-[#EBEBEB] px-4 py-[5px] focus:border-primary transition-all duration-200"
                >
                <button type="submit" id="btnSearch"
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
                        Lich sử mua tài khoản
                    </h2>
                </div>
                <div class="w-full overflow-scroll">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <p style="color: green">{{\Illuminate\Support\Facades\Session::get('success')}}</p>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <p style="color: red">{{\Illuminate\Support\Facades\Session::get('error')}}</p>
                    @endif
                    <table class="order-s w-full dsth " style="text-align: center">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>
                                Phương thức thanh toán
                            </th>
                            <th>
                                Mã hóa đơn
                            </th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>Loại tài khoản</th>
                            <th>Thời gian giao dịch</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($histories) > 0)
                            @foreach($histories as $history)
                                <tr>
                                    <td>{{$history->id}}</td>
                                    <td>{{$history->name}}</td>
                                    <td>{{$history->method_payment}}</td>
                                    <td>{{$history->no}}</td>
                                    <td>{!!$history->status == 3 && $history->payment_status == 1 ?
'<span class="text-green-600">Thành công</span>' : '<span class="text-red-600">Thất bại</span' !!}</td>
                                    <td>{{number_format($history->total,0,'.','.')}} đ</td>
                                    <td>{{$history->type}}</td>
                                    <td>{{\Carbon\Carbon::parse($history->created_at)->format('d/m/Y H:i')}}</td>
                                    <td><a href="#" onclick="checkPayment({{$history->id}})"
                                           class="text-blue-500 underline">Kiểm tra giao dịch</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end items-center gap-4 flex-wrap">
                    <span class="text-sm text-title">Tổng: <strong
                            class="font-bold">{{$histories->total()}}</strong></span>
                    {{$histories->withQueryString()->links()}}
                    <div class="flex justify-start items-center gap-2 flex-wrap">
                        <select name="limit" id="limit"
                                class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                            <option value="10" {{ isset($params['limit']) && $params['limit'] == 10 ? 'selected' : ''}}>
                                10
                                hàng / trang
                            </option>
                            <option value="25" {{ isset($params['limit']) && $params['limit'] == 25 ? 'selected' : ''}}>
                                25
                                hàng / trang
                            </option>
                            <option value="50" {{ isset($params['limit']) && $params['limit'] == 50 ? 'selected' : ''}}>
                                50
                                hàng / trang
                            </option>
                        </select>
                        {{--                        <div class="flex justify-start items-center gap-2">--}}
                        {{--                            <span class="text-title text-sm">Đi đến</span>--}}
                        {{--                            <input type="number" name="page1" id="page"--}}
                        {{--                                   value="{{isset($params['page1']) && $params['page1'] ? $params['page1'] : ''}}"--}}
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

@section('custom_js')
    <script>
        let name = document.getElementById('name');
        let id = document.getElementById('id');
        let limit = document.getElementById('limit');
        let form = document.getElementById('form');
        document.getElementById('btnSearch').addEventListener('click', () => {
                form.submit();
            }
        )
        limit.addEventListener('change', (e) => {
            form.submit();
        });

        async function checkPayment(id) {
            $.ajax({
                url: '{{route('screens.admin.user.checkPayment')}}?id=' + id + '&_token={{csrf_token()}}',
                success: function (result) {
                    const data = JSON.parse(result.request);
                    const tax_code = result.tax_code;
                    const name = result.name;
                    const phone_number = result.phone_number;
                    const present_status = result.status;
                    const payment_status = result.payment_status;
                    let status = '';
                    switch (data.status) {
                        case 2:
                            status = 'Giao dịch đang xủ lý';
                            break;
                        case 3:
                            status = "Giao dịch đang chờ kiểm tra (Giao dịch bị nghi ngờ vi phạm quy định về quản trị rủi ro của đối tác thanh toán)";
                            break;
                        case 5 :
                            status = "Giao dịch thành công";
                            break;
                        case 6:
                            status = "Giao dịch thất bại";
                            break;
                        case 8:
                            status = "Giao dịch bị hủy";
                            break;
                        case 9 :
                            status = "Giao dịch bị từ chối (Giao dịch bị từ chối do vi phạm quy định về quản trị rủi ro của đói tác thanh toán)";
                            break;
                        default:
                            status = "Giao dịch đã nhận tiền (Chỉ áp dụng với phương thức thanh toánChuyển khoản ngân hàng)";
                            break;
                    }
                    const html = `
                    <div class="modal modal-details">
    <div class="over-lay-modal" onclick="$('.modal-details').toggleClass('show-modal')"></div>
    <div
        class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-4">
        <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
            <div></div>
            <h2 class="text-xl text-title font-semibold">Thông tin giao dịch</h2>
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
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Mã giao dịch:</span>
                    <span class="text-title">${data.invoice_no}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Tên khách hàng:</span>
                    <span class="text-title">${name}</span>
                </div>
                 <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Số điện thoại:</span>
                    <span class="text-title">${phone_number}</span>
                </div>
           <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Mã số thuế:</span>
                    <span class="text-title">${tax_code}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Loại thẻ:</span>
                    <span class="text-title">${data.card_brand}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Loại tiền tệ:</span>
                    <span class="text-title">${data.currency}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Nội dung:</span>
                    <span class="text-title">${data.description}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Phương thức thanh toán:</span>
                    <span class="text-title">${data.method}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Trạng thái thanh toán:</span>
                    <span class="text-title">${present_status == 3 && payment_status == 1 ? 'Thành công' : 'Thất bại'}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Trạng thái thanh toán thực tế (9PAY):</span>
                    <span class="text-title">${status}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full">
                    <span class="text-title font-medium ">Thời gian giao dịch:</span>
                    <span
                        class="text-title">${data.created_at}</span>
                </div>
                     <div class="grid grid-cols-2 gap-4 w-full">
                    ${
                        status == 5 && (payment_status != 1 && present_status != 3) ? `<a href="{{route('screens.admin.user.updatePayment')}}?id=${id}" onclick="return confirm('Bạn có chắc muốn thay đổi trạng thái giao dịch này')" class="w-48 bg-transparent hover:bg-blue-500 text-blue-700  hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Chuyển trạng thái</a>` : ''
                    }
                </div>
            </div>
        </div>
    </div>
</div>
                    `;
                    $('#modal1').html('');
                    $('#modal1').append(html);
                    $('.modal-details').toggleClass('show-modal')
                },
            });
        }

    </script>
@endsection
