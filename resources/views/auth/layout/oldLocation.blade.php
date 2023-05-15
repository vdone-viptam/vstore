
@if (old('city_id') != '')
    <script>
        fetch('{{ route('get_city') }}?type=2&value={{ old('city_id') }}', {
                mode: 'no-cors',

            })
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    divDistrict.innerHTML = `<option value="" disabled selected >Lựa chọn quận (huyện)</option>` + data
                        .map(item =>
                            `<option data-name="${item.DISTRICT_NAME}" value="${item.DISTRICT_ID}" ${item.DISTRICT_ID == '{{ old('district_id') }}' ? 'selected' : ''}>${item.DISTRICT_NAME}</option>`
                            );

                } else {
                    divDistrict.innerHTML = `<option value="" disabled selected >Lựa chọn quận (huyện)</option>`;
                }
            })
            .catch(() => divDistrict.innerHTML = `<option value="" disabled selected >Lựa chọn quận (huyện)</option>`);
    </script>
@endif
@if (old('district_id') != '')
    <script>
        fetch('{{ route('get_city') }}?type=3&value={{ old('district_id') }}', {
                mode: 'no-cors',

            })
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    divWard.innerHTML = `<option value="" disabled selected >Lựa chọn phường (xã)</option>` + data
                        .map(item =>
                                `<option ${item.WARDS_ID == '{{ old('ward_id') }}' ? 'selected' : ''} data-name="${item.WARDS_NAME}" value="${item.WARDS_ID}">${item.WARDS_NAME}</option>`
                                );

                } else {
                    divWard.innerHTML = `<option value="" disabled selected >Lựa chọn phường (xã)</option>`;
                }
            })
            .catch(() => divWard.innerHTML = `<option value="" disabled selected >Lựa chọn phường (xã)</option>`);
    </script>
@endif

