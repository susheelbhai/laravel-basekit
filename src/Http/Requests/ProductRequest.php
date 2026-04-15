<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->filled('seller_id')) {
            $this->merge(['seller_id' => null]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'seller_id' => ['nullable', 'integer', 'exists:sellers,id'],
            'product_category_id' => 'required|integer|exists:product_categories,id',

            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',

            'short_description' => 'nullable|string',
            'description' => 'nullable|string',

            'price' => 'required|numeric|min:0',
            'mrp' => 'nullable|numeric|min:0',

            'stock' => 'nullable|integer|min:0',
            'manage_stock' => 'required|in:0,1',

            'images' => 'nullable|array',
            'images.*' => 'image|max:2048', // 2MB per image (max is in KB)

            'thumbnail' => 'nullable|image|max:5120',
            'gallery' => 'nullable',

            'is_active' => 'required|in:0,1',
            'is_featured' => 'required|in:0,1',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];
    }
}
