@extends('admin.layouts.master')

@section('title', 'Add New Product')

@section('content')
<main class="app-main">
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Add New Product</h3>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <strong>Basic Information</strong>
                        </div>
                        <div class="card-body">
                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <!-- Price & Sale Price -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price *</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sale_price" class="form-label">Sale Price</label>
                                    <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
                                </div>
                            </div>

                            <!-- Weight & Unit -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="weight" class="form-label">Weight</label>
                                    <input type="text" name="weight" class="form-control" value="{{ old('weight') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="unit" class="form-label">Unit</label>
                                    <select name="unit" class="form-select">
                                        <option value="">-- Select Unit --</option>
                                        @foreach(['g', 'kg', 'ml', 'l'] as $unit)
                                            <option value="{{ $unit }}" {{ old('unit') == $unit ? 'selected' : '' }}>{{ strtoupper($unit) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Stock -->
                            <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', 0) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-light">
                            <strong>About this Item</strong>
                        </div>
                        <div class="card-body">
                            @php
                                $fields = ['brand', 'expiry', 'weight_detail', 'packaging_type', 'manufacturer_name', 'shipped_from'];
                            @endphp

                            @foreach($fields as $field)
                                <div class="mb-3">
                                    <label for="{{ $field }}" class="form-label text-capitalize">{{ str_replace('_', ' ', $field) }}</label>
                                    <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <strong>Settings</strong>
                        </div>
                        <div class="card-body">
                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category *</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4 text-end">
                        <button class="btn btn-success w-100" type="submit">
                            <i class="bi bi-plus-circle"></i> Create Product
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
