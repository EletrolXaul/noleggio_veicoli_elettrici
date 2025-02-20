@extends('layouts.app')
@section('title', 'Modifica Noleggio')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Modifica Noleggio</h1>

                <form action="{{ route('rentals.update', $rental) }}" method="POST">
                    @csrf
                    @include('components.errors')
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Cliente</label>
                        <select name="customer_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" 
                                    {{ $rental->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Veicolo</label>
                        <select name="vehicle_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}"
                                    {{ $rental->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->model }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Stato</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="active" {{ $rental->status == 'active' ? 'selected' : '' }}>Attivo</option>
                            <option value="completed" {{ $rental->status == 'completed' ? 'selected' : '' }}>Completato</option>
                            <option value="cancelled" {{ $rental->status == 'cancelled' ? 'selected' : '' }}>Cancellato</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Aggiorna Noleggio
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection