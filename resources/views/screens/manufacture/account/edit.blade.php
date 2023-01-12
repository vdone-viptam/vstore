<form action="{{route('screens.manufacture.account.update',['id' => $ware->id])}}" method="POST">

    @csrf
    <div class="modal modal-edit-add">
        <div class="over-lay-modal" onclick="$('.modal-edit-add').toggleClass('show-modal')"></div>
        <div
            class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl px-3 py-6 md:p-6 mx-auto mt-10 md:mt-24">
            <div class="flex justify-between items-center border-b-[1px] border-grey pb-3">
                <h2 class="text-base text-title font-medium">Cập nhập địa chỉ</h2>
                <svg width="16" height="16" class="cursor-pointer hover:opacity-70"
                     onclick="$('.modal-edit-add').toggleClass('show-modal')" viewBox="0 0 16 16" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.92473 7.99916L13.6122 2.41166C13.6908 2.31881 13.6247 2.17773 13.5033 2.17773H12.0783C11.9944 2.17773 11.914 2.21523 11.8587 2.27952L7.99258 6.88845L4.12651 2.27952C4.07294 2.21523 3.99258 2.17773 3.90687 2.17773H2.48187C2.36044 2.17773 2.29437 2.31881 2.37294 2.41166L7.06044 7.99916L2.37294 13.5867C2.35534 13.6074 2.34405 13.6327 2.3404 13.6596C2.33676 13.6865 2.34092 13.7139 2.35239 13.7386C2.36386 13.7632 2.38216 13.784 2.40511 13.7985C2.42806 13.8131 2.4547 13.8207 2.48187 13.8206H3.90687C3.9908 13.8206 4.07115 13.7831 4.12651 13.7188L7.99258 9.10988L11.8587 13.7188C11.9122 13.7831 11.9926 13.8206 12.0783 13.8206H13.5033C13.6247 13.8206 13.6908 13.6795 13.6122 13.5867L8.92473 7.99916Z"
                        fill="black" fill-opacity="0.45"/>
                </svg>
            </div>
            <div class="content  max-h-[600px] overflow-y-auto">
                <div class="flex flex-col justify-start items-start gap-4 py-3 w-full">

                    <div class="flex justify-between flex-wrap md:flex-nowrap items-center gap-4 w-full">
                        <input type="text" name="name"
                               class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                               value="{{$ware->name}}">
                        <input type="text" name="phone_number"
                               class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                               value="{{$ware->phone_number}}">
                    </div>
                    <div class="flex flex-col justify-start items-start gap-4 py-3 w-full">

                        <div class="flex justify-between flex-wrap md:flex-nowrap items-center gap-4 w-full">
                            <select
                                class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                                name="city_id" id="city2" aria-label=".form-select-sm">
                                <option value="" selected>Chọn tỉnh thành</option>
                            </select>

                            <select
                                class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                                name="district_id" id="district2" aria-label=".form-select-sm">
                                <option value="" selected>Chọn quận huyện</option>
                            </select>

                            <select
                                class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full"
                                name="ward_id" id="ward2" aria-label=".form-select-sm">
                                <option value="" selected>Chọn phường xã</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-start items-center gap-2 w-full">
                        <textarea name="address"
                                  class="text-title outline-none py-[7px] px-3 border-[1px] border-[#D9D9D9] bg-[#FFFFFF] focus:border-primary transition-all duration-200 rounded-sm w-full">{{$ware->address}}</textarea>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-4 ">
                    <a
                            class=" cursor-pointer outline-none bg-[#FFF] transition-all duration-200 rounded-sm py-2 px-3 text-center text-title hover:opacity-70 border-[1px] border-secondary"
                            href="{{route('screens.manufacture.account.address')}}">Đóng lại
                    </a>
                    <button
                        class=" cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 border-[1px] border-primary text-center text-[#FFFFFF] hover:opacity-70">
                        Lưu lại
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>
<script>
    const divCity2 = document.getElementById('city2');
    const divDistrict2 = document.getElementById('district2');
    const divWard2 = document.getElementById('ward2');
    $.ajax({
        url: "https://provinces.open-api.vn/api/p",
        type: 'GET',
        success: function (result) {
            divCity2.innerHTML +=
                `${
                    result.map(item => `<option value="${item.code}" ${item.code === {{$ware->city_id}} ? 'selected' : ''}>${item.name}</option>`).join('')
                }`;
            if ({{$ware->city_id}}) {
                $.ajax({
                    url: `https://provinces.open-api.vn/api/p/{{$ware->city_id}}/?depth=2`,
                    type: 'GET',
                    success: function (result) {
                        divDistrict2.innerHTML = '<option value="0">Lựa chọn huyện</option>' + result.districts.map(districtitem => `<option value="${districtitem.code}"
${districtitem.code === {{$ware->district_id}} ? 'selected' : ''}
>${districtitem.name}</option>`).join('');

                    }
                });
                $.ajax({
                    url: `https://provinces.open-api.vn/api/d/{{$ware->district_id}}?depth=2`,
                    type: 'GET',
                    success: function (result) {
                        divWard2.innerHTML = '<option value="0">Lựa chọn phường xã</option>' + result.wards.map(wardItem => `<option value="${wardItem.code}"
${wardItem.code === {{$ware->ward_id}} ? 'selected' : ''}
>${wardItem.name}</option>`).join('');
                    }
                });
            }

        }
    });
    divCity2.addEventListener('change', (e) => {
        const id = e.target.value;
        if (+id !== 0) {
            $.ajax({
                url: `https://provinces.open-api.vn/api/p/${id}/?depth=2`,
                type: 'GET',
                success: function (result) {
                    divDistrict2.innerHTML = '<option value="0">Lựa chọn huyện</option>' + result.districts.map(districtitem => `<option value="${districtitem.code}">${districtitem.name}</option>`).join('');

                }
            });
        } else {
            divDistrict2.innerHTML = '<option value="0">Bạn chưa chọn thành phố</option>';
        }

    })
    divDistrict2.addEventListener('change', (e) => {
        const id = e.target.value;
        if (+id !== 0) {
            $.ajax({
                url: `https://provinces.open-api.vn/api/d/${id}?depth=2`,
                type: 'GET',
                success: function (result) {
                    divWard2.innerHTML = '<option value="0">Lựa chọn phường xã</option>' + result.wards.map(wardItem => `<option value="${wardItem.code}">${wardItem.name}</option>`).join('');
                }
            });
        } else {
            divWard2.innerHTML = '<option value="0">Bạn chưa chọn quận huyện</option>';
        }
    });
</script>

