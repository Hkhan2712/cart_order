<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\View\View;

class ProductViewController extends Controller {
    public function __construct(
        protected ProductServiceInterface $productService,
        protected CategoryServiceInterface $categoryService) {}

    public function index(): View 
    {
        return view('products.index', [
            'categories' => $this->categoryService->all(),
            'products' => $this->productService->all()
        ]);
    }
    public function show(string $slug)
    {
        $product = $this->productService->getBySlugWithDetailsAndReviews($slug);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        return view('products.show', compact('product', 'relatedProducts'));
    }
}