<?php 
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\View\View;

class CategoryViewController extends Controller {
    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService) {}
    public function index(): View {
        return view('categories.index', [
            'categories' => $this->categoryService->all()
        ]);
    }

    public function show(string $slug): View {
        $category = $this->categoryService->findBySlug($slug);
        $products = $this->productService->paginateByCategory($category->id, 10);
        return view('categories.show', compact('category', 'products'));
    }
}