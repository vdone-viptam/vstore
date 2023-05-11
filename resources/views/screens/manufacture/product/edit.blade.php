@extends('layouts.manufacture.main')
@section('page_title','Sửa sản phẩm')



@section('modal')
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 18px;">Thông tin chi tiết</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body md-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Sửa sản phẩm</h2>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Quản lý sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('content')
    <form action="{{route('screens.manufacture.product.update',['id' => $product->id])}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header" style="font-size: 20px;">Sửa sản phẩm</h5>

                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-12">
                                <h3 style="font-size: 18px;">Thông tin cơ bản</h3>
                            </div>

                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                                           value="{{$product->name}}" placeholder="Nhập tên sản phẩm">
                                    @error('name')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chọn ngành hàng <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" id="category_id" name="category_id">
                                        <option value="" disabled selected>Lựa chọn ngành hàng sản phẩm</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Giá sản phẩm chưa VAT(đ):<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg number only-number"
                                           id="price"
                                           name="price"
                                           value="{{number_format($product->price,0,'.','.')}}" placeholder="0">
                                    @error('price')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Mã SKU sản phẩm<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="sku_id" name="sku_id"
                                           value="{{$product->sku_id}}" placeholder="Nhập mã SKU của sản phẩm">
                                    @error('sku_id')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chi tiết sản phẩm <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control form-control-lg" id="editor"
                                              cols="30" rows="10"
                                              placeholder="Nhập chi tiết sản phẩm">{{$product->description}}</textarea>
                                    @error('description')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Tóm tắt sản phẩm <span class="text-danger">*</span></label>
                                    <textarea name="short_content" class="form-control form-control-lg"
                                              id="short_content"
                                              cols="30" rows="4"
                                              placeholder="Nhập tóm tắt sản phẩm">{{$product->short_content}}</textarea>
                                    @error('short_content')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-12 col-xl-6">
                                <label for="formFileMultiple" class="form-label">Hình ảnh sản phẩm<span
                                        class="text-danger">*</span></label>
                                <input class="form-control form-control-lg" accept=".jpeg.gif,.png,.jpg" type="file"
                                       name="images[]"
                                       id="images"
                                       multiple>
                                <p class="text-danger mt-2 ml-1" id="error"></p>

                                @error('images')
                                <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-3 col-xl-6">
                                <div class="form-group" id="file-input">
                                    <label for="name">Video sản phẩm</label>
                                    <input type="file" id="pickfiles" class="form-control form-control-lg"
                                           accept="video/mp4">
                                    <div id="filelist"></div>
                                </div>
                                <input type="hidden" name="video" id="videoSuccess" value="{{$product->video}}">
                                @error('video')
                                <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group" id="filelist">

                            </div>
                            <div class="col-12">
                                <h3 style="font-size: 18px;">Thông tin chi tiết</h3>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên thương hiệu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="brand" name="brand"
                                           value="{{$product->brand}}" placeholder="Nhập tên thương hiệu">
                                    @error('brand')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Xuất xứ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="origin" name="origin"
                                           value="{{$product->origin}}" placeholder="Nhập xuất xứ">
                                    @error('origin')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Chất liệu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="material"
                                           name="material"
                                           value="{{$product->material}}" placeholder="Nhập chất liệu sản phẩm">
                                    @error('material')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Kích cỡ (Cm) <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-12">
                                            <input type="text" class="form-control form-control-lg number only-number"
                                                   id="length"
                                                   name="length"
                                                   value="{{number_format($product->length,0,'.','.')}}"
                                                   placeholder="Nhập chiều dài (Cm)">
                                            @error('length')
                                            <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-12 ">
                                            <input type="text" class="form-control form-control-lg number only-number"
                                                   id="with"
                                                   name="with"
                                                   value="{{number_format($product->with,0,'.','.')}}"
                                                   placeholder="Nhập chiều rộng (Cm)">
                                            @error('with')
                                            <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-xl-4  col-lg-4 col-12">
                                            <input type="text" class="form-control form-control-lg number only-number"
                                                   id="height"
                                                   name="height"
                                                   value="{{number_format($product->height,0,'.','.')}}"
                                                   placeholder="Nhập chiều cao (Cm)">
                                            @error('height')
                                            <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Trọng lượng (Gram) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg number only-number"
                                           id="weight"
                                           name="weight"
                                           value="{{number_format($product->weight / 1000,0,'.','.')}}"
                                           placeholder="Nhập trọng lượng sản phẩm (Gram)">
                                    @error('weight')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Thể tích (Ml)</label>
                                    <input type="text" class="form-control form-control-lg number only-number"
                                           id="volume"
                                           name="volume"
                                           value="{{number_format($product->volume,0,'.','.')}}"
                                           placeholder="Nhập thể tích sản phẩm">
                                    @error('volume')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên tổ chức chịu trách nhiệm sản xuất </label>
                                    <input type="text" class="form-control form-control-lg" id="manufacturer_name"
                                           name="manufacturer_name"
                                           value="{{$product->manufacturer_name}}" placeholder="Nhập tên tổ chức">
                                    @error('manufacturer_name')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Địa chỉ tổ chức chịu trách nhiệm sản xuất</label>
                                    <input type="text" class="form-control form-control-lg" id="manufacturer_address"
                                           name="manufacturer_address"
                                           value="{{$product->manufacturer_address}}"
                                           placeholder="Nhập địa chỉ tổ chức">
                                    @error('manufacturer_address')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên đơn vị chịu trách nhiệm nhập khẩu/ thương nhân</label>
                                    <input type="text" class="form-control form-control-lg" id="import_unit"
                                           name="import_unit"
                                           value="{{$product->import_unit}}" placeholder="Nhập tên địa chỉ đơn vị">
                                    @error('import_unit')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Địa chỉ đơn vị chịu trách nhiệm nhập khẩu/ thương nhân</label>
                                    <input type="text" class="form-control form-control-lg" id="import_address"
                                           name="import_address"
                                           value="{{$product->import_address}}" placeholder="Nhập tên địa chỉ đơn vị">
                                    @error('import_address')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Ngày sản xuất / ngày nhập khẩu</label>
                                    <input type="date" class="form-control form-control-lg" id="import_date"
                                           name="import_date"
                                           value="{{$product->import_date}}"
                                           placeholder="Nhập tên thương hiệu">
                                    @error('import_date')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Kiểu đóng gói <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" name="packing_type" id="packing_type">
                                        <option disabled selected>Lựa chọn kiểu đóng gói</option>
                                        <option value="1" {{$product->packing_type == 1 ? 'selected' : ''}}>Túi</option>
                                        <option value="2" {{$product->packing_type == 2 ? 'selected' : ''}}>Hộp</option>
                                        <option value="3" {{$product->packing_type == 3 ? 'selected' : ''}}>Thùng
                                        </option>
                                        <option value="4" {{$product->packing_type == 4 ? 'selected' : ''}}>Bao Bì
                                        </option>
                                    </select>
                                    @error('packing_type')
                                    <p class="text-danger mt-2 ml-1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mx-auto my-4">
                                <button class="btn btn-secondary" type="button" onclick="location.reload()">Hủy bỏ
                                </button>
                                <button class="btn btn-primary ml-2" id="btnSave">Lưu thay đổi</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('custom_js')
    <script src="{{ asset('plupload/js/plupload.full.min.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/eipbi8bjib571v1w6eywh5ua9w3i7mik7k6afn65tew8m0fe/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script async>
        tinymce.init({
            selector: '#editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                  Note: In modern browsers input[type="file"] is functional without
                  even adding it to the DOM, but that might not be the case in some older
                  or quirky browsers like IE, so you might want to add it to the DOM
                  just in case, and visually hide it. And do not forget do remove it
                  once you do not need it anymore.
                */

                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        fetch('{{route('upload')}}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                                // 'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: JSON.stringify({file: reader.result}) // body data type must match "Content-Type" header
                        }).then(res => res.json())
                            .then(data => {
                                var blobInfo = blobCache.create(id, file, data);
                                blobCache.add(blobInfo);
                                /* call the callback and populate the Title field with the file name */
                                cb(data, {title: file.name});
                            });

                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

        });
    </script>

    @if(\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{\Illuminate\Support\Facades\Session::get('success')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{\Illuminate\Support\Facades\Session::get('error')}}',
                text: 'Click vào nút bên dưới để đóng',
            })
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function () {
            var path = "{{ asset('/plupload/js/') }}";

            var uploader = new plupload.Uploader({
                browse_button: 'pickfiles',
                container: document.getElementById('file-input'),
                url: '{{ route("chunk.store") }}',
                chunk_size: '1MB', // 1 MB
                max_retries: 2,
                filters: {
                    max_file_size: '200mb',
                    mime_types: [
                        {title: "Video files", extensions: "AVI,MP4,MKV,WMV,VOB,FLV"},
                    ],
                },
                multipart_params: {
                    // Extra Parameter
                    "_token": "{{ csrf_token() }}"
                },
                init: {
                    PostInit: function () {
                        document.getElementById('filelist').innerHTML = '';
                    },
                    FilesAdded: function (up, files) {
                        plupload.each(files, function (file) {
                            document.getElementById('filelist').innerHTML = '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                        });
                        uploader.start();
                    },
                    UploadProgress: function (up, file) {
                        document.querySelector('#btnSave').setAttribute('disabled', 'true');
                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    },
                    FileUploaded: function (up, file, result) {

                        responseResult = JSON.parse(result.response);

                        if (responseResult.ok == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Xem chi tiết sản phẩm thất bại !',
                                text: responseResult.info,
                            })
                        }
                        if (result.status != 200) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload video không thành công !',
                                text: '',
                            })
                        }
                        if (responseResult.ok == 1 && result.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Upload video thành công !',
                                text: '',
                            })
                            document.querySelector('#btnSave').removeAttribute('disabled');
                            $('#videoSuccess').val("storage/products/" + JSON.parse(result.response).video)

                        }
                    },
                    UploadComplete: function (up, file) {
                        const fileInput = document.querySelector('#pickfiles');

                        // Create a new File object
                        const myFile = new File(['Hello World!'], file[file.length - 1].name, {
                            type: 'mp4/plain',
                            lastModified: new Date(),
                        });

                        // Now let's create a DataTransfer to get a FileList
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(myFile);
                        fileInput.files = dataTransfer.files;
                    },
                    Error: function (up, err) {
                        // DO YOUR ERROR HANDLING!
                        let stringError = 'Upload video không thành công !';
                        if (err.message == 'File extension error.')
                            stringError = "Hãy chọn video hợp lệ !";
                        Swal.fire({
                            icon: 'error',
                            title: stringError,
                            text: '',
                        })
                    }
                }
            });
            uploader.init();
        });
        document.querySelector('#images').addEventListener('change', (e) => {
            let error = document.querySelector("#error");

            error.innerHTML = "";
            if (e.target.files) {
                console.log(e.target.files)
                for (let i = 0; i < e.target.files.length; i++) {
                    let file = e.target.files[i];
                    let allowedImageTypes = ["image/jpeg", "image/gif", "image/png", "image/jpg"];
                    if (!allowedImageTypes.includes(file.type)) {
                        error.innerHTML = "Đuôi file được cho phép là: [ .jpg .png .gif ]";
                        document.querySelector('#btnSave').setAttribute('disabled', 'true');
                        return false;
                    }
                    if (file.size > 1024 * 1024 * 5) {
                        error.innerHTML = "File ảnh upload không quá 5MB";
                        document.querySelector('#btnSave').setAttribute('disabled', 'true');
                        return false;
                    }


                    document.querySelector('#btnSave').removeAttribute('disabled');

                }

            }
        })

    </script>
@endsection
