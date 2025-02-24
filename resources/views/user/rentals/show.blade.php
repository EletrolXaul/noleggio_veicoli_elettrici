@extends('layouts.guest')

@section('title', 'Dettaglio Noleggio')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6">Dettaglio Noleggio</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Informazioni Veicolo --}}
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Veicolo</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><span class="font-medium">Modello:</span> {{ $rental->vehicle->model }}</p>
                            <p><span class="font-medium">Tipo:</span> {{ $rental->vehicle->type }}</p>
                            <p><span class="font-medium">Tariffa oraria:</span> €{{ $rental->vehicle->hourly_rate }}</p>
                        </div>
                    </div>

                    {{-- Dettagli Noleggio --}}
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Dettagli Noleggio</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><span class="font-medium">Data Inizio:</span> {{ $rental->start_time->format('d/m/Y H:i') }}</p>
                            <p><span class="font-medium">Data Fine:</span> {{ $rental->end_time->format('d/m/Y H:i') }}</p>
                            <p><span class="font-medium">Stato:</span> 
                                <span class="px-2 py-1 text-sm font-semibold rounded-full
                                    {{ $rental->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $rental->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $rental->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $rental->status }}
                                </span>
                            </p>
                            <p><span class="font-medium">Costo Totale:</span> €{{ $rental->total_cost }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('user.rentals') }}" class="btn-secondary">
                        Torna ai noleggi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection