<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentReminderMail;

class SendAppointmentReminders extends Command
{
    protected $signature = 'appointment:reminder';
    protected $description = 'Envoie un rappel par email la veille du rendez-vous';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow();

        $appointments = DB::table('appointments')
            ->join('users', 'appointments.user_student_id', '=', 'users.id')
            ->whereDate('appointments.date', $tomorrow)
            ->select('appointments.*', 'users.email', 'users.name')
            ->get()
            ->map(function ($appointment) {
                // Convertir la date en objet Carbon
                $appointment->date = Carbon::parse($appointment->date);
                return $appointment;
            });


        foreach ($appointments as $appointment) {
            // Envoi du mail uniquement à l'étudiant
            Mail::to($appointment->email)->send(new AppointmentReminderMail($appointment));
        }

        $this->info('Rappels envoyés aux étudiants avec succès !');
    }

}

