<form action="{{ route('order.process') }}" method="POST">
    @csrf

    <div class="card">
        <div class="card-body">
            <ol class="activity-checkout mb-0 px-4 mt-3">

                {{-- Billing Info --}}
                <li class="checkout-item">
                    <div class="avatar checkout-icon p-1">
                        <div class="avatar-title rounded-circle bg-primary">
                            <i class="bx bxs-receipt text-white font-size-20"></i>
                        </div>
                    </div>
                    <div class="feed-item-list">
                        <h5 class="font-size-16 mb-1">Billing Info</h5>
                        <p class="text-muted text-truncate mb-4">Recipient information</p>

                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label for="billing-name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="billing_name" id="billing-name" placeholder="Enter name" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="billing-email-address" class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="billing_email" id="billing-email-address" placeholder="Enter email" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="billing-phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="billing_phone" id="billing-phone" placeholder="Enter phone" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="billing-address" class="form-label">Address</label>
                            <textarea class="form-control" name="billing_address" id="billing-address" rows="3" placeholder="Enter full address" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label for="billing-country" class="form-label">Country</label>
                                <select class="form-control form-select" name="billing_country" id="billing-country" required>
                                    <option value="">Select Country</option>
                                    <option value="VN">Vietnam</option>
                                    <option value="US">United States</option>
                                    <option value="JP">Japan</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="billing-city" class="form-label">City</label>
                                <input type="text" class="form-control" name="billing_city" id="billing-city" placeholder="Enter city" required>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="zip-code" class="form-label">Zip / Postal code</label>
                                <input type="text" class="form-control" name="billing_zip" id="zip-code" placeholder="Enter code" required>
                            </div>
                        </div>
                    </div>
                </li>

                {{-- Shipping Info (có thể thêm địa chỉ giao hàng khác nếu khác billing) --}}
                <li class="checkout-item">
                    <div class="avatar checkout-icon p-1">
                        <div class="avatar-title rounded-circle bg-primary">
                            <i class="bx bxs-truck text-white font-size-20"></i>
                        </div>
                    </div>
                    <div class="feed-item-list">
                        <h5 class="font-size-16 mb-1">Shipping Info</h5>
                        <p class="text-muted text-truncate mb-4">Another address</p>
                        <div class="row" id="shipping-address-list">
                            {{-- Optionally render saved addresses, or checkbox: use billing address as shipping --}}
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="same-as-billing" name="shipping_same_as_billing" value="1" checked>
                                <label class="form-check-label" for="same-as-billing">
                                    Same as billing address
                                </label>
                            </div>
                        </div>
                    </div>
                </li>

                {{-- Payment Info --}}
                <li class="checkout-item">
                    <div class="avatar checkout-icon p-1">
                        <div class="avatar-title rounded-circle bg-primary">
                            <i class="bx bxs-wallet-alt text-white font-size-20"></i>
                        </div>
                    </div>
                    <div class="feed-item-list">
                        <h5 class="font-size-16 mb-1">Payment Info</h5>
                        <p class="text-muted text-truncate mb-4">Choose your payment method</p>
                        <div class="row">
                            @php
                                $payments = [
                                    ['value' => 'card', 'icon' => 'bx bx-credit-card', 'label' => 'Credit / Debit Card'],
                                    ['value' => 'momo', 'image' => 'payments/momo.svg', 'label' => 'Momo'],
                                    ['value' => 'vnpay', 'image' => 'payments/vnpay.svg', 'label' => 'VNPay'],
                                    ['value' => 'cod', 'icon' => 'bx bx-money', 'label' => 'Cash on Delivery'],
                                ];
                            @endphp

                            @foreach ($payments as $payment)
                                <div class="col-lg-3 col-sm-6">
                                    <label class="card-radio-label w-100">
                                        <input type="radio" name="payment_method" value="{{ $payment['value'] }}" class="card-radio-input" {{ $payment['value'] == 'cod' ? 'checked' : '' }}>
                                        <span class="card-radio py-3 text-center text-truncate">
                                            @if (isset($payment['icon']))
                                                <i class="{{ $payment['icon'] }} d-block h2 mb-3"></i>
                                            @else
                                                <img src="{{ asset('storage/' . $payment['image']) }}" alt="{{ $payment['label'] }}" style="height: 40px;" class="mb-2">
                                            @endif
                                            <div>{{ $payment['label'] }}</div>
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div>

    <div class="row my-4">
        <div class="col">
            <a href="{{ route('products.index') }}" class="btn btn-link text-muted">
                <i class="mdi mdi-arrow-left me-1"></i> Continue Shopping
            </a>
        </div>
        <div class="col text-end">
            <button type="submit" class="btn btn-lg btn-primary">
                <i class="mdi mdi-cart-outline me-1"></i> Order Now
            </button>
        </div>
    </div>
</form>