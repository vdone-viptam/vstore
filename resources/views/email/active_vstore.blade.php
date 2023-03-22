<!DOCTYPE html>
<html>
<title></title>
<head>
</head>
<style>
    p {
        font-size: 17px;
    }
    @media only screen and (max-width: 600px) {

    }
</style>
<body style="background-color: #F6FAFB; padding-top:10px ;">
<div style="text-align:center;margin:1%">
    <img src="{{asset('asset/images/logo.png')}}" style="height:40px"></div>
<div style="background-color: #ffff;padding:4% 6%;width:36%;margin:0px auto;">

    <p style="font-weight:bold;font-size:19px;">V-Store chào mừng quý khách hàng đã đăng ký tài khoản V-Store

    </p>
    <p style="margin-top:1%;">
        Quý khách vui lòng truy cập vào địa chỉ <a href="{{route('landingpagevstore')}}">https://vstore.vdone.vn/</a>
        để thao tác với thông
        tin tài khoản của Quý khách
        hàng như sau:
    <p>
        <span style="font-weight:bold;">Mã tài khoản: </span>{{$ID}}

    </p>
    <p>
        <span style="font-weight:bold;">Mật khẩu: </span>{{$password}}
    </p>
    <p>Quý khách có thể đổi mật khẩu trong chức năng Quản lý tài khoản sau khi đăng nhập.</p>
    <p style="margin-top:1%;">Rất hân hạnh được phục vụ Quý khách!</p>
    <p>Trân trọng cảm ơn!</p>
    </p>
</div>
</body>
</html>
