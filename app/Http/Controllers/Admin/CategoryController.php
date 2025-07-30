<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(protected CategoryRepo $categoryRepo)
    {}

    public function index()
    {
        $categories = $this->categoryRepo->getAllWithProductCountPaginated(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('categories', 'public');
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('categories', 'public');
        }

        $this->categoryRepo->create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->categoryRepo->findById($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepo->findById($id);
        $data = $request->validated();

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if ($request->hasFile('thumbnail')) {
            // Xoá ảnh cũ nếu có
            if ($category->thumbnail) {
                Storage::disk('public')->delete($category->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('categories', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($category->banner) {
                Storage::disk('public')->delete($category->banner);
            }
            $data['banner'] = $request->file('banner')->store('categories', 'public');
        }

        $this->categoryRepo->update($id, $data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = $this->categoryRepo->findById($id);

        // Xoá hình ảnh
        if ($category->thumbnail) {
            Storage::disk('public')->delete($category->thumbnail);
        }

        if ($category->banner) {
            Storage::disk('public')->delete($category->banner);
        }

        $this->categoryRepo->delete($id);

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
