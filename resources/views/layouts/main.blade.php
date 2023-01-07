<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    @include('layouts.css')
</head>
<body>
<div class="over-lay-mobile" onclick="$('.menu-mobile').toggleClass('show-menuMB')">

</div>
@include('layouts.menu_mobile')
@include('layouts.header')
@yield('content')
@include('layouts.js')
@yield('custom_js')
</body>
</html>
