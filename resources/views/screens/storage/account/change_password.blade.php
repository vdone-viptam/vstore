@extends('layouts.storage.main')
@section('page_title','Đổi mật khẩu')

@section('custom_css')

    <link rel="stylesheet" href="{{asset('asset/dist/output.css')}}">

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
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 m-auto">
            <!-- ============================================================== -->
            <!-- campaign tab one -->
            <!-- ============================================================== -->
            <div class="influence-profile-content pills-regular">
                <div class="card">
                    <h5 class="card-header" style="font-size: 18px;">Đổi mật khẩu</h5>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <div class="alert alert-success collapshow" role="alert">
                                Mật khẩu của bạn đã được đổi thành công!
                            </div>
                        @endif
                        <form method="post" action="{{route('screens.storage.account.saveChangePassword')}}">
                            @csrf
                            <div class="row">

                                <div class=" col-xl-10 mx-auto  col-lg-10 col-md-12 col-sm-12 col-12 p-4">
                                    <div class="form-group old pass w-full relative">
                                        <label for="name">Mật khẩu cũ</label>
                                        <input required type="password" class="form-control form-control-lg pass"
                                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$"
                                               title="Mật khẩu ít nhất 8 ký tự, ít nhất 1 chữ hoa, 1 chữ thường, 1 ký tự đặc biệt, 1 chữ số"
                                               id="old_password" name='old_password'>
                                        <div>
                                            @error('old_password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group pas pass w-full relative">
                                        <label for="name">Mật khẩu mới</label>
                                        <input required type="password" class="form-control form-control-lg pass"
                                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$"
                                               title="Mật khẩu ít nhất 8 ký tự, ít nhất 1 chữ hoa, 1 chữ thường, 1 ký tự đặc biệt, 1 chữ số"
                                               id="password" name="password">
                                        <div>  @error('password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror</div>
                                    </div>
                                    <div class="form-group conf pass w-full relative">
                                        <label for="name">Nhập lại mật khẩu</label>
                                        <input required type="password" class="form-control form-control-lg pass"
                                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$"
                                               title="Mật khẩu ít nhất 8 ký tự, ít nhất 1 chữ hoa, 1 chữ thường, 1 ký tự đặc biệt, 1 chữ số"
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
    <script src="{{asset('asset/js/main.js')}}"></script>
    <script>
        setTimeout(() => {
            $('.alert.alert-success.collapshow').hide();
        }, "5000");
    </script>

@endsection
