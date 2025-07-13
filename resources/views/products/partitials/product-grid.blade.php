<div class="grid grid-cols-5 gap-6">
  @foreach ($products as $product)
    @include('components.product-card', ['product' => $product])
  @endforeach
</div>