<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'userLogout')->middleware('auth:sanctum');
   
});

Route::middleware(['auth:sanctum'])->group(function () {

    //service routes
    Route::post('create/service', [ServiceController::class, 'create']);
    Route::post('update/service/{id}', [ServiceController::class, 'update']);
    Route::delete('delete/service/{id}', [ServiceController::class, 'delete']);
    Route::get('services', [ServiceController::class, 'index']);

    //booking routes
    Route::post('create/booking', [BookingController::class, 'createBooking']);
    Route::get('bookings', [BookingController::class, 'bookingList']);
   
});
