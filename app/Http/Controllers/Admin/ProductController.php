<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\CategoryRepo;
use App\Repositories\ProductRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepo $productRepo,
        protected CategoryRepo $categoryRepo
    ) {}

    public function index()
    {
        $products = $this->productRepo->getProductsWithPaginate(10);
        $allCategories = $this->categoryRepo->all();
        return view('admin.products.index', compact('products', 'allCategories'));
    }

    public function create()
    {
        $categories = $this->categoryRepo->all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }
        $this->productRepo->createProductWithDetails($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryRepo->all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        $this->productRepo->updateProductWithDetails($product, $data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }



    public function destroy(Product $product)
    {
        $this->productRepo->delete($product->id);
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
