@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm - AquaTerra')

@section('content')
<div class="py-5 mx-3">
    <h1 class="mb-3 d-flex justify-content-center" style="font-size: 2.5rem;">
        Kết quả cho từ khóa: "{{ $query }}"
    </h1>

    <div class="row">
        {{-- Product Grid --}}
        <section class="col-12 col-md-9">
            @if($products->count())
                @include('products.partials.product-grid', ['products' => $products])
            @else
                <p class="text-center">Không tìm thấy sản phẩm nào phù hợp.</p>
            @endif
        </section>
    </div>
</div>

<x-store-benefits :benefits="[
    ['icon' => 'package', 'title' => 'Free delivery', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'secure', 'title' => '100% secure payment', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'quality', 'title' => 'Quality guarantee', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'savings', 'title' => 'Guaranteed savings', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'offers', 'title' => 'Daily offers', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
]" />
@endsection
