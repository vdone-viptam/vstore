@extends('layouts.admin.main')

@section('content')
    <form action="" method="GET" id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Danh sách tài khoản</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="#" class="text-blueMain font-medium">Danh sách tài khoản đã đăng ký</a>
        </div>
        <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">
            <ul class="tab-th flex justify-start items-start">
                <li class="active"><a href="{{route('screens.admin.user.index')}}">Bộ lọc</a></li>

            </ul>


            <div class="flex justify-start items-start gap-2 flex-wrap">
                <input type="text" id="id" name="id" value="{{isset($params['id']) ? $params['id'] : ''}}"
                       class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200"
                       placeholder="ID">
                <input type="text" value="{{isset($params['name']) ? $params['name'] : ''}}"
                       name="name" id="name"
                       class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200"
                       placeholder="Tên nhà cung cấp / tên công ty">
                <button type="button" id="btnSearch"
                        class="cursor-pointer transition-all duration-200 hover:bg-[#FFF] hover:text-blueMain outline-none rounded-sm border-[1px] border-blueMain bg-blueMain px-4 py-[5px] text-[#FFF]"
                >Lọc
                </button>
            </div>
            <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <h2 class="text-xl md:text-3xl font-medium">Danh sách tài khoản</h2>
                    <div class="flex justify-start md:justify-end items-center gap-2 flex-wrap md:flex-nowrap">

                        <button
                            class="bg-primary border-primary hover:opacity-70 transition-all duration-300 shadow-lg rounded-sm py-[6px] px-[15px] text-[#FFF] flex justify-start items-center gap-3">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
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
                            <a href="{{route('screens.admin.category.create')}}">Thêm mới</a>
                        </button>

                    </div>

                </div>
                <div class="w-full">
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
                            <th>
                                Họ tên
                            </th>
                            <th>
                                Email
                            </th>
                            <th>ID người đại diện</th>
                            <th>Tên công ty</th>
                            <th>Số điện thoại</th>
                            <th>Mã số thuế</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đăng ký</th>
                            <th>Ngày duyệt</th>
                            <th>Quyền</th>
                            <th>
                                Hành động
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->id_vdone}}</td>
                                    <td>{{$user->company_name}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>{{$user->tax_code}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>{{\Illuminate\Support\Carbon::parse($user->created_at)->format('d/m/Y h:i A')}}</td>
                                    <td>{{$user->confirm_date ? \Illuminate\Support\Carbon::parse($user->confirm_date)->format('d/m/Y h:i A') : 'Chưa được duyệt'}}</td>
                                    <td>
                                        @if($user->role_id == 2)
                                            Nhà cung cấp
                                        @else
                                            Vstore
                                        @endif
                                    </td>
                                    <td>

                                        @if($user->confirm_date)
                                            <span>Đã duyệt</span>
                                        @else
                                            <a href="{{route('screens.admin.user.confirm',['id' => $user->id])}}">Duyệt
                                                tài
                                                khoản</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end items-center gap-4 flex-wrap">
                    <span class="text-sm text-title">Tổng: <strong
                            class="font-bold">10</strong></span>
                    {{$users->withQueryString()->links()}}
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
                            <input type="number" name="page" id="page"
                                   value="{{isset($params['page']) && $params['page'] ? $params['page'] : ''}}"
                                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-2 py-[6px] w-[60px] focus:border-primary transition-all duration-200"
                                   min="1">
                        </div>
                    </div>
                </div>
            </div>
            <div></div>

        </div>
    </form>
@endsection
