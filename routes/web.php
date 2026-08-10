<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\AI\AIController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ShipmentReportController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Gps\gpsController;

Route::redirect('/' , '/shipments');

Route::middleware(['auth', 'customer'])->group(function () {


Route::get('/shipments' , [ShipmentController::class , 'index'])->middleware('auth');
Route::get('/shipments/load' , [ShipmentController::class , 'load']);
Route::get('/shipments/status' , [ShipmentController::class , 'filterStatus']);
Route::get('/shipments/request' , [ShipmentController::class , 'create'])->middleware('auth');
Route::post('/shipments/request' , [ShipmentController::class , 'store'])->middleware('auth');
Route::patch('/shipments/{shipment}' , [ShipmentController::class , 'update'])->middleware('auth');
Route::delete('/shipments/{shipment}' , [ShipmentController::class , 'destroy'])->middleware('auth');
Route::get('/shipments/{shipment}/sensor-reading' , [ShipmentController::class , 'sensorReading']);


});


Route::get('/shipments/{shipment}/sensor-reading' , [SensorController::class , 'sensorReading']);

Route::get('/register' , [RegisterController::class , 'create'])->name('registerForm')->middleware('guest');
Route::post('/register' , [RegisterController::class , 'store'])->name('register')->middleware('guest');
Route::get('/login' , [SessionsController::class , 'create'])->name('loginForm')->middleware('guest');
Route::post('/login' , [SessionsController::class , 'store'])->name('login')->middleware('guest');

Route::delete('/logout' , [SessionsController::class , 'destroy'])->middleware('auth');

Route::middleware(['auth', 'driver'])->group(function () {

Route::get('/driver' , [DriverController::class , 'index'])->middleware('auth');
Route::patch('/driver/{shipment}' , [DriverController::class , 'updateToDelivered'])->middleware('auth');


});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'shipmentsView']);

    Route::get('/admin/customers', [AdminController::class, 'customersView']);
    Route::get('/admin/alerts', [AdminController::class, 'alertsView']);
    Route::get('/admin/requests', [AdminController::class, 'requests']);
    Route::get('/admin/intransit', [AdminController::class, 'intransit']);
    Route::get('/admin/delivered', [AdminController::class, 'delivered']);

    Route::get('/admin/approved', [AdminController::class, 'approved']);
    Route::patch('/admin/approved/{shipment}', [AdminController::class, 'updateApproved']);

    Route::get('/admin/drivers', [AdminController::class, 'drivers']);
    Route::post('/admin/drivers', [AdminController::class, 'addDrivers']);
    Route::delete('/admin/drivers/{driver}', [AdminController::class, 'deleteDriver']);

    Route::post('/admin/customers', [AdminController::class, 'addCustomers']);
    Route::delete('/admin/customers/{customer}', [AdminController::class, 'deleteCustomer']);

    Route::get('/stats', [AdminController::class, 'stats']);

    Route::patch('/admin/shipments/{shipment}', [AdminController::class, 'updatePending']);
    Route::patch('/admin/Rejectshipments/{shipment}', [AdminController::class, 'rejectShipment']);
    Route::patch('/admin/Approvedshipments/{shipment}', [AdminController::class, 'updateApproved']);
    Route::get('/alerts', [AlertController::class, 'alerts']);

    Route::get('/alerts/count' , [AlertController::class , 'alertCounts']);

    Route::get('/admin/settings' ,[SettingsController::class , 'index']);
    Route::patch('/profile' , [SettingsController::class , 'update']);

});
// Route::get('/showAdminShipments/{shipment}' , [AdminController::class , 'showAdminShipments'])->middleware('auth');
Route::get('/shipments/{shipment}' , [ShipmentController::class , 'show'])->middleware('auth');

Route::post('/sensor/readings', [SensorController::class, 'storeReadings']);

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


Route::get('/shipments/{shipment}/pdf' , [ShipmentReportController::class , 'generatePDF'])
->name('shipment.pdf');

Route::get('/shipments/{shipment}/email', [ShipmentReportController::class, 'emailPDF'])
    ->name('shipment.email');

Route::get('/ai-assistant' , [AIController::class , 'index']);
Route::post('/ai/chat' , [AIController::class , 'chat']);
Route::get('/chat/history' , [AIController::class , 'history']);

Route::post('/gps/readings' , [gpsController::class , 'store']);

Route::get('/gps/readings/{shipment}' , [gpsController::class , 'latest']);

Route::get('/gps/address/{shipment}', [gpsController::class, 'address']);