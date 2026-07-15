<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\Driver\DriverController;



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

Route::get('/driver' , [DriverController::class , 'index'])->middleware('auth');
Route::patch('/driver/{shipment}' , [DriverController::class , 'updateToDelivered'])->middleware('auth');



Route::get('/admin' , [AdminController::class , 'shipmentsView'])->middleware('auth');
Route::get('/showAdminShipments/{shipment}' , [AdminController::class , 'showAdminShipments'])->middleware('auth');
Route::get('/admin/customers' , [AdminController::class , 'customersView'])->middleware('auth');
Route::get('/admin/alerts' , [AdminController::class , 'alertsView'])->middleware('auth');
Route::get('/admin/requests' , [AdminController::class , 'requests'])->middleware('auth');
Route::get('/admin/intransit' , [AdminController::class , 'intransit'])->middleware('auth');
Route::get('/admin/delivered' , [AdminController::class , 'delivered'])->middleware('auth');

Route::get('/admin/approved' , [AdminController::class , 'approved'])->middleware('auth');
Route::patch('/admin/approved/{shipment}' , [AdminController::class , 'updateApproved'])->middleware('auth');

Route::get('/admin/drivers' , [AdminController::class , 'drivers'])->middleware('auth');
Route::post('/admin/drivers' , [AdminController::class , 'addDrivers'])->middleware('auth');
Route::delete('/admin/drivers/{driver}' , [AdminController::class , 'deleteDriver'])->middleware('auth');

Route::post('/admin/customers' , [AdminController::class , 'addCustomers'])->middleware('auth');
Route::delete('/admin/customers/{customer}' , [AdminController::class , 'deleteCustomer'])->middleware('auth');


Route::get('/stats' , [AdminController::class , 'stats']);
Route::patch('/admin/shipments/{shipment}' , [AdminController::class , 'updatePending'])->middleware('auth');
Route::patch('/admin/Rejectshipments/{shipment}' , [AdminController::class , 'rejectShipment'])->middleware('auth');
Route::patch('/admin/Approvedshipments/{shipment}' , [AdminController::class , 'updateApproved'])->middleware('auth');







