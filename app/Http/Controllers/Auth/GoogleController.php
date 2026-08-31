<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeMail;
use App\Models\Activity;
use Illuminate\Support\Facades\Mail;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

        public function callback()
        {

            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(str()->random(16)),
                ]);

            Mail::to($user->email)->send(new WelcomeMail($user));
                

            }

            Auth::login($user);

            Activity::create([
            'user_id' => Auth::id(),
            'action' => 'Logged In',
            'description' => $user->name . ' just logged in to the system'
            ]);

            return redirect('/shipments');
        }
}
