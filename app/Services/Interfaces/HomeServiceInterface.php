<?php 
namespace App\Services\Interfaces;

interface HomeServiceInterface {
    public function getCategories();
    public function getBestSellingProducts();
    public function getFeaturedProducts();
    public function getPopularProducts();
    public function getNewArrivals();
}