<?php 
namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepoInterface;

class OrderRepo extends BaseRepo implements OrderRepoInterface
{
    protected function model(): string { return Order::class; }
}