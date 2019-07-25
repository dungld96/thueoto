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
 
        return User::create([
            'name' => $facebookUser->name,
            'password' => $facebookUser->token,
            'email' => $facebookUser->email,
            'social_type' => 'facebook',
            'social_id' => $facebookUser->id,
        ]);
    }

}
