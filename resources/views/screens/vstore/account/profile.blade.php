@extends('layouts.vstore.main')

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
    <div class="modal2 modal-hd @if(\Illuminate\Support\Facades\Session::has('validate')) show-modal @endif">
        <div class="over-lay-modal" onclick="$('.modal-hd').toggleClass('show-modal')"></div>
        <form action="{{route('screens.vstore.account.editPro',['id' => $infoAccount->id])}}" method="POST">
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
                            <span class="text-secondary w-full md:w-[280px]">Tên V-Store:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" id="name" name="name" @if($infoAccount->branch == 2) readonly @endif
                                class="w-full outline-none w-full py-2 px-3 @if($infoAccount->branch == 2) border-[1px] border-[#D9D9D9] bg-gray-200 @else border-[1px] border-[#D9D9D9] @endif    focus:border-primary transition-all duration-200 rounded-sm"
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
                            <span class="text-secondary w-full md:w-[280px]">Địa chỉ:</span>
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
                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Giới thiệu</span>
                            <div class="w-full">
                                <textarea type="text" name="description" id="description" rows="5" maxlength="500"
                                          class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                                >{{$infoAccount->description}}</textarea>
                                @error('description')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row justify-start items-center gap-4 w-full">
                            <span class="text-secondary w-full md:w-[280px]">Slug:</span>
                            <div class="w-full flex flex-col justify-start items-start gap-2">
                                <input type="text" name="link_website"
                                       class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] focus:border-primary transition-all duration-200 rounded-sm"
                                       value="{{$infoAccount->slug}}">
                                @error('link_website')
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
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

        </form>
    </div>

@endsection

@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title" id="pro">Hồ sơ của tôi </h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài
                                    khoản</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hồ sơ của tôi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 col-12">
            <div class="card profile">
                <form action="{{route('screens.vstore.account.upload',['id' => $infoAccount->id])}}"
                      id="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="text-center">
                            <div class="user-avatar text-center d-block mx-auto"
                                 style="position: relative; width: 128px; height: 128px; border-radius: 100%;">
                                <img id="img-avatar"
                                     src="{{$infoAccount->avatar ? asset('image/users/'.$infoAccount->avatar) : asset('asset/images/success.png')}}"
                                     alt="User Avatar" class="rounded-circle user-avatar-xxl">
                                <label for="upload-avatar">
                                    <i class="fas fa-image upAvatar" style="position: absolute; bottom: 10px; right: 10px; cursor: pointer; z-index: 10
                                ;"></i>
                                </label>
                                <input type="file" id="upload-avatar" hidden name="img" onchange="form.submit()"
                                       accept="image/png, image/gif, image/jpeg">
                            </div>
                            <h2 class="font-24 mb-0">{{$infoAccount->name}}</h2>
                            <p>{{$infoAccount->account_code}}</p>
                        </div>
                    </div>
                </form>
                <div class="card-body border-top">
                    <h3 class="font-16">Thông tin liên hệ</h3>
                    <div class="">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-0"><i class="fas fa-fw fa-phone mr-2"></i>{{$infoAccount->phone_number}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">

                    <h4>Ngày kích hoạt:
                        <strong>{{\Illuminate\Support\Carbon::parse($infoAccount->confirm_date)->format('d/m/Y')}}</strong>
                    </h4>
                    <h4>Ngày hết hạn: <strong
                            style="color:#DC2626">{{\Illuminate\Support\Carbon::parse($infoAccount->expiration_date)->format('d/m/Y')}}</strong>
                    </h4>
                </div>

            </div>
        </div>
        <div class="col-xl-9 col-lg-7 col-md-12 col-sm-12 col-12">
            <div class="influence-profile-content pills-regular">
                <div class="card">
                    <h5 class="card-header" style="font-size: 18px;">Hồ sơ của tôi</h5>

                    <div class="card-body">
                        <div>
                            <form action="{{route('screens.vstore.account.editPro',['id' => $infoAccount->id])}}"
                                  method="POST">
                                @csrf
                                <div class="row">
                                    <div class=" col-xl-10 mx-auto  col-lg-10 col-md-12 col-sm-12 col-12 p-4">
                                        @if(Session::has('success'))
                                            <div class="alert alert-success collapshow" role="alert"
                                                 id="alert-succ">
                                                {{Session::get('success')}}
                                                {{--                                                    Thông tin của bạn đã được cập nhật thành công!--}}
                                            </div>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Session::has('error'))
                                            <div class="alert alert-danger collapshow" role="alert"
                                                 id="alert-succ">
                                                {{\Illuminate\Support\Facades\Session::get('error')}}
                                            </div>
                                        @endif
                                        <div class="form-g">
                                            <div class="form-group">
                                                <label for="name">ID:</label>
                                                <input readonly type="text" class="form-control form-control-lg"
                                                       value="{{$infoAccount->account_code}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Email:</label>
                                                <input readonly type="text" class="form-control form-control-lg"
                                                       value="{{$infoAccount->email}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Tên V-Store:</label>
                                                <input required type="text" class="form-control form-control-lg"
                                                       name="name" id="name" @if($infoAccount->branch == 2) readonly
                                                       @endif value="{{$infoAccount->name}}">
                                                @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="company_name">Tên công ty:</label>
                                                <input required type="text" class="form-control form-control-lg"
                                                       id="company_name" name="company_name"
                                                       value="{{$infoAccount->company_name}}">
                                                @error('company_name')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Mã số thuế:</label>
                                                <input type="text" class="form-control form-control-lg"
                                                       value="{{$infoAccount->tax_code}}" readonly>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-4 mx-auto col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="name">Tỉnh (thành phố):</label>
                                                        <select required name="city_id" id="city_id"
                                                                class="addr form-control form-control-lg">
                                                            <option value="" disabled selected>Lựa chọn tỉnh (thành
                                                                phố)
                                                            </option>
                                                        </select>
                                                        @error('city_id')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 mx-auto col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="name">Quận (huyện):</label>
                                                        <select required name="district_id" id="district_id"
                                                                class="addr form-control form-control-lg">
                                                            <option value="" hidden>Lựa chọn quận (huyện)</option>
                                                        </select>
                                                        @error('district_id')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 mx-auto col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="name">Phường (xã):</label>
                                                        <select required name="ward_id" id="ward_id"
                                                                class="addr form-control form-control-lg">
                                                            <option value="">Lựa chọn Phường (xã)</option>
                                                        </select>
                                                        @error('ward_id')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="addres">Địa chỉ:</label>
                                                <input required type="text" class="form-control form-control-lg"
                                                       id="address" name="address"
                                                       value="{{$infoAccount->address}}">

                                                @error('address')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_number">Số điện thoại:</label>
                                                <input required type="text"
                                                       class="form-control form-control-lg only-number"
                                                       id="phone_number" name="phone_number"
                                                       pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b"
                                                       value="{{$infoAccount->phone_number}}">
                                                @error('phone_number')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="id_vdone">ID Người đại diện:</label>
                                                <input required type="text" class="form-control form-control-lg"
                                                       id="id_vdone" name="id_vdone"
                                                       value="{{$infoAccount->id_vdone}}">
                                                @error('id_vdone')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="id_vdone_diff">ID Người đại diện (khác):</label>
                                                <input type="text" class="form-control form-control-lg"
                                                       id="id_vdone_diff" name="id_vdone_diff"
                                                       value="{{$infoAccount->id_vdone_diff}}">
                                                @error('id_vdone_diff')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="link_website">
                                                    <a class="text-secondary"
                                                       href="{{route('intro',['slug'=> $infoAccount->slug])}}">Slug</a>
                                                </label>
                                                <input type="text" class="form-control form-control-lg"
                                                       id="link_website" name="link_website"
                                                       value="{{$infoAccount->slug}}">
                                                @error('link_website')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Giới thiệu</label>
                                                <textarea type="text" class="form-control form-control-lg"
                                                          style="max-height: 150px"
                                                          id="description"
                                                          name="description">{{$infoAccount->description}}</textarea>
                                                @error('description')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center"
                                             style="gap:10px">
                                            <button type="submit" class="btn btn-primary btn-submit ">Cập nhật
                                                thông tin
                                            </button>
                                            <button type="button" class="btn btn-success"
                                                {{-- data-toggle="modal" data-target="#modal-tax-code" --}}
                                            >
                                                <a href="{{route('screens.vstore.account.editTaxCode')}}"
                                                   class="text-white">
                                                    Cập nhật mã số thuế
                                                </a>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <div class="modal fade" id="modal-tax-code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật mã số thuế</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('screens.storage.account.saveChangeTaxCode')}}" method="POST">
                    @csrf
                    <div class="modal-body" id="form-tax-code">
                        <div class="form-group">
                            <label for="tax_code">Mã số thuế:</label>
                            <input type="text" class="form-control form-control-lg"
                                   value="{{$infoAccount->tax_code}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tax_code">Mã số thuế mới:</label>
                            <input required type="text" class="form-control form-control-lg" id="new_tax_code"
                                   name="tax_code"
                                   pattern="^[0-9]{10,13}$" title="Mã số thuế phải có độ dài từ 10 hoặc 13 chữ số"
                                   value="">
                            <div class="vali"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng lại</button>
                        <button type="submit" class="btn btn-primary btn-save-tax">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('custom_js')
    <script>
        $(document).ready(function () {
            function convertDate(inputFormat) {
                function pad(s) {
                    return (s < 10) ? '0' + s : s;
                }

                var d = new Date(inputFormat)
                return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join('/')
            }

            // show loi
            @if ($errors->has('img'))
            const textError = '{{ $errors->first('img') }}';
            swalNoti('center', 'error', 'Định dạng ảnh không hợp lệ', textError, 500, true, 3000);
            @endif
        });

        // tinh thanh pho
        const divCity = document.getElementById('city_id');
        const divDistrict = document.getElementById('district_id');
        const divWard = document.getElementById('ward_id');
        fetch('{{route('get_city')}}', {
            mode: 'no-cors',

        })
            .then((response) => response.json())
            .then((data) => {
                document.getElementById('city_id').innerHTML = `<option value="" disabled selected>Lựa chọn tỉnh (thành phố)</option>` + data.map(item => `<option ${item.PROVINCE_ID == '{{(int) $infoAccount->provinceId}}' ? 'selected' : ''}  data-name="${item.PROVINCE_NAME}" value="${item.PROVINCE_ID}">${item.PROVINCE_NAME.toUpperCase()}</option>`);
            })
            .catch(console.error);
        fetch('{{route('get_city')}}?type=2&value=' + '{{(int) $infoAccount->provinceId}}', {
            mode: 'no-cors',
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    divDistrict.innerHTML = `<option value="" disabled selected>Lựa chọn quận (huyện)</option>` + data.map(item => `<option ${item.DISTRICT_ID == '{{(int) $infoAccount->district_id}}' ? 'selected' : ''} data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}">${item.DISTRICT_NAME}</option>`);

                } else {
                    divDistrict.innerHTML = `<option value="" disabled selected>Lựa chọn quận (huyện)</option>`;
                }
            })
            .catch(() => divDistrict.innerHTML = `<option value="" disabled selected>Lựa chọn quận (huyện)</option>`
            );
        fetch('{{route('get_city')}}?type=3&value=' + '{{(int) $infoAccount->district_id}}', {
            mode: 'no-cors',

        })
            .then((response) => response.json())

            .then((data) => {
                if (data.length > 0) {
                    divWard.innerHTML = `<option value="" disabled selected>Lựa chọn phường (xã)</option>` + data.map(item => `<option ${item.WARDS_ID == '{{(int) $infoAccount->ward_id}}' ? 'selected' : ''} data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`);
                } else {
                    divWard.innerHTML = `<option value="" disabled selected>Lựa chọn phường (xã)</option>`;
                }
            })
            .catch(() => divWard.innerHTML = `<option value="" disabled selected>Lựa chọn phường (xã)</option>`
            );
        divCity.addEventListener('change', (e) => {
            fetch('{{route('get_city')}}?type=2&value=' + e.target.value, {
                mode: 'no-cors',

            })
                .then((response) => response.json())
                .then((data) => {

                    if (data.length > 0) {
                        divDistrict.innerHTML = `<option value="" disabled selected>Lựa chọn quận (huyện)</option>` + data.map(item => `<option data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}">${item.DISTRICT_NAME}</option>`);
                        divWard.innerHTML = `<option value="" disabled selected>Lựa chọn phường (xã)</option>`;
                    } else {
                        divDistrict.innerHTML = `<option value="" disabled selected>Lựa chọn quận (huyện)</option>`;
                        divWard.innerHTML = `<option value="" disabled selected>Lựa chọn phường (xã)</option>`;
                    }
                })
                .catch(() => {
                        divDistrict.innerHTML = `<option value="" disabled selected>Lựa chọn quận (huyện)</option>`
                        divWard.innerHTML = `<option value="" disabled selected>Lựa chọn phường (xã)</option>`
                    }
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
@endsection
