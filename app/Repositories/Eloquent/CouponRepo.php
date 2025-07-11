<?php 
namespace App\Repositories\Eloquent;

use App\Models\Coupon;
use App\Repositories\Interfaces\CouponRepoInterface;

class CouponRepo extends BaseRepo implements CouponRepoInterface
{
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }
}