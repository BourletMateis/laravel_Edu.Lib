<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    // MODIFIABLE EN FONCTION DU CODE

    protected $table = 'appointments';
    protected $fillable = [
        "id",
        "user_teacher_id",
        "user_student_id",
        "title",
        "description",
        "date",
        "start_time",
        "end_time",
        "created_at",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}