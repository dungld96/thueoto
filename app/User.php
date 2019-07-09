<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\RoleUser;
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

    public function checkAdmin(){
        $role = $this->getRole();
        $flag = false;
        if( $role > 1){ 
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

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
    if (is_array($roles)) {
        return $this->hasAnyRole($roles) || 
                abort(401, 'This action is unauthorized.');
    }
    return $this->hasRole($roles) || 
            abort(401, 'This action is unauthorized.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
    return null !== $this->roles()->whereIn(‘name’, $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
    return null !== $this->roles()->where(‘name’, $role)->first();
    }
}
