<?php 
namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepo;

class CategoryService extends Service 
{
    public function __construct(CategoryRepo $repo) {
        parent::__construct($repo);
    }

    public function findBySlug(string $slug): Category {
        return $this->repo->findBySlug($slug);
    }
}