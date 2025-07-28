<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'role_id',
        'phone',
        'is_active',
        'shipping_address_id',
        'remember_token',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function role() { return $this->belongsTo(Role::class); }

    public function shippingAddress() { return $this->belongsTo(ShippingAddress::class, 'shipping_address_id'); }

    public function shippingAddresses() { return $this->hasMany(ShippingAddress::class); }

    public function orders() { return $this->hasMany(Order::class); }

    public function cart() { return $this->hasOne(Cart::class); }

    public function reviews() { return $this->hasMany(Review::class); }

    public function wishlists() { return $this->hasMany(Wishlist::class); }

    public function notifications() { return $this->hasMany(Notification::class); }

    public function activities() { return $this->hasMany(UserActivity::class); }

    public function socialAccounts() { return $this->hasMany(SocialAccount::class); }

    public function searchLogs() { return $this->hasMany(SearchLog::class); }

    public function hasPermissions(string $permission) {
        return $this->role?->permissions->contains('name', $permission);
    }
}

