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
        @include('layouts.partials.admin-sidebar')

        {{-- Contenuto principale --}}
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
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

    {{-- Scripts aggiuntivi --}}
    @stack('scripts')
</body>
</html>
