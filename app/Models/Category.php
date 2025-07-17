<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = ['name', 'thumbnail', 'slug', 'path'];

    public function products() { return $this->hasMany(Product::class); }

    public function getThumbnailUrlAttribute(): string
    {
        $path = 'images/categories/' . $this->thumbnail;

        return (!empty($this->thumbnail) && File::exists(public_path($path)))
            ? asset($path)
            : asset('images/categories/default.jpg');
    }

    public function getBannerUrlAttribute()
    {
        $path = 'categories/banners/' . $this->banner;

        if ($this->banner && Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        return null;
    }

}

