@php
    $isOrder = \Illuminate\Support\Facades\Session::has('order');
    $order = \Illuminate\Support\Facades\Session::get('order');
    $user = \Illuminate\Support\Facades\Session::get('user');
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
    <meta property="og:image:width" content="120">
    <meta property="og:image:height" content="100">
    @vite('resources/css/app.css')
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

<div class="modal modal-hd">
    <div class="over-lay-modal" onclick="$('.modal-hd').toggleClass('show-modal')"></div>
    <div
        class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-10 md:mt-24">
        <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
            <h2 class="text-base text-title">Hợp đồng điện tử</h2>
            <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                 onclick="$('.modal-hd').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                    fill="black" fill-opacity="0.45"/>
            </svg>
        </div>
        <div class="content pt-3 px-3 border-r-[1px] border-l-[1px] border-grey max-h-[500px] overflow-y-auto">
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
            Chính sách quyền riêng tư của chúng tôi giải thích cách chúng tôi thu thập và sử dụng dữ liệu cá nhân của
            bạn để quyết định hiển thị cho bạn quảng cáo nào, cũng như để cung cấp tất cả các dịch vụ khác được mô tả
            bên dưới. Bạn cũng có thể chuyển đến trang cài đặt trên Sản phẩm có liên quan của VDONE bất cứ lúc nào để
            xem lại các lựa chọn quyền riêng tư mình có đối với cách chúng tôi sử dụng dữ liệu của bạn.

        </div>
    </div>
</div>
<div class="mb-20">
    <form action="{{route('post_register',['role_id' => 4])}}" id="formRegister-V" enctype="multipart/form-data"
          method="POST">
        @csrf
        <div class=" grid grid-cols-1 lg:grid-cols-2">
            <div class="register-1 flex flex-col justify-start items-start gap-6 xl:px-32 p-10 px-4 lg:px-10">
                <div class="w-[162px]">
                    <a href="{{route('screens.storage.index')}}"> <img src="{{asset('home/img/titleK.png')}}" alt=""></a>
                </div>
                <h1 class="text-4xl font-medium max-w-[520px]">Đăng ký</h1>

        </div>
    </div>
    <div class="flex flex-col lg:flex-row justify-between item-start gap-6 xl:gap-28 xl:px-32 p-10 pt-0 px-4 lg:px-10">
        <div class="flex flex-col justify-start items-start gap-6 w-full">
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Email</span>
                <input required type="email" name="email" id="email" placeholder="Nhập email" value="{{old('email')}}"
                       class="mail outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('email')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Tên Kho</span>
                <input required type="text" name="name" id="name" placeholder="Nhập tên Kho" value="{{old('name')}}"
                       class="nameV outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('name')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Tên Công ty</span>
                <input required type="text" name="company_name" id="company_name" placeholder="Nhập tên công ty"
                       value="{{old('company_name')}}"
                       class="comp outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('company_name')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Mã số thuế</span>
                <input required type="text" name="tax_code" id="tax_code" placeholder="Nhập mã số thuế"
                        pattern="^[0-9]{10,13}$" title="Mã số thuế phải có độ dài từ 10 hoặc 13 chữ số"
                       value="{{old('tax_code')}}"
                       class="only-number maV outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('tax_code')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Địa chỉ</span>
                <input required type="text" name="address" id="address" placeholder="Nhập địa chỉ" value="{{old('address')}}"
                       class="addr outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('address')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1  md:grid-cols-3 gap-2">
                <div class="w-full">
                    <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Tỉnh (thành phố)</span>
                    <select required name="city_id" id="city_id"
                            class="addr outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        <option value="" selected disabled>Lựa chọn tỉnh (thành phố)</option>
                    </select>
                    @error('city_id')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <div class="">
                    <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Quận (huyện)</span>
                    <select required name="district_id" id="district_id"
                            class="addr outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        <option value="" selected disabled>Lựa chọn quận (huyện)</option>
                    </select>
                    @error('district_id')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <div class="">
                    <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Phường (xã)</span>
                    <select required name="ward_id" id="ward_id"
                            class="addr outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        <option value="">Lựa chọn Phường (xã)</option>
                    </select>
                    @error('ward_id')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
            </div>


        </div>
        <div class="flex flex-col justify-start items-start gap-6 w-full">
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong>Số điện thoại</span>
                <input required type="text" name="phone_number" placeholder="Nhập số điện thoại" value="{{old('phone_number')}}"
                    pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b"
                       class="sdt outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('phone_number')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-sm font-medium flex justify-start items-center gap-1"><strong
                            class="text-[#FF4D4F]">*</strong> Người đại diện <svg class="cursor-pointer" width="14"
                                                                                  height="14" viewBox="0 0 14 14"
                                                                                  fill="none"
                                                                                  xmlns="http://www.w3.org/2000/svg">
                        <title>Vui lòng nhập ID của người đại diện cho V-Store của bạn</title>
                        <path
                            d="M7 0C3.13437 0 0 3.13437 0 7C0 10.8656 3.13437 14 7 14C10.8656 14 14 10.8656 14 7C14 3.13437 10.8656 0 7 0ZM7 12.8125C3.79063 12.8125 1.1875 10.2094 1.1875 7C1.1875 3.79063 3.79063 1.1875 7 1.1875C10.2094 1.1875 12.8125 3.79063 12.8125 7C12.8125 10.2094 10.2094 12.8125 7 12.8125Z"
                            fill="black" fill-opacity="0.45"/>
                        <path
                            d="M6.24976 4.25C6.24976 4.44891 6.32877 4.63968 6.46943 4.78033C6.61008 4.92098 6.80084 5 6.99976 5C7.19867 5 7.38943 4.92098 7.53009 4.78033C7.67074 4.63968 7.74976 4.44891 7.74976 4.25C7.74976 4.05109 7.67074 3.86032 7.53009 3.71967C7.38943 3.57902 7.19867 3.5 6.99976 3.5C6.80084 3.5 6.61008 3.57902 6.46943 3.71967C6.32877 3.86032 6.24976 4.05109 6.24976 4.25ZM7.37476 6H6.62476C6.55601 6 6.49976 6.05625 6.49976 6.125V10.375C6.49976 10.4438 6.55601 10.5 6.62476 10.5H7.37476C7.44351 10.5 7.49976 10.4438 7.49976 10.375V6.125C7.49976 6.05625 7.44351 6 7.37476 6Z"
                            fill="black" fill-opacity="0.45"/>
                        </svg>
                        </span>
                <input required type="text" name="id_vdone" placeholder="Nhập ID người đại diện" value="{{old('id_vdone')}}"
                       class="nameDD outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('id_vdone')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium">Người đại diện (khác)</span>
                <input type="text" name="id_vdone_diff" placeholder="Nhập ID người đại diện (khác)"
                       value="{{old('id_vdone_diff')}}"
                       class="nameDDM outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm ">
            </div>
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium">Mã giới thiệu</span>
                <input type="text" name="referral_code" placeholder="Mã giới thiệu" readonly
                       value="{{$referral_code}}"

                       class="nameDDM outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-gray-200 focus:border-none transition-all duration-200 rounded-sm ">
            </div>

        </div>
    </div>

    <div class="flex flex-col lg:flex-row justify-between item-start gap-6 xl:gap-28 xl:px-32 p-10 pt-0 px-4 lg:px-10">
        <div class="flex flex-col justify-start items-start gap-6 w-full">
            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Diện tích sàn (m2)</span>
                <input required type="number" name="floor_area" id="" placeholder="Nhập diện tích"
                       class="mail outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('floor_area')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong> Thể tích(m3)</span>
                <input required type="number" name="volume" id="" placeholder="Nhập thể tích"
                       class="mail outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('volume')
                <p class="text-red-600">{{$message}}</p>
                @enderror
            </div>

            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong>Hình ảnh kho </span>
                <input required type="file" multiple accept="image/png, image/gif, image/jpeg" name="image_storage[]" id="" placeholder="Nhập địa chỉ thư điện tử"
                       class="mail outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('image_storage')
                <p class="text-red-600">{{$message}}</p>
                @enderror
                @if ($errors->has('image_storage.*'))
                    <p class="text-red-600">{{ $errors->first('image_storage.*')}}</p>
                @endif
            </div>

            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium"><strong class="text-[#FF4D4F]">*</strong>Giấy chứng nhận PCCC/ Chứng nhận khác </span>
                <input required type="file" multiple accept="image/png, image/gif, image/jpeg" name="image_pccc[]" id="" placeholder="Nhập địa chỉ thư điện tử"
                       class="mail outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                @error('image_pccc')
                <p class="text-red-600">{{$message}}</p>
                @enderror
                @if ($errors->has('image_pccc.*'))
                    <p class="text-red-600">{{ $errors->first('image_pccc.*')}}</p>
                @endif
            </div>

        </div>
        <div class="flex flex-col justify-start items-start gap-6 w-full">
            <div class="w-full">
                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-sm font-medium">Kích thước (m)</span>

                    <div class="flex justify-between items-center w-full gap-6">
                        <input type="number" min="0" max="" placeholder="Nhập chiều dài (m)" name="length" value=""
                               id="length"
                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        <input type="number" min="0" max="" placeholder="Nhập chiều rộng (m)" name="with" value=""
                               id="with"
                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        <input type="number" min="0" max="" placeholder="Nhập chiều cao (m)" name="height" value=""
                               id="height"
                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    </div>

                </div>

            </div>

            <div class="flex flex-col justify-start items-start gap-2 w-full">
                <span class="text-sm font-medium">Diện tích loại kho (m2)</span>

                <div class="flex justify-between items-center w-full gap-6">
                    <input type="number" min="0" max="" placeholder="Kho lạnh (m)" name="cold_storage" value=""
                           id="length"
                           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    <input type="number" min="0" max="" placeholder="Kho bãi (m)" name="warehouse" value="" id="with"
                           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    <input type="number" min="0" max="" placeholder="Kho thường (m)" name="normal_storage" value=""
                           id="height"
                           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                </div>

            </div>
        </div>

    </div>
    <div class="text-center my-4">
        <input type="checkbox" id="terms_of_use" required>
        <label for="terms_of_use"> Bạn đồng ý với điều khoản sử dụng của chúng tôi.</label>
        <a href="#"
                onclick="$('.modal-hd').toggleClass('show-modal')"
                class="underline text-blue-700">Xem
            thêm</a></div>
    <div class="flex flex-col gap-5 max-w-[600px] text-center mx-auto px-4 lg:px-10">
        <button type="submit"
                class="active btn-sub text-center w-full text-grey text-xl font-medium bg-btnGrey rounded-lg py-4 bg-sky-500/100 text-[#FFF]"
        >Mua ngay
        </button>
        <span class="text-xl font-medium w-full">Bạn đã có tài khoản? <a href="{{route('login_storage')}}"
                                                                         class="text-primary hover:opacity-70 transition-all duration-500">Đăng nhập</a></span>
    </div>
</form>
    @if($isOrder)
        <div id="payment" class="fixed w-screen h-screen bg-white top-0" style="background: rgba(0, 0, 0, 0.5);">
            <form method="POST" action="{{route('post_register_order',['order_id' => $order->id])}}">
                @csrf
                <div
                    class="absolute p-4 lg:p-16 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-[50%] md:-translate-y-[55%] bg-white rounded-2xl w-11/12 lg:w-10/12 h-[95%] md:h-[80%] overflow-auto">
                    <div class="relative">
                        <img src="{{asset('home/img/titleK.png')}}" alt="Logo Kho">
                        <h2 class="font-medium text-2xl mt-4">Thông tin thanh toán</h2>

                        <button class="closeModalPayment absolute top-0 right-0">
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.0726 0.553704C22.9071 0.383748 22.7104 0.248911 22.4939 0.156911C22.2774 0.064912 22.0453 0.0175566 21.8109 0.0175566C21.5765 0.0175566 21.3444 0.064912 21.1279 0.156911C20.9114 0.248911 20.7147 0.383748 20.5492 0.553704L11.7976 9.50037L3.04608 0.535371C2.88038 0.365637 2.68368 0.230997 2.46719 0.139138C2.2507 0.0472788 2.01867 1.78843e-09 1.78435 0C1.55003 -1.78843e-09 1.318 0.0472788 1.10151 0.139138C0.885021 0.230997 0.688316 0.365637 0.522624 0.535371C0.356931 0.705104 0.225497 0.906607 0.135825 1.12837C0.0461531 1.35014 -1.74585e-09 1.58783 0 1.82787C1.74585e-09 2.06791 0.0461531 2.3056 0.135825 2.52737C0.225497 2.74913 0.356931 2.95064 0.522624 3.12037L9.27417 12.0854L0.522624 21.0504C0.356931 21.2201 0.225497 21.4216 0.135825 21.6434C0.0461531 21.8651 0 22.1028 0 22.3429C0 22.5829 0.0461531 22.8206 0.135825 23.0424C0.225497 23.2641 0.356931 23.4656 0.522624 23.6354C0.688316 23.8051 0.885021 23.9397 1.10151 24.0316C1.318 24.1235 1.55003 24.1707 1.78435 24.1707C2.01867 24.1707 2.2507 24.1235 2.46719 24.0316C2.68368 23.9397 2.88038 23.8051 3.04608 23.6354L11.7976 14.6704L20.5492 23.6354C20.7149 23.8051 20.9116 23.9397 21.1281 24.0316C21.3445 24.1235 21.5766 24.1707 21.8109 24.1707C22.0452 24.1707 22.2773 24.1235 22.4937 24.0316C22.7102 23.9397 22.9069 23.8051 23.0726 23.6354C23.2383 23.4656 23.3698 23.2641 23.4594 23.0424C23.5491 22.8206 23.5952 22.5829 23.5952 22.3429C23.5952 22.1028 23.5491 21.8651 23.4594 21.6434C23.3698 21.4216 23.2383 21.2201 23.0726 21.0504L14.3211 12.0854L23.0726 3.12037C23.7527 2.4237 23.7527 1.25037 23.0726 0.553704Z" fill="black"/>
                            </svg>
                        </button>
                    </div>
                    <div class="bg-[#F2F8FF] w-full p-[24px] pt-2 lg:pt-8 mt-2 lg:mt-8 rounded-xl">
                        <h3 class="font-extrabold text-xl">Thông tin bên mua</h3>
                        <div class="flex flex-col justify-between lg:flex-row gap-4 mt-6">
                            <div class="table w-full">
                                <div class="table-row">
                                    <p class="font-medium text-xl leading-8 table-cell">Tên công ty</p>
                                    <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->company_name}}</p>
                                </div>
                                <div class="table-row">
                                    <p class="font-medium text-xl leading-8 table-cell">Email</p>
                                    <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->email}}</p>
                                </div>
                                <div class="table-row">
                                    <p class="font-medium text-xl leading-8 table-cell">Số điện thoại</p>
                                    <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->phone_number}}</p>
                                </div>
                            </div>
                            <div class="table w-full">
                                <div class="table-row">
                                    <p class="font-medium text-xl leading-8 table-cell">Tên nhà cung cấp</p>
                                    <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->name}}</p>
                                </div>
                                <div class="table-row">
                                    <p class="font-medium text-xl leading-8 table-cell">Mã số thuế</p>
                                    <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->tax_code}}</p>
                                </div>
                                <div class="table-row">
                                    <p class="font-medium text-xl leading-8 table-cell">Người đại diện</p>
                                    <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->id_vdone}}</p>
                                </div>
                                @if($user->referral_code)
                                    <div class="table-row">
                                        <p class="font-medium text-xl leading-8 table-cell">Mã người giới thiệu</p>
                                        <p class="font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$user->referral_code}}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-[30px] pt-8">
                        <div class="bg-[#F2F8FF] w-full p-[24px] rounded-xl">
                            <h3 class="font-extrabold text-xl">Chi tiết sản phẩm</h3>
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
                                        "class"=> "text-red-500"
                                    ]);
                            @endphp
                            <div class="mt-6 table w-full">
                                @foreach($chiTietThanhToan as $value)
                                    <div class="table-row">
                                        <p class="font-medium text-xl leading-8 table-cell">{{$value['title']}}</p>
                                        <p class=" {{$value['class']}} font-medium text-xl leading-8 table-cell text-right lg:text-left">{{$value['value']}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="bg-[#F2F8FF] w-full p-[24px] rounded-xl">
                            <h3 class="font-extrabold text-xl">Phương thức thanh toán</h3>
                            <div class="mt-8">
                                <div class="bg-white items-center py-[10px] flex justify-between px-8 rounded-2xl mt-4">
                                    <div class="flex gap-2">
                                        <img src="{{asset('asset/icons/payment/icon_9pay.png')}}" alt="">
                                        <label class="cursor-pointer" for="paymentInput1">Thanh toán ngay qua 9Pay</label>
                                    </div>
                                    <input value="9PAY" class="cursor-pointer" checked id="paymentInput1" name="method_payment" type="radio">
                                </div>

                                <div class="bg-white items-center py-[10px] flex justify-between px-8 rounded-2xl mt-4">
                                    <div class="flex gap-2">
                                        <img src="{{asset('asset/icons/payment/icon_cart.png')}}" alt="">
                                        <label class="cursor-pointer" for="paymentInput2">Thẻ nội địa</label>
                                    </div>
                                    <input value="ATM_CARD" class="cursor-pointer" id="paymentInput2" name="method_payment" type="radio">
                                </div>
                                <div class="bg-white items-center py-[10px] flex justify-between px-8 rounded-2xl mt-4">
                                    <div class="flex gap-2">
                                        <img src="{{asset('asset/icons/payment/icon_cart_2.png')}}" alt="">
                                        <label class="cursor-pointer" for="paymentInput3">Thẻ quốc tế</label>
                                    </div>
                                    <input value="CREDIT_CARD" class="cursor-pointer" id="paymentInput3" name="method_payment" type="radio">
                                </div>

                                <div class="bg-white items-center py-[10px] flex justify-between px-8 rounded-2xl mt-4">
                                    <div class="flex gap-2">
                                        <img src="{{asset('asset/icons/payment/icon_bank.png')}}" alt="">
                                        <label class="cursor-pointer" for="paymentInput4">Chuyển khoản ngân hàng</label>
                                    </div>
                                    <input value="BANK_TRANSFER" class="cursor-pointer" id="paymentInput4" name="method_payment" type="radio">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap justify-center gap-4 md:gap-8 mt-8">
                        <button type="button" class="order-last md:order-first text-[#258AFF] border border-[#258AFF] rounded-2xl py-[10px] w-[300px] closeModalPayment">Đóng</button>
                        <button type="submit" class="order-first md:order-last text-white border border-[#258AFF] rounded-2xl py-[10px] w-[300px] bg-[#258AFF]">Thanh Toán</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>

<script src="{{asset('asset/js/main.js')}}"></script>
@if(!$isOrder)
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
    </script>
@endif
<script>
    // $('#formRegister-V').validate({
    //     rules: {
    //         name: {
    //             required: true,
    //         },
    //         id_vdone: {
    //             required: true,
    //         },
    //         email: {
    //             required: true,
    //         },
    //         company_name: {
    //             required: true,
    //         },
    //         tax_code: {
    //             required: true,
    //         },
    //         address: {
    //             required: true,
    //         },
    //         phone_number: {
    //             required: true,
    //         },
    //         password: {
    //             required: true,
    //
    //         },
    //         password_confirmation: {
    //             required: true,
    //             equalTo: '#password'
    //         },
    //
    //     },
    //     messages: {
    //         name: {
    //             required: 'Bạn cần nhập tên Kho'
    //         },
    //         id_vdone: {
    //             required: 'Bạn cần nhập ID người đại diện'
    //         },
    //         email: {
    //             required: 'Bạn cần nhập địa chỉ Email'
    //         },
    //         company_name: {
    //             required: 'Bạn cần nhập tên công ty'
    //         },
    //         tax_code: {
    //             required: 'Bạn cần nhập mã số thuế'
    //         },
    //         address: {
    //             required: 'Bạn cần nhập địa chỉ'
    //         },
    //         password: {
    //             required: 'Bạn phải nhập mật khẩu',
    //
    //         },
    //         phone_number: {
    //             required: 'Số điện thoại bắt buộc nhập',
    //         },
    //     },
    //     submitHandler: function (form) {
    //         form.submit();
    //     }
    // });
</script>
<script !src="">
    const divCity = document.getElementById('city_id');
    const divDistrict = document.getElementById('district_id');
    const divWard = document.getElementById('ward_id');
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
                    divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>` + data.map(item => `<option data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`);

                } else {
                    divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>`;
                }
            })
            .catch(() => divWard.innerHTML = `<option value="0">Lựa chọn phường (xã)</option>`
            )
    });

    // divWard.addEventListener('')
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
</body>
</html>
