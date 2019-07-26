<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    CONST CUSTOMER_ROLE = 1;
    CONST MOD_ROLE = 2;
    CONST ADMIN_ROLE = 3;


    protected $table = 'roles';

    public function users()
    {
    return $this->belongsToMany(User::class);
    }
}
