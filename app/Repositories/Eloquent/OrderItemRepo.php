<?php 
namespace App\Repositories\Eloquent;

use App\Models\OrderItem;
use App\Repositories\Interfaces\OrderItemRepoInterface;

class OrderItemRepo extends BaseRepo implements OrderItemRepoInterface
{
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }
}