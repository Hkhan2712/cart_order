<?php 
namespace App\Repositories;

use App\Models\Order;

class OrderRepo extends BaseRepo 
{
    protected function model(): string { return Order::class; }
}