<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['user_id', 'fullname', 'phone', 'address', 'ward_code', 'district_code', 'city_code', 'is_default'];

    public function user() { return $this->belongsTo(User::class); }
}
