

<div class="container-create"  style="display: none">
    <form id="category-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="create-img">
                <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(event, 'create-preview')" id="create-img">
                <img src="{{ Storage::url($profiles->background_image) ?? asset('images/default-placeholder.png') }}" width="100" height="100" id="create-preview" alt="Image Preview"> Image
            </label>

            <div class="row">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="category-name" name="name" value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="container-btn">
            <button class="btn" type="button" id="cancel-create">Cancel</button>
            <button type="button" id="category-btn">Add Category</button>
        </div>
    </form>
</div>




<script>
    const categoriesRoute = " {{ route('categories.store') }}";
</script>