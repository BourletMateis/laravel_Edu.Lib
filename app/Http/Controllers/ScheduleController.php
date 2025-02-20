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
    /*
     * Display the schedule management page.
     *
     * @param Request $request The incoming request containing optional start and end times.
     * @return \Illuminate\View\View The calendar view with schedules and available slots.
     */

    public function index(Request $request) {
        $this->authorize('view', new Schedule());

        $startTime = $request->input('start_time', '07:00');
        $endTime = $request->input('end_time', '21:00');

        $schedules = Schedule::where('user_teacher_id', Auth::id())->get();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        $availableSlots = $this->generateTimeSlots($startTime, $endTime);

        return view('calendar', compact('schedules', 'availableSlots','days'));

    }

    /*
     * Store a new schedule slot for a teacher.
     *
     * @param ScheduleRequest $request The validated request data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the schedules index with a success or error message.
     */
    public function store(ScheduleRequest $request) // Utilisation de ScheduleRequest
    {
        // Vérifier si l'horaire existe déjà pour cet enseignant
        $exists = Schedule::where('user_teacher_id', Auth::id())
            ->where('day', $request->day)
            ->where('time_start', $request->time_start)
            ->where('time_end', $request->time_end)
            ->exists();

        if ($exists) {
            return redirect()->route('schedules.index')
                ->with('error', 'Cet horaire existe déjà.');
        }

        // Enregistrement de l'horaire dans la base de données
        Schedule::create([
            'user_teacher_id' => Auth::id(),
            'booked' => false,
            'day' => $request->day,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);

        // Redirection avec un message de succès
        return redirect()->route('schedules.index')->with('success', 'Horaire ajouté');
    }


    /*
     * Delete a schedule slot.
     *
     * @param Schedule $schedule The schedule instance to be deleted.
     * @return \Illuminate\Http\JsonResponse Returns a JSON response with a success or error message.
     */
    public function destroy(Schedule $schedule) {
        $this->authorize('delete', $schedule);
        // Supprimer l'horaire si c'est le professeur connecté qui en est l'auteur
        if ($schedule->user_teacher_id == Auth::id()) {
            $schedule->delete();
            return response()->json(['message' => 'Plage horaire supprimée']);
                }
                return response()->json(['message' => 'Plage horaire non trouvé'], 404);
            }


    /*
     * Generate time slots between a given start and end time.
     *
     * @param string $startTime The start time in "H:i" format.
     * @param string $endTime The end time in "H:i" format.
     * @return array An array of available time slots.
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

<<<<<<< HEAD
    /*
     * Load the teacher's schedule and return it in JSON format.
     *
     * @return \Illuminate\Http\JsonResponse JSON response containing the teacher's schedule events.
     */
    public function load_schedule()
=======
    public function ScheduleCalendar() {
        Carbon::setLocale('fr');
        $schedules = schedule::all();

        $list_schedules = $schedules->map(function ($schedules) {
            $start = Carbon::parse($schedules->time_start)->locale('fr'); //convertit les heures de debut
            $end = Carbon::parse($schedules->time_end)->locale('fr'); //convertit les heures de fin

            $hours = []; //les heures en tableaux


            for ($current = $start; $current->lt($end); $current->addHour()) { //calcule end - start = n - 1
                $hours[] = $current->isoFormat('HH:mm');
            }

            return [
                'day' => $schedules->day,
                'user_teacher_id' => $schedules->user_teacher_id,
                'hours' => $hours,
            ];
        });

        return response()->json($list_schedules); //met en format json

    }
    
        public function load_schedule()
>>>>>>> main
    {
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
