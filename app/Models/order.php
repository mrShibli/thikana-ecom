<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function order_items()
    // {
    //     return $this->hasMany(order_item::class, 'order_id', 'id');
    // }

    // public function products()
    // {
    //     return $this->hasManyThrough(Product::class, order_item::class, 'order_id', 'id', 'id', 'product_id');
    // }

    // Change this relationship to eager load the product
    public function order_items()
    {
        return $this->hasMany(order_item::class)->with('product');
    }

    // Keep other existing relationships
    public function products()
    {
        return $this->hasManyThrough(Product::class, order_item::class, 'order_id', 'id', 'id', 'product_id');
    }

    // OrderItem.php
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
