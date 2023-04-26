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
    <title>Đăng ký V-Store</title>
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/dist/output.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/images/Frame 1321315296.ico') }}">
    <meta property="og:title" content="V-store | Ecommerce. Cổng thương mại điện tử dành cho nhà phân phối" />
    <meta property="og:description"
        content="Hãy đồng hành cùng 20.000+ người bán hàng cùng những nhà phân phối hàng đầu Việt Nam." />
    <meta property="og:url" content="{{ asset('') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('asset/images/Frame 1321315296.ico') }}">
    <meta property="og:image" content="{{ asset('home/img/vstore11.png') }}" />
    @vite('resources/css/app.css')
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

                <img src="{{ asset('asset/images/vstore.png') }}" style="object-fit: contain; width:162px; height:40px;"
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
                                    class="text-danger">*</span>Số điện thoại công ty </label>
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
                            <label style="font-weight: 600;" for="vstore" style="font-weight: 600;"><span
                                    class="text-danger">*</span>Tên V-Store</label>
                            <input class="form-control form-control-lg" required type="text" name="name"
                                id="name" placeholder="Nhập tên nhà cung cấp" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="id_vdone"><span class="text-danger">*</span>ID
                                P-Done người đại diện  </label>
                            <input class="form-control form-control-lg" required type="text" name="id_vdone"
                                id="id_vdone" placeholder="Nhập ID P-Done người đại diện"
                                value="{{ old('id_vdone') }}">
                            @error('id_vdone')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="company" style="font-weight: 600;"><span
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
                            <label style="font-weight: 600;" for="idpDonemore"><span class="text-danger"></span>
                                &ensp;ID P-Done người đại diện (khác)</label>
                            <input class="form-control form-control-lg" type="text" name="id_vdone_diff"
                                id="id_vdone_diff" placeholder="Nhập ID P-Done người đại diện (khác)"
                                value="{{ old('id_vdone_diff') }}">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="code"><span class="text-danger">*</span>Mã
                                số thuế</label>
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
                            <label style="font-weight: 600;" for="codeInvite"><span class="text-danger"></span>
                                &ensp;Mã P-Done người giới thiệu</label>
                            <input class="form-control form-control-lg" type="text" name="referral_code"
                                placeholder="V-Shop giới thiệu" readonly value="{{ $referral_code }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-2 col-lg-4 col-md-4">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="city_id"><span class="text-danger">*</span>Tỉnh
                                (Thành
                                phố)</label>
                            <select class="form-control form-control-lg" required name="city_id" id="city_id">
                                <option value="" hidden>Lựa chọn tỉnh (thành phố)</option>
                            </select>
                            @error('city_id')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4">
                        <div class="form-group">
                            <label style="font-weight: 600;" for=""><span class="text-danger">*</span>Quận
                                (Huyện)</label>
                            <select class="form-control form-control-lg" required name="district_id"
                                id="district_id">
                                <option value="" hidden>Lựa chọn quận (huyện)</option>
                            </select>
                            @error('district_id')
                                <p class="text-red-600">{{ $message }}</p>
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
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label style="font-weight: 600;" for="address"><span class="text-danger">*</span>Địa chỉ chi tiết
                            </label>
                            <input class="form-control form-control-lg" type="text" name="address" required=""
                                placeholder="Nhập địa chỉ chi tiết (VD:Số nhà 89, phố Tô Vĩnh Diễn, phường Khương Trung, quận Thanh Xuân, thành phố Hà Nội)" value="{{ old('address') }}"> @error('address')
                                <p class="text-danger text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group" style="max-width: 450px; margin: 0 auto;">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="1" required=""><span
                            class="custom-control-label"> Tôi đồng ý với <a
                                href="#" onclick="$('.modal-hd').toggleClass('show-modal')"
                                class="underline text-blue-700">Điều khoản sử dụng dịch vụ</a>. </span>
                    </label>
                    <div class="form-group pt-2">
                        <button type="submit" class="active btn btn-block btn-primary">Đăng ký mua</button>

                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p>Bạn đã có tài khoản? <a href="{{ route('login_vstore') }}" class="text-secondary">Đăng nhập
                        ngay</a></p>
            </div>
        </div>
    </form>


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
