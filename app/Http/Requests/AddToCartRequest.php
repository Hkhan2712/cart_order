<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Please, choose product!',
            'product_id.exists' => 'Product is not exist',
            'quantity.required' => 'Please, enter quantity!',
            'quantity.integer' => 'Quantity must integer',
            'quantity.min' => 'At least 1',
        ];
    }
}
