@extends('layouts.storage.main')
@section('page_title','Hồ sơ của tôi')

@section('custom_css')


@endsection
@section('modal')

@endsection
@section('content')
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
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
        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="row ">
            <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 col-12">
                <div class="card profile">

                </div>
            </div>

            <div class="col-xl-9 col-lg-7 col-md-12 col-sm-12 col-12">
                <div class="influence-profile-content pills-regular">
                    <div class="card">
                        <h5 class="card-header" style="font-size: 18px;">Hồ sơ của tôi</h5>

                        <div class="card-body">
                            <div>
                                <form action="{{route('screens.storage.account.editPro',['id' => $infoAccount->id])}}"
                                      method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class=" col-xl-10 mx-auto  col-lg-10 col-md-12 col-sm-12 col-12 p-4">
                                            @if(Session::has('success'))
                                                <div class="alert alert-success collapshow" role="alert"
                                                     id="alert-succ">
                                                    Thông tin của bạn đã được cập nhật thành công!
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
                                                    <label for="name">Tên Kho:</label>
                                                    <input required type="text" class="form-control form-control-lg"
                                                           name="name" id="name" value="{{$infoAccount->name}}">
                                                    @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="company_name">Tên công ty, hợp tác xã, hộ kinh doanh cá
                                                        thế:</label>
                                                    <input required type="text" class="form-control form-control-lg"
                                                           id="company_name" name="company_name"
                                                           value="{{$infoAccount->company_name}}">
                                                    @error('company_name')
                                                    <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Mã số thuế:</label>
                                                    <input required type="text" class="form-control form-control-lg"
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
                                                    <input required type="text" class="only-number form-control form-control-lg"
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
                                                <span style="font-size:18px; font-weight:600">Thông tin kho:</span>
                                                {{--                                                <div class="form-group">--}}
                                                {{--                                                    <label for="floor_area">Diện tích sàn (m2):</label>--}}
                                                {{--                                                    <input required type="number" class="form-control form-control-lg"--}}
                                                {{--                                                           id="floor_area" name="floor_area"--}}
                                                {{--                                                           value="{{$infoAccount->storage_information->floor_area}}">--}}
                                                {{--                                                    @error('floor_area')--}}
                                                {{--                                                    <p class="text-danger">{{$message}}</p>--}}
                                                {{--                                                    @enderror--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-group">--}}
                                                {{--                                                    <label for="volume">Thể tích (m3):</label>--}}
                                                {{--                                                    <input required type="number" class="form-control form-control-lg"--}}
                                                {{--                                                           id="volume" name="volume"--}}
                                                {{--                                                           value="{{$infoAccount->storage_information->volume}}">--}}
                                                {{--                                                    @error('volume')--}}
                                                {{--                                                    <p class="text-danger">{{$message}}</p>--}}
                                                {{--                                                    @enderror--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <div class="form-group">--}}
                                                {{--                                                    <label for="cold_storage">Diện tích kho lạnh (m2):</label>--}}
                                                {{--                                                    <input required type="number" class="form-control form-control-lg"--}}
                                                {{--                                                           id="cold_storage" name="cold_storage"--}}
                                                {{--                                                           value="{{$infoAccount->storage_information->cold_storage}}">--}}
                                                {{--                                                    @error('cold_storage')--}}
                                                {{--                                                    <p class="text-danger">{{$message}}</p>--}}
                                                {{--                                                    @enderror--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-group">--}}
                                                {{--                                                    <label for="warehouse">Diện tích kho bãi (m2):</label>--}}
                                                {{--                                                    <input required type="number" class="form-control form-control-lg"--}}
                                                {{--                                                           id="warehouse" name="warehouse"--}}
                                                {{--                                                           value="{{$infoAccount->storage_information->volume}}">--}}
                                                {{--                                                    @error('warehouse')--}}
                                                {{--                                                    <p class="text-danger">{{$message}}</p>--}}
                                                {{--                                                    @enderror--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="form-group">--}}
                                                {{--                                                    <label for="normal_storage">Diện tích kho thường (m2):</label>--}}
                                                {{--                                                    <input required type="number" class="form-control form-control-lg"--}}
                                                {{--                                                           id="normal_storage" name="normal_storage"--}}
                                                {{--                                                           value="{{$infoAccount->storage_information->normal_storage}}">--}}
                                                {{--                                                    @error('normal_storage')--}}
                                                {{--                                                    <p class="text-danger">{{$message}}</p>--}}
                                                {{--                                                    @enderror--}}
                                                {{--                                                </div>--}}
                                                <table class="table table-striped table-bordered second my-4">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Diện tích (m2)</th>
                                                        <th>Thể tích (m3)</th>
                                                        <th>Chiều dài (m2)</th>
                                                        <th>Chiều rộng (m2)</th>
                                                        <th>Chiều cao (m2)</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($infoWarehouse) > 0)
                                                        @foreach($infoWarehouse as $info)
                                                            <tr>
                                                                <td>
                                                                    @if($info->type == 1)
                                                                        Kho thường
                                                                    @elseif($info->type == 2)
                                                                        Kho lạnh
                                                                    @else
                                                                        Kho bãi
                                                                    @endif
                                                                </td>
                                                                <td>{{number_format($info->acreage,0,'.','.')}}</td>
                                                                <td>{{number_format($info->volume,0,'.','.')}}</td>
                                                                <td>{{number_format($info->length,0,'.','.')}}</td>
                                                                <td>{{number_format($info->width,0,'.','.')}}</td>
                                                                <td>{{number_format($info->height,0,'.','.')}}</td>
                                                            </tr>

                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="6" class="text-center">Không có dữ liệu phù hợp</td>
                                                        </tr>
                                                    @endif
                                                    </tbody>

                                                </table>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center"
                                                 style="gap:10px">
                                                <button type="submit" class="btn btn-primary btn-submit ">Cập nhật
                                                    thông tin
                                                </button>
                                                <button type="button" class="btn btn-success"
                                                    {{-- data-toggle="modal" data-target="#modal-tax-code" --}}
                                                >
                                                    <a href="{{route('screens.storage.account.editTaxCode')}}"
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

        <!-- Modal tax-code -->
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

            async function getUser() {
                await $.ajax({
                    type: "GET",
                    url: '{{ route('screens.storage.account.profile.detail') }}',
                    dataType: "json",
                    data: {},
                    encode: true,
                }).done(function (data) {
                    if (data.data) {
                        var htmlData = '';
                        var htmlDataForm = '';
                        htmlData += ` <div class="card-body">
                                    <div class="text-center">
                                        <h2 class="font-24 mb-0">${data.data.name}</h2>
                                        <p> ${data.data.account_code}</p>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <h3 class="font-16">Thông tin liên hệ</h3>
                                    <div class="">
                                        <ul class="list-unstyled mb-0">
                                        <li class="mb-0"><i class="fas fa-fw fa-phone mr-2"></i>${data.data.phone_number}</li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="card-body border-top">

                                    <h4>Ngày kích hoạt: <strong>${convertDate(data.data.confirm_date)}</strong></h4>
                                    <h4>Ngày hết hạn: <strong style="color:#DC2626"> ${convertDate(data.data.expiration_date)}</strong></h4>
                                </div>
                                        `;
                        htmlDataForm += `  <div class="form-group">
                                                            <label for="name">Tên V-Kho:</label>
                                                            <input type="text" class="form-control form-control-lg" id="name" value="${data.data.name}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="company_name">Tên công ty:</label>
                                                            <input type="text" class="form-control form-control-lg" id="company_name" value="${data.data.company_name}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tax_code">Mã số thuế:</label>
                                                            <input type="text" class="form-control form-control-lg" id="tax_code" value="${data.data.tax_code}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="addres">Địa chỉ:</label>
                                                            <input type="text" class="form-control form-control-lg" id="address" value="${data.data.address}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone_number">Số điện thoại:</label>
                                                            <input type="text" class="form-control form-control-lg" id="phone_number" value="${data.data.phone_number}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="id_vdone">ID Người đại diện:</label>
                                                            <input type="text" class="form-control form-control-lg" id="id_vdone" value="${data.data.id_vdone}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="id_vdone_diff">ID Người đại diện (khác):</label>
                                                            <input type="text" class="form-control form-control-lg" id="id_vdone_diff" value="${data.data.id_vdone_diff ? data.data.id_vdone_diff : 'Không có'}">
                                                        </div>
                                                        <span style="font-size:18px; font-weight:600">Thông tin kho:</span>
                                                        <div class="form-group">
                                                            <label for="floor_area">Diện tích sàn:</label>
                                                            <input type="text" class="form-control form-control-lg" id="floor_area" value="${data.data.storage_information.floor_area}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="volume">Thể tích:</label>
                                                            <input type="text" class="form-control form-control-lg" id="volume" value="${data.data.storage_information.volume ? data.data.storage_information.volume : 'Không có'}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cold_storage">Diện tích kho lạnh (m2):</label>
                                                            <input type="text" class="form-control form-control-lg" id="cold_storage" value="${data.data.storage_information.cold_storage ? data.data.storage_information.cold_storage : 'Không có'}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="warehouse">Diện tích kho bãi (m2):</label>
                                                            <input type="text" class="form-control form-control-lg" id="warehouse" value="${data.data.storage_information.warehouse ? data.data.storage_information.warehouse : 'Không có'}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="normal_storage">Diện tích kho thường:</label>
                                                            <input type="text" class="form-control form-control-lg" id="normal_storage" value="${data.data.storage_information.normal_storage ? data.data.storage_information.normal_storage : 'Không có'}">
                                                        </div>`
                        $('.profile').html(htmlData);
                        // $('.form-g').html(htmlDataForm);

                    } else {
                        $('.profile').html('')
                        $('.form-g').html('');
                    }
                })
            }

            getUser();
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
                document.getElementById('city_id').innerHTML = `<option value="0" disabled selected>Lựa chọn tỉnh (thành phố)</option>` + data.map(item => `<option ${item.PROVINCE_ID == '{{(int) $infoAccount->provinceId}}' ? 'selected' : ''}  data-name="${item.PROVINCE_NAME}" value="${item.PROVINCE_ID}">${item.PROVINCE_NAME}</option>`);
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
                    console.log(1);
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
                .catch(() => {
                        divDistrict.innerHTML = `<option value="0" disabled selected>Lựa chọn quận (huyện)</option>`
                        divWard.innerHTML = `<option value="0" disabled selected>Lựa chọn phường (xã)</option>`
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
