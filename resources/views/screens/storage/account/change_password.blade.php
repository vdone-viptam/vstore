@extends('layouts.storage.main')
@section('page_title','Đổi mật khẩu')

@section('custom_css')
    <link rel="stylesheet" href="{{asset('asset/bootstrap.min.css')}}">
    <link href="{{asset('asset/assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/style.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('asset/assets/vendor/datatables/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('asset/assets/vendor/datatables/css/buttons.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/assets/vendor/datatables/css/select.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('asset/assets/vendor/datatables/css/fixedHeader.bootstrap4.css')}}">
    <link rel="stylesheet"
          href="{{asset('asset/assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet"
          href="{{asset('asset/assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('asset/assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet"
          href="{{asset('asset/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/assets/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet"
          href="{{asset('asset/assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
            integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    <h2 class="pageheader-title">Đổi mật khẩu </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài
                                        khoản</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end pageheader  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- ============================================================== -->
            <!-- campaign tab one -->
            <!-- ============================================================== -->
            <div class="influence-profile-content pills-regular">
                <div class="card">
                    <h5 class="card-header" style="font-size: 18px;">Đổi mật khẩu</h5>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <div class="alert alert-success collapse" role="alert">
                                Mật khẩu của bạn đã được đổi thành công!
                            </div>
                        @endif
                        <div class="alert alert-success collapse" role="alert">
                            Mật khẩu của bạn đã được đổi thành công!
                        </div>
                        <form method="post" action="{{route('screens.storage.account.saveChangePassword')}}">
                            @csrf
                            <div class="row">

                                <div class=" col-xl-10 mx-auto  col-lg-10 col-md-12 col-sm-12 col-12 p-4">
                                    <div class="form-group old">
                                        <label for="name">Mật khẩu cũ</label>
                                        <input type="password" class="form-control form-control-lg"
                                               id="old_password" name='old_password'>
                                        <div>
                                            @error('old_password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group pas">
                                        <label for="name">Mật khẩu mới</label>
                                        <input type="password" class="form-control form-control-lg"
                                               id="password" name="password">
                                        <div>  @error('password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror</div>
                                    </div>
                                    <div class="form-group conf">
                                        <label for="name">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control form-control-lg"
                                               id="password_confirmation" name="password_confirmation">
                                        <div>
                                            @error('password_confirmation')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror</div>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center"
                                         style="gap:10px">
                                        <button class="btn btn-primary btn-acp">Cập nhập mật khẩu</button>

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
        document.querySelector('.btn-acp').classList.add('bg-slate-300');
        document.querySelector('.btn-acp').classList.add('disabled-link');


        $('.btn-acp').on('click', function () {
            $('.modal-acp').toggleClass('show-modal');
        })
        document.querySelectorAll('input').forEach(item => {
            item.addEventListener('keyup', (e) => {
                let check1 = true;
                let check2 = true;
                let check3 = true;
                if (!document.querySelectorAll('input')[1].value) {
                    check1 = false;
                }
                if (!document.querySelectorAll('input')[2].value) {
                    check2 = false;
                }
                if (!document.querySelectorAll('input')[3].value) {
                    check3 = false;
                }
                if (check1 && check2 && check3) {
                    document.querySelector('.btn-acp').classList.remove('bg-slate-300');
                    document.querySelector('.btn-acp').classList.remove('disabled-link');

                } else {
                    document.querySelector('.btn-acp').classList.add('bg-slate-300');
                    document.querySelector('.btn-acp').classList.add('disabled-link');

                }
            })
        })
    </script>

@endsection
