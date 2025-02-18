<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'file' => 'required|image|mimes:jpg,png|max:2048', 
            'product_name' => 'required|string|max:255', 
            'product_description' => 'nullable|string', 
            'product_price' => 'required|numeric|min:0', 
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'A fájl feltöltése kötelező.',
            'file.image' => 'A fájl egy érvényes kép kell, hogy legyen.',
            'file.mimes' => 'A fájl csak JPG vagy PNG formátumban lehet.',
            'file.max' => 'A fájl mérete nem haladhatja meg a 2 MB-ot.',
            'product_name.required' => 'A termék neve kötelező.',
            'product_name.string' => 'A termék neve szöveg kell, hogy legyen.',
            'product_name.max' => 'A termék neve legfeljebb 255 karakter lehet.',
            'product_description.string' => 'A termék leírása szöveg kell, hogy legyen.',
            'product_price.required' => 'A termék ára kötelező.',
            'product_price.numeric' => 'A termék ára szám kell, hogy legyen.',
            'product_price.min' => 'A termék ára nem lehet negatív.',
        ];
    }
}
