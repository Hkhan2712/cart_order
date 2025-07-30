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
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
						<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
					</svg> Add New Product
				</a>
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
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>-</td> <!-- Chưa có parent -->
                                    <td>{{ $category->products_count ?? 0 }}</td>
                                    <td>
                                        <span class="badge bg-{{ $category->status ? 'success' : 'secondary' }}">
                                            {{ $category->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <button data-id="{{ $category->id }}" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                        <div class="mt-3 px-3">
                            {{ $categories->links() }}
                        </div>
                </div>
            </div>

        </div>
    </div>
</main>
@include('admin.components.confirm-modal')
@endsection
