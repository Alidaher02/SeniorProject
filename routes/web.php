<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\ShipmentController;


Route::redirect('/' , '/shipments');
Route::get('/shipments' , [ShipmentController::class , 'index'])->middleware('auth');

Route::get('/register' , [RegisterController::class , 'create'])->name('registerForm')->middleware('guest');
Route::post('/register' , [RegisterController::class , 'store'])->name('register')->middleware('guest');

Route::get('/login' , [SessionsController::class , 'create'])->name('loginForm')->middleware('guest');
Route::post('/login' , [SessionsController::class , 'store'])->name('login')->middleware('guest');

Route::delete('/logout' , [SessionsController::class , 'destroy'])->middleware('auth');



