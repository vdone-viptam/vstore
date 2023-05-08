<div class="modal-body">
    <div class="form-group">
        <label for="name">Tên ngân hàng: <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ $banks->name }}"
            placeholder="Tên ngân hàng">
        @error('name')
            <div style="color: red">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Tên chi tiết ngân hàng: <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg" name="full_name" value="{{ $banks->full_name }} "
            id="full_name" placeholder="Tên chi tiết ngân hàng">
        @error('full_name')
            <div style="color: red">{{ $message }}</div>
        @enderror
    </div>
    @csrf
    <div class="form-group">
        <label for="img">Ảnh hiển thị: <span class="text-danger">*</span></label>
        <input type="file" class="form-control form-control-lg" accept="image/*" id="image" name="image"
            placeholder="">
        <div style="color: red" id="error"></div>
    </div>
</div>
<script>
    $('#name').on('keyup', (e) => {
        if (e.target.value && $('#full_name').val() && $('#img').val() && $('#error').html().length == 0) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
    $('#full_name').on('keyup', (e) => {
        if (e.target.value && $('#name').val() && $('#img').val() && $('#error').html().length == 0) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
    $('#image').on('change', (e) => {
        let error = document.querySelector("#error");

        error.innerHTML = "";
        if (e.target.files) {
            for (let i = 0; i < e.target.files.length; i++) {
                let file = e.target.files[i];
                let allowedImageTypes = ["image/jpeg", "image/gif", "image/png"];
                if (!allowedImageTypes.includes(file.type)) {
                    error.innerHTML = "Đuôi file được cho phép là: [ .jpg .png .gif ]";
                    return false;
                }
                if (file.size > 1024 * 1024 * 5) {
                    error.innerHTML = "File ảnh upload không quá 5MB";

                    return false;
                }
            }
        }
        if ($('#name').val() && $('#full_name').val() && $('#error').html().length == 0) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
</script>
