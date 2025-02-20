@extends('layouts.admin')

@section('title', 'Modifica Veicolo')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.vehicles.index') }}" class="text-blue-500 hover:underline">
                ← Torna ai veicoli
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <h1 class="text-2xl font-bold mb-6">Modifica Veicolo</h1>

                <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700">Modello</label>
                        <input type="text" name="model" id="model" required value="{{ old('model', $vehicle->model) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('model')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Tipo</label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="car" {{ $vehicle->type === 'car' ? 'selected' : '' }}>Auto</option>
                            <option value="scooter" {{ $vehicle->type === 'scooter' ? 'selected' : '' }}>Scooter</option>
                            <option value="bike" {{ $vehicle->type === 'bike' ? 'selected' : '' }}>Bici</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="battery_capacity" class="block text-sm font-medium text-gray-700">Capacità Batteria (%)</label>
                        <input type="number" name="battery_capacity" id="battery_capacity" required min="0" max="100"
                               value="{{ old('battery_capacity', $vehicle->battery_capacity) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('battery_capacity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hourly_rate" class="block text-sm font-medium text-gray-700">Tariffa Oraria (€)</label>
                        <input type="number" name="hourly_rate" id="hourly_rate" required step="0.01" min="0"
                               value="{{ old('hourly_rate', $vehicle->hourly_rate) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('hourly_rate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Stato</label>
                        <select name="status" id="status" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="available" {{ $vehicle->status === 'available' ? 'selected' : '' }}>Disponibile</option>
                            <option value="maintenance" {{ $vehicle->status === 'maintenance' ? 'selected' : '' }}>In Manutenzione</option>
                            <option value="rented" {{ $vehicle->status === 'rented' ? 'selected' : '' }}>In Noleggio</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Aggiorna Veicolo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
