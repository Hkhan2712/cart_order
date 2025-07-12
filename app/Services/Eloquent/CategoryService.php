<?php 
namespace App\Services\Eloquent;

use App\Repositories\Interfaces\CategoryRepoInterface;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryService extends Service implements CategoryServiceInterface
{
    public function __construct(CategoryRepoInterface $repo) {
        parent::__construct($repo);
    }
}