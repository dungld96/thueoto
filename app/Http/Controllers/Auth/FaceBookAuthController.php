<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;

class FaceBookAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
        $user = $this->findOrCreateUser($facebookUser);

        Auth::login($user, true);
        return redirect()->route('home-client');
    }

    private function findOrCreateUser($facebookUser){
        $authUser = User::where('social_type', 'facebook')->where('social_id', $facebookUser->id)->first();
 
        if($authUser){
            return $authUser;
        }

        $user = new User();
        $user->name = $facebookUser->name;
        $user->password = $facebookUser->token;
        $user->email = $facebookUser->email;
        $user->social_type = 'facebook';
        $user->social_id = $facebookUser->id;
        $user->save();
        $user->roles()->attach(Role::where('role', 1)->first());
        return $user;
    }

}
