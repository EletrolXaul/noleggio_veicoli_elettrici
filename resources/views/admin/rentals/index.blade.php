@extends('layouts.admin')

@section('title', 'Gestione Noleggi')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Noleggi</h1>
            <a href="{{ route('admin.rentals.create') }}" class="btn-primary">
                Nuovo Noleggio
            </a>
        </div>

        {{-- Filtri --}}
        <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('admin.rentals.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stato</label>
                    <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        <option value="">Tutti</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Attivi</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completati</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancellati</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Data Inizio</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Data Fine</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="btn-primary w-full">Filtra</button>
                </div>
            </form>
        </div>

        {{-- Tabella noleggi --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b">Cliente</th>
                        <th class="px-6 py-3 border-b">Veicolo</th>
                        <th class="px-6 py-3 border-b">Data Inizio</th>
                        <th class="px-6 py-3 border-b">Data Fine</th>
                        <th class="px-6 py-3 border-b">Costo</th>
                        <th class="px-6 py-3 border-b">Stato</th>
                        <th class="px-6 py-3 border-b">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentals as $rental)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $rental->user->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $rental->vehicle->model }}</td>
                            <td class="px-6 py-4 border-b">{{ $rental->start_time->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 border-b">{{ $rental->end_time->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 border-b">€{{ $rental->total_cost }}</td>
                            <td class="px-6 py-4 border-b">
                                <span class="px-2 py-1 rounded-full text-sm
                                    {{ $rental->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $rental->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $rental->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ $rental->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 border-b">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.rentals.show', $rental) }}" 
                                       class="text-blue-500 hover:text-blue-700">
                                        Dettagli
                                    </a>
                                    @if($rental->status === 'active')
                                        <form action="{{ route('admin.rentals.complete', $rental) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-500 hover:text-green-700">
                                                Completa
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.rentals.cancel', $rental) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700"
                                                    onclick="return confirm('Sei sicuro di voler cancellare questo noleggio?')">
                                                Cancella
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $rentals->links() }}
        </div>
    </div>
</div>
@endsection