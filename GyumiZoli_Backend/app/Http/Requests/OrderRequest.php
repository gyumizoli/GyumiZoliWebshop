<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric',
            'status' => 'required|in:pending,completed,canceled',
        ];
    }
}
