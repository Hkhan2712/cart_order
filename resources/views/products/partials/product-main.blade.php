<div class="row mb-5">
    <div class="col-md-6">
        <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="img-fluid w-100 rounded">
    </div>
    <div class="col-md-6">
        <h1 class="h4 fw-bold">{{ $product->name }}</h1>
        <div class="d-flex align-items-center mb-2">
            @for ($i = 1; $i <= 5; $i++)
                <svg width="18" height="18" class="text-warning me-1">
                    <use xlink:href="#{{ $i <= round($product->rating) ? 'star-full' : 'star-half' }}"></use>
                </svg>
            @endfor
            <span class="text-muted">({{ $product->review_count }} reviews)</span>
        </div>
        <div class="mb-2">
            <span class="h5 text-danger me-2">${{ number_format($product->price, 2) }}</span>
            @if ($product->original_price > $product->price)
                <del class="text-muted">${{ number_format($product->original_price, 2) }}</del>
            @endif
        </div>
        <div class="d-flex align-items-center mb-3">
            <label for="quantity" class="me-2">Quantity:</label>
            <input type="number" id="quantity" class="form-control w-25" value="1" min="1">
        </div>
        <button class="btn btn-primary">
            <svg width="18" height="18" class="me-1"><use xlink:href="#cart"></use></svg>
            Add to Cart
        </button>
    </div>
</div>
