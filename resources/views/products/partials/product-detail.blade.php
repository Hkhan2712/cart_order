<div class="mb-5">
    <h2 class="h5 mb-3">About this item</h2>
    <ul>
        <li><strong>Brand:</strong> {{ $product->detail->brand }}</li>
        <li><strong>Expiry:</strong> {{ $product->detail->expiry }}</li>
        <li><strong>Weight detail:</strong> {{ $product->detail->weight_detail }}</li>
        <li><strong>Packaging type:</strong> {{ $product->detail->packaging_type }}</li>
        <li><strong>Registration number:</strong> {{ $product->detail->registration_number }}</li>
        <li><strong>Serial number:</strong> {{ $product->detail->serial_number }}</li>
        <li><strong>Manufacturer:</strong> {{ $product->detail->manufacturer_name }}</li>
        <li><strong>Shipped from:</strong> {{ $product->detail->shipped_from }}</li>
    </ul>
</div>
