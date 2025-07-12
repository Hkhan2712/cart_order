<?php 
namespace App\Services\Eloquent;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Interfaces\HomeServiceInterface;
use App\Services\Interfaces\ProductServiceInterface;

class HomeService implements HomeServiceInterface
{
    protected $productService;
    protected $categoryService;
    
    public function __construct(
        ProductServiceInterface $productService,
        CategoryServiceInterface $categoryService
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