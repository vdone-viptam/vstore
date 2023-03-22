
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

    <p style="font-weight:bold;font-size:19px;">V-Store chào mừng quý khách hàng

    </p>
    <p style="margin-top:3%;">
        Quý khách đang thực hiện đăng nhập trang quản trị @if($role_id == 1)
            Admin
        @elseif($role_id==2)
            Nhà cung cấp
        @elseif($role_id ==3)
            V-Store
        @else
            KHO
    @endif
    <p>
        <span style="font-weight:bold;">Mã Xác thực: </span>{{$confirm_code}}

    </p>


    <p style="margin-top:3%;">Rất hân hạnh được phục vụ Quý khách!</p>
    <p>Trân trọng cảm ơn!</p>
    </p>
</div>
</body>
</html>
