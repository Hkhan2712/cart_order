<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller {
    public function __construct(protected CategoryRepo $categoryRepo)
    {}

    public function index()
    {
        $categories = $this->categoryRepo->getAllWithProductCount();
        $tree = $this->categoryRepo->buildTree($categories);
        $allCategories = $this->categoryRepo->all();
        return view('admin.categories.index', compact('tree', 'allCategories'));
    }

    public function update(Request $request, $id)
    {
        $category = $this->categoryRepo->findById($id);

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->status = $request->has('status');

        if ($request->hasFile('thumbnail')) {
            // handle upload
            $category->thumbnail = $request->file('thumbnail')->store('categories', 'public');
        }

        $category->save();

        return redirect()->back()->with('success', 'Category updated!');
    }


    public function delete() {

    }
}