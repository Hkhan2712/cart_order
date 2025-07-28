<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total_amount', 'order_status', 'shipping_address_id',
        'coupon_id', 'order_note', 'shipping_fee', 'payment_id'
    ];

    public function user() { return $this->belongsTo(User::class); }

    public function address() { return $this->belongsTo(ShippingAddress::class, 'shipping_address_id'); }

    public function coupon() { return $this->belongsTo(Coupon::class); }

    public function items() { return $this->hasMany(OrderItem::class); }

    public function payment() { return $this->belongsTo(Payment::class); }

    public function statusLogs() { return $this->hasMany(OrderStatusLog::class); }
}
