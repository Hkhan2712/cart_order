<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'thumbnail', 'slug', 'path'];

    public function products() { return $this->hasMany(Product::class); }
}

