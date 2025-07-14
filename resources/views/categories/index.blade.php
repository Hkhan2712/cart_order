@extends('layouts.app')

@section('title', 'AquaTerra - All Category')

@section('content')
<div class="py-5 mx-3">
    <h1 class="mb-5 d-flex justify-content-center" style="font-size: 4rem;">All Category</h1>
    {{-- Banner like sale off, ...  --}}
    <div style="background-image: url('{{ asset('store/categories/categories-banner.jpg') }}'); background-repeat: no-repeat; background-size: cover;"></div>
    <div>

    </div>
    {{-- Show all categories --}}
    <div class="container">
        
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
