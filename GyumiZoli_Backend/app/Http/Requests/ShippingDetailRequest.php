<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'shipping_date' => 'required|date',
            'delivery_date' => 'nullable|date',
            'shipping_address' => 'required|string|max:100',
            'status' => 'required|string|max:20',
        ];
    }
}
