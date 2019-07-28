<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\RoleUser;
use App\Models\Role;
use App\Models\Image;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check current user has moderator role
     * @return boolean  
     */

    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }

    // public function images()
    // {
    //     return $this->hasMany(Image::class);
    // }


    public function isModOrAdmin(){
        $role = $this->getRole();
        $flag = false;
        if( $role > Role::CUSTOMER_ROLE){ 
            $flag = true;
        }
        return $flag;
    }

    public function isAdmin(){
        $role = $this->getRole();
        $flag = false;
        if( $role == Role::ADMIN_ROLE){ 
            $flag = true;
        }
        return $flag;
    }

    public function getRole(){
        $userRole = RoleUser::where('user_id', $this->id)->first();
        if($userRole){
            return Role::find($userRole->role_id)->role;
        }else{
            return null;
        }
    }

    public static function getCustomer()
    {
        $customers = self::whereHas("roles", function($q){ $q->where("role", Role::CUSTOMER_ROLE); })
                         ->get();
        return $customers;

    }

}
