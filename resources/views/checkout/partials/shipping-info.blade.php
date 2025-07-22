<div class="card mb-4">
    <div class="card-body">
        <div class="checkout-item">
            <div class="avatar checkout-icon p-1">
                <div class="avatar-title rounded-circle bg-primary">
                    <i class="bx bxs-truck text-white font-size-20"></i>
                </div>
            </div>
            <h5 class="font-size-16 mb-1">Shipping Info</h5>
            <div class="row">
                {{-- Bạn có thể lặp các địa chỉ giao hàng nếu có --}}
                <div class="col-md-6 mb-3">
                    <label class="card-radio-label">
                        <input type="radio" name="shipping_address" class="card-radio-input" checked>
                        <div class="card-radio p-3">
                            <span class="fs-14 mb-1 d-block">Default Address</span>
                            <span class="text-muted small">John Doe, 123 Main St, City, Country</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>