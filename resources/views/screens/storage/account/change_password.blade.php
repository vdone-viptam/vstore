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

                                <div class=" col-xl-8  col-lg-8 col-md-12 col-sm-12 col-12 p-4">
                                    <div class="form-group old pass w-full relative">
                                        <label for="name">Mật khẩu cũ</label>
                                        <input required type="password" class="form-control form-control-lg pass"
                                               {{-- pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$" --}}
                                               {{-- title="Mật khẩu ít nhất 8 ký tự, ít nhất 1 chữ hoa, 1 chữ thường, 1 ký tự đặc biệt, 1 chữ số" --}}
                                               autocomplete="off"
                                               id="old_password" name='old_password'>
                                        <div class="icon-password">
                                            <svg width="16" height="16" class="icon cursor-pointer absolute top-[45px] right-[10px]" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.6822 7.53757C15.0545 6.21507 14.3075 5.1365 13.4412 4.30185L12.5326 5.21043C13.2735 5.91846 13.9188 6.84471 14.4769 7.99828C12.9912 11.0733 10.8822 12.534 8.0001 12.534C7.13498 12.534 6.33813 12.4008 5.60956 12.1344L4.6251 13.1188C5.637 13.5861 6.762 13.8197 8.0001 13.8197C11.4322 13.8197 13.993 12.0322 15.6822 8.45721C15.7502 8.31344 15.7854 8.1564 15.7854 7.99739C15.7854 7.83838 15.7502 7.68135 15.6822 7.53757ZM14.5471 1.81185L13.7858 1.04971C13.7725 1.03643 13.7568 1.02589 13.7394 1.0187C13.7221 1.01151 13.7035 1.00781 13.6847 1.00781C13.666 1.00781 13.6474 1.01151 13.63 1.0187C13.6127 1.02589 13.5969 1.03643 13.5837 1.04971L11.6306 3.00185C10.5538 2.45185 9.34367 2.17685 8.0001 2.17685C4.56796 2.17685 2.00724 3.96435 0.317957 7.53935C0.250055 7.68313 0.21484 7.84017 0.21484 7.99918C0.21484 8.15818 0.250055 8.31522 0.317957 8.459C0.992837 9.88043 1.80534 11.0198 2.75546 11.877L0.865814 13.7661C0.839043 13.7929 0.824005 13.8293 0.824005 13.8671C0.824005 13.905 0.839043 13.9413 0.865814 13.9681L1.62813 14.7304C1.65492 14.7572 1.69125 14.7722 1.72912 14.7722C1.76699 14.7722 1.80331 14.7572 1.8301 14.7304L14.5471 2.014C14.5603 2.00073 14.5709 1.98497 14.5781 1.96763C14.5853 1.95029 14.589 1.9317 14.589 1.91293C14.589 1.89415 14.5853 1.87556 14.5781 1.85822C14.5709 1.84088 14.5603 1.82512 14.5471 1.81185ZM1.52331 7.99828C3.01081 4.92328 5.11974 3.46257 8.0001 3.46257C8.97403 3.46257 9.85956 3.62971 10.663 3.96953L9.4076 5.22489C8.81308 4.90768 8.13234 4.78996 7.46582 4.88908C6.7993 4.9882 6.18228 5.29893 5.7058 5.77541C5.22931 6.2519 4.91859 6.86891 4.81947 7.53544C4.72034 8.20196 4.83807 8.88269 5.15528 9.47721L3.66563 10.9669C2.84117 10.2392 2.13046 9.25328 1.52331 7.99828ZM5.92867 7.99828C5.92898 7.6834 6.00357 7.37303 6.14637 7.09238C6.28917 6.81174 6.49615 6.56874 6.75051 6.38312C7.00487 6.1975 7.29943 6.0745 7.61025 6.02411C7.92108 5.97372 8.23941 5.99736 8.53938 6.0931L6.02349 8.609C5.96043 8.41157 5.92844 8.20554 5.92867 7.99828Z" fill="black" fill-opacity="0.45"></path>
                                                <path d="M7.92897 10.0012C7.86719 10.0012 7.80629 9.99839 7.74594 9.99286L6.80272 10.9361C7.37003 11.1533 7.98812 11.2016 8.58228 11.0751C9.17643 10.9485 9.72122 10.6526 10.1508 10.2231C10.5803 9.7935 10.8763 9.24871 11.0028 8.65455C11.1293 8.0604 11.0811 7.4423 10.8638 6.875L9.92058 7.81821C9.92612 7.87857 9.92897 7.93946 9.92897 8.00125C9.92911 8.26393 9.87748 8.52407 9.77702 8.76678C9.67656 9.0095 9.52925 9.23003 9.3435 9.41578C9.15776 9.60152 8.93722 9.74884 8.69451 9.8493C8.45179 9.94976 8.19166 10.0014 7.92897 10.0012Z" fill="black" fill-opacity="0.45"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            @error('old_password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group pas pass w-full relative">
                                        <label for="name">Mật khẩu mới</label>
                                        <input required type="password" class="form-control form-control-lg pass"
                                                autocomplete="off"
                                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$"
                                               title="Mật khẩu ít nhất 8 ký tự, ít nhất 1 chữ hoa, 1 chữ thường, 1 ký tự đặc biệt, 1 chữ số"
                                               id="password" name="password">
                                        <div class="icon-password">
                                            <svg width="16" height="16" class="icon cursor-pointer absolute top-[45px] right-[10px]" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.6822 7.53757C15.0545 6.21507 14.3075 5.1365 13.4412 4.30185L12.5326 5.21043C13.2735 5.91846 13.9188 6.84471 14.4769 7.99828C12.9912 11.0733 10.8822 12.534 8.0001 12.534C7.13498 12.534 6.33813 12.4008 5.60956 12.1344L4.6251 13.1188C5.637 13.5861 6.762 13.8197 8.0001 13.8197C11.4322 13.8197 13.993 12.0322 15.6822 8.45721C15.7502 8.31344 15.7854 8.1564 15.7854 7.99739C15.7854 7.83838 15.7502 7.68135 15.6822 7.53757ZM14.5471 1.81185L13.7858 1.04971C13.7725 1.03643 13.7568 1.02589 13.7394 1.0187C13.7221 1.01151 13.7035 1.00781 13.6847 1.00781C13.666 1.00781 13.6474 1.01151 13.63 1.0187C13.6127 1.02589 13.5969 1.03643 13.5837 1.04971L11.6306 3.00185C10.5538 2.45185 9.34367 2.17685 8.0001 2.17685C4.56796 2.17685 2.00724 3.96435 0.317957 7.53935C0.250055 7.68313 0.21484 7.84017 0.21484 7.99918C0.21484 8.15818 0.250055 8.31522 0.317957 8.459C0.992837 9.88043 1.80534 11.0198 2.75546 11.877L0.865814 13.7661C0.839043 13.7929 0.824005 13.8293 0.824005 13.8671C0.824005 13.905 0.839043 13.9413 0.865814 13.9681L1.62813 14.7304C1.65492 14.7572 1.69125 14.7722 1.72912 14.7722C1.76699 14.7722 1.80331 14.7572 1.8301 14.7304L14.5471 2.014C14.5603 2.00073 14.5709 1.98497 14.5781 1.96763C14.5853 1.95029 14.589 1.9317 14.589 1.91293C14.589 1.89415 14.5853 1.87556 14.5781 1.85822C14.5709 1.84088 14.5603 1.82512 14.5471 1.81185ZM1.52331 7.99828C3.01081 4.92328 5.11974 3.46257 8.0001 3.46257C8.97403 3.46257 9.85956 3.62971 10.663 3.96953L9.4076 5.22489C8.81308 4.90768 8.13234 4.78996 7.46582 4.88908C6.7993 4.9882 6.18228 5.29893 5.7058 5.77541C5.22931 6.2519 4.91859 6.86891 4.81947 7.53544C4.72034 8.20196 4.83807 8.88269 5.15528 9.47721L3.66563 10.9669C2.84117 10.2392 2.13046 9.25328 1.52331 7.99828ZM5.92867 7.99828C5.92898 7.6834 6.00357 7.37303 6.14637 7.09238C6.28917 6.81174 6.49615 6.56874 6.75051 6.38312C7.00487 6.1975 7.29943 6.0745 7.61025 6.02411C7.92108 5.97372 8.23941 5.99736 8.53938 6.0931L6.02349 8.609C5.96043 8.41157 5.92844 8.20554 5.92867 7.99828Z" fill="black" fill-opacity="0.45"></path>
                                                <path d="M7.92897 10.0012C7.86719 10.0012 7.80629 9.99839 7.74594 9.99286L6.80272 10.9361C7.37003 11.1533 7.98812 11.2016 8.58228 11.0751C9.17643 10.9485 9.72122 10.6526 10.1508 10.2231C10.5803 9.7935 10.8763 9.24871 11.0028 8.65455C11.1293 8.0604 11.0811 7.4423 10.8638 6.875L9.92058 7.81821C9.92612 7.87857 9.92897 7.93946 9.92897 8.00125C9.92911 8.26393 9.87748 8.52407 9.77702 8.76678C9.67656 9.0095 9.52925 9.23003 9.3435 9.41578C9.15776 9.60152 8.93722 9.74884 8.69451 9.8493C8.45179 9.94976 8.19166 10.0014 7.92897 10.0012Z" fill="black" fill-opacity="0.45"></path>
                                            </svg>
                                        </div>
                                        <div>  @error('password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror</div>
                                    </div>
                                    <div class="form-group conf pass w-full relative">
                                        <label for="name">Nhập lại mật khẩu</label>
                                        <input required type="password" class="form-control form-control-lg pass"
                                                autocomplete="off"
                                               pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$"
                                               title="Mật khẩu ít nhất 8 ký tự, ít nhất 1 chữ hoa, 1 chữ thường, 1 ký tự đặc biệt, 1 chữ số"
                                               id="password_confirmation" name="password_confirmation">
                                        <div class="icon-password">
                                            <svg width="16" height="16" class="icon cursor-pointer absolute top-[45px] right-[10px]" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.6822 7.53757C15.0545 6.21507 14.3075 5.1365 13.4412 4.30185L12.5326 5.21043C13.2735 5.91846 13.9188 6.84471 14.4769 7.99828C12.9912 11.0733 10.8822 12.534 8.0001 12.534C7.13498 12.534 6.33813 12.4008 5.60956 12.1344L4.6251 13.1188C5.637 13.5861 6.762 13.8197 8.0001 13.8197C11.4322 13.8197 13.993 12.0322 15.6822 8.45721C15.7502 8.31344 15.7854 8.1564 15.7854 7.99739C15.7854 7.83838 15.7502 7.68135 15.6822 7.53757ZM14.5471 1.81185L13.7858 1.04971C13.7725 1.03643 13.7568 1.02589 13.7394 1.0187C13.7221 1.01151 13.7035 1.00781 13.6847 1.00781C13.666 1.00781 13.6474 1.01151 13.63 1.0187C13.6127 1.02589 13.5969 1.03643 13.5837 1.04971L11.6306 3.00185C10.5538 2.45185 9.34367 2.17685 8.0001 2.17685C4.56796 2.17685 2.00724 3.96435 0.317957 7.53935C0.250055 7.68313 0.21484 7.84017 0.21484 7.99918C0.21484 8.15818 0.250055 8.31522 0.317957 8.459C0.992837 9.88043 1.80534 11.0198 2.75546 11.877L0.865814 13.7661C0.839043 13.7929 0.824005 13.8293 0.824005 13.8671C0.824005 13.905 0.839043 13.9413 0.865814 13.9681L1.62813 14.7304C1.65492 14.7572 1.69125 14.7722 1.72912 14.7722C1.76699 14.7722 1.80331 14.7572 1.8301 14.7304L14.5471 2.014C14.5603 2.00073 14.5709 1.98497 14.5781 1.96763C14.5853 1.95029 14.589 1.9317 14.589 1.91293C14.589 1.89415 14.5853 1.87556 14.5781 1.85822C14.5709 1.84088 14.5603 1.82512 14.5471 1.81185ZM1.52331 7.99828C3.01081 4.92328 5.11974 3.46257 8.0001 3.46257C8.97403 3.46257 9.85956 3.62971 10.663 3.96953L9.4076 5.22489C8.81308 4.90768 8.13234 4.78996 7.46582 4.88908C6.7993 4.9882 6.18228 5.29893 5.7058 5.77541C5.22931 6.2519 4.91859 6.86891 4.81947 7.53544C4.72034 8.20196 4.83807 8.88269 5.15528 9.47721L3.66563 10.9669C2.84117 10.2392 2.13046 9.25328 1.52331 7.99828ZM5.92867 7.99828C5.92898 7.6834 6.00357 7.37303 6.14637 7.09238C6.28917 6.81174 6.49615 6.56874 6.75051 6.38312C7.00487 6.1975 7.29943 6.0745 7.61025 6.02411C7.92108 5.97372 8.23941 5.99736 8.53938 6.0931L6.02349 8.609C5.96043 8.41157 5.92844 8.20554 5.92867 7.99828Z" fill="black" fill-opacity="0.45"></path>
                                                <path d="M7.92897 10.0012C7.86719 10.0012 7.80629 9.99839 7.74594 9.99286L6.80272 10.9361C7.37003 11.1533 7.98812 11.2016 8.58228 11.0751C9.17643 10.9485 9.72122 10.6526 10.1508 10.2231C10.5803 9.7935 10.8763 9.24871 11.0028 8.65455C11.1293 8.0604 11.0811 7.4423 10.8638 6.875L9.92058 7.81821C9.92612 7.87857 9.92897 7.93946 9.92897 8.00125C9.92911 8.26393 9.87748 8.52407 9.77702 8.76678C9.67656 9.0095 9.52925 9.23003 9.3435 9.41578C9.15776 9.60152 8.93722 9.74884 8.69451 9.8493C8.45179 9.94976 8.19166 10.0014 7.92897 10.0012Z" fill="black" fill-opacity="0.45"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            @error('password_confirmation')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror</div>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center"
                                         style="gap:10px">
                                        <button class="btn btn-primary btn-acp">Cập nhật mật khẩu</button>

                                    </div>

                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 p-4">
                                    <h3 style="margin-bottom:15px; font-weight:600; font-size:20px;color:#a6afce;">Lưu ý về mật khẩu</h3>
                                    <div class="d-flex flex-column " style="gap:10px; ">
                                        <span style="color:#a6afce;">- Tối thiểu 8 kí tự</span>
                                        <span style="color:#a6afce;">- Có ít nhất một chữ cái viết hoa</span>
                                        <span style="color:#a6afce;">- Có ít nhất một chữ cái viết thường</span>
                                        <span style="color:#a6afce;">- Có ít nhất một chữ số</span>
                                        <span style="color:#a6afce;">- Có ít nhất một kí tự đặc biệt</span>
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
        setTimeout(() => {
            $('.alert.alert-success.collapshow').hide();
        }, "5000");
    </script>

@endsection
