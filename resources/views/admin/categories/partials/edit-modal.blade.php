<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" enctype="multipart/form-data" class="modal-content" id="editCategoryForm">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="edit-category-id">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" id="edit-category-name" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label>Parent Category</label>
                    <select name="parent_id" id="edit-category-parent" class="form-control">
                        <option value="">-- None --</option>
                        @foreach ($allCategories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <input type="checkbox" name="status" value="1" id="edit-category-status" />
                </div>
                <div class="mb-3">
                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" />
                </div>
                <div class="mb-3">
                    <label>Banner</label>
                    <input type="file" name="banner" class="form-control" />
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" id="edit-category-description" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
