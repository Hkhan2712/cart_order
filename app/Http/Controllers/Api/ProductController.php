<?php 
namespace App\Http\Controllers\Api;

use App\Services\Interfaces\ProductServiceInterface;

class ProductController extends ApiController
{
    protected ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function show($id)
    {
        $product = $this->productService->find($id);
        return view('products.show', compact('product'));
    }
}