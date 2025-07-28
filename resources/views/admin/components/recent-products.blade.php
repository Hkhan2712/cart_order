<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recently Added Products</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="px-2">
            @if ($products->isNotEmpty())
                @foreach ($products as $product)
                    <div class="d-flex border-top py-2 px-1">
                        <div class="col-2">
                            <img
                                src="{{ $product->thumbnail_url ?? asset('images/default-150x150.png') }}"
                                alt="{{ $product->name }}"
                                class="img-size-50"
                            />
                        </div>
                        <div class="col-10">
                            <a href="{{ route('admin.products.show', $product) }}" class="fw-bold">
                                {{ $product->name }}
                                <span class="badge text-bg-primary float-end">
                                    ${{ number_format($product->price) }}
                                </span>
                            </a>
                            <div class="text-truncate">{{ $product->short_description }}</div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center text-muted py-4">
                    No products found.
                </div>
            @endif
        </div>
    </div>

    <div class="card-footer text-center">
        <a href="{{ route('admin.products.index') }}" class="uppercase"> View All Products </a>
    </div>
</div>
