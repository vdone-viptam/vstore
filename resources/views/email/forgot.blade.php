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
    @elseif($role_id == 1)
        <img src="{{asset('home/img/vdone.png')}}" style="height:60px">
    @else
        <img src="{{asset('home/img/titleK.png')}}" style="height:60px">
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
<body style="padding-top:10px ; background-color: #F6FAFB;">
<div style="text-align:center;margin:6%">
    @if($role_id == 1)

        <img src="https://vstore.vdone.vn/asset/images/logo.png" style="height:40px">
    @elseif($role_id==2)

        <img src="https://ncc.vdone.vn/home/img/NCC.png" style="height:40px">
    @elseif($role_id ==3)
        <img src="https://vstore.vdone.vn/asset/images/logo.png" style="height:40px">
    @else
        <img src="https://kho.vdone.vn/home/img/titleK.png" style="height:40px">
    @endif

</div>
<div style="background-color: #ffff;padding:4% 6%;width:36%;margin:0px auto;">


    <p style="font-weight:bold;font-size:19px;">Chào mừng quý khách đến với hệ thống Thương mại điện tử.

    </p>
    <p style="margin-top:3%;">
        Để bắt đầu quá trình đặt lại mật khẩu cho Tài khoản
        @if($role_id == 1)
            Admin
        @elseif($role_id==2)
            Nhà cung cấp
        @elseif($role_id ==3)
            V-Store
        @else
            KHO
    @endif
            của bạn xin mời bạn Nhấn <a
                href="{{route('reset_password',['token'=>$token,'role_id' => $role_id])}}" style="text-decoration: underline">vào
                đây</a> và đợi vài phút. Hệ thống sẽ chuyển đến trang đặt lại mật khẩu.
    </p>

    <p style="margin-top:3%;">Rất hân hạnh được phục vụ Quý khách!</p>
    <p>Trân trọng cảm ơn!</p>
    </p>
</div>
</body>
</html>
