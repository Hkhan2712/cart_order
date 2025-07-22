<?php 
namespace App\Repositories;

use App\Repositories\BaseRepo;
use App\Models\Coupon;

class CouponRepo extends BaseRepo 
{
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }
}