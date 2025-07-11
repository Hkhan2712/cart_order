<?php 
namespace App\Repositories\Eloquent;

use App\Models\InventoryLog;
use App\Repositories\Interfaces\InventoryLogRepoInterface;

class InventoryRepo extends BaseRepo implements InventoryLogRepoInterface
{
    public function __construct(InventoryLog $model)
    {
        parent::__construct($model);
    }
}