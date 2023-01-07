@extends('layouts.main')

@section('content')
    <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
        <span class="text-secondary">Sản phẩm</span>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                  stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <a href="../them-san-pham/" class="text-blueMain font-medium">Thêm sản phẩm</a>
    </div>
    <div class="px-5 xl:px-16 py-2">
        <h2 class="text-4xl text-title font-medium">Thêm sản phẩm mới</h2>
    </div>
    <form action="{{route('screens.product.store',['type' => $type])}}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 lg:gap-4 px-5 xl:px-16 py-4">
            <div class="order-last lg:order-first col-span-8">
                <div class="box-act flex flex-col justify-start items-start gap-4 p-5">
                    <h4 class="font-medium text-[#141414] text-2xl">Thông tin cơ bản</h4>
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Tên sản phẩm</span>
                        <input type="text" placeholder="Vui lòng nhập tên sản phẩm" name="name" id="name"
                               class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                    </div>
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Loại sản phẩm</span>
                        <select name="cate_id" id="cate_id"
                                class="outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                            <option value="0">Chọn loại sản phẩm</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-between items-center gap-6 w-full flex-wrap md:flex-nowrap">
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Giá bán</span>
                            <input type="text" placeholder="Nhập giá bán (đ)" name="price" id="price"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Giá vốn</span>
                            <input type="text" placeholder="Nhập giá vốn (đ)" id="cost_price" name="cost_price"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        </div>
                    </div>
                    <div class="flex justify-between items-center gap-6 w-full flex-wrap md:flex-nowrap">
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Mã vạch</span>
                            <input type="text" placeholder="Nhập số mã vạch" name="barcode" id="barcode"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        </div>
                        <div class="flex flex-col justify-start items-start gap-2 w-full">
                            <span class="text-title font-medium">Mã sản phẩm SKU</span>
                            <input type="text" placeholder="Nhập mã SKU" name="sku" id="sku"
                                   class=" outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                        </div>
                    </div>
                    <div class=" p-5 bg-[#FFF] rounded-xl w-full">
                        <div class="flex justify-between items-start gap-6 w-full flex-wrap md:flex-nowrap">
                            <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span class="text-title font-medium">Thương hiệu</span>
                                <select name="trademark_id" id="trademark_id"
                                        class="th js-example-tags text-opa outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                    <option value="0">Chọn thương hiệu hoặc thêm mới</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                                <span>Thông tin thương hiệu trái phép chỉ được sử dụng cho mục đích thống kê và sẽ không được hiển thị cho khách hàng. Nếu bạn muốn tiết lộ thương hiệu này cho khách hàng, vui lòng đăng ký <a
                                        href="#"
                                        class="text-[#1D39C4] font-medium hover:opacity-70 transition-all duration-300">Ủy quyền thương hiệu</a></span>
                            </div>
                            <div class="flex flex-col justify-start items-start gap-2 w-full">
                                <span class="text-title font-medium">Xuất xứ <span class="text-secondary font-normal">(Tùy chọn)</span></span>
                                <select name="origin_id" id="origin_id"
                                        class="outline-none w-full py-2 px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">
                                    <option value="0">Chọn thương hiệu hoặc thêm mới</option>
                                    @foreach($origins as $origin)
                                        <option value="{{$origin->id}}">{{$origin->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-more ">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis odio magni minus deleniti
                            ex
                            minima ratione odit, laborum voluptatum non aliquam maiores rerum hic. Ducimus quia
                            praesentium
                            ipsa labore quasi?
                        </div>
                        <div class="w-full pt-6 text-center">
                            <button type="button"
                                class="show-b-more flex justify-center items-center w-full gap-2 text-secondary outline-none hover:opacity-70 transition-all duration-200">
                                <span>Xem thêm</span>
                                <svg width="15" height="9" viewBox="0 0 15 9" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 8.43115C7.70752 8.43115 7.91504 8.34814 8.05615 8.19043L14.481 1.60791C14.6221 1.4668 14.7051 1.28418 14.7051 1.07666C14.7051 0.64502 14.3813 0.312988 13.9497 0.312988C13.7422 0.312988 13.5513 0.395996 13.4102 0.528809L7.5 6.57178L1.58154 0.528809C1.44873 0.395996 1.25781 0.312988 1.04199 0.312988C0.610352 0.312988 0.286621 0.64502 0.286621 1.07666C0.286621 1.28418 0.369629 1.4668 0.510742 1.61621L6.93555 8.19043C7.09326 8.34814 7.28418 8.43115 7.5 8.43115Z"
                                        fill="black" fill-opacity="0.45"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex justify-start items-center gap-2">
                        <span class="text-title font-medium">Còn hàng</span>
                        <div class="check-radio">
                            <div class="toggle-pill ">
                                <input type="checkbox" id="pill1" name="status" checked="">
                                <label for="pill1"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center flex-wrap md:flex-nowrap md:justify-end items-center gap-5 py-10">
                    <button
                        class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 text-title">
                        Hủy bỏ
                    </button>
                    <button
                        class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 text-title">
                        Lưu nháp
                    </button>
                    <button type="submit"
                        class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-[15px] py-[6px] transition-all duration-500 hover:opacity-70 bg-primary text-[#FFF]">
                        Tiếp tục
                    </button>
                </div>
            </div>
            <div class="order-first lg:order-last col-span-4">
                <div class="flex flex-col justify-start items-start gap-4 w-full">
                    <div class="box-act p-5 w-full">
                        <div class="flex flex-col justify-start items-start gap-3 w-full">
                            <span class="text-title font-medium">Quá trình hoàn thành</span>
                            <div class="flex justify-start items-center gap-2 w-full">
                            <span class="process w-full max-w-[243px] h-[8px] rounded-[100px] relative bg-[#F5F5F5]">

                            </span>
                                <span class="text-title text-sm">2%</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-act p-5 w-full">
                        <div class="flex flex-col justify-start items-start gap-3 w-full">
                            <span class="text-title font-medium">Bảng nội dung</span>
                            <ul class="tab-side flex flex-col justify-start items-start w-full">
                                <li class="active"><a href="..">Thông tin cơ bản</a></li>
                                <li><a href="./chi-tiet-san-pham.html">Thông tin chi tiết sản phẩm</a></li>
                                <li><a href="./thong-tin-ban-hang.html">Thông tin bán hàng</a></li>
                                <li><a href="./van-chuyen.html">Vận chuyển & Bảo hành</a></li>
                            </ul>
                        </div>
                    </div>
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
    </script>
@endsection
