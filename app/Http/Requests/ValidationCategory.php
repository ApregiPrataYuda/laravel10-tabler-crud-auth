<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationCategory extends FormRequest
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
            // Mengizinkan huruf dan spasi untuk name_category
            'name_category' => 'required|regex:/^[A-Za-z\s]+$/|max:255',
    
            // Mengizinkan huruf, angka, spasi, dan simbol tertentu untuk description_category
            'description_category' => 'required|regex:/^[A-Za-z0-9\s\-_\/.+]+$/',
        ];
    }
    
    public function messages(): array
    {
        return [
            'name_category.required' => 'The category name field is required.',
            'name_category.regex' => 'The category name may only contain letters and spaces.',
            'name_category.max' => 'The category name may not be greater than 255 characters.',
            
            'description_category.required' => 'The description field is required.',
            'description_category.regex' => 'The description may only contain letters, numbers, spaces, and the following symbols: - _ / . +.',
        ];
    }
    
    // Membersihkan input sebelum validasi
    // Mencegah input seperti " Kategori " menjadi "Kategori"
    protected function prepareForValidation()
    {
        $this->merge([
            'name_category' => trim($this->name_category),
            'description_category' => trim($this->description_category),
        ]);
    }
    

}
