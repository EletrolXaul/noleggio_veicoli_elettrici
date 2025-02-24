<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Noleggio veicoli elettrici - La tua scelta sostenibile per la mobilità">
    <title>@yield('title') - Noleggio EV</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    {{-- Header Pubblico --}}
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-xl font-bold text-gray-800">Noleggio EV</span>
                    </a>
                    <div class="hidden md:flex items-center ml-10 space-x-8">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                        <a href="{{ route('vehicles.public') }}" class="nav-link">Veicoli</a>
                        <a href="{{ route('about') }}" class="nav-link">Chi Siamo</a>
                        <a href="{{ route('contact') }}" class="nav-link">Contatti</a>
                    </div>
                </div>
                <div class="flex items-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-secondary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Accedi</a>
                        <a href="{{ route('register') }}" class="btn-secondary ml-4">Registrati</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.guest-footer')
</body>
</html>

<?php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.public');
Route::get('/about', [PageController::class, 'about'])->name('about');