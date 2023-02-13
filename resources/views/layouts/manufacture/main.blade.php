<!DOCTYPE html>
<html lang="vi">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('page_title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/Frame 1321315296.ico')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
            integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
          integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    {{--    font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @include('layouts.css')
    <link rel="stylesheet" href={{asset("asset/css/menu.css")}}>
    @vite('resources/css/app.css')
    @yield('custom_css')
</head>
<style>

    .btn-verify.active {
        background: linear-gradient(91.35deg, #005BB4 3.26%, #0E88FF 99.59%);
    }


    .validate-fail .inpt-vali {
        border-color: #D90000;
    }


    .validate-fail .text-war {
        display: block;
        color: #D90000;
    }


    .validate-fail .input-code li input {
        border-color: #D90000;
    }
</style>
<body>
@yield('modal')
<div class="grid grid-cols-12">
    @include('layouts.manufacture.menu')
    <div class="md:col-span-3 2xl:col-span-2 hidden md:block">
    </div>
    <div class="w-full col-span-12 md:col-span-9 2xl:col-span-10">
        @include('layouts.manufacture.header')
        @include('layouts.manufacture.header_mobile')
        @yield('content')
    </div>
</div>
@include('layouts.js')
@yield('custom_js')
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
    }
    if (param === "products") {
        tm[1].classList.toggle("active");
        l[0].classList.remove("hidden");
        checkUnder(tm[1],a)
    }
    if (param === "warehouses") {
        tm[2].classList.toggle("active")
        l[1].classList.remove("hidden");
        checkUnder(tm[2],a)
    }
    if (param === "partners") {
        tm[3].classList.toggle("active");
        l[2].classList.remove("hidden");
        checkUnder(tm[3],a)
    }
    if (param === "orders") {
        tm[4].classList.toggle("active");
        l[3].classList.remove("hidden");
        checkUnder(tm[4],a)
    }
    if (param === "finances") {
        tm[5].classList.toggle("active");
        l[4].classList.remove("hidden");
        checkUnder(tm[5],a)
    }

    function checkUnder(element, param) {
        const li = element.querySelectorAll('li');
        li.forEach(item => {
            const {page} = item.dataset;
            if (page == param) {
                item.classList.add('underline');
            }

        })
    }

    //
    const nav = document.getElementById("nav")
    const menu = document.getElementsByClassName("menu")
    const bg = document.getElementsByClassName("show_bg")[0]
    nav.addEventListener("click", () => {
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
        for (let i = 1; i <= tm.length; i++) {
            if (tm[i].classList.contains("active")) {
                tm[i].classList.remove("tab__hover")
            } else {
                tm[i].classList.add("tab__hover")
            }
        }
    })

    for (let i = 0; i <= tm.length; i++) {
        if (tm[i].classList.contains("active")) {
            tm[i].classList.remove("tab__hover")
        } else {
            tm[i].classList.add("tab__hover")
        }
    }
</script>

</body>
</html>
