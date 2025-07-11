<?php 
namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepoInterface;

class OrderRepo extends BaseRepo implements OrderRepoInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}