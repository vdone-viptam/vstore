<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Sản phẩm</title>
    @include('layouts.css')
    @vite('resources/css/app.css')
</head>
<body>
@yield('modal')
@include('layouts.manufacture.menu_mobile')
@include('layouts.manufacture.header')
@yield('content')
@include('layouts.js')
@yield('custom_js')
</body>
</html>
