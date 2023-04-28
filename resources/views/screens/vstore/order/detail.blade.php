<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Mã đơn hàng</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$order->no}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$order->name}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Giá sản phẩm</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{number_format($order->price,0,'.','.')}} đ" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Số lượng</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{number_format($order->quantity,0,'.','.')}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>

</div>
<div class="form-group">
    <label for="name">Giá trị đơn hàng</label>
    <input type="text" class="form-control form-control-lg" disabled id="name"
           value="{{number_format($order->total,0,'.','.')}} đ" placeholder="Nhập tên sản phẩm">
</div>
<div class="form-group">
    <label for="name">Thời gian đặt hàng</label>
    <input type="text" class="form-control form-control-lg" disabled id="name"
           value="{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i')}}" placeholder="Nhập tên sản phẩm">
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Thời gian hoàn thành</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="@if($order->export_status == 4 && \Carbon\Carbon::parse($order->estimated_date)->diffInDays(\Carbon\Carbon::now()) >= 7){{\Carbon\Carbon::parse($order->estimated_date)->format('d/m/Y H:i')}}@elseĐơn hàng chưa hoàn thành
                   @endif"
                   placeholder="Nhập tên sản phẩm">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Kho giao nhận</label>
            <input type="text" class="form-control form-control-lg" readonly id="discount"
                   value="{{$order->ware_name}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Chiết khấu nhận được</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$order->discount}} %"
                   placeholder="Nhập tên sản phẩm">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Chiết khấu nhận được (thành tiền)</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{number_format($order->money / 100,0,'.','.')}} đ"
                   placeholder="Nhập tên sản phẩm">
        </div>
    </div>
</div>

