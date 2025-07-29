<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepo;
use App\Services\Service;
use Illuminate\Database\Eloquent\Collection;

class ProductService extends Service 
{
    public function __construct(ProductRepo $repo)
    {
        parent::__construct($repo);
    }
    public function getAllProductsActive() {
        return $this->repo->getAllProductsActive();
    }
    public function getBestSelling($limit = 10): Collection
    {
        return $this->repo->orderBySoldCountDesc($limit);
    }

    public function getFeatured($limit = 10): Collection
    {
        return $this->repo->getFeaturedProducts($limit);
    }

    public function getPopular($limit = 10): Collection
    {
        return $this->repo->orderByViewDesc($limit);
    }

    public function getNewArrivals($limit = 10): Collection
    {
        return $this->repo->latestByCreatedAt($limit);
    }

    public function getBySlugWithDetailsAndReviews(string $slug)
    {
        return $this->repo->findBySlugWithDetailsAndReviews($slug);
    }

    public function getRelatedProducts(Product $product)
    {
        return $this->repo->getRelatedProducts($product);
    }

    public function paginateByCategory($id, $limit)
    {
        return $this->repo->paginateByCategory($id, $limit);
    }

    public function search(string $query, int $perPage) {
        return $this->repo->search($query, $perPage);
    }
}
