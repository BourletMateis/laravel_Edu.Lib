<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentReminderMail extends Mailable
{
    use SerializesModels;

    public $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->subject('Rappel de votre rendez-vous')
            ->view('mail-template.reminder')
            ->with([
                'appointment' => $this->appointment,
            ]);
    }
}
