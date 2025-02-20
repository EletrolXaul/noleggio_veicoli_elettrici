@extends('layouts.app')
@section('title', 'Lista Noleggi')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Noleggi</h1>
        <a href="{{ route('rentals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuovo Noleggio</a>
    </div>

    <div class="mb-6">
        <form action="{{ route('rentals.index') }}" method="GET" class="grid grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Tutti</option>
                    <option value="active">Attivi</option>
                    <option value="completed">Completati</option>
                    <option value="cancelled">Cancellati</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Data Inizio</label>
                <input type="date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Data Fine</label>
                <input type="date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Filtra
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b">Cliente</th>
                    <th class="px-6 py-3 border-b">Veicolo</th>
                    <th class="px-6 py-3 border-b">Inizio</th>
                    <th class="px-6 py-3 border-b">Fine</th>
                    <th class="px-6 py-3 border-b">Stato</th>
                    <th class="px-6 py-3 border-b">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                    <tr>
                        <td class="px-6 py-4 border-b">{{ $rental->customer->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $rental->vehicle->model }}</td>
                        <td class="px-6 py-4 border-b">{{ $rental->start_time }}</td>
                        <td class="px-6 py-4 border-b">{{ $rental->end_time }}</td>
                        <td class="px-6 py-4 border-b">{{ $rental->status }}</td>
                        <td class="px-6 py-4 border-b">
                            @if($rental->status === 'active')
                                <form action="{{ route('rentals.complete', $rental) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-500">Completa</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection