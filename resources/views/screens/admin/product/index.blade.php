@extends('layouts.admin.main')
@section('modal')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="modal modal-success  flex justify-center items-center show-modal">
            <div class="over-lay-modal" onclick="$('.modal-success').toggleClass('show-modal')"></div>
            <div
                class="information success flex flex-col justify-end w-full  max-w-[300px] md:max-w-[650px] h-[400px]  shadow-xl p-6 my-6 mx-auto rounded-sm">
                <svg width="24" height="24" viewBox="0 0 24 24" onclick="$('.modal-success').toggleClass('show-modal')"
                     class="cursor-pointer absolute top-[-25px] right-0 hover:opacity-75 transition-all duration-200"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 20.4736C16.6318 20.4736 20.4668 16.6304 20.4668 12.0068C20.4668 7.375 16.6235 3.54004 11.9917 3.54004C7.36816 3.54004 3.5332 7.375 3.5332 12.0068C3.5332 16.6304 7.37646 20.4736 12 20.4736ZM9.21094 15.4932C8.8291 15.4932 8.53027 15.186 8.53027 14.8042C8.53027 14.6216 8.59668 14.4473 8.72949 14.3228L11.0288 12.0151L8.72949 9.71582C8.59668 9.58301 8.53027 9.41699 8.53027 9.23438C8.53027 8.84424 8.8291 8.55371 9.21094 8.55371C9.40186 8.55371 9.55127 8.62012 9.68408 8.74463L12 11.0522L14.3325 8.73633C14.4736 8.59521 14.623 8.53711 14.8057 8.53711C15.1875 8.53711 15.4946 8.83594 15.4946 9.21777C15.4946 9.40869 15.4365 9.55811 15.2871 9.70752L12.9795 12.0151L15.2788 14.3145C15.4199 14.439 15.4863 14.6133 15.4863 14.8042C15.4863 15.186 15.1792 15.4932 14.7891 15.4932C14.5981 15.4932 14.4238 15.4268 14.2993 15.2939L12 12.9863L9.70898 15.2939C9.57617 15.4268 9.40186 15.4932 9.21094 15.4932Z"
                        fill="white"/>
                </svg>

                <div class="content pt-3 px-3 text-center pb-2 md:pb-12">
                    <h2 class="text-title text-2xl font-medium">{{\Illuminate\Support\Facades\Session::get('success')}}</h2>

                </div>
            </div>
        </div>
    @endif
    <div id="modal3"></div>
@endsection
@section('content')
    <form id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Sản phẩm</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="./yeu-cau-them-sp.html" class="text-blueMain font-medium">Lịch sử yêu cầu thêm sản phẩm</a>
        </div>
        <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">

            <div class="flex justify-start items-start gap-2 flex-wrap">
                <select name="condition" id=""
                        class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                    <option value="0" selected="">Tất cả</option>
                    <option value="sku_id">Mã sản phẩm</option>
                    <option value="name">Tên sản phẩm</option>
                    <option value="brand">Thương hiệu</option>
                    <option value="3">Ngành hàng</option>
                </select>

                <input type="text" name="key_search"
                       class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200 "
                       placeholder="Nhập từ khóa">
                <input type="submit"
                       class="cursor-pointer transition-all duration-200 hover:bg-[#FFF] hover:text-blueMain outline-none rounded-sm border-[1px] border-blueMain bg-blueMain px-4 py-[5px] "
                       value="Lọc">
            </div>
            <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <h2 class="text-xl md:text-3xl font-medium">Lịch sử yêu cầu thêm sản phẩm</h2>

                </div>
                <div class="w-full overflow-scroll">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <p class="text-green-600">{{\Illuminate\Support\Facades\Session::get('success')}}</p>
                    @endif
                    <table class="w-full dsth">
                        <thead>
                        <tr>

                            <th>
                                Mã yêu cầu
                            </th>
                            <th>
                                Tên sản phẩm
                            </th>
                            <th>
                                Ngành hàng
                            </th>
                            <th>
                                Ngày yêu cầu
                            </th>
                            <th>
                                Nhà cung cấp yêu cầu
                            </th>
                            <th>
                                Trạng thái yêu cầu
                            </th>
                            <th>
                                Chi tiết
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($products) > 0)
                            @foreach($products as $product)

                                <tr>
                                    <td>
                                        {{$product->sku_id}}
                                    </td>
                                    <td>
                                        {{$product->name}}
                                    </td>
                                    <td>
                                        {{$product->category->name}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
                                    </td>
                                    <td>
                                        {{$product->NCC->name}}
                                    </td>
                                    <td>
                                        @if($product->status == 2 && !$product->admin_confirm_date)
                                            <span class="text-yellow-400 font-medium">Đang chờ duyệt</span>
                                        @elseif($product->status == 2 && $product->admin_confirm_date)
                                            <span class="text-green-600 font-medium">Đã duyệt</span>
                                        @elseif($product->status == 3 && $product->admin_confirm_date)
                                            <span class="text-red-600 font-medium">Từ chối</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" data-id="{{$product->id}}"
                                           class="more-details text-primary underline">
                                            Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="7">Không có dữ liệu phù hợp</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end items-center gap-4 flex-wrap">
                    <span class="text-sm text-title">Tổng: <strong class="font-bold">1.241</strong></span>
                    @include('layouts.custom.paginator', ['paginator' => $products])
                    <div class="flex justify-start items-center gap-2 flex-wrap">
                        <select name="limit"
                                class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                            <option value="10">10 hàng / trang</option>
                            <option value="25">25 hàng / trang</option>
                            <option value="50">50 hàng / trang</option>
                        </select>
                        <div class="flex justify-start items-center gap-2">
                            <span class="text-title text-sm">Đi đến</span>
                            <input type="number" name="page1" value="0" id="page"
                                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-2 py-[6px] w-[60px] focus:border-primary transition-all duration-200"
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div></div>
        </div>
    </form>
@endsection
<script>

    // $( ".cursor-pointer" ).click(function() {
    //     alert( "Handler for .click() called." );
    // });
    {{--window.location.href = "{{ route('screens.admin.product.index')}}";--}}
</script>
@section('custom_js')
    <script>
        $('.more-details').each(function (i, e) {
            $(this).on('click', (o) => {
                $.ajax({
                    url: '{{route('screens.admin.product.detail')}}?id=' + e.dataset.id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        console.log(result);
                        $('#modal3').append(result);
                        $('.modal-details').toggleClass('show-modal')
                    },
                });
            });
        });
    </script>
    <script>
        const form = document.getElementById('form');
        const limit = document.getElementsByName('limit')[0];
        const page = document.getElementById('page');
        limit.addEventListener('change', (e) => {
            form.submit();
        });
        page.addEventListener('change', (e) => {
            form.submit();
        });
        $(".cursor-pointer").click(function () {
            let search = $('.search').val();
            let select = $('.select-form').val();
            form.submit();
        });
        {{--window.location.href = "{{ route('screens.admin.product.index')}}";--}}
    </script>
@endsection

