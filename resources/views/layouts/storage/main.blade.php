<!DOCTYPE html>
<html lang="vi">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('page_title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Kho | Hệ thống quản lý kho chuyên nghiệp"/>
    <meta property="og:description"
          content="Hãy đồng hành cùng 20.000+ người kinh doanh và thương hiệu bậc nhất tại Việt Nam đang tin dùng Kho."/>
    <meta property="og:url" content="{{asset('')}}"/>
    <meta property="og:image" content="{{asset('home/img/kho11.png')}}"/>
    <meta property="og:image:width" content="130">
    <meta property="og:image:height" content="100">
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @include('layouts.storage.css')
    @yield('custom_css')
    <style>
        .page-item.active .page-link {
            background-color: transparent !important;
            color: #1890FF !important;
            border-color: transparent !important;
        }

        .page-link {
            margin-right: 0 !important;
        }

        .page-item a:hover {
            background: transparent !important;
            color: #1890FF !important;
        }

        .pagination {
            gap: 8px;
        }
    </style>

</head>

<body id="body">
@yield('modal')
<div class="dashboard-main-wrapper">
    <!-- ============================================================== -->
    <!-- navbar -->
    <!-- ============================================================== -->
    @include('layouts.storage.header')
    <!-- ============================================================== -->
    <!-- end navbar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- left sidebar -->
    <!-- ============================================================== -->
    @include('layouts.storage.siderbar')
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->

                @yield('page')
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="ecommerce-widget">
                    <div class="row row-dash">
                        <!-- ============================================================== -->
                        <!-- sales  -->
                        <!-- ============================================================== -->
                        @yield('dash')
                        <!-- ============================================================== -->
                        <!-- end total orders  -->
                        <!-- ============================================================== -->
                    </div>

                    <div class="row">
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->

                        <!-- recent orders  -->
                        <!-- ============================================================== -->
                        @yield('content')
                        <!-- ============================================================== -->
                        <!-- end recent orders  -->


                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- customer acquistion  -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- end customer acquistion  -->
                        <!-- ============================================================== -->
                    </div>


                    <!-- <div class="row">

                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header" style="font-size: 18px;">Doanh thu theo danh mục</h5>
                                <div class="card-body">
                                    <div id="c3chart_category" style="height: 420px;"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header " style="font-size: 18px;"> Doanh thu</h5>
                                <div class="card-body">
                                    <div id="morris_totalrevenue"></div>
                                </div>
                                <div class="card-footer">
                                    <p class="display-7 font-weight-bold"><span
                                            class="text-primary d-inline-block">$26,000</span><span
                                            class="text-success float-right">+9.45%</span></p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        Copyright © 2023, được vận hành bởi đội nhóm Aneed <a href="https://aneed.vn">aneed.vn</a>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript: void(0);">Về chúng tôi</a>
                            <a href="javascript: void(0);">Hỗ trợ</a>
                            <a href="javascript: void(0);">Liên hệ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
</div>
@yield('custom_js')
<script>
    function convertDate(inputFormat) {
        function pad(s) {
            return (s < 10) ? '0' + s : s;
        }

        var d = new Date(inputFormat)
        return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join('/')
    }

    $(document).keypress(async function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            if ($('#search').val().length > 0) {
                await $.ajax({
                    type: "GET",
                    url: `{{route('screens.storage.dashboard.searchAllByKeyword')}}?_token={{csrf_token()}}`,
                    data: {
                        key_search: $('#search').val().trim()
                    },

                    error: function (jqXHR, error, errorThrown) {
                        $('#requestModal').modal('hide')
                        var error0 = JSON.parse(jqXHR.responseText)
                        Swal.fire({
                            icon: 'error',
                            title: 'Tìm kiếm không thành công !',
                            text: error0.message,
                        })
                    }
                }).done(function (data) {
                    document.location = data.href;
                })
            }
        }
    });
    const x = document.querySelectorAll('input[type="number"]');
    x.forEach(item => {
        item.addEventListener("keypress", function (evt) {
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57) {
                evt.preventDefault();
            }
        });
    })

    $('#switch12').on('change', (e) => {

        Swal.fire({
            title: 'Bạn có chắc muốn thay đổi trạng thái hoạt động của kho ?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tôi đồng ý',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: `{{route('screens.storage.dashboard.offWarehouse')}}`,
                    dataType: "json",
                    data: {"value": e.target.value},
                    encode: true,
                    error: function (jqXHR, error, errorThrown) {

                        var error0 = JSON.parse(jqXHR.responseText)
                        Swal.fire({
                            icon: 'error',
                            title: 'Liên kết kho không thành công',
                            text: error0.message,
                        })
                    }
                }).done(function (data) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        text: 'Click vào nút bên dưới để đóng',
                    }).then(() => location.reload())
                })
            } else {
                location.reload()
            }
        })
    });


</script>
<script src="{{asset('asset/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
{{-- <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script> --}}
{{-- <script src="{{asset('asset/assets/vendor/jquery/jquery-3.3.1.min.js')}}" ></script> --}}
<script src="{{asset('asset/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('asset/assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{asset('asset/assets/vendor/multi-select/js/jquery.multi-select.js')}}"></script>
<script src="{{asset('asset/assets/libs/js/main-js.js')}}"></script>
<script src="{{asset('asset/js/main.js')}}"></script>
<script src="{{asset('asset/assets/vendor/sweetalert2/sweetalert2.all.min.js')}}"></script>
</body>
</html>
