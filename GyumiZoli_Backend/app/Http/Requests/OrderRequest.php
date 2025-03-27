<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'items' => 'required|array',
            'totalPrice' => 'required|numeric',
            'customers_name' => 'required|string',
            'customers_phone' => 'required|numeric',
            'customers_email' => 'required|email',
            'delivery_address' => 'required|string',
            'payment_method' => 'required|string',
            'status' => 'required|string',
            'delivery_date' => 'required|date',
        ];
    }

    public function messages() {
        return [
            'user_id.required'       => 'A felhasználó azonosító megadása kötelező.',
            'user_id.integer'        => 'A felhasználó azonosítónak számnak kell lennie.',
            'items.required'         => 'Az elemek megadása kötelező.',
            'items.array'            => 'Az elemeknek tömbnek kell lenniük.',
            'totalPrice.required'    => 'Az összár megadása kötelező.',
            'totalPrice.numeric'     => 'Az összárnak számnak kell lennie.',
            'customers_name.required'=> 'A vásárló név megadása kötelező.',
            'customers_name.string'  => 'A vásárló névnek szövegnek kell lennie.',
            'customers_phone.required'=> 'A telefonszám megadása kötelező.',
            'customers_phone.numeric' => 'A telefonszámnak számnak kell lennie.',
            'customers_email.required'=> 'Az email megadása kötelező.',
            'customers_email.email'  => 'Az email formátuma nem megfelelő.',
            'delivery_address.required'=> 'A szállítási cím megadása kötelező.',
            'delivery_address.string' => 'A szállítási címnek szövegnek kell lennie.',
            'payment_method.required'=> 'A fizetési mód megadása kötelező.',
            'payment_method.string'  => 'A fizetési módnak szövegnek kell lennie.',
            'status.required'        => 'A rendelés állapotának megadása kötelező.',
            'status.string'          => 'A rendelés állapotának szövegnek kell lennie.',
            'delivery_date.required' => 'A szállítási dátum megadása kötelező.',
            'delivery_date.date'     => 'A szállítási dátumnak érvényes dátumnak kell lennie.',
        ];
    }

    public function failedValidation( Validator $validator ) {

        throw new HttpResponseException( response()->json([

            "success" => false,
            "message" => "Beviteli hiba",
            "data" => $validator->errors()
        ]));
    }
}
