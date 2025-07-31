<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name'      => ['required', 'string', 'max:255'],
            'slug'      => ['nullable', 'string', 'max:255'],
            'thumbnail' => ['nullable', 'image', 'max:2048'], 
            'banner'    => ['nullable', 'image', 'max:4096'], 
            'status' => ['required', 'in:0,1'],
            'path'      => ['nullable', 'string', 'max:255'],
        ];

        if ($this->isMethod('post')) {
            // Store
            $rules['slug'][] = 'unique:categories,slug';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Update: ignore unique for current category
            $id = $this->route('id') ?? $this->route('category');
            $rules['slug'][] = 'unique:categories,slug,' . $id;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Category name is required.',
            'name.max'           => 'Category name may not be greater than 255 characters.',
            'slug.unique'        => 'Slug has already been taken.',
            'thumbnail.image'    => 'Thumbnail must be an image.',
            'thumbnail.max'      => 'Thumbnail size must not exceed 2MB.',
            'banner.image'       => 'Banner must be an image.',
            'banner.max'         => 'Banner size must not exceed 4MB.',
        ];
    }
}
