<?php

namespace App\Http\Requests;  // Changez le namespace ici
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
            'user_teacher_id' => 'required|exists:users,id',
            'user_student_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|decimal:2,2',
        ];
    }
}