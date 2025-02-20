@extends('layouts.app')
@section('title', 'Lista Noleggi')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Noleggi</h1>
        <a href="{{ route('rentals.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuovo Noleggio</a>
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