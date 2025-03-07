<?php
// app/Http/Controllers/Public/ContactController.php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('public.contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Qui puoi aggiungere la logica per l'invio effettivo del messaggio
        // Per esempio, salvare nel database o inviare una mail

        return back()->with('success', 'Messaggio inviato con successo!');
    }
}