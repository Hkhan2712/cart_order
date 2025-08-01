<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'address_id' => 'nullable|exists:shipping_addresses,id',
            'payment_method' => 'required|in:cod,card,vnpay,momo',
            'shipping_same_as_billing' => 'nullable|boolean',
        ];

        if (!$this->filled('address_id')) {
            $rules = array_merge($rules, [
                'billing_name' => 'required|string|max:255',
                'billing_email' => 'required|email',
                'billing_phone' => 'required|string|max:15',
                'billing_address' => 'required|string|max:255',
                'billing_city' => 'required|string|max:255',
                'billing_country' => 'required|string',
                'billing_zip' => 'nullable|string|max:20',
            ]);
        }

        return $rules;
    }
}
