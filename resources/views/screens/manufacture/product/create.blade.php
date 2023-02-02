@extends('layouts.manufacture.main')

@section('modal')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="modal modal-pend flex justify-center items-center show-modal">
            <div class="over-lay-modal" onclick="$('.modal-pend').toggleClass('show-modal')"></div>
            <div
                class="information success flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px] h-[400px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-pend').toggleClass('show-modal')"
                     class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                        fill="white"/>
                </svg>

                <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
                    <h2 class="text-title text-2xl font-medium">Yêu cầu thêm sản phẩm đã được gửi đến nhà cung cấp
                        bạn đăng ký.</h2>

                </div>
            </div>
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <div class="modal modal-pend flex justify-center items-center show-modal">
            <div class="over-lay-modal" onclick="$('.modal-pend').toggleClass('show-modal')"></div>
            <div
                class="information failed flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px] h-[400px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-pend').toggleClass('show-modal')"
                     class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                        fill="white"/>
                </svg>

                <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
                    <h2 class="text-title text-2xl font-medium">Có lỗi xảy ra, vui lòng thử lại !</h2>

                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Sản phẩm</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="./them-san-pham.html" class="text-blueMain font-medium">Yêu cầu thêm sản phẩm</a>
    </div>
    <div class="px-5 xl:px-16 py-2">
        <h2 class="text-4xl text-title font-medium">Yêu cầu xét duyệt sản phẩm</h2>


    </div>

    <form action="{{route('screens.manufacture.product.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1  gap-y-4 lg:gap-4 px-5 xl:px-16 py-4">
            <div class="box-act flex flex-col justify-start items-start gap-4 p-5 shadow-lg">
                <h4 class="font-medium text-[#141414] text-2xl">Thông tin cơ bản</h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 w-full">
                    <div class="col-span-6 flex flex-col justify-start items-start gap-4">
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Chọn V-Store<strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <select name="vstore_id" id="vstore_id"
                                    class="th choose-vstore text-opa outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                <option value="0">Chọn V-Store</option>
                                @foreach($v_stores as $v_store)
                                    <option value="{{$v_store->id}}">{{$v_store->name}}</option>
                                @endforeach
                            </select>
                            @error('vstore_id')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Tên sản phẩm<strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <input type="text" placeholder="Nhập tên sản phẩm" name="name" id="name"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('name')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-6 flex flex-col justify-start items-start gap-4 w-full">

                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Mức chiết khấu (%)<strong class="text-[#FF4D4F]">*</strong>
                        </span>
                            <span>
                                <input type="number" name="discount" id="discount" min="0" max="99"
                                       placeholder="Nhập mức chiết khấu (%)"
                                       class=" outline-none w-[250px] py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            </span>

                            @error('discount')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Chọn ngành hàng <strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <select name="category_id" id="category_id"
                                    class="th choose-vstore text-opa outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                <option value="">Chọn ngành hàng</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                </div>


                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-title font-medium">Mô tả sản phẩm<strong class="text-[#FF4D4F]">*</strong></span>
                    <textarea name="description" id="description"
                              class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"></textarea>
                    @error('description')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex justify-start items-start gap-2 w-full">
                    <span class="text-title font-medium">Hình ảnh sản phẩm<strong
                            class="text-[#FF4D4F]">*</strong></span>
                    <div class="file-sp flex justify-center items-start gap-4 flex-wrap md:justify-start">

                    </div>
                    <input type="hidden" id="images" name="images">
                    <div
                        class="cursor-pointer add-img-SP w-[104px] h-[104px] border-2 border-dashed bg-[#FAFAFA] border-secondary flex justify-center flex-col items-center rounded-sm gap-1">
                        <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                fill="black" fill-opacity="0.85"/>
                        </svg>
                        <span class="text-sm text-secondary">Tải hình ảnh</span>
                        <span class="text-xs text-secondary" id="countImage"> 0/5</span>
                    </div>

                </div>
                <label for="">Video sản phẩm</label>
                <div class="flex justify-start items-start gap-2 w-full">
                    <input type="file" accept="video/mp4"
                           class="outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                           name="video" id="video">
                </div>
                <h4 class="font-medium text-[#141414] text-2xl">Thông tin chi tiết</h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 w-full ">
                    <div class="col-span-6 flex flex-col justify-start items-start gap-4">
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Tên thương hiệu<strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <input type="text" name="brand" id="brand" placeholder="Nhập tên thương hiệu"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('brand')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Trọng lượng (Gram)<strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <input type="number" name="weight" id="weight" min="0" max=""
                                   placeholder="Nhập trọng lượng sản phẩm (Gram)"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('weight')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Kiểu đóng gói</span>
                            <select name="packing_type" id="packing_type" placeholder="Nhập kiểu đóng gói sản phẩm"
                                    class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                <option value="">Lựa chọn kiểu đóng gói</option>
                                <option value="1">Túi</option>
                                <option value="2">Bao</option>
                                <option value="3">Hộp</option>
                            </select>
                            @error('packing_type')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Đơn vị</span>
                            <select name="unit" id="unit"
                                    class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                <option value="0">Doanh nghiệp</option>
                                <option value="1">Hợp tác xã</option>
                                <option value="2">Hộ kinh doanh cá thể</option>
                            </select>
                            @error('unit')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Tên đơn vị</span>
                            <input type="text" id="unit_name" name="unit_name"
                                   placeholder="Nhập tên tổ chức"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('unit_name')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                                  <span class="text-title font-medium">Ảnh chứng minh<strong
                                          class="text-[#FF4D4F]">*</strong></span>
                            <div class="file-sp-1 flex justify-center items-start gap-4 flex-wrap md:justify-start">

                            </div>
                            <input type="hidden" id="unitImages" name="unitImages">
                            <div
                                class="cursor-pointer add-img-Uni w-[104px] h-[104px] border-2 border-dashed bg-[#FAFAFA] border-secondary flex justify-center flex-col items-center rounded-sm gap-1">
                                <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                        fill="black" fill-opacity="0.85"/>
                                </svg>
                                <span class="text-sm text-secondary">Tải hình ảnh</span>
                                <span class="text-xs text-secondary" id="countImage1"> 0/5</span>
                            </div>

                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Tên tổ chức chịu trách nhiệm sản xuất</span>
                            <input type="text" id="manufacturer_name" name="manufacturer_name"
                                   placeholder="Nhập tên tổ chức"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('manufacturer_name')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Tên đơn vị chịu trách nhiệm nhập khẩu</span>
                            <input type="text" id="manufacturer_address" name="manufacturer_address"
                                   placeholder="Nhập tên đơn vị"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('manufacturer_address')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-6 flex flex-col justify-start items-start gap-4 ">
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Xuất xứ </span>
                            <input type="text" name="origin" id="origin" placeholder="Nhập xuất xứ"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('origin')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span class="text-title font-medium">Kích cỡ (Cm)</span>

                                <div class="flex justify-between items-center w-full gap-6">
                                    <input type="number" min="0" max="" placeholder="Nhập chiều dài (cm)" name="length"
                                           id="length"
                                           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">

                                    <input type="number" min="0" max="" placeholder="Nhập chiều rộng (cm)" name="with"
                                           id="with"
                                           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                    <input type="number" min="0" max="" placeholder="Nhập chiều cao (cm)" name="height"
                                           id="height"
                                           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">

                                </div>

                            </div>


                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Thể tích (Lít)</span>
                            <input type="text" placeholder="Nhập thể tích sản phẩm" name="volume" id="volume"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('volume')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Địa chỉ tổ chức chịu trách nhiệm sản xuất</span>
                            <input type="text" placeholder="Nhập địa chỉ tổ chức" name="import_unit" id="import_unit"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('import_unit')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Địa chỉ đơn vị chịu trách nhiệm nhập khẩu</span>
                            <input type="text" placeholder="Nhập tên địa chỉ đơn vị" name="import_address"
                                   id="import_address"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('import_address')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <h4 class="font-medium text-[#141414] text-2xl">Thông tin bán hàng</h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 w-full">
                    <div class="col-span-6 flex flex-col justify-start items-start gap-4">


                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Giá(chưa bao gồm VAT)<strong
                                    class="text-[#FF4D4F]">*</strong></span>
                            <input type="number" placeholder="Nhập giá sản phẩm" name="price" id="price"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('price')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        {{--                        <div class="flex flex-col justify-start items-start gap-2 w-full">--}}
                        {{--                            <span class="text-title font-medium">Mua nhiều giảm giá</span>--}}
                        {{--                            <input type="text" placeholder="Nhập số sản phẩm mua ít nhất để được giảm giá"--}}
                        {{--                                   name="amount_product_send_to_discount" id="amount_product_send_to_discount"--}}
                        {{--                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">--}}
                        {{--                            @error('amount_product_send_to_discount')--}}
                        {{--                            <p class="text-red-600">{{$message}}</p>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}
                        {{--                        <div class="flex flex-col justify-start items-start gap-2 w-full">--}}
                        {{--                            <span class="text-title font-medium">Phần trăm giảm giá (%)</span>--}}
                        {{--                            <input type="text" placeholder="Số phần trăm giảm giá" id="percent_discount"--}}
                        {{--                                   name="percent_discount"--}}
                        {{--                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">--}}
                        {{--                            @error('percent_discount')--}}
                        {{--                            <p class="text-red-600">{{$message}}</p>--}}
                        {{--                            @enderror--}}
                        {{--                        </div>--}}
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Ngày sản xuất / ngày nhập khẩu</span>
                            <input type="datetime-local" min="2018-01-01" name="import_date"
                                   placeholder="Nhập ngày sản xuất hoặc nhập khẩu"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">

                        </div>
                    </div>
                    <div class="col-span-6 flex flex-col justify-start items-start gap-4">
                        {{--                        <div class="flex flex-col justify-start items-start gap-2 w-full">--}}
                        {{--                            <span class="text-title font-medium">Ngày sản xuất / ngày nhập khẩu</span>--}}
                        {{--                            <input type="datetime-local" min="2018-01-01"  name="import_date"--}}
                        {{--                                   placeholder="Nhập ngày sản xuất hoặc nhập khẩu"--}}
                        {{--                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">--}}

                        {{--                        </div>--}}


                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">SKU sản phẩm</span>
                            <input type="text" placeholder="Nhập SKU sản phẩm" name="sku_id" id="sku_id"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        </div>

                        @error('sku_id')
                        <p class="text-red-600">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col justify-start items-start gap-4 w-full">
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-title font-medium">Địa chỉ kho hàng<strong
                            class="text-[#FF4D4F]">*</strong></span>
                    </div>
                    <div class=" choose-adr choose-adr grid grid-cols-1 gap-4 w-full ">
                        <div class=" char p-4 item flex flex-col justify-start items-start gap-4 w-full ">
                            <div class="flex justify-between items-center w-full">
                                <span class="text-title text-lg font-medium">Địa chỉ 1 :</span>
                                <svg width="16" height="16" class="cursor-pointer hover:opacity-70" viewBox="0 0 16 16"
                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                                        fill="black" fill-opacity="0.45"/>
                                </svg>
                            </div>
                            <div class="content-item grid grid-cols-2 gap-6 w-full">
                                <div class="flex justify-start items-center gap-2 w-full">
                                <span class="text-title font-medium text-sm w-[250px]">Địa chỉ kho hàng:<strong
                                        class="text-[#FF4D4F]">*</strong></span>
                                    <select name="ward_id[]" id=""
                                            class="ward_id text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                        <option value="0" selected>Chọn địa chỉ kho hàng</option>
                                        @foreach($wareHouses as $ware)
                                            <option value="{{$ware->id}}">{{$ware->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex justify-start items-center gap-2 w-full">
                                <span class="text-title font-medium text-sm w-[250px]">Số lượng hàng trong kho<strong
                                        class="text-[#FF4D4F]">*</strong></span>
                                    <input type="number" placeholder="Nhập số lượng hàng trong kho" name="amount[]"
                                           class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                </div>
                            </div>
                        </div>
                        <div class="more-ad w-[210px]">
                            <a href="javascript:void(0)"
                               class=" outline-none border-[1px] border-primary rounded-sm px-4 flex justify-start items-center gap-2 text-secondary text-lg hover:text-primary transition-all duration-200">
                                <div class="w-[20px] h-[20px]"><img src="{{asset('asset/images/plus.png')}}" alt=""
                                                                    class="w-full">
                                </div>
                                Thêm địa chỉ mới
                            </a>
                        </div>


                    </div>
                </div>
                <h4 class="font-medium text-[#141414] text-2xl">Thanh toán</h4>
                <div class="flex flex-col justify-start items-start gap-4">
                <span class="text-title font-medium">Phương thức thanh toán<strong
                        class="text-[#FF4D4F]">*</strong></span>
                    <div class="flex justify-start items-center gap-4 flex-wrap">
                        <div>
                            <input type="checkbox" name="prepay" class="accent-primary w-4 h-4">
                            <span class="text-secondary">Thanh toán trước</span>
                        </div>
                        <div>
                            <input type="checkbox" name="payment_on_delivery" class="accent-primary w-4 h-4">
                            <span class="text-secondary">Thanh toán sau khi nhận hàng</span>
                        </div>

                    </div>
                </div>
                <div class="flex justify-center flex-wrap md:flex-nowrap md:justify-center items-center gap-5  w-full">
                    <a href="{{route('screens.manufacture.product.index')}}"
                       class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 text-title">
                        Hủy
                        bỏ
                    </a>
                    <button
                        class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 bg-primary text-[#FFF]">
                        Đăng
                        ký
                    </button>
                </div>
            </div>


        </div>
    </form>

@endsection

@section('custom_js')
    <script>
        $(".js-example-tags").select2({
            tags: true
        });
        let i = 1;
        let arrImage = [];
        let arrUnit = [];
        $('.choose-vstore').select2();

        function render(data) {
            const html = data.map((item, index) => {
                return `<div class="item w-[104px] h-[104px] flex justify-center items-center relative">
                    <div class="over-lay"></div>
                    <svg width="16" height="16" data-index="${index}" class="deleteImg cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
</svg>
                <img src="${item}" class="w-full h-full"></img></div>`;
            }).join("")
            $('.file-sp').html(html);
            document.getElementById('countImage').innerHTML = data.length +
                '/5';

            document.getElementById('images').value = JSON.stringify(data);
            document.querySelectorAll('.deleteImg').forEach(item => {
                const {index} = item.dataset;
                item.addEventListener('click', () => {
                    arrImage = data.filter((item1, index1) => index1 !== +index);
                    if (arrImage.length < 5) {
                        document.querySelector('.add-img-SP').classList.remove('hidden');
                    }
                    render(arrImage);
                })
            })
        }

        function render2(data) {
            const html = data.map((item, index) => {
                return `<div class="item w-[104px] h-[104px] flex justify-center items-center relative">
                    <div class="over-lay"></div>
                    <svg width="16" height="16" data-index="${index}" class="deleteImg1 cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
</svg>
                <img src="${item}" class="w-full h-full"></img></div>`;
            }).join("")
            $('.file-sp-1').html(html);
            document.getElementById('countImage1').innerHTML = data.length +
                '/5';

            document.getElementById('unitImages').value = JSON.stringify(data);
            document.querySelectorAll('.deleteImg1').forEach(item => {
                const {index} = item.dataset;
                item.addEventListener('click', () => {
                    console.log(1)
                    arrUnit = data.filter((item1, index1) => index1 !== +index);
                    if (arrUnit.length < 5) {
                        document.querySelector('.add-img-Uni').classList.remove('hidden');
                    }
                    render2(arrUnit);
                })
            })
        }

        $('.add-img-SP').on('click', function () {
            let input = document.createElement('input');
            input.type = 'file';
            input.onchange = _ => {
                var files = Array.from(input.files);
                const reader = new FileReader();

                return new Promise(resolve => {
                    reader.onload = ev => {
                        resolve(ev.target.result)
                        arrImage.push(ev.target.result);
                        if (arrImage.length == 5) {
                            document.querySelector('.add-img-SP').classList.add('hidden');
                        }
                        render(arrImage);
                    }
                    reader.readAsDataURL(files[0])

                })
            };
            input.click();
        })
        $('.add-img-Uni').on('click', function () {
            let input = document.createElement('input');
            input.type = 'file';
            input.onchange = _ => {
                var files = Array.from(input.files);
                const reader = new FileReader();

                return new Promise(resolve => {
                    reader.onload = ev => {
                        resolve(ev.target.result)
                        arrUnit.push(ev.target.result);
                        if (arrUnit.length == 5) {
                            document.querySelector('.add-img-Uni').classList.add('hidden');
                        }
                        render2(arrUnit);
                    }
                    reader.readAsDataURL(files[0])

                })
            };
            input.click();
        })
        $('.more-ad').on('click', function () {
            $('.more-ad').remove();
            i++;
            var html = `       <div class=" char p-4 item flex flex-col justify-start items-start gap-4 w-full ">
        <div class="flex justify-between items-center w-full">
            <span class="text-title text-lg font-medium">Địa chỉ ${i} :</span>
            <svg width="16" height="16" class="remove cursor-pointer hover:opacity-70"  viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z" fill="black" fill-opacity="0.45"/>
                </svg>
        </div> <div class="content-item grid grid-cols-2 gap-6 w-full">
                                <div class="flex justify-start items-center gap-2 w-full">
                                <span class="text-title font-medium text-sm w-[250px]">Địa chỉ kho hàng:<strong
                                        class="text-[#FF4D4F]">*</strong></span>
                                    <select name="ward_id[]" id=""
                                            class="ward_id text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                        <option value="0" selected>Chọn địa chỉ kho hàng</option>
                                        @foreach($wareHouses as $ware)
            <option value="{{$ware->id}}">{{$ware->name}}</option>
                                        @endforeach
            </select>
        </div>
        <div class="flex justify-start items-center gap-2 w-full">
        <span class="text-title font-medium text-sm w-[250px]">Số lượng hàng trong kho<strong
                class="text-[#FF4D4F]">*</strong></span>
            <input type="number" placeholder="Nhập số lượng hàng trong kho" name="amount[]"
                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
        </div>
    </div>
    </div>
     <div class="new-more-ad w-[210px]">
        <a href="javascript:void(0)" class=" outline-none border-[1px] border-primary rounded-sm px-4 flex justify-start items-center gap-2 text-secondary text-lg hover:text-primary transition-all duration-200"> <div class="w-[20px] h-[20px]"><img src="{{asset('asset/images/plus.png')}}" alt="" class="w-full"></div> Thêm địa chỉ mới</a>
    </div>
`;
            $('.choose-adr').append(html);
            $(document).on("click", ".remove", function () {
                $(this).parent().parent().remove()
            });
            $(document).on("click", ".new-more-ad", function () {
                i++;
                var html = `   <div class=" char p-4 item flex flex-col justify-start items-start gap-4 w-full ">
        <div class="flex justify-between items-center w-full">
            <span class="text-title text-lg font-medium">Địa chỉ ${i} :</span>
            <svg width="16" height="16" class="remove cursor-pointer hover:opacity-70"  viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z" fill="black" fill-opacity="0.45"/>
                </svg>
        </div>
        <div class="content-item grid grid-cols-2 gap-6 w-full">
            <div class="flex justify-start items-center gap-2 w-full">
                <span class="text-title font-medium text-sm w-[250px]">Địa chỉ kho hàng:<strong class="text-[#FF4D4F]">*</strong></span>
                <select name="ware_id[]" id="ware_id[]"  class="text-title outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    <option value="0" selected>Chọn địa chỉ kho hàng</option>
                    @foreach($wareHouses as $ware)
                <option value="{{$ware->id}}">{{$ware->name}}</option>
                                    @endforeach
                </select>
            </div>
            <div class="flex justify-start items-center gap-2 w-full">
                <span class="text-title font-medium text-sm w-[250px]">Số lượng hàng trong kho<strong class="text-[#FF4D4F]">*</strong></span>
                <input type="number" id="amount[]" name="amount[]" placeholder="Nhập số lượng hàng trong kho" class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
            </div>
        </div>
    </div>
    <div class="new-more-ad w-[210px]">
        <a href="javascript:void(0)" class=" outline-none border-[1px] border-primary rounded-sm px-4 flex justify-start items-center gap-2 text-secondary text-lg hover:text-primary transition-all duration-200"> <div class="w-[20px] h-[20px]"><img src="{{asset('asset/images/plus.png')}}" alt="" class="w-full"></div> Thêm địa chỉ mới</a>
    </div>
`;
                $('.new-more-ad').remove();
                $('.choose-adr').append(html);
            });
        });
    </script>
    <script>


$("#discount").keyup(function (){
    var price = $("#price").val();
    var discount = $("#discount").val();
    var total =0;
    if(price != null){
        total = (price/100)*discount;
        $(".total").html('='+total+'VNĐ');


    }

})
$("#price").keyup(function (){
    var price = $("#price").val();
    var discount = $("#discount").val();
    var total =0;
    if(discount != null){
        total = (price/100)*discount;
        $(".total").html('='+total+'VNĐ');


    }

})
    </script>
@endsection
