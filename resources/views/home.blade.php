@extends('layouts.app')
@section('title', 'Home - Noleggio Veicoli Elettrici')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-8">Noleggio Veicoli Elettrici</h1>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-6 bg-blue-50 rounded-lg">
                            <h2 class="text-xl font-semibold mb-4">Veicoli</h2>
                            <p class="mb-4">Gestisci il parco veicoli elettrici</p>
                            <a href="{{ route('vehicles.index') }}"
                                class="inline-block bg-blue-500 text-white px-4 py-2 rounded">
                                Vai ai Veicoli
                            </a>
                        </div>

                        <div class="p-6 bg-green-50 rounded-lg">
                            <h2 class="text-xl font-semibold mb-4">Clienti</h2>
                            <p class="mb-4">Gestisci l'anagrafica clienti</p>
                            <a href="{{ route('customers.index') }}"
                                class="inline-block bg-green-500 text-white px-4 py-2 rounded">
                                Vai ai Clienti
                            </a>
                        </div>

                        <div class="p-6 bg-purple-50 rounded-lg">
                            <h2 class="text-xl font-semibold mb-4">Noleggi</h2>
                            <p class="mb-4">Gestisci i noleggi attivi</p>
                            <a href="{{ route('rentals.index') }}"
                                class="inline-block bg-purple-500 text-white px-4 py-2 rounded">
                                Vai ai Noleggi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
