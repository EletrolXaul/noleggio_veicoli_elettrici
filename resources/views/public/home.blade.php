@extends('layouts.guest')

@section('title', 'Home')

@section('content')
<div class="relative">
    {{-- Hero Section --}}
    <div class="relative bg-gray-900">
        <div class="mx-auto max-w-7xl px-4 py-24 sm:py-32 lg:flex lg:items-center lg:gap-x-10 lg:px-8 lg:py-40">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:flex-auto">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">
                    Mobilità Elettrica Sostenibile
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-300">
                    Scopri il futuro della mobilità con la nostra flotta di veicoli elettrici.
                    Zero emissioni, massima efficienza.
                </p>
                <div class="mt-10 flex items-center gap-x-6">
                    <a href="{{ route('vehicles.public') }}" class="btn-primary">
                        Scopri i Veicoli
                    </a>
                    <a href="{{ route('about') }}" class="text-sm font-semibold leading-6 text-white">
                        Scopri di più <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Veicoli in Evidenza --}}
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                I Nostri Veicoli
            </h2>
            <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($availableVehicles as $vehicle)
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold">{{ $vehicle->model }}</h3>
                            <p class="mt-2 text-gray-600">{{ $vehicle->type }}</p>
                            <p class="mt-2">
                                <span class="text-sm font-medium text-gray-500">Batteria:</span>
                                <span class="ml-1">{{ $vehicle->battery_capacity }}%</span>
                            </p>
                            <p class="mt-4 text-2xl font-bold">€{{ $vehicle->hourly_rate }}/ora</p>
                            <a href="{{ route('vehicles.show', $vehicle) }}" 
                               class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                                Dettagli →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
