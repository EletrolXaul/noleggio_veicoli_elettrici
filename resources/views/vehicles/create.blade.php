@extends('layouts.app')
@section('title', 'Nuovo Veicolo')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Nuovo Veicolo</h1>

                <form action="{{ route('vehicles.store') }}" method="POST">
                    @csrf
                    @include('components.errors')
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Modello</label>
                        <input type="text" name="model" value="{{ old('model') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('model')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Tipo</label>
                        <select name="type" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="car">Auto</option>
                            <option value="scooter">Scooter</option>
                            <option value="bike">Bici</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Capacità Batteria</label>
                        <input type="number" name="battery_capacity" value="{{ old('battery_capacity') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Tariffa Oraria</label>
                        <input type="number" step="0.01" name="hourly_rate" value="{{ old('hourly_rate') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Salva Veicolo
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
