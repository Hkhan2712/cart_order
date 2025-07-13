<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Category extends Model
{
    protected $fillable = ['name', 'thumbnail', 'slug', 'path'];

    public function products() { return $this->hasMany(Product::class); }

    public function getThumbnailUrlAttribute(): string
    {
        $path = 'images/categories/' . $this->thumbnail;

        return (!empty($this->thumbnail) && File::exists(public_path($path)))
            ? asset($path)
            : asset('images/categories/default.png');
    }
}

