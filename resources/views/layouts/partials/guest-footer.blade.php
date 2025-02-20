<footer class="bg-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Noleggio EV</h3>
                <p class="text-gray-400">
                    La tua scelta sostenibile per la mobilità elettrica.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Links Utili</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Home</a></li>
                    <li><a href="{{ route('vehicles.public') }}" class="text-gray-400 hover:text-white">Veicoli</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white">Chi Siamo</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white">Contatti</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Contatti</h3>
                <ul class="space-y-2 text-gray-400">
                    <li>Email: info@noleggioev.it</li>
                    <li>Tel: +39 123 456 7890</li>
                    <li>Indirizzo: Via Example 123, Città</li>
                </ul>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-gray-700">
            <p class="text-center text-gray-400">
                © {{ date('Y') }} Noleggio EV. Tutti i diritti riservati.
            </p>
        </div>
    </div>
</footer>
