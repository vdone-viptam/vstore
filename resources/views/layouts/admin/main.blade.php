<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    @include('layouts.css')
    @yield('custom_css')
    @vite('resources/css/app.css')
</head>
<body>
<div class="over-lay-mobile" onclick="$('.menu-mobile').toggleClass('show-menuMB')">

</div>
@yield('modal')
<div class="flex">
    <div class="xl:min-w-[310px] lg:min-w-[240px] md:min-w-[200px] md:min-h-full bg-[#F2F8FF] md:block hidden">
        @include('layouts.admin.menu')
    </div>
    <div class="w-full">
        @include('layouts.admin.header')
        @include('layouts.admin.header_mobile')
        @yield('content')
    </div>
</div>
@include('layouts.js')
@yield('custom_js')
</body>
<script>
    const nav = document.getElementById("nav")
    const menu = document.getElementsByClassName("menu")
    const bg = document.getElementsByClassName("show_bg")[0]
    nav.addEventListener("click", ()=>{
        console.log(menu[1])
        menu[0].classList.add("show")
        menu[1].classList.add("show")
    })
    window.onclick = function(event) {
        if (event.target == bg) {
            menu[0].classList.remove("show")
            menu[1].classList.remove("show")
        }
    }
//    hover menu
    const hv = document.getElementsByClassName("choose-tab")[0]
    const tm = document.getElementsByClassName("tab__menu")
    hv.addEventListener("click", () => {
        for(let i =0; i<tm.length; i++)
        {
            if(tm[i].classList.contains("active")){
                tm[i].classList.remove("tab__hover")
            }
            else {
                tm[i].classList.add("tab__hover")
            }
        }
    })
</script>
</html>
