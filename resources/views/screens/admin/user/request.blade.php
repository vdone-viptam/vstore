@extends('layouts.admin.main')
@section('page_title','Yêu cầu cập nhật mã số thuế')

@section('content')
    <form action="" method="GET" id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Tài khoản</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="#" class="text-blueMain font-medium italic">Yêu cầu cập nhật mã số thuế</a>
        </div>
        <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">


            {{--            <div class="flex justify-start items-start gap-2 flex-wrap">--}}
            {{--                <input type="text" id="id" name="id" value="{{isset($params['id']) ? $params['id'] : ''}}"--}}
            {{--                       class="outline-none rounded-xl border-[1px] border-[#C4CDD5] px-4 py-[5px] focus:border-primary transition-all duration-200"--}}
            {{--                       placeholder="ID">--}}
            {{--                <input type="text" value="{{isset($params['name']) ? $params['name'] : ''}}"--}}
            {{--                       name="name" id="name"--}}
            {{--                       class="outline-none rounded-xl border-[1px] border-[#EBEBEB] px-4 py-[5px] focus:border-primary transition-all duration-200"--}}
            {{--                       placeholder="Tên nhà cung cấp / tên công ty">--}}
            {{--                <button type="submit"--}}
            {{--                        class="flex items-center gap-2 cursor-pointer transition-all duration-200 hover:opacity-70 rounded-xl outline-none border-[1px] bg-[#40BAFF] text-[#FFF] px-4 py-[5px] "--}}
            {{--                >--}}
            {{--                    <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
            {{--                        <path d="M12 6H4L6.28571 11.1316V19.8158L7.80952 21L9.33333 19.8158V11.1316L12 6Z"--}}
            {{--                              fill="white"/>--}}
            {{--                        <path d="M13 11H18" stroke="white" stroke-width="2" stroke-linecap="round"/>--}}
            {{--                        <path d="M13 15H18" stroke="white" stroke-width="2" stroke-linecap="round"/>--}}
            {{--                        <path d="M13 19H18" stroke="white" stroke-width="2" stroke-linecap="round"/>--}}
            {{--                        <path--}}
            {{--                            d="M1.21336 2.32558L6.69784 10.7209V17.7907C6.69784 18.6744 6.69784 20 7.9635 20C8.97602 20 9.281 18.5271 9.30692 17.7907V10.7209C10.8279 8.36434 14.0386 3.38605 14.7136 2.32558C15.3886 1.26512 14.7136 1 14.2918 1H2.05712C0.707096 1 0.9321 1.88372 1.21336 2.32558Z"--}}
            {{--                            stroke="white" stroke-width="2" stroke-linecap="round"/>--}}
            {{--                    </svg>--}}
            {{--                    Lọc--}}
            {{--                </button>--}}
            {{--            </div>--}}
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
                        Yêu cầu cập nhật mã số thuế
                    </h2>
                    <div class="flex justify-start md:justify-end items-center gap-2 flex-wrap md:flex-nowrap">

                    </div>

                </div>
                <div class="w-full overflow-scroll">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <p style="color: green;margin-top: 4px;">{{\Illuminate\Support\Facades\Session::get('success')}}</p>
                    @endif
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <p style="color: red;margin-top: 4px;">{{\Illuminate\Support\Facades\Session::get('error')}}</p>
                    @endif
                    <table class="order-s w-full dsth " style="text-align: center">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên công ty</th>
                            <th>
                                Mã số thuế cũ
                            </th>
                            <th>
                                Mã số thuế mới
                            </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($requests) > 0)
                            @foreach($requests as $req)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{$req->user->company_name}}</td>
                                    <td>{{$req->user->tax_code}}</td>
                                    <td>{{$req->tax_code}}</td>
                                    <td>
                                        @if($req->status == 0)
                                            <a href="{{route('screens.admin.user.confirm1',['id' => $req->id,'status' => 1])}}"
                                               class="text-blue-600">Đồng ý</a> /
                                            <a href="{{route('screens.admin.user.confirm1',['id' => $req->id,'status' => 2])}}"
                                               class="text-red-600">Từ chối</a>
                                        @elseif($req->status == 1)
                                            <p class="text-green-600 font-bold">Đồng ý</p>
                                        @else
                                            <p class="text-red-600 font-bold">Từ chối</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end items-center gap-4 flex-wrap">
                    <span class="text-sm text-title">Tổng: <strong
                            class="font-bold">{{$requests->total()}}</strong></span>
                    @include('layouts.custom.paginator', ['paginator' => $requests])
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
                        <div class="flex justify-start items-center gap-2">
                            <span class="text-title text-sm">Đi đến</span>
                            <input type="number" name="page1" id="page"
                                   value="{{isset($params['page1']) && $params['page1'] ? $params['page1'] : ''}}"
                                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-2 py-[6px] w-[60px] focus:border-primary transition-all duration-200"
                            >
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
        const name = document.getElementById('name');
        const id = document.getElementById('id');
        const limit = document.getElementById('limit');
        const form = document.getElementById('form');
        document.getElementById('btnSearch').addEventListener('click', () => {
                form.submit();
            }
        )
        limit.addEventListener('change', (e) => {
            form.submit();
        });
    </script>
@endsection
