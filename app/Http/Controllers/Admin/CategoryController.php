<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepo;
use Illuminate\Support\Facades\Log;

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

    public function edit($id)
    {
        $category = $this->categoryRepo->findById($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryRepo->createWithUpload($request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function update(CategoryRequest $request, $id)
    {
        $this->categoryRepo->updateWithUpload($id, $request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        try {
            $this->categoryRepo->deleteWithMedia($id);

            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Category deleted successfully.'
                ]);
            }

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Delete category failed: ' . $e->getMessage());

            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Failed to delete category.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to delete category.');
        }
    } 
}
