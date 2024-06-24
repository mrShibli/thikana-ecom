<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'name'
    ];

    public function options()
    {
        return $this->hasMany(VariationOption::class);
    }
}