<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customers_name',
        'customers_phone',
        'shipping_date',
        'delivery_date',
        'shipping_address',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
