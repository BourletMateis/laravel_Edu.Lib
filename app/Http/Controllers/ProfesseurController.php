<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;
use App\Models\User;  

class ProfesseurController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Appointments()); 

        // Get only users where 'is_teacher' is 1
        $professeurs = User::where('role', "teacher")->get();

        // Switch teachers to the 'reservation' view
        return view('reservation', compact('professeurs'));
    }

}
