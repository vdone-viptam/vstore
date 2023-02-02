@extends('layouts.vstore.main')

@section('modal')
    <div id="modal2"></div>
@endsection


@section('content')
    <form action="" id="form">
        <div class="brc flex justify-start items-center gap-2 px-5 xl:px-16 py-4">
            <span class="text-secondary">Sản phẩm</span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 6L15.2929 11.2929C15.6834 11.6834 15.6834 12.3166 15.2929 12.7071L10 18" stroke="black"
                      stroke-opacity="0.45" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <a href="{{route('screens.vstore.product.request')}}" class="text-blueMain font-medium">Lịch sử yêu cầu thêm
                sản
                phẩm</a>
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
                <input type="submit"
                       class="text-blue-700 cursor-pointer transition-all duration-200 hover:bg-[#FFF] hover:text-blueMain outline-none rounded-sm border-[1px] border-blueMain  px-4 py-[5px]"
                       value="Lọc">
            </div>
            <div class="box flex flex-col gap-6 p-4 xl:p-10 w-full">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <h2 class="text-xl md:text-3xl font-medium">Lịch sử yêu cầu thêm sản phẩm</h2>

                </div>
                <div class="w-full ">
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
                                        {{isset($params['condition']) && $params['condition'] == 3 ? $product->cate_name : $product->category->name}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
                                    </td>
                                    <td>
                                        {{$product->NCC->name}}
                                    </td>
                                    <td>
                                        @if($product->status == 1)
                                            <span class="text-yellow-400 font-medium">Đang chờ duyệt</span>
                                        @elseif($product->status == 2 && !$product->admin_confirm_date && $product->vstore_confirm_date)
                                            <span class="text-yellow-400 font-medium">Chờ admin duyệt</span>
                                        @elseif($product->status == 2 && $product->admin_confirm_date && $product->vstore_confirm_date)
                                            <span class="text-green-600 font-medium">Đã duyệt</span>
                                        @elseif($product->status == 3 && !$product->admin_confirm_date && $product->vstore_confirm_date)
                                            <span class="text-red-600 font-medium">Vstore từ chối</span>
                                        @else
                                            <span class="text-red-600 font-medium">Admin từ chối</span>
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
                            <option
                                value="10" {{isset($params['limit']) && $params['limit'] == '10' ? 'selected' : ''}}>10
                                hàng / trang
                            </option>
                            <option
                                value="25" {{isset($params['limit']) && $params['limit'] == '25' ? 'selected' : ''}}>25
                                hàng / trang
                            </option>
                            <option
                                value="50" {{isset($params['limit']) && $params['limit'] == '50' ? 'selected' : ''}}>50
                                hàng / trang
                            </option>
                        </select>

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
                    url: '{{route('screens.vstore.product.detail')}}?id=' + e.dataset.id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        $('#modal2').html('');
                        $('#modal2').append(result);
                        $('.modal-details').toggleClass('show-modal')
                    },
                });
            });
        });
        const form = document.getElementById('form');
        const limit = document.getElementsByName('limit')[0];
        limit.addEventListener('change', (e) => {
            form.submit();
        });
        // page.addEventListener('change', (e) => {
        //     form.submit();
        // });
    </script>
@endsection
