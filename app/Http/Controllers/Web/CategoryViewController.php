<?php 
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\View\View;

class CategoryViewController extends Controller {
    public function __construct(
        protected ProductServiceInterface $productService,
        protected CategoryServiceInterface $categoryService) {}
    public function index(): View {
        return view('categories.index', [
            'categories' => $this->categoryService->all()
        ]);
    }

    public function show(string $slug): View {
        $category = $this->categoryService->findBySlug($slug);
        $products = $this->productService->paginateByCategory($category->id, 30);
        return view('categories.show', compact('category', 'products'));
    }
}