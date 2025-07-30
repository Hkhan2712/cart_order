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

    public function getWithProductCountOnlyTopLevel()
    {
        return $this->model
            ->whereRaw("LENGTH(path) - LENGTH(REPLACE(path, '/', '')) = 1")
            ->withCount('products')
            ->orderByDesc('created_at')
            ->get();
    }
    
    public function getAllWithProductCountPaginated(int $limit = 10)
    {
        return $this->model->withCount('products')
                ->latest()->paginate($limit);
    }
    public function attachParentsToCategories($categories)
    {
        $all = $this->model->get()->keyBy('id');

        foreach ($categories as $cat) {
            $ids = array_filter(explode('/', $cat->path));
            $parentId = count($ids) > 1 ? $ids[count($ids) - 2] : null;
            $cat->parent = $parentId ? $all[$parentId] ?? null : null;
        }

        return $categories;
    }

    
    public function getTopLevelCategories() {
        return $this->model
            ->whereRaw("LENGTH(path) - LENGTH(REPLACE(path, '/', '')) = 1")
            ->orderBy('name')
            ->get();
    }

    public function getDescendants($categoryId) {
        $prefix = "/$categoryId";

        return $this->model
                    ->where('path', 'LIKE', "$prefix/%")
                    ->orderBy('path')
                    ->get();
    }

    public function getAncestors($category)
    {
        $ids = array_filter(explode('/', $category->path));

        return $this->model
            ->whereIn('id', $ids)
            ->orderByRaw("FIELD(id, " . implode(',', $ids) . ")")
            ->get();
    }
    
    public function buildTree($categories, $parentId = null): array
    {
        $tree = [];

        foreach ($categories as $category) {
            if ($category->parent_id === $parentId) {
                $children = $this->buildTree($categories, $category->id);
                if ($children) {
                    $category->children = $children;
                }
                $tree[] = $category;
            }
        }

        return $tree;
    }

}