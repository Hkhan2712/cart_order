<?php 
namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepoInterface;

class CategoryRepo extends BaseRepo implements CategoryRepoInterface 
{
    protected function model(): string { return Category::class; }

    public function findBySlug($slug) {
        return $this->model
                ->where('slug', $slug)
                ->firstOrFail();
    }
}