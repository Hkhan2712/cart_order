<?php 
namespace App\Repositories;

use App\Models\Category;

class CategoryRepo extends BaseRepo 
{
    protected function model(): string { return Category::class; }

    public function findBySlug($slug) {
        return $this->model
                ->where('slug', $slug)
                ->firstOrFail();
    }

    public function findById($id) {
        return $this->model
                    ->where('id', $id)
                    ->firstOrFail();
    }
}