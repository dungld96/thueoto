<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;	
use App\User;
use App\Models\UserRole;
use App\Models\Role;
class LoginController extends Controller
{
    public function login(LoginRequest $request){
    	$attempt = array('email'=> $request['email'], 'password'=> $request['password']);
    	if(Auth::attempt($attempt)){
            $role = Auth::user()->getRole();
    		if($role == 1){
                return redirect()->route('user_reservation');
            }else if($role > 1){
                return redirect()->route('dashboard');
            }
    	}else{
    		return 'invalid email/password';
    	}
    }
   
}
