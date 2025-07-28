<?php 
namespace App\Repositories;

use App\Models\ProductImage;

class ProductImgRepo extends BaseRepo
{
    protected function model(): string { return ProductImage::class; }
}