<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V-done</title>
    @include('layouts.css')
    @yield('custom_css')
    @vite('resources/css/app.css')
</head>
<style>
    .btnGra{
        background: linear-gradient(180deg, #7280FD 0%, #7280FD 0.01%, #4C5DF4 100%) ;

    }
</style>
<body>
<div class="over-lay-mobile" onclick="$('.menu-mobile').toggleClass('show-menuMB')">

</div>
@yield('modal')
<div class="grid grid-cols-12">
    <div class="md:col-span-3 2xl:col-span-2 h-full bg-[#F2F8FF] md:block hidden">
        @include('layouts.admin.menu')
    </div>
    <div class="w-full col-span-12 md:col-span-9 2xl:col-span-10">
        @include('layouts.admin.header')
        @include('layouts.admin.header_mobile')
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
    if (param === "dashboard") {
        tm[0].classList.toggle("active")
    }
    if (param === "products") {
        tm[1].classList.toggle("active");
    }
    if (param === "warehouses") {
        tm[2].classList.toggle("active")
    }
    if (param === "partners") {
        tm[3].classList.toggle("active")
    }
    if (param === "orders") {
        tm[4].classList.toggle("active")
    }
    if (param === "finances") {
        tm[5].classList.toggle("active")
    }
    //
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
    if (tm[0].classList.contains("active")) {
        tm[0].classList.remove("tab__hover")
    } else {
        tm[0].classList.add("tab__hover")
    }
</script>
</html>
