<div id="product-list" class="row row-cols-2 row-cols-lg-3 row-cols-xl-4 g-4">
    @foreach ($products as $product)
        <div class="col">
            @include('components.product-card', ['product' => $product])
        </div>
    @endforeach
</div>

{{-- Pagination --}}
<div class="mt-4">
    {{-- $products->links() --}}
</div>
