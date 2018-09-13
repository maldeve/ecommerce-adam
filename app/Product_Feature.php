<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Feature;

class Product_Feature extends Model
{
    protected $guarded = [];

    // relate to products
    public function product() {
        return $this->belongsTo(Product::class);
    }

    // relate to features
    public function feature() {
        return $this->belongsTo(Feature::class);
    }
}
