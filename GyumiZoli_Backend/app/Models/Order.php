<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'items',
        'totalPrice',
        'customers_name',
        'customers_phone',
        'delivery_address',
        'payment_method',
        'status',
        'delivery_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingDetails()
    {
        return $this->hasOne(ShippingDetail::class);
    }
}
