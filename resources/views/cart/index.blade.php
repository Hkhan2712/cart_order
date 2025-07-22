@extends('layouts.app')

@section('title', 'AquaTerra - Cart')

@section('content')
<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Cart - {{ count($cart->items)}} items</h5>
          </div>
          <div class="card-body">
            @foreach ($cart->items as $item)
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                        <div class="bg-image hover-overlay hover-zoom ripple rounded">
                            <img src="{{ asset($item['image']) }}" class="w-100" alt="{{ $item['name'] }}">
                        </div>
                    </div>

                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
					<a href="/products/{{$item['slug']}}" class="text-decoration-none"><strong>{{ $item['name'] }}</strong></a>
					<p>Category: {{ $item['category']['name'] ?? '-' }}</p>
					<button class="btn btn-primary btn-sm me-1 mb-2 remove-item" data-id="{{ $item['product_id'] }}">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
							<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
						</svg>
					</button>
					<button class="btn btn-danger btn-sm mb-2 wishlist-btn">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
							<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
						</svg>
					</button>
                </div>

                @php
                    $originalPrice = $item['price'];
                    $salePrice = $item['sale_price'];
                    $unitPrice = $salePrice ?? $originalPrice;
                    $subtotal = $unitPrice * $item['quantity'];
                @endphp

                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="d-flex flex-column" style="max-width: 300px">
                    
                    <p class="mb-2">
                        Price: 
                        @if ($salePrice)
                            <span class="text-muted text-decoration-line-through me-2">
                                {{ number_format($originalPrice, 0, ',', '.') }}₫
                            </span>
                            <span class="fw-bold text-danger">
                                {{ number_format($salePrice, 0, ',', '.') }}₫
                            </span>
                        @else
                            <span class="fw-bold">
                                {{ number_format($originalPrice, 0, ',', '.') }}₫
                            </span>
                        @endif
                    </p>

                    <div class="d-flex mb-2">
                    <button class="btn btn-primary px-3 me-2 update-quantity" data-id="{{ $item['product_id']}}" data-type="decrease">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8"/>
                        </svg>
                    </button>

                    <input min="1" name="quantity" value="{{ $item['quantity'] }}" type="number" class="form-control text-center quantity-input" data-id="{{ $item['product_id']}}"/>

                    <button class="btn btn-primary px-3 ms-2 update-quantity" data-id="{{ $item['product_id'] }}" data-type="increase">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                        </svg>
                    </button>
                    </div>

                    <p class="text-start text-md-center mb-0">
                        Total: <strong class="line-total">{{ number_format($subtotal, 0, ',', '.') }}₫</strong>
                    </p>
                </div>
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
			<img class="me-2" width="45px" src="/storage/payments/vnpay.svg" alt="Vnpay" />
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
                    <span><strong class="summary-subtotal">{{ number_format($cart->total, 0, ',', '.') }}₫</strong></span>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    VAT (10%)
                    <span class="cart-vat">{{ number_format($total['vat'], 0, ',', '.') }}₫</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <strong>Total amount</strong>
                    <span><strong class="cart-total-vat">{{ number_format($total['totalWithVAT'], 0, ',', '.') }}₫</strong></span>
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