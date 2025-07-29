@extends('admin.layouts.master')

@section('title', 'Category Management')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Category Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <!-- Add Button -->
            <div class="mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                    <i class="fas fa-plus"></i> Add New Category
                </button>
            </div>

            <!-- Category Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Category List</h5>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tree as $category)
                                @include('admin.categories.partials.category-row', ['category' => $category, 'depth' => 0])
                            @empty
                                <tr><td colspan="8" class="text-center">No categories found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>
@include('admin.categories.partials.confirm-modal')
@include('admin.categories.partials.create-modal')
@include('admin.categories.partials.edit-modal')
@endsection
