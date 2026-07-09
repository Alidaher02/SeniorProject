<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;




class SessionsController extends Controller
{
    public function create(){

        return view('auth.login');
    }
    

    public function store(Request $request){

        $validated = $request->validate([
        'email' => ['required' , 'string' , 'email' , 'max:255'],
        'password' => ['required' , 'string' , 'min:8']
    ]);

     if(! Auth::attempt($validated)){

        return back()->withErrors(['password' => 'Invalid Credentials!']);
     }   

     if(auth()->user()->role === 'admin'){
        return redirect('/admin')->with('Success' , 'Welcome Admin!');
     }
     
        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'You are logged in!');
        

    }



    public function destroy(){

        Auth::logout();

        return redirect('/');
    }
}
