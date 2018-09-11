<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Usertype extends Model
{
    protected $guarded = [];

    // relate to user
    public function users() {
        return $this->hasMany(User::class);
    }
}
