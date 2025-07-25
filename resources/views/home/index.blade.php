@extends('layouts.app')

@section('title', 'AquaTerra - Homepage')

@section('content')
    
    @include('home._hero')
    
    @include('home._category_carousel', [
        'categories' => $categories,
        'link' => route('categories.index')
    ])

    @include('home._best_selling')
    @include('home._promo_banners')
    
    <x-product-carousel
        id="featured-products"
        title="Featured Products"
        :products="$featured"
        link="{{route('products.index', ['sort' => 'featured'])}}"
    />
    <x-newsletter-banner />
    <x-product-carousel
        id="popular-products"
        title="Most Popular Products"
        :products="$popular"
        link="{{route('products.index', ['sort' => 'popular'])}}"  
    />
    <x-product-carousel
        id="arrived-products"
        title="Just arrived"
        :products="$newArrivals"
        link="{{route('products.index', ['sort' => 'arrived'])}}"
    />
    <!-- blog section -->
    <x-blog-section />
    <!-- download app -->
    <x-app-download 
        title="Download AquaTerra App"
        subtitle="Online Orders made easy, fast, and reliable"
        appStoreUrl="https://apps.apple.com/aquaterra"
        googlePlayUrl="https://play.google.com/store/apps/details?id=aquaterra"
    />
    <x-popular-searches 
        title="People are also looking for"
        :searches="[
            'Blue diamon almonds',
            'Angie’s Boomchickapop Corn',
            'Salty kettle Corn',
            'Chobani Greek Yogurt',
            'Sweet Vanilla Yogurt',
            'Foster Farms Takeout Crispy wings',
            'Warrior Blend Organic',
            'Chao Cheese Creamy',
            'Chicken meatballs',
        ]"
    />
    <x-store-benefits :benefits="[
        ['icon' => 'package', 'title' => 'Free delivery', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'secure', 'title' => '100% secure payment', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'quality', 'title' => 'Quality guarantee', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'savings', 'title' => 'Guaranteed savings', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ['icon' => 'offers', 'title' => 'Daily offers', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
        ]" 
    />

@endsection
