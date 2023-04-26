@php
    
    if ($order && $user) {
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
    <title>Đăng ký NCC</title>
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/dist/output.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <meta property="og:title" content="NCC" />
    <meta property="og:title" content="NCC | Ecommerce. Cổng thương mại điện tử dành cho nhà cung cấp và sản xuất" />
    <meta property="og:description"
        content="Hãy đồng hành cùng 20.000+ người kinh doanh và nhà phân phối uy tín tại việt nam." />
    <meta property="og:description" content="" />
    <meta property="og:url" content="{{ asset('') }}" />
    <meta property="og:image" content="{{ asset('home/img/ncc11.png') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/images/Frame 1321315296.ico') }}">
    <meta property="og:image:width" content="120">
    <meta property="og:image:height" content="100">
    @vite('resources/css/app.css')
    {{--    css thêm sau --}}

    <link rel="stylesheet" href="{{ asset('asset/bootstrap.min.css') }}">

    {{--    END css thêm sau --}}

    <link rel="stylesheet" href="{{ asset('asset/css/register/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/register/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/register/fontawesome-all.css') }}">

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
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <div class="modal modal-success flex justify-center items-center show-modal">
            <div class="over-lay-modal" onclick="$('.modal-success').toggleClass('show-modal')"></div>
            <div
                class="information success flex flex-col justify-end w-full max-w-[300px] md:max-w-[650px] h-[400px] shadow-xl p-6 my-6 mx-auto rounded-sm">
                <svg width="24" height="24" viewBox="0 0 24 24"
                    onclick="$('.modal-success').toggleClass('show-modal')"
                    class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                        fill="white" />
                </svg>
                <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
                    <h2 class="text-title text-2xl font-medium">Bạn đã gửi thông tin đăng ký thành công</h2>
                    <span class="text-[#000]">Thông tin đăng ký của bạn đang chờ duyệt. Vui lòng chờ kết quả trong vòng
                        (24 giờ)</span>
                </div>
            </div>
        </div>
    @endif
   
    <form class="splash-container splash-register" action="{{ route('post_register', ['role_id' => 2]) }}"
        id="formRegister-V" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h1 class="mb-1">Đăng ký</h1>
                    @if (isset($_GET['orderErr']))
                        <span class="text-danger text-red-500">{{ $_GET['orderErr'] }}</span>
                    @endif
                    <p>Vui lòng nhập thông tin để đăng ký tài khoản.</p>
                </div>

                <img src="{{ asset('asset/images/NCC.png') }}" style="object-fit: contain; height: 40px;"
                    alt="Logo">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="email" style="font-weight: 600;"><span
                                    class="text-danger">*</span>Email</label>
                            <input required type="email" name="email" id="email" placeholder="Nhập email"
                                value="{{ old('email') }}" class="form-control form-control-lg">
                            @error('email')
                                <p class="text-danger text-red-500 text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="email" style="font-weight: 600;"><span
                                    class="text-danger">*</span>Số điện thoại công
                                ty </label>
                            <input required type="text" name="phone_number" id="phone_number"
                                placeholder="Nhập số điện thoại công ty" value="{{ old('phone_number') }}"
                                pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b" class="form-control form-control-lg">
                            @error('phone_number')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="name" style="font-weight: 600;"><span
                                    class="text-danger">*</span>Tên nhà cung
                                cấp</label>
                            <input class="form-control form-control-lg" required type="text" name="name"
                                id="name" placeholder="Nhập tên nhà cung cấp" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="id_phone"><span class="text-danger">*</span>ID
                                P-Done người đại diện </label>
                            <input class="form-control form-control-lg" required type="text" name="id_vdone"
                                id="id_vdone" placeholder="Nhập ID P-Done người đại diện"
                                value="{{ old('id_phone') }}">
                            @error('id_vdone')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="idpDone" style="font-weight: 600;"><span
                                    class="text-danger">*</span>Tên công ty</label>
                            <input class="form-control form-control-lg" required type="text" name="company_name"
                                id="company_name" placeholder="Nhập tên công ty" value="{{ old('company_name') }}">
                            @error('company_name')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="company"><span class="text-danger">

                            </span>
                            &ensp;ID P-Done người đại diện (khác)</label>
                            <input class="form-control form-control-lg" type="text" name="id_vdone_diff"
                                id="id_vdone_diff" placeholder="Nhập ID P-Done người đại diện (khác)"
                                value="{{ old('id_vdone_diff') }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="idpDonemore"><span class="text-danger">*</span>Mã số thuế</label>
                            <input class="form-control form-control-lg"required type="text" name="tax_code"
                                id="tax_code" placeholder="Nhập mã số thuế" pattern="^[0-9]{10,13}$"
                                title="Mã số thuế phải có độ dài từ 10 hoặc 13 chữ số" value="{{ old('tax_code') }}">
                            @error('tax_code')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                            @if (\Illuminate\Support\Facades\Session::has('tax_code'))
                                <p class="text-danger text-red-500 text-red-500">Mã số thuế đã đăng ký hoặc lỗi</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="codeInvite"><span class="text-danger"></span> &ensp;Mã P-Done người
                                giới thiệu</label>
                            <input class="form-control form-control-lg" type="text" name="referral_code"
                                placeholder="V-Shop giới thiệu" readonly value="{{ $referral_code }}">
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
    
                   
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="address"><span class="text-danger">*</span>Địa chỉ
                                chi tiết</label>
                            <input class="form-control form-control-lg" type="text" name="address" required=""
                                placeholder="Nhập địa chỉ chi tiết (VD: Số nhà 89, phố Tô Vĩnh Diễn, phường Khương Trung, quận Thanh Xuân, thành phố Hà Nội)" value="{{ old('address') }}"> @error('address')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group" style="max-width: 450px; margin: 0 auto;">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" required type="checkbox"><span class="custom-control-label">Tôi đồng
                            ý với <span style="text-decoration: underline;cursor: pointer;"  class="underline text-blue-700" data-toggle="modal" data-target=".modal-terms">Điều khoản sử dụng dịch vụ.</span></span>
                    </label>
                    <div class="form-group pt-2">
                        <button type="submit" class="active btn btn-block btn-primary" >Mua ngay</button>
                    </div>
                </div>



            </div>
            <div class="card-footer bg-white">
                <p>Bạn đã có tài khoản? <a href="{{ route('login_ncc') }}" class="text-secondary">Đăng nhập
                        ngay</a></p>
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
    @if ($isOrder)
        <div class="modal fade modal-tt" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="false">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('post_register_order_ncc', ['order_id' => $order->id]) }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="d-flex flex-column" style="gap:6px">
                                <img src="{{ asset('home/img/NCC.png') }}" alt=""
                                    style="object-fit: contain; height: 40px;">
                                <h5 class="modal-title" style="font-size: 20px;">Thông tin thanh toán</h5>
                            </div>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="content m-4">
                            <div class="w-100 h-100" style="background-color: #F2F8FF; border-radius: 10px;">
                                <div class="col-12">
                                    <h3
                                        style="font-weight: 600; padding-top: 15px; font-size:22px; margin-bottom:15px;">
                                        Thông tin bên mua</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 style="font-size:18px;font-weight: 600; margin-bottom:15px;">Tên công
                                                ty</h4>
                                        </div>
                                        <div class="col-6">
                                            <span
                                                style="font-weight: 600; font-size: 16px;">{{ $user->company_name }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 style="font-size:18px;font-weight: 600; margin-bottom:15px;">Mã số thuế
                                            </h4>
                                        </div>
                                        <div class="col-6">
                                            <span style="font-size: 16px;">{{ $user->tax_code }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 style="font-size:18px;font-weight: 600; margin-bottom:15px;">Tên Nhà
                                                cung cấp</h4>
                                        </div>
                                        <div class="col-6">
                                            <span style="font-size: 16px;">{{ $user->name }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 style="font-size:18px;font-weight: 600; margin-bottom:15px;">ID P-Done
                                                người đại diện</h4>
                                        </div>
                                        <div class="col-6">
                                            <span style="font-size: 16px;">{{ $user->id_vdone }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 style="font-size:18px;font-weight: 600; margin-bottom:15px;">Số điện
                                                thoại công ty</h4>
                                        </div>
                                        <div class="col-6">
                                            <span style="font-size: 16px;">{{ $user->phone_number }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 style="font-size:18px;font-weight: 600; margin-bottom:15px;">Email</h4>
                                        </div>
                                        <div class="col-6">
                                            <span style="font-size: 16px;">{{ $user->email }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 style="font-size:18px;font-weight: 600; margin-bottom:15px;">Mã P-Done người
                                                giới thiệu</h4>
                                        </div>
                                        <div class="col-6">
                                            <span style="font-size: 16px;">{{ $user->referral_code }}</span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-xl-6 col-lg-6 col-md-12 my-3">
                                    <div class="w-100 h-100" style="background-color: #F2F8FF; border-radius: 10px;">
                                        <div class="col-12">
                                            <h3
                                                style="font-weight: 600; padding-top: 15px; margin-bottom:15px; font-size:22px">
                                                Chi tiết sản phẩm</h3>
                                        </div>
                                        @php
                                            
                                            $price = (float) config('constants.orderService.price_ncc');
                                            $priceFormat = number_format($price, 0, '', '.');
                                            $vat = ((float) config('constants.orderService.price_ncc') * 10) / 100;
                                            $vatFormat = number_format($vat, 0, '', '.');
                                            
                                            $total = $price + $vat;
                                            $totalFormat = number_format($total, 0, '', '.');
                                            
                                            $chiTietThanhToan = [
                                                [
                                                    'title' => 'Ngày tạo',
                                                    'value' => $order->created_at,
                                                    'class' => '',
                                                ],
                                                [
                                                    'title' => 'Tài khoản',
                                                    'value' => 'Nhà cung cấp',
                                                    'class' => '',
                                                ],
                                                [
                                                    'title' => 'Thời hạn',
                                                    'value' => '1 năm',
                                                    'class' => '',
                                                ],
                                                [
                                                    'title' => 'Giá sản phẩm',
                                                    'value' => $priceFormat . 'đ',
                                                    'class' => '',
                                                ],
                                                [
                                                    'title' => 'VAT',
                                                    'value' => $vatFormat . 'đ',
                                                    'class' => '',
                                                ],
                                                [
                                                    'title' => 'Tổng số tiền',
                                                    'value' => $totalFormat . 'đ',
                                                    'class' => 'text-danger',
                                                ],
                                            ];
                                        @endphp
                                        <div class="col-12">
                                            @foreach ($chiTietThanhToan as $value)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4
                                                            style="font-size:18px; margin-bottom:15px; font-weight:500">
                                                            {{ $value['title'] }}</h4>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <span class="{{ $value['class'] }}"
                                                            style="font-size: 16px;">{{ $value['value'] }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 my-3">
                                    <div class="w-100 " style="background-color: #F2F8FF; border-radius: 10px;">
                                        <div class="col-12">
                                            <h3
                                                style="font-weight: 600; padding-top: 15px; margin-bottom:15px; font-size:22px;">
                                                Phương thức thanh toán</h3>
                                        </div>
                                        <div class="col-12" style="padding-bottom: 15px;">
                                            <div class="d-flex justify-content-between align-items-center w-100"
                                                style="background-color: white; border-radius: 10px; padding: 13px 20px;">
                                                <div class="d-flex align-items-center" style="gap: 10px;">
                                                    <div style="width: 26px; height: 26px;">
                                                        <img src="{{ asset('asset/icons/payment/icon_9pay.png') }}"
                                                            alt="">
                                                    </div>
                                                    <span style='font-size:14px'>Thanh toán ngay qua 9Pay</span>
                                                </div>
                                                <label class="custom-control custom-radio custom-control-inline"
                                                    style="margin: 0;">
                                                    <input type="radio" value="9PAY" name="method_payment"
                                                        checked class="custom-control-input"><span
                                                        class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center w-100 my-2"
                                                style="background-color: white; border-radius: 10px; padding: 13px 20px;">
                                                <div class="d-flex align-items-center" style="gap: 10px;">
                                                    <div style="width: 26px; height: 26px;">
                                                        <img src="{{ asset('asset/icons/payment/icon_cart.png') }}"
                                                            alt="">
                                                    </div>
                                                    <span style='font-size:14px'>Thẻ nội địa</span>
                                                </div>
                                                <label class="custom-control custom-radio custom-control-inline"
                                                    style="margin: 0;">
                                                    <input type="radio" value="ATM_CARD" name="method_payment"
                                                        class="custom-control-input"><span
                                                        class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center w-100"
                                                style="background-color: white; border-radius: 10px; padding: 13px 20px;">
                                                <div class="d-flex align-items-center" style="gap: 10px;">
                                                    <div style="width: 26px; height: 26px;">
                                                        <img src="{{ asset('asset/icons/payment/icon_cart_2.png') }}"
                                                            alt="">
                                                    </div>
                                                    <span style='font-size:14px'>Thẻ quốc tế</span>
                                                </div>
                                                <label class="custom-control custom-radio custom-control-inline"
                                                    style="margin: 0;">
                                                    <input type="radio" value="CREDIT_CARD" name="method_payment"
                                                        class="custom-control-input"><span
                                                        class="custom-control-label"></span>
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center w-100 mt-2 "
                                                style="background-color: white; border-radius: 10px; padding: 13px 20px;">
                                                <div class="d-flex align-items-center" style="gap: 10px;">
                                                    <div style="width: 26px; height: 26px;">
                                                        <img src="{{ asset('asset/icons/payment/icon_bank.png') }}"
                                                            alt="">
                                                    </div>
                                                    <span style='font-size:14px'>Chuyển khoản ngân hàng</span>
                                                </div>
                                                <label class="custom-control custom-radio custom-control-inline"
                                                    style="margin: 0;">
                                                    <input type="radio" value="BANK_TRANSFER" name="method_payment"
                                                        class="custom-control-input"><span
                                                        class="custom-control-label"></span>
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
                                <button type="submit" class="btn btn-primary">Thanh toán
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    {{-- @if ($isOrder) --}}
    {{--    <div id="payment" class="fixed w-screen h-screen bg-white top-0" style="background: rgba(0, 0, 0, 0.5);"> --}}
    {{--        <form method="POST" action="{{route('post_register_order_ncc',['order_id' => $order->id])}}"> --}}
    {{--            @csrf --}}
    {{--            <div --}}
    {{--                class="absolute p-4 lg:p-16 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-[50%] md:-translate-y-[55%] bg-white rounded-2xl w-11/12 lg:w-10/12 h-[95%] md:h-[80%] overflow-auto"> --}}
    {{--                <div class="relative"> --}}
    {{--                    <img src="{{asset('home/img/NCC.png')}}" alt="Logo Nhà Cung Cấp"> --}}
    {{--                    <h2 class="font-medium text-2xl mt-4">Thông tin thanh toán</h2> --}}

    {{--                    <button type="button" class="closeModalPayment absolute top-0 right-0"> --}}
    {{--                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"> --}}
    {{--                            <path --}}
    {{--                                d="M23.0726 0.553704C22.9071 0.383748 22.7104 0.248911 22.4939 0.156911C22.2774 0.064912 22.0453 0.0175566 21.8109 0.0175566C21.5765 0.0175566 21.3444 0.064912 21.1279 0.156911C20.9114 0.248911 20.7147 0.383748 20.5492 0.553704L11.7976 9.50037L3.04608 0.535371C2.88038 0.365637 2.68368 0.230997 2.46719 0.139138C2.2507 0.0472788 2.01867 1.78843e-09 1.78435 0C1.55003 -1.78843e-09 1.318 0.0472788 1.10151 0.139138C0.885021 0.230997 0.688316 0.365637 0.522624 0.535371C0.356931 0.705104 0.225497 0.906607 0.135825 1.12837C0.0461531 1.35014 -1.74585e-09 1.58783 0 1.82787C1.74585e-09 2.06791 0.0461531 2.3056 0.135825 2.52737C0.225497 2.74913 0.356931 2.95064 0.522624 3.12037L9.27417 12.0854L0.522624 21.0504C0.356931 21.2201 0.225497 21.4216 0.135825 21.6434C0.0461531 21.8651 0 22.1028 0 22.3429C0 22.5829 0.0461531 22.8206 0.135825 23.0424C0.225497 23.2641 0.356931 23.4656 0.522624 23.6354C0.688316 23.8051 0.885021 23.9397 1.10151 24.0316C1.318 24.1235 1.55003 24.1707 1.78435 24.1707C2.01867 24.1707 2.2507 24.1235 2.46719 24.0316C2.68368 23.9397 2.88038 23.8051 3.04608 23.6354L11.7976 14.6704L20.5492 23.6354C20.7149 23.8051 20.9116 23.9397 21.1281 24.0316C21.3445 24.1235 21.5766 24.1707 21.8109 24.1707C22.0452 24.1707 22.2773 24.1235 22.4937 24.0316C22.7102 23.9397 22.9069 23.8051 23.0726 23.6354C23.2383 23.4656 23.3698 23.2641 23.4594 23.0424C23.5491 22.8206 23.5952 22.5829 23.5952 22.3429C23.5952 22.1028 23.5491 21.8651 23.4594 21.6434C23.3698 21.4216 23.2383 21.2201 23.0726 21.0504L14.3211 12.0854L23.0726 3.12037C23.7527 2.4237 23.7527 1.25037 23.0726 0.553704Z" --}}
    {{--                                fill="black"/> --}}
    {{--                        </svg> --}}
    {{--                    </button> --}}
    {{--                </div> --}}
    {{--                <div class="bg-[#F2F8FF] w-full p-[24px] pt-2 lg:pt-8 mt-2 lg:mt-8 rounded-xl"> --}}
    {{--                    <h3 class="font-extrabold text-xl">Thông tin bên mua</h3> --}}
    {{--                    <div class="flex flex-col justify-between lg:flex-row gap-4 mt-6"> --}}
    {{--                        <div class="table w-full"> --}}
    {{--                            <div class="table-row"> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell">Tên công ty</p> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->company_name}}</p> --}}
    {{--                            </div> --}}
    {{--                            <div class="table-row"> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell">Email</p> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->email}}</p> --}}
    {{--                            </div> --}}
    {{--                            <div class="table-row"> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell">Số điện thoại</p> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->phone_number}}</p> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                        <div class="table w-full"> --}}
    {{--                            <div class="table-row"> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell">Tên nhà cung cấp</p> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->name}}</p> --}}
    {{--                            </div> --}}
    {{--                            <div class="table-row"> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell">Mã số thuế</p> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->tax_code}}</p> --}}
    {{--                            </div> --}}
    {{--                            <div class="table-row"> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell">Người đại diện</p> --}}
    {{--                                <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->id_vdone}}</p> --}}
    {{--                            </div> --}}
    {{--                            @if ($user->referral_code) --}}
    {{--                                <div class="table-row"> --}}
    {{--                                    <p class="font-medium text-xl leading-8 table-cell">Mã người giới thiệu</p> --}}
    {{--                                    <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->referral_code}}</p> --}}
    {{--                                </div> --}}
    {{--                            @endif --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="flex flex-col md:flex-row gap-[30px] pt-8"> --}}
    {{--                    <div class="bg-[#F2F8FF] w-full p-[24px] rounded-xl"> --}}
    {{--                        <h3 class="font-extrabold text-xl">Chi tiết sản phẩm</h3> --}}
    {{--                        @php --}}

    {{--                            $price = (float) config('constants.orderService.price_ncc'); --}}
    {{--                            $priceFormat = number_format($price, 0, '', '.'); --}}
    {{--                            $vat = (float) config('constants.orderService.price_ncc')*10/100; --}}
    {{--                            $vatFormat = number_format($vat, 0, '', '.'); --}}

    {{--                            $total = $price + $vat; --}}
    {{--                            $totalFormat = number_format($total, 0, '', '.'); --}}


    {{--                            $chiTietThanhToan = array( --}}
    {{--                                [ --}}
    {{--                                    "title" => "Ngày tạo", --}}
    {{--                                    "value" => $order->created_at, --}}
    {{--                                    "class"=> "" --}}
    {{--                                ], --}}
    {{--                                [ --}}
    {{--                                    "title" => "Tài khoản", --}}
    {{--                                    "value" => "Nhà cung cấp", --}}
    {{--                                    "class"=> "" --}}
    {{--                                ], --}}
    {{--                                [ --}}
    {{--                                    "title" => "Thời hạn", --}}
    {{--                                    "value" => "1 năm", --}}
    {{--                                    "class"=> "" --}}
    {{--                                ], --}}
    {{--                                [ --}}
    {{--                                    "title" => "Giá sản phẩm", --}}
    {{--                                    "value" => $priceFormat . "đ", --}}
    {{--                                    "class"=> "" --}}
    {{--                                ], --}}
    {{--                                [ --}}
    {{--                                    "title" => "VAT", --}}
    {{--                                    "value" => $vatFormat . "đ", --}}
    {{--                                    "class"=> "" --}}
    {{--                                ], --}}
    {{--                                [ --}}
    {{--                                    "title" => "Tổng số tiền", --}}
    {{--                                    "value" => $totalFormat . "đ", --}}
    {{--                                    "class"=> "text-red-500" --}}
    {{--                                ]); --}}
    {{--                        @endphp --}}
    {{--                        <div class="mt-6 table w-full"> --}}
    {{--                            @foreach ($chiTietThanhToan as $value) --}}
    {{--                                <div class="table-row"> --}}
    {{--                                    <p class="font-medium text-xl leading-8 table-cell">{{$value['title']}}</p> --}}
    {{--                                    <p class=" {{$value['class']}} font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$value['value']}}</p> --}}
    {{--                                </div> --}}
    {{--                            @endforeach --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                    <div class="bg-[#F2F8FF] w-full p-[24px] rounded-xl"> --}}
    {{--                        <h3 class="font-extrabold text-xl">Phương thức thanh toán</h3> --}}
    {{--                        <div class="mt-8"> --}}
    {{--                            <div class="bg-white items-center py-[10px] flex justify-between px-8 rounded-2xl mt-4"> --}}
    {{--                                <div class="flex gap-2"> --}}
    {{--                                    <img src="{{asset('asset/icons/payment/icon_9pay.png')}}" alt=""> --}}
    {{--                                    <label class="cursor-pointer" for="paymentInput1">Thanh toán ngay qua 9Pay</label> --}}
    {{--                                </div> --}}
    {{--                                <input value="9PAY" class="cursor-pointer" checked id="paymentInput1" --}}
    {{--                                       name="method_payment" type="radio"> --}}
    {{--                            </div> --}}

    {{--                            <div class="bg-white items-center py-[10px] flex justify-between px-8 rounded-2xl mt-4"> --}}
    {{--                                <div class="flex gap-2"> --}}
    {{--                                    <img src="{{asset('asset/icons/payment/icon_cart.png')}}" alt=""> --}}
    {{--                                    <label class="cursor-pointer" for="paymentInput2">Thẻ nội địa</label> --}}
    {{--                                </div> --}}
    {{--                                <input value="ATM_CARD" class="cursor-pointer" id="paymentInput2" name="method_payment" --}}
    {{--                                       type="radio"> --}}
    {{--                            </div> --}}
    {{--                            <div class="bg-white items-center py-[10px] flex justify-between px-8 rounded-2xl mt-4"> --}}
    {{--                                <div class="flex gap-2"> --}}
    {{--                                    <img src="{{asset('asset/icons/payment/icon_cart_2.png')}}" alt=""> --}}
    {{--                                    <label class="cursor-pointer" for="paymentInput3">Thẻ quốc tế</label> --}}
    {{--                                </div> --}}
    {{--                                <input value="CREDIT_CARD" class="cursor-pointer" id="paymentInput3" --}}
    {{--                                       name="method_payment" type="radio"> --}}
    {{--                            </div> --}}

    {{--                            <div class="bg-white items-center py-[10px] flex justify-between px-8 rounded-2xl mt-4"> --}}
    {{--                                <div class="flex gap-2"> --}}
    {{--                                    <img src="{{asset('asset/icons/payment/icon_bank.png')}}" alt=""> --}}
    {{--                                    <label class="cursor-pointer" for="paymentInput4">Chuyển khoản ngân hàng</label> --}}
    {{--                                </div> --}}
    {{--                                <input value="BANK_TRANSFER" class="cursor-pointer" id="paymentInput4" --}}
    {{--                                       name="method_payment" type="radio"> --}}
    {{--                            </div> --}}
    {{--                        </div> --}}
    {{--                    </div> --}}
    {{--                </div> --}}
    {{--                <div class="flex flex-wrap justify-center gap-4 md:gap-8 mt-8"> --}}
    {{--                    <button type="button" --}}
    {{--                            class="order-last md:order-first text-[#258AFF] border border-[#258AFF] rounded-2xl py-[10px] w-[300px] closeModalPayment"> --}}
    {{--                        Đóng --}}
    {{--                    </button> --}}
    {{--                    <button type="submit" --}}
    {{--                            class="order-first md:order-last text-white border border-[#258AFF] rounded-2xl py-[10px] w-[300px] bg-[#258AFF]"> --}}
    {{--                        Thanh Toán --}}
    {{--                    </button> --}}
    {{--                </div> --}}
    {{--            </div> --}}
    {{--        </form> --}}
    {{--    </div> --}}
    {{-- @endif --}}
    <script src="{{ asset('asset/js/main.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.bundle.js') }}"></script>

    @if (old('city_id') != '')
        <script>
            fetch('{{ route('get_city') }}?type=2&value={{ old('city_id') }}', {
                    mode: 'no-cors',

                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>` + data
                            .map(item =>
                                `<option data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}" ${item.DISTRICT_ID == '{{ old('district_id') }}' ? 'selected' : ''}>${item.DISTRICT_NAME}</option>`
                                );

                    } else {
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`;
                    }
                })
                .catch(() => divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`);
        </script>
    @endif
    @if ($isOrder)
        <script type="text/javascript">
            $(window).on('load', function() {
                $('.modal-tt').modal('show');
            });
        </script>
    @endif

    <script !src="">
        const x = document.querySelectorAll('input[type="number"]');
        x.forEach(item => {
            item.addEventListener("keypress", function(evt) {
                if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57) {
                    evt.preventDefault();
                }
            });
        })
        document.querySelector('.active').setAttribute('disabled', 'true');
        document.querySelector('.active').classList.add('bg-slate-300');
        const divCity = document.getElementById('city_id');
        const divDistrict = document.getElementById('district_id');
        const divWard = document.getElementById('ward_id');
        fetch('{{ route('get_city') }}', {
                mode: 'no-cors',

            })
            .then((response) => response.json())
            .then((data) => {
                document.getElementById('city_id').innerHTML =
                    `<option value="0" disabled selected>Lựa chọn tỉnh (thành phố)</option>` + data.map(item =>
                        `<option data-name="${item.PROVINCE_NAME}" value="${item.PROVINCE_ID}" ${item.PROVINCE_ID == '{{ old('city_id') }}' ? 'selected' : ''}>${item.PROVINCE_NAME}</option>`
                        );
            })
            .catch(console.error);

        divCity.addEventListener('change', (e) => {
            fetch('{{ route('get_city') }}?type=2&value=' + e.target.value, {
                    mode: 'no-cors',

                })
                .then((response) => response.json())

                .then((data) => {
                    if (data.length > 0) {
                        const check = checkEmpty(inputs);
                        if (check && divCity.value && divDistrict.value && divWard.value) {
                            document.querySelector('.active').removeAttribute('disabled');
                            document.querySelector('.active').classList.remove('bg-slate-300');
                        } else {
                            document.querySelector('.active').setAttribute('disabled', 'true');
                            document.querySelector('.active').classList.add('bg-slate-300');
                        }
                        divDistrict.innerHTML =
                            `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>` + data.map(
                                item =>
                                `<option data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}" >${item.DISTRICT_NAME}</option>`
                                );

                    } else {
                        divDistrict.innerHTML =
                            `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`;
                    }
                })
                .catch(() => divDistrict.innerHTML =
                    `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`
                )
        });
        divDistrict.addEventListener('change', (e) => {
            fetch('{{ route('get_city') }}?type=3&value=' + e.target.value, {
                    mode: 'no-cors',

                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.length > 0) {
                        const check = checkEmpty(inputs);
                        if (check && divCity.value && divDistrict.value && divWard.value) {
                            document.querySelector('.active').removeAttribute('disabled');
                            document.querySelector('.active').classList.remove('bg-slate-300');
                        } else {
                            document.querySelector('.active').setAttribute('disabled', 'true');
                            document.querySelector('.active').classList.add('bg-slate-300');
                        }
                        divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>` + data.map(item =>
                            `<option data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`
                            );

                    } else {
                        divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>`;
                    }
                })
                .catch(() => divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>`)
        });

        function checkEmpty(inputs) {
            let check1 = true
            inputs.forEach((item1, index1) => {
                if (!item1.value && index1 > 0 && index1 != 8 && index1 != 9) {
                    check1 = false;
                }
            });

            return check1;
        }

        const inputs = document.querySelectorAll('input');
        console.log(inputs);
       
        inputs.forEach((item, index) => {
            item.setAttribute('autocomplete', 'off')
            item.addEventListener('change', (e) => {
                const check = checkEmpty(inputs);
                if (check && divCity.value && divDistrict.value && divWard.value && inputs[10].checked) {
                    document.querySelector('.active').removeAttribute('disabled');
                    document.querySelector('.active').classList.remove('bg-slate-300');
                } else {
                    console.log(1);
                    document.querySelector('.active').setAttribute('disabled', 'true');
                    document.querySelector('.active').classList.add('bg-slate-300');
                }
            })
        });
    </script>
    @if ($isOrder)
        <script>
            const formRegister = document.querySelector('#formRegister');
            const payment = document.querySelector('#payment');
            const closeModalPayment = document.querySelectorAll('.closeModalPayment');

            for (i = 0; i < closeModalPayment.length; i++) {
                closeModalPayment[i].addEventListener('click', function() {
                    payment.classList.add("hidden");
                    formRegister.classList.remove("fixed");
                });
            }

            // fill information
            getInfoNCC();

            function getInfoNCC() {
                const infoNCC = @json($user);
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
                setValueById("referral_code", infoNCC.referral_code);

                loadAddress(infoNCC.provinceId, infoNCC.district_id, infoNCC.ward_id);
            }

            function loadAddress(provinceId, district_id, ward_id) {
                fetch('{{ route('get_city') }}', {
                        mode: 'no-cors',
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById('city_id').innerHTML =
                            `<option value="0" disabled selected>Lựa chọn tỉnh (thành phố)</option>` + data.map(item =>
                                `<option ${item.PROVINCE_ID == provinceId ? 'selected' : ''}  data-name="${item.PROVINCE_NAME}" value="${item.PROVINCE_ID}">${item.PROVINCE_NAME.toUpperCase()}</option>`
                                );
                    })
                    .catch(console.error);
                fetch('{{ route('get_city') }}?type=2&value=' + provinceId, {
                        mode: 'no-cors',
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.length > 0) {
                            divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>` +
                                data.map(item =>
                                    `<option ${item.DISTRICT_ID == district_id ? 'selected' : ''} data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}">${item.DISTRICT_NAME}</option>`
                                    );

                        } else {
                            divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`;
                        }
                    })
                    .catch(() => divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`);
                fetch('{{ route('get_city') }}?type=3&value=' + district_id, {
                        mode: 'no-cors',
                    }).then((response) => response.json())
                    .then((data) => {
                        if (data.length > 0) {
                            divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>` + data
                                .map(item =>
                                    `<option ${item.WARDS_ID == ward_id ? 'selected' : ''} data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`
                                    );
                            console.log(1);
                        } else {
                            divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`;
                        }
                    })
                    .catch(() => divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`);
            }
        </script>
    @endif
</body>

</html>
