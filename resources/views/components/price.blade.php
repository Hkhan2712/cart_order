@props(['price', 'sale'])

@if ($sale && $sale < $price)
    <del class="text-muted">{{ number_format($price, 0) }}&#8363;</del>
    <span class="h6 m-0 fw-semibold text-dark">{{ number_format($sale, 0) }}&#8363;</span>
    <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
        {{ round(100 - ($sale / $price * 100)) }}% OFF
    </span>
@else
    <span class="h6 text-dark">{{ number_format($price, 0) }}&#8363;</span>
@endif
