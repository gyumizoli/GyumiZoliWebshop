<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'product_id'];

    // Automatikusan teljes URL-t ad vissza
    public function getPathAttribute($value)
    {
        return url('storage/' . $value);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
