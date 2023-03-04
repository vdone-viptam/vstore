{{--<h4>{{route('reset_password',['token'=>$token])}}</h4>--}}

{{--<span>Chúc bạn 1 ngày tốt lành</span> -->--}}

<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Chúc mừng bạn</a>
        </div>
        <p style="font-size:1.5em">Xin chào,</p>
        <p style="font-size:1.2em">Chúng tôi nhận được yêu cầu lấy lại mật khẩu của bạn vui lòng truy cập vào link này
            để tiếp tục<br>{{route('reset_password',['token'=>$token,'role_id' => $role_id])}}</p>
        <p style="font-size:1em;">Xin cảm ơn,<br/>V-Store admin</p>
        <hr style="border:none;border-top:1px solid #eee"/>
        <!-- <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
          <p>Your Brand Inc</p>
          <p>1600 Amphitheatre Parkway</p>
          <p>California</p>
        </div> -->
    </div>
</div>

