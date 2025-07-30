<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Hoặc logic phân quyền nếu cần
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id ?? null;

        return [
            'name'          => ['required', 'string', 'max:255'],
            'slug'          => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'description'   => ['nullable', 'string'],
            'price'         => ['required', 'numeric', 'min:0'],
            'sale_price'    => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'weight'        => ['required', 'string', 'max:255'],
            'unit'          => ['required', Rule::in(['g', 'kg', 'ml', 'l'])],
            'stock_quantity'=> ['required', 'integer', 'min:0'],
            'category_id'   => ['required', 'exists:categories,id'],
            'status'        => ['required', 'boolean'],
            'image'         => ['nullable', 'image', 'max:2048'], // 2MB limit
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'Please enter the product name.',
            'price.required'        => 'Price is required.',
            'price.numeric'         => 'Price must be a number.',
            'sale_price.lte'        => 'Sale price must be less than or equal to price.',
            'weight.required'       => 'Weight is required.',
            'unit.required'         => 'Please select a valid unit.',
            'stock_quantity.required' => 'Stock quantity is required.',
            'category_id.required'  => 'Please select a category.',
            'status.required'       => 'Please select product status.',
            'image.image'           => 'Uploaded file must be an image.',
        ];
    }
}
