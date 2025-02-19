<?php
namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User; 

class AppointmentsController extends Controller
{
    public function index()
    {
        Carbon::setLocale('fr');
        $appointments = Appointments::where('user_teacher_id', auth()->id())->get();

        $events = $appointments->map(function ($appointment) {
            // Formatage des dates
            $start = Carbon::parse($appointment->date . ' ' . $appointment->start_time)->locale('fr')->isoFormat('YYYY-MM-DDTHH:mm');
            $end = Carbon::parse($appointment->date . ' ' . $appointment->end_time)->locale('fr')->isoFormat('YYYY-MM-DDTHH:mm');

            $user = User::find($appointment->user_student_id);
            $name_surname = $user->name . ' ' . $user->surname;
            
            return [
                'id' => $appointment->id,
                'start' => $start,
                'end' => $end,
                'title' => $name_surname,
                'email'=> $user->email,
                'user_student_id' => $appointment->user_student_id,
                'user_teacher_id' => $appointment->user_teacher_id,
                'subject' => $appointment->title,
                'description' => $appointment->description,
                'date' => $appointment->date,
            ];
        });

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
    
}
