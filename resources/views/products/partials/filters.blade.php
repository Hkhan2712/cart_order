<div class="bg-white p-4 border rounded shadow-sm">
    <h2 class="h5 fw-semibold mb-4">Filters</h2>

    {{-- Category Filter --}}
    <div class="mb-4">
        <h3 class="h6 fw-medium mb-2">Category</h3>
        @foreach ($categories as $category)
            <div class="form-check">
                <input class="form-check-input" style="border-color: #747474;" type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
            </div>
        @endforeach
    </div>
</div>
