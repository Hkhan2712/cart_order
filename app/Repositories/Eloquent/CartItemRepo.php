<?php 
namespace App\Repositories\Eloquent;

use App\Models\CartItem;
use App\Repositories\Interfaces\CartItemRepoInterface;

class CartItemRepo extends BaseRepo implements CartItemRepoInterface
{
    protected function model(): string { return CartItem::class; }
}