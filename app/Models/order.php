<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderItems () {
        return $this->hasMany (order_item::class);
    }

    public function products () {
        return $this->hasManyThrough (Product::class, order_item::class, 'order_id', 'id', 'id', 'product_id');
    }


}
