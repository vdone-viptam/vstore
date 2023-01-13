@extends('layouts.manufacture.main')

@section('modal')
    <div id="modal1">

    </div>
@endsection

@section('content')
    <form action="" id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Sản phẩm</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="{{route('screens.manufacture.product.request')}}" class="text-blueMain font-medium">Lịch sử yêu cầu
                thêm sản phẩm</a>
        </div>
        <div class="flex flex-col justify-start items-start gap-10 px-5 xl:px-16">

            <div class="flex justify-start items-start gap-2 flex-wrap">
                <select name="condition" id=""
                        class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                    <option value="0">Tất cả</option>
                    <option
                        value="sku_id" {{isset($params['condition']) && $params['condition'] == 'sku_id' ? 'selected' : ''}}>
                        Mã sản phẩm
                    </option>
                    <option
                        value="name" {{isset($params['condition']) && $params['condition'] == 'name' ? 'selected' : ''}}>
                        Tên sản phẩm
                    </option>
                    <option
                        value="brand" {{isset($params['condition']) && $params['condition'] == 'brand' ? 'selected' : ''}}>
                        Thương hiệu
                    </option>
                    <option value="3" {{isset($params['condition']) && $params['condition'] == '3' ? 'selected' : ''}}>
                        Ngành hàng
                    </option>
                </select>

                <input type="text" name="key_search" value="{{$params['key_search'] ?? ''}}"
                       class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[5px] focus:border-primary transition-all duration-200"
                       placeholder="Nhập từ khóa">
                <button type="submit"
                        class="cursor-pointer text-blue-700 transition-all duration-200 hover:bg-[#FFF] hover:text-blueMain outline-none rounded-sm border-[1px] border-blueMain bg-blueMain px-4 py-[5px] text-[#FFF]"
                        value="">Lọc
                </button>
            </div>
            <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <h2 class="text-xl md:text-3xl font-medium">Lịch sử yêu cầu thêm sản phẩm</h2>
                    <a href="{{route('screens.manufacture.product.create')}}"
                       class="bg-primary border-primary hover:opacity-70 transition-all duration-300 shadow-lg rounded-sm py-[6px] px-[15px] text-[#FFF] flex justify-start items-center gap-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_4_2870)">
                                <rect width="20" height="20" fill="white" fill-opacity="0.01"/>
                                <path
                                    d="M10 1.25C5.16797 1.25 1.25 5.16797 1.25 10C1.25 14.832 5.16797 18.75 10 18.75C14.832 18.75 18.75 14.832 18.75 10C18.75 5.16797 14.832 1.25 10 1.25ZM13.75 10.4688C13.75 10.5547 13.6797 10.625 13.5938 10.625H10.625V13.5938C10.625 13.6797 10.5547 13.75 10.4688 13.75H9.53125C9.44531 13.75 9.375 13.6797 9.375 13.5938V10.625H6.40625C6.32031 10.625 6.25 10.5547 6.25 10.4688V9.53125C6.25 9.44531 6.32031 9.375 6.40625 9.375H9.375V6.40625C9.375 6.32031 9.44531 6.25 9.53125 6.25H10.4688C10.5547 6.25 10.625 6.32031 10.625 6.40625V9.375H13.5938C13.6797 9.375 13.75 9.44531 13.75 9.53125V10.4688Z"
                                    fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_4_2870">
                                    <rect width="20" height="20" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>Thêm mới</span>
                    </a>
                </div>
                <div class="w-full overflow-scroll">
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
                                Vstore yêu cầu
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
                                        {{isset($params['condition']) && $params['condition'] == 3 ? $product->cate_name : $product->category->name}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
                                    </td>
                                    <td>
                                        {{$product->vStore->name}}
                                    </td>
                                    <td>
                                        @if($product->status == 1)
                                            <span class="text-yellow-400 font-medium">Đang chờ duyệt</span>
                                        @elseif($product->status == 2 && !$product->admin_confirm_date)
                                            <span class="text-yellow-400 font-medium">Đang chờ duyệt</span>
                                        @elseif($product->status == 2 && $product->admin_confirm_date)
                                            <span class="text-green-600 font-medium">Đã duyệt</span>
                                        @else
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
                    <span class="text-sm text-title">Tổng: <strong
                            class="font-bold">{{count($products)}}</strong></span>
                    @include('layouts.custom.paginator', ['paginator' => $products])
                    <div class="flex justify-start items-center gap-2 flex-wrap">
                        <select name="limit"
                                class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-4 py-[6px] focus:border-primary transition-all duration-200">
                            <option
                                value="10" {{isset($params['limit']) && $params['limit'] == '10' ? 'selected' : ''}}>10
                                hàng / trang
                            </option>
                            <option
                                value="25" {{isset($params['limit']) && $params['limit'] == '25' ? 'selected' : ''}}>25
                                hàng / trang
                            </option>
                            <option
                                value="50" {{isset($params['limit']) && $params['limit'] == '50' ? 'selected' : ''}}>
                                50 hàng / trang
                            </option>
                        </select>
                        <div class="flex justify-start items-center gap-2">
                            <span class="text-title text-sm">Đi đến</span>
                            <input type="number" name="page1" id="page" value="0"
                                   class="outline-none rounded-sm border-[1px] border-[#D9D9D9] px-2 py-[6px] w-[60px] focus:border-primary transition-all duration-200"
                                   min="1">
                        </div>
                    </div>
                </div>
            </div>
            <div></div>
        </div>
    </form>
@endsection

@section('custom_js')
    <script>
        $('.more-details').each(function (i, e) {
            $(this).on('click', (o) => {
                $.ajax({
                    url: '{{route('screens.manufacture.product.detail')}}?id=' + e.dataset.id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        $('#modal1').append(result);
                        $('.modal-details').toggleClass('show-modal')
                    },
                });
            });
        });
        const form = document.getElementById('form');
        const limit = document.getElementsByName('limit')[0];
        const page = document.getElementById('page');
        limit.addEventListener('change', (e) => {
            form.submit();
        });
        page.addEventListener('change', (e) => {
            form.submit();
        });
    </script>
@endsection
