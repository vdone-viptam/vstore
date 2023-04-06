@extends('layouts.storage.main')
@section('page_title','Đổi mật khẩu')

@section('custom_css')
    <style>
        .disabled-link {
            pointer-events: none;
        }
    </style>
@endsection
@section('modal')
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
                        <div class="alert alert-success collapse" role="alert">
                            Mật khẩu của bạn đã được đổi thành công!
                        </div>
                        <form method="post">
                            <div class="row">

                                <div class=" col-xl-10 mx-auto  col-lg-10 col-md-12 col-sm-12 col-12 p-4">
                                    <div class="form-group old">
                                        <label for="name">Mật khẩu cũ</label>
                                        <input type="password" class="form-control form-control-lg" id="old_password" name="old_password">
                                        <div></div>
                                    </div>
                                    <div class="form-group pas">
                                        <label for="name">Mật khẩu mới</label>
                                        <input type="password" class="form-control form-control-lg" id="password" name="password">
                                        <div></div>
                                    </div>
                                    <div class="form-group conf">
                                        <label for="name">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation">
                                        <div></div>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center" style="gap:10px">
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
