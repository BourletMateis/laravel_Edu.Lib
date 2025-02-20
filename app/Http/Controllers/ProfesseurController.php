<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // Using the User model instead of Teacher

class ProfesseurController extends Controller
{
    public function index()
    {
        // Get only users where 'is_teacher' is 1
        $professeurs = User::where('role', "teacher")->get();

        // Switch teachers to the 'reservation' view
        return view('reservation', compact('professeurs'));
    }
}
