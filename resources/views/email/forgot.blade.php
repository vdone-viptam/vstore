

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
<body style="padding-top:10px ; background-color: #e8e8e8;">
<div style="text-align:center;margin:1%">
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
    <p style="margin-top:1%;">
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

    <p style="margin-top:1%;">Rất hân hạnh được phục vụ Quý khách!</p>
    <p>Trân trọng cảm ơn!</p>
    </p>
</div>
</body>
</html>
