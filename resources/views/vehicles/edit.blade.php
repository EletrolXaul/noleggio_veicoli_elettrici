@extends('layouts.app')
@section('title', 'Modifica Veicolo')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Modifica Veicolo</h1>

                <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
                    @csrf
                    @include('components.errors')
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Modello</label>
                        <input type="text" name="model" value="{{ old('model', $vehicle->model) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Tipo</label>
                        <select name="type" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="car" {{ $vehicle->type == 'car' ? 'selected' : '' }}>Auto</option>
                            <option value="scooter" {{ $vehicle->type == 'scooter' ? 'selected' : '' }}>Scooter</option>
                            <option value="bike" {{ $vehicle->type == 'bike' ? 'selected' : '' }}>Bici</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Stato</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="available" {{ $vehicle->status == 'available' ? 'selected' : '' }}>Disponibile
                            </option>
                            <option value="rented" {{ $vehicle->status == 'rented' ? 'selected' : '' }}>Noleggiato</option>
                            <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>In
                                Manutenzione</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Capacità Batteria</label>
                        <input type="number" name="battery_capacity"
                            value="{{ old('battery_capacity', $vehicle->battery_capacity) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Tariffa Oraria</label>
                        <input type="number" step="0.01" name="hourly_rate"
                            value="{{ old('hourly_rate', $vehicle->hourly_rate) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Aggiorna Veicolo</button>
                    <a href="{{ route('vehicles.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Annulla</a>
                </form>
            </div>
        </div>
    </div>
@endsection
