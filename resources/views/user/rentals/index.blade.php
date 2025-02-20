<?php
@extends('layouts.guest')
@section('title', 'I Miei Noleggi')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">I Miei Noleggi</h1>

        @if($rentals->count() > 0)
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b">Veicolo</th>
                            <th class="px-6 py-3 border-b">Data Inizio</th>
                            <th class="px-6 py-3 border-b">Data Fine</th>
                            <th class="px-6 py-3 border-b">Costo</th>
                            <th class="px-6 py-3 border-b">Stato</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentals as $rental)
                            <tr>
                                <td class="px-6 py-4 border-b">{{ $rental->vehicle->model }}</td>
                                <td class="px-6 py-4 border-b">{{ $rental->start_time->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 border-b">{{ $rental->end_time->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 border-b">€{{ $rental->total_cost }}</td>
                                <td class="px-6 py-4 border-b">
                                    <span class="px-2 py-1 rounded text-sm
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
            {{ $rentals->links() }}
        @else
            <p class="text-gray-600">Non hai ancora effettuato noleggi.</p>
        @endif
    </div>
</div>
@endsection