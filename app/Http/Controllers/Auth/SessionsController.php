<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Services\AuthClass;


class SessionsController extends Controller
{
    public function create(){

        return view('auth.login');
    }
    

    public function store(Request $request){

      $authClass = new AuthClass();

      return $authClass->login($request);

    }

    public function destroy(){

        Auth::logout();

        return redirect('/');
    }
}
