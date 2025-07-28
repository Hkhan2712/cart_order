<form id="filter-form">
    <div class="bg-white p-4 border rounded shadow-sm">
        <h2 class="h5 fw-semibold mb-4">Filters</h2>

        {{-- Category Filter --}}
        <div class="mb-4">
            <h3 class="h6 fw-medium mb-2">Category</h3>
            @foreach ($categories as $category)
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="categories[]"
                           value="{{ $category->id }}"
                           {{ in_array($category->id, request()->input('categories', [])) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</form>
