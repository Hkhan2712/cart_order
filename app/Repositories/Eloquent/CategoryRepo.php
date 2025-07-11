<?php 
namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CartRepoInterface;

class CategoryRepo extends BaseRepo implements CartRepoInterface 
{
    public function __construct(Category $model) 
    {
        parent::__construct($model);
    }
}