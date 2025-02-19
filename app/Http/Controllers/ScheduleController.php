<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Requests\ScheduleRequest;
class ScheduleController extends Controller
{
    public function index(Request $request) {
        $this->authorize('view', new Schedule());

        $startTime = $request->input('start_time', '07:00');
        $endTime = $request->input('end_time', '21:00');

        $schedules = Schedule::where('user_teacher_id', Auth::id())->get();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        $availableSlots = $this->generateTimeSlots($startTime, $endTime);

        return view('calendar', compact('schedules', 'availableSlots','days'));

    }


    public function store(ScheduleRequest $request) // Utilisation de ScheduleRequest
    {
    }


    public function destroy(Schedule $schedule) {
        $this->authorize('delete', $schedule);
        // Supprimer l'horaire si c'est le professeur connecté qui en est l'auteur
        if ($schedule->user_teacher_id == Auth::id()) {
            $schedule->delete();
            return response()->json(['message' => 'Plage horaire supprimée']);
                }
                return response()->json(['message' => 'Plage horaire non trouvé'], 404);
            }


    /**
     * Génère des créneaux horaires entre une heure de début et une heure de fin.
     */
    private function generateTimeSlots($startTime, $endTime) {
        $this->authorize('view', new Schedule());
        $slots = [];
        $start = Carbon::createFromFormat('H:i', $startTime);
        $end = Carbon::createFromFormat('H:i', $endTime);

        while ($start->lt($end)) {
            $slots[] = $start->format('H:i');
            $start->addHour();
        }

        return $slots;
    }

    public function load_schedule()
    {
        $this->authorize('view', new Schedule());
        Carbon::setLocale('fr');
        $schedules = schedule::where('user_teacher_id', auth()->id())->get();

        $events = $schedules->map(function ($schedules) {
            // Formatage des dates
            $start = Carbon::parse($schedules->day . ' ' . $schedules->time_start)->locale('fr')->isoFormat('YYYY-MM-DDTHH:mm');
            $end = Carbon::parse($schedules->day . ' ' . $schedules->time_end)->locale('fr')->isoFormat('YYYY-MM-DDTHH:mm');
            $end_time = Carbon::parse($schedules->time_end)->locale('fr')->isoFormat('HH:mm');



            $user = User::find($schedules->user_teacher_id);

            return [
                'id' => $schedules->id,
                'start' => $start,
                'end' => $end,
                "className"=> "event-schedule-load",


            ];
        });

        return response()->json($events);
    }
}
