<?php
namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    public function index()
    {
        Carbon::setLocale('fr');
        $appointments = Appointments::all();

        $events = $appointments->map(function ($appointment) {
            // Formatage des dates
            $start = Carbon::parse($appointment->date . ' ' . $appointment->start_time)->locale('fr')->isoFormat('YYYY-MM-DDTHH:mm');
            $end = Carbon::parse($appointment->date . ' ' . $appointment->end_time)->locale('fr')->isoFormat('YYYY-MM-DDTHH:mm');

            return [
                'title' => 'RDV',
                'start' => $start,
                'end' => $end,
            ];
        });

        return response()->json($events);
    }

    public function showReservation() {
        return view('reservation');
    }
}
