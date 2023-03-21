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
<div style="text-align:center;">
    @if($role_id == 2)
        <img src="{{asset('home/img/NCC.png')}}" style="height:60px">
    @elseif($role_id == 3)
        <img src="{{asset('home/img/Logo.png')}}" style="height:60px">
    @else
        <img src="{{asset('home/img/titleK.png')}}" style="height:60px">
    @endif
</div>
<p>
    Quý khách đang thực hiện đăng nhập trang quản trị @if($role_id == 1)
        Admin
    @elseif($role_id==2)
        Nhà cung cấp
    @elseif($role_id ==3)
        V-Store
    @else
        KHO
    @endif
</p>
<p>
    Mã xác thực là: <span style="font-weight:bold;">{{$confirm_code}}</span>
</p>
<p>
    Mã xác thực có hiệu lực trong vòng 3 phút.
</p>
<p>Rất hân hạnh được phục vụ Quý khách!
</p>
<p>
    Trân trọng cảm ơn!
</p>
</body>
</html>
