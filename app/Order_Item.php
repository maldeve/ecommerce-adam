<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Order_Item extends Model
{
    // relate with orders
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
