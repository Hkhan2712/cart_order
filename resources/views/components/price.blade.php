@props(['price', 'sale'])

@if ($sale && $sale < $price)
    <span class="h5 text-danger me-2">${{ number_format($sale, 2) }}</span>
    <del class="text-muted">${{ number_format($price, 2) }}</del>
    <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
        {{ round(100 - ($sale / $price * 100)) }}% OFF
    </span>
@else
    <span class="h5 text-dark">${{ number_format($price, 2) }}</span>
@endif
