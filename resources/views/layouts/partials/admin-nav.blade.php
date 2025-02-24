<nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-white font-bold text-xl">Admin Dashboard</span>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('admin.vehicles.index') }}" class="nav-link">Veicoli</a>
                        <a href="{{ route('admin.rentals.index') }}" class="nav-link">Noleggi</a>
                        <a href="{{ route('admin.customers.index') }}" class="nav-link">Clienti</a>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-white px-3 py-2">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>