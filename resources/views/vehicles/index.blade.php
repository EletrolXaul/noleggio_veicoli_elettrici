@extends('layouts.app')
@section('title', 'Lista Veicoli')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Veicoli</h1>
                <a href="{{ route('vehicles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuovo Veicolo</a>
            </div>

            <form action="{{ route('vehicles.search') }}" method="GET" class="mb-6">
                <div class="flex gap-4">
                    <select name="type" class="rounded-md shadow-sm">
                        <option value="">Tutti i tipi</option>
                        <option value="car">Auto</option>
                        <option value="scooter">Scooter</option>
                        <option value="bike">Bici</option>
                    </select>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="status" value="available" id="available" 
                               class="rounded shadow-sm">
                        <label for="available" class="ml-2">Solo disponibili</label>
                    </div>
                    
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Cerca
                    </button>
                </div>
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b">Modello</th>
                            <th class="px-6 py-3 border-b">Tipo</th>
                            <th class="px-6 py-3 border-b">Batteria</th>
                            <th class="px-6 py-3 border-b">Stato</th>
                            <th class="px-6 py-3 border-b">Tariffa/h</th>
                            <th class="px-6 py-3 border-b">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td class="px-6 py-4 border-b">{{ $vehicle->model }}</td>
                                <td class="px-6 py-4 border-b">{{ $vehicle->type }}</td>
                                <td class="px-6 py-4 border-b">{{ $vehicle->battery_capacity }}%</td>
                                <td class="px-6 py-4 border-b">
                                    <span
                                        class="px-2 py-1 rounded text-sm
                                        {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $vehicle->status === 'rented' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $vehicle->status === 'maintenance' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $vehicle->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 border-b">€{{ $vehicle->hourly_rate }}</td>
                                <td class="px-6 py-4 border-b">
                                    <a href="{{ route('vehicles.show', $vehicle) }}" class="text-blue-500">Dettagli</a>
                                    <a href="{{ route('vehicles.edit', $vehicle) }}"
                                        class="text-yellow-500 ml-2">Modifica</a>
                                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 ml-2"
                                            onclick="return confirm('Sei sicuro di voler eliminare questo veicolo?')">
                                            Elimina
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
