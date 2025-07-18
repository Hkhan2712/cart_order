<?php 
namespace App\Repositories\Eloquent;

use App\Models\OrderStatusLog;
use App\Repositories\Interfaces\OrderStatusRepoInterface;

class OrderStatusRepo extends BaseRepo implements OrderStatusRepoInterface
{
    protected function model(): string { return OrderStatusLog::class; }
}