<?php 
namespace App\Repositories\Eloquent;

use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepoInterface;

class PaymentRepo extends BaseRepo implements PaymentRepoInterface
{
    protected function model(): string { return Payment::class;}
}