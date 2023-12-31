@extends('layouts.storage.main')

@section('page_title','Hồ sơ của tôi')

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
    <div class="modal modal-hd @if(\Illuminate\Support\Facades\Session::has('validate')) show-modal @endif">
        <div class="over-lay-modal" onclick="$('.modal-hd').toggleClass('show-modal')"></div>
        <form action="{{route('screens.storage.account.editPro',['id' => $infoAccount->id])}}" method="POST">
            <div
                class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px] md:max-h-[500px] h-screen my-4 shadow-xl px-3 py-6 md:p-6 mx-auto   md:mt-24">
                <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                    <h2 class="text-base text-title font-medium">Chỉnh sửa hồ sơ</h2>
                    <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                         onclick="$('.modal-hd').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                            fill="black" fill-opacity="0.45"/>
                    </svg>
                </div>
                @csrf
                <div class="content  max-h-[600px] overflow-y-auto">
                    <div class="flex flex-col justify-start items-start gap-6 py-4 md:p-6 w-full ">
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Tên Kho:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="name" name="name"
                                       class="w-full outline-none py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->name}}">
                                @error('name')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>


                        </div>

                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Tên Công ty:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="company_name" name="company_name"
                                       class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->company_name}}">
                                @error('company_name')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Mã số thuế:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="tax_code" name="tax_code"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-gray-200 focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->tax_code}}" disabled>
                                @error('tax_code')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Tỉnh (thành phố):</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <select name="city_id" id="city_id"
                                        class="addr outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                    <option value="" disabled selected>Lựa chọn tỉnh (thành phố)</option>
                                </select>
                                @error('city_id')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Quận (huyện):</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <select name="district_id" id="district_id"
                                        class="addr outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                    <option value="" hidden>Lựa chọn quận (huyện)</option>
                                </select>
                                @error('district_id')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Phường (xã):</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <select name="ward_id" id="ward_id"
                                        class="addr outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                    <option value="" >Lựa chọn Phường (xã)</option>
                                </select>
                                @error('ward_id')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Địa chỉ chính xác:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="address" id="address"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->address}}">
                                @error('address')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Số diện thoại:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="phone_number" name="phone_number"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->phone_number}}">
                                @error('phone_number')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">ID người đại diện:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="id_vdone" id="id_vdone"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->id_vdone}}">
                                @error('id_vdone')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">ID người đại diện (khác):</span>
                            <input type="text" name="id_vdone_diff" id="id_vdone_diff"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                   value="{{$infoAccount->id_vdone_diff}}">
                        </div>
                        {{--                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">--}}
                        {{--                            <span class="text-secondary w-full md:w-[280px]">Link Website:</span>--}}
                        {{--                            <div class="w-full flex flex-col justify-start items-start gap-2">--}}
                        {{--                                <input type="text" name="link_website"--}}
                        {{--                                       class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-gray-200 focus:border-primary transition-all duration-200 rounded-sm"--}}
                        {{--                                       value="{{$infoAccount->link_website ?? asset('/p/'.$infoAccount->slug)}}">--}}
                        {{--                                @error('link_website')--}}
                        {{--                                <p class="text-red-600">{{$message}}</p>--}}
                        {{--                                @enderror--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <h4>Thông tin kho</h4>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Diện tích sàn:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="floor_area"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->storage_information->floor_area}}">
                                @error('floor_area')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Thể tích:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="volume"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->storage_information->volume}}">
                                @error('volume')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Ảnh kho:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <img style="height: 200px"
                                     src="{{asset(json_decode($infoAccount->storage_information->image_storage)[0])}}"
                                     alt="">
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Ảnh chứng nhận PCCC:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <img style="height: 200px"
                                     src="{{asset(json_decode($infoAccount->storage_information->image_pccc)[0])}}"
                                     alt="">
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Diện tích kho lạnh (m2):</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="cold_storage"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->storage_information->cold_storage}}">
                                @error('cold_storage')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Diện tích kho bãi (m2):</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="warehouse"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->storage_information->volume}}">
                                @error('warehouse')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Diện tích kho thường:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="normal_storage"
                                       class="w-full outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->storage_information->normal_storage}}">
                                @error('normal_storage')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center md:justify-end items-center mt-6 gap-4 px-6">
                        <button type="button"
                                class=" cursor-pointer outline-none bg-[#FFF] transition-all duration-200 rounded-sm py-2 px-3 text-center text-title hover:opacity-70 border-[1px] border-secondary"
                                onclick="$('.modal-hd').toggleClass('show-modal')">Đóng lại
                        </button>
                        <button
                            class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70">
                            Lưu lại
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@section('content')
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <p>{{\Illuminate\Support\Facades\Session::get('error')}}</p>
    @endif
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 xl:gap-10 px-5 xl:px-16 py-4">
        <div class="col-span-12">
            <div class="box w-full">
                <div class="flex flex-col justify-start items-start w-full p-6">
                    <div class="flex justify-between  gap-1 pb-6 border-b-[1px] border-grey w-full">
                        <div class="p-3 ">
                            <h3 class="captilize font-medium text-xl text-title">Hồ sơ của tôi</h3>
                            <span class="text-secondary text-sm">Quản lý thông tin hồ sơ để bảo mật tài khoản</span>
                        </div>
                        <div class="p-3 text-xl">
                            <table>
                                <tr>
                                    <td>Ngày kích hoạt</td>
                                    <td>{{\Illuminate\Support\Carbon::parse($infoAccount->confirm_date)->format('d/m/Y')}}</td>
                                </tr>
                                <tr>
                                    <td>Ngày hết hạn</td>
                                    <td class="text-red-600 font-bold">{{\Illuminate\Support\Carbon::parse($infoAccount->expiration_date)->format('d/m/Y')}}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 md:gap-y-0 w-full md:p-6 ">
                        <div class="col-span-8 order-last md:order-first">
                            <div class="flex flex-col justify-start items-start gap-6 md:p-6 w-full ">
                                <div class="flex justify-start items-start gap-4">
                                    <span class="text-secondary">ID:</span>
                                    <span>{{$infoAccount->account_code}}</span>
                                </div>
                                <div class="flex justify-start items-start gap-4">
                                    <span class="text-secondary">Tên Kho:</span>
                                    <span>{{$infoAccount->name}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Tên công ty: </span>
                                    <span>{{$infoAccount->company_name}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Mã số thuế:</span>
                                    <span>{{$infoAccount->tax_code}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Địa chỉ:</span>
                                    <span>{{$infoAccount->address}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Tỉnh (thành phố): </span>
                                    <span>{{ucfirst($infoAccount->province->province_name)}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Quận (huyện): </span>
                                    <span>{{ucfirst($infoAccount->district->district_name)}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Phường(xã) </span>
                                    <span>{{ucfirst($infoAccount->ward->wards_name)??'' }}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">Số điện thoại: </span>
                                    <span>{{$infoAccount->phone_number}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">ID Người đại diện:</span>
                                    <span>{{$infoAccount->id_vdone}}</span>
                                </div>
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <span class="text-secondary">ID Người đại diện (khác):</span>
                                    <span>{{$infoAccount->id_vdone_diff}}</span>
                                </div>
                                {{--                                <div class="flex justify-start items-center gap-4 w-full">--}}
                                {{--                                    <span class="text-secondary">Link website: </span>--}}
                                {{--                                    <span><a--}}
                                {{--                                            href="{{$infoAccount->link_website ?? asset('/p/'.$infoAccount->slug)}}">{{$infoAccount->link_website ?? asset('/p/'.$infoAccount->slug)}}</a></span>--}}
                                {{--                                </div>--}}
                                <div class="flex justify-start items-center gap-4 w-full">
                                    <a href="#"
                                       class="w-1/4 edit-hs cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 w-full text-center text-[#FFFFFF] hover:opacity-70">
                                        Chỉnh sửa thông tin
                                    </a>
                                    <a href="{{route('screens.storage.account.editTaxCode')}}"
                                       class="w-1/4 cursor-pointer outline-none bg-green-600 transition-all duration-200 rounded-sm py-2 px-3 w-full text-center text-[#FFFFFF] hover:opacity-70">
                                        Cập nhật mã số thuế
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 order-first md:order-last">
                            <form action="{{route('screens.storage.account.upload',['id' => $infoAccount->id])}}"
                                  id="form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="flex flex-col justify-center items-center gap-4 w-full text-center border-l-0 md:border-l-[2px] border-grey">
                                    <div class="w-[200px] file-avt">
                                        <div class="w-[200px] h-[100px]  ">
                                            <img
                                                src="{{$infoAccount->avatar ? asset('image/users/'.$infoAccount->avatar) : asset('asset/images/success.png')}}"
                                                alt=""
                                                class="w-full  ">
                                        </div>
                                    </div>
                                    <button type="button"
                                            class="change-avt flex justify-center items-center border-[1px] rounded-sm border-grey px-4 py-2 outline-none hover:bg-primary hover:text-[#FFF] transition-all duration-200">
                                        Chọn ảnh
                                    </button>
                                    <div id="image"></div>
                                    <span class="text-secondary text-sm w-[200px]">Dụng lượng file tối đa 1 MB
                                                                        Định dạng:.JPEG, .PNG</span>
                                    <div class="flex flex-col justify-center items-center text-center gap-4 w-full p-4">
                                        <div class="w-full file-banner">
                                            <div class="w-full h-[100px] rounded-full shadow-xl">
                                                <img
                                                    src="{{asset('image/users/'.$infoAccount->banner) ?? asset('asset/images/bannerlg.png')}}"
                                                    alt="" class="w-full">
                                            </div>
                                        </div>
                                        <button type="button"
                                                class="change-bn flex justify-center items-center border-[1px] rounded-sm border-grey px-4 py-2 outline-none hover:bg-primary hover:text-[#FFF] transition-all duration-200">
                                            Chọn ảnh Banner
                                        </button>
                                        <div id="image2"></div>
                                        <span class="text-secondary text-sm w-[200px]">Dụng lượng file tối đa 1 MB
                                                                                    Định dạng:.JPEG, .PNG</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>


    </div>

@endsection
@section('custom_js')
    <script !src="">
        const divCity = document.getElementById('city_id');
        const divDistrict = document.getElementById('district_id');
        const divWard = document.getElementById('ward_id');
        fetch('{{route('get_city')}}', {
            mode: 'no-cors',

        })
            .then((response) => response.json())
            .then((data) => {
                document.getElementById('city_id').innerHTML = `<option value="0" disabled selected>Lựa chọn tỉnh (thành phố)</option>` + data.map(item => `<option ${item.PROVINCE_ID == '{{(int) $infoAccount->provinceId}}' ? 'selected' : ''}  data-name="${item.PROVINCE_NAME}" value="${item.PROVINCE_ID}">${item.PROVINCE_NAME.toUpperCase()}</option>`);
            })
            .catch(console.error);
        fetch('{{route('get_city')}}?type=2&value=' + '{{(int) $infoAccount->provinceId}}', {
            mode: 'no-cors',

        })
            .then((response) => response.json())
            .then((data) => {

                if (data.length > 0) {
                    divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>` + data.map(item => `<option ${item.DISTRICT_ID == '{{(int) $infoAccount->district_id}}' ? 'selected' : ''} data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}">${item.DISTRICT_NAME}</option>`);

                } else {
                    divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`;
                }
            })
            .catch(() => divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`
            );
        fetch('{{route('get_city')}}?type=3&value=' + '{{(int) $infoAccount->district_id}}', {
            mode: 'no-cors',

        })
            .then((response) => response.json())

            .then((data) => {

                if (data.length > 0) {
                    divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>` + data.map(item => `<option ${item.WARDS_ID == '{{(int) $infoAccount->ward_id}}' ? 'selected' : ''} data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`);

                } else {
                    divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`;
                }
            })
            .catch(() => divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`
            );
        divCity.addEventListener('change', (e) => {
            fetch('{{route('get_city')}}?type=2&value=' + e.target.value, {
                mode: 'no-cors',

            })
                .then((response) => response.json())
                .then((data) => {

                    if (data.length > 0) {
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>` + data.map(item => `<option data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}">${item.DISTRICT_NAME}</option>`);
                        divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`;
                    } else {
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`;
                        divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`;
                    }
                })
                .catch(() => {divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`
                    divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`}
                )
            ;
        });
        divDistrict.addEventListener('change', (e) => {
            fetch('{{route('get_city')}}?type=3&value=' + e.target.value, {
                mode: 'no-cors',

            })
                .then((response) => response.json())

                .then((data) => {

                    if (data.length > 0) {
                        divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>` + data.map(item => `<option  data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`);

                    } else {
                        divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`;
                    }
                })
                .catch(() => divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`
                );
        });

    </script>
    <script>
        $('.change-avt').on('click', function () {
            let input = document.createElement('input');
            input.type = 'file';
            // input.name = 'img'
            input.setAttribute('hidden', 'true')
            input.setAttribute('name', 'img');
            input.click();

            input.onchange = _ => {
                var files = Array.from(input.files);
                const reader = new FileReader();
                $('#form').submit();
                return new Promise(resolve => {
                    reader.onload = ev => {
                        resolve(ev.target.result)


                        $('.file-avt').html(` <div class="w-[100px] h-[100px] rounded-full shadow-xl">
            <img src="${ev.target.result}" alt="" class="w-full rounded-full">
        </div>`)
                    }
                    reader.readAsDataURL(files[0])

                })


            };
            $('#image').html(input);
        })

        $('.change-bn').on('click', function () {
            let input = document.createElement('input');
            input.type = 'file';
            input.setAttribute('hidden', 'true')
            input.setAttribute('name', 'banner');
            input.click();
            input.onchange = _ => {
                var files = Array.from(input.files);
                const reader = new FileReader();
                $('#form').submit();
                return new Promise(resolve => {
                    reader.onload = ev => {
                        resolve(ev.target.result)
                        $('.file-banner').html(`  <div class="w-full h-[100px] rounded-full shadow-xl">
            <img src="${ev.target.result}" alt="" class="w-full">
        </div>`)
                    }
                    reader.readAsDataURL(files[0])

                })
            };
            $('#image2').append(input);
        })
    </script>
@endsection
