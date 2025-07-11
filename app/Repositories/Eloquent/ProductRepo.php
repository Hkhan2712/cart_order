<?php 
namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepoInterface;

class ProductRepo extends BaseRepo implements ProductRepoInterface 
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}