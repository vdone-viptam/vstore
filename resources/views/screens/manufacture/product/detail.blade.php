<form method="post" key=${id}>


    <div class="form-group">
        <label>Mã yêu cầu :</label>
        <input class="form-control form-control-lg" disabled value="{{$product->code}}"/></div>
    <div class="form-group">
        <label>Mã sản phẩm :</label>
        <input class="form-control form-control-lg" disabled value="{{$product->publish_id}}"/>
    </div>
    <div class="form-group">
        <label>Tên sản phẩm :</label>
        <input class="form-control form-control-lg" disabled value="{{$product->product_name}}">
    </div>
    <div class="form-group">
        <label>Giá bán :</label>
        <input class="form-control form-control-lg" disabled value="{{number_format($product->price,0,'.','.')}} đ">
    </div>
    <div class="form-group">
        <label>Store xét duyệt:</label>
        <input class="form-control form-control-lg" disabled value="{{$product->user_name}}">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <label for="">Chiết khấu cho Store</label>
                <input class="form-control form-control-lg" disabled value="{{$product->discount}} %">
            </div>
            <div class="col-6">
                <label for="">Chiết khấu cho Store (thành tiền)</label>
                <input class="form-control form-control-lg" disabled
                                      value="{{number_format($product->discount * $product->price / 100,0,'.','.')}} đ"></div>
        </div>
    </div>
    <div class="form-group">
        <label>Thời gian xét duyệt :</label>
        <input class="form-control form-control-lg" disabled value="{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y H:i')}}">
    </div>
    <div class="form-group">
        <label>Trạng thái :</label>
        <select name="" class="form-control" id="" disabled>
            <option value="0" {{$product->status == 0 ? 'selected' : ''}}>Đang xét duyệt lên Store</option>
            <option value="1" {{$product->status == 1 ? 'selected' : ''}}>Store đồng ý - chờ hệ thống duyệt</option>
            <option value="2" {{$product->status == 2 ? 'selected' : ''}}>Store từ chối</option>
            <option value="2" {{$product->status == 3 ? 'selected' : ''}}>Hệ thống đã duyệt</option>
            <option value="4" {{$product->status == 4 ? 'selected' : ''}}>Hệ thống từ chối</option>

        </select>
    </div>
    @if($product->status == 2 || $product->status == 4)
        <div class="form-group">
            <label>Lý do từ chối :</label>
            <textarea name="" id="" class="form-control" disabled>{{$product->note}}</textarea>
        </div>
    @endif
</form>
