<div class="row mb-5">
    <div class="col-md-7">
        <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="img-fluid w-100 rounded">
    </div>
    <div class="col-md-5">
        <h1 class="h4 fw-bold">{{ $product->name }}</h1>
        <x-star-rating :rating="$product->rating" :review-count="$product->review_count" />
        <div class="mb-2">
            <x-price :price="$product->price" :sale="$product->sale_price" />
        </div>
        <div class="mb-4" style="max-width: 200px;">
            <label for="quantity" class="form-label fw-semibold mb-2">Quantity</label>
            <div class="input-group">
                <button class="btn btn-outline-success" style="border-color:#b5e7b1" type="button" onclick="document.getElementById('quantity').stepDown()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8"/>
                    </svg>
                </button>
                <input type="number" id="quantity" class="form-control text-center" value="1" min="1">
                <button class="btn btn-outline-success" style="border-color:#b5e7b1" type="button" onclick="document.getElementById('quantity').stepUp()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                    </svg>
                </button>
            </div>
        </div>
        <p class="mb-3">
            <strong class="{{ $product->stock_quantity > 0 ? 'text-success' : 'text-danger' }}">
                {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
            </strong>
        </p>
        <button class="btn btn-primary">
            <svg width="18" height="18" class="me-1"><use xlink:href="#cart"></use></svg>
            Add to Cart
        </button>
        <div class="my-5 pdp-value-props">
            <div class="value">
                <div class="value-icon">
                    <img width="60" role="presentation" src="https://crowdcow-images.imgix.net/https%3A%2F%2Fcrowdcow-uploads.imgix.net%2Fpicture%2Fproduction%2Fiwxxj6uzrrv%2Ffast-truck.png?ixlib=rails-2.1.4&amp;role=presentation&amp;auto=compress%2Cformat&amp;cs=srgb&amp;w=60&amp;fit=min&amp;s=09c82974ab24b1f8a6f487ebf7c10e45">
                </div>
                <div class="value-text is-size-6point5">
                    1 - 3 Business-Day Delivery
                </div>
            </div>
            <div class="value">
                <div class="value-icon">
                    <img width="60" role="presentation" src="https://crowdcow-images.imgix.net/https%3A%2F%2Fcrowdcow-uploads.imgix.net%2Fpicture%2Fproduction%2Fiulwhcqghh0%2Ffree-shipping.png?ixlib=rails-2.1.4&amp;role=presentation&amp;auto=compress%2Cformat&amp;cs=srgb&amp;w=60&amp;fit=min&amp;s=3b4f0dde06df2a39b2d0b4311c836d9a">
                </div>
                <div class="value-text is-size-6point5">
                    Free Shipping for $149+ orders
                </div>
            </div>
            <div class="value">
                <div class="value-icon">
                    <img width="60" role="presentation" src="https://crowdcow-images.imgix.net/https%3A%2F%2Fcrowdcow-uploads.imgix.net%2Fpicture%2Fproduction%2Fitqkrnjo8np%2Fstar-badge.png?ixlib=rails-2.1.4&amp;role=presentation&amp;auto=compress%2Cformat&amp;cs=srgb&amp;w=60&amp;fit=min&amp;s=00e1c65524e71312f7d645e13a1b6c51">
                </div>
                <div class="value-text is-size-6point5">
                Quality Guaranteed
                </div>
            </div>
        </div>
        <p class="mb-3">
            <span class="text-muted">Estimated Delivery:</span> 1-3 business days
        </p>
        <p class="mb-3">
            <span class="text-muted">Return Policy:</span> 7-day refund or exchange
        </p>
    </div>
</div>
