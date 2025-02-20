<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        {{-- Sidebar Admin --}}
        @include('layouts.partials.admin-sidebar')

        {{-- Contenuto principale --}}
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                </div>
            </header>

            <main class="max-w-7xl mx-auto py-6 px-4">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
