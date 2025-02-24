<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var User|null $user */
        $user = Auth::user();
        
        if (!$user?->isAdmin()) {
            return redirect()->route('home')
                ->with('error', 'Non hai i permessi per accedere a questa sezione');
        }

        return $next($request);
    }
}