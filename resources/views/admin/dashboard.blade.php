@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            {{-- Statistiche --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Veicoli Totali</h3>
                <p class="text-3xl">{{ $stats['total_vehicles'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Veicoli Disponibili</h3>
                <p class="text-3xl">{{ $stats['available_vehicles'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Noleggi Attivi</h3>
                <p class="text-3xl">{{ $stats['active_rentals'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Utenti Totali</h3>
                <p class="text-3xl">{{ $stats['total_users'] }}</p>
            </div>
        </div>

        {{-- Veicoli più noleggiati --}}
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Veicoli più noleggiati</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b">Modello</th>
                            <th class="px-6 py-3 border-b">Tipo</th>
                            <th class="px-6 py-3 border-b">Noleggi Completati</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($popularVehicles as $vehicle)
                            <tr>
                                <td class="px-6 py-4 border-b">{{ $vehicle->model }}</td>
                                <td class="px-6 py-4 border-b">{{ $vehicle->type }}</td>
                                <td class="px-6 py-4 border-b">{{ $vehicle->rentals_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection