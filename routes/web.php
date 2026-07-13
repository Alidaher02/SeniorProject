<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ShipmentController;


Route::redirect('/' , '/shipments');

Route::get('/shipments' , [ShipmentController::class , 'index'])->middleware('auth');
Route::get('/shipments/request' , [ShipmentController::class , 'create'])->middleware('auth');
Route::post('/shipments/request' , [ShipmentController::class , 'store'])->middleware('auth');
Route::get('/shipments/{shipment}' , [ShipmentController::class , 'show'])->middleware('auth');
Route::delete('/shipments/{shipment}' , [ShipmentController::class , 'destroy'])->middleware('auth');



Route::get('/register' , [RegisterController::class , 'create'])->name('registerForm')->middleware('guest');
Route::post('/register' , [RegisterController::class , 'store'])->name('register')->middleware('guest');

Route::get('/login' , [SessionsController::class , 'create'])->name('loginForm')->middleware('guest');
Route::post('/login' , [SessionsController::class , 'store'])->name('login')->middleware('guest');

Route::delete('/logout' , [SessionsController::class , 'destroy'])->middleware('auth');

Route::get('/admin' , [AdminController::class , 'index'])->middleware('auth');
Route::get('/admin/shipments' , [AdminController::class , 'shipmentsView'])->middleware('auth');
Route::get('/admin/customers' , [AdminController::class , 'customersView'])->middleware('auth');
Route::get('/admin/alerts' , [AdminController::class , 'alertsView'])->middleware('auth');



Route::get('/stats' , [AdminController::class , 'stats']);
Route::patch('/admin/shipments/{shipment}' , [AdminController::class , 'updatePending'])->middleware('auth');
Route::patch('/admin/Approvedshipments/{shipment}' , [AdminController::class , 'updateApproved'])->middleware('auth');







