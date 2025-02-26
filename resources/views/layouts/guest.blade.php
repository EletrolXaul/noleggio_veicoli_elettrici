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
                        <a href="{{ route('user.dashboard') }}" class="btn-primary">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-secondary ml-4">Logout</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trova tutti i pulsanti di toggle password
            var toggleButtons = document.querySelectorAll('.toggle-password');
            
            // Aggiungi event listener a ciascuno
            toggleButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    // Impedisci l'invio del form
                    e.preventDefault();
                    
                    // Trova l'elemento input associato utilizzando l'attributo data-target
                    var targetId = this.getAttribute('data-target');
                    var passwordInput = document.getElementById(targetId);
                    
                    // Toggle del tipo di input
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        // Quando mostro la password (testo in chiaro), mostro l'icona dell'occhio barrato
                        this.querySelector('.eye-open').classList.add('hidden');
                        this.querySelector('.eye-closed').classList.remove('hidden');
                    } else {
                        passwordInput.type = 'password';
                        // Quando nascondo la password, mostro l'icona dell'occhio normale
                        this.querySelector('.eye-open').classList.remove('hidden');
                        this.querySelector('.eye-closed').classList.add('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.public');
Route::get('/about', [PageController::class, 'about'])->name('about');