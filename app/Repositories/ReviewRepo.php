<?php 
namespace App\Repositories\Eloquent;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepoInterface;

class ReviewRepo extends BaseRepo implements ReviewRepoInterface
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }
}