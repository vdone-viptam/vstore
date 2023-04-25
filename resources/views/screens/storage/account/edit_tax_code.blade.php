@extends('layouts.storage.main')
@section('page_title','Cập nhật mã số thuế')

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
                    <h2 class="pageheader-title" id="pro">Cập nhật mã số thuế </h2>

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tài
                                        khoản</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cập nhật mã số thuế</li>
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
                    <h5 class="card-header" style="font-size: 18px;">Cập nhật mã số thuế</h5>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <input type="hidden" name="" id="check-success" value="1">
                        @endif
                        <form action="{{route('screens.storage.account.saveChangeTaxCode')}}" method="POST">
                            @csrf
                            <div class="row">

                                <div class=" col-xl-10 mx-auto  col-lg-10 col-md-12 col-sm-12 col-12 p-4">
                                    <div class="form-group old pass w-full">
                                        <label for="name">Mã số thuế cũ</label>
                                        <input type="text" value="{{Auth::user()->tax_code}}" disabled
                                               class="form-control form-control-lg">
                                        <div class="w-full">
                                            @error('ádasd')
                                            <p class="text-danger">{{$message}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group pas pass w-full ">
                                        <label for="name">Mã số thuế mới</label>
                                        <input required type="text" class="only-number form-control form-control-lg"
                                               id="new_tax_code" name="tax_code"
                                               pattern="^[0-9]{10,13}$"
                                               title="Mã số thuế phải có độ dài từ 10 hoặc 13 chữ số">
                                    </div>
                                    <div class="form-group">
                                        @error('tax_code')
                                        <p class="text-danger">{{$message}}</p>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center"
                                         style="gap:10px">
                                        <button class="btn btn-primary btn-acp">Cập nhật mã số thuế</button>
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
            if ($('#check-success').val() == 1) {
                swalNoti('center', 'success', 'Gửi yêu cầu thay đổi mã số thuế thành công','', 500, true, 2200);
            }
        });
    </script>
@endsection
