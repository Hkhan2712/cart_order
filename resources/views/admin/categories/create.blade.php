@extends('admin.layouts.master')

@section('title', 'Add New Category')

@section('content')
<main class="app-main">
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Add New Category</h3>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <strong>Basic Information</strong>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Category Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Path</label>
                                <input type="text" name="path" class="form-control" value="{{ old('path') }}">
                            </div>
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
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Banner</label>
                                <input type="file" name="banner" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button class="btn btn-success w-100" type="submit">
                            <i class="bi bi-plus-circle"></i> Create Category
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
