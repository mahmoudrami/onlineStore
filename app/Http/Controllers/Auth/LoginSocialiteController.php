<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

class LoginSocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // content check user in database or not and if user not fount in database make user and login but if user
        // founded in data base make user login in data base
        $existsUser = User::Where('email', $user->email)->first();

        if ($existsUser) {
            Auth::guard('web')->login($existsUser);
        } else {
            // here add user in data base
            User::create([
                'name' => $user->name,
                'email' => $user->email
            ]);
        }
        // but now you need thing on way how to make provider_id , provider_type , provider_token crypt





        return redirect()->route('homePage');
    }
}
