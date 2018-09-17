<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Usertype;
use \App\Auth;
use App\Order;
use App\Product;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','usertype_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // relate with usertype
    public function Usertype() {
        return $this->belongsTo(Usertype::class);
    }

    // relate with orders
    public function orders() {
        return $this->hasMany(Order::class);
    }

    // relate with products
    public function products() {
        return $this->hasMany(Product::class);
    }
}
