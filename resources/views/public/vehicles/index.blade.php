@extends('layouts.guest')

@section('title', 'Veicoli Disponibili')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Veicoli Disponibili</h1>
        
        {{-- Filtri di ricerca --}}
        <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('vehicles.public') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Tutti</option>
                        <option value="car" {{ request('type') === 'car' ? 'selected' : '' }}>Auto</option>
                        <option value="scooter" {{ request('type') === 'scooter' ? 'selected' : '' }}>Scooter</option>
                        <option value="bike" {{ request('type') === 'bike' ? 'selected' : '' }}>Bici</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Prezzo Max/ora</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="md:col-span-2 flex items-end">
                    <button type="submit" class="btn-primary w-full">Filtra</button>
                </div>
            </form>
        </div>

        {{-- Grid veicoli --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($vehicles as $vehicle)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">{{ $vehicle->model }}</h2>
                        <p class="text-gray-600">Tipo: {{ $vehicle->type }}</p>
                        <p class="text-gray-600">Batteria: {{ $vehicle->battery_capacity }}%</p>
                        <p class="text-lg font-bold mt-4">€{{ $vehicle->hourly_rate }}/ora</p>
                        
                        @if($vehicle->isAvailable())
                            <a href="{{ route('vehicles.show', $vehicle) }}" 
                               class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md">
                                Dettagli
                            </a>
                        @else
                            <span class="mt-4 inline-block bg-gray-300 text-gray-700 px-4 py-2 rounded-md">
                                Non disponibile
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $vehicles->links() }}
        </div>
    </div>
</div>
@endsection