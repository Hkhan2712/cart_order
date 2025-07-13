<div class="mb-5">
    <h2 class="h5 mb-3">Customer Reviews</h2>
    @forelse ($reviews as $review)
        <div class="border-bottom py-3">
            <div class="d-flex justify-content-between">
                <strong>{{ $review->user_name }}</strong>
                <span class="text-muted">{{ $review->created_at->format('F j, Y') }}</span>
            </div>
            <div class="mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    <svg width="16" height="16" class="{{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}">
                        <use xlink:href="#star-full"></use>
                    </svg>
                @endfor
            </div>
            <p class="mb-0">{{ $review->comment }}</p>
        </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse
</div>