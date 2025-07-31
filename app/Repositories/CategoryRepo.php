<?php 
namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
    public function createWithUpload(array $data): Category
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
            $data['thumbnail'] = $data['thumbnail']->store('categories', 'public');
        }

        if (isset($data['banner']) && $data['banner'] instanceof \Illuminate\Http\UploadedFile) {
            $data['banner'] = $data['banner']->store('categories', 'public');
        }

        return $this->create($data);
    }

    public function updateWithUpload($id, array $data): Category
    {
        $category = $this->findById($id);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
            if ($category->thumbnail) {
                Storage::disk('public')->delete($category->thumbnail);
            }
            $data['thumbnail'] = $data['thumbnail']->store('categories', 'public');
        }

        if (isset($data['banner']) && $data['banner'] instanceof \Illuminate\Http\UploadedFile) {
            if ($category->banner) {
                Storage::disk('public')->delete($category->banner);
            }
            $data['banner'] = $data['banner']->store('categories', 'public');
        }

        $category->update($data);

        return $category;
    }

    public function deleteWithMedia($id): bool
    {
        $category = $this->findById($id);

        if ($category->thumbnail) {
            Storage::disk('public')->delete($category->thumbnail);
        }

        if ($category->banner) {
            Storage::disk('public')->delete($category->banner);
        }

        return $this->delete($id);
    }

}