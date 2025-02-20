@extends('layouts.app')
@section('title', 'Nuovo Noleggio')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Nuovo Noleggio</h1>

                <form action="{{ route('rentals.store') }}" method="POST">
                    @csrf
                    @include('components.errors')
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Cliente</label>
                        <select name="customer_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Veicolo</label>
                        <select name="vehicle_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->model }} - €{{ $vehicle->hourly_rate }}/h</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Data Inizio</label>
                        <input type="datetime-local" name="start_time" 
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Data Fine</label>
                        <input type="datetime-local" name="end_time" 
                               class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Crea Noleggio
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection