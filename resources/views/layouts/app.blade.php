<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Noleggio veicoli elettrici - La tua scelta sostenibile per la mobilità">
    <title>@yield('title') - Noleggio EV</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    {{-- Header con Annuncio --}}
    <div class="bg-green-600 text-white text-center py-2">
        <p>🌱 Scegli la mobilità sostenibile - Zero emissioni, massima libertà!</p>
    </div>

    {{-- Navigation --}}
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                {{-- Logo e Menu Principale --}}
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-8 w-auto mr-2">
                        <span class="text-xl font-bold text-gray-800">Noleggio EV</span>
                    </a>
                    {{-- Menu Principale --}}
                    <div class="hidden md:flex items-center ml-10 space-x-8">
                        <a href="{{ route('home') }}" 
                           class="text-gray-600 hover:text-green-600 px-3 py-2 rounded-md {{ Request::routeIs('home') ? 'text-green-600 font-semibold' : '' }}">
                            Home
                        </a>
                        <div class="relative group">
                            <button class="text-gray-600 group-hover:text-green-600 px-3 py-2 rounded-md inline-flex items-center">
                                <span>Veicoli</span>
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                                <div class="py-1">
                                    <a href="{{ route('vehicles.index', ['type' => 'car']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Auto Elettriche</a>
                                    <a href="{{ route('vehicles.index', ['type' => 'scooter']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Scooter Elettrici</a>
                                    <a href="{{ route('vehicles.index', ['type' => 'bike']) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Bici Elettriche</a>
                                </div>
                            </div>
                        </div>
                        <a href="#come-funziona" class="text-gray-600 hover:text-green-600 px-3 py-2 rounded-md">Come Funziona</a>
                        <a href="#contatti" class="text-gray-600 hover:text-green-600 px-3 py-2 rounded-md">Contatti</a>
                    </div>
                </div>

                {{-- Menu Utente e CTA --}}
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" 
                       class="hidden md:inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        Area Riservata
                    </a>
                    {{-- Menu Mobile --}}
                    <button type="button" class="md:hidden bg-white p-2 rounded-md text-gray-400 hover:text-gray-500" 
                            onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Menu Mobile --}}
        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Home</a>
                <a href="{{ route('vehicles.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Veicoli</a>
                <a href="#come-funziona" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Come Funziona</a>
                <a href="#contatti" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Contatti</a>
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-green-600">Area Riservata</a>
            </div>
        </div>
    </nav>

    {{-- Breadcrumbs --}}
    @unless(Request::routeIs('home'))
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto py-3 px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">Home</a>
                    </li>
                    @yield('breadcrumbs')
                </ol>
            </nav>
        </div>
    </div>
    @endunless

    {{-- Messaggi Flash --}}
    @if (session('success'))
    <div class="max-w-7xl mx-auto px-4 mt-4">
        <div class="bg-green-50 border-l-4 border-green-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Chi Siamo</h3>
                    <p class="text-gray-300">La tua scelta sostenibile per la mobilità urbana. Noleggia veicoli elettrici in modo semplice e veloce.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Collegamenti Rapidi</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="{{ route('vehicles.index') }}" class="text-gray-300 hover:text-white">Veicoli</a></li>
                        <li><a href="#come-funziona" class="text-gray-300 hover:text-white">Come Funziona</a></li>
                        <li><a href="#faq" class="text-gray-300 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contatti</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <span>info@noleggio-ev.it</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <span>+39 123 456 7890</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <form class="mt-4">
                        <div class="flex">
                            <input type="email" placeholder="La tua email" 
                                   class="flex-1 rounded-l-md px-4 py-2 bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <button type="submit" 
                                    class="px-4 py-2 bg-green-600 text-white rounded-r-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                Iscriviti
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400">&copy; {{ date('Y') }} Noleggio Veicoli Elettrici. Tutti i diritti riservati.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#privacy" class="text-gray-400 hover:text-white">Privacy Policy</a>
                        <a href="#termini" class="text-gray-400 hover:text-white">Termini e Condizioni</a>
                        <a href="#cookie" class="text-gray-400 hover:text-white">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- Back to Top Button --}}
    <button id="back-to-top" 
            class="fixed bottom-8 right-8 bg-green-600 text-white p-2 rounded-full shadow-lg hover:bg-green-700 focus:outline-none hidden">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    {{-- Script per il pulsante Back to Top --}}
    <script>
        const backToTop = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 100) {
                backToTop.classList.remove('hidden');
            } else {
                backToTop.classList.add('hidden');
            }
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
