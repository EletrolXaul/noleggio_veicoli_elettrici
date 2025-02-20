<?php
// layouts/partials/admin-sidebar.blade.php
<aside class="w-64 bg-gray-800 text-white">
    <div class="p-4">
        <h1 class="text-xl font-bold">Dashboard Admin</h1>
    </div>
    
    <nav class="mt-8">
        <a href="{{ route('admin.dashboard') }}" 
           class="block py-2.5 px-4 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
            Dashboard
        </a>
        
        <a href="{{ route('admin.vehicles.index') }}"
           class="block py-2.5 px-4 {{ request()->routeIs('admin.vehicles.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
            Gestione Veicoli
        </a>
        
        <a href="{{ route('admin.rentals.index') }}"
           class="block py-2.5 px-4 {{ request()->routeIs('admin.rentals.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
            Gestione Noleggi
        </a>
        
        <a href="{{ route('admin.customers.index') }}"
           class="block py-2.5 px-4 {{ request()->routeIs('admin.customers.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
            Gestione Clienti
        </a>
        
        <div class="mt-auto p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left py-2.5 px-4 hover:bg-gray-700">
                    Logout
                </button>
            </form>
        </div>
    </nav>
</aside>
