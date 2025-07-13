<div class="bg-white p-4 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">Filters</h2>
    <div class="mb-4">
        <h3 class="font-medium mb-2">Category</h3>
        @foreach ($categories as $category)
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="category-{{ $category->id }}" name="categories[]" value="{{ $category->id }}">
                <label for="category-{{ $category->id }}">{{ $category->name }}</label>
            </div>
        @endforeach
    </div>
    <div class="mb-4">
        <h3 class="font-medium mb-2">Price</h3>
        <input type="range" min="0" max="1000000" step="10000" class="w-full">
    </div> 
</div>
