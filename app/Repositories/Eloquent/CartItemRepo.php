<?php 
namespace App\Repositories\Eloquent;

use App\Models\CartItem;
use App\Repositories\Interfaces\CartItemRepoInterface;

class CartItemRepo extends BaseRepo implements CartItemRepoInterface
{
    public function __construct(CartItem $model)
    {
        parent::__construct($model);
    }
}