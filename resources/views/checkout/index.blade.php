@extends('layouts.app')

@section('title', 'AquaTerra - Checkout')

@push('styles')
<link href="{{ asset('css/pages/checkout.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" rel="stylesheet">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- LEFT: Billing, Shipping, Payment --}}
        <div class="col-xl-8">
            @include('checkout.partials.checkout-info');
        </div>
        {{-- RIGHT: Order Summary --}}
        <div class="col-xl-4">
            @include('checkout.partials.order-summary', ['cartItems' => $cartItems])
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/address.js') }}"></script>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush