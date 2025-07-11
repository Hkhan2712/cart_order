<?php 
namespace App\Repositories\Eloquent;

use App\Models\ShippingAddress;
use App\Repositories\Interfaces\ShippingRepoInterface;

class ShippingRepo extends BaseRepo implements ShippingRepoInterface 
{
    public function __construct(ShippingAddress $model)
    {
        parent::__construct($model);
    }
}