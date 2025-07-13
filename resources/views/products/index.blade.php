@extends('layouts.app')

@section('title', 'AquaTerra - Shop')

@section('content')
    <div class="container mx-auto px-4 py-6 grid grid-cols-12 gap-6">
        {{-- Sidebar Filter (col-span-3) --}}
        <aside class="col-span-3">
            @include('products.partials.filters')
        </aside>

        {{-- Product Grid (col-span-9) --}}
        <section class="col-span-9">
            @include('products.partials.product-grid', ['products' => $products])
        </section>
    </div>
    <x-store-benefits :benefits="[
        ['icon' => 'package', 'title' => 'Free delivery', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'secure', 'title' => '100% secure payment', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'quality', 'title' => 'Quality guarantee', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'savings', 'title' => 'Guaranteed savings', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'offers', 'title' => 'Daily offers', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ]" 
    />

@endsection