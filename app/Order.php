<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Order_Status;
use App\Order_Item;

class Order extends Model
{
    // relate with users
    public function user() {
        return $this->belongsTo(User::class);
    }

    // relate with order_statuses
    public function order_status() {
        return $this->belongsTo(Order_Status::class);
    }

    // relate with order_items
    public function order_items() {
        return $this->hasMany(Order_Item::class);
    }
}
