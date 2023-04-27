<div class="modal-body">
    <div class="form-group">
        <label for="name">Tên danh mục: <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-lg" name="name" id="name"
               placeholder="Tên danh mục ngành hàng">
    </div>
    @csrf
    <div class="form-group">
        <label for="parent_id">Danh mục cha: <span class="text-danger">*</span></label>
        <select class="form-control form-control-lg" id="parent_id" name="parent_id">
            <option value="0">Danh mục không cha</option>
            @foreach($categories as $category)
                <option
                    value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="img">Ảnh hiển thị: <span class="text-danger">*</span></label>
        <input type="file" class="form-control form-control-lg" accept="image/*" id="img" name="img" placeholder="">
    </div>
</div>
<script>
    $('#name').on('keyup', (e) => {
        if (e.target.value && $('#parent_id').val() && $('#img').val()) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
    $('#parent_id').on('change', (e) => {
        if (e.target.value && $('#name').val() && $('#img').val()) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
    $('#img').on('change', (e) => {
        if (e.target.value && $('#name').val() && $('#parent_id').val()) {
            $('.btnSubmit').removeAttr('disabled');
        }
    });
</script>
