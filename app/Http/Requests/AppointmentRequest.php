<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true; // Mets une logique d'autorisation si nécessaire
    }

    /**
     * Définit les règles de validation.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:appointments,id',
        ];
    }
}
