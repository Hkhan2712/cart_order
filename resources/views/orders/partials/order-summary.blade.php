<div class="card checkout-order-summary">
    <div class="card-body">
        <div class="p-3 bg-light mb-3">
            <h5 class="font-size-16 mb-0">Order Summary</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th style="width: 80px;">Product</th>
                        <th>Details</th>
                        <th class="text-end" style="width: 100px;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" style="padding: 0; border: none;">
                            <div style="max-height: 350px; overflow-y: auto;">
                                <table class="table table-centered table-nowrap mb-0" style="table-layout: fixed;">
                                    <tbody>
                                        @php $subtotal = 0; @endphp
                                        @foreach ($cartItems->items as $item)
                                            @php 
                                                $price = ($item['sale_price'] === 0) ? $item['price'] : $item['sale_price'];
                                                $subtotal += $price * $item['quantity']; 
                                            @endphp
                                            <tr>
                                                <td style="width: 80px;">
                                                    <img src="{{ $item['image'] }}" alt="" class="img-fluid rounded" style="max-width: 60px;">
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 text-truncate" style="max-width: 200px; font-size: 14px;">
                                                        {{ $item['name'] }}
                                                    </h6>
                                                    <small class="text-muted">{{ number_format($price, 0) }}₫ x {{ $item['quantity'] }}</small>
                                                </td>
                                                <td class="text-end" style="width: 100px;">{{ number_format($price * $item['quantity'], 0) }}₫</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr><td colspan="2">Sub Total</td><td class="text-end">{{ number_format($subtotal, 0) }}₫</td></tr>
                    <tr><td colspan="2">Shipping</td><td class="text-end">12,000₫</td></tr>
                    <tr><td colspan="2">VAT</td><td class="text-end">{{ number_format($subtotal * 0.1, 0) }}₫</td></tr>
                    <tr class="bg-light">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="text-end"><strong>{{ number_format($subtotal + 12000 + ($subtotal * 0.1), 0) }}₫</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
