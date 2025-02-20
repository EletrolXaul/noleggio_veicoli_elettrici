@extends('layouts.app')
@section('title', 'Dettaglio Veicolo')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Dettaglio Veicolo</h1>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="font-bold">Modello:</p>
                        <p>{{ $vehicle->model }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Tipo:</p>
                        <p>{{ $vehicle->type }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Capacità Batteria:</p>
                        <p>{{ $vehicle->battery_capacity }}%</p>
                    </div>
                    <div>
                        <p class="font-bold">Stato:</p>
                        <p>{{ $vehicle->status }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Tariffa Oraria:</p>
                        <p>€{{ $vehicle->hourly_rate }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('vehicles.edit', $vehicle) }}"
                        class="bg-yellow-500 text-white px-4 py-2 rounded">Modifica</a>
                    <a href="{{ route('vehicles.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Indietro</a>
                </div>
            </div>
        </div>
    </div>
@endsection
