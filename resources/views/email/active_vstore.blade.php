<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div style="text-align:center;margin:15px">
    <img src="{{asset('home/img/Logo.png')}}" style="height:60px">
</div>
<div>
    <p>Hệ thống Thương mại điện tử V-Store chúc mừng quý khách hàng đã đăng ký thành công tài khoản V-Store.
    </p>
    <p>
        Quý khách vui lòng truy cập vào địa chỉ <a
            href="{{asset(config('domain.vstore'))}}">https://vstore.vdone.vn/</a> để thao tác với thông
        tin tài khoản của Quý
        khách hàng như sau:
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
