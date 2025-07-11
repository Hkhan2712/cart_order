<?php 
namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepoInterface;

class CartRepo extends BaseRepo implements CartRepoInterface
{
    public function __construct(Cart $model)
    {  
        parent::__construct($model);
    }
}