<?php 
namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepoInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepo extends BaseRepo implements ProductRepoInterface 
{
    protected function model(): string { return Product::class; }
     
    public function orderBySoldCountDesc($limit = 10)
    {
        return $this->model
            ->with('images')
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take($limit)
            ->get();
    }

    public function orderByViewDesc($limit = 10)
    {
        return $this->model
            ->with('images')
            ->orderByDesc('view_count')
            ->take($limit)
            ->get();
    }

    public function latestByCreatedAt($limit = 10)
    {
        return $this->model
            ->with('images')
            ->latest('created_at')
            ->take($limit)
            ->get();
    }

    public function getFeaturedProducts($limit = 10): Collection
    {
        return $this->model
            ->with('images')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->limit($limit)
            ->get();
    }
    
    public function where(array $conditions, $limit = 10)
    {
        $query = $this->model->where($conditions);
        if ($limit) {
            $query->take($limit);
        }
        return $query->get();
    }
}