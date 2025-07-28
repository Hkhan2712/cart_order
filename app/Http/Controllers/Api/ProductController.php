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
}