<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Rental;
use Illuminate\Auth\Access\HandlesAuthorization;

class RentalPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Rental $rental)
    {
        return $user->id === $rental->user_id || $user->isAdmin();
    }

    public function create(User $user)
    {
        return true; // Tutti gli utenti autenticati possono creare noleggi
    }

    public function update(User $user, Rental $rental)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Rental $rental)
    {
        return $user->isAdmin();
    }
}