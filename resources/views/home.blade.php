@extends('layouts.app')

@section('title', 'Noleggio Veicoli Elettrici')

@section('content')
<div class="relative bg-white">
    {{-- Hero Section --}}
    <div class="relative bg-gray-900">
        <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
            <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 lg:pb-56 lg:pt-48 xl:col-span-6">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">
                        Noleggio Veicoli Elettrici
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-300">
                        Scopri la nostra flotta di veicoli elettrici per una mobilità sostenibile
                    </p>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ route('vehicles.index') }}" 
                           class="rounded-md bg-green-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-400">
                            Esplora i Veicoli
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Veicoli Disponibili --}}
    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Veicoli Disponibili
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    Scegli tra la nostra selezione di veicoli elettrici
                </p>
            </div>
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @foreach($availableVehicles as $vehicle)
                <article class="flex flex-col items-start justify-between">
                    <div class="w-full">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900">
                            {{ $vehicle->model }}
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-600">
                            Tipo: {{ ucfirst($vehicle->type) }}
                        </p>
                        <p class="text-sm text-gray-600">
                            €{{ $vehicle->hourly_rate }}/ora
                        </p>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
