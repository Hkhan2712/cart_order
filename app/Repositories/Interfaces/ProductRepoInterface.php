<?php
namespace App\Repositories\Interfaces;

use App\Models\Product;

interface ProductRepoInterface extends Repository {
    public function orderBySoldCountDesc($limit = 10);
    public function orderByViewDesc($limit = 10);
    public function latestByCreatedAt($limit = 10);
    public function where(array $conditions, $limit = 10);
    public function getFeaturedProducts($limit);
    public function findBySlugWithDetailsAndReviews(string $slug);
    public function getRelatedProducts(Product $product);
}