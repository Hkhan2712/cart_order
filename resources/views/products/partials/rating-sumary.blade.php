<div class="mb-5">
    <h2 class="h5 mb-3">Guest Ratings & Reviews</h2>
    <div class="row">
        <div class="col-md-4 text-center">
            <h3 class="display-4">{{ number_format($product->rating, 1) }}/5</h3>
            <div>
                @for ($i = 1; $i <= 5; $i++)
                    <svg width="20" height="20" class="text-warning">
                        <use xlink:href="#{{ $i <= round($product->rating) ? 'star-full' : 'star-half' }}"></use>
                    </svg>
                @endfor
            </div>
        </div>
        <div class="col-md-8">
            @for ($i = 5; $i >= 1; $i--)
                @php
                    $percent = ($product->reviews->where('rating', $i)->count() / max(1, $product->reviews->count())) * 100;
                @endphp
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">{{ $i }} star</span>
                    <div class="progress w-75">
                        <div class="progress-bar" style="width: {{ $percent }}%"></div>
                    </div>
                    <span class="ms-2">{{ round($percent) }}%</span>
                </div>
            @endfor
        </div>
    </div>
</div>