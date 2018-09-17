<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Order_Status;

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
}
