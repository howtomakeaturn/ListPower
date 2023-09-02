<?php

namespace Modules\SocialAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Socialite;
use Auth;
use Modules\SocialAuth\Entities\SocialCredential;
use App\User;

class SocialAuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if ($request->get('from')) {
            $request->session()->put('url.intended', $request->get('from'));
        }

        return view('socialauth::login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect($request->get('to'));
    }

    public function auth(Request $request)
    {
        return Socialite::driver('facebook')->usingGraphVersion('v17.0')->redirect();
    }

    public function callback(Request $request)
    {
        $facebook = Socialite::driver('facebook')->user();

        $email = $facebook->getEmail() ? $facebook->getEmail() : $facebook->getId() . '@facebook.com';

        if ($user = User::where('email', $email)->first()) {
        // if ($credential = SocialCredential::where('social_id', $facebook->id)->first()) {
            // Auth::loginUsingId($credential->user_id);
            Auth::loginUsingId($user->id);
        } else {
            $user = new User();

            // $email = $facebook->getEmail() ? $facebook->getEmail() : $facebook->getId() . '@facebook.com';

            $user->email = $email;

            $user->name = $facebook->getName();

            $user->password = '';

            $user->avatar = $facebook->getAvatar();

            // $user->avatar_original = $facebook->avatar_original;

            $user->save();

            /*
            $credential = new SocialCredential();

            $credential->user_id = $user->id;

            $credential->social_id = $facebook->id;

            $credential->save();
            */

            Auth::login($user);
        }

        return redirect()->intended('/');
    }

    public function authGithub(Request $request)
    {
        return Socialite::driver('github')->redirect();
    }

    public function callbackGithub(Request $request)
    {
        $github = Socialite::driver('github')->user();

        if ($user = User::where('email', $github->getEmail())->first()) {
            Auth::loginUsingId($user->id);
        } else {
            $user = new User();

            $email = $github->getEmail();

            $user->email = $email;

            $user->name = $github->getName() ?: '';

            $user->password = '';

            $user->github = $github->user['login'];

            $user->avatar = $github->getAvatar();

            // $user->avatar_original = $github->getAvatar();

            $user->save();

            /*
            $credential = new SocialCredential();

            $credential->user_id = $user->id;

            $credential->social_id = $github->getId();

            $credential->save();
            */

            Auth::login($user);
        }

        return redirect()->intended('/');
    }
}
