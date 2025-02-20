<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // Utilisation du modèle User au lieu de Professeur

class ProfesseurController extends Controller
{
    public function index()
    {
        // Récupérer uniquement les utilisateurs où 'is_teacher' est égal à 1
        $professeurs = User::where('role', "teacher")->get();

        // Passer les professeurs à la vue 'reservation'
        return view('reservation', compact('professeurs'));
    }
}
