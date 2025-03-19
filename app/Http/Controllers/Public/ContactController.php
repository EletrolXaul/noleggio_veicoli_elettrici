<?php
// app/Http/Controllers/Public/ContactController.php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Invia email all'indirizzo amministrativo
        Mail::to(env('ADMIN_EMAIL', 'info@noleggioev.it'))
            ->send(new ContactMail(
                $validated['name'],
                $validated['email'],
                $validated['subject'],
                $validated['message']
            ));

        return back()->with('success', 'Messaggio inviato con successo! Ti risponderemo al più presto.');
    }
}