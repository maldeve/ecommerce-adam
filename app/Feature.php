<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product_Feature;

class Feature extends Model
{
    protected $guarded = [];

    // relate with product_features
    public function product_features() {
        return $this->hasMany(Product_Feature::class);
    }

}
