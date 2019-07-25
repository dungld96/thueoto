<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
use App\Models\Role;

class GoogleAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        try {
            $user = $this->findOrCreateUser($googleUser);
        } catch (\Exception $e) {
            if($e->errorInfo[1] == 1062){
                $message = 'Email đã tồn tại.';
            }else{
                $message = $e->getMessage();
            }
            return view('errors.error', ['message'=>$message]);
        }
        Auth::login($user, true);
        return redirect()->route('home-client');
    }

    private function findOrCreateUser($googleUser){
        $authUser = User::where('social_type', 'google')->where('social_id', $googleUser->id)->first();
 
        if($authUser){
            return $authUser;
        }

        $user = new User();
        $user->name = $googleUser->name;
        $user->password = $googleUser->token;
        $user->email = $googleUser->email;
        $user->social_type = 'google';
        $user->social_id = $googleUser->id;
        $user->save();
        $user->roles()->attach(Role::where('role', 1)->first());
        return $user;
    }



}
