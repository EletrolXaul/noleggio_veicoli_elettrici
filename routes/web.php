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
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Rotte utente autenticato
Route::middleware('auth')->group(function () {
    // Dashboard e profilo
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Gestione noleggi utente
    Route::get('/my-rentals', [UserDashboardController::class, 'rentals'])->name('user.rentals');
    Route::post('/rentals/book/{vehicle}', [UserDashboardController::class, 'bookVehicle'])->name('rentals.book');
    Route::get('/rentals/{rental}', [UserDashboardController::class, 'showRental'])->name('rentals.show');
});

// Rotte admin protette
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // altre route admin...
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Gestione veicoli (CRUD completo)
    Route::resource('vehicles', AdminVehicleController::class)->names('admin.vehicles');
    Route::post('vehicles/{vehicle}/toggle-status', [AdminVehicleController::class, 'toggleStatus'])
        ->name('admin.vehicles.toggle-status');
    
    // Gestione noleggi (CRUD completo + azioni specifiche)
    Route::resource('rentals', AdminRentalController::class)->names('admin.rentals');
    Route::post('rentals/{rental}/complete', [AdminRentalController::class, 'complete'])
        ->name('admin.rentals.complete');
    Route::post('rentals/{rental}/cancel', [AdminRentalController::class, 'cancel'])
        ->name('admin.rentals.cancel');
    
    // Gestione clienti (CRUD completo)
    Route::resource('customers', AdminCustomerController::class)->names('admin.customers');
});
