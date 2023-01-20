<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ V-Store</title>
    <link rel="stylesheet" href="{{asset('home/dist/style.css')}}">
    <link rel="stylesheet" href="{{asset('home/dist/output.css')}}">
{{--    <link rel="stylesheet" href="../../dist/output.css">--}}

    <link href="https://fonts.cdnfonts.com/css/svn-gilroy" rel="stylesheet">
</head>
<body>
<div class="bg w-full relative">
    <div class="max-w-[1440px] mx-auto flex flex-col justify-between gap-20 py-10 h-screen">
        <div class="flex justify-between items-center ">
            <div class="w-[162px] h-[32px]">
                <a href="./"> <img src="{{asset('home//img/Logo.png')}}" class="w-full" alt=""></a>
            </div>
            <a href="#" class="border-2 rounded-xl border-[#FFF] hover:bg-[#0E88FF] transition-all duration-200 py-3 px-6 text-xl font-semibold text-[#FFF]">Đăng nhập</a>
        </div>
        <div class="flex flex-col gap-5 max-w-[500px]">
            <h2 class="font-extrabold text-[40px] leading-[70px] tracking-[2px] ">"Cổng thương <br> mại điện tử V-store"</h2>
            <span class="text-[#333] text-lg">Hãy đồng hành cùng 20.000+ người kinh doanh và thương hiệu bậc nhất tại Việt Nam đang tin dùng V-Store.    </span>
        </div>
        <div class="max-w-[320px]">
            <button class="btn-register text-center w-full rounded-[10px] text-[#FFF] py-4 uppercase transition-all duration-200 hover:opacity-70">Đăng ký ngay</button>
        </div>
    </div>

</div>
<div class="banner flex flex-col justify-center items-center gap-6 max-w-[1440px] mx-auto p-16 my-8 ">
    <h2 class="font-bold text-2xl text-[#FFF]">CỔNG THƯƠNG MẠI ĐIỆN TỬ V-STORE LÀ GÌ?</h2>
    <span class="text-center text-[#FFF] text-xl font-medium">“Cổng thương mại điện tử V-Store” là cổng tiếp nhận đăng kí, kiểm duyệt và đàm phán chiết khấu các sản phẩm, dịch vụ từ nhà cung cấp. Nhà cung cấp muốn kinh doanh sản phẩm của mình trên nền tảng mạng xã hội V-Done thì bắt buộc phải khai báo sản phẩm của của mình thông qua các cổng V-Store. Mỗi một V-Store sẽ phụ trách các lĩnh vực sản phẩm khác nhau. Sản phẩm được cổng V-Store kiểm duyệt sẽ được cấp một mã sản phẩm và có thể lưu thông tin trên nền tảng V-Done. </span>
</div>
<div class="flex justify-around items-start max-w-[1440px] mx-auto">
    <div class="w-[312px]">
        <div class="w-[311px] h-[316px]">
            <img src="{{asset('home/img/ql1.png')}}" class="w-full" alt="">
        </div>
    </div>
    <div class="w-[256px] mt-14">
        <div class="w-[255px] h-[255px]">
            <img src="{{asset('home/img/ql2.png')}}" class="w-full" alt="">
        </div>
    </div>
    <div class="w-[300px]">
        <div class="w-[299px] h-[255px]">
            <img src="{{asset('home/img/ql3.png')}}" class="w-full" alt="">
        </div>
    </div>
</div>
<div class="flex flex-col justify-center items-center max-w-[1092px] mx-auto gap-2">
    <h2 class="text-2xl font-bold text-[#4F4F4F] uppercase">QUY TRÌNH TRỞ THÀNH V-STORE</h2>
    <span class="text-lg font-medium text-[#333]">Quy trình đăng kí V-Store đơn giản nhanh chóng, giúp người dùng dễ dàng nhận được những đặc quyền của V-Store </span>
    <div class="w-full">
        <img src="{{asset('home/img/bnqt.png')}}" class="w-full" alt="">
    </div>
</div>
<div class="flex flex-col justify-center items-center max-w-[1092px] mx-auto gap-2">
    <h2 class="text-2xl font-bold text-[#4F4F4F] uppercase">LỢI ÍCH KHI THAM GIA V-STORE  </h2>
    <span class="text-lg font-medium text-[#333] text-center">“Cổng thương mại điện tử V-Store” là công cụ được sử dụng để kết nối giữa người dùng với hệ thống quản trị thương mại điện tử thông qua hình thức đăng tài hàng hóa, dịch vụ để thực hiện hoạt động thương mại hóa </span>

</div>
<div class="grid grid-cols-2 place-items-center gap-8  max-w-[1440px] mx-auto py-6">
    <div class="flex flex-col justify-start items-start gap-8">
        <div class="flex flex-col gap-2">
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Hoàn toàn ủy quyền cho 1000+ doanh nghiệp, dễ dàng xác minh nguồn gốc sản phẩm. </span>
            </div>
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Công nghệ hoàn toàn mới. </span>
            </div>
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Công nghệ hoàn toàn mới. </span>
            </div>
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Được cung cấp website quản trị riêng cho tính năng kiểm duyệt, quản trị sản phẩm.  </span>
            </div>
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Được V-Done hỗ trợ kết nối tới các nhà cung cấp. </span>
            </div>
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Được đăng ký phụ trách theo tỉnh hoặc quốc gia. </span>
            </div>
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Được hưởng chiết khấu, lợi nhuận trên từng sản phẩm. </span>
            </div>
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Được chủ động đàm phán, điều chỉnh mức giá, chiết khấu sản phẩm.  </span>
            </div>
            <div class="flex justify-start items-center gap-2">
                <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="19" cy="19" r="19" fill="#EBEBEB"/>
                    <path d="M28.1667 16.8642C28.1088 16.6965 28.0035 16.5492 27.8636 16.4402C27.7236 16.3312 27.5551 16.2651 27.3783 16.25L22.1625 15.4892L19.825 10.75C19.7499 10.595 19.6327 10.4643 19.4868 10.3729C19.3409 10.2814 19.1722 10.2329 19 10.2329C18.8278 10.2329 18.6591 10.2814 18.5132 10.3729C18.3673 10.4643 18.2501 10.595 18.175 10.75L15.8375 15.48L10.6217 16.25C10.452 16.2741 10.2925 16.3453 10.1613 16.4555C10.03 16.5657 9.9323 16.7104 9.87917 16.8733C9.83053 17.0325 9.82617 17.202 9.86654 17.3635C9.90692 17.525 9.9905 17.6724 10.1083 17.79L13.8942 21.4567L12.9775 26.6633C12.9405 26.8361 12.9542 27.0158 13.0169 27.1809C13.0796 27.3461 13.1887 27.4895 13.3311 27.5941C13.4734 27.6987 13.643 27.7599 13.8193 27.7704C13.9956 27.7809 14.1712 27.7403 14.325 27.6533L19 25.2058L23.675 27.6533C23.8037 27.7259 23.949 27.7638 24.0967 27.7633C24.2908 27.764 24.4802 27.703 24.6375 27.5892C24.7797 27.4873 24.8898 27.3469 24.9548 27.1844C25.0198 27.022 25.0369 26.8444 25.0042 26.6725L24.0875 21.4658L27.8733 17.7992C28.0057 17.687 28.1035 17.5397 28.1554 17.3742C28.2073 17.2087 28.2112 17.0318 28.1667 16.8642ZM22.5292 20.5308C22.4231 20.6339 22.3435 20.7611 22.2972 20.9015C22.2509 21.042 22.2393 21.1916 22.2633 21.3375L22.9233 25.1875L19.4767 23.3542C19.3427 23.2879 19.1953 23.2534 19.0458 23.2534C18.8964 23.2534 18.749 23.2879 18.615 23.3542L15.1683 25.1875L15.8283 21.3375C15.8524 21.1916 15.8408 21.042 15.7945 20.9015C15.7482 20.7611 15.6686 20.6339 15.5625 20.5308L12.8125 17.7808L16.6717 17.2217C16.8202 17.201 16.9613 17.1443 17.0828 17.0564C17.2042 16.9685 17.3023 16.8521 17.3683 16.7175L19 13.225L20.7233 16.7267C20.7894 16.8613 20.8874 16.9776 21.0089 17.0655C21.1303 17.1534 21.2715 17.2102 21.42 17.2308L25.2792 17.79L22.5292 20.5308Z" fill="url(#paint0_linear_1_1394)"/>
                    <defs>
                        <linearGradient id="paint0_linear_1_1394" x1="19.0183" y1="10.2329" x2="19.0183" y2="27.7721" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#299CDD"/>
                            <stop offset="1" stop-color="#3369D1"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="text-[#4F4F4F] font-medium">Được quyền hỗ trợ bảo hành nâng cấp hệ thống miễn phí trong 20 năm. </span>
            </div>

        </div>

        <a href="#" class="btn-register font-semibold text-xl text-[#FFF] py-4 px-8 rounded-lg uppercase hover:opacity-70 transtion-all duration-200">Đăng ký thành viên</a>
    </div>
    <div class="w-full h-full">
        <img src="{{asset('home/img/img-com.png')}}" class="w-full" alt="">
    </div>
</div>
<div class="flex flex-col justify-center items-center gap-8  max-w-[1440px] mx-auto ">
    <h2 class="text-2xl font-bold text-[#4F4F4F] uppercase">DANH SÁCH V-STORE NỔI BẬT  </h2>
    <div class="grid grid-cols-6 gap-9 w-full">
        <div class="box flex flex-col justify-center items-center gap-2 p-5">
            <div class="w-[80px] h-[80px] rounded-full">
                <img src="{{asset('home/img/avt.png')}}" class="w-full rounded-full" alt="">
            </div>
            <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần ANEED </span>
        </div>
        <div class="box flex flex-col justify-center items-center gap-2 p-5">
            <div class="w-[80px] h-[80px] rounded-full">
                <img src="{{asset('home/img/avt1.png')}}" class="w-full rounded-full" alt="">
            </div>
            <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần và phát triển AHF  </span>
        </div>
        <div class="box flex flex-col justify-center items-center gap-2 p-5">
            <div class="w-[80px] h-[80px] rounded-full">
                <img src="{{asset('home/img/avt2.png')}}" class="w-full rounded-full" alt="">
            </div>
            <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần và phát triển AHF </span>
        </div>
        <div class="box flex flex-col justify-center items-center gap-2 p-5">
            <div class="w-[80px] h-[80px] rounded-full">
                <img src="{{asset('home/img/avt3.png')}}" class="w-full rounded-full" alt="">
            </div>
            <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần ANEED </span>
        </div>
        <div class="box flex flex-col justify-center items-center gap-2 p-5">
            <div class="w-[80px] h-[80px] rounded-full">
                <img src="{{asset('home/img/avt4.png')}}" class="w-full rounded-full" alt="">
            </div>
            <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần ANEED </span>
        </div>
        <div class="box flex flex-col justify-center items-center gap-2 p-5">
            <div class="w-[80px] h-[80px] rounded-full">
                <img src="{{asset('home/img/avt5.png')}}" class="w-full rounded-full" alt="">
            </div>
            <span class="max-w-[135px] text-sm text-center font-semibold text-[#4F4F4F]">Công ty cổ phần và phát triển AHF </span>
        </div>
    </div>
</div>
<div class="flex flex-col justify-center items-center gap-8  max-w-[1440px] mx-auto py-16">
    <h2 class="text-2xl font-bold text-[#4F4F4F] uppercase">NHỮNG CÂU HỎI ĐẶT RA CHO V-STORE </h2>
    <div class="grid grid-cols-2 gap-8 w-full">
        <div class="w-full h-full">
            <img src="{{asset('home/img/quest.png')}}" class="w-full" alt="">
        </div>
        <ul class="flex flex-col gap-2 w-full">
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-8">V-Store vận hành như thế nào? <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
                </a>
                <div class="content py-2 ml-8">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Est modi doloremque quis quo ipsa voluptas, neque odit architecto tenetur ad repellendus nobis fuga sit unde obcaecati! Ex consequuntur nesciunt eaque!
                </div>
            </li>
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-8">Làm sao để trở thành thành viên của V-Store  <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
                </a>

            </li>
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-8">Thành viên của V-Store sẽ được hưởng những lợi ích gì? <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
                </a>

            </li>
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-8">Nhà phát triển V-Store?<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
                </a>

            </li>
            <li class="w-full"><a href="#" class="flex justify-between text-[#333] text-xl items-center w-full border-[#0E88FF] border-[1px] rounded-[20px] py-3 px-8">Đối tác của V-Store?<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.9182 16.1933C12.4233 16.729 11.5767 16.729 11.0818 16.1933L7.01002 11.7854C6.27046 10.9848 6.8383 9.68726 7.92821 9.68726L16.0718 9.68726C17.1617 9.68726 17.7295 10.9848 16.99 11.7854L12.9182 16.1933Z" fill="#333333"/>
                    </svg>
                </a>

            </li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</body>
</html>
