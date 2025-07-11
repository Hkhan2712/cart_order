<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $fillable = ['order_id', 'old_status', 'new_status', 'changed_by_type', 'changed_by_id', 'note'];

    public function order() { return $this->belongsTo(Order::class); }
}