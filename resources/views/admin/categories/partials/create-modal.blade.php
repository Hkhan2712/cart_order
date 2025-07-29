<!-- ADD NEW CATEGORY MODAL -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Name -->
                <div class="mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control" required />
                </div>

                <!-- Parent -->
                <div class="mb-3">
                    <label for="parent_id">Parent Category</label>
                    <select name="parent_id" class="form-control">
                        <option value="">-- None --</option>
                        @foreach ($allCategories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status">Visible</label>
                    <input type="checkbox" name="status" value="1" checked />
                </div>

                <!-- Thumbnail -->
                <div class="mb-3">
                    <label for="thumbnail">Thumbnail (optional)</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*" />
                </div>

                <!-- Banner -->
                <div class="mb-3">
                    <label for="banner">Banner (optional)</label>
                    <input type="file" name="banner" class="form-control" accept="image/*" />
                </div>

                <!-- Description (optional) -->
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>