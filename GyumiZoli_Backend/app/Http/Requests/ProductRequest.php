<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'promotion' => 'nullable|boolean',
            'discount_price' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:255',
            'category' => 'required|string|max:50',
        ];
    }
}
