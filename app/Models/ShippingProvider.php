<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingProvider extends Model
{
    protected $fillable = ['code', 'name', 'description', 'logo', 'api_key', 'api_url', 'webhook_url', 'fee_formula', 'is_active'];
}
