@extends('layouts.admin')

@section('title', 'Dettaglio Noleggio')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.rentals.index') }}" class="text-blue-500 hover:underline">
                ← Torna ai noleggi
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <h1 class="text-2xl font-bold mb-6">Dettaglio Noleggio #{{ $rental->id }}</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Info Cliente --}}
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informazioni Cliente</h2>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nome</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $rental->user->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $rental->user->email }}</dd>
                            </div>
                        </dl>
                    </div>

                    {{-- Info Veicolo --}}
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informazioni Veicolo</h2>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Modello</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $rental->vehicle->model }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tipo</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $rental->vehicle->type }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Dettagli Noleggio</h2>
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Data Inizio</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $rental->start_time->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Data Fine</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $rental->end_time->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Durata</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $rental->start_time->diffInHours($rental->end_time) }} ore</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Costo Totale</dt>
                            <dd class="mt-1 text-2xl font-bold text-gray-900">€{{ $rental->total_cost }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Stato</dt>
                            <dd class="mt-1">
                                <span class="px-2 py-1 rounded-full text-sm
                                    {{ $rental->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $rental->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $rental->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $rental->status }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                @if($rental->status === 'active')
                    <div class="mt-8 flex gap-4">
                        <form action="{{ route('admin.rentals.complete', $rental) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Completa Noleggio
                            </button>
                        </form>
                        <form action="{{ route('admin.rentals.cancel', $rental) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
                                    onclick="return confirm('Sei sicuro di voler cancellare questo noleggio?')">
                                Cancella Noleggio
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection