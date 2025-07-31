<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'banner',
        'status',
        'path',
    ];
    
    public function products() { return $this->hasMany(Product::class); }

    public function getThumbnailUrlAttribute(): string
    {
        $path = 'storage/categories/' . $this->thumbnail;

        return (!empty($this->thumbnail) && File::exists(public_path($path)))
            ? asset($path)
            : asset('storage/categories/default.jpg');
    }

    public function getBannerUrlAttribute()
    {
        $path = 'categories/banners/' . $this->banner;

        if ($this->banner && Storage::disk('public')->exists($path)) {
            return asset('storage/' . $path);
        }

        return null;
    }

    public function getDepthAttribute()
    {
        return substr_count($this->path, '/');
    }

    public function getParentIdAttribute(): ?int
    {
        if (!$this->path || $this->path === "/{$this->id}") {
            return null;
        }

        $segments = explode('/', trim($this->path, '/'));
        $parentId = count($segments) >= 2 ? $segments[count($segments) - 2] : null;

        return $parentId ? (int) $parentId : null;
    }


    public function getIsRootAttribute()
    {
        return $this->depth === 1;
    }

}

