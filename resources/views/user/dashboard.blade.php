@extends('layouts.guest')
@section('title', 'Dashboard')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

        {{-- Statistiche Utente --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Noleggi Attivi</h3>
                <p class="text-3xl">{{ $stats['active_rentals'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Noleggi Completati</h3>
                <p class="text-3xl">{{ $stats['completed_rentals'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-2">Totale Speso</h3>
                <p class="text-3xl">€{{ $stats['total_spent'] }}</p>
            </div>
        </div>

        {{-- Noleggi Attivi --}}
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">I tuoi noleggi attivi</h2>
            @if($activeRentals->count() > 0)
                <div class="space-y-4">
                    @foreach($activeRentals as $rental)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                                <div class="flex-grow">
                                    <div class="flex justify-between items-start">
                                        <h3 class="font-semibold text-lg">{{ $rental->vehicle->model }}</h3>
                                        <span class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-800">
                                            Attivo
                                        </span>
                                    </div>
                                    
                                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Dal:</span> {{ $rental->start_time->format('d/m/Y H:i') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Al:</span> {{ $rental->end_time->format('d/m/Y H:i') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Durata:</span> {{ $rental->start_time->diffInHours($rental->end_time) }} ore
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Tipo veicolo:</span> {{ $rental->vehicle->type }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium">Tariffa oraria:</span> €{{ $rental->vehicle->hourly_rate }}/ora
                                            </p>
                                            <p class="text-sm font-medium text-gray-800">
                                                <span class="font-medium">Costo totale:</span> €{{ $rental->total_cost }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 w-full sm:w-auto">
                                    <a href="{{ route('user.rentals.show', $rental) }}" 
                                       class="block w-full text-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                        Dettagli
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Non hai noleggi attivi al momento.</p>
            @endif
        </div>
    </div>
</div>
@endsection