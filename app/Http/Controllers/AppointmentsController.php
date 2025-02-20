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

    public function createAppointments(Request $request)
    {
        try {
            // Valider les données envoyées
            $validatedData = $request->validate([
                'day'  => 'required|date',
                'hour' => 'required|time',
                'teacher_id' => 'required|exists:users,id',  
                'student_id' => 'required|exists:users,id',  
                'title' => 'required|string|max:255',  
                'description' => 'nullable|string|max:255',  
            ]);
    
            // Créer un nouveau rendez-vous
            $appointment = Appointments::create([
                'user_student_id' => $validatedData['student_id'],
                'user_teacher_id' => $validatedData['teacher_id'],
                'title' => $validatedData['title'],
                'description' => $validatedData['description'] ?? null,  // Description optionnelle
                'date' => $validatedData['day'],
                'start_time' => $validatedData['hour'],
                'end_time' => $validatedData['hour'],  // Vous pouvez ajouter une logique pour l'heure de fin si nécessaire
                'price' => 0.00,  // Assurez-vous de gérer le prix comme vous le souhaitez
            ]);
    
            // Retourner une réponse JSON
            return response()->json([
                'message'     => 'Rendez-vous créé avec succès !',
                'appointment' => $appointment,
            ], 201);
        } catch (\Exception $e) {
            // En cas d'erreur, capturer et renvoyer une erreur détaillée
            \Log::error('Erreur lors de la création du rendez-vous: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Erreur lors de la création du rendez-vous.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    
}
