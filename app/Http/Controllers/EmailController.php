<?php

namespace App\Http\Controllers;

use App\Mail\CheckMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class EmailController extends Controller
{

    public function SendCheckEmail(Request $request){

        //$dateRdv = $request->input('date');   // La date du rendez-vous (format: 'Y-m-d')
       // $heureRdv = $request->input('heure'); // L'heure du rendez-vous (format: 'H')

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non connecté'], 401);  // Retourne une erreur si l'utilisateur n'est pas connecté
        }

        // Récupérer l'email de l'utilisateur
        $toEmail = $user->email;


        $dateRdv = 22/07/2021;
        $heureRdv = 3;
        // Crée un message personnalisé
        $message = "Bonjour, vous avez bien un rendez-vous le " . \Carbon\Carbon::parse($dateRdv)->format('d/m/Y') . " à " . $heureRdv . "h00.";
        $subject = "Confirmation de rendez-vous";

        // Envoi de l'email
        $response = Mail::to($toEmail)->send(new CheckMail($message, $subject));

        // Affiche la réponse ou un message de confirmation (par exemple)
        dd($response ? 'Email envoyé avec succès!' : 'Échec de l\'envoi de l\'email.');
    }

}
