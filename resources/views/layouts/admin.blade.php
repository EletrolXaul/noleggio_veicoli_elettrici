<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Pannello di amministrazione">
    <title>Admin - @yield('title')</title>
    
    {{-- Stili e Script --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Setup CSRF per AJAX --}}
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        {{-- Sidebar Admin --}}
        {{-- @include('layouts.partials.admin-sidebar') --}}

        <nav class="w-64 bg-gray-800 h-screen fixed">
            <div class="p-6">
                <h1 class="text-white text-2xl font-bold">Admin Panel</h1>
            </div>
            <ul class="mt-6">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.vehicles.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                        <span>Veicoli</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.rentals.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                        <span>Noleggi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.customers.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                        <span>Clienti</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Contenuto principale --}}
        <div class="flex-1 pl-64 overflow-x-hidden overflow-y-auto"> {{-- Aggiungi pl-64 per compensare la navbar fixed --}}
            {{-- Header --}}
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="max-w-7xl mx-auto py-6 px-4">
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Main Content --}}
                @yield('content')
            </main>
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="btn-secondary">Logout</button>
    </form>

    {{-- Scripts aggiuntivi --}}
    @stack('scripts')
</body>
</html>
