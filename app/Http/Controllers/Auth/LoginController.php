<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            /** @var \App\Models\User|null $user */
            $user = Auth::user();
            
            // Reindirizza in base al ruolo
            if ($user?->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            // Per gli utenti normali
            return redirect()->route('user.dashboard');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => __('auth.failed'),
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
