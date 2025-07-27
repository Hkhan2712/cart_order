<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepo;

class CategoryController extends Controller {
    public function __construct(protected CategoryRepo $categoryRepo)
    {}

    public function index() {
        $categories = $this->categoryRepo->all();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }
}