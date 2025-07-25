<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

class ProductViewController extends Controller {
    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService) {}

    public function index(): View 
    {
        return view('products.index', [
            'categories' => $this->categoryService->all(),
            'products' => $this->productService->all()
        ]);
    }
    
    public function show(string $slug): View
    {
        $product = $this->productService->getBySlugWithDetailsAndReviews($slug);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request){
        $query = $request->input('q');
        $products = $this->productService->search($query, 30);

        return view('products.search', compact('products', 'query'));
    }

    public function ajaxFilter(Request $request) {
        $query = Product::query();

        if ($request->has('categories')) {
            $query->whereIn('category_id', $request->input('categories', []));
        }

        $products = $query->paginate(30);

        return view('products.partials.product-grid', compact('products'))->render();   
    }
}