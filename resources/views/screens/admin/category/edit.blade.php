<div class="modal-body">
    <div class="form-group">
        <label for="name">Tên danh mục: <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg" name="name" id="name"
               value="{{$currentCategory->name}}"
               placeholder="">
    </div>
    @csrf
    <div class="form-group">
        <label for="parent_id">Danh mục cha: <span class="text-danger">*</span></label>
        <select class="form-control form-control-lg" id="parent_id" name="parent_id">
            <option value="0">Danh mục không cha</option>
            @foreach($categories as $category)
                <option
                    value="{{$category->id}}" {{$category->id == $currentCategory->parent_id ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="img">Ảnh hiển thị: <span class="text-danger">*</span></label>
        <input type="file" class="form-control form-control-lg" accept=".jpeg,.gif,.png" id="img" name="img"
               placeholder="">
        <p class="text-danger ml-1 mt-2" id="error"></p>

    </div>
</div>
<script>
    $('#name').on('keyup', (e) => {
        if (e.target.value && $('#parent_id').val()) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
    $('#parent_id').on('change', (e) => {
        if (e.target.value && $('#name').val()) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
    $('#img').on('change', (e) => {
        let error = document.querySelector("#error");

        error.innerHTML = "";
        if (e.target.files) {
            console.log(e.target.files)
            for (let i = 0; i < e.target.files.length; i++) {
                let file = e.target.files[i];
                let allowedImageTypes = ["image/jpeg", "image/gif", "image/"];
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
        if ($('#name').val() && $('#parent_id').val() && $('#error').html().length === 0) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
</script>
