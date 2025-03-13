<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'promotion',
        'discount_price',
        'category',
        'unit',
        'stock',
        'image_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
    public function getImageUrlAttribute($value)
    {
        return $value ? url('storage/' . $value) :null ;
    }
}
