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
                    <p class="text-muted text-truncate mb-4">Sed ut perspiciatis unde omnis iste</p>
                    <form>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label for="billing-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="billing-name" placeholder="Enter name">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="billing-email-address" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="billing-email-address" placeholder="Enter email">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="billing-phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="billing-phone" placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="billing-address" class="form-label">Address</label>
                            <textarea class="form-control" id="billing-address" rows="3" placeholder="Enter full address"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Country</label>
                                <select class="form-control form-select">
                                    <option value="0">Select Country</option>
                                    <option value="VN">Vietnam</option>
                                    <option value="US">United States</option>
                                    <option value="JP">Japan</option>
                                </select>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="billing-city" class="form-label">City</label>
                                <input type="text" class="form-control" id="billing-city" placeholder="Enter city">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="zip-code" class="form-label">Zip / Postal code</label>
                                <input type="text" class="form-control" id="zip-code" placeholder="Enter code">
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            {{-- Shipping Info --}}
            <li class="checkout-item">
                <div class="avatar checkout-icon p-1">
                    <div class="avatar-title rounded-circle bg-primary">
                        <i class="bx bxs-truck text-white font-size-20"></i>
                    </div>
                </div>
                <div class="feed-item-list">
                    <h5 class="font-size-16 mb-1">Shipping Info</h5>
                    <p class="text-muted text-truncate mb-4">Neque porro quisquam est</p>
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <label class="card-radio-label mb-0">
                                <input type="radio" name="address" class="card-radio-input" checked>
                                <div class="card-radio text-truncate p-3">
                                    <span class="fs-14 mb-4 d-block">Address 1</span>
                                    <span class="fs-14 mb-2 d-block">Bradley McMillian</span>
                                    <span class="text-muted fw-normal text-wrap d-block mb-1">109 Clarksburg Park Road, AZ 85901</span>
                                    <span class="text-muted fw-normal d-block">Mo. 012-345-6789</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <label class="card-radio-label mb-0">
                                <input type="radio" name="address" class="card-radio-input">
                                <div class="card-radio text-truncate p-3">
                                    <span class="fs-14 mb-4 d-block">Address 2</span>
                                    <span class="fs-14 mb-2 d-block">Bradley McMillian</span>
                                    <span class="text-muted fw-normal text-wrap d-block mb-1">Alternate Address Info</span>
                                    <span class="text-muted fw-normal d-block">Mo. 012-345-6789</span>
                                </div>
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
                        {{-- Credit / Debit --}}
                        <div class="col-lg-3 col-sm-6">
                            <label class="card-radio-label">
                                <input type="radio" name="pay-method" value="card" class="card-radio-input">
                                <span class="card-radio py-3 text-center text-truncate">
                                    <i class="bx bx-credit-card d-block h2 mb-3"></i>
                                    Credit / Debit Card
                                </span>
                            </label>
                        </div>

                        {{-- Momo --}}
                        <div class="col-lg-3 col-sm-6">
                            <label class="card-radio-label">
                                <input type="radio" name="pay-method" value="momo" class="card-radio-input">
                                <span class="card-radio py-3 text-center text-truncate">
                                    <img src="{{ asset('storage/payments/momo.svg') }}" alt="Momo" style="height: 40px;" class="mb-2">
                                    <div>Momo</div>
                                </span>
                            </label>
                        </div>

                        {{-- VNPay --}}
                        <div class="col-lg-3 col-sm-6">
                            <label class="card-radio-label">
                                <input type="radio" name="pay-method" value="vnpay" class="card-radio-input">
                                <span class="card-radio py-3 text-center text-truncate">
                                    <img src="{{ asset('storage/payments/vnpay.svg') }}" alt="VNPay" style="height: 40px;" class="mb-2">
                                    <div>VNPay</div>
                                </span>
                            </label>
                        </div>

                        {{-- COD --}}
                        <div class="col-lg-3 col-sm-6">
                            <label class="card-radio-label">
                                <input type="radio" name="pay-method" value="cod" class="card-radio-input" checked>
                                <span class="card-radio py-3 text-center text-truncate">
                                    <i class="bx bx-money d-block h2 mb-3"></i>
                                    Cash on Delivery
                                </span>
                            </label>
                        </div>
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
        <a href="#" class="btn btn-lg btn-primary">
            <i class="mdi mdi-cart-outline me-1"></i> Order Now
        </a>
    </div>
</div>