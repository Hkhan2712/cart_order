<?php 
namespace App\Repositories\Eloquent;

use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepoInterface;

class PaymentRepo extends BaseRepo implements PaymentRepoInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }
}