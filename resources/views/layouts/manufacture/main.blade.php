<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Sản phẩm</title>
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
    {{--   fontawesome--}}
    @include('layouts.css')
    <link rel="stylesheet" href={{asset("asset/css/menu.css")}}>
    @vite('resources/css/app.css')
</head>
<body>
@yield('modal')
@include('layouts.manufacture.menu_mobile')
{{--@include('layouts.manufacture.header')--}}
<div class="flex">
    <div class="xl:min-w-[310px] lg:min-w-[240px] md:min-w-[200px] min-h-full bg-[#F2F8FF] ">
        @include('layouts.manufacture.menu')
    </div>
    <div class="w-full">
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
    // console.log(param)
    // console.log(tm)

    // tm.forEach((ele, index1) => {
    //     ele.addEventListener('click', () => {
    //         const {index} = ele.dataset;
    //         tm[index].classList.add('active');
    //         l[index-1].classList.add('list-show')
    //         tm.forEach((item,index3)=>{
    //             if(index3 != index){
    //                 item.classList.remove('active')
    //             }
    //         })
    //         l.forEach((item,index3)=>{
    //             if(index3 != index-1){
    //                 item.classList.remove('list-show')
    //             }
    //         })
    //     })
    // })

    // if (param === "dashboard") {
    //     tm[0].classList.toggle("active")
    // }
    // if (param === "products") {
    //     tm[1].classList.toggle("active");
    //     l[0].classList.toggle("list-show")
    // }
    // if (param === "warehouses") {
    //     tm[2].classList.toggle("active")
    //     console.log(l[1])
    //     l[1].classList.toggle("list-show")
    // }
    // if (param === "partners") {
    //     tm[3].classList.toggle("active")
    //     l[2].classList.toggle("list-show")
    // }
    // if (param === "orders") {
    //     tm[4].classList.toggle("active")
    //     l[3].classList.toggle("list-show")
    // }
    // if (param === "finances") {
    //     tm[5].classList.toggle("active")
    //     l[4].classList.toggle("list-show")
    // }
    // //
    // tm[0].addEventListener("click", () => {
    //     if (param !== 'dashboard') {
    //         tm[0].classList.toggle("active")
    //     }
    // })
    // tm[1].addEventListener("click", () => {
    //     if (param !== 'products') {
    //         tm[1].classList.toggle("active")
    //         l[0].classList.toggle("list-show")
    //     }
    // })
    // tm[2].addEventListener("click", () => {
    //     if (param !== 'warehouses') {
    //         tm[2].classList.toggle("active")
    //         l[1].classList.toggle("list-show")
    //     }
    // })
    // tm[3].addEventListener("click", () => {
    //     if (param !== 'partners') {
    //         tm[3].classList.toggle("active")
    //         l[2].classList.toggle("list-show")
    //     }
    // })
    // tm[4].addEventListener("click", () => {
    //     if (param !== 'orders') {
    //         tm[4].classList.toggle("active")
    //         l[3].classList.toggle("list-show")
    //     }
    // })
    // tm[5].addEventListener("click", () => {
    //     if (param !== 'finances') {
    //         tm[5].classList.toggle("active")
    //         l[4].classList.toggle("list-show")
    //     }
    // })
</script>
</body>
</html>
