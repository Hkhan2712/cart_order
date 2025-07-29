<?php

namespace App\Repositories;

use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductRepo extends BaseRepo
{
    public function __construct(Product $product, protected ImageService $imageService)
    {
        $this->model = $product;
    }
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

    public function getAllProductsActive() {
        return $this->model
                    ->where('status', 1)
                    ->get();
    }
    public function createProductWithDetails(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

            $productData = Arr::only($data, [
                'name', 'slug', 'description', 'price', 'sale_price',
                'weight', 'unit', 'stock_quantity', 'category_id', 'status'
            ]);

            $product = Product::create($productData);

            $product->detail()->create([
                'brand' => $data['brand'] ?? null,
                'expiry' => $data['expiry'] ?? null,
                'weight_detail' => $data['weight_detail'] ?? null,
                'packaging_type' => $data['packaging_type'] ?? null,
                'manufacturer_name' => $data['manufacturer_name'] ?? null,
                'shipped_from' => $data['shipped_from'] ?? null,
            ]);

            if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                $paths = $this->imageService->uploadWithSizes($data['image'], 'products');

                $product->images()->create([
                    'image_path' => $paths['medium'],
                    'original_path' => $paths['original'] ?? null,
                    'thumbnail_path' => $paths['thumbnail'] ?? null,
                    'is_primary' => true
                ]);
            }

            return $product;
        });
    }

    public function updateProductWithDetails(Product $product, array $data): bool
    {
        return DB::transaction(function () use ($product, $data) {
            $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

            $productData = Arr::only($data, [
                'name', 'slug', 'description', 'price', 'sale_price',
                'weight', 'unit', 'stock_quantity', 'category_id', 'status'
            ]);

            $product->update($productData);

            // Cập nhật thông tin chi tiết sản phẩm
            $product->detail()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'brand' => $data['brand'] ?? null,
                    'expiry' => $data['expiry'] ?? null,
                    'weight_detail' => $data['weight_detail'] ?? null,
                    'packaging_type' => $data['packaging_type'] ?? null,
                    'manufacturer_name' => $data['manufacturer_name'] ?? null,
                    'shipped_from' => $data['shipped_from'] ?? null,
                ]
            );

    
            if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                $product->images()->where('is_primary', true)->each(function ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    if ($image->original_path) Storage::disk('public')->delete($image->original_path);
                    if ($image->thumbnail_path) Storage::disk('public')->delete($image->thumbnail_path);
                    $image->delete();
                });

                $paths = $this->imageService->uploadWithSizes($data['image'], 'products');

                $product->images()->create([
                    'image_path' => $paths['medium'],
                    'original_path' => $paths['original'] ?? null,
                    'thumbnail_path' => $paths['thumbnail'] ?? null,
                    'is_primary' => true
                ]);
            }

            return true;
        });
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

    public function getProductsWithPaginate($limit = 20)
    {
        return $this->model
            ->with('category')  
            ->latest()
            ->paginate($limit);
    }
}
