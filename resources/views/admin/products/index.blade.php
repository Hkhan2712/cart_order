@extends('admin.layouts.master')

@section('title', 'Product Management')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Product Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            {{-- Product Chart --}}
            <div class="row my-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Total Products by Category</h5>
                        </div>
                        <div class="card-body" style="position: relative; max-height: 500px;">
                            <canvas id="productsByCategoryChart" class = "w-100"
                                data-chart='@json([
                                    'labels' => $categoryStats->pluck("category_name"),
                                    'counts' => $categoryStats->pluck("total")
                                ])'>
                            </canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Another Chart</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $months = array_keys($salesData);
                                $totals = array_values($salesData);
                            @endphp
                            <canvas id="productCategoryChart2" class="w-100"
                                data-chart='@json([
                                    'labels' => $months,
                                    'data' => $totals 
                                ])'
                                >
                                
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center px-5">
                    <h5 class="card-title">Product List</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary d-flex ms-auto align-items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg> Add New Product
                    </a>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
								<th>Sale Price</th>
								<th>Rating</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>{{ number_format($product->price) }}₫</td>
                                    <td>{{ number_format($product->sale_price)}}₫</td>
									<td>{{ $product->rating}}</td>
									<td>{{ $product->stock_quantity }}</td>
                                    <td>
                                        <span class="badge bg-{{ $product->status ? 'success' : 'secondary' }}">
                                            {{ $product->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
											Edit
										</a>
                                        <!-- Delete Button -->
                                        <button class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-url="{{ route('admin.products.destroy', $product->id) }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center">No products found.</td></tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                    <div class="mt-3 px-3">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('admin.components.confirm-modal')
@endsection
@vite('resources/js/admin/charts/products-by-category.js')
@vite('resources/js/admin/charts/monthly-sales.js')