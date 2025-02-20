@extends('layouts.guest')

@section('title', $vehicle->model)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('vehicles.public') }}" class="text-blue-500 hover:underline">
                ← Torna ai veicoli
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-4">{{ $vehicle->model }}</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Dettagli Veicolo</h2>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tipo</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $vehicle->type }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Batteria</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $vehicle->battery_capacity }}%</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tariffa Oraria</dt>
                                <dd class="mt-1 text-2xl font-bold text-gray-900">€{{ $vehicle->hourly_rate }}/ora</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Stato</dt>
                                <dd class="mt-1">
                                    <span class="px-2 py-1 text-sm rounded-full
                                        {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $vehicle->status === 'rented' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $vehicle->status === 'maintenance' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $vehicle->status }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    @if($vehicle->isAvailable())
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Prenota Ora</h2>
                        <form action="{{ route('rentals.book', $vehicle) }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Data e Ora Inizio</label>
                                <input type="datetime-local" name="start_time" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                                       min="{{ now()->format('Y-m-d\TH:i') }}" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Data e Ora Fine</label>
                                <input type="datetime-local" name="end_time" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                                       min="{{ now()->format('Y-m-d\TH:i') }}"
                                       max="{{ now()->addMonth()->format('Y-m-d\TH:i') }}"
                                       required>
                            </div>
                            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Prenota
                            </button>
                        </form>

                        @if ($errors->any())
                            <div class="mt-4 bg-red-50 text-red-800 p-4 rounded-md">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    @else
                        <div class="flex items-center justify-center">
                            <span class="text-lg text-gray-500">
                                Questo veicolo non è attualmente disponibile per il noleggio
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection