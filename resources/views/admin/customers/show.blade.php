@extends('layouts.admin')

@section('title', 'Dettaglio Cliente')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.customers.index') }}" class="text-blue-500 hover:underline">
                ← Torna ai clienti
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">{{ $customer->name }}</h1>
                    <div class="flex gap-4">
                        <a href="{{ route('admin.customers.edit', $customer) }}" 
                           class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                            Modifica
                        </a>
                        @if($customer->rentals()->where('status', 'active')->count() === 0)
                            <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
                                        onclick="return confirm('Sei sicuro di voler eliminare questo cliente?')">
                                    Elimina
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Info Cliente --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informazioni Personali</h2>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $customer->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Data Registrazione</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $customer->created_at->format('d/m/Y') }}</dd>
                            </div>
                        </dl>
                    </div>

                    {{-- Statistiche Noleggi --}}
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Statistiche Noleggi</h2>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Noleggi Attivi</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $customer->rentals()->where('status', 'active')->count() }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Noleggi Completati</dt>
                                <dd class="mt-1 text-lg text-gray-900">{{ $customer->rentals()->where('status', 'completed')->count() }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Totale Speso</dt>
                                <dd class="mt-1 text-lg text-gray-900">€{{ $customer->rentals()->sum('total_cost') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                {{-- Lista Noleggi --}}
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Storia Noleggi</h2>
                    @if($customer->rentals->count() > 0)
                        <div class="overflow-x-auto">
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
                                    @foreach($customer->rentals as $rental)
                                        <tr>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">Nessun noleggio registrato per questo cliente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
