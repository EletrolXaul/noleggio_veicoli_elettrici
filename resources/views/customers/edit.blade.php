@extends('layouts.app')
@section('title', 'Modifica Cliente')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Modifica Cliente</h1>

                <form action="{{ route('customers.update', $customer) }}" method="POST">
                    @csrf
                    @include('components.errors')
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Nome</label>
                        <input type="text" name="name" value="{{ old('name', $customer->name) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $customer->email) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Telefono</label>
                        <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Numero Patente</label>
                        <input type="text" name="license_number"
                            value="{{ old('license_number', $customer->license_number) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Aggiorna Cliente</button>
                    <a href="{{ route('customers.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Annulla</a>
                </form>
            </div>
        </div>
    </div>
@endsection
