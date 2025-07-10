<div class="product-item swiper-slide">
  <figure>
    <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}">
      <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Product Thumbnail" class="tab-image">
    </a>
  </figure>
  <div class="d-flex flex-column text-center">
    <h3 class="fs-6 fw-normal">{{ $product->name }}</h3>
    <div>
      <span class="rating">
        @for ($i = 1; $i <= 5; $i++)
          <svg width="18" height="18" class="text-warning">
            <use xlink:href="#{{ $i <= round($product->rating) ? 'star-full' : 'star-half' }}"></use>
          </svg>
        @endfor
      </span>
      <span>({{ $product->review_count }})</span>
    </div>
    <div class="d-flex justify-content-center align-items-center gap-2">
      @if ($product->original_price > $product->price)
        <del>${{ number_format($product->original_price, 2) }}</del>
      @endif
      <span class="text-dark fw-semibold">${{ number_format($product->price, 2) }}</span>
      @if ($product->original_price > $product->price)
        <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
          {{ round(100 - ($product->price / $product->original_price * 100)) }}% OFF
        </span>
      @endif
    </div>
    <div class="button-area p-3 pt-0">
      <div class="row g-1 mt-2">
        <div class="col-3">
          <input type="number" name="quantity" class="form-control border-dark-subtle input-number quantity" value="1">
        </div>
        <div class="col-7">
          <a href="#" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart">
            <svg width="18" height="18"><use xlink:href="#cart"></use></svg> Add to Cart
          </a>
        </div>
        <div class="col-2">
          <a href="#" class="btn btn-outline-dark rounded-1 p-2 fs-6">
            <svg width="18" height="18"><use xlink:href="#heart"></use></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
