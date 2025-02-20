<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;

// Pagina pubblica
Route::get('/', [HomeController::class, 'index'])->name('home');

// Area amministrativa
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('vehicles', VehicleController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('rentals', RentalController::class);
    Route::post('rentals/{rental}/complete', [RentalController::class, 'complete'])->name('rentals.complete');
    Route::get('/vehicles/search', [VehicleController::class, 'search'])->name('vehicles.search');
});
