<?php


namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthClass;
use App\Models\User;
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


        if (Auth::user()->isAdmin()) {
            return redirect('/admin')->with('success', 'Welcome Admin!');
        }

        return redirect()->intended('/')->with('success', 'You are logged in!');    }

     

    public function register(Request $request){

        $request->validate([

        'name' => ['required' , 'string' , 'max:255'],
        'email' => ['required' , 'string' , 'email' , 'max:255' , 'unique:users'],
        'password' => ['required' , 'string' , Password::default()]

      ]);

     $user = User::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => Hash::make($request->password)
     ]);

      Auth::login($user);

      return redirect('/')->with('success' , 'Your Successfully Registered!');
    }

}