<!DOCTYPE html>
<html>
<title></title>
<head>
</head>
<style>
    p {
        font-size: 17px;
    }
</style>
<body>
<div style="text-align:center;margin:15px">
    <img src="{{asset('home/img/titleK.png')}}" style="height:60px"></div>
<div>
    <p>V-Store chào mừng quý khách hàng đã đăng ký tài khoản KHO

    </p>
    <p>
        Quý khách vui lòng truy cập vào địa chỉ <a href="{{route('screens.storage.index')}}">https://kho.vdone.vn/</a>
        để thao tác với thông
        tin tài khoản của Quý khách
        hàng như sau:
    <p>
        <span style="font-weight:bold;">Mã tài khoản: </span>{{$ID}}

    </p>
    <p>
        <span style="font-weight:bold;">Mật khẩu: </span>{{$password}}
    </p>
    <p>Quý khách có thể đổi mật khẩu trong chức năng Quản lý tài khoản sau khi đăng nhập.
        Rất hân hạnh được phục vụ Quý khách!</p>
    <p>Trân trọng cảm ơn!</p>
    </p>
</div>
</body>
</html>
