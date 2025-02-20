<?php

namespace App\Http\Controllers;

use App\Mail\CheckMail;
use App\Models\User;
use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class EmailController extends Controller
{

    public function SendCheckEmail(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Utilisateur non connecté'], 401);
        }

        $toEmail = $user->email;

        $appointment = Appointments::where('user_student_id', $user->id)
            ->orderBy('id', 'desc') // Trier par ID décroissant pour prendre le plus récent
            ->first();

        if (!$appointment) {
            return response()->json(['message' => "Aucun rendez-vous trouvé."], 404);
        }

        $date = Carbon::parse($appointment->date)->format('d/m/y');
        $start_time = Carbon::parse($appointment->start_time)->format('H:i');

        $message = "Bonjour, vous avez bien un rendez-vous le {$date} à {$start_time}.";
        $subject = "Confirmation de rendez-vous";

        Mail::to($toEmail)->send(new CheckMail($message, $subject));

        return response()->json(['message' => 'Email envoyé avec succès !']);
    }


}
