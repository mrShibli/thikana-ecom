<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumb_image',
        'slug',
        'images',
        'tags',
        'old_price',
        'offer',
        'status',
        'quantity',
        'category_id',
        'sub_category_id',
    ];

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function order_items()
    {
        return $this->hasMany(order_item::class);
    }

}
