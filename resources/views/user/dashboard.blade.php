@extends('layouts.guest')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">Benvenuto, {{ auth()->user()->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Statistiche --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Le tue statistiche</h2>
                <dl class="grid grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Noleggi Attivi</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['active_rentals'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Noleggi Completati</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['completed_rentals'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Spesa Totale</dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">€{{ $stats['total_spent'] }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Noleggi Attivi --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Noleggi Attivi</h2>
                @if($activeRentals->count() > 0)
                    <div class="space-y-4">
                        @foreach($activeRentals as $rental)
                            <div class="border-b pb-4 last:border-b-0 last:pb-0">
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
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Attivo
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Nessun noleggio attivo</p>
                @endif
            </div>
        </div>

        {{-- Azioni Rapide --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('vehicles.public') }}" 
               class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                <h3 class="text-lg font-semibold mb-2">Noleggia un Veicolo</h3>
                <p class="text-gray-600">Sfoglia la nostra flotta di veicoli elettrici disponibili</p>
            </a>
            
            <a href="{{ route('user.rentals') }}" 
               class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                <h3 class="text-lg font-semibold mb-2">I Miei Noleggi</h3>
                <p class="text-gray-600">Visualizza lo storico dei tuoi noleggi</p>
            </a>
            
            <a href="{{ route('profile.edit') }}" 
               class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                <h3 class="text-lg font-semibold mb-2">Profilo</h3>
                <p class="text-gray-600">Modifica le tue informazioni personali</p>
            </a>
        </div>
    </div>
</div>
@endsection