<?php 
namespace App\Repositories\Eloquent;

use App\Models\ProductImage;
use App\Repositories\Interfaces\ProductImgRepoInterface;

class ProductImgRepo extends BaseRepo implements ProductImgRepoInterface 
{
    protected function model(): string { return ProductImage::class; }
}