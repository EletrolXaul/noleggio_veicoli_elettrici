<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'user')
                        ->withCount('rentals')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
                        
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $user)
    {
        if ($user->role !== 'user') {
            abort(404);
        }

        $user->load(['rentals.vehicle']);
        
        return view('admin.customers.show', compact('user'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'user'
        ]);

        return redirect()->route('admin.customers.index')
                        ->with('success', 'Cliente creato con successo');
    }

    public function edit(User $user)
    {
        if ($user->role !== 'user') {
            abort(404);
        }

        return view('admin.customers.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->role !== 'user') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        if (isset($validated['password'])) {
            $user->update(['password' => bcrypt($validated['password'])]);
        }

        return redirect()->route('admin.customers.index')
                        ->with('success', 'Cliente aggiornato con successo');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'user') {
            abort(404);
        }

        if ($user->rentals()->where('status', 'active')->exists()) {
            return back()->with('error', 'Non puoi eliminare un cliente con noleggi attivi');
        }

        $user->delete();

        return redirect()->route('admin.customers.index')
                        ->with('success', 'Cliente eliminato con successo');
    }
}
