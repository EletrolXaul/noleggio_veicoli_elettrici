@extends('layouts.guest')

@section('title', 'Chi Siamo')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-6">Chi Siamo</h1>
                
                <div class="prose max-w-none">
                    <p class="text-lg text-gray-700 mb-6">
                        Benvenuti in Noleggio EV, la tua destinazione di fiducia per la mobilità elettrica sostenibile. 
                        La nostra missione è rendere il trasporto eco-friendly accessibile a tutti.
                    </p>

                    <h2 class="text-2xl font-semibold mb-4">La Nostra Missione</h2>
                    <p class="text-gray-700 mb-6">
                        Crediamo in un futuro di mobilità sostenibile. Il nostro obiettivo è offrire soluzioni 
                        di trasporto innovative che rispettino l'ambiente e soddisfino le esigenze dei nostri clienti.
                    </p>

                    <h2 class="text-2xl font-semibold mb-4">La Nostra Flotta</h2>
                    <p class="text-gray-700 mb-6">
                        Disponiamo di una vasta gamma di veicoli elettrici, dalle auto alle bici, tutti mantenuti 
                        secondo i più alti standard di qualità e sicurezza.
                    </p>

                    <h2 class="text-2xl font-semibold mb-4">I Nostri Valori</h2>
                    <ul class="list-disc list-inside text-gray-700 mb-6">
                        <li>Sostenibilità ambientale</li>
                        <li>Innovazione tecnologica</li>
                        <li>Qualità del servizio</li>
                        <li>Soddisfazione del cliente</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection