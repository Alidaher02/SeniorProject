<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthClass;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
   {
    return view('auth.register');
   }

   public function store(Request $request){
      
      $authClass = new authClass();

      return $authClass->register($request);
    
   }
}
