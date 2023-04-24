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
    <label for="name">Thuế giá trị gia tăng (%)</label>
    <input type="text" class="form-control form-control-lg" disabled id="name"
           value="{{$product->vat}}" placeholder="Nhập tên sản phẩm">
</div>
<div class="form-group">
    <label for="name">Mô tả ngắn sản phẩm (%)</label>
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
    <label for="name">Video sản phẩm (%)</label>
    <video width="320" height="240" controls class="form-control">
        <source src="{{asset($product->video)}}" type="video/mp4">

    </video>
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
        class=" @if($product->status == 2) col-xl-12 col-lg-12 col-md-12 @else col-xl-6 col-lg-6 col-md-6 @endif  col-sm-12">
        <div class="form-group">
            <label for="name">Trạng thái yêu cầu</label>
            <select name="status" id="status" class="form-control form-control-lg"
                    @if($product->status != 0) disabled @endif>
                <option value="1" {{$product->status != 0 && $product->status != 2 ? 'selected' : ''}}>Đống ý</option>
                <option value="2" {{$product->status == 2 ? 'selected' : ''}}>Từ chối</option>
            </select>
        </div>
    </div>
    @if($product->status == 2)
        <div class="col -12">
            <div class="form-group">
                <label for="name">Lý do từ chối</label>
                <textarea name="" disabled class="form-control number" id="">{{$product->note}}</textarea>
            </div>
        </div>
    @else
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label for="name">Chiết khấu cho V-Shop</label>
                <input type="text" class="form-control form-control-lg number-percent"
                       value="{{$product->discount_vshop ?? ''}}"
                       {{isset($product->discount_vshop) || $product->status == 2 ? 'disabled' : ''}} name="discount_vShop"
                       id="discount_vShop"
                       placeholder="Nhập chiết khẩu cho V-Shop">
                <p id="messageDis" style="display: none" class="text-danger mt-2 ms-1">Chiết khấu cho V-Shop không được
                    nhỏ
                    hơn {{$product->discount / 2}} và lớn hơn {{$product->discount}}</p>
            </div>
        </div>
    @endif

</div>
<div class="form-group text-center mt-4">
    <label class="custom-control custom-checkbox custom-control-inline" id="appect" style="margin: 0;">
        <input type="checkbox" id="appect" name="type" value="1" class="custom-control-input"><span
            class="custom-control-label">Chúng tôi đã kiểm định thông tin sản phẩm</span>
    </label>
</div>
<div id="note">

</div>

<script>
    document.getElementById('btnConfirm').style.display = 'none';
    document.getElementsByName('discount_vShop')[0].addEventListener("keypress", (e) => {
        var regex = new RegExp("^[0-9.]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    });
    document.querySelector('#status').addEventListener('change', (e) => {
        if (e.target.value == 2) {
            document.getElementById('btnConfirm').style.display = 'block';
            document.querySelector('#note').innerHTML = `
   <label for="name">Lý do từ chối</label>
<textarea name="note" placeholder="Lý do từ chối"
                             class="form-control" ></textarea>`
        } else if (e.target.value == 1) {
            document.querySelector('#note').innerHTML = ``;
            document.getElementById('btnConfirm').style.display = 'none';
        } else {
            document.querySelector('#note').innerHTML = ``;

        }
    })
    $('#appect').on('change', (e) => {
        if (e.target.checked && $('#discount_vShop').val()) {
            document.getElementById('btnConfirm').style.display = 'block';
        } else {
            document.getElementById('btnConfirm').style.display = 'none';
        }
    });
    if (document.getElementsByName('discount_vShop')[0]) {
        document.getElementsByName('discount_vShop')[0].addEventListener('keyup', (e) => {
            if (+e.target.value < Number(document.getElementById('discount').dataset.discount) && +e.target.value >= Number(document.getElementById('discount').dataset.discount) / 2) {
                document.getElementById('messageDis').style.display = 'none';
                if($('#appect').is(":checked")){
                    document.getElementById('btnConfirm').style.display = 'block';
                }else{
                    document.getElementById('btnConfirm').style.display = 'none';

                }

            } else {
                document.getElementById('messageDis').style.display = 'block';
                document.getElementById('btnConfirm').style.display = 'none';
            }

        })
    }

</script>
