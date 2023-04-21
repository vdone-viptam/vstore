
<div class="card-body">
    <form method="post" action="{{route('screens.manufacture.product.update',['id' => $product->id])}}">
        @csrf
        <div class="row">
            <div class="col-12">
                <h3 style="font-size: 18px;">Thông tin cơ bản</h3>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control form-control-lg" disabled id="name"
                           value="{{$product->name}}" placeholder="Nhập tên sản phẩm">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Chọn ngành hàng</label>
                    <input type="text" class="form-control" disabled value="{{$product->cate_name}}">
                </div>

            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Giá bán sản phẩm (Chưa VAT):</label>
                    <input type="text" class="form-control form-control-lg" id="name" disabled
                           value="{{number_format($product->price,0,'.','.')}}" placeholder="0">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">SKU <span class="text-danger">*</span></label>
                    <input type="text" disabled class="form-control form-control-lg" id="name"
                           value="{{$product->sku_id}}" placeholder="">
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="name">Chi tiết sản phẩm</label>
                    <div>
                        {!! $product->description !!}
                    </div>

                </div>
                <div class="form-group">
                    <label for="name">Tóm tắt sản phẩm</label>
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
                    <a href="{{asset($product->video)}}" target="_blank" class="btn btn-link">Click vào đây để xem video về sản phẩm</a>
                </div>
            </div>
            <div class="col-12">
                <h3 style="font-size: 18px;">Thông tin chi tiết</h3>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Tên thương hiệu</label>
                    <input type="text" class="form-control form-control-lg" disabled id="name"
                           value="{{$product->brand}}" placeholder="Nhập tên thương hiệu">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Xuất xứ <span class="text-danger">*</span></label>
                    <input type="text" disabled class="form-control form-control-lg" id="name"
                           value="{{$product->origin}}" placeholder="Nhập xuất xứ">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="name">Chất liệu</label>
                    <input type="text" class="form-control form-control-lg" id="name" disabled
                           value="{{$product->material}}" placeholder="Nhập chất liệu sản phẩm">
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="name">Kích cỡ (Cm)</label>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-12">
                            <input type="text" class="form-control form-control-lg"
                                   id="name" value="{{$product->length.' cm'}}" disabled
                                   placeholder="Nhập chiều dài (Cm)">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-12 ">
                            <input type="text" class="form-control form-control-lg" disabled
                                   id="name" value="{{$product->with.' cm'}}"
                                   placeholder="Nhập chiều rộng (Cm)">
                        </div>
                        <div class="col-xl-4  col-lg-4 col-12">
                            <input type="text" class="form-control form-control-lg" disabled
                                   id="name" value="{{$product->height.' cm'}}"
                                   placeholder="Nhập chiều cao (Cm)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Trọng lượng (Gram)</label>
                    <input type="text" class="form-control form-control-lg" id="name" disabled
                           value="{{number_format($product->weight,0,'.','.').' gram'}}"
                           placeholder="Nhập trọng lượng sản phẩm (Gram)">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Thể tích (Ml)</label>
                    <input type="text" class="form-control form-control-lg" id="name" disabled
                           value="{{number_format($product->volume,0,'.','.')}}" placeholder="Nhập thể tích sản phẩm">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Tên tổ chức chịu trách nhiệm sản xuất </label>
                    <input type="text" class="form-control form-control-lg" id="name" disabled
                           value="{{$product->manufacturer_name}}" placeholder="Nhập tên tổ chức">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Địa chỉ tổ chức chịu trách nhiệm sản xuất</label>
                    <input type="text" class="form-control form-control-lg" id="name" disabled
                           value="{{$product->manufacturer_address}}" placeholder="Nhập địa chỉ tổ chức">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Tên đơn vị chịu trách nhiệm nhập khẩu</label>
                    <input type="text" class="form-control form-control-lg" id="name" disabled
                           value="{{$product->import_unit}}" placeholder="Nhập tên địa chỉ đơn vị">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Địa chỉ đơn vị chịu trách nhiệm nhập khẩu</label>
                    <input type="text" class="form-control form-control-lg" id="name" disabled
                           value="{{$product->import_address}}" placeholder="Nhập tên địa chỉ đơn vị">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Ngày sản xuất</label>
                    <input type="date" class="form-control form-control-lg" id="name" disabled
                           value="{{$product->import_date}}" placeholder="Nhập tên thương hiệu">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="name">Kiểu đóng gói</label>
                    <select class="form-control form-control-lg" disabled>
                        <option value="1" {{$product->packing_type == 1 ? 'selected' : ''}}>Túi</option>
                        <option value="2" {{$product->packing_type == 2 ? 'selected' : ''}}>Hộp</option>
                        <option value="3" {{$product->packing_type == 3 ? 'selected' : ''}}>Thùng</option>
                    </select>
                </div>
            </div>


        </div>
    </form>
</div>
