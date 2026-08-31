<?php


namespace App\Services;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthClass{

public function login(Request $request)
    {
        $validated = $request->validate([
        'email' => ['required' , 'string' , 'email' , 'max:255'],
        'password' => ['required' , 'string' , 'min:8']
    ]);

     if(! Auth::attempt($validated)){
        return back()->withErrors(['password' => 'Invalid Credentials!']);
     }   


        $request->session()->regenerate();

        $user = Auth::user();

        $user->activities()->create([
            'action' => 'Logged In',
            'description' => $user->name . ' just logged in to the system'
        ]);

        if ($user->isAdmin()) {
            return redirect('/admin')->with('success', 'Welcome Admin!');
        }

        if ($user->isDriver()) {
            return redirect('/driver')->with('success', 'Welcome Driver!');
        }

        return redirect()->intended('/shipments')->with('success', 'You are logged in!');
            }

     

  public function register(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', Password::default()]
    ]);


    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);



    Auth::login($user);

    Mail::to($user->email)->send(new WelcomeMail($user));

   return redirect('/shipments');
}

}