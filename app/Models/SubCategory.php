<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class SubCategory extends Model {
        use HasFactory;

        protected $guarded = [];

        public function category (): \Illuminate\Database\Eloquent\Relations\BelongsTo {
           return $this->belongsTo (ProductCategory::class, "product_category_id", "id");
        }
    }
