<form action="{{route('screens.vstore.product.confirm',['id' => $product->id])}}" method="POST">
    @csrf
    <div class="modal modal-details">
        <div class="over-lay-modal" onclick="$('.modal-details').toggleClass('show-modal')"></div>
        <div
            class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-4">
            <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                <h2 class="text-base text-title font-medium">Thông tin chi tiết</h2>
                <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                     onclick="$('.modal-details').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                        fill="black" fill-opacity="0.45"/>
                </svg>
            </div>
            <div class="content  max-h-[600px] overflow-y-auto">
                <div class="flex flex-col justify-start items-start gap-4 py-3 w-full">
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Mã sản phẩm:</span>
                        <span class="text-title">{{$product->id}}</span>
                    </div>

                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Tên sản phẩm:</span>
                        <span class="text-title">{{$product->name}}</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Nhà cung cấp:</span>
                        <span class="text-title">{{$product->NCC->name}}</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Giá bán:</span>
                        <span class="text-title">{{$product->price}}</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Chiết khấu:</span>
                        <span class="text-title" id="discount" data-discount="{{$product->discount}}">{{$product->discount}}%</span>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <span class="text-title font-medium ">Số lượng bán:</span>
                        <span class="text-title">{{$product->amount_product}}</span>
                    </div>
                    <label for="">Trạng thái đơn đăng ký</label>
                    <div class="flex justify-start items-center gap-2 w-full">

                        <select name="status" id="status" @if($product->status ==2 || $product->status ==3) disabled
                                @endif
                                class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full">
                            <option value="0">Chưa xem</option>
                            <option
                                value="2" {{$product->status ==2 || \Illuminate\Support\Facades\Session::get('error') ? 'selected' : ''}}>
                                Duyệt
                            </option>
                            <option value="3" {{$product->status ==3 ? 'selected' : ''}}>Từ chối</option>
                        </select>
                    </div>
                    <div id="vShop" class="w-full"
                         @if($product->status ==1 || $product->status == 3) style="display: none" @endif>
                        <label for="">Phần trăm chiết khấu V-Shop</label>
                        <div class="flex justify-start items-center gap-2 w-full">
                            <input type="text" min="" name="discount_vShop"
                                   @if($product->status == 2) disabled @endif
                                   value="{{$product->status == 2 ? $product->discount_vShop : ''}}"
                                   class="w-full text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm">

                        </div>
                        <p class="text-red-600" style="display: none" id="messageDis">Phần trăm chiết khấu V-shop không
                            được nhỏ hơn 50% chiết khấu
                            V-store</p>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full" id="note">
                        @if($product->status == 3)
                            <textarea name="note" placeholder="{{$product->note}}"
                                      class="w-full text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm"></textarea>
                        @endif
                    </div>
                </div>
                <div class="flex justify-end items-center gap-4 ">
                    {{--                    <button--}}
                    {{--                        type="button"--}}
                    {{--                        class="text-blue-700 cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70"--}}
                    {{--                        onclick="$('.modal-details').toggleClass('show-modal')">Đóng lại--}}
                    {{--                    </button>--}}
                    @if($product->status == 1)
                        <button id="btnConfirm"
                                class="cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70">
                            Lưu thay đổi
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.querySelector('#status').addEventListener('change', (e) => {
        if (e.target.value == 3) {
            document.querySelector('#vShop').style.display = 'none'
            document.querySelector('#note').innerHTML = `  <textarea name="note" placeholder="Lý do từ chối"
                               class="w-full text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"></textarea>`
        } else if (e.target.value == 2) {
            document.querySelector('#vShop').style.display = 'block';
        } else {
            document.querySelector('#note').innerHTML = ``;
            document.querySelector('#vShop').style.display = 'none'

        }
    })

    document.getElementsByName('discount_vShop')[0].addEventListener('keyup', (e) => {
        if (e.target.value < Number(document.getElementById('discount').dataset.discount) / 2) {
            document.getElementById('messageDis').style.display = 'block';
            document.getElementById('btnConfirm').style.display = 'none';
        } else {
            document.getElementById('messageDis').style.display = 'none';
            document.getElementById('btnConfirm').style.display = 'block';
        }

    })
</script>
