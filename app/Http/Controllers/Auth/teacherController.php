<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

// Utilisation du modèle User au lieu de Professeur

class teacherController extends Controller
{
    public function index()
    {
        // Récupérer uniquement les utilisateurs où 'is_teacher' est égal à 1
        $professeurs = User::where('role', "teacher")->get();

        // Passer les professeurs à la vue 'reservation'
        return view('reservation', compact('professeurs'));
    }
}
