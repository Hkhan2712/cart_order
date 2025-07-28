<?php 
namespace App\Services;

class HomeService 
{
    protected $productService;
    protected $categoryService;
    
    public function __construct(
        ProductService $productService,
        CategoryService $categoryService
    ) 
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function getCategories() {
        return $this->categoryService->all();
    }

    public function getBestSellingProducts() {
        return $this->productService->getBestSelling(8);
    }

    public function getFeaturedProducts() {
        return $this->productService->getFeatured(8);
    }
    public function getPopularProducts() {
        return $this->productService->getPopular(8);
    }
    public function getNewArrivals() {
        return $this->productService->getNewArrivals(8);
    }
}