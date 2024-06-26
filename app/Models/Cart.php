<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'qunt', 'price', 'option_id', 'user_id'];
    public function product() {
        return $this->belongsTo(Product::class)->select ('id', 'title', 'thumb_image', 'old_price', 'offer');
    }

}
