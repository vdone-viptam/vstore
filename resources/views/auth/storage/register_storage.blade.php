@php
    if($order && $user) {
        $isOrder = true;
    } else {
        $isOrder = \Illuminate\Support\Facades\Session::has('order');
        $order = \Illuminate\Support\Facades\Session::get('order');
        $user = \Illuminate\Support\Facades\Session::get('user');
    }
@endphp

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký KHO</title>
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/dist/output.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
    <meta property="og:title" content="Kho | Hệ thống quản lý kho chuyên nghiệp"/>
    <meta property="og:description"
          content="Hãy đồng hành cùng 20.000+ người kinh doanh và thương hiệu bậc nhất tại Việt Nam đang tin dùng Kho."/>
    <meta property="og:url" content="{{asset('')}}"/>
    <meta property="og:image" content="{{asset('home/img/kho11.png')}}"/>
    {{--    css thêm sau --}}

    <link rel="stylesheet" href="{{asset('asset/bootstrap.min.css')}}">

    {{--    END css thêm sau --}}
    <meta property="og:image:width" content="120">
    <meta property="og:image:height" content="100">
    <link rel="stylesheet" href="{{asset('asset/css/register/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/register/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/register/fontawesome-all.css')}}">
    @vite('resources/css/app.css')
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>
<body>
@if(\Illuminate\Support\Facades\Session::has('success'))
    <div class="modal modal-success flex justify-center items-center show-modal">
        <div class="over-lay-modal" onclick="$('.modal-success').toggleClass('show-modal')"></div>
        <div
            class="information success flex flex-col justify-end w-full max-w-[300px] md:max-w-[650px] h-[400px] shadow-xl p-6 my-6 mx-auto rounded-sm">
            <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-success').toggleClass('show-modal')"
                 class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                 fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                    fill="white"/>
            </svg>
            <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
                <h2 class="text-title text-2xl font-medium">Bạn đã gửi thông tin đăng ký thành công</h2>
                <span
                    class="text-[#000]">Thông tin đăng ký của bạn đang chờ duyệt. Vui lòng chờ kết quả trong vòng (24 giờ)</span>
            </div>
        </div>
    </div>
@endif

<form class="splash-container splash-register" action="{{route('post_register',['role_id' => 4])}}" id="formRegister-V" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>
                <h3 class="mb-1">Đăng ký</h3>
                <p>Vui lòng nhập thông tin để đăng ký tài khoản.</p>
            </div>

            <img src="{{asset('asset/images/titleK.png')}}" style="object-fit: contain; height: 40px;" alt="Logo">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-2">
                    <h3 style="font-size: 20px;">Thông tin tài khoản</h3>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                        <label style="font-weight: 600;" for="email"><span class="text-danger">*</span>Email</label>
                        <input class="form-control form-control-lg" type="email" name="email" id="email" required=""
                               value="{{old('email')}}"
                               placeholder="Nhập email (VD: example@address.com)" autocomplete="off">
                        @error('email')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                        <label style="font-weight: 600;" for="telephone"><span class="text-danger">*</span>Số điện
                            thoại công ty</label>
                        <input class="only-number form-control form-control-lg" required=""
                               type="text" name="phone_number" id="phone_number"
                               value="{{old('phone_number')}}"
                               pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b"
                               placeholder="Nhập số điện thoại (VD: 0123456789)">
                        @error('phone_number')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                        <label style="font-weight: 600;" for="kho"><span class="text-danger">*</span>Tên Kho</label>
                        <input class="form-control form-control-lg" type="text" required=""
                               name="name" id="name" placeholder="Nhập tên kho" value="{{old('name')}}"
                               autocomplete="off">
                        @error('name')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                        <label style="font-weight: 600; display:flex;align-items:center" for="idpDone"><span class="text-danger">*</span>ID P-Done
                            người đại diện <svg style="cursor: pointer;margin-left: 3px;" width="14" height="14" viewBox="0 0 14 14"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <title>Vui lòng nhập ID P-Done của người đại diện của bạn</title>
                                <path
                                    d="M7 0C3.13437 0 0 3.13437 0 7C0 10.8656 3.13437 14 7 14C10.8656 14 14 10.8656 14 7C14 3.13437 10.8656 0 7 0ZM7 12.8125C3.79063 12.8125 1.1875 10.2094 1.1875 7C1.1875 3.79063 3.79063 1.1875 7 1.1875C10.2094 1.1875 12.8125 3.79063 12.8125 7C12.8125 10.2094 10.2094 12.8125 7 12.8125Z"
                                    fill="black" fill-opacity="0.45"></path>
                                <path
                                    d="M6.24976 4.25C6.24976 4.44891 6.32877 4.63968 6.46943 4.78033C6.61008 4.92098 6.80084 5 6.99976 5C7.19867 5 7.38943 4.92098 7.53009 4.78033C7.67074 4.63968 7.74976 4.44891 7.74976 4.25C7.74976 4.05109 7.67074 3.86032 7.53009 3.71967C7.38943 3.57902 7.19867 3.5 6.99976 3.5C6.80084 3.5 6.61008 3.57902 6.46943 3.71967C6.32877 3.86032 6.24976 4.05109 6.24976 4.25ZM7.37476 6H6.62476C6.55601 6 6.49976 6.05625 6.49976 6.125V10.375C6.49976 10.4438 6.55601 10.5 6.62476 10.5H7.37476C7.44351 10.5 7.49976 10.4438 7.49976 10.375V6.125C7.49976 6.05625 7.44351 6 7.37476 6Z"
                                    fill="black" fill-opacity="0.45"></path>
                            </svg></label>
                        <input class="form-control form-control-lg" required="" type="text"
                               name="id_vdone" id="id_vdone"
                               value="{{old('id_vdone')}}"
                               placeholder="Nhập ID P-Done người đại diện (VD: VN1234567891)">
                        @error('id_vdone')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                        <label style="font-weight: 600;" for="company"><span class="text-danger">*</span>Tên công ty/ hợp tác xã/ hộ kinh doanh cá thể</label>
                        <input class="form-control form-control-lg" type="text" required=""
                               name="company_name" id="company_name"
                               placeholder="Nhập tên công ty/ hợp tác xã/ hộ kinh doanh cá thể"
                               value="{{old('company_name')}}"
                               autocomplete="off">
                        @error('company_name')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                        <label style="font-weight: 600;" for="idpDonemore">&nbsp;ID P-Done người đại diện (khác)</label>
                        <input class="form-control form-control-lg" type="text"
                               name="id_vdone_diff" id="id_vdone_diff"
                               value="{{old('id_vdone_diff')}}"
                               placeholder="Nhập ID P-Done người đại diện khác (VD: VN12345678)">
                        @error('id_vdone_diff')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                        <label style="font-weight: 600;" for="code"><span class="text-danger">*</span>Mã số thuế</label>
                        <input class='only-number form-control form-control-lg' type="text" required=""
                               name="tax_code" id="tax_code" placeholder="Nhập mã số thuế (VD: 1234567891)"
                               pattern="^[0-9]{10,13}$" title="Mã số thuế phải có độ dài từ 10 hoặc 13 chữ số"
                               value="{{old('tax_code')}}"
                               autocomplete="off">
                        @error('tax_code')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label style="font-weight: 600;">&nbsp;ID P-Done
                                người giới thiệu</label>
                            <input class="form-control form-control-lg" type="text"
                                   name="referral_code"
                                   value="{{$referral_code}}"
                                   placeholder="ID P-Done người giới thiệu" readonly autocomplete="off">
                            @error('referral_code')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-2 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label style="font-weight: 600;" for="city_id"><span class="text-danger">*</span>Tỉnh (Thành
                            phố)</label>
                        <select class="form-control form-control-lg" required name="city_id" id="city_id">
                            <option value="" hidden>Lựa chọn tỉnh (thành phố)</option>
                        </select>
                        @error('city_id')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label style="font-weight: 600;" for=""><span class="text-danger">*</span>Quận
                            (Huyện)</label>
                        <select class="form-control form-control-lg" required name="district_id" id="district_id">
                            <option value="" hidden>Lựa chọn quận (huyện)</option>
                        </select>
                        @error('district_id')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label style="font-weight: 600;" for=""><span class="text-danger">*</span>Phường
                            (Xã)</label>
                        <select class="form-control form-control-lg" required name="ward_id" id="ward_id">
                            <option value="" hidden>Lựa chọn Phường (xã)</option>
                        </select>
                        @error('ward_id')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label style="font-weight: 600;" for="address"><span class="text-danger">*</span>Địa chỉ chi tiết</label>
                        <input class="form-control form-control-lg" type="text" name="address" id="address" required=""
                            value="{{old('address')}}"
                            placeholder="Nhập địa chỉ chi tiết (VD:Số nhà, tòa nhà, thôn...)">
                        @error('address')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-4">
                    <h3 style="font-size: 20px;">Thông tin kho</h3>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-3 mb-2">
                    <h4 style="font-weight: 600;">Phân loại kho: <span class="text-danger">*</span></h4>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 ">
                    <div class="card p-4" style="box-shadow: 0px 1px 2px 4px rgba(154, 154, 204, 0.22);">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="normal_storage" value="normal_storage" id="normal_storage"><span
                                class="custom-control-label">Kho thường</span>
                        </label>
                        @error('normal_storage')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                        <div class="">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;"><span
                                                class="text-danger">*</span>Diện tích kho
                                            (m2)</label>
                                        <input class="only-number form-control form-control-lg" type="text" name="acreage_normal_storage" id="acreage_normal_storage"
                                            placeholder="Nhập diện tích (m2)">
                                        @error('acreage_normal_storage')
                                        <p class="text-red-600">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <label style="font-weight: 600;" for="kt">Kích
                                        thước kho
                                        (m)</label>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="length_normal_storage" id="length_normal_storage"
                                                    placeholder="Chiều dài">
                                                @error('length_normal_storage')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="width_normal_storage" id="width_normal_storage"
                                                    placeholder="Chiều rộng">
                                                @error('width_normal_storage')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="height_normal_storage" id="height_normal_storage"
                                                    placeholder="Chiều cao">
                                                @error('height_normal_storage')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;" for="volume_normal_storage">Thể tích kho
                                            (m3)</label>
                                        <input class="only-number form-control form-control-lg" type="text" name="volume_normal_storage" id="volume_normal_storage"
                                            placeholder="Nhập thể tích (m3)">
                                            @error('volume_normal_storage')
                                            <p class="text-red-600">{{$message}}</p>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label style="font-weight: 600;" for="tts"><span
                                            class="text-danger">*</span>Hình ảnh kho</label>
                                    <input class="form-control form-control-lg" type="file" name="image_normal_storage[]" id="image_normal_storage"
                                        placeholder="Nhập hình ảnh kho" multiple accept="image/png, image/gif, image/jpeg">
                                    @error('image_normal_storage')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                    @if ($errors->has('image_normal_storage.*'))
                                        <p class="text-red-600">{{ $errors->first('image_normal_storage.*')}}</p>
                                    @endif
                                </div>
                                <div class="col-12 my-4">
                                    <label style="font-weight: 600;" for="tts">Giấy chứng nhận
                                        PCCC/Chứng nhận khác</label>
                                    <input class="form-control form-control-lg" type="file" name="image_pccc_normal_storage[]"
                                        placeholder="Nhập chứng nhận PCCC/Chứng nhận khác" multiple accept="image/png, image/gif, image/jpeg">
                                    @error('image_pccc_normal_storage')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                    @if ($errors->has('image_pccc_normal_storage.*'))
                                        <p class="text-red-600">{{ $errors->first('image_pccc_normal_storage.*')}}</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 ">
                    <div class="card p-4" style="box-shadow: 0px 1px 2px 4px rgba(168, 168, 207, 0.22);">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="custom-control-input" name="cold_storage" value="cold_storage" id="cold_storage"><span
                                class="custom-control-label">Kho lạnh</span>
                        </label>
                        @error('cold_storage')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                        <div class="">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;" for="dts"><span
                                                class="text-danger">*</span>Diện tích kho
                                            (m2)</label>
                                        <input class="only-number form-control form-control-lg" type="text" name="acreage_cold_storage" id="acreage_cold_storage"
                                            placeholder="Nhập diện tích (m2)">
                                        @error('acreage_cold_storage')
                                        <p class="text-red-600">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <label style="font-weight: 600;" for="kt">Kích
                                        thước kho
                                        (m)</label>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="length_cold_storage" id="length_cold_storage"
                                                    placeholder="Chiều dài">
                                                @error('length_cold_storage')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="width_cold_storage" id="width_cold_storage"
                                                    placeholder="Chiều rộng">
                                                @error('width_cold_storage')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="height_cold_storage" id="height_cold_storage"
                                                    placeholder="Chiều cao">
                                                @error('height_cold_storage')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;" for="tts">Thể tích kho
                                            (m3)</label>
                                        <input class="only-number form-control form-control-lg" type="text" name="volume_cold_storage" id="volume_cold_storage"
                                            placeholder="Nhập thể tích (m3)">
                                            @error('volume_cold_storage')
                                            <p class="text-red-600">{{$message}}</p>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label style="font-weight: 600;" for="tts"><span
                                            class="text-danger">*</span>Hình ảnh kho</label>
                                    <input class="form-control form-control-lg" type="file" name="image_cold_storage[]" id="image_cold_storage"
                                        placeholder="Nhập hình ảnh kho" multiple accept="image/png, image/gif, image/jpeg">
                                    @error('image_cold_storage')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                    @if ($errors->has('image_cold_storage.*'))
                                        <p class="text-red-600">{{ $errors->first('image_cold_storage.*')}}</p>
                                    @endif
                                </div>
                                <div class="col-12 my-4">
                                    <label style="font-weight: 600;" for="tts">Giấy chứng nhận
                                        PCCC/Chứng nhận khác</label>
                                    <input class="form-control form-control-lg" type="file" name="image_pccc_cold_storage[]"
                                        placeholder="Nhập chứng nhận PCCC/Chứng nhận khác" multiple accept="image/png, image/gif, image/jpeg">
                                    @error('image_pccc_cold_storage')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                    @if ($errors->has('image_pccc_cold_storage.*'))
                                        <p class="text-red-600">{{ $errors->first('image_pccc_cold_storage.*')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 ">
                    <div class="card p-4" style="box-shadow: 0px 1px 2px 4px rgba(154, 154, 204, 0.22);">
                        <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" class="only-number custom-control-input" name="warehouse" value="warehouse" id="warehouse"><span
                                class="custom-control-label">Kho bãi</span>
                        </label>
                        @error('warehouse')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                        <div class="">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;" for="dts"><span
                                                class="text-danger">*</span>Diện tích kho
                                            (m2)</label>
                                        <input class="only-number form-control form-control-lg" type="text" name="acreage_warehouse" id="acreage_warehouse"
                                            placeholder="Nhập diện tích (m2)">
                                        @error('acreage_warehouse')
                                        <p class="text-red-600">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <label style="font-weight: 600;" for="kt">Kích
                                        thước kho
                                        (m)</label>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="length_warehouse" id="length_warehouse"
                                                    placeholder="Chiều dài">
                                                @error('length_warehouse')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="width_warehouse" id="width_warehouse"
                                                    placeholder="Chiều rộng">
                                                @error('width_warehouse')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <input class="only-number form-control form-control-lg" type="text" name="height_warehouse" id="height_warehouse"
                                                    placeholder="Chiều cao">
                                                @error('height_warehouse')
                                                <p class="text-red-600">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label style="font-weight: 600;" for="tts">Thể tích kho
                                            (m3)</label>
                                        <input class="only-number form-control form-control-lg" type="text" name="volume_warehouse" id="volume_warehouse"
                                            placeholder="Nhập thể tích (m3)">
                                            @error('volume_warehouse')
                                            <p class="text-red-600">{{$message}}</p>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label style="font-weight: 600;" for="tts"><span
                                            class="text-danger">*</span>Hình ảnh kho</label>
                                    <input class="form-control form-control-lg" type="file" name="image_warehouse[]" id="image_warehouse"
                                        placeholder="Nhập hình ảnh kho" multiple accept="image/png, image/gif, image/jpeg">
                                    @error('image_warehouse')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                    @if ($errors->has('image_warehouse.*'))
                                        <p class="text-red-600">{{ $errors->first('image_warehouse.*')}}</p>
                                    @endif
                                </div>
                                <div class="col-12 my-4">
                                    <label style="font-weight: 600;" for="tts">Giấy chứng nhận
                                        PCCC/Chứng nhận khác</label>
                                    <input class="form-control form-control-lg" type="file" name="image_pccc_warehouse[]"
                                        placeholder="Nhập chứng nhận PCCC/Chứng nhận khác" multiple accept="image/png, image/gif, image/jpeg">
                                    @error('image_pccc_warehouse')
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                    @if ($errors->has('image_pccc_warehouse.*'))
                                        <p class="text-red-600">{{ $errors->first('image_pccc_warehouse.*')}}</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4" style="max-width: 450px; margin: 0 auto;">
                <label class="custom-control custom-checkbox">
                    <input class="custom-control-input" required type="checkbox"><span class="custom-control-label">Tôi đồng
                        ý với <span style="text-decoration: underline;cursor: pointer;"  class="underline text-blue-700" data-toggle="modal" data-target=".modal-terms">Điều khoản sử dụng dịch vụ.</span></span>
                </label>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary btn-secondary active" disabled type="submit">Đăng ký mua</button>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <p>Bạn đã có tài khoản? <a href="{{route('login_storage')}}" class="text-secondary">Đăng nhập ngay</a></p>
        </div>
    </div>
</form>

{{-- modal terms --}}
<div class="modal fade modal-terms" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 20px;">Điều khoản sử dụng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="content col-12 my-4">
                VDONE tạo ra các công nghệ và dịch vụ nhằm hỗ trợ mọi người kết nối với nhau, xây dựng cộng đồng cũng như
            phát triển doanh nghiệp. Các Điều khoản này điều chỉnh việc bạn sử dụng các sản phẩm, tính năng, ứng dụng,
            dịch vụ, công nghệ cũng như phần mềm khác mà chúng tôi cung cấp (Sản phẩm của VDONE), trừ khi chúng tôi nêu
            rõ là áp dụng các điều khoản riêng (và không áp dụng các điều khoản này). Các Sản phẩm này do VipTam, Inc.
            cung cấp cho bạn. <br>
            Bạn không mất phí sử dụng các sản phẩm và dịch vụ khác thuộc phạm vi điều chỉnh của những Điều khoản này,
            trừ khi chúng tôi có quy định khác. Thay vào đó, doanh nghiệp, tổ chức và những cá nhân khác sẽ phải trả
            tiền cho chúng tôi để hiển thị quảng cáo về sản phẩm và dịch vụ của họ cho bạn. Khi sử dụng Sản phẩm của
            chúng tôi, bạn đồng ý để chúng tôi hiển thị quảng cáo mà chúng tôi cho rằng có thể phù hợp với bạn và sở
            thích của bạn. Chúng tôi sử dụng dữ liệu cá nhân của bạn để xác định những quảng cáo được cá nhân hóa sẽ
            hiển thị cho bạn. <br>
            Chúng tôi không bán dữ liệu cá nhân của bạn cho các nhà quảng cáo, cũng không chia sẻ thông tin trực tiếp
            nhận dạng bạn (chẳng hạn như tên, địa chỉ email hoặc thông tin liên hệ khác) với những đơn vị này trừ khi
            được bạn cho phép cụ thể. Thay vào đó, các nhà quảng cáo có thể cho chúng tôi biết thông tin như kiểu đối
            tượng mà họ muốn nhìn thấy quảng cáo và chúng tôi có thể hiển thị những quảng cáo ấy cho người có thể quan
            tâm. <br>
Chúng tôi cho nhà quảng cáo biết hiệu quả quảng cáo để những đơn vị này nắm được cách mọi người tương tác
            với nội dung của họ. Hãy xem Mục 2 ở bên dưới để hiểu rõ hơn cách chúng tôi hiển thị quảng cáo được cá nhân
            hóa trên Sản phẩm của VDONE theo các điều khoản này.
            Chính sách quyền riêng tư của chúng tôi giải thích cách chúng tôi thu thập và sử dụng dữ liệu cá nhân của bạn để quyết định hiển thị cho bạn quảng cáo nào, cũng như để cung cấp tất cả các dịch vụ khác được mô tả
            bên dưới. Bạn cũng có thể chuyển đến trang cài đặt trên Sản phẩm có liên quan của VDONE bất cứ lúc nào để
            xem lại các lựa chọn quyền riêng tư mình có đối với cách chúng tôi sử dụng dữ liệu của bạn.
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                    lại</button>
            </div>
        </div>
    </div>
</div>
{{-- modal terms --}}

@if($isOrder)
    <div class="modal fade modal-tt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{route('post_register_order_kho',['order_id' => $order->id])}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="d-flex flex-column" style="gap:6px">
                            <img src="{{asset('home/img/titleK.png')}}" alt="" style="object-fit: contain; height: 40px;">
                            <h5 class="modal-title" style="font-size: 20px;">Thông tin thanh toán</h5>
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="content m-4">
                        <div class="w-100" style="background-color: #F2F8FF; border-radius: 10px;">
                            <div class="col-12">
                                <h3 style="font-weight: 600; padding-top: 15px; font-size:22px; margin-bottom:15px;">Thông tin bên mua</h3>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 style="font-weight: 600;margin-bottom:15px;">Tên công ty</h4>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-weight: 600; font-size: 16px;">{{$user->company_name}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 style="font-weight: 600;margin-bottom:15px;">Mã số thuế</h4>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-size: 16px;">{{$user->tax_code}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 style="font-weight: 600;margin-bottom:15px;">Tên Nhà cung cấp</h4>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-size: 16px;">{{$user->name}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 style="font-weight: 600;margin-bottom:15px;">ID P-Done người đại diện</h4>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-size: 16px;">{{$user->id_vdone}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 style="font-weight: 600;margin-bottom:15px;">Số điện thoại công ty</h4>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-size: 16px;">{{$user->phone_number}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 style="font-weight: 600;margin-bottom:15px;">Email</h4>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-size: 16px;">{{$user->email}}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 style="font-weight: 600;margin-bottom:15px;">ID P-Done người giới thiệu</h4>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-size: 16px;">{{$user->referral_code}}</span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="row ">
                            <div class="col-xl-6 col-lg-6 col-md-12 my-3">
                                <div class="w-100 " style="background-color: #F2F8FF; border-radius: 10px;">
                                    <div class="col-12">
                                        <h3 style="font-weight: 600; padding-top: 15px; margin-bottom:15px; font-size:22px">Chi tiết sản phẩm</h3>
                                    </div>
                                    @php

                                        $price = (float) config('constants.orderService.price_kho');
                                        $priceFormat = number_format($price, 0, '', '.');
                                        $vat = (float) config('constants.orderService.price_kho')*10/100;
                                        $vatFormat = number_format($vat, 0, '', '.');

                                        $total = $price + $vat;
                                        $totalFormat = number_format($total, 0, '', '.');


                                        $chiTietThanhToan = array(
                                            [
                                                "title" => "Ngày tạo",
                                                "value" => $order->created_at,
                                                "class"=> ""
                                            ],
                                            [
                                                "title" => "Tài khoản",
                                                "value" => "KHO",
                                                "class"=> ""
                                            ],
                                            [
                                                "title" => "Thời hạn",
                                                "value" => "1 năm",
                                                "class"=> ""
                                            ],
                                            [
                                                "title" => "Giá sản phẩm",
                                                "value" => $priceFormat . "đ",
                                                "class"=> ""
                                            ],
                                            [
                                                "title" => "VAT",
                                                "value" => $vatFormat . "đ",
                                                "class"=> ""
                                            ],
                                            [
                                                "title" => "Tổng số tiền",
                                                "value" => $totalFormat . "đ",
                                                "class"=> "text-danger"
                                            ]);
                                    @endphp
                                    <div class="col-12">
                                        @foreach($chiTietThanhToan as $value)
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 style=" margin-bottom:15px; font-weight:600">{{$value['title']}}</h4>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <span class="{{$value['class']}}" style="font-size: 16px;">{{$value['value']}}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 my-3" >
                                <div class="w-100 " style="background-color: #F2F8FF; border-radius: 10px;">
                                    <div class="col-12">
                                        <h3 style="font-weight: 600; padding-top: 15px; margin-bottom:15px; font-size:22px;">Phương thức thanh toán</h3>
                                    </div>
                                    <div class="col-12" style="padding-bottom: 15px;">
                                        <div class="d-flex justify-content-between align-items-center w-100" style="background-color: white; border-radius: 10px; padding: 13px 20px;">
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                <div style="width: 26px; height: 26px;">
                                                    <img src="{{asset('asset/icons/payment/icon_9pay.png')}}" alt="">
                                                </div>
                                                <span>Thanh toán ngay qua 9Pay</span>
                                            </div>
                                            <label class="custom-control custom-radio custom-control-inline" style="margin: 0;">
                                                <input type="radio" value="9PAY" name="method_payment" checked class="custom-control-input"><span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center w-100 my-2" style="background-color: white; border-radius: 10px; padding: 13px 20px;">
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                <div style="width: 26px; height: 26px;">
                                                    <img src="{{asset('asset/icons/payment/icon_cart.png')}}" alt="">
                                                </div>
                                                <span>Thẻ nội địa</span>
                                            </div>
                                            <label class="custom-control custom-radio custom-control-inline" style="margin: 0;">
                                                <input type="radio" value="ATM_CARD" name="method_payment"  class="custom-control-input"><span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center w-100" style="background-color: white; border-radius: 10px; padding: 13px 20px;">
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                <div style="width: 26px; height: 26px;">
                                                    <img src="{{asset('asset/icons/payment/icon_cart_2.png')}}" alt="">
                                                </div>
                                                <span>Thẻ quốc tế</span>
                                            </div>
                                            <label class="custom-control custom-radio custom-control-inline" style="margin: 0;">
                                                <input type="radio" value="CREDIT_CARD" name="method_payment"  class="custom-control-input"><span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center w-100 mt-2 " style="background-color: white; border-radius: 10px; padding: 13px 20px;">
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                <div style="width: 26px; height: 26px;">
                                                    <img src="{{asset('asset/icons/payment/icon_bank.png')}}" alt="">
                                                </div>
                                                <span>Chuyển khoản ngân hàng</span>
                                            </div>
                                            <label class="custom-control custom-radio custom-control-inline" style="margin: 0;">
                                                <input type="radio" value="BANK_TRANSFER" name="method_payment"  class="custom-control-input"><span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <div class="w-100 mx-auto text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng
                            </button>
                            <button type="submit" class="btn btn-primary" >Thanh toán
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    </div>

<script src="{{asset('asset/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('asset/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('asset/js/main.js')}}"></script>

    <script>
        const divCity = document.getElementById('city_id');
        const divDistrict = document.getElementById('district_id');
        const divWard = document.getElementById('ward_id');
        const btnSubmit = document.querySelector('.active');

        fetch('{{route('get_city')}}', {
            mode: 'no-cors',

        })
            .then((response) => response.json())
            .then((data) => {
                document.getElementById('city_id').innerHTML = `<option value="0" disabled selected>Lựa chọn tỉnh (thành phố)</option>` + data.map(item => `<option data-name="${item.PROVINCE_NAME}" value="${item.PROVINCE_ID}" ${item.PROVINCE_ID == '{{old('city_id')}}' ? 'selected' : ''}>${item.PROVINCE_NAME}</option>`);
            })
            .catch(console.error);

        divCity.addEventListener('change', (e) => {
            fetch('{{route('get_city')}}?type=2&value=' + e.target.value, {
                mode: 'no-cors',

            })
                .then((response) => response.json())

                .then((data) => {
                    if (data.length > 0) {
                        const check = checkEmpty(inputs);
                        if (check && divCity.value && divDistrict.value && divWard.value) {
                            btnSubmit.removeAttribute('disabled');
                            btnSubmit.classList.remove('btn-secondary');
                        } else {
                            btnSubmit.setAttribute('disabled', 'true');
                            btnSubmit.classList.add('btn-secondary');
                        }
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>` + data.map(item => `<option data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}" >${item.DISTRICT_NAME}</option>`);

                    } else {
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`;
                    }
                })
                .catch(() => divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`
                )
        });
        divDistrict.addEventListener('change', (e) => {
            fetch('{{route('get_city')}}?type=3&value=' + e.target.value, {
                mode: 'no-cors',

            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        const check = checkEmpty(inputs);
                        if (check && divCity.value && divDistrict.value && divWard.value) {
                            btnSubmit.removeAttribute('disabled');
                            btnSubmit.classList.remove('btn-secondary');
                        } else {
                            btnSubmit.setAttribute('disabled', 'true');
                            btnSubmit.classList.add('btn-secondary');
                        }
                        divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>` + data.map(item => `<option data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`);

                    } else {
                        divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>`;
                    }
                })
                .catch(() => divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>`
                )
        });

        function checkEmpty(inputs) {
            let check1 = true
            inputs.forEach((item1, index1) => {
                if (!item1.value && index1 > 0 && index1 <= 10 ) {
                    check1 = false;
                }
                if(index1 == 10){
                    if ( !item1.checked ){
                        check1 = false;
                    }

                }
            });

            return check1;
        }

        var inputs = document.getElementById('formRegister-V').querySelectorAll("[required]");

        inputs.forEach((item, index) => {
            item.setAttribute('autocomplete', 'off')
            item.addEventListener('change', (e) => {
                const check = checkEmpty(inputs);

                // check phải ít nhất 1 trong 3 loại kho !
                const condition2 = checkThreeCondition();
                if (check && divCity.value && divDistrict.value && divWard.value && inputs[10].checked && condition2 >0) {
                    btnSubmit.removeAttribute('disabled');
                    btnSubmit.classList.remove('btn-secondary');
                } else {
                    btnSubmit.setAttribute('disabled', 'true');
                    btnSubmit.classList.add('btn-secondary');
                }
            })
        });

        // phải check ít nhất 1 trong 3 loại kho !
        function checkThreeCondition() {
            let countCheck = 0;

            const checkTypeStorage1 = $('#normal_storage').is(':checked') && $('#acreage_normal_storage').val() != '' && $('#image_normal_storage').val() != '' ;
            const checkTypeStorage2 = $('#cold_storage').is(':checked') && $('#acreage_cold_storage').val() != '' && $('#image_cold_storage').val() != '';
            const checkTypeStorage3 = $('#warehouse').is(':checked') && $('#acreage_warehouse').val() != '' && $('#image_warehouse').val() != '';

            if(checkTypeStorage1)
                countCheck++;
            if(checkTypeStorage2)
                countCheck++;
            if(checkTypeStorage3)
                countCheck++;
            return countCheck;
        }

        // check thêm 3 cái loại kho
        // tao 1 hàm để 3 loại kho đều dùng đc ~~, mục đích check nếu ko bấm thì thôi, bấm thì phải điền nút

        function checkThreeTypeStorage(idCheckBox, acreageStorage) {
            $(idCheckBox).click(function() {
                const condition2 = checkThreeCondition();
                const check = checkEmpty(inputs);

                if( $(idCheckBox).is(':checked')){
                    if( $(acreageStorage).val() == ''){
                        btnSubmit.setAttribute('disabled', 'true');
                        btnSubmit.classList.add('btn-secondary');
                    }else if(check){
                        btnSubmit.removeAttribute('disabled');
                        btnSubmit.classList.remove('btn-secondary');
                    }
                }else{
                    if( condition2 > 0 && check ){
                        btnSubmit.removeAttribute('disabled');
                        btnSubmit.classList.remove('btn-secondary');
                    }else{
                        btnSubmit.setAttribute('disabled', 'true');
                        btnSubmit.classList.add('btn-secondary');
                    }
                }
            });
        };
        checkThreeTypeStorage('#normal_storage','#acreage_normal_storage');
        checkThreeTypeStorage('#cold_storage','#acreage_cold_storage');
        checkThreeTypeStorage('#warehouse','#acreage_warehouse');

        // check input file # null

        function checkThreeInputStorage(idCheckBox, inputFile, ) {
            $(inputFile).change(function() {
                const condition2 = checkThreeCondition();
                const check = checkEmpty(inputs);
                if( $(inputFile).val() != ''){
                    if( $(idCheckBox).is(':checked')){
                        if( $(inputFile).val() == ''){
                            btnSubmit.setAttribute('disabled', 'true');
                            btnSubmit.classList.add('btn-secondary');
                        }else if(check){
                            btnSubmit.removeAttribute('disabled');
                            btnSubmit.classList.remove('btn-secondary');
                        }
                    }else{
                        if( condition2 > 0 && check ){
                            btnSubmit.removeAttribute('disabled');
                            btnSubmit.classList.remove('btn-secondary');
                        }else{
                            btnSubmit.setAttribute('disabled', 'true');
                            btnSubmit.classList.add('btn-secondary');
                        }
                    }
                }else{
                    btnSubmit.setAttribute('disabled', 'true');
                    btnSubmit.classList.add('btn-secondary');
                }
            });
        };
        checkThreeInputStorage('#normal_storage','#image_normal_storage');
        checkThreeInputStorage('#cold_storage', '#image_cold_storage');
        checkThreeInputStorage('#warehouse', '#image_warehouse');

        checkThreeInputStorage('#normal_storage','#acreage_normal_storage');
        checkThreeInputStorage('#cold_storage', '#acreage_cold_storage');
        checkThreeInputStorage('#warehouse', '#acreage_warehouse');



        //lưu chiều dài, rộng, cao vào session storage vì nó ko đc lưu ở ĐB mà lại cần show lại ~~
        setSessionStorageThreeType();

        function setSessionStorageThreeType() {
            let length = document.getElementById("length");
            if (length) {
                length.addEventListener("change", function (evt) {
                    sessionStorage.setItem("length_storage", length.value);
                });
            }
            let width = document.getElementById("width");
            if (width) {
                width.addEventListener("change", function (evt) {
                    sessionStorage.setItem("width_storage", width.value);
                });
            }
            let height = document.getElementById("height");
            if (height) {
                height.addEventListener("change", function (evt) {
                    sessionStorage.setItem("height_storage", height.value);
                });
            }
        }

    </script>
    @if(old('city_id') != '')
        <script>
            fetch('{{route('get_city')}}?type=2&value={{old('city_id')}}', {
                mode: 'no-cors',

            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>` + data.map(item => `<option data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}" ${item.DISTRICT_ID == '{{old('district_id')}}' ? 'selected' : ''}>${item.DISTRICT_NAME}</option>`);

                    } else {
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`;
                    }
                })
                .catch(() => divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`
                );
        </script>
    @endif
@if($isOrder)
        <script>
            const formRegister = document.querySelector('#formRegister-V');
            const payment = document.querySelector('#payment');
            const closeModalPayment = document.querySelectorAll('.closeModalPayment');

            for (i = 0; i < closeModalPayment.length; i++) {
                closeModalPayment[i].addEventListener('click', function () {
                    payment.classList.add("hidden");
                    formRegister.classList.remove("fixed");
                });
            }


            getInfoVstorage();

            function getInfoVstorage() {
                const infoNCC = @json($user) ;
                setValueById("email", infoNCC.email);
                setValueById("name", infoNCC.name);
                setValueById("company_name", infoNCC.company_name);
                setValueById("tax_code", infoNCC.tax_code);
                setValueById("city_id", infoNCC.provinceId);
                setValueById("district_id", infoNCC.district_id);
                setValueById("ward_id", infoNCC.ward_id);
                setValueById("address", infoNCC.address);
                setValueById("phone_number", infoNCC.phone_number);
                setValueById("id_vdone", infoNCC.id_vdone);
                setValueById("id_vdone_diff", infoNCC.id_vdone_diff);
                setValueById("referral_code", infoNCC.referral_code);

                loadAddress(infoNCC.provinceId, infoNCC.district_id, infoNCC.ward_id);

                // info storage
                let storage_information = infoNCC.storage_information;
                if (storage_information) {
                    storage_information = JSON.parse(storage_information);
                    setValueById("floor_area", storage_information.floor_area);
                    setValueById("volume", storage_information.volume);
                    setValueById("cold_storage", storage_information.cold_storage);
                    setValueById("warehouse", storage_information.warehouse);
                    setValueById("normal_storage", storage_information.normal_storage);
                }

            }

            function loadAddress(provinceId, district_id, ward_id) {
                fetch('{{route('get_city')}}', {
                    mode: 'no-cors',
                })
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById('city_id').innerHTML = `<option value="0" disabled selected>Lựa chọn tỉnh (thành phố)</option>` + data.map(item => `<option ${item.PROVINCE_ID == provinceId ? 'selected' : ''}  data-name="${item.PROVINCE_NAME}" value="${item.PROVINCE_ID}">${item.PROVINCE_NAME.toUpperCase()}</option>`);
                    })
                    .catch(console.error);
                fetch('{{route('get_city')}}?type=2&value=' + provinceId, {
                    mode: 'no-cors',
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.length > 0) {
                            divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>` + data.map(item => `<option ${item.DISTRICT_ID == district_id ? 'selected' : ''} data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}">${item.DISTRICT_NAME}</option>`);

                        } else {
                            divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`;
                        }
                    })
                    .catch(() => divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`
                    );
                fetch('{{route('get_city')}}?type=3&value=' + district_id, {
                    mode: 'no-cors',
                }).then((response) => response.json())
                    .then((data) => {
                        if (data.length > 0) {
                            divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>` + data.map(item => `<option ${item.WARDS_ID == ward_id ? 'selected' : ''} data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`);
                        } else {
                            divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`;
                        }
                    })
                    .catch(() => divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`
                    );
            }

            getDataStorageThreeType();

            function getDataStorageThreeType() {
                let length = sessionStorage.getItem("length_storage");
                let width = sessionStorage.getItem("width_storage");
                let height = sessionStorage.getItem("height_storage");

                setValueById("length", length);
                setValueById("width", width);
                setValueById("height", height);
            }

    </script>
@endif

</body>
@if($isOrder)
    <script type="text/javascript">
        $(window).on('load', function() {
            $('.modal-tt').modal('show');
        });
    </script>
@endif
</html>
