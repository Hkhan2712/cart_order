<?php 
namespace App\Http\Controllers\Api;

use App\Services\ProductService;

class ProductController extends ApiController
{
    protected ProductService $productService;

   public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function show($id)
    {
        $product = $this->productService->find($id);
        return view('products.show', compact('product'));
    }
}