<!DOCTYPE html>
<html>
<title></title>
<head>
</head>
<body>
<div style="text-align:center;">
    @if($role_id == 2)
        <img src="{{asset('home/img/NCC.png')}}" style="height:60px">
    @elseif($role_id == 3)
        <img src="{{asset('home/img/Logo.png')}}" style="height:60px">
    @else
        <img src="{{asset('home/img/vdone.png')}}" style="height:60px">
    @endif
</div>
<p>
    Chào mừng quý khách đến với hệ thống Thương mại điện tử.
</p>
<p>
    Để bắt đầu quá trình đặt lại mật khẩu cho Tài khoản @if($role_id == 1)
        Admin
    @elseif($role_id==2)
        Nhà cung cấp
    @elseif($role_id ==3)
        V-Store
    @else
        KHO
    @endif của bạn xin mời bạn Nhấn <a
        href="{{route('reset_password',['token'=>$token,'role_id' => $role_id])}}" style="text-decoration: underline">vào
        đây</a> và đợi vài phút. Hệ thống sẽ chuyển đến trang đặt lại mật khẩu.
</p>
<p>
    Rất hân hạnh được phục vụ Quý khách!
</p>
<p>
    Trân trọng cảm ơn!
</p>
</body>
</html>

