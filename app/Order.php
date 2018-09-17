<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    // relate with users
    public function user() {
        return $this->belongsTo(User::class);
    }
}
