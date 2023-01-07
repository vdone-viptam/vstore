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
    <form action="{{route('screens.product.store',['product_id' => $product_id,'type' => $type])}}" method="post">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-y-4 lg:gap-4 px-5 xl:px-16 py-4">
            <div class="order-last lg:order-first col-span-8">
                <div class="box-act flex flex-col justify-start items-start gap-4 p-5">
                    <h4 class="font-medium text-[#141414] text-2xl">Thông tin chi tiết</h4>
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                    <span class="text-title font-medium">Hình ảnh sản phẩm <span
                            class="text-secondary font-normal ml-2">Đề xuất: Tải lên ít nhất 3 hình ảnh để giúp người mua tìm hiểu thêm</span></span>
                        <div class="flex justify-start items-center gap-4 flex-wrap">
                            <div class="file-name flex justify-start items-start gap-4 flex-wrap md:justify-start">

                            </div>
                            <div
                                class="cursor-pointer img-info w-[152px] h-[152px] border-2 border-dashed bg-[#FAFAFA] border-btnGrey flex justify-center flex-col items-center rounded-sm gap-1">
                                <svg width="14" height="14" class="cursor-pointer" viewBox="0 0 14 14" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.46838 1.37598H6.53088C6.44755 1.37598 6.40588 1.41764 6.40588 1.50098V6.40723H1.75C1.66667 6.40723 1.625 6.44889 1.625 6.53223V7.46973C1.625 7.55306 1.66667 7.59473 1.75 7.59473H6.40588V12.501C6.40588 12.5843 6.44755 12.626 6.53088 12.626H7.46838C7.55172 12.626 7.59338 12.5843 7.59338 12.501V7.59473H12.25C12.3333 7.59473 12.375 7.55306 12.375 7.46973V6.53223C12.375 6.44889 12.3333 6.40723 12.25 6.40723H7.59338V1.50098C7.59338 1.41764 7.55172 1.37598 7.46838 1.37598Z"
                                        fill="black" fill-opacity="0.85"/>
                                </svg>
                                <span class="text-sm text-secondary">Tải hình ảnh</span>
                                <span class="text-sm text-secondary" id="countImage">0/9</span>
                            </div>
                        </div>
                    </div>
                    <input type="text" name="photo_gallery" id="photo_gallery">
                    <div class="flex flex-col justify-start items-start gap-2 w-full">
                        <span class="text-title font-medium">Mô tả sản phẩm<span
                                class="text-secondary font-normal ml-2">Đề xuất: Tải lên hình ảnh và nhập ít nhất 30 ký tự cho phần mô tả</span></span>

                        <textarea id="desc" name="desc">Hello, World!</textarea>

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
                    <button
                        type="submit"
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
                                <li><a href="./">Thông tin cơ bản</a></li>
                                <li class="active"><a href="./chi-tiet-san-pham.html">Thông tin chi tiết sản phẩm</a>
                                </li>
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#desc',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>
@endsection
