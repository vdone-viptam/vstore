<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Mã sản phẩm</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$product->publish_id}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$product->name}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Ngành hàng</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$product->cate_name}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Giá sản phẩm</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{number_format($product->price,0,'.','.')}} đ" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
</div>
    <div class="form-group">
        <label for="name">Thuế giá trị gia tăng</label>
        <input type="text" class="form-control form-control-lg" disabled id="name"
               value="{{$product->vat}} %" placeholder="Nhập tên sản phẩm">
    </div>
<div class="form-group">
    <label for="name">Mô tả ngắn sản phẩm</label>
    <textarea disabled class="form-control">{{$product->short_content}}</textarea>
</div>
<div class="col-12">
    <label for="name">Hình ảnh sản phẩm</label>
</div>
<div class="mb-3 col-12 img-col w-100">

    @foreach(json_decode($product->images) as $image)
        <div class="col-xl-4 col-sm-6 " style="margin:15px 0;">
            <img src="{{asset($image)}}" class="w-100 " alt=""
                 style="object-fit: cover; height: 200px;">
        </div>
    @endforeach
</div>
<div class="form-group">
    <label for="name">Video sản phẩm</label>
    @if(strlen($product->video) > 0)
        <video width="320" height="240" controls class="form-control">
            <source src="{{asset($product->video)}}" type="video/mp4">
        </video>
    @else
        <p>Không có video liên quan đến sản phẩm</p>
    @endif
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Nhà cung cấp</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$product->user_name}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Chiết khấu từ nhà cung cấp</label>
            <input type="text" class="form-control form-control-lg" readonly id="discount" data-discount="{{$product->discount}}"
                   value="{{$product->discount}}%" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Ngày xét duyệt</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{\Carbon\Carbon::parse($product->admin_confirm_date)->format('d/m/Y H:i')}}" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Chiết khấu cho Shop</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$product->discount_vShop}}%" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
</div>

