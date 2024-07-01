<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'image',
        'background_image',
        'status',
        'show_menu'
    ];

    public function subCategory () {
        return $this->hasMany (SubCategory::class)->where ("show_menu",true);
    }
}
