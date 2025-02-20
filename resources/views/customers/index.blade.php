@extends('layouts.app')
@section('title', 'Lista Clienti')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Clienti</h1>
        <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nuovo Cliente</a>
    </div>

    <div class="bg-white shadow-md rounded-lg">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b">Nome</th>
                    <th class="px-6 py-3 border-b">Email</th>
                    <th class="px-6 py-3 border-b">Telefono</th>
                    <th class="px-6 py-3 border-b">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td class="px-6 py-4 border-b">{{ $customer->name }}</td>
                        <td class="px-6 py-4 border-b">{{ $customer->email }}</td>
                        <td class="px-6 py-4 border-b">{{ $customer->phone }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('customers.show', $customer) }}" class="text-blue-500">Dettagli</a>
                            <a href="{{ route('customers.edit', $customer) }}" class="text-yellow-500 ml-2">Modifica</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection