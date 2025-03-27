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
            'items' => 'required|array',
            'items.*.product.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'totalPrice' => 'required|numeric|min:0',
            'customers_name' => 'required|string|max:255',
            'customers_phone' => 'required|string|max:15',
            'customers_email' => 'required|email|max:255',
            'delivery_address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:cash,credit_card,bank_transfer',
            'status' => 'required|string|in:pending,completed,canceled',
            'delivery_date' => 'nullable|date|after_or_equal:today',
        ];
    }
}
