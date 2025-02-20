{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Veicoli Totali</h3>
                <p class="text-3xl">{{ $stats['total_vehicles'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Veicoli Disponibili</h3>
                <p class="text-3xl">{{ $stats['available_vehicles'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-2">Noleggi Attivi</h3>
                <p class="text-3xl">{{ $stats['active_rentals'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Veicoli Più Noleggiati</h3>
            <div class="space-y-4">
                @foreach($popularVehicles as $vehicle)
                    <div class="flex justify-between items-center">
                        <span>{{ $vehicle->model }}</span>
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">
                            {{ $vehicle->rentals_count }} noleggi
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection