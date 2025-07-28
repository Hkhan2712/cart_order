@extends('layouts.app')

@section('title', 'AquaTerra - Shop')

@section('content')
<div class="py-5 mx-3">
    <h1 class="mb-5 d-flex justify-content-center" style="font-size: 4rem;">Deals</h1>
    <div class="row">
        {{-- Sidebar Filter (col-12 on mobile, col-md-3 on desktop) --}}
        <aside class="col-12 col-md-3 mb-4 mb-md-0">
            @include('products.partials.filters')
        </aside>

        {{-- Product Grid (col-12 on mobile, col-md-9 on desktop) --}}
        <section class="col-12 col-md-9">
            @include('products.partials.product-grid', ['products' => $products])
        </section>
    </div>
</div>

<x-store-benefits :benefits="[
    ['icon' => 'package', 'title' => 'Free delivery', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'secure', 'title' => '100% secure payment', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'quality', 'title' => 'Quality guarantee', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'savings', 'title' => 'Guaranteed savings', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
    ['icon' => 'offers', 'title' => 'Daily offers', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipi elit.'],
]" />
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('filter-form');
        const productList = document.getElementById('product-list');

        form.querySelectorAll('input[type="checkbox"]').forEach(input => {
            input.addEventListener('change', function () {
                const formData = new FormData(form);

                fetch("{{ route('products.filter') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.text())
                .then(html => {
                    productList.innerHTML = html;
                });
            });
        });
    });
</script>
@endpush
