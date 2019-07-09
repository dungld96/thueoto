<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function create(RegisterRequest $request){
    	try {
            $new_user = new User;
            $new_user->name = $request['name'];

            if(is_numeric($request['phone_number'])){
                $new_user->phone_number = $request['phone_number'];
            }else{
                $new_user->email = $request['phone_number'];
            }
            $new_user->password = bcrypt($request['password']);
            $new_user->save();
            $new_user->roles()->attach(Role::where('role', 1)->first());
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(), 'status' => 'error']);
        }
    	return response()->json(['message'=>'Thành công', 'status' => 'success']);
    }
}
