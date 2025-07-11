<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = [
        'product_id',
        'brand',
        'expiry',
        'weight_detail',
        'packaging_type',
        'warranty_period',
        'registration_number',
        'serial_number',
        'manufacturer_name',
        'shipped_from',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

