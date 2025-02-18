<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        "id",
        "user_teacher_id",
        "booked",
        "day",
        "time_start",
        "time_end",

    ];

    public function teacher(){
        return $this->belongsTo(User::class, "user_teacher_id");
    }



}
