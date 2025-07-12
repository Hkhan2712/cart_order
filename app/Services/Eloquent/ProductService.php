<?php
namespace App\Services\Eloquent;

use App\Repositories\Interfaces\ProductRepoInterface;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductService extends Service implements ProductServiceInterface
{
    // thu hẹp kiểu để IDE nhận phương thức đặc thù
    public function __construct(ProductRepoInterface $repo)
    {
        parent::__construct($repo);
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
}
