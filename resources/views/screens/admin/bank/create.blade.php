<div class="modal-body">
    <div class="form-group">
        <label for="name">Tên ngân hàng: <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg only-char" name="name" id="name"  placeholder="Tên ngân hàng"
        required>
        @error('name')
            <div style="color: red">{{ $message }}</div>
        @enderror
        <div style="color: red" id="mesName"></div>
    </div>
    <div class="form-group">
        <label for="name">Tên chi tiết ngân hàng: <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg only-char" name="full_name"  id="full_name"
            placeholder="Tên chi tiết ngân hàng" required>
        @error('full_name')
            <div style="color: red">{{ $message }}</div>
        @enderror
        <div style="color: red" id="mesFull"></div>
    </div>
    @csrf
    <div class="form-group">
        <label for="img">Ảnh hiển thị: <span class="text-danger">*</span></label>
        <input type="file" class="form-control form-control-lg" accept="image/*" id="image" name="image"
            placeholder="" required>
            <input type="hidden" id="check">
        <div style="color: red" id="error"></div>
    </div>
</div>
<script>
    $('.btnSubmit').on('click', () => {
        if (!$('#full_name').val()) {
            $('#mesFull').html('Tên chi tiết ngân hàng bắt buộc nhập')
        }else{
            $('#mesFull').html('')

        }
        if(!$('#check').val()){
            $('#error').html('Ảnh ngân hàng bắt buộc chọn')
        }else{
            $('#error').html('')

        }
        if(!$('#name').val()){
            $('#mesName').html('Tên ngân hàng bắt buộc nhập')
        }else{
            $('#mesName').html('')

        }
        if($('#full_name').val() && $('#check').val() && $('#name').val()){
           $('#form-AC').submit();
        }
    });
    document.querySelectorAll('.only-char').forEach(item => {
            item.addEventListener("keypress", (e) => {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
        })
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
        if ($('#error').html().length == 0) {
            $('#check').val(123123)
            $('.btnSubmit').removeAttr('disabled');
        }
    });
</script>
