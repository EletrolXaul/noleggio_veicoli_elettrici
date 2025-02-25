<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        {{-- Sidebar fissa --}}
        <aside class="fixed inset-y-0 left-0 w-64 bg-gray-800">
            <div class="flex flex-col h-full">
                {{-- Logo/Header --}}
                <div class="p-4">
                    <h1 class="text-white text-xl font-bold">Admin Panel</h1>
                </div>

                {{-- Menu principale --}}
                <nav class="flex-1 p-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="flex items-center px-4 py-2 rounded-lg text-gray-300 hover:bg-gray-700 
                                    {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.vehicles.index') }}"
                               class="flex items-center px-4 py-2 rounded-lg text-gray-300 hover:bg-gray-700
                                    {{ request()->routeIs('admin.vehicles.*') ? 'bg-gray-700' : '' }}">
                                <span>Veicoli</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.rentals.index') }}"
                               class="flex items-center px-4 py-2 rounded-lg text-gray-300 hover:bg-gray-700
                                    {{ request()->routeIs('admin.rentals.*') ? 'bg-gray-700' : '' }}">
                                <span>Noleggi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.customers.index') }}"
                               class="flex items-center px-4 py-2 rounded-lg text-gray-300 hover:bg-gray-700
                                    {{ request()->routeIs('admin.customers.*') ? 'bg-gray-700' : '' }}">
                                <span>Clienti</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                {{-- Footer con logout --}}
                <div class="p-4 border-t border-gray-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg text-left">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Contenuto principale --}}
        <main class="flex-1 ml-64">
            {{-- Header --}}
            <header class="bg-white shadow">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                </div>
            </header>

            {{-- Contenuto della pagina --}}
            <div class="p-6">
                {{-- Messaggi di feedback --}}
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Contenuto specifico della pagina --}}
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
