<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Vérifie si l'utilisateur est un administrateur.
     */
    public function isAdmin(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un enseignant.
     */
    public function isTeacher(User $user)
    {
        return $user->role === 'teacher' || $user->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un etudiant.
     */
    public function isStudent(User $user)
    {
        return $user->role === 'student' || $user->role === 'admin';
    }
}
