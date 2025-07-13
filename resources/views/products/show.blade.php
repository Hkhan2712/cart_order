@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container py-5">

        {{-- 1. Phần ảnh và thông tin sản phẩm --}}
        @include('products.partials.product-main', ['product' => $product])

        {{-- 2. Thông số chi tiết sản phẩm từ bảng product_details --}}
        @include('products.partials.product-detail', ['details' => $product->detail])

        {{-- 3. Sản phẩm liên quan carousel --}}
        @include('products.partials.related-products', ['products' => $relatedProducts])

        {{-- 4. Tổng quan đánh giá + phân tích phần trăm --}}
        @include('products.partials.rating-summary', ['product' => $product])

        {{-- 5. Danh sách đánh giá từ khách hàng --}}
        @include('products.partials.reviews-list', ['reviews' => $product->reviews])

    </div>
@endsection
