<?php 
namespace App\Services\Interfaces;

interface ProductServiceInterface extends ServiceInterface
{
    public function getBestSelling($limit = 10);
    public function getFeatured($limit = 10);
    public function getPopular($limit = 10);
    public function getNewArrivals($limit = 10); 
}