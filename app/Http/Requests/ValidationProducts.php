<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationProducts extends FormRequest
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
        return [
            'name_product' => 'required|regex:/^[A-Za-z0-9\s\-_\/.+]+$/|max:255',
            'id_category' => 'required',
            'description_product' => 'required|regex:/^[A-Za-z0-9\s\-_\/.+]+$/',
        ];
    }
    
    public function messages(): array
    {
        return [
            'name_product.required' => 'The product name field is required.',
            'name_product.regex' => 'The product name may only contain letters, numbers, spaces, and the following symbols: - _ / . +..',
            'name_product.max' => 'The product name may not be greater than 255 characters.',
            'id_category.required' => 'The category name field is required.',
            'description_product.required' => 'The description field is required.',
            'description_product.regex' => 'The description may only contain letters, numbers, spaces, and the following symbols: - _ / . +.',
        ];
    }
    
    // Membersihkan input sebelum validasi
    // Mencegah input seperti " Kategori " menjadi "Kategori"
    protected function prepareForValidation()
    {
        $this->merge([
            'name_product' => trim($this->name_product),
            'description_product' => trim($this->description_product),
        ]);
    }
}
