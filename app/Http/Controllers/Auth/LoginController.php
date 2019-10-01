<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;	
use App\User;
use App\Models\RoleUser;
use App\Models\Role;

class LoginController extends Controller
{

    public function loginView()
    {
        return view('auth._login');
    }

    public function login(LoginRequest $request){
        if(is_numeric($request->get('email'))){
            $attempt = array('phone_number'=> $request['email'], 'password'=> $request['password']);
        }else{
            $attempt = array('email'=> $request['email'], 'password'=> $request['password']);
        }

    	if(Auth::attempt($attempt)){
            $role = Auth::user()->getRole();
    		// if($role == 1){
            //     return redirect()->route('home-client');
            // }else if($role > 1){
            //     return redirect()->route('dashboard');
            // }

            return response()->json(['message'=>'Đăng nhập thành công', 'status' => 'success', 'role' => $role]);
    	}else{
            return response()->json(['message'=>'Thông tin đăng nhập không chính xác', 'status' => 'error']);
        }
    }
    
    public function logout(){
        Auth::logout();
    	return redirect()->route('home-client');
    }
   
}
