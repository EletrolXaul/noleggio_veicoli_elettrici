@extends('layouts.admin')

@section('title', 'Gestione Clienti')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Clienti</h1>
            <a href="{{ route('admin.customers.create') }}" class="btn-primary">
                Nuovo Cliente
            </a>
        </div>

        {{-- Tabella clienti --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b">Nome</th>
                        <th class="px-6 py-3 border-b">Email</th>
                        <th class="px-6 py-3 border-b">Noleggi Attivi</th>
                        <th class="px-6 py-3 border-b">Data Registrazione</th>
                        <th class="px-6 py-3 border-b">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td class="px-6 py-4 border-b">{{ $customer->name }}</td>
                            <td class="px-6 py-4 border-b">{{ $customer->email }}</td>
                            <td class="px-6 py-4 border-b">{{ $customer->active_rentals_count }}</td>
                            <td class="px-6 py-4 border-b">{{ $customer->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 border-b">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.customers.show', $customer) }}" 
                                       class="text-blue-500 hover:text-blue-700">
                                        Dettagli
                                    </a>
                                    <a href="{{ route('admin.customers.edit', $customer) }}" 
                                       class="text-yellow-500 hover:text-yellow-700">
                                        Modifica
                                    </a>
                                    <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700"
                                                onclick="return confirm('Sei sicuro di voler eliminare questo cliente?')">
                                            Elimina
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection