@extends('layouts.app')
@section('title', 'Dettaglio Noleggio')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Dettaglio Noleggio</h1>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="font-bold">Cliente:</p>
                        <p>{{ $rental->customer->name }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Veicolo:</p>
                        <p>{{ $rental->vehicle->model }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Data Inizio:</p>
                        <p>{{ $rental->start_time }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Data Fine:</p>
                        <p>{{ $rental->end_time }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Costo Totale:</p>
                        <p>€{{ $rental->total_cost }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Stato:</p>
                        <p>{{ $rental->status }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    @if($rental->status === 'active')
                        <form action="{{ route('rentals.complete', $rental) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                Completa Noleggio
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('rentals.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
                        Indietro
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection