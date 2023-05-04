<div class="card-body">
    @csrf
    <div class="row">
        <div class="col-12">
            <h3 style="font-size: 18px;">Thông tin cơ bản</h3>
        </div>

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
                <input type="text" class="form-control" disabled value="{{$product->name}}">
            </div>

        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label for="name">Ngành hàng:</label>
                <input type="text" class="form-control form-control-lg" id="name" disabled
                       value="{{$product->cate_name}}" placeholder="0">
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12">
            <div class="form-group">
                <label for="name">Giá sản phẩm <span class="text-danger">*</span></label>
                <input type="text" disabled class="form-control form-control-lg" id="name"
                       value="{{number_format((int)$product->price,0,'.','.')}} đ" placeholder="">
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="name">Thuế giá trị gia tăng (%)</label>
                <input type="text" class="form-control form-control-lg" disabled value=" {{$product->vat ?? 0}}">

            </div>
            <div class="form-group">
                <label for="name">Nội dung</label>
                <textarea name="" class="form-control form-control-lg" id="" disabled
                          cols="30" rows="4"
                          placeholder="Nhập tóm tắt sản phẩm">{{$product->short_content}}</textarea>
            </div>
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
        <div class="col-12 mb-3 col-xl-12">
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
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label for="name">Ngày xét duyệt</label>
                <input type="text" class="form-control form-control-lg" disabled id="name"
                       value="{{$product->admin_confirm_date ? \Illuminate\Support\Carbon::parse($product->admin_confirm_date) : 'Chưa xác định'}}"
                       placeholder="Nhập tên thương hiệu">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label for="name">Chiết khấu V-Shop <span class="text-danger">*</span></label>
                <input type="text" disabled class="form-control form-control-lg" id="name"
                       value="{{$product->discount_vShop != null ? $product->discount_vShop : 'Chưa niêm yết'}}"
                       placeholder="Nhập xuất xứ">
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="name">Số lượng đã bán</label>
                <input type="text" class="form-control form-control-lg" id="name" disabled
                       value="{{$product->amount_product_sold > 0 ? number_format((int)$product->amount_product_sold ,0,'.','.') : 0}}"
                       placeholder="Nhập chất liệu sản phẩm">
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="name">Số lượng sản phẩm trong kho</label>
                <input type="text" class="form-control form-control-lg" id="name" disabled
                       value="{{$product->amount > 0 ? number_format((int)$product->amount,0,'.','.') : 0}}"
                       placeholder="Nhập chất liệu sản phẩm">
            </div>
        </div>
    </div>
</div>
