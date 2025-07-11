<?php 
namespace App\Repositories\Eloquent;

use App\Models\ProductImage;
use App\Repositories\Interfaces\ProductImgRepoInterface;

class ProductImgRepo extends BaseRepo implements ProductImgRepoInterface 
{
    public function __construct(ProductImage $model)
    {
        parent::__construct($model);        
    }
}