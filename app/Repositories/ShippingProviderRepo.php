<?php 
namespace App\Repositories\Eloquent;

use App\Models\ShippingProvider;
use App\Repositories\Interfaces\ShippingProviderRepoInterface;

class ShippingProviderRepo extends BaseRepo implements ShippingProviderRepoInterface
{
    public function __construct(ShippingProvider $model)
    {
        parent::__construct($model);
    }
}