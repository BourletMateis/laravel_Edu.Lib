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

    public function SendCheckEmail(Request $request){

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non connecté'], 401);  // Retourne une erreur si l'utilisateur n'est pas connecté
        }

        // Récupérer l'email de l'utilisateur
        $toEmail = $user->email;

        // Recupérer dans la bdd Appointement
        $appointment = Appointments::where('user_student_id', $user->id)->orderBy('created_at', 'desc')->first();

        if (!$appointment) {
            return response()->json(['message' => "Aucun rendez-vous trouvé."], 404);
        }

        $date = Carbon::parse($appointment->date)->format('d/m/y');
        $start_time = Carbon::parse($appointment->start_time)->format('H:i');


        // Crée un message personnalisé
        $message = "Bonjour, vous avez bien un rendez-vous le {$date} à {$start_time}.";
        $subject = "Confirmation de rendez-vous";

        // Envoi de l'email
        $response = Mail::to($toEmail)->send(new CheckMail($message, $subject));

        // Affiche la réponse ou un message de confirmation (par exemple)
        dd($response ? 'Email envoyé avec succès!' : 'Échec de l\'envoi de l\'email.');
    }

}
