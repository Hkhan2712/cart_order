
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/product.css') }}">
@endpush

@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container py-5">

        @include('products.partials.product-main', ['product' => $product])

        @include('products.partials.product-detail', ['details' => $product->detail])

        @include('products.partials.related-products', ['products' => $relatedProducts])

        @include('products.partials.rating-summary', ['product' => $product])

        @include('products.partials.reviews-list', ['reviews' => $product->reviews])

    </div>
    <x-store-benefits :benefits="[
        ['icon' => 'package', 'title' => 'Free delivery', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'secure', 'title' => '100% secure payment', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'quality', 'title' => 'Quality guarantee', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'savings', 'title' => 'Guaranteed savings', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'offers', 'title' => 'Daily offers', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ]" />
@endsection
