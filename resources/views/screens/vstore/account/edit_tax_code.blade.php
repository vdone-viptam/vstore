@extends('layouts.vstore.main')
@section('page_title','Cập nhập mã số thuế')

@section('custom_css')
    <link rel="stylesheet" href="{{asset('asset/dist/output.css')}}">
@endsection


@section('content')
    <div class="container-fluid dashboard-content ">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Cập nhập mã số thuế </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài
                                        khoản</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cập nhập mã số thuế</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 m-auto">
            <!-- ============================================================== -->
            <!-- campaign tab one -->
            <!-- ============================================================== -->
            <div class="influence-profile-content pills-regular">
                <div class="card">
                    <h5 class="card-header" style="font-size: 18px;">Cập nhập mã số thuế</h5>
                    <div class="card-body">
                        <form action="{{route('screens.vstore.account.saveChangeTaxCode')}}" method="POST">
                            @csrf
                            <div class="row">

                                <div class=" col-xl-10 mx-auto  col-lg-10 col-md-12 col-sm-12 col-12 p-4">

                                    <div class="form-group pas pass w-full relative">
                                        <label for="name">Mã số thuế cũ</label>
                                        <input required type="text" class="form-control form-control-lg pass"
                                               autocomplete="off"

                                               value="{{\Illuminate\Support\Facades\Auth::user()->tax_code}}" readonly>
                                        <div class="icon-password">

                                        </div>
                                        <div>

                                        </div>
                                    </div>
                                    <div class="form-group conf pass w-full relative">
                                        <label for="name">Mã số thuế mới</label>
                                        <input required type="number" class="form-control form-control-lg pass"
                                               autocomplete="off"
                                               pattern="/^[0-9]{10,13}$/"
                                               title="Mã số thuế phải là kí tự số và 10 hoặc 13 kí tự"
                                               id="tax_code" name="tax_code">
                                        <div class="icon-password">

                                        </div>
                                        <div>
                                            @error('password_confirmation')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror</div>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center"
                                         style="gap:10px">
                                        <button class="btn btn-primary btn-acp">Cập nhập mã số thuế</button>

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- end campaign tab one -->
            <!-- ============================================================== -->
        </div>
    </div>

@endsection

@section('custom_js')
    <script>
        $(document).ready(function () {
            @if(Session::has('success'))
            swalNoti('center', 'success', 'Yêu cầu cập nhập mã số thuế','', 500, true, 2200);
            @endif
        });

        document.querySelector('#tax_code').addEventListener("keypress", (e) => {
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
    </script>
@endsection
