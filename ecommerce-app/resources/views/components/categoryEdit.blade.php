<div class="edit-container" style="display: none">
    <form id="editCategoryForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" id="edit-id">

    
        <div class="form-group">
            <label for="edit-image">
                <input type="file" class="form-control" id="edit-image" name="image" accept="image/*"  onchange="previewImage(event, 'edit-preview')">
                <img id="edit-preview" src="" width="100" height="100">Image
            </label>

            <div class="row">
                <label for="edit-name">Category Name</label>
                <input type="text" class="form-control" id="edit-name" name="name" required>
            </div>
        </div>

        <div class="container-btn">
            <button type="button" class="btn " id="cancel-edit">Cancel</button>
            <button type="submit" class="btn " id="update-category-btn">Update Category</button>
        </div>
    </form>
</div>