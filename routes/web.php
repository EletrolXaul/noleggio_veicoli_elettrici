<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminVehicleController;
use App\Http\Controllers\Admin\AdminRentalController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\VehicleController;
use App\Http\Controllers\Public\PageController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\ContactController;

// Solo per utenti non autenticati
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Rotta logout (richiede autenticazione)
Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Rotte pubbliche
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.public');
Route::get('/about', [PageController::class, 'about'])->name('about');

// Rotte per i contatti
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Rotte utente autenticato
Route::middleware('auth')->group(function () {
    // Rotte dashboard utente
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/rentals', [UserDashboardController::class, 'rentals'])->name('user.rentals');
    Route::get('/rentals/{rental}', [UserDashboardController::class, 'showRental'])->name('user.rentals.show');
    
    // Rotte profilo utente
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Rotte prenotazione veicoli
    Route::post('/vehicles/{vehicle}/book', [UserDashboardController::class, 'bookVehicle'])
        ->name('rentals.book');
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
});

// Rotte admin protette
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Rotte veicoli
        Route::resource('vehicles', AdminVehicleController::class);
        
        // Rotte noleggi con azioni aggiuntive
        Route::resource('rentals', AdminRentalController::class);
        Route::post('/rentals/{rental}/complete', [AdminRentalController::class, 'complete'])
            ->name('rentals.complete');
        Route::post('/rentals/{rental}/cancel', [AdminRentalController::class, 'cancel'])
            ->name('rentals.cancel');
            
        // Rotte clienti
        Route::resource('customers', AdminCustomerController::class);
    });
});
