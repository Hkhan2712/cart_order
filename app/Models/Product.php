<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price', 'sale_price', 'weight', 'unit', 'stock_quantity', 'category_id', 'status', 'published_at'];

    public function category() { return $this->belongsTo(Category::class); }

    public function images() { return $this->hasMany(ProductImage::class); }

    public function reviews() { return $this->hasMany(Review::class); }
    
    public function detail() { return $this->hasOne(ProductDetail::class); }

    public function orderItems() { return $this->hasMany(OrderItem::class); }

    public function inventoryLogs() { return $this->hasMany(InventoryLog::class); }

    public function wishlists() { return $this->hasMany(Wishlist::class); }

    public function cartItems() { return $this->hasMany(CartItem::class); }

    public function getImagePathAttribute(): string
    {
        $this->loadMissing('images');

        $image = $this->images->firstWhere('is_primary', 1);

        $path = $image ? 'storage/' . $image->image_path : 'storage/products/default.jpg';
        $fullPath = public_path($path);

        return file_exists($fullPath)
            ? asset($path)
            : asset('storage/products/default.jpg');
    }
}

