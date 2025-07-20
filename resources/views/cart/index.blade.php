@extends('layouts.app')

@section('title', 'AquaTerra - Cart')

@section('content')
<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Cart - {{ count($cart['items']) }} items</h5>
          </div>
          <div class="card-body">
            @foreach ($cart['items'] as $item)
              <div class="row mb-4">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                  <div class="bg-image hover-overlay hover-zoom ripple rounded">
                    <img src="{{ asset('storage/' . $item['product']->thumbnail) }}" class="w-100" alt="{{ $item['product']->name }}">
                  </div>
                </div>

                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                  <p><strong>{{ $item['product']->name }}</strong></p>
                  <p>Category: {{ $item['product']->category->name ?? '-' }}</p>
                  <button class="btn btn-primary btn-sm me-1 mb-2 remove-item" data-id="{{ $item['product']->id }}">
                    <i class="fas fa-trash"></i>
                  </button>
                  <button class="btn btn-danger btn-sm mb-2 wishlist-btn">
                    <i class="fas fa-heart"></i>
                  </button>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                  <div class="d-flex mb-4" style="max-width: 300px">
                    <button class="btn btn-primary px-3 me-2 update-quantity" data-id="{{ $item['product']->id }}" data-type="decrease">
                      <i class="fas fa-minus"></i>
                    </button>

                    <input min="1" name="quantity" value="{{ $item['quantity'] }}" type="number" class="form-control text-center quantity-input" data-id="{{ $item['product']->id }}"/>

                    <button class="btn btn-primary px-3 ms-2 update-quantity" data-id="{{ $item['product']->id }}" data-type="increase">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <p class="text-start text-md-center">
                    <strong>{{ number_format($item['total_price'], 0, ',', '.') }}₫</strong>
                  </p>
                </div>
              </div>
              <hr class="my-4" />
            @endforeach
          </div>
        </div>

        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <img class="me-2" width="45px" src="/storage/payments/visa.svg" alt="Visa" />
            <img class="me-2" width="45px" src="/storage/payments/mastercard.svg" alt="Mastercard" />
            <img class="me-2" width="45px" src="/storage/payments/momo.svg" alt="Momo" />
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>{{ number_format($cart['total'], 0, ',', '.') }}₫</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>Miễn phí</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <p class="mb-0">(VAT included)</p>
                </div>
                <span><strong>{{ number_format($cart['total'], 0, ',', '.') }}₫</strong></span>
              </li>
            </ul>
            <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg btn-block">
              Go to checkout
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
