<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Sản phẩm</title>
    @include('layouts.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body>
@yield('modal')
@include('layouts.vstore.menu_mobile')
@include('layouts.vstore.header')
@yield('content')
@include('layouts.js')
@yield('custom_js')
</body>
</html>
