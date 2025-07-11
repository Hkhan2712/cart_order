<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'product_id', 'rating', 'comment', 'is_verfied_purchase'];

    public function user() { return $this->belongsTo(User::class); }

    public function product() { return $this->belongsTo(Product::class); }

    public function images() { return $this->hasMany(ReviewImage::class); }
}
