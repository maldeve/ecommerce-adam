<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{
    protected $guarded = [];

    // relate to categories
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
