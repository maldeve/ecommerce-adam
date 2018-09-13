<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Product_Feature;

class Product extends Model
{
    protected $guarded = [];

    // relate with categories
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // relate with product_features
    public function product_features() {
        return $this->hasMany(Product_Feature::class);
    }
    
}
