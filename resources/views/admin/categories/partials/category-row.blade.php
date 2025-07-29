<tr>
    <td>{{ $category->id }}</td>
    <td>{!! str_repeat('— ', $depth) !!}{{ $category->name }}</td>
    <td>{{ $category->slug }}</td>
    <td>{{ $category->parent->name ?? '-' }}</td>
    <td>{{ $category->products_count ?? 0 }}</td>
    <td>
        <span class="badge bg-{{ $category->status ? 'success' : 'secondary' }}">
            {{ $category->status ? 'Visible' : 'Hidden' }}
        </span>
    </td>
    <td>{{ $category->created_at->format('Y-m-d') }}</td>
    <td>
        <button class="btn btn-sm btn-warning btn-edit-category"
                data-id="{{ $category->id }}"
                data-name="{{ $category->name }}"
                data-slug="{{ $category->slug }}"
                data-parent-id="{{ $category->parent_id }}"
                data-status="{{ $category->status }}"
                data-thumbnail="{{ $category->thumbnail }}"
                data-description="{{ $category->description }}"
                data-action="{{ route('admin.categories.update', $category->id) }}"
                data-bs-toggle="modal" data-bs-target="#editCategoryModal">
            Edit
        </button>

        <button class="btn btn-sm btn-danger btn-delete-category"
            data-id="{{ $category->id }}"
            data-name="{{ $category->name }}"
            data-url="{{ route('admin.categories.destroy', $category->id) }}">
            Delete
        </button>
    </td>
</tr>

@foreach ($category->children ?? [] as $child)
    @include('admin.categories.partials.category-row', ['category' => $child, 'depth' => $depth + 1])
@endforeach
