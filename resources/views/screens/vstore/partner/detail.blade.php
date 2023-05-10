<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Mã nhà cung cấp: {{$user->account_code}}</label>

        </div>
        <div class="form-group">
            <label for="name">Tên nhà cung cấp: {{$user->name}}</label>

        </div>
        <div class="form-group">
            <label for="name">Số điện thoại: {{$user->phone_number}}</label>

        </div>
        <div class="form-group">
            <label for="name">Khu vực: {{$user->khu_vuc}}</label>

        </div>
        <div class="form-group">
            <label for="name">Tổng số sản phẩm: {{number_format($user->amount,0,'.','.')}}</label>

        </div>
        <div class="form-group">
            <label for="name">Sản phẩm liên kết: {{$user->countProduct}}</label>

        </div>
    </div>



</div>


</div>
<div id="note">

</div>


