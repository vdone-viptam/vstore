@extends('layouts.manufacture.main')
@section('page_title','Sửa thông tin sản phẩm')

@section('modal')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="modal modal-success flex justify-center items-center show-modal">
            <div class="over-lay-modal" onclick="$('.modal-success').toggleClass('show-modal')"></div>
            <div
                class="information bg-[white] flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-success').toggleClass('show-modal')"
                     class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                        fill="white"/>
                </svg>

                <div class="content pt-3 px-3 text-center flex flex-col gap-6">
                    <div class="w-[262px] h-[262px] mx-auto">
                        <img src="{{asset('asset/images/success.gif')}}" class="w-full" alt="">
                    </div>
                    <h2 class="text-title text-2xl font-medium">{{\Illuminate\Support\Facades\Session::get('success')}}
                        !</h2>
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
        <span class="text-secondary whitespace-nowrap">Sản phẩm</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="" class="text-blueMain font-medium whitespace-nowrap italic">Sửa thông tin sản
            phẩm</a>
    </div>
    <div class="px-5 xl:px-16 py-2">
        <h2 class="text-xl md:text-3xl font-medium flex items-center gap-4">
            <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.4"
                      d="M9.98897 20.501L1.87431 24.4191C1.26151 24.7407 0.497103 24.526 0.154355 23.9361C0.0542551 23.7506 0.0013219 23.5445 0 23.3349V14.5648C0 15.4343 0.507167 15.971 1.84123 16.5722L9.98897 20.501Z"
                      fill="url(#paint0_linear_98_611)"/>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M6.11907 0.416626H13.8368C17.2216 0.416626 19.9669 1.70477 20 5.00028V23.3349C19.9986 23.541 19.9457 23.7437 19.8456 23.9253C19.6849 24.2216 19.4074 24.4415 19.0768 24.5347C18.7462 24.6278 18.391 24.5861 18.0926 24.4191L9.98897 20.501L1.84123 16.5721C0.507167 15.971 0 15.4343 0 14.5648V5.00028C0 1.70477 2.74531 0.416626 6.11907 0.416626ZM5.28115 9.62687H14.6858C15.2277 9.62687 15.667 9.19913 15.667 8.67149C15.667 8.14386 15.2277 7.71612 14.6858 7.71612H5.28115C4.73921 7.71612 4.29989 8.14386 4.29989 8.67149C4.29989 9.19913 4.73921 9.62687 5.28115 9.62687Z"
                      fill="url(#paint1_linear_98_611)"/>
                <defs>
                    <linearGradient id="paint0_linear_98_611" x1="4.99449" y1="14.5648" x2="4.99449" y2="24.5684"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#7280FD"/>
                        <stop offset="0.0001" stop-color="#1E90FF"/>
                        <stop offset="1" stop-color="#4062FF"/>
                    </linearGradient>
                    <linearGradient id="paint1_linear_98_611" x1="10" y1="0.416626" x2="10" y2="24.5833"
                                    gradientUnits="userSpaceOnUse">
                        <stop stop-color="#7280FD"/>
                        <stop offset="0.0001" stop-color="#1E90FF"/>
                        <stop offset="1" stop-color="#4062FF"/>
                    </linearGradient>
                </defs>
            </svg>
            Sửa thông tin sản phẩm
        </h2>
    </div>

    <form action="{{route('screens.manufacture.product.update',['id' => $product->id])}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1  gap-y-4 lg:gap-4 px-5 xl:px-16 py-4">
            <div class=" flex flex-col justify-start items-start gap-4 p-5 ">
                <h4 class="font-medium text-[#141414] text-2xl">Thông tin cơ bản</h4>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 w-full">
                    <div class="col-span-4 flex flex-col justify-start items-start gap-4">

                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Tên sản phẩm<strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <input type="text" placeholder="Nhập tên sản phẩm" name="name" id="name"
                                   value="{{$product->name}}"
                                   class="outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('name')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-4 flex flex-col justify-start items-start gap-4 w-full">
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Chọn ngành hàng <strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <select name="category_id" id="category_id"
                                    class="h-[42px] choose-vstore text-opa outline-none w-full px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                <option value="" disabled selected>Chọn ngành hàng</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}"
                                        @if($category->id ==$product->category_id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-4 flex flex-col justify-start items-start gap-4">

                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Giá sản phẩm<strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <input type="text" placeholder="Nhập giá sản phẩm" id="price"
                                   value="{{number_format($product->price,0,',',',')}}"
                                   class="h-[42px] outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('price')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-title font-medium">Tóm tắt sản phẩm<strong
                            class="text-[#FF4D4F]">*</strong></span>
                    <textarea name="description" id="description" style="width: 100% !important;;height: 750px;"
                              class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">{{$product->description}}</textarea>
                    @error('description')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex flex-col md:flex-row justify-start items-start gap-2 w-full">
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
                    <br>

                </div>
                @error('images')
                <p class="text-red-600">{{$message}}</p>
                @enderror
                <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <label for="">SKU</label>
                    <input type="text" value="{{$product->sku_id}}"
                           class="outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"
                           name="sku" id="sku">
                </div>
                @error('sku')
                <p class="text-red-600">{{$message}}</p>
                @enderror
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
                                   value="{{$product->brand}}"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('brand')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Chất liệu<strong
                                    class="text-[#FF4D4F]">*</strong></span>
                            <input type="text" id="material" name="material"
                                   placeholder="Nhập chất liệu sản phẩm" value="{{$product->material}}"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('material')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Trọng lượng (Gram)<strong
                                class="text-[#FF4D4F]">*</strong></span>
                            <input type="number" name="weight" id="weight" min="0" max=""
                                   placeholder="Nhập trọng lượng sản phẩm (Gram)" value="{{$product->weight}}"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('weight')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Tên tổ chức chịu trách nhiệm sản xuất</span>
                            <input type="text" id="manufacturer_name" name="manufacturer_name"
                                   value="{{$product->manufacturer_name}}"
                                   placeholder="Nhập tên tổ chức"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('manufacturer_name')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Tên đơn vị chịu trách nhiệm nhập khẩu</span>
                            <input type="text" id="unit_name" name="unit_name" value="{{$product->unit_name}}"
                                   placeholder="Nhập tên đơn vị"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('unit_name')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class=" flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Ngày sản xuất / ngày nhập khẩu</span>
                            <input type="date" min="2018-01-01" name="import_date" value="{{$product->import_date}}"
                                   placeholder="Nhập ngày sản xuất hoặc nhập khẩu"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">

                        </div>
                    </div>
                    <div class="col-span-6 flex flex-col justify-start items-start gap-4 ">
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Xuất xứ <strong
                                    class="text-[#FF4D4F]">*</strong></span>
                            <input type="text" name="origin" id="origin" placeholder="Nhập xuất xứ"
                                   value="{{$product->origin}}"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('origin')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>


                        <div>
                            <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span class="text-title font-medium">Kích cỡ (Cm)<strong
                                        class="text-[#FF4D4F]">*</strong></span>

                                <div class="flex justify-between items-center w-full gap-6">
                                    <div class="flex flex-col">
                                        <input type="number" min="0" placeholder="Nhập chiều dài (cm)"
                                               name="length"
                                               value="{{$product->length}}"
                                               id="length"
                                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                        @error('length')
                                        <p class="text-red-600">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col">
                                        <input type="number" min="0" placeholder="Nhập chiều rộng (cm)"
                                               name="with"
                                               value="{{$product->with}}"
                                               id="with"
                                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                        @error('with')
                                        <p class="text-red-600">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col">
                                        <input type="number" min="0" placeholder="Nhập chiều cao (cm)"
                                               name="height"
                                               value="{{$product->height}}"
                                               id="height"
                                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                        @error('height')
                                        <p class="text-red-600">{{$message}}</p>
                                        @enderror
                                    </div>

                                </div>

                            </div>


                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Thể tích (ml)</span>
                            <input type="text" placeholder="Nhập thể tích sản phẩm" name="volume" id="volume"
                                   value="{{$product->volume}}"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('volume')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Địa chỉ tổ chức chịu trách nhiệm sản xuất</span>
                            <input type="text" placeholder="Nhập địa chỉ tổ chức" name="import_unit" id="import_unit"
                                   value="{{$product->import_unit}}"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('import_unit')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Địa chỉ đơn vị chịu trách nhiệm nhập khẩu</span>
                            <input type="text" placeholder="Nhập tên địa chỉ đơn vị" name="import_address"
                                   value="{{$product->import_address}}"
                                   id="import_address"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            @error('import_address')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <input type="hidden" id="oldImage" value="{{$images}}">
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Kiểu đóng gói<strong
                                    class="text-[#FF4D4F]">*</strong></span>
                            <select name="packing_type" id="packing_type"
                                    class=" outline-none w-full py-[11px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                <option value="">Lựa chọn kiểu đóng gói</option>
                                <option value="1" {{1 == $product->packing_type ? 'selected' : ''}}>Túi</option>
                                <option value="2" {{2 ==$product->packing_type ? 'selected' : ''}}>Bao</option>
                                <option value="3" {{3 == $product->packing_type ? 'selected' : ''}}>Hộp</option>
                            </select>
                            @error('packing_type')
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <input type="hidden" name="price" value="{{$product->price}}">

                <div class="flex justify-center md:justify-center items-center gap-5  w-full">
                    <a href="{{route('screens.manufacture.product.index')}}"
                       class="outline-none rounded-xl  px-[20px] md:px-[45px] py-2 transition-all duration-500 hover:opacity-70 text-[#1D1D1D] bg-[#C6E6FF]">
                        Hủy
                        bỏ
                    </a>
                    <button
                        class="btnGra outline-none rounded-xl  px-[20px] md:px-[45px] py-2 transition-all duration-500 hover:opacity-70 text-white">
                        Lưu thay đổi
                    </button>
                </div>
            </div>


        </div>
    </form>

@endsection

@section('custom_js')
    <script src="https://cdn.tiny.cloud/1/eipbi8bjib571v1w6eywh5ua9w3i7mik7k6afn65tew8m0fe/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script async>
        tinymce.init({
            selector: '#description',
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
                        fetch('{{route('upload')}}?_token={{csrf_token()}}', {
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
    <script>
        $(".js-example-tags").select2({
            tags: true
        });

        let i = 1;

        let arrImage = JSON.parse(document.getElementById('oldImage').value);
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
            console.log(data)
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

        render(arrImage);

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
        document.querySelector('#price').addEventListener("keypress", (e) => {
            var regex = new RegExp("^[0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
        document.querySelector('#price').addEventListener("keyup", (e) => {
            if (e.target.value) {
                value = new Intl.NumberFormat('en-US', {
                    style: "currency",
                    currency: "USD",
                    maximumFractionDigits: 0
                }).format((e.target.value.replaceAll(',', '')));
                // document.getElementById('price').value = value.replaceAll('$', '');

                document.getElementsByName('price')[0].value = value.replaceAll('$', '').replaceAll(',', '');
                ;
                document.getElementById('price').value = value.replaceAll('$', '')
            }
        });
    </script>
@endsection
