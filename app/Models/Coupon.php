<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Coupon extends Model
{
    protected $table = 'coupons';

    public function users()
    {
    return $this->belongsToMany(User::class);
    }
}
