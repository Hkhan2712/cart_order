@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/categories.css') }}">
@endpush

@extends('layouts.app')

@section('title', 'AquaTerra - All Category')

@section('content')
<div class="py-5 mx-3">
    <h1 class="mb-5 d-flex justify-content-center" style="font-size: 4rem;">All Categories</h1>

    {{-- Banner (check that the file exists in public/store/categories/categories-banner.jpg) --}}
    <img src="{{ asset('storage/categories/1.jpg') }}" 
        alt="Category Banner"
        class="mb-5 w-100 rounded-4"
        style="object-fit: cover;">

    {{-- Show all categories --}}
    <div class="container">
        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('categories.show', $category->slug) }}" class="featured-categories-module__category-tile d-block text-center text-decoration-none text-dark">
                        <img class="featured-categories-module__category-tile__image mb-2 rounded" 
                            src="{{ asset($category->thumbnail_url) }}" 
                            alt="{{ $category->name }}">
                        <div class="featured-categories-module__category-tile__title">{{ $category->name }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


</div>

{{-- Store benefits section --}}
<x-store-benefits :benefits="[
    ['icon' => 'package', 'title' => 'Free delivery', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'secure', 'title' => '100% secure payment', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'quality', 'title' => 'Quality guarantee', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'savings', 'title' => 'Guaranteed savings', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'offers', 'title' => 'Daily offers', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
]" />
@endsection