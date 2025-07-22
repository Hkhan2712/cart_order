<div class="card checkout-order-summary">
    <div class="card-body">
        <div class="p-3 bg-light mb-3">
            <h5 class="font-size-16 mb-0">Order Summary</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Details</th>
                        <th class="text-end">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($cartItems->items as $item)
                        @php $subtotal += $item['sale_price'] * $item['quantity']; @endphp
                        <tr>
                            <td><img src="{{ $item['image'] }}" alt="" class="avatar-lg rounded"></td>
                            <td>
                                <h6 class="text-truncate">{{ $item['name'] }}</h6>
                                <small class="text-muted">${{ number_format($item['sale_price'], 2) }} x {{ $item['quantity'] }}</small>
                            </td>
                            <td class="text-end">${{ number_format($item['sale_price'] * $item['price'], 2) }}</td>
                        </tr>
                    @endforeach
                    <tr><td colspan="2">Sub Total</td><td class="text-end">${{ number_format($subtotal, 2) }}</td></tr>
                    <tr><td colspan="2">Shipping</td><td class="text-end">$25.00</td></tr>
                    <tr><td colspan="2">Tax</td><td class="text-end">$18.20</td></tr>
                    <tr class="bg-light">
                        <td colspan="2"><strong>Total</strong></td>
                        <td class="text-end"><strong>${{ number_format($subtotal + 25 + 18.2, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>