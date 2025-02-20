@extends('layouts.admin')

@section('title', 'Dettaglio Veicolo')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.vehicles.index') }}" class="text-blue-500 hover:underline">
                ← Torna ai veicoli
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">{{ $vehicle->model }}</h1>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}" 
                           class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                            Modifica
                        </a>
                        <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo veicolo?')">
                                Elimina
                            </button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Dettagli Veicolo --}}
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Dettagli</h2>
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

                    {{-- Storia Noleggi --}}
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Storia Noleggi</h2>
                        @if($vehicle->rentals->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 border-b">Cliente</th>
                                            <th class="px-6 py-3 border-b">Data Inizio</th>
                                            <th class="px-6 py-3 border-b">Data Fine</th>
                                            <th class="px-6 py-3 border-b">Stato</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vehicle->rentals as $rental)
                                            <tr>
                                                <td class="px-6 py-4 border-b">{{ $rental->user->name }}</td>
                                                <td class="px-6 py-4 border-b">{{ $rental->start_time->format('d/m/Y H:i') }}</td>
                                                <td class="px-6 py-4 border-b">{{ $rental->end_time->format('d/m/Y H:i') }}</td>
                                                <td class="px-6 py-4 border-b">
                                                    <span class="px-2 py-1 text-sm rounded-full
                                                        {{ $rental->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $rental->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $rental->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                        {{ $rental->status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">Nessun noleggio registrato per questo veicolo.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
