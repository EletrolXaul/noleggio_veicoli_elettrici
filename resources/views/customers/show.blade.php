@extends('layouts.app')
@section('title', 'Dettaglio Cliente')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Dettaglio Cliente</h1>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="font-bold">Nome:</p>
                        <p>{{ $customer->name }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Email:</p>
                        <p>{{ $customer->email }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Telefono:</p>
                        <p>{{ $customer->phone }}</p>
                    </div>
                    <div>
                        <p class="font-bold">Numero Patente:</p>
                        <p>{{ $customer->license_number }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Noleggi Attivi</h2>
                    @if ($customer->rentals->where('status', 'active')->count() > 0)
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b">Veicolo</th>
                                    <th class="px-6 py-3 border-b">Data Inizio</th>
                                    <th class="px-6 py-3 border-b">Data Fine</th>
                                    <th class="px-6 py-3 border-b">Costo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->rentals->where('status', 'active') as $rental)
                                    <tr>
                                        <td class="px-6 py-4 border-b">{{ $rental->vehicle->model }}</td>
                                        <td class="px-6 py-4 border-b">{{ $rental->start_time }}</td>
                                        <td class="px-6 py-4 border-b">{{ $rental->end_time }}</td>
                                        <td class="px-6 py-4 border-b">€{{ $rental->total_cost }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">Nessun noleggio attivo</p>
                    @endif
                </div>

                <div class="mt-6">
                    <a href="{{ route('customers.edit', $customer) }}"
                        class="bg-yellow-500 text-white px-4 py-2 rounded">Modifica</a>
                    <a href="{{ route('customers.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Indietro</a>
                </div>
            </div>
        </div>
    </div>
@endsection
