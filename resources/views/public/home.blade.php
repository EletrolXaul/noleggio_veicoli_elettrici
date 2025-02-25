@extends('layouts.guest')

@section('title', 'Home')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Hero Section con CTA per login/registrazione --}}
        <div class="bg-white rounded-lg shadow-xl p-8 mb-8">
            <h1 class="text-4xl font-bold mb-4">Noleggio Veicoli Elettrici</h1>
            <p class="text-xl text-gray-600 mb-6">Scopri la nostra selezione di veicoli elettrici per una mobilità sostenibile</p>
            @guest
                <div class="space-y-4">
                    <p class="text-lg text-gray-700">Per noleggiare un veicolo è necessario effettuare l'accesso o registrarsi.</p>
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="inline-block bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Accedi</a>
                        <a href="{{ route('register') }}" class="inline-block bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600">Registrati</a>
                    </div>
                </div>
            @endguest
        </div>

        {{-- Lista Veicoli Disponibili --}}
        <div class="bg-white rounded-lg shadow-xl p-8">
            <h2 class="text-2xl font-bold mb-6">Veicoli Disponibili</h2>
            @if($availableVehicles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($availableVehicles as $vehicle)
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="font-bold text-lg mb-2">{{ $vehicle->model }}</h3>
                            <p class="text-gray-600 mb-2">Tipo: {{ $vehicle->type }}</p>
                            <p class="text-gray-600 mb-4">€{{ $vehicle->hourly_rate }}/ora</p>
                            @guest
                                <p class="text-sm text-gray-500">Accedi per noleggiare questo veicolo</p>
                            @else
                                <a href="{{ route('vehicles.show', $vehicle) }}" 
                                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Dettagli e Prenotazione
                                </a>
                            @endguest
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Nessun veicolo disponibile al momento.</p>
            @endif
        </div>
    </div>
</div>
@endsection
