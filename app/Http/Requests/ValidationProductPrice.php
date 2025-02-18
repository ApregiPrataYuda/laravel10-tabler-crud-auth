<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationProductPrice extends FormRequest
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
            // 'price' => 'required',
            'product_id' => 'required',
            'start_date' => 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'price.required' => 'The product Price field is required.',
            'product_id.required' => 'The product Nama field is required.',
            'start_date.required' => 'The Start Date Price field is required.',
           
        ];
    }
    
    // Membersihkan input sebelum validasi
    // Mencegah input seperti " Kategori " menjadi "Kategori"
    protected function prepareForValidation()
    {
        $this->merge([
            'price' => trim($this->name_product),
        ]);
    }
}
