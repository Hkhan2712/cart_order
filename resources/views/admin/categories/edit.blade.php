@extends('admin.layouts.master')

@section('title', 'Edit Category')

@section('content')
<main class="app-main">
    <div class="container-fluid py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Edit Category: {{ $category->name }}</h3>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <strong>Basic Information</strong>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Category Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Path</label>
                                <input type="text" name="path" class="form-control" value="{{ old('path', $category->path) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <strong>Settings</strong>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            @if ($category->thumbnail)
                                <div class="mb-3">
                                    <label class="form-label">Current Thumbnail</label><br>
                                    <img src="{{ asset('storage/' . $category->thumbnail) }}" class="img-fluid rounded" style="max-height: 150px;">
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Change Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control">
                            </div>

                            @if ($category->banner)
                                <div class="mb-3">
                                    <label class="form-label">Current Banner</label><br>
                                    <img src="{{ asset('storage/' . $category->banner) }}" class="img-fluid rounded" style="max-height: 150px;">
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Change Banner</label>
                                <input type="file" name="banner" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="bi bi-save"></i> Update Category
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
