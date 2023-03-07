<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="V-store | Ecommerce. Cổng thương mại điện tử dành cho nhà phân phối"/>
    <meta property="og:description"
          content="Hãy đồng hành cùng 20.000+ người bán hàng cùng những nhà phân phối hàng đầu Việt Nam."/>
    <meta property="og:url" content="{{asset('')}}"/>
    <meta property="og:image" content="{{asset('home/img/logo-06.png')}}"/>
    <meta property="og:image:width" content="120">
    <meta property="og:image:height" content="100">
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">

    <title>@yield('page_title')</title>
    @include('layouts.css')
    @yield('custom_css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body id="body">
@yield('modal')
<div class="absolute w-full h-full bg-transparent screen z-[5] hidden">

</div>
<div class="grid grid-cols-12" id="boxq">
    @include('layouts.vstore.menu')
    <div class="md:col-span-3 2xl:col-span-2 hidden md:block z-[6]">
    </div>
    <div class="w-full col-span-12 md:col-span-9 2xl:col-span-10">
        @include('layouts.vstore.header')
        @include('layouts.vstore.header_mobile')
        @yield('content')
    </div>
</div>
@include('layouts.js')
@yield('custom_js')
</body>
<script>
    $('.more-details').on('click', function () {
        $('.modal-details').toggleClass('show-modal');
    })

    const url = window.location.href.split('/');
    const tm = document.querySelectorAll(".tab__menu")
    const l = document.getElementsByClassName("list")
    const param = url[3];
    const a = url[4] || '/';
    if (param === "dashboard") {
        tm[0].classList.toggle("active")
        checkUnder(tm[0], a);
    }
    if (param === "products") {
        tm[1].classList.toggle("active");
        l[0].classList.remove("hidden");
        checkUnder(tm[1], a);

    }
    if (param === "order") {
        tm[2].classList.toggle("active")
        l[1].classList.remove("hidden");
        checkUnder(tm[2], a);

    }
    if (param === "partners") {
        tm[3].classList.toggle("active")
        l[2].classList.remove("hidden");
        checkUnder(tm[3], a);

    }
    if (param === "finance") {
        tm[4].classList.toggle("active")
        l[3].classList.remove("hidden");
        checkUnder(tm[4], a);

    }
    if (param === "account") {
        tm[5].classList.toggle("active")
        l[4].classList.remove("hidden");
        checkUnder(tm[5], a);

    }

    //

    function checkUnder(element, param) {
        const li = element.querySelectorAll('li');
        li.forEach(item => {
            const {page} = item.dataset;
            if (page == param) {
                item.classList.add('underline');
            }

        })
    }

    const nav = document.getElementById("nav")
    const menu = document.getElementsByClassName("menu")
    const bg = document.getElementsByClassName("show_bg")[0]
    nav.addEventListener("click", () => {
        console.log(menu[1])
        menu[0].classList.add("show")
        menu[1].classList.add("show")
    })
    window.onclick = function (event) {
        if (event.target == bg) {
            menu[0].classList.remove("show")
            menu[1].classList.remove("show")
        }
    }

    //    hover menu
    const hv = document.getElementsByClassName("choose-tab")[0]
    hv.addEventListener("click", () => {
        for (let i = 1; i < tm.length; i++) {
            if (tm[i].classList.contains("active")) {
                tm[i].classList.remove("tab__hover")
            } else {
                tm[i].classList.add("tab__hover")
            }
        }
    })
    for (let i = 0; i < tm.length; i++) {
        if (tm[i].classList.contains("active")) {
            tm[i].classList.remove("tab__hover")
        } else {
            tm[i].classList.add("tab__hover")
        }
    }
    const nav1 = document.querySelectorAll('nav');
    nav1.forEach(item => {
        const ul = item.querySelector('ul');

        if (ul && ul.classList.contains('pagination')) {
            console.log(ul);
            ul.setAttribute('class', 'pagination flex justify-start items-center gap-2 flex-wrap')
        }
    })
</script>
</html>
