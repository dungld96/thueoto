<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserRole;
use App\Models\Role;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    public function checkAdmin(){
        $role = $this->getRole();
        $flag = false;
        if( $role > 1){ 
            $flag = true;
        }
        return $flag;
    }

    public function getRole(){
        $userRole = UserRole::where('user_id', $this->id)->first();
        if($userRole){
            return Role::find($userRole->role_id)->role;
        }else{
            return null;
        }
    }
}
