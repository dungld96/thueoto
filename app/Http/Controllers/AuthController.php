<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\auth\logintest;
use App\Http\Requests\auth\logintest2;
use App\User;
use App\Models\UserRole;
class AuthController extends Controller
{
    
    public function auth_car_list(){
    	return view('auth.list');
    }

    public function auth_contact(){
    	return view('auth.contact');
    } 

    public function auth_about(){
    	return view('auth.about');
    } 

    public function auth_account(){
    	if(Auth::check()){
    		return redirect()->route('user_account');
    	}else{
    		return view('auth.register');
    	}
    }

    public function auth_logincheck(Request $request, logintest2 $check){
            dd('a');
        
    	$attempt = array('email'=> $request['email'], 'password'=> $request['password']);

    	if(Auth::attempt($attempt)){
            dd('a');
            $role_id = UserRole::where('user_id', Auth::user()->id);
    		if($role_id == 1){
                return redirect()->route('user_reservation');
            }else if(Auth::user()->role_id >= 2){
                return redirect()->route('admin_home');
            }
    	}else{
    		return 'invalid email/password';
    	}
    }

    public function auth_register(Request $request, logintest $check){

    	$new_user = new User;
    	$new_user->fname = $request['fname'];
    	$new_user->lname = $request['lname'];
    	$new_user->username = $request['username'];
    	$new_user->email =  $request['email'];
    	$new_user->password = bcrypt($request['password']);
    	$new_user->role_id = 2;
        $new_user->contact = $request['contact'];
        $new_user->license = $request['license'];
    	$new_user->save();

    	return redirect()->back()->with('success', 'You have registered successfully!');

    	
    }
}
