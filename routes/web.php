<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('vehicles', VehicleController::class);
Route::resource('customers', CustomerController::class);
Route::resource('rentals', RentalController::class);
Route::post('rentals/{rental}/complete', [RentalController::class, 'complete'])->name('rentals.complete');
