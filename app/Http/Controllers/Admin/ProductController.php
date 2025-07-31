<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\CategoryRepo;
use App\Repositories\ProductRepo;
use App\Repositories\OrderRepo;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepo $productRepo,
        protected CategoryRepo $categoryRepo,
        protected OrderRepo $orderRepo,
    ) {}

    public function index()
    {
        $products = $this->productRepo->getProductsWithPaginate(10);
        $categoryStats = $this->productRepo->getTotalProductsByCategories();
        $allCategories = $this->categoryRepo->all();
        $salesData = $this->orderRepo->getMonthlySalesData();
        return view('admin.products.index', compact('products', 'allCategories', 'categoryStats', 'salesData'));
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
        try {
            $this->productRepo->delete($product->id);

            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Product deleted successfully.'
                ]);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Delete product failed: ' . $e->getMessage());

            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Failed to delete product.'
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to delete product.');
        }
    }

}
