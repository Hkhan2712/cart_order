<div class="product-item swiper-slide" data-product-id="{{ $product->id }}">
    <figure>
        <a href="/products/{{ $product->slug}}" title="{{ $product->name }}">
            <img src="{{ $product->image_path }}" alt="{{ $product->slug }}" class="tab-image">
        </a>
    </figure>
    <div class="d-flex flex-column text-center">
        <h3 class="fs-6 fw-normal">{{ $product->name }}</h3>
        <x-star-rating :rating="$product->rating" :review-count="$product->review_count" class="justify-content-center" />
        <div class="d-flex justify-content-center align-items-center gap-2">
            <x-price :price="$product->price" :sale="$product->sale_price" />
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
                    <a href="#" class="btn btn-outline-dark btn-cart rounded-1 p-2 fs-7 d-flex align-items-center justify-content-center">
                        <svg width="18" height="18"><use xlink:href="#heart"></use></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
