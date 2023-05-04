<div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">Mã yêu cầu</label>
            <input type="text" class="form-control form-control-lg" disabled id="name"
                   value="{{$product->code}}" placeholder="Nhập tên sản phẩm">
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
           value="{{$product->vat.' %'}}" placeholder="Nhập tên sản phẩm">
</div>
<div class="form-group">
    <label for="name">Mô tả ngắn sản phẩm</label>
    <textarea disabled class="form-control">{{$product->short_content}}</textarea>
</div>
<div class="col-12">
    <label for="name">Hình ảnh sản phẩm</label>
</div>
<div class="mb-3 col-12 d-flex flex-lg-wrap flex-xl-nowrap w-100">

    @foreach(json_decode($product->images) as $image)
        <div class="col-xl-4 col-sm-6 ">
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
            <input type="text" class="form-control form-control-lg" disabled id="discount"
                   data-discount="{{$product->discount}}"
                   value="{{$product->discount}} %" placeholder="Nhập tên sản phẩm">
        </div>
    </div>
</div>
<div class="row">

    <div
        class=" @if($product->status == 3) col-xl-12 col-lg-12 col-md-12 @else col-xl-6 col-lg-6 col-md-6 @endif  col-sm-12">
        <div class="form-group">
            <label for="name">Chiết khấu cho V-Shop</label>
            <input type="text" disabled class="form-control form-control-lg" value="{{$product->discount_vshop}}">
        </div>
    </div>
    <div
        class=" @if($product->status == 3) col-xl-12 col-lg-12 col-md-12 @else col-xl-6 col-lg-6 col-md-6 @endif  col-sm-12">
        <div class="form-group">
            <label for="name">Trạng thái yêu cầu</label>
            <select name="status" id="status" class="form-control form-control-lg" @if($product->status != 1) disabled @endif>
                <option value="3" {{$product->status == 3 ? 'selected' : ''}}>Đồng ý</option>
                <option value="4" {{$product->status == 4 ? 'selected' : ''}}>Từ chối</option>
            </select>
        </div>
    </div>
    @if($product->status == 4)
        <div class="col-12">
            <div class="form-group">
                <label for="name">Lý do từ chối</label>
                <textarea name="" disabled class="form-control form-control-lg" id="">{{$product->note}}</textarea>
            </div>
        </div>
    @endif
    <div id="note" class="col-12">

    </div>
</div>

@if($product->status != 1)
    <script>
        document.querySelector('#btnConfirm').style.display = 'none'
    </script>
@endif

<script>
    document.querySelector('#status').addEventListener('change', (e) => {
        if (e.target.value == 4) {
            document.querySelector('#note').innerHTML = `
            <div class="form-group">
                <label for="name">Lý do từ chối</label>
                <textarea name="note" class="form-control form-control-lg"></textarea>
            </div>`;
        } else {
            document.querySelector('#note').innerHTML = ``;

        }
    })
</script>
