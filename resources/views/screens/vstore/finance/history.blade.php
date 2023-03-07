@extends('layouts.vstore.main')


@section('page_title','Lịch sử giao dịch')


@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        <div class="col-span-12 ">
            <div class="brc flex justify-start items-center gap-2 py-4">
                <span class="text-secondary">Tài chính</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18"
                          stroke="black"
                          stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <a href="" class="text-blueMain font-medium italic">Lịch sử giao dịch</a>
            </div>

            <div class="box w-full">
                <div class="flex flex-col justify-start items-start w-full p-6">
                    <div class="flex flex-col justify-start items-start gap-1 pb-6 border-b-[1px] border-grey w-full">
                        <h3 class="captilize font-medium text-xl text-title flex items-center gap-4">
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
                            Lịch sử giao dịch
                        </h3>
                    </div>
                    <div class=" pt-6 w-full md:p-6 ">
                        <div class="w-full overflow-scroll">
                            <table class="w-full dsth">
                                <thead>
                                <tr>
                                    <th>Mã giao dịch</th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th>
                                        Số tiền
                                    </th>
                                    <th>
                                        Số dư
                                    </th>
                                    <th>Chủ tài khoản</th>
                                    <th>Ngân hàng</th>
                                    <th>Số tài khoản</th>
                                    <th>
                                        Nội dung
                                    </th>
                                    <th>
                                        Ngày giao dịch
                                    </th>


                                </tr>
                                </thead>
                                <tbody>
                                @if(count($histories) > 0)
                                    @foreach($histories as $history)
                                        <tr>
                                            <td>GD-{{$history->code}}</td>

                                            @if($history->status == 0)
                                                <td class="text-yellow-400">
                                                    Đang chờ duyệt
                                                </td>
                                            @elseif($history->status == 1)
                                                <td class="text-green-700">
                                                    Thành công
                                                </td>
                                            @else
                                                <td class="text-red-600">
                                                    Thất bại
                                                </td>
                                            @endif
                                            <td>
                                                {{number_format($history->amount,0,'.','.')}}
                                            </td>
                                            <td>
                                                {{number_format($history->old_money,0,'.','.')}}
                                            </td>
                                            <td>
                                                {{$history->name}}
                                            </td>
                                            <td>
                                                {{$history->bank->name}}
                                            </td>
                                            <td>
                                                @for($i = 0;$i < strlen($history->account_number) - 4;$i++)
                                                    *
                                                @endfor
                                                {{substr($history->account_number,strlen($history->account_number) - 4)}}
                                            </td>
                                            <td>
                                                Chuyển khoản ra ngoài
                                            </td>


                                            <td>
                                                {{\Illuminate\Support\Carbon::parse($history->created_at)->format('d/m/Y')}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9">Không tìm thấy dữ liệu phù hợp</td>
                                    </tr>
                                @endif


                                </tbody>
                            </table>
                            {{$histories->withQueryString()->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
