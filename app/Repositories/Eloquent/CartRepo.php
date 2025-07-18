<?php 
namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepoInterface;

class CartRepo extends BaseRepo implements CartRepoInterface
{
    protected function model(): string { return Cart::class; }
}