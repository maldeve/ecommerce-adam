<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Order_Status extends Model
{
    // relate to orders
    public function orders() {
        return $this->hasMany(Order::class);
    }
}
