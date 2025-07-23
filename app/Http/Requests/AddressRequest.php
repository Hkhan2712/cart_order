<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'ward_code' => 'required|string',
            'district_code' => 'required|string',
            'city_code' => 'required|string',
            'is_default' => 'nullable|boolean',
        ];

        if ($this->isMethod('PATCH') || $this->isMethod('PUT')) {
            $rules['is_default'] = 'nullable|boolean'; 
        }

        return $rules;
    }
}
