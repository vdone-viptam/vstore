
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
<body style="background-color: #e8e8e8; padding-top:10px ;">
<div style="text-align:center;margin:1%">
    @if($role_id == 1)

        <img src="{{asset('asset/images/logo.png')}}" style="height:40px">
    @elseif($role_id==2)

        <img src="{{asset('home/img/NCC.png')}}" style="height:40px">
    @elseif($role_id ==3)
        <img src="{{asset('asset/images/logo.png')}}" style="height:40px">
    @else
        <img src="{{asset('home/img/titleK.png')}}" style="height:40px">
    @endif



</div>
<div style="background-color: #ffff;padding:4% 6%;width:36%;margin:0px auto;">

    <p style="font-weight:bold;font-size:19px;">V-Store chào mừng quý khách hàng

    </p>
    <p style="margin-top:1%;">
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


    <p style="margin-top:1%;">Rất hân hạnh được phục vụ Quý khách!</p>
    <p>Trân trọng cảm ơn!</p>
    </p>
</div>
</body>
</html>
