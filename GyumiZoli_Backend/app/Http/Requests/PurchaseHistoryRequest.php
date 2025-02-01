<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'purchase_date' => 'required|date',
            'quantity' => 'required|integer',
        ];
    }
}
