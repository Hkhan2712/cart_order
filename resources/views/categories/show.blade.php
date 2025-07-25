@extends('layouts.app')

@section('title', 'AquaTerra - ' . $category->name)

@section('content')
<div class="p-5 mx-3">
    <h1 class="mb-5 d-flex justify-content-center" style="font-size: 4rem;">{{$category->name}}</h1>
   @if ($category->banner_url)
    <img src="{{ $category->banner_url }}" 
         alt="{{ $category->name }} Banner"
         class="mb-5 w-100 rounded-4"
         style="object-fit: cover;">
    @endif

    <div class="row">
        <section class="col-12 col-md-9">
            @include('products.partials.product-grid', ['products' => $products])
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
