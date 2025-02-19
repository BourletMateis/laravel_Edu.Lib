<?php
namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\User;  // Assure-toi d'importer le modèle User
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    public function index()
    {
        Carbon::setLocale('fr');
        $appointments = Appointments::all();

        $events = $appointments->map(function ($appointment) {
            $user = User::find($appointment->user_student_id);
            return [
                'id' => $appointment->id,
                'title' => $user->name,
                'surname' => $user->surname,
                'email'=> $user->email,
                'user_student_id' => $appointment->user_student_id,
                'user_teacher_id' => $appointment->user_teacher_id,
                'subject' => $appointment->title,
                'description' => $appointment->description,
                'date' => $appointment->date,
                'start' => $appointment->start_time,
                'end' => $appointment->end_time,
            ];
        });

        // Retourner la réponse JSON
        return response()->json($events);
    }

    public function destroy(Request $request)
    {
        $appointment = Appointments::find($request->id);
            if ($appointment) {
            $appointment->delete();
            return response()->json(['message' => 'Rendez-vous supprimé']);
        }
            return response()->json(['message' => 'Rendez-vous non trouvé'], 404);
    }


    public function showReservation() {
        return view('reservation');
    }
}
