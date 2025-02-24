@extends('layouts.guest')

@section('title', 'Dashboard Utente')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Benvenuto, {{ Auth::user()->name }}</h1>

        {{-- Statistiche --}}
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
                        <div class="border-b pb-4 last:border-b-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">{{ $rental->vehicle->model }}</h3>
                                    <p class="text-sm text-gray-600">
                                        Dal: {{ $rental->start_time->format('d/m/Y H:i') }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Al: {{ $rental->end_time->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                <span class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-800">
                                    Attivo
                                </span>
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