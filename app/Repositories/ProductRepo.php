<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepo extends BaseRepo
{
    protected function model(): string
    {
        return Product::class;
    }

    protected function baseQuery()
    {
        return $this->model
            ->with('images')
            ->withAvg('reviews', 'rating');
    }

    public function orderBySoldCountDesc(int $limit = 10): Collection
    {
        return $this->baseQuery()
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->limit($limit)
            ->get();
    }

    public function orderByViewDesc(int $limit = 10): Collection
    {
        return $this->baseQuery()
            ->orderByDesc('view_count')
            ->limit($limit)
            ->get();
    }

    public function latestByCreatedAt(int $limit = 10): Collection
    {
        return $this->baseQuery()
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getFeaturedProducts(int $limit = 10): Collection
    {
        return $this->baseQuery()
            ->orderByDesc('reviews_avg_rating')
            ->limit($limit)
            ->get();
    }

    public function where(array $conditions, int $limit = 10): Collection
    {
        return $this->baseQuery()
            ->where($conditions)
            ->limit($limit)
            ->get();
    }

    public function findBySlugWithDetailsAndReviews(string $slug): ?Product
    {
        return $this->model
            ->with(['detail', 'reviews.images', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function getRelatedProducts(Product $product, int $limit = 8): Collection
    {
        return $this->baseQuery()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit($limit)
            ->get();
    }

    public function paginateByCategory(int $categoryId, int $limit)
    {
        return $this->baseQuery()
            ->where('category_id', $categoryId)
            ->orderBy('id')
            ->cursorPaginate($limit);
    }

    public function search(string $query, int $perPage = 30)
    {
        return $this->model::search($query)->paginate($perPage);
    }

    public function countLowInventoryProducts(int $threshold = 10): int
    {
        return Product::where('stock_quantity', '<', $threshold)->count();
    }
}
