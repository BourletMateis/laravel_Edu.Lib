<?php

namespace App\Policies;

use App\Models\Appointments;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Container\Attributes\Auth;

class AppointmentsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAdmin(User $user, Appointments $appointments): bool
    {
        return $user->role === 'admin' || $user->role === 'teacher' || $user->id === auth()->id();
    }


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Appointments $appointments): bool
    {
        return $user->role === 'teacher' || $user->role === 'admin' || $user->role === 'student';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'teacher' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Appointments $appointments): bool
    {
        return $user->role === 'teacher' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Appointments $appointments): bool
    {
        return $user->role === 'teacher' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Appointments $appointments): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Appointments $appointments): bool
    {
        return $user->role === 'teacher' || $user->role === 'admin';
    }
}
