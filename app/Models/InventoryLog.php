<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $fillable = ['product_id', 'quantity_change', 'stock_after_change', 'type', 'reference_type', 'reference_id', 'note'];

    public function product() { return $this->belongsTo(Product::class); }
}
